<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use Bitrix\Main\Page\Asset;

Asset::getInstance()->addCss('/front/css/style.css');
Asset::getInstance()->addJs('/front/js/main.min.js');

?><!DOCTYPE html>
<html>
	<!--[if IE 6]>		<html id="section-reco_main" class="nojs ie6 ieb7 ieb8 ieb9 ieb10 split1 nosplit5 platform-PC platform-notouch"><![endif]-->
	<!--[if IE 7]>		<html id="section-reco_main" class="nojs iea6 ie7 ieb8 ieb9 ieb10 split1 nosplit5 platform-PC platform-notouch"><![endif]-->
	<!--[if IE 8]>		<html id="section-reco_main" class="nojs iea6 iea7 ie8 ieb9 ieb10 split1 nosplit5 platform-PC platform-notouch"><![endif]-->
	<!--[if IE 9]>		<html id="section-reco_main" class="nojs iea6 iea7 iea8 ie9 ieb10 split1 nosplit5 platform-PC platform-notouch"><![endif]-->
	<meta name="viewport" content="width=device-width">
	<meta name="MobileOptimized" content="320"/>
	<meta name="HandheldFriendly" content="true"/>
	<meta name="viewport min-width=320px" content="min-width=320, initial-scale=1.0" />
	<!--[if lt IE 9]>
		<script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/r29/html5.min.js" data-skip-moving="true"></script>
	<![endif]-->
	<title><?php $APPLICATION->ShowTitle(); ?></title>
	<?php $APPLICATION->ShowHead(); ?>
</head>
<body>
<?php $APPLICATION->ShowPanel()?>
<header class="header">
	<div class="promo-top">
		<div class="container">
			<div class="promo-top__wrapper">
				<span class="promo-top__text">
					Скидки до -90% <br class="promo-top__br"> Для всех влюблённых
				</span>
				<div class="promo-top__close">
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" onclick="o2.spoiler.hide(this,'.promo-top')">
						<path fill="#FFF" fill-rule="evenodd" d="M12 20c4.376 0 8-3.624 8-8 0-4.369-3.631-8-8.008-8C7.624 4 4 7.631 4 12c0 4.376 3.631 8 8 8zm2.808-4.518a.663.663 0 0 1-.47-.196l-2.346-2.353-2.337 2.353a.632.632 0 0 1-.47.196.664.664 0 0 1-.66-.666c0-.18.071-.338.197-.455l2.345-2.353-2.345-2.353a.598.598 0 0 1-.197-.455c0-.36.299-.651.66-.651.188 0 .337.07.454.196l2.353 2.345 2.369-2.353a.598.598 0 0 1 .455-.204c.368 0 .659.298.659.66 0 .18-.055.329-.197.454l-2.353 2.36 2.346 2.338a.645.645 0 0 1 .196.47.66.66 0 0 1-.66.667z" opacity=".6" />
					</svg>
				</div>
			</div>
		</div>
	</div>
	<div class="header__mobile">
		<div class="container">
			<div class="header__mobile-wrapper">
				<div class="header__mobile-left">
					<svg role="img" class="ic-menu header__mobile-hamburger" onclick="o2.popups.mobileMenuShow()">
						<use xlink:href="#ic-menu"></use>
					</svg>
					<svg role="img" class="search-mobile header__mobile-search" onclick="o2.popups.searchInputShow()">
						<use xlink:href="#search-mobile"></use>
					</svg>
					<svg role="img" class="ic-search-active" onclick="o2.popups.searchInputHide()">
						<use xlink:href="#ic-search-active"></use>
					</svg>
				</div>
				<a href="/" class="header__mobile-logo">
					<svg role="img" class="logo-gelios-mark">
						<use xlink:href="#logo-gelios-mark"></use>
					</svg>
					<svg role="img" class="logo-gelios-horizontal">
						<use xlink:href="#logo-gelios-horizontal"></use>
					</svg>
				</a>
				<div class="header__mobile-right">
					<?php $APPLICATION->IncludeComponent('odva:favorites', '', ['MOBILE' => 'Y']); ?>
					<?php $APPLICATION->IncludeComponent('odva:cart', 'mobile', []); ?>
				</div>
				<?$APPLICATION->IncludeComponent("custom:search.title","desktop",Array(
						"FORM_ACTION"=>"/search/",
						"SHOW_INPUT" => "Y",
						"INPUT_ID" => "title-search-input-mobile",
						"CONTAINER_ID" => "title-search-mobile",
						"PRICE_CODE" => array("BASE","RETAIL"),
						"PRICE_VAT_INCLUDE" => "Y",
						"PREVIEW_TRUNCATE_LEN" => "150",
						"SHOW_PREVIEW" => "Y",
						"PREVIEW_WIDTH" => "75",
						"PREVIEW_HEIGHT" => "75",
						"CONVERT_CURRENCY" => "Y",
						"CURRENCY_ID" => "RUB",
						"PAGE" => "#SITE_DIR#search/index.php",
						"NUM_CATEGORIES" => "3",
						"TOP_COUNT" => "10",
						"ORDER" => "date",
						"USE_LANGUAGE_GUESS" => "Y",
						"CHECK_DATES" => "Y",
						"SHOW_OTHERS" => "Y",
						"CATEGORY_0_TITLE" => "контент",
						"CATEGORY_0" => array("iblock")
					)
				);?>
			</div>
		</div>
	</div>
	<div class="header__wrapper">
		<div class="top-info">
			<div class="devider devider_top-info"></div>
			<div class="container">
				<?php $APPLICATION->IncludeComponent("odva:authLine","auth.line.mobile",[]);?>
				<ul class="top-info__list">
					<li class="top-info__item top-info__catalog" onclick="o2.popups.openMobCatalog()">
						<div class="top-info__item-wrapper">
							<div class="top-info__icon">
								<svg role="img" class="ic-catalog">
									<use xlink:href="#ic-catalog"></use>
								</svg>
							</div>
							<span class="top-info__text">Каталог товаров</span>
						</div>
						<svg role="img" class="ic-right-arrow">
							<use xlink:href="#ic-right-arrow"></use>
						</svg>
					</li>
					<li class="devider__wrapper">
						<div class="devider"></div>
					</li>
					<li>
						<a href="/page/contacts/" class="top-info__item">
							<div class="top-info__icon">
								<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
									<path fill-rule="evenodd" d="M9.992 1.667c3.679 0 6.675 2.917 6.675 6.496 0 1.32-.41 2.596-1.185 3.706l-.07.097a.562.562 0 0 1-.028.033l-.026.026-4.569 5.924a1.01 1.01 0 0 1-.797.384c-.264 0-.506-.1-.7-.273l-.117-.117-4.53-5.913a.435.435 0 0 1-.074-.092l-.025-.045-.147-.213a6.374 6.374 0 0 1-1.043-2.997l-.017-.267-.006-.27c0-3.572 2.99-6.48 6.659-6.48zm0 1.382c-2.895 0-5.259 2.292-5.259 5.114 0 1.042.334 2.06.94 2.913l.016.017.038.056 4.265 5.553 4.305-5.598.007-.016a5.088 5.088 0 0 0 .94-2.686l.006-.24c0-2.816-2.36-5.113-5.258-5.113zm.833 2.268v1.837h1.867V8.78h-1.867v1.822H9.158V8.78H7.275V7.154h1.883V5.317h1.667z" />
								</svg>
							</div>
							<span class="top-info__text">Адреса аптек 24/7</span>
						</a>
					</li>
					<li>
						<a href="/page/stocks/" class="top-info__item">
							<div class="top-info__icon">
								<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
									<path fill-rule="evenodd" d="M9.617 1.824a.545.545 0 0 1 .766 0l1.429 1.415 1.944-.511a.545.545 0 0 1 .664.383l.53 1.94 1.939.53a.543.543 0 0 1 .383.663l-.51 1.944 1.414 1.429c.21.212.21.554 0 .766l-1.415 1.429.511 1.944a.545.545 0 0 1-.383.664l-1.94.53-.53 1.939a.545.545 0 0 1-.663.383l-1.944-.51-1.429 1.414a.543.543 0 0 1-.766 0L8.188 16.76l-1.944.511a.545.545 0 0 1-.664-.383l-.53-1.94-1.939-.53a.545.545 0 0 1-.383-.663l.51-1.944-1.414-1.429a.545.545 0 0 1 0-.766L3.24 8.188l-.511-1.944a.545.545 0 0 1 .383-.664l1.94-.53.53-1.939a.545.545 0 0 1 .663-.383l1.944.51zM10 2.98L8.734 4.232a.545.545 0 0 1-.522.14L6.49 3.919l-.47 1.719a.545.545 0 0 1-.381.382l-1.719.47.453 1.722a.545.545 0 0 1-.14.522L2.98 10l1.253 1.266a.545.545 0 0 1 .14.522l-.453 1.723 1.719.47c.186.05.331.195.382.381l.47 1.719 1.722-.453a.545.545 0 0 1 .522.14L10 17.02l1.266-1.253a.545.545 0 0 1 .522-.14l1.723.453.47-1.719a.545.545 0 0 1 .381-.382l1.719-.47-.453-1.722a.545.545 0 0 1 .14-.522L17.02 10l-1.253-1.266a.545.545 0 0 1-.14-.522l.453-1.723-1.719-.47a.545.545 0 0 1-.382-.381l-.47-1.719-1.722.453a.545.545 0 0 1-.522-.14L10 2.979zm2.18 7.384c1.002 0 1.816.815 1.816 1.817a1.819 1.819 0 0 1-1.816 1.816 1.819 1.819 0 0 1-1.817-1.816c0-1.002.815-1.817 1.817-1.817zm-.022-3.292a.545.545 0 1 1 .77.771L7.842 12.93a.543.543 0 0 1-.77 0 .545.545 0 0 1 0-.771zm.022 4.382a.727.727 0 1 0 .002 1.455.727.727 0 0 0-.002-1.455zm-4.36-5.45c1.002 0 1.817.815 1.817 1.817A1.819 1.819 0 0 1 7.82 9.637 1.819 1.819 0 0 1 6.004 7.82c0-1.002.814-1.816 1.816-1.816zm0 1.09a.727.727 0 1 0 .002 1.455.727.727 0 0 0-.002-1.455z" />
								</svg>
							</div>
							<span class="top-info__text">Акции</span>
						</a>
					</li>
					<li>
						<a href="/news/" class="top-info__item">
							<div class="top-info__icon">
								<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
									<path fill-rule="evenodd" d="M12.962 3.75c.808 0 1.465.647 1.465 1.442v8.654c0 .795-.657 1.442-1.465 1.442a1.46 1.46 0 0 1-1.448-1.227l-.446-.438c-.775-.763-1.917-1.22-3.054-1.22h-.488v2.405c0 .795-.657 1.442-1.465 1.442a1.455 1.455 0 0 1-1.465-1.442V12.32a1.46 1.46 0 0 1-.892-.879H3.62c-1.077 0-1.953-.862-1.953-1.923 0-1.06.876-1.923 1.953-1.923h.084c.201-.56.744-.961 1.38-.961h2.93c1.137 0 2.28-.456 3.054-1.22l.446-.438a1.46 1.46 0 0 1 1.448-1.227zM6.55 12.404h-.976v2.404c0 .265.219.48.488.48.27 0 .488-.215.488-.48v-2.404zm6.413-7.692a.485.485 0 0 0-.488.48v8.654c0 .265.219.48.488.48l.088-.007c.227-.04.4-.237.4-.473V5.192a.485.485 0 0 0-.488-.48zm2.585 6.871c.19-.188.5-.188.69 0l.977.962c.19.187.19.492 0 .68a.494.494 0 0 1-.69 0l-.977-.962a.475.475 0 0 1 0-.68zm-4.05-5.248A5.38 5.38 0 0 1 8.5 7.575v3.89a5.38 5.38 0 0 1 2.998 1.238zM7.526 7.596H5.085a.485.485 0 0 0-.489.48v2.886c0 .265.22.48.489.48h2.441V7.596zm10.32 1.923c.269 0 .487.215.487.481s-.218.48-.488.48H16.38a.485.485 0 0 1-.488-.48c0-.266.219-.48.488-.48zM3.62 8.558a.97.97 0 0 0-.977.961c0 .53.438.962.977.962zm12.903-1.783c.19-.187.5-.187.69 0a.475.475 0 0 1 0 .68l-.976.962a.494.494 0 0 1-.69 0 .476.476 0 0 1 0-.68z" />
								</svg>
							</div>
							<span class="top-info__text">Новости</span>
						</a>
					</li>
					<li>
						<a href="/page/delivery/" class="top-info__item">
							<div class="top-info__icon">
								<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
									<path fill-rule="evenodd" d="M18.227 9.596l-2.543-3.91a.65.65 0 0 0-.545-.296h-3.163v-1.4a.654.654 0 0 0-.651-.657H2.318a.654.654 0 0 0-.651.657v10.708c0 .363.291.656.65.656h2.066a1.957 1.957 0 0 0 1.841 1.313c.849 0 1.572-.549 1.841-1.313h4.597a1.957 1.957 0 0 0 1.841 1.313c.85 0 1.573-.549 1.842-1.313h1.337c.36 0 .651-.293.651-.656V9.955a.66.66 0 0 0-.106-.36zM6.224 15.354a.654.654 0 0 1-.651-.656c0-.362.292-.656.651-.656.359 0 .651.294.651.656a.654.654 0 0 1-.651.656zm4.45-1.312h-2.61a1.957 1.957 0 0 0-1.841-1.312c-.849 0-1.572.548-1.841 1.312H2.969V4.646h7.704v9.396zm3.83 1.312a.654.654 0 0 1-.652-.656c0-.362.292-.656.651-.656.36 0 .652.294.652.656a.654.654 0 0 1-.652.656zm2.527-1.312h-.686a1.957 1.957 0 0 0-1.842-1.312c-.848 0-1.572.548-1.84 1.312h-.687v-7.34h2.811l2.244 3.45v3.89z" />
								</svg>
							</div>
							<span class="top-info__text">Доставка и самовывоз</span>
						</a>
					</li>
					<li>
						<a href="tel:<?php $APPLICATION->IncludeFile('/inc/phone.php') ?>" class="top-info__item top-info__item_phone">
							<div class="top-info__icon top-info__icon_phone">
								<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
									<path fill-rule="evenodd" d="M14.89 18.333c1.49 0 2.47-.4 3.33-1.371a4.26 4.26 0 0 0 .197-.214c.511-.57.75-1.133.75-1.67 0-.613-.358-1.184-1.117-1.712l-2.48-1.721c-.766-.529-1.66-.588-2.376.119l-.657.656c-.195.196-.366.204-.553.085-.46-.29-1.39-1.099-2.02-1.73C9.3 10.12 8.661 9.387 8.32 8.85c-.111-.196-.103-.358.093-.554l.648-.656c.716-.716.656-1.62.128-2.377l-1.721-2.48c-.529-.758-1.1-1.108-1.713-1.116-.537-.009-1.1.238-1.67.75l-.213.187C2.9 3.474 2.5 4.454 2.5 5.927c0 2.437 1.5 5.402 4.252 8.155 2.735 2.735 5.709 4.251 8.137 4.251zm.008-1.312c-2.173.043-4.96-1.627-7.166-3.826C5.508 10.98 3.762 8.1 3.804 5.927c.017-.937.349-1.747 1.014-2.326.06-.051.102-.094.162-.136.255-.222.528-.341.775-.341s.469.094.63.35L8.04 5.952c.178.264.195.562-.069.826l-.75.75c-.587.588-.545 1.304-.119 1.875.486.656 1.33 1.61 1.986 2.258.647.656 1.678 1.576 2.343 2.07.57.426 1.286.469 1.874-.12l.75-.749c.264-.264.554-.247.827-.077l2.48 1.653c.255.17.349.384.349.64 0 .247-.12.52-.341.775l-.137.162c-.579.664-1.388.988-2.334 1.005z" />
								</svg>
							</div>
							<span class="top-info__text"><?php $APPLICATION->IncludeFile('/inc/phone.php') ?></span>
						</a>
					</li>
					<li>
						<?php $APPLICATION->IncludeComponent("odva:authLine","auth.line",[]);?>
					</li>
				</ul>
				<div class="devider"></div>
			</div>
			<?php
				$APPLICATION->IncludeComponent(
					"odva:sections",
					"catalog-menu-mobile",
					[
						'filter' => [
							'ACTIVE' => 'Y',
							'INCLUDE_SUBSECTIONS' => 'Y',
							'IBLOCK_ID' => 2
						],
						'count' => 1000
					]
				);
			?>
		</div>
		<?php
			$APPLICATION->IncludeComponent(
				"bitrix:menu",
				"top-static",
				[
					"ROOT_MENU_TYPE" => "top-static"
				]
			);
		?>
		<div class="header__bottom">
			<div class="container">
				<div class="header__bottom-wrapper">
					<a class="header__logo" href="/">
						<svg role="img" class="logo-gelios-horizontal header__logo-lg">
							<use xlink:href="#logo-gelios-horizontal"></use>
						</svg>
						<svg role="img" class="logo-gelios-mark header__logo-md">
							<use xlink:href="#logo-gelios-mark"></use>
						</svg>
					</a>
					<div class="header__search-block">
						<div class="button header__button" onclick="o2.popups.openCalalog()">
							<span>Каталог</span>
							<div class="header__btn-icon header__btn-icon_active">
								<svg role="img" class="ic-down">
									<use xlink:href="#ic-down"></use>
								</svg>
							</div>
							<div class="header__btn-icon">
								<svg xmlns="http://www.w3.org/2000/svg" width="21" height="20" viewBox="0 0 21 20">
									<path fill="#FFF" fill-rule="evenodd" d="M4.939 15.582c.325.325.855.338 1.173.02l4.41-4.41 4.284 4.284a.85.85 0 0 0 1.187-.007.843.843 0 0 0 0-1.18l-4.284-4.284 4.417-4.417c.318-.318.305-.848-.02-1.173a.827.827 0 0 0-1.167-.014l-4.417 4.417-4.29-4.29a.843.843 0 0 0-1.18 0 .85.85 0 0 0-.007 1.186l4.29 4.29-4.41 4.41a.827.827 0 0 0 .014 1.168z" />
								</svg>
							</div>
						</div>
						<?$APPLICATION->IncludeComponent("custom:search.title","desktop",Array(
								"FORM_ACTION"=>"/search/",
								"SHOW_INPUT" => "Y",
								"INPUT_ID" => "title-search-input",
								"CONTAINER_ID" => "title-search",
								"PRICE_CODE" => array("BASE","RETAIL"),
								"PRICE_VAT_INCLUDE" => "Y",
								"PREVIEW_TRUNCATE_LEN" => "150",
								"SHOW_PREVIEW" => "Y",
								"PREVIEW_WIDTH" => "75",
								"PREVIEW_HEIGHT" => "75",
								"CONVERT_CURRENCY" => "Y",
								"CURRENCY_ID" => "RUB",
								"PAGE" => "#SITE_DIR#search/index.php",
								"NUM_CATEGORIES" => "3",
								"TOP_COUNT" => "10",
								"ORDER" => "date",
								"USE_LANGUAGE_GUESS" => "Y",
								"CHECK_DATES" => "Y",
								"SHOW_OTHERS" => "Y",
								"CATEGORY_0_TITLE" => "контент",
								"CATEGORY_0" => array("iblock")
							)
						);?>
					</div>
					<?php $APPLICATION->IncludeComponent('odva:favorites', '', []); ?>
					<?php $APPLICATION->IncludeComponent('odva:cart', '', []); ?>
				</div>
			</div>
		</div>
		<?php
			$APPLICATION->IncludeComponent(
				"odva:sections",
				"catalog-menu",
				[
					'filter' => [
						'ACTIVE' => 'Y',
						'INCLUDE_SUBSECTIONS' => 'Y',
						'IBLOCK_ID' => 2
					],
					'count' => 1000
				]
			);
		?>
	</div>
</header>