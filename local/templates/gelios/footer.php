	<footer>
		<div class="footer container">
			<div class="footer__top">
				<?php
					$APPLICATION->IncludeComponent(
						"bitrix:menu",
						"bottom-static",
						[
							"ROOT_MENU_TYPE" => "bottom-static",
							"TITLE"=>"Меню"
						]
					);
				?>
				<?php
					$APPLICATION->IncludeComponent(
						"bitrix:menu",
						"bottom-static",
						[
							"ROOT_MENU_TYPE" => "help-static",
							"TITLE"=>"Помощь"
						]
					);
				?>
				<ul class="footer__top-list">
					<li class="footer__top-title">
						Контакты
					</li>
					<li class="footer__top-item footer__top-item_mb18">
						<svg role="img" class="ic-phone">
							<use xlink:href="#ic-phone"></use>
						</svg>
						<a class="footer__top-link footer__top-link_bold" href="tel:<?php $APPLICATION->IncludeFile('/inc/phone.php') ?>">
							<?php $APPLICATION->IncludeFile('/inc/phone.php') ?>
						</a>
					</li>
					<li class="footer__top-item footer__top-item_mb34">
						<svg role="img" class="ic-mail">
							<use xlink:href="#ic-mail"></use>
						</svg>
						<a class="footer__top-link footer__top-link_medium" href="mailto:<?php $APPLICATION->IncludeFile('/inc/mail.php') ?>">
							<?php $APPLICATION->IncludeFile('/inc/mail.php') ?>
						</a>
					</li>
					<li class="footer__top-title">
						Мы принимаем к оплате
					</li>
					<li class="footer__top-item footer__top-item_list">
						<svg role="img" class="logo-visa">
							<use xlink:href="#logo-visa"></use>
						</svg>
						<svg role="img" class="logo-mc">
							<use xlink:href="#logo-mc"></use>
						</svg>
						<svg role="img" class="logo-mir">
							<use xlink:href="#logo-mir"></use>
						</svg>
					</li>
				</ul>
				<ul class="footer__top-list">
					<li class="footer__top-item footer__top-item-title footer__top-item_questions">
						<svg role="img" class="ic-support">
							<use xlink:href="#ic-support"></use>
						</svg>
						<span>Остались вопросы?</span>
					</li>
					<li class="footer__top-item footer__top-item_mb20 footer__top-item_pl40 footer__top-item_questions">
						<a class="footer__top-link" href="#">
							Обратитесь в нашу службу поддержки
						</a>
					</li>
					<li class="footer__top-title footer__top-item_pl40 footer__top-item_questions">
						<a class="footer__btn more-btn" href="#">Перейти</a>
					</li>
					<li class="footer__top-title">
						Мы в социальных сетях
					</li>
					<li class="footer__top-item footer__top-item_list footer__top-item_list-social">
						<a href="#">
							<svg role="img" class="ic-fb-white">
								<use xlink:href="#ic-fb-white"></use>
							</svg>
						</a>
						<a href="#">
							<svg role="img" class="ic-vk-white">
								<use xlink:href="#ic-vk-white"></use>
							</svg>
						</a>
						<a href="#">
							<svg role="img" class="ic-instagram">
								<use xlink:href="#ic-instagram"></use>
							</svg>
						</a>
					</li>
				</ul>
			</div>
			<div class="footer__bottom">
				<div class="footer__bottom-text">
					© 2020 Сеть аптек «Гелиос»
				</div>
				<div class="footer__bottom-text">
					Лицензия: № ЛО-77-02-007516 от 24.03.2016 г.
				</div>
			</div>
		</div>
	</footer>
	<div onclick="o2.popups.closePopup();" class="overlay _overlay">
		<?php $APPLICATION->IncludeComponent('odva:auth','authorization',[]);?>
		<?php $APPLICATION->IncludeComponent('odva:auth','registration',[]);?>
		<?php $APPLICATION->IncludeComponent('odva:order.make','confirm',[]);?>
		<?php $APPLICATION->IncludeComponent('odva:auth','recovery',['m_event'=>'SEND_PASSWORD']);?>
	</div>
	<?php echo file_get_contents($_SERVER['DOCUMENT_ROOT']."/front/img/svg-symbols.svg"); ?>
</body>
</html>