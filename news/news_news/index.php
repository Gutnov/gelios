<?php
	require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
	$APPLICATION->SetTitle("Новости | ".CSite::GetByID("s1")->Fetch()['NAME']);
?>
<?$APPLICATION->IncludeComponent(
	'odva:elements',
	'.default',
	[
		'filter' => [
			'IBLOCK_TYPE'    => 'news',
			'IBLOCK_ID'      => 1,
			'ID'		=> 1

		],
		'count' => 10
	]
);
?>



<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>


