<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Оформления заказа | ".CSite::GetByID("s1")->Fetch()['NAME']);
$APPLICATION->IncludeComponent('odva:orders', 'complite'//template -- имя шаблона компонента
    ,[
	'filter' => [
		'@ID' => [$_GET['id']]// массив ид заказов
		//параметры передаются в GetList филтр
	]
]);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");