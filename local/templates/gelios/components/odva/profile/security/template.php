<div class="account__right">
	<h3 class="title title--account">Смена пароля</h3>
	<form action="<?=$arResult['SAVE_PASSWORD_PATH']?>" onsubmit="ProfilePassword.chenge(event,this)">
		<div class="account-secutity__form">
			<div class="account-security__form-item">
				<span>Действующий пароль *</span>
				<input
					type="password"
					name="password"
					placeholder="Действующий пароль"
				>
			</div>
			<div class="account-security__form-item">
				<span>Новый пароль *</span>
				<input
					type="password"
					class="account-security__form-item--pass-val"
					name="newpassword"
					placeholder="Новый пароль"
				>
			</div>
			<div class="account-security__form-item">
				<span>Подтверждение пароля *</span>
				<input
					type="password"
					class="account-security__form-item--pass-val"
					name="confirm"
					placeholder="Подтверждение пароля"
				>
			</div>
		</div>
		<div class="account-details__button">
			<button class="g-primary-button g-primary-button--account-details" disabled>Сохранить</button>
		</div>
	</form>
</div>