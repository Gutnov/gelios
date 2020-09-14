<?php
foreach ($arParams['LINKS'] as $index => $link)
{
	if(!empty($link['url']))
	{
		?>
		<a href="<?=$link['url']?>"><?=$link['text']?></a>
		<?php
	}
	else
	{
		?>
		<?=$link['text']?>
		<?php
	}

	if($index != count($arParams['LINKS']) - 1)
		echo " > ";
}
?>