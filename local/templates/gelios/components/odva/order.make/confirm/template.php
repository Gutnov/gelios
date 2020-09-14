<div onclick="event.stopPropagation();" class="g-popup _popup popup-confirm">
	<div class="g-popup__close" onclick="o2.popups.closePopup()">
		<svg role="img" class="close-popup">
			<use xlink:href="#close-popup"></use>
		</svg>
	</div>
	<div class="g-popup__body">
		<div class="popup-confirm__body">
			<div class="g-popup__title popup-confirm__title">
				Подтвердить номер
			</div>
			<div class="g-popup__text popup-confirm__text">
				Введите полученный в СМС код для подтверждения номера телефона
			</div>

			<label class="l-input popup-confirm__input">
				<div class="l-input__label">Код подтверждения *</div>
				<div class="l-input__sub-text">Error message</div>
				<input name="CODE" type="text" class="g-input l-input__input input-code-confirm--value" placeholder="Код подтверждения" value="">
			</label>

			<div class="popup-confirm__phone">
				<div class="g-popup__text">
					Код подтверждения отправлен на номер
				</div>
				<div class="popup-confirm__phone-num">
					<span>+7 (999) 123 45 67</span>
					<span class="popup-confirm__phone-change">Изменить</span>
				</div>
			</div>
			<div class="g-popup__text popup-confirm__time">
				Можно отправить повторно через <span class="popup-confirm__time-sec">299</span> сек.
			</div>
			<div class="g-popup__text popup-confirm__time_mobile">
				Отправить повторно через <span class="popup-confirm__time-sec">299</span> сек.
			</div>
			<div class="g-primary-button popup-confirm__btn" onclick="confirmPopap.checkCode()">
				Подтвердить
			</div>
		</div>
	</div>
</div>
<script>
BX.message({
	TEMPLATE_PATH_COFIRM: '<? echo $this->GetFolder(); ?>'
});
</script>