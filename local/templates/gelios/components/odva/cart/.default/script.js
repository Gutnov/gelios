var odvaCartLine = {
	notify: function(event, data)
	{
		if(!data.success)
			return;

		if(!!data.count.ITEMS)
			$('._cart-products-count').removeClass('header__bubble_hide').html(data.count.ITEMS);
		else
			$('._cart-products-count').addClass('header__bubble_hide').empty();
	}
};

odvaHelpers.subscribe(odvaCartLine, ['basket:add', 'basket:delete','basket:chg']);