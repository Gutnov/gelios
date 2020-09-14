<?php
	require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
	$APPLICATION->SetTitle("Помощь | ".CSite::GetByID("s1")->Fetch()['NAME']);
?>
Помощь
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>