<ul class="breadcrumbs">
	<?php
	foreach ($arParams['LINKS'] as $link)
	{
		?>
		<li class="breadcrumbs__item">
			<a href="<?=$link['url']?>" class="breadcrumbs__link">
				<?=$link['text']?>
			</a>
		</li>
		<?php
	}
	?>
</ul>