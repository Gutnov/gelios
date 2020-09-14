<?php
	require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
	$APPLICATION->SetTitle("Публичная оферта | ".CSite::GetByID("s1")->Fetch()['NAME']);
?>
Публичная оферта
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>