<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
require_once 'fieldTypes/baseField.php';
CModule::IncludeModule("iblock");

$filterArray = $this->explodeUrlToParams($arParams['url']);

$arResult['FIELDS'] = [];
$productsFilter = [];
$offersFilter = [];
if(count($arParams['fields']))
{
	foreach ($arParams['fields'] as $fieldName => $fieldArr)
	{
		$curFieldArr = [];
		$className = "{$fieldArr['type']}FilterField";
		$classPath = "fieldTypes/{$className}.php";
		if(!file_exists(__DIR__."/{$classPath}")) continue;

		require_once $classPath;
		$fieldObject = new $className();

		if(!empty($filterArray['filter'][$fieldName]))
			$fieldObject->setValue($filterArray['filter'][$fieldName]);

		if(!empty($fieldArr['offers']))
			$addFilter = ['IBLOCK_ID' => $arParams['offersFilter']['IBLOCK_ID']];
		else
			$addFilter = [
				'IBLOCK_ID'    => $fieldIblockId,
				'SECTION_CODE' => $arParams['productsFilter']['SECTION_CODE']
			];

		$settings = array_merge($fieldArr, $addFilter);

		$fieldObject->setSettings($settings);
		$fieldObject->setFilter($arParams['productsFilter']);
		$curFieldArr['VALUES']          = $fieldObject->getValues();
		$curFieldArr['TYPE']            = $fieldArr['type'];
		$curFieldArr['SETTINGS']        = $fieldArr;
		$curFieldArr['FILTER']          = $fieldObject->getFilter();
		$arResult['FIELDS'][$fieldName] = $curFieldArr;
		if(empty($fieldArr['offers']))
			$productsFilter = array_merge($productsFilter,$curFieldArr['FILTER']);
		else
			$offersFilter = array_merge($offersFilter,$curFieldArr['FILTER']);
	}
}

if(!empty($arParams['ajax']))
	$this->IncludeComponentTemplate('ajax');
else
	$this->IncludeComponentTemplate();

// return filter
$filterArray['offersFilter'] = array_merge($arParams['offersFilter'],$offersFilter);
$filterArray['productsFilter'] = array_merge($arParams['productsFilter'],$productsFilter);
return $filterArray;
