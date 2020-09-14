<div onclick="event.stopPropagation();" class="g-popup _popup popup-auth">
	<div class="g-popup__close" onclick="o2.popups.closePopup()">
		<svg role="img" class="close-popup">
			<use xlink:href="#close-popup"></use>
		</svg>
	</div>
	<div class="g-popup__body">
		<div class="popup-auth">
			<form action="<?=$arResult['AUTH_BITRIX_PATH']?>" onsubmit="authBitrix.authorization(event,this)">
				<div class="g-popup__title popup-auth__title">
					Вход
				</div>
				<?php $APPLICATION->IncludeComponent("odva:auth","social",['ID'=>'uloginAuth']); ?>
				<label class="l-input popup-auth__input popup-auth__input-email">
					<div class="l-input__label">Email *</div>
					<div class="l-input__sub-text">Error message</div>
					<input
						name="email"
						type="text"
						class="g-input l-input__input"
						placeholder="Введите ваш email"
						value=""
						onkeydown="authBitrix.disableErrors(this)"
					>
				</label>
				<label class="l-input popup-auth__input">
					<div class="l-input__label">Пароль *</div>
					<div class="l-input__sub-text">Error message</div>
					<input
						name="password"
						type="password"
						class="g-input l-input__input"
						placeholder="Введите пароль"
						value=""
						onkeydown="authBitrix.disableErrors(this)"
					>
				</label>

				<div class="popup-auth__restore">
					<a href="#" class="popup-confirm__restore-link" onclick="o2.popups.closePopup(); o2.popups.showPopup('.popup-recovery')">Восстановить пароль</a>
				</div>
				<button class="g-primary-button popup-auth__btn popup-auth__btn-log">
					Войти
				</button>
				<div class="g-secondary-button popup-auth__btn popup-auth__btn-reg" onclick="o2.popups.closePopup(); o2.popups.showPopup('.popup-registr')">
					Регистрация
				</div>
			</form>
		</div>
	</div>
</div>