<div class="catalog-filter">
	<div class="sidebar-menu__title">
		Сортировка и фильтры
		<div class="sidebar-menu__close" onclick="o2.popups.mainCatalogMenuHide()">
			<svg role="img" class="close-mobile">
				<use xlink:href="#close-mobile"></use>
			</svg>
		</div>
		<div class="devider devider_main-catalog"></div>
	</div>
	<div class="catalog-filter__block">
		<div class="catalog-filter__block-title" onclick="o2.popups.filterBlockClose(this)">
			Сортировать
			<svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 17 17">
				<path fill="#01A54E" fill-rule="evenodd" d="M3.542 10.673c0 .372.29.66.66.66a.673.673 0 00.48-.2l3.824-3.885 3.812 3.886c.129.127.302.2.48.2.37 0 .66-.29.66-.661a.625.625 0 00-.19-.455L9.02 5.9a.693.693 0 00-1.034-.006l-4.254 4.318a.648.648 0 00-.19.46z" />
			</svg>
		</div>
		<div class="catalog-filter__block-inputs">
			<?php
			$priceIsDownSort = ($arParams['SORT'][$arParams['FIELDS_MAP']['price']] == 'DESC' ? ' catalog-filter__sort-price--down' : '');
			?>
			<div
				class="catalog-filter__sort-price<?=$priceIsDownSort?>"
				onclick="smartFilter.changePriceSorter(this)"
			>
				<div>
					<svg role="img" class="ic-sort-down">
						<use xlink:href="#ic-sort-down"></use>
					</svg>
					<svg role="img" class="ic-sort-up">
						<use xlink:href="#ic-sort-up"></use>
					</svg>
				</div>
				<span>Цена</span>
			</div>
			<label class="g-checkbox catalog-filter__input-line">
				<input
					type="checkbox"
					class="g-checkbox__input"
					onclick="smartFilter.changeSortersCheckbox(this)"
					name="in_store"
					<?=(array_key_exists($arParams['FIELDS_MAP']['in_store'], $arParams['SORT'])) ? 'checked' : ''?>
				>
				<div class="g-checkbox__body">
					<span class="g-checkbox__box"></span>
					<span class="g-checkbox__text">В наличии</span>
				</div>
			</label>
			<label class="g-checkbox catalog-filter__input-line">
				<input
					type="checkbox"
					class="g-checkbox__input"
					onclick="smartFilter.changeSortersCheckbox(this)"
					name="is_new"
					<?=(array_key_exists($arParams['FIELDS_MAP']['is_new'], $arParams['SORT'])) ? 'checked' : ''?>
				>
				<div class="g-checkbox__body">
					<span class="g-checkbox__box"></span>
					<span class="g-checkbox__text">Новинки</span>
				</div>
			</label>
			<label class="g-checkbox catalog-filter__input-line">
				<input
					type="checkbox"
					class="g-checkbox__input"
					onclick="smartFilter.changeSortersCheckbox(this)"
					name="popular"
					<?=(array_key_exists($arParams['FIELDS_MAP']['popular'], $arParams['SORT'])) ? 'checked' : ''?>
				>
				<div class="g-checkbox__body">
					<span class="g-checkbox__box"></span>
					<span class="g-checkbox__text">Популярные</span>
				</div>
			</label>
			<label class="g-checkbox catalog-filter__input-line">
				<input
					type="checkbox"
					class="g-checkbox__input"
					onclick="smartFilter.changeSortersCheckbox(this)"
					name="discount"
					<?=(array_key_exists($arParams['FIELDS_MAP']['discount'], $arParams['SORT'])) ? 'checked' : ''?>
				>
				<div class="g-checkbox__body">
					<span class="g-checkbox__box"></span>
					<span class="g-checkbox__text">Скидки и акции</span>
				</div>
			</label>
		</div>
	</div>
	<?php
	$priceField = $arResult['ITEMS']['price'];
	$priceFieldValues = $priceField->getValues();

	if(
		!empty($priceFieldValues['MIN'])
		&&
		!empty($priceFieldValues['MAX'])
	)
	{
		?>
		<div class="catalog-filter__block">
			<div class="catalog-filter__block-title" onclick="o2.popups.filterBlockClose(this)">
				<?=$priceField->name?>
				<svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 17 17">
					<path fill="#01A54E" fill-rule="evenodd" d="M3.542 10.673c0 .372.29.66.66.66a.673.673 0 00.48-.2l3.824-3.885 3.812 3.886c.129.127.302.2.48.2.37 0 .66-.29.66-.661a.625.625 0 00-.19-.455L9.02 5.9a.693.693 0 00-1.034-.006l-4.254 4.318a.648.648 0 00-.19.46z" />
				</svg>
			</div>
			<div class="catalog-filter__block-inputs">
				<div class="price-slider">
					<div class="price-slider-wr">
						<div class="price-slider-labels">
							<div class="price-slider-labels__item">
								<span class="price-slider-labels_from"><?=$priceFieldValues['FROM']?></span>
								₽
							</div>
							<div class="price-slider-labels__item">
								<span class="price-slider-labels_to"><?=$priceFieldValues['TO']?></span>
								₽
							</div>
						</div>
						<div
							class="price-range"
							data-field-name="price"
							data-field-min-name="price-min"
							data-field-max-name="price-max"
							data-type="range"
							data-min="<?=$priceFieldValues['MIN']?>"
							data-max="<?=$priceFieldValues['MAX']?>"
							data-from="<?=$priceFieldValues['FROM']?>"
							data-to="<?=$priceFieldValues['TO']?>"
						></div>
						<input type="hidden" value="<?=$priceFieldValues['MIN']?>" class="price-input" name="price-min" onchange="smartFilter.changeFilterPrice(this)">
						<input type="hidden" value="<?=$priceFieldValues['MAX']?>" class="price-input" name="price-max" onchange="smartFilter.changeFilterPrice(this)">
					</div>
				</div>

			</div>
		</div>
		<?php
	}

	foreach ($arResult['ITEMS'] as $filterCode => $item)
	{
		if(in_array($filterCode, ['price']) || empty($item->getValues()))
			continue;
		?>
		<div class="catalog-filter__block <?= ($item->getSettings()['DISPLAY_EXPANDED'] != 'Y') ? ' catalog-filter__block--close' : ''?>">
			<div class="catalog-filter__block-title" onclick="o2.popups.filterBlockClose(this)">
				<?=$item->name?>
				<svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 17 17">
					<path fill="#01A54E" fill-rule="evenodd" d="M3.542 10.673c0 .372.29.66.66.66a.673.673 0 00.48-.2l3.824-3.885 3.812 3.886c.129.127.302.2.48.2.37 0 .66-.29.66-.661a.625.625 0 00-.19-.455L9.02 5.9a.693.693 0 00-1.034-.006l-4.254 4.318a.648.648 0 00-.19.46z" />
				</svg>
			</div>
			<div class="catalog-filter__block-inputs">
				<?php
				foreach ($item->getValues() as $facetId => $value)
				{
					if(empty($value['FILTER_VALUE']) || empty($value['DISPLAY_VALUE']))
						continue;

					switch ($item->getSettings()['DISPLAY_TYPE'])
					{
						case 'F':
							?>
							<label class="g-checkbox catalog-filter__input-line">
								<input
									type="checkbox"
									class="g-checkbox__input"
									name="filter[PROPERTY_<?=$item->code?>][]"
									value="<?=$value['FILTER_VALUE']?>"
									<?= $value['CHECKED'] ? 'checked' : '' ?>
									onclick="smartFilter.changeFilterCheckbox(this, 'PROPERTY_<?=$item->code?>')"
								>
								<div class="g-checkbox__body">
									<span class="g-checkbox__box"></span>
									<span class="g-checkbox__text"><?=$value['DISPLAY_VALUE']?></span>
								</div>
							</label>
							<?php
							break;

						case 'K':
							?>
							<label class="g-radio catalog-filter__input-line">
								<input
									type="radio"
									class="g-radio__input"
									name="filter[PROPERTY_<?=$item->code?>]"
									value="<?=$value['FILTER_VALUE']?>"
									<?= $value['CHECKED'] ? 'checked' : '' ?>
									onclick="smartFilter.changeFilterRadio(this, 'PROPERTY_<?=$item->code?>')"
								>
								<div class="g-radio__body">
									<span class="g-radio__box"></span>
									<span class="g-radio__text"><?=$value['DISPLAY_VALUE']?></span>
								</div>
							</label>
							<?php
							break;
						default:
							break;
					}
				}

				if(count($item->getValues()) > 6)
				{
					?>
					<div class="sidebar-menu__buttons">
						<div class="sidebar-menu__show sidebar-menu--btn-active" onclick="o2.popups.sidebarMenuShowOther(this)">Смотреть всё
							<svg role="img" class="ic-down-arrow">
								<use xlink:href="#ic-down-arrow"></use>
							</svg>
						</div>
						<div class="sidebar-menu__hide" onclick="o2.popups.sidebarMenuHideOther(this)">Скрыть
							<svg role="img" class="ic-up-arrow">
								<use xlink:href="#ic-up-arrow"></use>
							</svg>
						</div>
					</div>
					<?php
				}
				?>
			</div>
		</div>
		<?php
	}
	?>
</div>