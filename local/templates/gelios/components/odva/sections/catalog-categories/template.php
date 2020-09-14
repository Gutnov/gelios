<?php

Bitrix\Main\Page\Asset::getInstance()->addJs($templateFolder . "/script.js");

foreach($arResult['SECTIONS'] as $section)
{
	if(empty($section['ELEMENT_CNT']))
		continue;

	$APPLICATION->IncludeComponent(
		'odva:products',
		'category-slider',
		[
			'filter' => [
				'IBLOCK_ID'           => 2,
				'ACTIVE'              => 'Y',
				'SECTION_ID'          => $section['ID'],
				'INCLUDE_SUBSECTIONS' => 'Y'
			],
			'count'   => 10,
			'heading' => $section['NAME']
		]
	);
}

if(empty($_REQUEST['AJAX']))
{
	?>
	<button
		class="simple-button simple-button_catalog"
		data-page="1"
		data-parent="<?=$arParams['filter']['SECTION_ID']?>"
		onclick="odvaCatalogCategories.showMore(event)"
	>Показать ещё</button>
	<?php
}