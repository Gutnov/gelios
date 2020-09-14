<?php
foreach ($arResult['RESULT']['PRODUCTS'] as &$products)
{
	$products['IMG'] = CFile::ResizeImageGet($products['IMG'], ['width' => 240, 'height' => 240])['src'];
}
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
};
$arResult['STR_COUNT'] = declension($arResult['COUNT']['ITEMS'],['товар','товара','товаров']);
\Odva\Helpers\JsLib::registerExt($this);
?>