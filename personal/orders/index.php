<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
	$APPLICATION->SetTitle("Персональный раздел | ".CSite::GetByID("s1")->Fetch()['NAME']);
?>
<div class="container">
	<?php
	$APPLICATION->IncludeComponent("odva:breadcrumbs", "", [
		'LINKS' => [
			['text' => 'Главная', 'url'  => '/'],
			['text' => 'Личный кабинет', 'url'  => '/personal/']
		]
	]);
	?>
	<h2 class="title title--account">Личный кабинет</h2>
	<div class="account__wrapper">
		<?$APPLICATION->IncludeComponent("bitrix:main.include","",[
			"AREA_FILE_SHOW"   => "sect",
			"AREA_FILE_SUFFIX" => "menu",
			"EDIT_TEMPLATE"    => "",
			"ACTIVE_PAGE"      => "orders"
		]);?>
		<div class="account__right">
			<?php
			global $USER;
			$APPLICATION->IncludeComponent("odva:orders", "", [
				'filter'=>[
					'USER_ID' => $USER->GetID()
				]
			]);
			?>
		</div>
	</div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>