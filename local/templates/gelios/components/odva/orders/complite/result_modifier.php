<?php
use Bitrix\Sale,
Bitrix\Sale\Order;

$arResult = $arResult['ORDERS'][0];
// список товаров по id заказа
function BasketItems($order_id){
   $dbBasketItems = CSaleBasket::GetList(
        array(
                "NAME" => "ASC",
                "ID" => "ASC"
            ),
        array(
                "LID" => SITE_ID,
                "ORDER_ID" => "$order_id",
                "CAN_BUY" => "Y"
            ),
        false,
        false,
        array("ID", "CALLBACK_FUNC", "MODULE",
              "PRODUCT_ID", "QUANTITY", "DELAY",
              "CAN_BUY", "PRICE", "WEIGHT")
    );
   while ($arItems = $dbBasketItems->Fetch())
   {
       if (strlen($arItems["CALLBACK_FUNC"]) > 0)
       {
           CSaleBasket::UpdatePrice($arItems["ID"],
                                    $arItems["CALLBACK_FUNC"],
                                    $arItems["MODULE"],
                                    $arItems["PRODUCT_ID"],
                                    $arItems["QUANTITY"]);
           $arItems = CSaleBasket::GetByID($arItems["ID"]);
       }
       $arBasketItems[] = $arItems;
   }
   return $arBasketItems;
}
//функция для склонения
function declension($number, array $data)
{
	$rest = array($number % 10, $number % 100);
	if($rest[1] > 10 && $rest[1] < 20)
	{
    	return $data[2];
 	}
	elseif ($rest[0] > 1 && $rest[0] < 5)
 	{
 		return $data[1];
	}
	else if ($rest[0] == 1)
	{
		return $data[0];
	}
	return $data[2];
}
//достаю товары
$arResult['PRODUCTS_ITEMS'] = BasketItems($arResult['ID']);
$arResult['COUNT_PRODUCTS'] = 0;
foreach ($arResult['PRODUCTS_ITEMS'] as &$product)
{
	$res	 = CIBlockElement::GetList([], ['ID'=>$product['PRODUCT_ID']], false, [], []);
	$ob   = $res->GetNextElement();
	//достаю картинку
	$product['DETAIL_PICTURE'] = CFile::GetPath($ob->GetFields()['DETAIL_PICTURE']);
	//достаю имя товара
	$product['NAME'] = $ob->GetFields()['NAME'];
	//считаю общее количество товаров
	$arResult['COUNT_PRODUCTS'] += $product['QUANTITY'];
	//считаю общую цену за каждый товар
	$product['ALL_PRICE'] = $product['PRICE'] * $product['QUANTITY'];
}
// готовлю строку сколько товаров и склоняю слово рядом
$arResult['COUNT_PRODUCTS_STR'] =
	$arResult['COUNT_PRODUCTS']." ".declension($arResult['COUNT_PRODUCTS'],['товар','товара','товаров']);
$order = \Bitrix\sale\Order::load($arResult['ID']);
$discounts = $order->getDiscount();
$res = $discounts->getApplyResult();
$priceArrayBasket = array_pop($res['PRICES']['BASKET']);
//достаю цену товара без скидки
$arResult['PRICE_WITH_SALE'] = $priceArrayBasket['BASE_PRICE'];
//достаю цену товара со скидкой
$arResult['PRICE_SALE'] = $priceArrayBasket['PRICE'];
//считаю скидку
$arResult['SALE_VALUE'] = $arResult['PRICE_WITH_SALE'] - $arResult['PRICE_SALE'];

if($arResult['DELIVERY_ID'] == 3)
{
	$res = CIBlockElement::GetList(
		[],
		['IBLOCK_ID' => 5,'PROPERTY_ADRESS' => trim($arResult['PROPERTIES']['ADDRESS']['VALUE'])],
		false,
		[],
		[]
	);
	$ob = $res->GetNextElement();
	$pharmacy = $ob->GetFields();
	$pharmacy['PROPERTIES'] = $ob->getProperties();
	if($pharmacy['PROPERTIES']['GIVE_TODAY']['VALUE'] == 'да')
	{
		$arResult['WHEN_GIVE'] = 'Можно забрать через 10 минут';
	}
	else
	{
		if(Date("H") >= 7 || Date("H") <= 17)
		{
			$arResult['WHEN_GIVE'] = 'Забрать можно через 2 часа';
		}
		else
		{
			$arResult['WHEN_GIVE'] = 'Забрать можно через 8 часа';
		}
	};
}
else
{
	//модицицируем дату доставки
	$dateDelivery = new DateTime($arResult['DATE_INSERT']);
	$dateDelivery->modify('+30 min');
	//достаю день недели доставки
	$arResult['DELIVETY_DAY_WEEK_NAME'] = FormatDate("l",MakeTimeStamp($dateDelivery->format("d.m.Y G:i:s")));
	//достаю день доставки
	$arResult['DELIVETY_DAY'] = $dateDelivery->format("j");
	//достаю имя месяца доставки в родительном падиже
	$arResult['DELIVETY_MAY_NAME'] = FormatDate("F",MakeTimeStamp($dateDelivery->format("d.m.Y G:i:s")));
	//достаю время доставки
	$arResult['DELIVETY_TIME'] = $dateDelivery->format("G:i");
};