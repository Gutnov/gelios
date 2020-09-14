<?php
foreach ($arResult['ITEMS'] as &$item)
{
	$arDATE = ParseDateTime($item['DATE_CREATE'], FORMAT_DATETIME);
	$item['DATE_CREATE'] = $arDATE;
	$item['DATE_CREATE']['MM'] = ToLower(GetMessage("MONTH_".intval($arDATE["MM"])."_S"));
}
