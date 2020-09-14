var odvaCart =
{
	CartQuatityOld:null,
	CartQuatityContainer:null,
	notify: function(event, data)
	{
		if(event == "basket:chg")
		{
			if(data.success)
			{
				this.recountAllPrice();
				this.recountCountItems();
			}
			else
			{
				this.CartQuatityContainer.html(this.CartQuatityOld);
				this.recountItemPrice();
			}
		}
	},
	recountCountItems:function()
	{
		let count = 0;
		$(".cart__detail-count-number").each((index,element)=>
			{
				count += parseInt($(element).html());
			}
		)
		$(".checkout-summary__line--count").html("Товар ("+count+")");
	},
	removeItem:function(e,init)
	{
		$.post(
				BX.message('PATH_REMOVE_ITEM'),
				{
					'PRODUCT_ID':$(init).data("product-id")
				},
				(data)=>
				{
					let result = JSON.parse(data);
					if(result.success)
					{
						let price = parseFloat(result.PRICE.VALUE + result.PRICE.DISCOUNT);
						price = price.toFixed(2);
						let discount = parseFloat(result.PRICE.DISCOUNT);
						discount = discount.toFixed(2);
						let summ = parseFloat(result.PRICE.VALUE);
						summ = summ.toFixed(2);
						$(".checkout-summary__line--price").html(price+"₽");
						$(".checkout-summary__line--discount").html("-"+discount+"₽");
						$(".checkout-summary__line-sum").html(summ+"₽");
					}
					else
					{
						return false;
					}
				}
		);
	},
	recountItemPrice:function()
	{
		$(".cart__detail-qn").each((index,element)=>
			{
				let count = parseFloat($(element).find(".cart__detail-count-number").html());
				let onePrice = $(element).find(".cart__detail-price-one span").html();
				let discount = $(".checkout-summary__line--discount").html();
					discount = parseFloat(discount.split('-').pop());
				let summ = parseFloat($(".checkout-summary__line--price").html());
				let procent = (discount/summ);
				let result = count * (onePrice - (onePrice * procent));
				$(element).find(".cart__detail-price span").html(result.toFixed(2));
			}
		)
	},
	recountAllPrice:function()
	{
		let price = 0;
		$(".cart__detail-price span").each((index,element)=>
			{
				price += parseFloat($(element).html());
			}
		)
		let discount = $(".checkout-summary__line--discount").html();
		discount = parseFloat(discount.split('-').pop());
		let fullPrice = price + discount;
		$(".checkout-summary__line--price").html((fullPrice.toFixed(2))+"₽");
		$(".checkout-summary__line-sum").html(price.toFixed(2));
	},
	cartCount(instance)
	{
		let CartProductQuatity = $(instance).siblings('.cart__detail-count-number'),
			totalPrice = $(instance).parents('.cart__detail-qn').find('.cart__detail-price span'),
			totalPriceVal = +totalPrice.text().replace(',', '.'),
			priceForOne = $(instance).parents('.cart__detail-qn').find('.cart__detail-price-one span'),
			priceForOneVal = +(priceForOne.text().replace(',', '.')),
			productId = $(instance).closest('.cart__detail-count').data('product-id');
			this.CartQuatityOld = CartProductQuatity.html();
			this.CartQuatityContainer = CartProductQuatity;
		if(+CartProductQuatity.text() > 1)
		{

		}else
		{
			priceForOne.parent().removeClass('cart__detail-price-one--show')
		}

		if ($(instance).hasClass('cart__detail-count-plus'))
		{
			priceForOne.parent().addClass('cart__detail-price-one--show');
			CartProductQuatity.text(+CartProductQuatity.text() + 1);
			let count = parseInt(CartProductQuatity.text());
			let discount = $(".checkout-summary__line--discount").html();
			discount = parseFloat(discount.split('-').pop());
			let summ = parseFloat($(".checkout-summary__line--price").html())+parseFloat(priceForOneVal);
			let procent = (discount/summ);
			let result = count * (priceForOneVal - (priceForOneVal * procent));
			totalPrice.text(result.toFixed(2));
			odvaHelpers.basket.chg(productId,CartProductQuatity.text());
		}
		else if(+CartProductQuatity.text() > 1)
		{
			if($(instance).hasClass('cart__detail-count-minus') && CartProductQuatity.text() == 2)
			{
				priceForOne.parent().removeClass('cart__detail-price-one--show');
			}
			CartProductQuatity.text(+CartProductQuatity.text() - 1);
			let count = parseFloat(CartProductQuatity.text());
			let discount = $(".checkout-summary__line--discount").html();
			discount = parseFloat(discount.split('-').pop());
			let summ = parseFloat($(".checkout-summary__line--price").html())-parseFloat(priceForOneVal);
			let procent = (discount/summ);
			let result = count * (priceForOneVal - (priceForOneVal * procent));
			totalPrice.text(result.toFixed(2));
			odvaHelpers.basket.chg(productId,CartProductQuatity.text());
		}
	},
	setPromocod:function(e,init)
	{
		e.preventDefault();
		$.post(
				BX.message('PATH_ACTIVATE_RPOMOCOD'),
				$(init).serialize(),
				(data)=>{
					let result = JSON.parse(data);
					if(result.success == true)
					{
						let price = parseFloat(result.PRICE.VALUE);
						let discount = parseFloat(result.PRICE.DISCOUNT);
						$(".checkout-summary__line--discount").html("-"+(discount.toFixed(2))+"₽");
						this.recountItemPrice();
						this.recountAllPrice();
					}
				}
		);
	}
}

odvaHelpers.subscribe(odvaCart, ['basket:add', 'basket:delete','basket:chg']);