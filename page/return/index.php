<?php
	require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
	$APPLICATION->SetTitle("Возврат | ".CSite::GetByID("s1")->Fetch()['NAME']);
?>
Возврат
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>