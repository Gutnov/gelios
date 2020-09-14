<?php
$res = CIBlockElement::GetList([], ['IBLOCK_ID' => 5], false, [], []);
$pharmacies = [];
while($ob = $res->GetNextElement())
{
	$pharmacy = $ob->GetFields();
	$pharmacy['PROPERTIES'] = $ob->getProperties();
	if($pharmacy['PROPERTIES']['GIVE_TODAY']['VALUE'] == 'да')
	{
		$pharmacy['WHEN_GIVE'] = 'Можно забрать через 10 минут';
	}
	else
	{
		if(Date("H") >= 7 || Date("H") <= 17)
		{
			$pharmacy['WHEN_GIVE'] = 'Забрать можно через 2 часа';
		}
		else
		{
			$pharmacy['WHEN_GIVE'] = 'Забрать можно через 8 часа';
		}
	}
	$pharmacies[] = $pharmacy;
}
$arResult['PHARMACIES'] = $pharmacies;
