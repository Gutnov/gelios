<?php
	require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
	$APPLICATION->SetTitle("Поставщикам | ".CSite::GetByID("s1")->Fetch()['NAME']);
?>
Поставщикам
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>