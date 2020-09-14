	ymaps.ready(function ()
	{
		console.log('sdaad')
		var myMap = new ymaps.Map('map',
			{
				center: [55.756817, 37.632305],
				zoom: 15
			},
			{
				suppressMapOpenBlock: true
			}),

			// Создаём макет содержимого.
			MyIconContentLayout = ymaps.templateLayoutFactory.createClass(
				'<div style="color: #000000; font-weight: bold;">$[properties.iconContent]</div>'
			),

			myPlacemarkWithContent = new ymaps.Placemark([55.756817, 37.632305],
			{
				balloonContent: '\<div class="map-balloon__wr">\
										<div class="map-ballon__wr-top">\
											<span>Аптека Гелиос</span>\
											<span>Москва, Лубянский пр. 15 стр 2</span>\
											<span>Круглосуточно</span>\
											<button class="button">выбрать</button>\
										</div>\
										<div class="map-ballon__wr-bottom">\
											<svg role="img" class="point-big"><use xlink:href="#point-big"></use></svg>\
										</div>\
								</div>'

			},
			{
				// Опции.
				// Необходимо указать данный тип макета.
				iconLayout: 'default#imageWithContent',
				// Своё изображение иконки метки.
				iconImageHref: '..//img/svg-for-sprite/point.svg',
				// Размеры метки.
				iconImageSize: [24, 24],
				// Смещение левого верхнего угла иконки относительно
				// её "ножки" (точки привязки).
				iconImageOffset: [-24, -24],
				// Смещение слоя с содержимым относительно слоя с картинкой.
				iconContentOffset: [15, 15],
				balloonPanelMaxMapArea:0,
				// Макет содержимого.
				iconContentLayout: MyIconContentLayout
			});
		myMap.geoObjects
			.add(myPlacemarkWithContent);
		myMap.controls.remove('fullscreenControl)');
		myMap.controls.remove('rulerControl)');
		myMap.controls.remove('searchControl');
		myMap.controls.remove('trafficControl');
		myMap.controls.remove('typeSelector');
	});
	if($('.order-register__item-content').length > 1)
	{
		$('.order-register__tabs').css('margin-top', '0');

		$('.order-register__item-content').each(function()
		{
			$(this).addClass('order-register__item-content--mb')
		})
	}
