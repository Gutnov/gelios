<?php

foreach ($arResult['data'] as $post)
{
	?>
	<a href="<?=$post['link']?>"><img src="<?=$post['images']['standard_resolution']['url']?>"></a>
	<?php
}