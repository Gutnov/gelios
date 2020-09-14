<div class="order-complit__wrapper">
	<?php
	$APPLICATION->IncludeComponent("odva:breadcrumbs", "", [
		'LINKS' => [
			['text' => 'Главная', 'url'  => '/'],
			['text' => 'Корзина', 'url'  => '/cart/'],
			['text' => 'Оформления заказа', 'url'  => '/cart/order/'],
			['text' => 'Заказ №'.$arResult['ID'], 'url'  => '/cart/order/'],
		]
	]);
	?>
	<h2 class="title">Ваш заказ успешно оформлен!</h2>
	<div class="order-complit__descr">Мы позвоним вам или отправим СМС, чтобы подтвердить заказ.</div>
	<h3 class="title order-complit__subtitle">Заказ № <?=$arResult['ID']?></h3>
	<div class="order-complit__check">
		<?php
			foreach ($arResult['PRODUCTS_ITEMS'] as $product)
			{
				?>
				<div class="order-complit__item">
					<div class="order-complit__item-img"><img src="<?=$product['DETAIL_PICTURE']?>" alt=""></div>
					<div class="order-complit__right">
						<div class="order-complit__item-name"><?=$product['NAME']?></div>
						<div class="order-complit__item-wr">
							<div class="order-complit__item-quantity"><?=$product['QUANTITY']?> шт.</div>
							<div class="order-complit__item-price"><?=$product['ALL_PRICE']?> ₽</div>
						</div>
					</div>
				</div>
				<?php
			}
		?>
		<div class="order-complit__item">
			<div class="order-complit__left-wr">
				<div class="order-complit__item-property">
					<?=$arResult['COUNT_PRODUCTS_STR']?> на сумму
				</div>
				<div class="order-complit__item-property">
					Скидка по промокоду
				</div>
				<div class="order-complit__item-property">
					Доставка
				</div>
				<div class="order-complit__item-property">
					Итоговая стоимость
				</div>
			</div>
			<div class="order-complit__right-wr">
				<div class="order-complit__item-value">
					<?=$arResult['PRICE_WITH_SALE']?> ₽
				</div>
				<div class="order-complit__item-value">
					-<?=$arResult['SALE_VALUE']?> ₽
				</div>
				<div class="order-complit__item-value">
					<?=($arResult['DELIVERY_PRICE'] == 0)?'Бесплатно':$arResult['DELIVERY_PRICE']." ₽"?>
				</div>
				<div class="order-complit__item-value">
					<?=$arResult['PRICE_SALE']+$arResult['DELIVERY_PRICE']?> ₽
				</div>
			</div>
		</div>
	</div>
	<h3 class="title order-complit__subtitle">Получатель</h3>
	<div class="order-complit__recipient">
		<div class="order-complit__recipient-item">
			<svg role="img" class="ic-user-order">
				<use xlink:href="#ic-user-order"></use>
			</svg>
			<div class="order-complit__recipient-name">
				<?=$arResult['PROPERTIES']['FIO']['VALUE']?>
			</div>
		</div>
		<div class="order-complit__recipient-item">
			<svg role="img" class="ic-phone-order">
				<use xlink:href="#ic-phone-order"></use>
			</svg>
			<div class="order-complit__recipient-name">
				<?=$arResult['PROPERTIES']['PHONE']['VALUE']?>
			</div>
		</div>
		<div class="order-complit__recipient-item">
			<svg role="img" class="ic-mail-order">
				<use xlink:href="#ic-mail-order"></use>
			</svg>
			<div class="order-complit__recipient-name">
				<?=$arResult['PROPERTIES']['EMAIL']['VALUE']?>
			</div>
		</div>
	</div>
	<?php
		if($arResult['DELIVERY_ID'] == 3)
		{
			?>
			<h3 class="title order-complit__subtitle"><?=$arResult['WHEN_GIVE']?></h3>
			<?php
		}
		else
		{
			?>
			<h3 class="title order-complit__subtitle">Адрес доставки</h3>
			<div class="order-complit__address">
				<div class="order-complit__address-item">
					<svg role="img" class="ic-location-order">
						<use xlink:href="#ic-location-order"></use>
					</svg>
					<div class="order-complit__address-name">
						<?=$arResult['PROPERTIES']['ADDRESS']['VALUE']?>
					</div>
				</div>
				<div class="order-complit__address-item">
					<svg role="img" class="ic-truck-order">
						<use xlink:href="#ic-truck-order"></use>
					</svg>
					<div class="order-complit__address-name">
						День доставки: <?=$arResult['DELIVETY_DAY_WEEK_NAME']?>, <?=$arResult['DELIVETY_DAY']?> <?=$arResult['DELIVETY_MAY_NAME']?>
					</div>
				</div>
				<div class="order-complit__address-item">
					<svg role="img" class="ic-time-order">
						<use xlink:href="#ic-time-order"></use>
					</svg>
					<div class="order-complit__address-name">
						Время доставки: <?=$arResult['DELIVETY_TIME']?>
					</div>
				</div>
			</div>
			<?php
		}
	?>
	<button class="simple-button simple-button--order-complit" onclick="window.location.href='/';">Перейти на главную</button>
</div>