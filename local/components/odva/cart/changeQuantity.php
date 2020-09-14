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

$basket = Basket::getBasket();
if ($item = $basket->getExistsItem('catalog', $_POST['PRODUCT_ID']))
{
	$res = $item->setField('QUANTITY',$_POST['QUANTITY']);
	if($res->isSuccess())
	{
		$items = Cart::getProducts();
		$result['PRICE'] = Cart::getPrice($items['PRODUCTS']);
		$result['success'] = true;
		echo json_encode($result);
		$basket->save();
	}
	else
	{
		echo json_encode(['success' => false]);
	}
}