$(document).ready(function()
{
	jQuery.extend
	(
		{
			getValues: function(url)
			{
				var result = null;
				$.ajax(
					{
						url: url,
						type: 'get',
						dataType: 'html',
						async: false,
						cache: false,
						success: function(data)
						{
							result = data;
						}
					}
				);
				return result;
			}
		}
	);
	if ($('.container').children().hasClass('_map-content'))
	{
		ymaps.ready(function ()
		{
			var myMap = new ymaps.Map('map',
				{
					center: [43.036890, 44.657495],
					zoom: 12
				},
				{
					suppressMapOpenBlock: true
				}),

				// Создаём макет содержимого.
				MyIconContentLayout = ymaps.templateLayoutFactory.createClass(
					'<div style="color: #000000; font-weight: bold;">$[properties.iconContent]</div>'
				);
				var	pharmacies = JSON.parse($.getValues(BX.message('TEMPLATE_PATH')+"/ajax.get.pharmacies.php"));
				var pharmaciesMark = [];
				for(key in pharmacies)
				{
					pharmaciesMark.push(
						new ymaps.Placemark([parseFloat(pharmacies[key].X), parseFloat(pharmacies[key].Y)],
						{
							balloonContent: '\<div class="map-balloon__wr">\
													<div class="map-ballon__wr-top">\
														<span>'+pharmacies[key].NAME+'</span>\
														<span>'+pharmacies[key].ADRES+'</span>\
														<span>Круглосуточно</span>\
														<button\
															class="button"\
															data-id='+pharmacies[key].ID+'\
															onclick="makeOrder.setAdress(\''+pharmacies[key].ADRES+'\')">выбрать</button>\
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
							iconImageHref: '/front/img/svg-for-sprite/point.svg',
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
						})
					)
				}
			for(key in pharmaciesMark)
			{
				myMap.geoObjects.add(pharmaciesMark[key]);
			}
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
	}
	$(".order-register__form-item--phone").mask("+0 (000) 000-00-00")
});
var makeOrder =
{
	delivery: 2 ,
	adress: '',
	priceDelivery:100,
	fillInputs:[],
	checkedCheckbox:false,
	disableButton:function()
	{
		if(this.delivery == 3)
		{
			if(this.fillInputs.length == 4 && this.checkedCheckbox == true)
			{
				$(".button--order-register").prop('disabled',false);
			}
			else
			{
				$(".button--order-register").prop('disabled',true);
			}
		}
		else
		{
			if(this.fillInputs.length == 8)
			{
				$(".button--order-register").prop('disabled',false);
			}
			else
			{
				$(".button--order-register").prop('disabled',true);
			}
		}
	},
	checkCheckbox:function()
	{
		if($(".g-checkbox__input").prop('checked') == false)
		{
			this.checkedCheckbox = false;
		}
		else
		{
			this.checkedCheckbox = true;
		}
		this.disableButton();
	},
	changeInput:function(input)
	{
		if($(input).val() != "")
		{
			if(this.fillInputs.indexOf($(input).attr("class")) == -1)
			{
				this.fillInputs.push($(input).attr("class"));
			}
		}
		else
		{
			const index = this.fillInputs.indexOf($(input).attr("class"));
			if (index > -1)
			{
				this.fillInputs.splice(index, 1);
			}
		}
		this.disableButton();
	},
	setDeliveryAndPriceBlock:function(delivery,price)
	{
		this.delivery = parseInt(delivery);
		this.priceDelivery = parseInt(price);
		$(".g-radio__input").prop('checked', false);
		$(".g-radio__input.radio__input--delivery-first").prop('checked', true);
		$(".checkout-summary__delivery-value").html((price == 0)?'Беслатнно':price+"₽");
		this.calcEndPrice();
	},
	setDeliveryAndAdressBlock:function(delivery,price,adress)
	{
		this.delivery = parseInt(delivery);
		this.priceDelivery = parseInt(price);
		this.adress = adress;
		$(".g-radio__input").prop('checked', false);
		$(".g-radio__input.radio__input--adress-first").prop('checked', true);
		$(".checkout-summary__delivery-value").html((price == 0)?'Бесплатнно':price+"₽");
		this.calcEndPrice();
	},
	setDeliveryAndPrice:function(delivery,price)
	{
		this.delivery = parseInt(delivery);
		this.priceDelivery = parseInt(price);
		$(".checkout-summary__delivery-value").html((price == 0)?'Бесплатнно':price+"₽");
		this.calcEndPrice();
	},
	setAdress:function(adress)
	{
		this.adress = adress;
	},
	setPromocod:function(e,init)
	{
		e.preventDefault();
		var promocod = ($(init).siblings("input").eq(0).val() == "")?$(init).siblings("input").eq(1).val():$(init).siblings("input").eq(0).val();
		$.post(
			BX.message('PATH_ACTIVATE_RPOMOCOD'),
			{
				PROMOCOD:promocod
			},
			(data)=>
			{
				var resultPromocod = JSON.parse(data);
				if(resultPromocod.success)
				{
					$(".checkout-summary__price-value").html((resultPromocod.price.VALUE+resultPromocod.price.DISCOUNT)+"₽");
					$(".checkout-summary__discount-value").html("-"+resultPromocod.price.DISCOUNT+"₽");
					this.calcEndPrice();
					alert("Ваш промоко Актвирован");
				}
				else
				{
					alert("Ваш промоко не действителен");
				}

			}
		)
		return false;
	},
	calcEndPrice:function()
	{
		var Price = (!isNaN(parseInt($(".checkout-summary__price-value").html())))?parseInt($(".checkout-summary__price-value").html()):0,
		discount = $(".checkout-summary__discount-value").html();
		discount = parseInt(discount.split('-').pop());
		$(".checkout-summary__end-price-value").html(((Price-discount)+this.priceDelivery)+"₽");
	},
	isValidateForm:function(form)
	{
		let validate = 0;
		$(form).find("input").each(
			function(indx, element)
			{
				if($(element).closest(".order-register__form-item--promo").hasClass("order-register__form-item--promo"))
				{
					return;
				}
				if($(element).val()==="")
				{
					validate++;
					$(element).parent().addClass("order-register__form-item--error");
				}
				else
				{
					$(element).parent().removeClass("order-register__form-item--error");
				}
			}
		);
		return validate == 0;
	},
	sendOrder:function()
	{
		$.post(
			BX.message('PATH_MAKE_ORDER'),
				{
					EMAIL:$(".order-register__form-item--email").val(),
					NAME:$(".order-register__form-item--fname").val()+" "+$(".order-register__form-item--lname").val(),
					PHONE:$(".order-register__form-item--phone").val(),
					ADDRESS:this.adress,
					DOST_ID:this.delivery
				},
				(data) =>
				{
					let result = JSON.parse(data);
					if(result.success == true)
					{
						window.location.href = "/cart/order/"+result.id+"/";
					}
					else
					{
						alert("Что то пошло не так!");
					}
				}
		);
	},
	preSendOrder:function(e,init)
	{
		e.preventDefault();
		let isValidate = true;
		if(this.delivery == 2)
		{
			let errorFiels = false;
			let adress = $(".order-register__form--delivery");
			isValidate = this.isValidateForm(adress);
			let city = $(adress).find("input[name='city']").val(),
			street = $(adress).find("input[name='street']").val(),
			home = $(adress).find("input[name='home']").val(),
			apartment = $(adress).find("input[name='apartment']").val();
			this.adress = city+" ул. "+street+" д. "+home+" кв. "+apartment;
		}
		if(this.isValidateForm($(".order-register__form--person")) == false || isValidate == false)
		{
			return false;
		}
		if(this.delivery == 3 && $(".g-checkbox__input").prop('checked') == false)
		{
			alert("Согласитесь с политикой конфидициальности");
			return false;
		}
		o2.popups.showPopup('.popup-confirm');
		confirmPopap.getCode();
	}
}