<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
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
class Cart extends CBitrixComponent
{
	public static function getPrice(&$items)
	{
		$basket = Sale\Basket::loadItemsForFUser(Sale\Fuser::getId(), Bitrix\Main\Context::getCurrent()->getSite());
		$context = new \Bitrix\Sale\Discount\Context\Fuser($basket->getFUserId());
		$discounts = \Bitrix\Sale\Discount::buildFromBasket($basket, $context);
		$r = $discounts->calculate();
		$result = $r->getData();
		foreach ($result['BASKET_ITEMS'] as $idProduct => $itemPrice)
		{
			$value += ($itemPrice['PRICE'] * $items[$idProduct]['QUANTITY']);
			$items[$idProduct]['PRICE'] = $itemPrice['PRICE'];
			$priceDiscount += ($itemPrice['DISCOUNT_PRICE'] * $items[$idProduct]['QUANTITY']);
		};
		return ['VALUE' => $value,'DISCOUNT'=> $priceDiscount];
	}
	public static function getProducts()
	{
		$productImtem = Basket::getItems();
		$result['PRODUCTS'] = [];
		$result['RECOMMEND'] = [];
		foreach ($productImtem as $productImtem)
		{
			$item['ID'] = $productImtem->getField("ID");
			$item['NAME'] = $productImtem->getField("NAME");
			$item['PRODUCT_ID'] = $productImtem->getField("PRODUCT_ID");
			$item['BASE_PRICE'] = round($productImtem->getField("BASE_PRICE"),0);
			$item['QUANTITY'] = $productImtem->getField("QUANTITY");
			$res = CIBlockElement::GetList([], ['ID'=>$item['PRODUCT_ID']], false, [], []);
			$ob = $res->GetNextElement();
			$result['RECOMMEND'] = array_merge($result['RECOMMEND'],$ob->getProperties()['RECOMMEND']['VALUE']);
			$item['IMG'] = $ob->GetFields()['DETAIL_PICTURE'];
			$result['PRODUCTS'][$item['ID']] = $item;
		}
		return $result;
	}
	public function executeComponent()
	{
		$this->arResult['BASE_PRICE'] = Basket::getPrice();
		$this->arResult['RESULT'] = $this->getProducts();
		$this->arResult['COUNT'] = Basket::getCount();
		if(!empty($this->arResult['RESULT']['PRODUCTS']))
		{
			$this->arResult['PRICE'] = $this->getPrice($this->arResult['RESULT']['PRODUCTS']);
		}
		$this->arResult['PATH_ACTIVATE_RPOMOCOD'] = $this->GetPAth().'/promocod.php';
		$this->arResult['PATH_CHANGE_QUANTITY'] = $this->GetPAth().'/changeQuantity.php';
		$this->arResult['PATH_REMOVE_ITEM'] = $this->GetPAth().'/removeItem.php';
		$this->IncludeComponentTemplate();
	}
}
