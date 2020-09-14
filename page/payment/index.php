<?php
	require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
	$APPLICATION->SetTitle("Оплата | ".CSite::GetByID("s1")->Fetch()['NAME']);
?>
Оплата
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>