<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

class Products extends CBitrixComponent
{
	public function getProducts($filter,$propertiesSettings,$params)
	{
		$arSelect = ['*', 'CATALOG_QUANTITY'];
		$arOrder  = $params['sort'];
		if(!is_array($arOrder))
		{
			$arOrder = [];
		}
		$res      = CIBlockElement::GetList($arOrder, $filter, false, ["nPageSize"=>$params['count'],'iNumPage'=>$params['page']], $arSelect);
		$products = [];
		while($ob = $res->GetNextElement())
		{
			$arFields                                          = $ob->GetFields();
			$arFields["PROPERTIES"]                            = $ob->getProperties();

			// apply field setings by handling teir methods
			foreach ($arFields["PROPERTIES"] as $propertyKey => &$porpertyArray)
			{
				if(!array_key_exists($propertyKey, $propertiesSettings)) continue;

				$methodName = "apply{$propertiesSettings[$propertyKey]['type']}Settings";
				if(!method_exists($this,$methodName)) continue;

				$porpertyArray = $this->{$methodName}($propertiesSettings[$propertyKey],$porpertyArray);
			}

			// settings for preview picture
			if(array_key_exists('PREVIEW_PICTURE', $propertiesSettings))
			{
				$arFields['PREVIEW_PICTURE'] = ['VALUE' => $arFields['PREVIEW_PICTURE']];
				$arFields['PREVIEW_PICTURE'] = $this->applyImageSettings($propertiesSettings['PREVIEW_PICTURE'], $arFields['PREVIEW_PICTURE']);
			}

			$arFields["PRICE"]   = $this->getProductBasePrice($arFields["ID"]);
			$arFields["SECTION"] = $this->getSection($arFields['IBLOCK_SECTION_ID']);
			$products[]          = $arFields;
		}
		$this->arResult['NAV'] = [
			'RECORD_COUNT' => $res->NavRecordCount
		];
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

	/**
	 * applyImagesSettings
	 * @param  array $settings
	 * @param  array $propertyArray
	 * @return array
	 */
	public function applyImageSettings($settings,$propertyArray)
	{
		if(!empty($settings['sizes']))
		{
			$sizes = [];
			foreach ($settings['sizes'] as $sizeName => $sizeArray)
			{
				$sizes[$sizeName] = CFile::ResizeImageGet(
					$propertyArray['VALUE'],
					['width' => $sizeArray['width'], 'height' => $sizeArray['height']],
					BX_RESIZE_IMAGE_PROPORTIONAL,
					true
				);
			}
			$propertyArray['SIZES'] = $sizes;
		}
		return $propertyArray;
	}
}
