<div class="container-fuild">
	<?php
	foreach ($arResult['PRODUCTS'] as $product)
	{
		?>
		<div class="row">
			<div class="col"><a href="<?=$product['DETAIL_PAGE_URL']?>"><?=$product['NAME']?></a></div>
		</div>
		<?php
	}
	?>
</div>