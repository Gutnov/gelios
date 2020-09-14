<div class="checkout-summary__wr">
	<div class="checkout-summary">
		<div class="checkout-summary__item">
			<div class="checkout-summary__line">
				<span>Вашь заказ</span>
				<a href="/cart/">Изменить</a>
			</div>
		</div>
		<div class="checkout-summary__item">
			<div class="checkout-summary__line">
				<span>Товар (<?=$arResult['COUNT_PRODUCTS']?>)</span>
				<span class="checkout-summary__price-value"><?=$arResult['PRICE']['VALUE']+$arResult['PRICE']['DISCOUNT']?>₽</span>
			</div>
			<div class="checkout-summary__line checkout-summary__line--delivery">
				<span>Доставка</span>
				<span class="checkout-summary__delivery-value">100₽</span>
			</div>
			<div class="checkout-summary__line">
				<span>Скидка по промокоду</span>
				<span class="checkout-summary__discount-value">-<?=$arResult['PRICE']['DISCOUNT']?>₽</span>
			</div>
		</div>
		<div class="checkout-summary__item">
			<div class="checkout-summary__line">
				<span>Итого</span>
				<span class="checkout-summary__end-price-value"><?=$arResult['PRICE']['VALUE']+100?>₽</span>
			</div>
		</div>
	</div>
</div>