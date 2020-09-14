<?php
    if($arResult['AUTH'])
    {
        ?>
        <div class="top-info__registr-mobile">
			<div class="top-info__registr-icon">
				<svg role="img" class="close-mobile" onclick="o2.popups.mobileMenuHide()">
					<use xlink:href="#close-mobile"></use>
				</svg>
			</div>
			<div class="top-info__registr-links">
				<a class="top-info__registr-text" data-url-ajax="<?=$arResult['LOGOUT_AJAX_PATH']?>" onclick="authLineMobile.logout(event,this)">Выйти</a>
			</div>
		</div>
        <?
    }
    else
    {
        ?>
        <div class="top-info__registr-mobile">
			<div class="top-info__registr-icon">
				<svg role="img" class="close-mobile" onclick="o2.popups.mobileMenuHide()">
					<use xlink:href="#close-mobile"></use>
				</svg>
			</div>
			<div class="top-info__registr-links">
				<a class="top-info__registr-text top-info__registr-log" href="/personal/">Войти</a>
				<a class="top-info__registr-text" href="/personal/">Регистрация</a>
			</div>
		</div>
        <?
    }
?>
