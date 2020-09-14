<div class="container-fluid">
	<div class="row">
		<?php
		if(count($arResult['OFFERS']))
		{
			foreach ($arResult['OFFERS'] as $offer)
			{
				?>
				<div class="col-3"><?=$offer['NAME']?></div>
				<?php
			}
			?>
			<?php
		}
		else
		{
			?>
			<div class="col-12">
				<h2 class="text-center">Ничего не найдено</h2>
			</div>
			<?php
		}
		?>
	</div>
</div>