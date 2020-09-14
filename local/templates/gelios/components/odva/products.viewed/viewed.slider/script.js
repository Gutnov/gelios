var odvaProductsViewedSlider = {
	favoriteId: false,
	toggleFavorite: function(instance, event)
	{
		event.preventDefault();
		this.favoriteId = $(instance).data('favorite-id');

		if($(instance).hasClass('product-item__action_fav_added'))
			odvaHelpers.favorites.delete(this.favoriteId);
		else
			odvaHelpers.favorites.add(this.favoriteId);
	},
	favoritesAdd: function(data)
	{
		if(!data.success)
			return;

		$(`[data-favorite-id=${this.favoriteId}]`).addClass('product-item__action_fav_added');

		let heart = $(`[data-favorite-id=${this.favoriteId}]`).find('.heart');
		$(heart).removeClass('g-dnone').addClass('is_animating');
		setTimeout(() =>
		{
			$(heart).addClass('g-dnone')
		}, 500);
	},
	favoritesDelete: function(data)
	{
		if(!data.success)
			return;

		$(`[data-favorite-id=${this.favoriteId}]`).removeClass('product-item__action_fav_added');

		let heart = $(`[data-favorite-id=${this.favoriteId}]`).find('.heart');
		$(heart).removeClass('is_animating').addClass('g-dnone');
	},
	notify: function(event, data)
	{
		let callback = event.split(':');
		callback[1] = callback[1].charAt(0).toUpperCase() + callback[1].slice(1);
		callback = callback.join('');

		this[callback](data);
	}
};

odvaHelpers.subscribe(odvaProductsViewedSlider, ['favorites:add', 'favorites:delete']);