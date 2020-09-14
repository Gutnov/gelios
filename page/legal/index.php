<?php
	require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
	$APPLICATION->SetTitle("Правовая информация | ".CSite::GetByID("s1")->Fetch()['NAME']);
?>
Правовая информация
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>