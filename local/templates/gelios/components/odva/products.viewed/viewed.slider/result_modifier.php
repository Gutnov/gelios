<?php

use Odva\Helpers\Formatters;

\Odva\Helpers\JsLib::registerExt($this);

$favorites = \Odva\Helpers\Favorites::get();

foreach ($arResult as &$product)
{
	$product['IS_FAVORITE'] = in_array($product['ID'], $favorites);

	$product['PRICE']['VALUE']    = Formatters::price($product['PRICE']['VALUE']);
	$product['PRICE']['DISCOUNT'] = false;

	if(!empty($product['PROPERTIES']['PRICE_OLD']['VALUE']) && !empty($product['PROPERTIES']['DISCOUNT']['VALUE']))
	{
		$product['PRICE'] = [
			'VALUE'    => Formatters::price($product['PROPERTIES']['PRICE_OLD']['VALUE']),
			'DISCOUNT' => [
				'PRICE'   => Formatters::price($product['PRICE']['VALUE']),
				'PERCENT' => $product['PROPERTIES']['DISCOUNT']['VALUE'],
				'VALUE'   => Formatters::price($product['PROPERTIES']['PRICE_OLD']['VALUE'] - $product['PRICE']['VALUE'])
			]
		];
	}
}
