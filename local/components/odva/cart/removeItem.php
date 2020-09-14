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

if(CSaleBasket::Delete($_POST['PRODUCT_ID']))
{
	$result['success'] = true;
	$items = Cart::getProducts();
	$result['PRICE'] = Cart::getPrice($items['PRODUCTS']);
	echo json_encode($result);
}
else
{
	echo json_encode(['success' => false]);
};