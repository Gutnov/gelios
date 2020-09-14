<div class="products-carousel_small">
	<div class="products-carousel__head">
		<div class="products-carousel__title">Вы смотрели</div>
		<div class="products-carousel__arrows">
			<div class="products-carousel__arrow slider-prev">
				<svg role="img" class="left-normal">
					<use xlink:href="#left-normal"></use>
				</svg>
				<svg role="img" class="left-hover">
					<use xlink:href="#left-hover"></use>
				</svg>
			</div>
			<div class="products-carousel__arrow slider-next">
				<svg role="img" class="right-normal">
					<use xlink:href="#right-normal"></use>
				</svg>
				<svg role="img" class="right-hover">
					<use xlink:href="#right-hover"></use>
				</svg>
			</div>
		</div>
	</div>
	<div class="products-carousel-wr">
		<?php
			foreach ($arResult as $key => $product)
			{
				$detailPicture2x = CFile::ResizeImageGet($product['DETAIL_PICTURE'], ['width' => 450, 'height' => 456]);
				$detailPicture1x = CFile::ResizeImageGet($product['DETAIL_PICTURE'], ['width' => 300, 'height' => 304]);
				?>
				<div class="product-carousel-slide-wr">
					<div class="product-item-small product-item_sale _product-rating" data-rating="<?=$key?>">
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
								onclick="odvaProductsViewedSlider.toggleFavorite(this, event)"
								data-favorite-id="<?=$product['ID']?>"
							>
								<svg role="img" class="ic-favorites-fill product-item__action_fav_enable">
									<use xlink:href="#ic-favorites-fill"></use>
								</svg>
								<svg role="img" class="ic-favorites-red product-item__action_fav_disable">
									<use xlink:href="#ic-favorites-red"></use>
								</svg>
								<div class="heart g-dnone"></div>
							</a>
						</div>
						<a href="<?=$product['DETAIL_PAGE_URL']?>" class="product-item-small__img">
							<picture>
								<source data-srcset="<?=$detailPicture1x['src']?>, <?=$detailPicture2x['src']?> 2x">
								<img data-src="<?=$detailPicture1x['src']?>" alt="" class="lazy-image">
							</picture>
						</a>
						<div class="product-item-small__info">
							<div class="product-item-small__title"><?=$product['NAME']?></div>
							<div class="product-item-small__prices">
								<?php
									if(!empty($product['PRICE']['DISCOUNT']))
									{
										?>
										<span class="product-item__current-price product-item-small__current-price"><?=$product['PRICE']['DISCOUNT']['PRICE']?> ₽</span>
										<span class="product-item__old-price product-item-small__old-price"><?=$product['PRICE']['VALUE']?> ₽</span>
										<?php
									}
									else
									{
										?>
										<span class="product-item-small__current-price"><?=$product['PRICE']['VALUE']?> ₽</span>
										<?
									}
								?>
							</div>
						</div>
					</div>
				</div>
				<?
			}
		?>
	</div>
</div>