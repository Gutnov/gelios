<?php

$rootSections  = [];
$childSections = [];

foreach ($arResult['SECTIONS'] as $section)
{
	$sect = [
		'ID' => $section['ID'],
		'NAME' => $section['NAME'],
		'CODE' => $section['CODE'],
		'URL' => $section['SECTION_PAGE_URL'],
	];
	if(empty($section['IBLOCK_SECTION_ID']))
		$rootSections[$section['ID']] = $sect;
	else
		$childSections[$section['IBLOCK_SECTION_ID']][] = $sect;
}

foreach ($rootSections as $rootSectionId => $rootSection)
{
	if(!empty($childSections[$rootSectionId]))
		$rootSections[$rootSectionId]['SECTIONS'] = $childSections[$rootSectionId];
}

$arResult['SECTIONS'] = $rootSections;