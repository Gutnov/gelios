<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
CModule::IncludeModule("iblock");

$arResult["SECTIONS"] = $this->getSections($arParams,$arParams["count"]);

$this->IncludeComponentTemplate();

return $arResult;
