<?php

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

class Instagram extends CBitrixComponent
{
	public function executeComponent()
	{
		// это временная мера, достаются данные из json файла
		// когда сделаем аккаунт instagram, переделаем на доставание постов через API
		$debugJsonPath = dirname(__FILE__) . "/debug.json";
		$this->arResult = json_decode(file_get_contents($debugJsonPath), true);
		$this->includeComponentTemplate();
	}
}