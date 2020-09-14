<div class="order-register__form order-register__form--person">
	<h3 class="order-register__subtitle">Личные данные</h3>
	<form action="<?=$arResult['PATH_MAKE_ORDER']?>">
		<div class="order-register__form-item">
			<span>Имя *</span>
			<input type="text" onchange="makeOrder.changeInput(this)" class="order-register__form-item--fname" placeholder="Введите ваше имя">
		</div>
		<div class="order-register__form-item">
			<span>Фамилия *</span>
			<input type="text" onchange="makeOrder.changeInput(this)" class="order-register__form-item--lname" placeholder="Введите вашу Фамилию">
		</div>
		<div class="order-register__form-item">
			<span>Номер телефона *</span>
			<input type="text" onchange="makeOrder.changeInput(this)" class="order-register__form-item--phone" placeholder="+7 (000) 000-00-00">
		</div>
		<div class="order-register__form-item">
			<span>Email *</span>
			<input type="email" onchange="makeOrder.changeInput(this)" class="order-register__form-item--email" placeholder="Введите ваш email">
		</div>
		<div class="order-register__form-item order-register__form-item--promo">
			<span>Промокод</span>
			<div>
				<input type="text" placeholder="Введите промокод">
				<input type="text" placeholder="Промокод">
				<button class="button-activate" onclick="makeOrder.setPromocod(event,this)">Активировать</button>
			</div>
		</div>
	</form>
</div>
<div class="order-register__bottom">
	<div class="order-register__bottom-offer">
		<div>
			<label class="g-checkbox catalog-menu__item">
				<input type="checkbox" onchange="makeOrder.checkCheckbox()" class="g-checkbox__input">
				<div class="g-checkbox__body">
					<span class="g-checkbox__box"></span>
				</div>
			</label>
		</div>
		<span>
			Нажимая на кнопку оформить заказ я соглашаюсь с политикой конфиденциальности, публичной офертой и регистрируюсь на сайте.
		</span>
	</div>
	<button class="button button--order-register" onclick="makeOrder.preSendOrder(event,this)" disabled>Оформить заказ</button>
</div>