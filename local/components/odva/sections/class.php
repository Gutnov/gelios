<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

class Sections extends CBitrixComponent
{
	public function getSections($arParams, $count = 10)
	{
		$filter   = (empty($arParams['filter']) || !is_array($arParams['filter'])) ? [] : $arParams['filter'];
		$page     = (empty(intval($arParams['page']))) ? 1 : $arParams['page'];
		$arSelect = [];
		$sections = [];
		$res = CIBlockSection::GetList([], $filter, true, $arSelect,["nPageSize" => $count, "iNumPage" => $page]);
		while($ob = $res->GetNextElement())
		{
			$arFields            = $ob->GetFields();
			$arFields["PICTURE"] = CFile::ResizeImageGet($arFields["PICTURE"], ['width'=>639, 'height'=>551], BX_RESIZE_IMAGE_PROPORTIONAL, true);
			$arFields['ELEMENTS_COUNT'] = $this->formatProductsCount($arFields['ELEMENT_CNT']);
			$sections[]          = $arFields;
		}
		$this->arResult['NAV'] = [
			'currentPage'   => $res->NavPageNomer,
			'maxPage'       => $res->NavPageCount,
			'isLastPage'    => ($res->NavPageNomer == $res->NavPageCount),
			'elementsCount' => $res->NavRecordCount
		];
		return $sections;
	}

	public function formatProductsCount($count)
	{
		if($count == 1)
			return "{$count} продукт";
		elseif($count > 1 and $count < 5)
			return "{$count} продукта";
		elseif($count > 4)
			return "{$count} продуктов";
		else
			return "Нет продуктов";
	}

}
