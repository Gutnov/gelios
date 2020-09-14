<h3 class="title title--account">Заказы</h3>
	<div class="account-orders__list">
		<?php
			if(!count($arResult['ORDERS']))
			{
				?><p>У вас нет заказов</p><?php
			}
			foreach ($arResult['ORDERS'] as $order)
			{
				?>
				<div class="account-orders__list-item">
					<div class="account-orders__item-left">
						<div class="account-orders__item-number">
							№<?=$order['ID']?>
						</div>
						<div class="account-orders__item-date">
							<?="{$order['DATE_INSERT']['DD']} {$order['DATE_INSERT']['MM']} {$order['DATE_INSERT']['YYYY']}";?>
						</div>
					</div>
					<div class="account-orders__item-right">
						<div class="account-orders__item-status">
							<?=$order['STATUS_NAME']?>
						</div>
						<div class="account-orders__item-price">
							<?=$order['PRICE_FORMAT']?>
						</div>
					</div>
					<div class="account-orders__item-more">
						<a href='/personal/orders/<?=$order['ID']?>'class="simple-button simple-button--orders">Подробнее</a>
					</div>
				</div>
				<?php
			}
		?>
	</div>
	<?php
	if(count($arResult['ORDERS']) > 10)
	{
		?><div class="account-orders__more">
			<div class="accout-orders__more-name"> Смотреть всё </div>
			<svg role="img" class="ic-down-arrow">
				<use xlink:href="#ic-down-arrow"></use>
			</svg>
		</div><?php
	}
	?>
</div>