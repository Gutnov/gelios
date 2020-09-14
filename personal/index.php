<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
	$APPLICATION->SetTitle("Персональный раздел | ".CSite::GetByID("s1")->Fetch()['NAME']);
?>
<div class="container">
	<?php
	$APPLICATION->IncludeComponent("odva:breadcrumbs", "", [
		'LINKS' => [
			['text' => 'Главная', 'url'  => '/'],
			['text' => 'Личный кабинет', 'url'  => '/personal/']
		]
	]);
	?>
	<h2 class="title title--account">Личный кабинет</h2>
	<div class="account__wrapper">
		<?$APPLICATION->IncludeComponent("bitrix:main.include","",[
			"AREA_FILE_SHOW"   => "sect",
			"AREA_FILE_SUFFIX" => "menu",
			"EDIT_TEMPLATE"    => "",
			"ACTIVE_PAGE"      => "personal"
		]);?>
		<div class="account__right">
			<h3 class="title title--account">Контактные данные</h3>
			<div class="account-details__contacts">
				<div class="account-details__contacts-wr">
					<div class="account-details__contacts-item">
						<span>Имя *</span>
						<input type="text" placeholder="Введите ваше имя">
					</div>
					<div class="account-details__contacts-item">
						<span>Фамилия *</span>
						<input type="text" placeholder="Введите вашу Фамилию">
					</div>
				</div>
				<div class="account-details__contacts-wr">
					<div class="account-details__contacts-item">
						<span>Номер телефона *</span>
						<div class="account-details__contacts-flex account-details__contacts-flex--phone">
							<input type="text" placeholder="+7 (999) 123-23-34">
							<button class="button-activate button-activate--account-details">Подтвердить</button>
						</div>
					</div>
					<div class="account-details__contacts-item">
						<span>Email *</span>
						<input type="email" placeholder="Введите ваш email">
					</div>
				</div>
			</div>
			<h3 class="title title--account">Дата рождения</h3>
			<div class="account-details__date">
				<div class="account-details__date-items">
					<div class="account-details__date-item">
						<span>День *</span>
						<div class="g-select" data-value="">
							<div class="g-select__selected" onclick="o2.select.selectDropdownToggle(this);" data-id="1">
								<div class="g-select__selected-name _selected-item-name">День</div>
								<div class="g-select__arrow">
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
										<path fill-rule="evenodd" d="M15.525 9c.416 0 .61.455.37.856l-2.93 4.87c-.204.374-.721.356-.934 0l-2.93-4.87C8.87 9.483 9.054 9 9.47 9h6.054z" />
									</svg>
								</div>
							</div>
							<div class="g-select-list">
								<ul class="g-select-list__items">
									<li class="g-select-list__item g-select-list__item_active" onclick="o2.select.markSelectedItem(this);">1</li>
									<li class="g-select-list__item" onclick="o2.select.markSelectedItem(this);">2</li>
									<li class="g-select-list__item" onclick="o2.select.markSelectedItem(this);">3</li>
									<li class="g-select-list__item" onclick="o2.select.markSelectedItem(this);">4</li>
									<li class="g-select-list__item" onclick="o2.select.markSelectedItem(this);">5</li>
									<li class="g-select-list__item" onclick="o2.select.markSelectedItem(this);">6</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="account-details__date-item">
						<span>Месяц *</span>
						<div class="g-select" data-value="">
							<div class="g-select__selected" onclick="o2.select.selectDropdownToggle(this);" data-id="2">
								<div class="g-select__selected-name _selected-item-name">День</div>
								<div class="g-select__arrow">
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
										<path fill-rule="evenodd" d="M15.525 9c.416 0 .61.455.37.856l-2.93 4.87c-.204.374-.721.356-.934 0l-2.93-4.87C8.87 9.483 9.054 9 9.47 9h6.054z" />
									</svg>
								</div>
							</div>
							<div class="g-select-list">
								<ul class="g-select-list__items">
									<li class="g-select-list__item g-select-list__item_active" onclick="o2.select.markSelectedItem(this);">1</li>
									<li class="g-select-list__item" onclick="o2.select.markSelectedItem(this);">2</li>
									<li class="g-select-list__item" onclick="o2.select.markSelectedItem(this);">3</li>
									<li class="g-select-list__item" onclick="o2.select.markSelectedItem(this);">4</li>
									<li class="g-select-list__item" onclick="o2.select.markSelectedItem(this);">5</li>
									<li class="g-select-list__item" onclick="o2.select.markSelectedItem(this);">6</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="account-details__date-item">
						<span>Год *</span>
						<div class="g-select" data-value="">
							<div class="g-select__selected" onclick="o2.select.selectDropdownToggle(this);" data-id="3">
								<div class="g-select__selected-name _selected-item-name">День</div>
								<div class="g-select__arrow">
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
										<path fill-rule="evenodd" d="M15.525 9c.416 0 .61.455.37.856l-2.93 4.87c-.204.374-.721.356-.934 0l-2.93-4.87C8.87 9.483 9.054 9 9.47 9h6.054z" />
									</svg>
								</div>
							</div>
							<div class="g-select-list">
								<ul class="g-select-list__items">
									<li class="g-select-list__item g-select-list__item_active" onclick="o2.select.markSelectedItem(this);">1</li>
									<li class="g-select-list__item" onclick="o2.select.markSelectedItem(this);">2</li>
									<li class="g-select-list__item" onclick="o2.select.markSelectedItem(this);">3</li>
									<li class="g-select-list__item" onclick="o2.select.markSelectedItem(this);">4</li>
									<li class="g-select-list__item" onclick="o2.select.markSelectedItem(this);">5</li>
									<li class="g-select-list__item" onclick="o2.select.markSelectedItem(this);">6</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="account-details__date-descr">
					Получайте поздравления и дополнительные скидки
				</div>
			</div>
			<h3 class="title title--short-margin">Пол</h3>
			<div class="account-details__sex">
				<div class="account-details__sex-item">
					<label class="g-radio">
						<input type="radio" name="boom1" class="g-radio__input">
						<div class="g-radio__body">
							<span class="g-radio__box"></span>
							<span class="g-radio__text">Мужской</span>
						</div>
					</label>
				</div>
				<div class="account-details__sex-item">
					<label class="g-radio g-radio--account-details">
						<input type="radio" name="boom1" class="g-radio__input">
						<div class="g-radio__body">
							<span class="g-radio__box"></span>
							<span class="g-radio__text">Женский</span>
						</div>
					</label>
				</div>
			</div>
			<div class="account-details__button">
				<button class="g-primary-button g-primary-button--account-details" disabled="disabled">Сохранить</button>
			</div>
		</div>
	</div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>