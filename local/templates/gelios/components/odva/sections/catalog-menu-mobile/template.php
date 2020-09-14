<div class="catalog-mobmenu">
	<div class="catalog-mobmenu__title">
		<svg onclick="o2.popups.returnMenu(this)" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
			<path fill="#263238" fill-rule="evenodd" d="M15.068 19c.525 0 .932-.41.932-.931a.952.952 0 0 0-.282-.679l-5.485-5.398 5.485-5.382A.966.966 0 0 0 16 5.93.921.921 0 0 0 15.068 5c-.251 0-.47.095-.643.268L8.33 11.266A.983.983 0 0 0 8 12c0 .276.11.513.321.726l6.096 6.006c.18.173.4.268.65.268z" />
		</svg>
		<span>Каталог товаров</span>
		<svg role="img" class="close-mobile" onclick="o2.popups.mobileMenuHide()">
			<use xlink:href="#close-mobile"></use>
		</svg>
	</div>
	<ul class="catalog-mobmenu__list">
		<?php
			foreach ($arResult['SECTIONS'] as $section)
			{
				?>
				<li class="catalog-mobmenu__item"
					id="<?=$section['ID']?>"
					<?=(!empty($section['SECTIONS']))?'onclick="o2.popups.openCatalogLinks(this)"': ''?>
				>
				<?php
					if(!empty($section['SECTIONS']))
					{
						?>
						<span >
							<?=$section['NAME']?>
						</span>
						<?php
					}

					else
					{
						?>
						<a href="<?=$section['URL']?>">
							<?=$section['NAME']?>
						</a>
						<?php
					}
				?>
				<svg role="img" class="ic-right-arrow">
					<use xlink:href="#ic-right-arrow"></use>
				</svg>
				</li>
				<?php
			}
		?>
	</ul>
</div>
<?php
	foreach ($arResult['SECTIONS'] as $section)
	{
		if(!empty($section['SECTIONS']))
		{
			?>
			<div class="catalog-mobmenu_second-lvl" data-id="<?=$section['ID']?>">
				<div class="catalog-mobmenu__title">
					<svg onclick="o2.popups.returnCatalog(this)" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
						<path fill="#263238" fill-rule="evenodd" d="M15.068 19c.525 0 .932-.41.932-.931a.952.952 0 0 0-.282-.679l-5.485-5.398 5.485-5.382A.966.966 0 0 0 16 5.93.921.921 0 0 0 15.068 5c-.251 0-.47.095-.643.268L8.33 11.266A.983.983 0 0 0 8 12c0 .276.11.513.321.726l6.096 6.006c.18.173.4.268.65.268z" />
					</svg>
					<span>Лекарственные средства</span>
					<svg role="img" class="close-mobile" onclick="o2.popups.mobileMenuHide()">
						<use xlink:href="#close-mobile"></use>
					</svg>
				</div>
				<ul class="catalog-mobmenu__list">
					<?php
						foreach ($section['SECTIONS'] as $sectionSecondLvl)
						{
							?>
							<li class="catalog-mobmenu__item">
								<a href="<?=$section['URL']?>"><?=$sectionSecondLvl['NAME']?></a>
							</li>
							<?php
						}
					?>
				</ul>
			</div>
		<?php
		}
	}
?>