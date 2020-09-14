<?php

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

Bitrix\Main\Loader::includeModule("iblock");

$sectionId = empty(intval($_REQUEST['SECTION_ID'])) ? false : intval($_REQUEST['SECTION_ID']);
$page      = empty(intval($_REQUEST['PAGE'])) ? 1 : intval($_REQUEST['PAGE']);

$filter = [
	'IBLOCK_ID'   => 2,
	'ACTIVE'      => 'Y',
	'DEPTH_LEVEL' => ($sectionId ? 2 : 1),
	'CNT_ACTIVE'  => 'Y',
];

if($sectionId)
	$filter['SECTION_ID'] = $sectionId;

ob_start();
$result = $APPLICATION->IncludeComponent(
	'odva:sections',
	'catalog-categories',
	[
		'filter' => [
			'IBLOCK_ID'   => 2,
			'SECTION_ID'  => $sectionId,
			'ACTIVE'      => 'Y',
			'CNT_ACTIVE'  => 'Y',
		],
		'count' => 3,
		'page' => $page
	]
);
$html = ob_get_contents();
ob_end_clean();

echo json_encode([
	'html' => $html,
	'nav'  => $result['NAV']
]);