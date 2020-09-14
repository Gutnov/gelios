<div class="catalog__left catalog__left--category">
	<ul class="catalog-section-menu__list">
		<li class="sidebar-menu__title catalog-section-menu__title">
			<?=$arParams['NAME']?>
			<div class="sidebar-menu__close" onclick="o2.popups.mainCatalogMenuHide()">
				<svg role="img" class="close-mobile">
					<use xlink:href="#close-mobile"></use>
				</svg>
			</div>
			<div class="devider devider_main-catalog"></div>
		</li>
		<?php
			foreach ($arResult['SECTIONS'] as $section)
			{
				?>
				<li class="catalog-section-menu__item">
					<a href="<?=$section['SECTION_PAGE_URL']?>"><?=$section['NAME']?></a>
				</li>
				<?php
			}
		?>
	</ul>
</div>