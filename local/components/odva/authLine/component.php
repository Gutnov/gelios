<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
CModule::IncludeModule("iblock");

global $USER;
$arResult['AUTH'] = $USER->IsAuthorized();
$arResult['LOGOUT_AJAX_PATH'] = "$componentPath/ajax.loguot.php";
if ($arResult['AUTH'])
{
	$arResult['USER'] = [
		'EMAIL' => $USER->GetEmail(),
		'PIC'  => AuthLine::getAvatar()
	];
}
$this->IncludeComponentTemplate();
