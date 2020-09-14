<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Мой заказ | ".CSite::GetByID("s1")->Fetch()['NAME']);

global $USER;
$APPLICATION->IncludeComponent('odva:orders', 'orderDetail', [
	'filter'=>[
		'ID'      => $_GET['oid'],
		'USER_ID' => $USER->GetID()
	]
]);

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
