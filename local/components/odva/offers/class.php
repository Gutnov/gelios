<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

class Products extends CBitrixComponent
{
	public function getProducIds($filter)
	{
		$arSelect    = ['ID'];
		$res         = CIBlockElement::GetList([], $filter, false, [], $arSelect);
		$productsIds = [];
		while($ob = $res->GetNextElement())
		{
			$arFields      = $ob->GetFields();
			$productsIds[] = $arFields['ID'];
		}
		return $productsIds;
	}

	public function getOffers($filter,$params)
	{
		$arSelect = [];
		$arOrder  = $this->getSorting($params['sort']);
		$res      = CIBlockElement::GetList($arOrder, $filter, false, ["nPageSize"=>$params['count'],'iNumPage'=>$params['page']], $arSelect);
		$offers = [];
		while($ob = $res->GetNextElement())
		{
			$arFields               = $ob->GetFields();
			$arFields["PROPERTIES"] = $ob->getProperties();
			$arFields               = $this->applyOfferPropertiesSettings($arFields,$params['offerPropertiesSettings']);
			$arFields['PRODUCT']    = $this->getProduct($arFields["PROPERTIES"]['CML2_LINK']['VALUE'],$params['productPropertiesSettings']);
			$offers[] = $arFields;
		}
		return $offers;
	}

	public function applyOfferPropertiesSettings($offer,$settings)
	{
		$offer["PRICE"]   = $this->getProductBasePrice($offer["ID"]);

		if(empty($settings)) return $offer;
		// apply field setings by handling their methods
		foreach ($offer["PROPERTIES"] as $propertyKey => &$porpertyArray)
		{
			if(!array_key_exists($propertyKey, $settings)) continue;

			$methodName = "apply{$settings[$propertyKey]['type']}Settings";
			if(!method_exists($this,$methodName)) continue;

			$porpertyArray = $this->{$methodName}($settings[$propertyKey],$porpertyArray);
		}
		return $offer;
	}

	public function getProduct($productId,$productPropertiesSettings)
	{
		static $products = [];
		if(array_key_exists($productId, $products))
			return $products[$productId];

		$arSelect = [];
		$res      = CIBlockElement::GetList([], ['ID'=>$productId], false, [], $arSelect);
		if($ob = $res->GetNextElement())
		{
			$arFields               = $ob->GetFields();
			$arFields["PROPERTIES"] = $ob->getProperties();
			$arFields               = $this->applyProductPropertiesSettings($arFields,$productPropertiesSettings);
			$products[$arFields['ID']] = $arFields;
			return $arFields;
		}
		return false;
	}

	public function applyProductPropertiesSettings($product,$settings)
	{
		$product["SECTION"] = $this->getSection($product['IBLOCK_SECTION_ID']);
		if(empty($settings)) return $product;
		if(array_key_exists('PREVIEW_PICTURE', $settings))
		{
			$product['PREVIEW_PICTURE'] = ['VALUE' => $product['PREVIEW_PICTURE']];
			$product['PREVIEW_PICTURE'] = $this->applyImageSettings($settings['PREVIEW_PICTURE'], $product['PREVIEW_PICTURE']);
		}
		// apply field setings by handling their methods
		foreach ($product["PROPERTIES"] as $propertyKey => &$porpertyArray)
		{
			if(!array_key_exists($propertyKey, $settings)) continue;

			$methodName = "apply{$settings[$propertyKey]['type']}Settings";
			if(!method_exists($this,$methodName)) continue;

			$porpertyArray = $this->{$methodName}($settings[$propertyKey],$porpertyArray);
		}

		return $product;
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

	public $sortings = [
		'id_desc' => [
			'name'      => 'РїРѕ РїРѕРїСѓР»СЏСЂРЅРѕСЃС‚Рё',
			'filedName' => 'SORT',
			'direction' => 'desc',
			'default'   => 1
		],
		'date_desc' => [
			'name'      => 'РїРѕ РґР°С‚Рµ',
			'filedName' => 'ACTIVE_DATE',
			'direction' => 'desc'
		],
		'price_desc' => [
			'name'      => 'РїРѕ С†РµРЅРµ (РїРѕ СѓР±С‹РІР°РЅРёСЋ)',
			'filedName' => 'CATALOG_PRICE_1',
			'direction' => 'desc'
		],
		'price_asc' => [
			'name'      => 'РїРѕ С†РµРЅРµ (РїРѕ РІРѕР·СЂР°СЃС‚Р°РЅРёСЋ)',
			'filedName' => 'CATALOG_PRICE_1',
			'direction' => 'asc'
		],
	];

	/**
	 * [getSorting description]
	 * @param  string $sortString <sortName>-<sortDirection>
	 * @return sort array
	 */
	public function getSorting($sortString)
	{
		if(empty($sortString))
		{
			foreach ($this->sortings as $sortingKey => &$sorting)
				if($sorting['default'] == 1)
				{
					$sortString = $sortingKey;
					break;
				}
		}

		if(!array_key_exists($sortString, $this->sortings)) return [];
		$sortArray = $this->sortings[$sortString];
		$this->sortings[$sortString]['selected'] = 1;

		return ["{$sortArray['filedName']}"=>$sortArray['direction']];
	}
}
