<div class="detail-news">
	<div class="detail-news__wrapper">
		<h2 class="detail-news__title">Новости</h2>
		<?php
			foreach ($arResult['ITEMS'] as $news)
			{
				$detailPicture2x = CFile::ResizeImageGet($news['DETAIL_PICTURE'], ['width' => 640, 'height' => 472]);
				$detailPicture1x = CFile::ResizeImageGet($news['DETAIL_PICTURE'], ['width' => 320, 'height' => 236]);
				?>
				<a class="detail-news__item" href="<?=$news['DETAIL_PAGE_URL']?>">
					<div class="detail-news__image">
						<picture>
							<source data-srcset="<?=$detailPicture1x['src']?>, <?=$detailPicture2x['src']?>">
							<img class="lazy-image" alt="A lazy image" data-src="<?=$detailPicture1x['src']?>">
						</picture>
					</div>
					<div class="detail-news__right">
						<div class="detail-news__data">
							<svg role="img" class="ic-time-news">
								<use xlink:href="#ic-time-news"></use>
							</svg>
							<span><?php echo "{$news['DATE_CREATE']['DD']} {$news['DATE_CREATE']['MM']} {$news['DATE_CREATE']['YYYY']}"; ?></span>
						</div>
						<div class="detail-news__text"><?=$news['NAME']?></div>
					</div>
				</a>
				<?php
			}
		?>
	</div>
</div>