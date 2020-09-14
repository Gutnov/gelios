<?php
	require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
	$APPLICATION->SetTitle("Акции | ".CSite::GetByID("s1")->Fetch()['NAME']);
?>
Акции
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>