<div class="order-complit__wrapper">
	<?php
	$APPLICATION->IncludeComponent("odva:breadcrumbs", "", [
		'LINKS' => [
			['text' => 'Главная', 'url'  => '/'],
			['text' => 'Личный кабинет', 'url'  => '/personal/']
		]
	]);
	?>
	<h2 class="title">Ваш заказ успешно оформлен!</h2>
	<div class="order-complit__descr">Мы позвоним вам или отправим СМС, чтобы подтвердить заказ.</div>
	<h3 class="title order-complit__subtitle">Заказ № <?=$arResult['ID']?></h3>
	<div class="order-complit__check">
		<?php
		foreach ($arResult['PRODUCTS'] as $product)
		{
			?>
			<div class="order-complit__item">
				<div class="order-complit__item-img"><img src="<?=$product['IMG']?>" alt=""></div>
				<div class="order-complit__right">
					<div class="order-complit__item-name"><?=$product['NAME']?></div>
					<div class="order-complit__item-wr">
						<div class="order-complit__item-quantity"><?=$product['QUANTITY']?> шт.</div>
						<div class="order-complit__item-price"><?=number_format($product['PRICE'],0,' ',' ')?> ₽</div>
					</div>
				</div>
			</div>
			<?php
		}
		?>
		<div class="order-complit__item">
			<div class="order-complit__left-wr">
				<div class="order-complit__item-property">
					<?=$product['QUANTITY']?> товара на сумму
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
					<?=number_format($arResult['PRICE'],0,' ',' ')?> ₽
				</div>
				<div class="order-complit__item-value">
					<?= number_format($arResult['DISCOUNT_VALUE'],0,' ',' ')?>  ₽
				</div>
				<div class="order-complit__item-value">
					<?=($arResult['DELIVERY_PRICE']==0)? "Бесплатно" : $arResult['DELIVERY_PRICE']." ₽"?>
				</div>
				<div class="order-complit__item-value">
					<?=number_format($arResult['PRICE'],0,' ',' ')?> ₽
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
				<?=$arResult['PROPERTIES']['FIO']['VALUE_ORIG']?>
			</div>
		</div>
		<div class="order-complit__recipient-item">
			<svg role="img" class="ic-phone-order">
				<use xlink:href="#ic-phone-order"></use>
			</svg>
			<div class="order-complit__recipient-name">
				<?=$arResult['PROPERTIES']['PHONE']['VALUE_ORIG']?>
			</div>
		</div>
		<div class="order-complit__recipient-item">
			<svg role="img" class="ic-mail-order">
				<use xlink:href="#ic-mail-order"></use>
			</svg>
			<div class="order-complit__recipient-name">
				<?=$arResult['PROPERTIES']['EMAIL']['VALUE_ORIG']?>
			</div>
		</div>
	</div>
	<h3 class="title order-complit__subtitle">Адрес доставки</h3>
	<div class="order-complit__address">
		<div class="order-complit__address-item">
			<svg role="img" class="ic-location-order">
				<use xlink:href="#ic-location-order"></use>
			</svg>
			<div class="order-complit__address-name">
				<?=$arResult['PROPERTIES']['CITY']['VALUE_ORIG']." , ".$arResult['PROPERTIES']['ADDRESS']['VALUE_ORIG']?>
			</div>
		</div>
		<?php if($arResult['PRICE_DELIVERY']!=0)
		{?>
			<div class="order-complit__address-item">
				<svg role="img" class="ic-truck-order">
					<use xlink:href="#ic-truck-order"></use>
				</svg>
				<div class="order-complit__address-name">
					День доставки: <?=$arResult['FORMAT_DATE_INSERT']?>
				</div>
			</div>
			<?php
		}
		?>
		<div class="order-complit__address-item">
			<svg role="img" class="ic-time-order">
				<use xlink:href="#ic-time-order"></use>
			</svg>
			<div class="order-complit__address-name">
				<?=$arResult['TIME_DELIVERY']?>
			</div>
		</div>

	</div>
	<a href="/" class="simple-button simple-button--order-complit">Перейти на главную</a>
</div>
