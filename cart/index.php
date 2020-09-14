<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Корзина | ".CSite::GetByID("s1")->Fetch()['NAME']);
$APPLICATION->IncludeComponent(
    'odva:cart',
    'page',
    []
);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");