<div onclick="event.stopPropagation();" class="g-popup _popup popup-recovery">
    <div class="g-popup__close" onclick="o2.popups.closePopup();">
        <svg role="img" class="close-popup">
            <use xlink:href="#close-popup"></use>
        </svg>
    </div>
    <div class="g-popup__body">
        <div class="popup-recovery">
        	<form action="<?=$arResult['SEND_PASSWORD_BITRIX_PATH']?>" onsubmit="sendPasswordBitrix.sendpassword(event,this)">
	            <div class="g-popup__title popup-recovery__title">
	                Восстановление пароля
	            </div>
	            <div class="popup-recovery__content _recovery-content">
	                <div class="g-popup__text popup-recovery__text">
	                    Для получения временного пароля необходимо ввести email, указанные в вашем личном кабинете.
	                </div>
	                <input type="hidden" name="m_event" value="<?=$arParams['m_event']?>">
					<label class="l-input popup-recovery__input">
						<div class="l-input__label">Email *</div>
						<div class="l-input__sub-text">Error message</div>
						<input
							name="email"
							type="text"
							class="g-input l-input__input"
							placeholder="Введите ваш email"
							value=""
							onkeydown="sendPasswordBitrix.disableErrors(this)"
						>
					</label>
	                <div class="g-popup__text popup-recovery__text">
	                    Срок действия временного пароля 24 часа.
	                </div>
	                <button class="g-primary-button popup-recovery__btn">
	                    Отправить
	                </button>
	            </div>
	            <div class="popup-recovery__success popup-recovery__success--hide _recovery-success">
	                Ваш новый пароль отправлен на почту.
	            </div>
        	</form>
        </div>
    </div>
</div>