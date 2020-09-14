<?php
	define("HIDE_SIDEBAR", true);
	require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
	$APPLICATION->SetTitle("Корзина | ".CSite::GetByID("s1")->Fetch()['NAME']);
?>
<?php
$APPLICATION->IncludeComponent(
	'odva:cartOrder',
	'',
	[]
);
?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>