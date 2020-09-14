<div class="discounts-panel">
	<h2>С большой скидкой</h2>
	<div class="discounts-panel__cards__wr">
		<?php
			$detailPicture2x = CFile::ResizeImageGet($arResult['PRODUCTS'][0]['DETAIL_PICTURE'], ['width' => 720, 'height' => 720]);
			$detailPicture1x = CFile::ResizeImageGet($arResult['PRODUCTS'][0]['DETAIL_PICTURE'], ['width' => 480, 'height' => 480]);
		?>
		<a class="discount-panel__large-card" href="<?=$arResult['PRODUCTS'][0]['DETAIL_PAGE_URL']?>">
			<picture>
				<source data-srcset="<?=$detailPicture1x['src']?> 1x, <?=$detailPicture2x['src']?> 2x" media="(max-width: 740px)">
				<source data-srcset="<?=$detailPicture1x['src']?> 1x, <?=$detailPicture2x['src']?> 2x">
				<img class="lazy-image" data-src="<?=$detailPicture2x['src']?>" alt="<?=$arResult['PRODUCTS'][0]['NAME']?>">
			</picture>
			<div class="discount-panel__name discount-panel__name_mw240">
				<?=$arResult['PRODUCTS'][0]['NAME']?>
			</div>
			<div class="discount-panel__value">
				<?php
				if($arResult['PRODUCTS'][0]['PRICE']['DISCOUNT'])
				{
					?>
					<div class="discount-panel__value-wr discount-panel__newprice">
						<span><?=$arResult['PRODUCTS'][0]['PRICE']['DISCOUNT']['PRICE']?></span>
						<span>₽</span>
					</div>
					<div class="discount-panel__value-wr discount-panel__lastprice">
						<span><?=$arResult['PRODUCTS'][0]['PRICE']['VALUE']?></span>
						<span>₽</span>
					</div>
					<?php
				}
				else
				{
					?>
					<div class="discount-panel__value-wr discount-panel__newprice">
						<span><?=$arResult['PRODUCTS'][0]['PRICE']['VALUE']?></span>
						<span>₽</span>
					</div>
					<?php
				}
				?>
			</div>
			<?php
				if(empty($product['CATALOG_QUANTITY']))
				{
					?>
					<button
						class="g-primary-button discount-panel__btn"
						onclick="window.location.href='<?=$arResult['PRODUCTS'][0]['DETAIL_PAGE_URL']?>'"
						data-to-cart-button="<?=$arResult['PRODUCTS'][0]['ID']?>"
					>
					Перейти
					</button>
					<?php
				}
				else
				{
					?>
					<button
						class="g-primary-button discount-panel__btn <?=($arResult['PRODUCTS'][0]['HAS_BASKET'])?'product-item__button-in-cart':''?>"
						onclick="discountProducts.addToBasket(this, event, <?=$arResult['PRODUCTS'][0]['ID']?>)"
						data-to-cart-button="<?=$arResult['PRODUCTS'][0]['ID']?>"
					>
					<?=($arResult['PRODUCTS'][0]['HAS_BASKET'])?'В корзине':'В корзину'?>
					</button>
					<?
				}
			?>
			<div class="discount-panel__sale discount-panel__sale_card">-<?=$arResult['PRODUCTS'][0]['PRICE']['DISCOUNT']['PERCENT']?>%</div>
		</a>
		<div class="discounts-panel__cards">
			<?php
			foreach ($arResult['PRODUCTS'] as $key => $product)
			{
				$detailPicture2x = CFile::ResizeImageGet($product['DETAIL_PICTURE'], ['width' => 402, 'height' => 402]);
				$detailPicture1x = CFile::ResizeImageGet($product['DETAIL_PICTURE'], ['width' => 268, 'height' => 268]);
				if($key == 0)
				{
					continue;
				}
				?>
				<a class="discounts-panel__card <?=($key<3)?'active':''?>" href="<?=$product['DETAIL_PAGE_URL']?>">
					<picture>
						<source data-srcset="<?=$detailPicture1x['src']?> 1x, <?=$detailPicture2x['src']?> 2x" media="(max-width: 740px)">
						<source data-srcset="<?=$detailPicture1x['src']?> 1x, <?=$detailPicture2x['src']?> 2x">
						<img class="lazy-image" data-src="<?=$detailPicture2x['src']?>" alt="">
					</picture>
					<div class="discount-panel__name">
						<?=$product['NAME']?>
					</div>
					<div class="discount-panel__value">
						<?php
						if($product['PRICE']['DISCOUNT'])
						{
							?>
							<div class="discount-panel__value-wr discount-panel__newprice">
								<span><?=$product['PRICE']['DISCOUNT']['PRICE']?></span>
								<span>₽</span>
							</div>
							<div class="discount-panel__value-wr discount-panel__lastprice">
								<span><?=$product['PRICE']['VALUE']?></span>
								<span>₽</span>
							</div>
							<?php
						}
						else
						{
							?>
							<div class="discount-panel__value-wr discount-panel__newprice">
								<span><?=$product['PRICE']['VALUE']?></span>
								<span>₽</span>
							</div>
							<?php
						}
						?>
					</div>
					<div class="discount-panel__sale discount-panel__sale_card">-<?=$product['PRICE']['DISCOUNT']['PERCENT']?>%</div>
				</a>
				<?
			}
			?>
		</div>
	</div>
	<div class="discount-panel__show-more-wr">
		<div class="discount-panel__show-more" onclick="o2Popups.showMoreDiscounts(this)">
			Показать еще
		</div>
	</div>
</div>