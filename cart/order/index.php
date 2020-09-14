<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Оформления заказа | ".CSite::GetByID("s1")->Fetch()['NAME']);
$APPLICATION->IncludeComponent('odva:order.make','',['filter' => ['IBLOCK_ID' => 2]]);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");