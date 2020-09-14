<?php
$filter =
[
	'INCLUDE_SUBSECTIONS' => (empty($arResult['SECTION_ID'])?'N':'Y'),
	'ACTIVE'    => 'Y',
	'IBLOCK_ID' => 2,
];
if(empty($arResult['SECTION_ID']))
{
	$templateLeftMenu = "catalog-left-main";
}
else
{
	$templateLeftMenu = "catalog-left-category";
	$filter['SECTION_ID'] = $arResult['SECTION_ID'];
}
$APPLICATION->IncludeComponent(
	"odva:sections",
	$templateLeftMenu,
	[
		'filter' => $filter,
		'count' => 1000,
		'NAME' =>($arSection['NAME'])?$arSection['NAME']:'Каталог'
	]
);
?>
<div class="catalog__right">
	<?php $APPLICATION->IncludeFile('/inc/banner.catalog.php') ?>
	<div class="catalog__catigories-btn" onclick="o2.popups.mainCatalogMenuShow()">
		<div class="catalog__catigories-btn-right">
			<svg role="img" class="ic-catalog">
				<use xlink:href="#ic-catalog"></use>
			</svg>
			Список категорий
		</div>
		<svg role="img" class="ic-right-catalog">
			<use xlink:href="#ic-right-catalog"></use>
		</svg>
		<div class="devider devider_main-catalog"></div>
	</div>
	<?php
	$APPLICATION->IncludeComponent(
		'odva:products',
		'big.discount.catalog',
		[
			'filter' => [
				'IBLOCK_ID' => 2,
				'ACTIVE'    => 'Y',
				'!PROPERTY_DISCOUNT' => false
			],
			'sort' =>
			[
				'PROPERTY_DISCOUNT' => 'desc'
			],
			'count' => 10,
		]
	);

	$APPLICATION->IncludeComponent(
		'odva:sections',
		'catalog-categories',
		[
			'filter' => [
				'IBLOCK_ID'   => 2,
				'SECTION_ID'  => $arResult['SECTION_ID'],
				'ACTIVE'      => 'Y',
				'DEPTH_LEVEL' => (empty($arResult['SECTION_ID']) ? 1 : 2),
				'CNT_ACTIVE'  => 'Y',
			],
			'count' => 3,
		]
	);
	?>
</div>