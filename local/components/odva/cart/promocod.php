<?php
require_once($_SERVER['DOCUMENT_ROOT']. "/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("sale");
CModule::IncludeModule("catalog");
use Bitrix\Main,
Bitrix\Main\Localization\Loc as Loc,
Bitrix\Main\Loader,
Bitrix\Main\Config\Option,
Bitrix\Sale\Delivery,
Bitrix\Sale\PaySystem,
Bitrix\Sale,
Bitrix\Sale\Order,
Bitrix\Sale\DiscountCouponsManager,
Bitrix\Main\Context,
\Odva\Helpers\Basket;
include 'class.php';
$result['success'] = DiscountCouponsManager::add($_POST['PROMOCOD']);
$result['items'] = [];
if($result['success'])
{
	$items = Cart::getProducts();
	if(!empty($items['PRODUCTS']))
	{
		$result['PRICE'] = Cart::getPrice($items['PRODUCTS']);
	}
}

echo json_encode($result);