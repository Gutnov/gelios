<?php
	require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
	$APPLICATION->SetTitle(CSite::GetByID("s1")->Fetch()['NAME']);
?>
<div class="container">
	<?php
	$APPLICATION->IncludeComponent(
		'odva:elements',
		'slider.on.main',
		[
			'filter' => [
				'IBLOCK_ID' => 4,
				'ACTIVE'    => 'Y',
			],
			"count" => 2
		]
	);

	$APPLICATION->IncludeComponent(
		'odva:products',
		'saleleader',
		[
			'filter' => [
				'IBLOCK_ID'  => 2,
				'ACTIVE'     => 'Y',
				'PROPERTY_SALELEADER_VALUE' => 'Y',
			],
			'count' => 10,
			'heading' => 'Популярные товары'
		]
	);
	$APPLICATION->IncludeComponent(
		'odva:products',
		'big.discount',
		[
			'filter' => [
				'IBLOCK_ID' => 2,
				'ACTIVE'    => 'Y',
				'!PROPERTY_DISCOUNT' => false
			],
			'sort' =>
			[
				'PROPERTY_DISCOUNT' => 'desc'
			],
			'count' => 5,
		]
	);
	$APPLICATION->IncludeComponent(
		'odva:products',
		'saleleader',
		[
			'filter' => [
				'IBLOCK_ID' => 2,
				'ACTIVE'    => 'Y',
				'PROPERTY_ACTUAL_VALUE' => 'Y'
			],
			'count' => 50,
			'heading' => 'Актуально в эту погоду'
		]
	);
	?>
	<?php $APPLICATION->IncludeComponent('odva:products.viewed', 'viewed.slider', []);?>
	<?php $APPLICATION->IncludeFile('/inc/main.banners.php') ?>
	<?php $APPLICATION->IncludeComponent('odva:instagram', '', []);?>
	<?php
		$APPLICATION->IncludeComponent('odva:elements', 'news.main'
			,[
			'filter' => [
				'IBLOCK_ID' => 1,
				'ACTIVE'    => 'Y',
			],
			'sort'=>
			[
				'ID'=>'desc'
			],
			"count" => 6
		]);	
	?>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>