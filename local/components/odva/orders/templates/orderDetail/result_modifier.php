<?php
if(!count($arResult['ORDERS']))
 LocalRedirect('/404.php');

$arResult = reset($arResult['ORDERS']);


CModule::IncludeModule('sale');
$res = CSaleBasket::GetList(array(), array("ORDER_ID" => $arResult['ID']));
echo $arResult['PRODUCTS']['PRODUCT_ID'];
while ($arItem 	= $res->Fetch())
{

	$arFilter = Array("ID" => $arItem['PRODUCT_ID']);
	$res = CIBlockElement::GetList(Array(), $arFilter, false, [], []);
	$arFields = $res->Fetch();
	$arResult['PRODUCTS'][] =[
	  'NAME' 		=> 	$arItem['NAME'],
	  'PRODUCT_ID' 	=> 	$arItem['PRODUCT_ID'],
	  'PRICE' 		=>	$arItem['PRICE'],
	  'QUANTITY' 	=> 	$arItem['QUANTITY'],
	  'IMG' 		=> 	CFile::GetPath($arFields['DETAIL_PICTURE'])
	 ];
}

$hour   						= 	substr($arResult['FORMAT_DATE_INSERT'],10,-3);
$arResult['TIME_DELIVERY']   	= 	($hour>7 && $hour<17)? "Можно будет забрать через 2 часа":"Можно забрать через 8 часов";
$arResult['FORMAT_DATE_INSERT'] = 	FormatDateFromDB($arResult["FORMAT_DATE_INSERT"],'D, d ,f');
?>