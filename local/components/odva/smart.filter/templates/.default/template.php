<form>
	<?php
	foreach ($arResult['ITEMS'] as $item)
	{
		?>
		<div>
			<div><strong><?=$item->name?></strong></div>
			<?php
			foreach ($item->getValues() as $facetId => $value)
			{
				?>
				<div style="margin-left: 10px;">
					<label style="cursor: pointer;">
						<input
							type="checkbox"
							name="filter[PROPERTY_<?=$item->code?>][]"
							value="<?=$value['FILTER_VALUE']?>"
							<?= $value['CHECKED'] ? 'checked' : '' ?>
						>
						(<?=$value['ELEMENT_COUNT']?>) <?=$value['DISPLAY_VALUE']?>
					</label>
				</div>
				<?php
			}
			?>
		</div>
		<?php
	}
	?>
	<input type="submit" value="Отправить">
</form>