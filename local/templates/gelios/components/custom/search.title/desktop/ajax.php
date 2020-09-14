<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
if(!empty($arResult)):?>
	<div class="search-input__items-wr">
	    <div class="container">
	        <ul class="search-input__items">
			<?php
				foreach ($arResult['ITEMS'] as $key => $item)
				{
					if($key == 6)
						break;
					?>
					<li>
		                <a href="<?=$item['DETAIL_PAGE_URL']?>" class="search-input__item">
		                	<div class="search-input__item-img">
		                    	<img src="<?=CFile::ResizeImageGet($item['DETAIL_PICTURE'], ['width' => 40, 'height' => 40])['src']?>" alt="">
		                    </div>
		                    <span><?=$item['NAME']?></span>
		                </a>
		            </li>
					<?
				}
			?>
			<?php
				if(count($arResult['ITEMS']) > 0)
				{
					?>
					<li class="search-input__all">
		                <a href="<?=$arResult['URL']?>">
		                    Смотреть всё (<?=count($arResult['ITEMS'])?>)
		                </a>
		            </li>
					<?
				}
			?>
			</ul>
	    </div>
	</div>
<?endif;
?>