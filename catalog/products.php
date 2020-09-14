<div class="catalog__left">
	<?php

	$fieldsMap = [
		'price'    => 'CATALOG_PRICE_1',
		'is_new'   => 'PROPERTY_IS_NEW',
		'in_store' => 'CATALOG_QUANTITY',
		'popular'  => 'PROPERTY_SALELEADER',
		'discount' => 'PROPERTY_DISCOUNT'
	];

	$sortArr = [
		$fieldsMap['price'] => 'ASC'
	];

	if(!empty($_REQUEST['sort']))
	{
		$sort = preg_replace('/\/{2,}/', '/', $_REQUEST['sort']);
		$sort = explode('/', $sort);
		$sort = array_chunk($sort, 2);
		$sort = array_filter($sort, function($item) { return count($item) == 2; });
		$sort = array_combine(array_column($sort, 0), array_column($sort, 1));

		if(!empty($sort))
			$sortArr = [];

		foreach ($sort as $sortKey => $sortDirection)
		{
			$sortDirection = strtoupper($sortDirection);
			if(!in_array($sortDirection, ['DESC', 'ASC']) || !array_key_exists($sortKey, $fieldsMap))
				continue;

			$sortArr[$fieldsMap[$sortKey]] = $sortDirection;
		}
	}

	$smartFilterResult = $APPLICATION->IncludeComponent(
		"odva:smart.filter",
		"",
		[
			'IBLOCK_ID'    => 2,
			'SECTION_CODE' => $_REQUEST['section'],
			'FILTER_URL'   => $_REQUEST['filter'],
			'SORT'         => $sortArr,
			'FIELDS_MAP'   => $fieldsMap,
			'PRICE'        => [
				'FIELD' => 'CATALOG_PRICE_1',
				'TITLE' => 'Цена'
			]
		]
	);
	?>
</div>
<div class="catalog__right">
	<div class="catalog__catigories-btn" onclick="o2.popups.mainCatalogMenuShow()">
		<div class="catalog__catigories-btn-right">
			<svg role="img" class="ic-filter">
				<use xlink:href="#ic-filter"></use>
			</svg>
			Сортировка и фильтры
		</div>
		<svg role="img" class="ic-right-catalog">
			<use xlink:href="#ic-right-catalog"></use>
		</svg>
		<div class="devider devider_main-catalog"></div>
	</div>
	<?php
	$filter = $smartFilterResult['products'];

	$filter['IBLOCK_ID']    = 2;
	$filter['ACTIVE']       = 'Y';
	$filter['SECTION_CODE'] = $_REQUEST['section'];

	$nav = new \Bitrix\Main\UI\PageNavigation('nav');
	$nav->allowAllRecords(false)->setPageSize(9)->initFromUri();

	$productsResult = $APPLICATION->IncludeComponent(
		"odva:products",
		"catalog",
		[
			'filter' => $filter,
			'sort'   => $sortArr,
			'count'  => $nav->getPageSize(),
			'page'   => $nav->getCurrentPage()
		]
	);

	$nav->setRecordCount($productsResult['NAV']['RECORD_COUNT']);

	$APPLICATION->IncludeComponent(
		"bitrix:main.pagenavigation",
		"",
		[
			"NAV_OBJECT" => $nav,
			"SEF_MODE"   => "Y",
		],
		false
	);
	?>
</div>