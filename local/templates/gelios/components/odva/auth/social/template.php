<div class="g-popup__text g-popup__text-soc">
	Через соцсети
	<div class="g-popup__social popup-auth__social">
		<a href="javascript:void(0);" class="g-popup__soc popup-auth__soc" onclick="authSocial.authVk(event)">
			<svg role="img" class="ic-vk">
				<use xlink:href="#ic-vk"></use>
			</svg>
		</a>
		<a href="javascript:void(0);" class="g-popup__soc popup-auth__soc" onclick="authSocial.authFb(event)">
			<svg role="img" class="ic-facebook">
				<use xlink:href="#ic-facebook"></use>
			</svg>
		</a>
	</div>
</div>
<script src="//ulogin.ru/js/ulogin.js"></script>
<div  class="social-auth-block" id="<?=$arParams['ID']?>" data-url-file="<?=$arResult['AUTH_SOCIAL_PATH']?>" data-ulogin="display=panel;theme=classic;fields=email,first_name,last_name;providers=vkontakte,facebook;hidden=;redirect_uri=;mobilebuttons=0;callback=auth_with_social;"></div>