<?php
	require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
	$APPLICATION->SetTitle("Заказы | ".CSite::GetByID("s1")->Fetch()['NAME']);
?><?
LocalRedirect('/personal/');
?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>