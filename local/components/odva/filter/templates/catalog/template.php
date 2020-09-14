<div>
	<div class="_catalogOverlay _catalogFilter" onclick="o2.popups.closeFilter('.popup');">
		<div class="catalog__left _filterMobile" onclick="event.stopPropagation();">
			<div onclick="o2.popups.closeFilter();" class="popup-close _popupClose">
				<div class="svg-close svg-close-dims svg-close__icon"></div>
			</div>
			<?php
			foreach ($arResult['FIELDS'] as $fieldName => $field)
			{
				$APPLICATION->IncludeFile(
					"{$templateFolder}/fieldTypes/{$field['TYPE']}.php",
					['field' => $field],
					['MODE' => 'php']
				);
			}
			?>
			<div class="filter__butoon-block">
				<button>Показать результаты</button>
				<button>Сбросить</button>
			</div>
		</div>
	</div>
</div>