<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

class ProductsViewed extends CBitrixComponent
{
	public function onPrepareComponentParams($params)
	{
		if(empty($params['COUNT']))
			$params['COUNT'] = 10;

		return $params;
	}

	public function executeComponent()
	{
		CModule::IncludeModule("sale");

		$rsViewedProducts = \Bitrix\Catalog\CatalogViewedProductTable::getList([
			'filter' => ['FUSER_ID' => CSaleBasket::GetBasketUserID()],
			'order'  => ['DATE_VISIT' => 'DESC'],
			'limit'  => $this->arParams['COUNT']
		]);

		$productIds = [];

		while($arViewedProducts = $rsViewedProducts->Fetch())
			$productIds[] = $arViewedProducts['ELEMENT_ID'];

		if(empty($productIds))
		{
			$this->arResult = [];
			return $this->IncludeComponentTemplate();
		}

		$this->arResult = $this->getProducts(['=ID' => $productIds]);

		return $this->IncludeComponentTemplate();
	}

	public function getProducts($filter = [])
	{
		$res      = CIBlockElement::GetList([], $filter, false, false, ['*', 'CATALOG_QUANTITY']);
		$products = [];
		while($ob = $res->GetNextElement())
		{
			$arFields               = $ob->GetFields();
			$arFields["PROPERTIES"] = $ob->getProperties();

			$arFields["PRICE"]      = $this->getProductBasePrice($arFields["ID"]);
			$arFields["SECTION"]    = $this->getSection($arFields['IBLOCK_SECTION_ID']);
			$products[]             = $arFields;
		}
		return $products;
	}

	/**
	 * getSection  by id
	 * @param  int $sectionId section id
	 * @return section info array or false
	 */
	public function getSection($sectionId)
	{
		$res = CIBlockSection::GetByID($sectionId);
		if($sectionRes = $res->GetNext())
			return $sectionRes;
		return false;
	}

	/**
	 * get products price
	 * @param  int $productId
	 * @return price array or false
	 */
	public function getProductBasePrice($productId)
	{
		$price = CCatalogProduct::GetOptimalPrice($productId);

		if(!$price) return false;

		$priceArr = [
			'VALUE'    => $this->formatPrice($price['PRICE']['PRICE']),
			'DISCOUNT' => false
		];

		if(empty($price['DISCOUNT']))
			return $priceArr;

		$priceArr['DISCOUNT'] = [
			'PRICE'   => $this->formatPrice($price['RESULT_PRICE']['DISCOUNT_PRICE']),
			'VALUE'   => $this->formatPrice($price['RESULT_PRICE']['DISCOUNT']),
			'PERCENT' => $price['RESULT_PRICE']['PERCENT']
		];

		return $priceArr;
	}
	public function formatPrice($price)
	{
		if($price - floor($price) != 0)
			return $price;

		return number_format($price, 0, '', '');
	}
}