<?php
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
Bitrix\Main\Context;
$arBasketItems = array();

$arBasketItems = $this->getProducts();

$arResult['ITEMS'] = [];
foreach ($arBasketItems as $product)
{
	$item = $this->getProduct(['IBLOCK_ID' => $arParams['filter']['IBLOCK_ID'],'ID' => $product['PRODUCT_ID']]);
	$subProcduct['NAME'] = $item['NAME'];
	$subProcduct['PICTURE'] = CFile::ResizeImageGet($item['DETAIL_PICTURE'], ['width' => 828, 'height' => 828])['src'];
	$subProcduct['COUNT'] = $product['QUANTITY'];
	$arResult['ITEMS'][] = $subProcduct;
}
DiscountCouponsManager::add("SL-JBOCR-9PEWSAQ"); // установить купон
//DiscountCouponsManager::clear(true); // удалить купон
// $couponList = \Bitrix\Sale\DiscountCouponsManager::get(true, array(), true, false);
// $discountID = [];
// foreach ($couponList as $coupon)
// {
//    $discountID[] = $coupon['DISCOUNT_ID'];

// }
$this->IncludeComponentTemplate();