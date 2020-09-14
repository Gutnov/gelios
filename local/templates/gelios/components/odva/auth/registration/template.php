<div onclick="event.stopPropagation();" class="g-popup _popup popup-registr">
	<div class="g-popup__close" onclick="o2.popups.closePopup()">
		<svg role="img" class="close-popup">
			<use xlink:href="#close-popup"></use>
		</svg>
	</div>
	<div class="g-popup__body">
		<div class="popup-registr">
			<form action="<?=$arResult['REG_BITRIX_PATH']?>" onsubmit="regBitrix.resgistration(event,this)">
				<div class="g-popup__title popup-registr__title">
					Регистрация
				</div>
				<?php $APPLICATION->IncludeComponent("odva:auth","social",['ID'=>'uloginReg']); ?>
				<label class="l-input popup-registr__input popup-registr__input-email">
					<div class="l-input__label">Email *</div>
					<div class="l-input__sub-text">Error message</div>
					<input
						type="text"
						name="email"
						class="g-input l-input__input"
						placeholder="Введите ваш email" value=""
						onkeydown="regBitrix.disableErrors(this)"
					>
				</label>
				<label class="l-input popup-registr__input popup-registr__input-pasword">
					<div class="l-input__label">Пароль *</div>
					<div class="l-input__sub-text">Error message</div>
					<input
						type="password"
						name="password"
						class="g-input l-input__input"
						placeholder="Введите пароль"
						value=""
						onkeydown="regBitrix.disableErrors(this)"
					>
				</label>
				<label class="l-input popup-registr__input popup-registr__input-pasword">
					<div class="l-input__label">Повторите пароль *</div>
					<div class="l-input__sub-text">Error message</div>
					<input
						type="password"
						name="confirm"
						class="g-input l-input__input"
						placeholder="Введите пароль"
						value=""
						onkeydown="regBitrix.disableErrors(this)"
					>
				</label>
				<div class="g-popup__text popup-registr__desc">
					Регистрируясь на сайте, вы соглашаетесь с нашими Правилами и Политикой конфиденциальности и соглашаетесь на информационную рассылку.
				</div>
				<button class="g-primary-button popup-registr__btn popup-registr__btn-reg">
					Зарегистрироваться
				</button>
				<div class="g-secondary-button popup-registr__btn popup-registr__btn-log" onclick="o2.popups.closePopup(); o2.popups.showPopup('.popup-auth')">
					Войти
				</div>
			</form>
		</div>
	</div>
</div>