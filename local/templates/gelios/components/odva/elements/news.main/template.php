<div class="simple-slider__wrapper">
	<div class="simple-slider__top simple-slider__top_news">
		<h2 class="simple-slider__title simple-slider__title_news">
			<span>Новости</span>
		</h2>
		<div class="simple-slider__arrows simple-slider__arrows_news">
			<div class="simple-slider__prev slider-prev">
				<svg role="img" class="left-normal">
					<use xlink:href="#left-normal"></use>
				</svg>
				<svg role="img" class="left-hover">
					<use xlink:href="#left-hover"></use>
				</svg>
			</div>
			<div class="simple-slider__next slider-next">
				<svg role="img" class="right-normal">
					<use xlink:href="#right-normal"></use>
				</svg>
				<svg role="img" class="right-hover">
					<use xlink:href="#right-hover"></use>
				</svg>
			</div>
		</div>
	</div>
	<div class="simple-slider_news">
		<?php
			foreach ($arResult['ITEMS'] as $news)
			{
				$detailPicture2x = CFile::ResizeImageGet($news['DETAIL_PICTURE'], ['width' => 640, 'height' => 472]);
				$detailPicture1x = CFile::ResizeImageGet($news['DETAIL_PICTURE'], ['width' => 320, 'height' => 236]);
				?>
				<a class="simple-slider__item-wr simple-slider_mobile simple-slider__item-wr_news" href="<?=$news['DETAIL_PAGE_URL']?>">
					<div class="simple-slider__item">
						<picture>
							<source data-srcset="<?=$detailPicture1x['src']?>, <?=$detailPicture2x['src']?> 2x">
							<img class="lazy-image" alt="" data-src="<?=$detailPicture1x['src']?>">
						</picture>
						<div class="news-slider__content">
							<div class="news-slider__data">
								<svg role="img" class="ic-time">
									<use xlink:href="#ic-time"></use>
								</svg>
								<?php echo "{$news['DATE_CREATE']['DD']} {$news['DATE_CREATE']['MM']} {$news['DATE_CREATE']['YYYY']}"; ?>
							</div>
							<div class="news-slider__text">
								<?=$news['NAME']?>
							</div>
						</div>
					</div>
				</a>
				<?
			};
		?>
	</div>
</div>