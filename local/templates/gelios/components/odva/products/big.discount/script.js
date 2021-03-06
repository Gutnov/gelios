var discountProducts = {
	target: false,
	addToBasket: function(instance, event, productId)
	{
		event.preventDefault();
		this.target = productId;

		odvaHelpers.basket.add(productId, 1);
	},
	basketAdd: function(data)
	{
		if(!data.success)
		{
			alert(data.error.msg);
			return;
		}

		$(`[data-to-cart-button=${this.target}]`).addClass('product-item__button-in-cart').text('В корзине');
	},
	notify: function(event, data)
	{
		let callback = event.split(':');
		callback[1] = callback[1].charAt(0).toUpperCase() + callback[1].slice(1);
		callback = callback.join('');

		this[callback](data);
	}
};

odvaHelpers.subscribe(discountProducts, ['basket:add', 'basket:delete']);