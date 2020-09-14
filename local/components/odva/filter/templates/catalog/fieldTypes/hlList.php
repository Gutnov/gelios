<div class="catalog__left-filter">
	<div class="filter__title"><?= $field['SETTINGS']['heading'] ?></div>
	<div class="filter__block _filterField"
		data-fieldtype="list"
		data-fieldname="<?= $field['SETTINGS']['propName'] ?>"
	>
		<?php
		foreach ($field['VALUES'] as $fieldItem)
		{
			?>
			<label class="checkbox-label filter-checkbox-label">
				<input type="checkbox" class="checkbox" value="<?= $fieldItem['UF_XML_ID'] ?>" <?= !empty($fieldItem['SELECTED'])?'checked':'' ?>>
				<span></span>
				<?= $fieldItem['UF_NAME'] ?>
			</label>
			<?php
		}
		?>
	</div>
</div>