<?php

use Odva\Helpers\Formatters;

foreach ($arResult['PRODUCTS'] as &$product)
{
	$product['HAS_BASKET'] = \Odva\Helpers\Basket::hasInBasket($product['ID']);

	$product['PRICE']['VALUE']    = Formatters::price($product['PRICE']['VALUE']);
	$product['PRICE']['DISCOUNT'] = false;

	if(!empty($product['PROPERTIES']['PRICE_OLD']['VALUE']) && !empty($product['PROPERTIES']['DISCOUNT']['VALUE']))
	{
		$oldPrice  = Formatters::price($product['PROPERTIES']['PRICE_OLD']['VALUE']);
		$newPrice  = Formatters::price($product['PRICE']['VALUE']);
		$diffPrice = Formatters::price($product['PROPERTIES']['PRICE_OLD']['VALUE'] - $product['PRICE']['VALUE']);

		$product['PRICE'] = [
			'VALUE'    => $oldPrice,
			'DISCOUNT' => [
				'PRICE'   => $newPrice,
				'PERCENT' => $product['PROPERTIES']['DISCOUNT']['VALUE'],
				'VALUE'   => $diffPrice
			]
		];
	}
}
