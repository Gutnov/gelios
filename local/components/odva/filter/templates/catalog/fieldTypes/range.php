<div class="catalog__left-filter">
	<div class="filter__title">Цена, <div class="svg-rouble svg-rouble-dims rouble-svg"></div></div>
	<div class="filter__pricerange _filterField"
		data-fieldtype="range"
		data-fieldname="price"
	>
		<div class="filter__pricerange-input">
			<input
				name="minprice"
				id="minprice"
				data-filtervalue="<?= $field['VALUES']['current'][0] ?>"
				data-filtermax="<?= $field['VALUES']['maximum'][0] ?>"
				value=""
				class="_fromValue input"
			>
		</div>
		<div class="filter__divider"></div>
		<div class="filter__pricerange-input filter__pricerange-input__right">
			<input
				name="maxprice"
				id="maxprice"
				data-filtervalue="<?= $field['VALUES']['current'][1] ?>"
				data-filtermax="<?= $field['VALUES']['maximum'][1] ?>"
				value=""
				class="_toValue input"
			>
		</div>
	</div>
</div>
<div class="filer__pricerange-slider"></div>