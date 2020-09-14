<div class="account__left">
	<ul class="account__nav">
		<li class="account__nav-item <?=($arParams['ACTIVE_PAGE'] == 'personal')?'account__nav-item--active':''?>">
			<a href="/personal/">
				<svg role="img" class="ic-user-action">
					<use xlink:href="#ic-user-action"></use>
				</svg>
				<div class="account__nav-name">Мои данные</div>
			</a>
		</li>
		<li class="account__nav-item <?=($arParams['ACTIVE_PAGE'] == 'orders')?'account__nav-item--active':''?>">
			<a href="/personal/orders/">
				<svg role="img" class="ic-cart-account">
					<use xlink:href="#ic-cart-account"></use>
				</svg>
				<div class="account__nav-name">Мои заказы</div>
			</a>
		</li>
		<li class="account__nav-item <?=($arParams['ACTIVE_PAGE'] == 'security')?'account__nav-item--active':''?>">
			<a href="/personal/security/">
				<svg role="img" class="ic-security-account">
					<use xlink:href="#ic-security-account"></use>
				</svg>
				<div class="account__nav-name">Безопасность</div>
			</a>
		</li>
	</ul>
</div>