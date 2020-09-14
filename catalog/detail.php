<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->IncludeComponent(
		'odva:product',
		'product.detail',
		[
			'filter' => [
				'IBLOCK_ID'    => 2,
				'ACTIVE'       => 'Y',
				'SECTION_CODE' => $_GET['section_code'],
				'CODE'		   => $_GET['product_code']
			],
		]
	);
?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>