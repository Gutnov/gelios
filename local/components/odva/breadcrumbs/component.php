<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
CModule::IncludeModule("iblock");

if(empty($arParams['LINKS']))
	$arParams['LINKS'] = [];

$this->IncludeComponentTemplate();
