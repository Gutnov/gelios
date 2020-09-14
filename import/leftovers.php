<?php
set_time_limit(0);
ini_set('memory_limit','1000M');
require($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/main/include/prolog_before.php");
global $USER;
$USER->Authorize(1);
CModule::IncludeModule("iblock");
CModule::IncludeModule("catalog");
CModule::IncludeModule("sale");
CModule::IncludeModule('highloadblock');
class RewriteProduct
{
	private $idCatalog = 2; // ID инфоблока каталога
	private $idSection = 148; // ID секции для новых товаров
	private $manufacter = []; // список производителей

	//метод конвертирует русские символы в английские
	public function convertNameToCode($name)
	{
		return Cutil::translit($name,"ru",["replace_space"=>"-","replace_other"=>"-"]);
	}

	//метод добавляющий производителя
	private function addManufacter($name)
	{
		$property = CIBlockProperty::GetByID("MANUFACTURER", $this->idCatalog)->GetNext();
		$ibpenum = new CIBlockPropertyEnum;
		if($PropID = $ibpenum->Add(Array('PROPERTY_ID'=>$property['ID'], 'VALUE'=>$name)))
		{
			$this->manufacter[$name] = $PropID;
			return $PropID;
		}
		else
		{
			return false;
		}
	}

	//метод проверяющий сушествование производителя если есть вернуть его id иначе добавить его
	private function hasManufactur($name)
	{
		if(array_key_exists($name, $this->manufacter))
		{
			return $this->manufacter[$name];
		}
		else
		{
			return $this->addManufacter($name);
		}
	}

	//метод проверяющий сушествование товара в каталоге
	private function hasProduct($articul)
	{
		if(empty($articul))
			return false;
		$arFilter = Array('IBLOCK_ID' => $this->idCatalog,'PROPERTY_ARTNUMBER' => $articul);
		$db_list = CIBlockElement::GetList([], $arFilter,false, [], ['ID']);
		return !empty($db_list->GetNextElement()->fields['ID']);
	}

	//метод добавляющий товар
	private function addProduct($data)
	{
		//проверяю сушествование производителя, если его нет то добавляю его
		if(empty($data[1]))
			return false;
		$idManufacter = $this->hasManufactur($data[3]);
		//заполняю дополнительные свойства товара
		$poperty = [
			'ARTNUMBER' => (string)$data[1],
			'MANUFACTURER'=> $idManufacter
		];
		//заполняю основные свойства товара
		$arFields = array(
		   "ACTIVE" => 'Y',
		   "IBLOCK_ID" => $this->idCatalog,
		   "IBLOCK_SECTION_ID" => $this->idSection,
		   "NAME" => $data[2],
		   "CODE" => $this->convertNameToCode($data[2]),
		   "PROPERTY_VALUES" => $poperty
		);
		//добавляю товар
		$oElement = new CIBlockElement();
		$idElement = $oElement->Add($arFields, true);
		//добавляю количество товара на cкладе
		$arFields = Array(
			"PRODUCT_ID" => $idElement,
			"STORE_ID" => 1,
			"AMOUNT" => (int)$data[6],
		);
		CCatalogStoreProduct::Add($arFields);
		//регестрирую товар и устаналиваю закупочную цену
		$arFields = array(
				  "ID" => $idElement,
				  "VAT_ID" => 1, //выставляем тип ндс (задается в админке)
				  "VAT_INCLUDED" => "Y", //НДС входит в стоимость
				  "PURCHASING_PRICE" => (int)$data[4],
				  "PURCHASING_CURRENCY" => "RUB",
				  "QUANTITY" => (int)$data[6],
				  );
		CCatalogProduct::Add($arFields);
		//устанавливаю базовую цену
		$arFields = Array(
			"PRODUCT_ID" => $idElement,
			"CATALOG_GROUP_ID" => 1,
			"PRICE" => (int)$data[4],
			"CURRENCY" => "RUB",
		);
		CPrice::add($arFields,true);

	}

	//метод обновляющий товар
	private function updateProduct($data)
	{
		if(empty($data[1]))
			return false;
		//достаю обновляемый продукт
		$arFilter 				= Array('IBLOCK_ID' => $this->idCatalog,'PROPERTY_ARTNUMBER' => $data[1]);
		$db_list 				= CIBlockElement::GetList([], $arFilter,false, [], []);
		$ob    					= $db_list->GetNextElement();
		$arFields				= $ob->GetFields();
		$arFields["PROPERTIES"] = $ob->getProperties();
		$arForUpdate = [];
		//меняю имя если оно изменилось
		if($data[2] != $arFields['NAME'])
		{
			$arForUpdate['NAME'] = $data[2];
			$arForUpdate['CODE'] = $this->convertNameToCode($data[2]);
		}
		if(count($arForUpdate))
		{
			$el = new CIBlockElement;
			$el->Update($arFields['ID'], $arForUpdate);
		};
		//меняю производителя если он был изменен
		if($data[3] != $arFields["PROPERTIES"]['MANUFACTURER']['VALUE'])
		{
			$idManufacter = $this->hasManufactur($data[3]);
			CIBlockElement::SetPropertyValues($arFields['ID'], $arFields['IBLOCK_ID'], $idManufacter, 'MANUFACTURER');
		}
		//меняю количество товара
		$res = CCatalogProduct::GetList(
			[],
			["ID"=>$arFields['ID']],
			false,
			[]
		);
		$itemCatalog = $res->Fetch();
		if((int)$itemCatalog['QUANTITY'] != (int)$data[6])
		{
			$arFields = array('QUANTITY' => (int)$data[6]);
			CCatalogProduct::Update($itemCatalog['ID'], $arFields);
		}
		//меняю цену товара
		$res = CPrice::GetList([],["PRODUCT_ID" => $arFields['ID'],"CATALOG_GROUP_ID" => 1]);
		$arr = $res->Fetch();
		if((int)$arr['PRICE'] != (int)$data[4])
		{
			CPrice::Update($arr["ID"], ['PRICE' => (float)$data[4]]);
		}
		//меняю количество товара
		$rsStore = CCatalogStoreProduct::GetList([], ['PRODUCT_ID' => $arFields['ID'], 'STORE_ID' => 1], false, false, []);
		$arStore = $rsStore->Fetch();
		if($arStore['AMOUNT'] != (int)$data[6])
		{
			CCatalogStoreProduct::Update($arStore['ID'], ['AMOUNT' => (int)$data[6]]);
		}


	}

	public function __construct()
	{
		$property_enums = CIBlockPropertyEnum::GetList(Array("sort"=>"asc"), Array("IBLOCK_ID"=>$this->idCatalog, "CODE"=>"MANUFACTURER"));
		while($enum_fields = $property_enums->GetNext())
		{
		  	$this->manufacter[htmlspecialchars_decode($enum_fields['VALUE'])] = $enum_fields["ID"];
		};
		$productsFile = fopen($_SERVER['DOCUMENT_ROOT'].'/import/ostatki.csv', "r");
		while (($data = fgetcsv($productsFile,0,";")) !== FALSE)
		{
			if($this->hasProduct($data[1]))
			{
				$this->updateProduct($data);
			}
			else
			{
				$this->addProduct($data);
			};
		};
		fclose($productsFile);
	}
}
$object = new RewriteProduct();