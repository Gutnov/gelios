<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Каталог | ".CSite::GetByID("s1")->Fetch()['NAME']);

$arSection = false;

if(empty($_REQUEST['section']))
{
	$arResult['SECTION_ID'] = false;
	$arResult['PAGE']       = 'sections';
}
else
{
	$arSection = CIBlockSection::GetList([], ['CODE' => $_REQUEST['section']])->GetNext();

	if(!$arSection)
		Bitrix\Iblock\Component\Tools::process404('', true, true, true, false);

	if(!empty(CIBlockSection::GetCount(['SECTION_ID' => $arSection['ID']])))
	{
		$arResult['SECTION_ID'] = $arSection['ID'];
		$arResult['PAGE']       = 'sections';
	}
	else
		$arResult['PAGE'] = 'products';
}
?>
<div class="container">
	<?php
	$links = [
		[
			'text' => 'Главная',
			'url'  => '/'
		],
		[
			'text' => 'Каталог',
			'url'  => '/catalog/'
		]
	];

	if(!empty($arSection))
	{

		$nav = CIBlockSection::GetNavChain(false, $arSection['ID']);
		while($v = $nav->GetNext())
		{
			$links[] = [
				'text' => $v['NAME'],
				'url'  => $v['SECTION_PAGE_URL']
			];

			$APPLICATION->SetTitle($v['NAME'] . " | ".CSite::GetByID("s1")->Fetch()['NAME']);
		}
	}

	$APPLICATION->IncludeComponent(
		"odva:breadcrumbs",
		"",
		[
			'LINKS' => $links
		]
	);
	?>
	<h2 class="catalog__title"><?=($arSection['NAME'])?$arSection['NAME']:'Каталог'?></h2>
	<div class="catalog__wr<?=$arResult['PAGE'] == 'products' ? ' catalog__wr--filter' : ''?>">
		<?php include __DIR__ . "/{$arResult['PAGE']}.php"; ?>
	</div>
</div>
<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php"); ?>