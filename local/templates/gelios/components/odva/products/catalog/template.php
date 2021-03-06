<div class="catalog__right-products catalog__right-products--show">
	<?php
	foreach ($arResult['PRODUCTS'] as $product)
	{
		$detailPicture2x = CFile::ResizeImageGet($product['DETAIL_PICTURE'], ['width' => 470, 'height' => 400]);
		$detailPicture1x = CFile::ResizeImageGet($product['DETAIL_PICTURE'], ['width' => 235, 'height' => 200]);
		?>
		<div class="product-item _product-rating<?=$product['PRICE']['DISCOUNT'] ? ' product-item_sale' : ''?>">
			<div class="product-item__actions">
				<?php
				if(empty($product['CATALOG_QUANTITY']))
				{
					?>
					<div class="product-item__action product-item__action_stick product-item__action_stick_stock">
						Нет в наличии
					</div>
					<?
				}
				else if(!empty($product['PRICE']['DISCOUNT']))
				{
					?>
					<div class="product-item__action product-item__action_stick product-item__action_stick_sale">
						Экономия <?=$product['PRICE']['DISCOUNT']['PERCENT']?>%
					</div>
					<?php
				}
				?>
				<a
					href="#"
					class="product-item__action product-item__action_fav<?=$product['IS_FAVORITE'] ? ' product-item__action_fav_added' : ''?>"
					onclick="odvaCatalogProducts.toggleFavorite(this, event, <?=$product['ID']?>)"
					data-favorite-id="<?=$product['ID']?>"
				>
					<svg role="img" class="ic-favorites-fill product-item__action_fav_enable">
						<use xlink:href="#ic-favorites-fill"></use>
					</svg>
					<svg role="img" class="ic-favorites-red product-item__action_fav_disable">
						<use xlink:href="#ic-favorites-red"></use>
					</svg>
					<div class="heart"></div>
				</a>
			</div>
			<a href="<?=$product['DETAIL_PAGE_URL']?>" class="product-item__img">
				<picture>
					<source data-srcset="<?=$detailPicture1x['src']?>, <?=$detailPicture2x['src']?> 2x">
					<img data-src="<?=$detailPicture1x['src']?>" alt="" class="lazy-image">
				</picture>
			</a>
			<div class="product-item__info">
				<div class="product-item__title"><?=$product['NAME']?></div>
				<div class="product-item-small__prices">
					<?php
					if($product['PRICE']['DISCOUNT'])
					{
						?>
						<span class="product-item__current-price"><?=$product['PRICE']['DISCOUNT']['PRICE']?> ₽</span>
						<span class="product-item__old-price product-item-small__old-price"><?=$product['PRICE']['VALUE']?> ₽</span>
						<?php
					}
					else
					{
						?>
						<span class="product-item__current-price"><?=$product['PRICE']['VALUE']?> ₽</span>
						<?php
					}
					?>
				</div>
				<div class="product-item__control">
					<?php
						if(empty($product['CATALOG_QUANTITY']))
						{
							?>
							<a
								href="<?=$product['DETAIL_PAGE_URL']?>"
								class="button product-item__button"
							>
							Перейти
							</a>
							<?php
						}
						else
						{
							?>
							<a
								href="#"
								class="button product-item__button <?=($product['HAS_BASKET'])?'product-item__button-in-cart':''?>"
								onclick="odvaCatalogProducts.addToBasket(this, event, <?=$product['ID']?>)"
								data-to-cart-button="<?=$product['ID']?>"
							>
							<?=($product['HAS_BASKET'])?'В корзине':'В корзину'?>
							</a>
							<?
						}
					?>
				</div>
			</div>
		</div>
		<?php
	}

	if(!empty($arResult['PRODUCTS']))
	{
		?>
			
		<?php
	}
	else
	{
		?>Ничего не найдено<?php
	}
	?>
</div>