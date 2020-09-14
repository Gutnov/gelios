<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);?>
<?
$INPUT_ID = trim($arParams["~INPUT_ID"]);
if(strlen($INPUT_ID) <= 0)
	$INPUT_ID = "title-search-input";
$INPUT_ID = CUtil::JSEscape($INPUT_ID);

$CONTAINER_ID = trim($arParams["~CONTAINER_ID"]);
if(strlen($CONTAINER_ID) <= 0)
	$CONTAINER_ID = "title-search";
$CONTAINER_ID = CUtil::JSEscape($CONTAINER_ID);

if($arParams["SHOW_INPUT"] !== "N"):?>
	<div class="search-input__block">
		<div class="search-input__wrapper" id="<?echo $CONTAINER_ID?>">
			<form action="<?echo $arParams["FORM_ACTION"]?>">
				<input type="text" id="<?echo $INPUT_ID?>" name="q" value="" autocomplete="off" class="search-input" placeholder="Поиск по названию или симптомам">
				<div class="search-input__icons" onclick="o2.popups.clearInput()">
					<svg role="img" class="ic-close-input">
						<use xlink:href="#ic-close-input"></use>
					</svg>
					<svg role="img" class="ic-search">
						<use xlink:href="#ic-search"></use>
					</svg>
				</div>
			</form>
		</div>
	</div>
<?endif?>
<script>
	BX.ready(function(){
		new JCTitleSearch({
			'AJAX_PAGE' : '<?echo CUtil::JSEscape(POST_FORM_ACTION_URI)?>',
			'CONTAINER_ID': '<?echo $CONTAINER_ID?>',
			'INPUT_ID': '<?echo $INPUT_ID?>',
			'MIN_QUERY_LEN': 1
		});
	});
</script>
