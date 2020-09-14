<?php
foreach ($arResult['ORDERS'] as &$order)
{
	foreach ($order['PRODUCTS'] as &$product)
	{
		$sostavArr = [];
		foreach ($product['PROPERTIES'] as $property)
		{
			if(strpos($property['CODE'], 'LANCH_') !== false)
				$sostavArr[] = $property['NAME'].": ".$property['VALUE'];
		}
		$product['SOSTAV'] 		= 	$sostavArr;
		$product['PRICE'] 		=	number_format($product['PRICE'],0,' ',' ');
	}

	$order['PRICE']				=	number_format($order['PRICE'],0,' ',' ');
	$arDATE 					= 	ParseDateTime($order['DATE_INSERT'], FORMAT_DATETIME);
	$order['DATE_INSERT'] 		= 	$arDATE;
	$order['DATE_INSERT']['MM'] = 	ToLower(GetMessage("MONTH_".intval($arDATE["MM"])."_S"));
	// $order['DATE_INSERT'] = FormatDateFromDB($arResult["DATE_INSERT"],'D, d ,f');


}


