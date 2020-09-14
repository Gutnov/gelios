var odvaCategorySliderProducts = {
	target: false,
	toggleFavorite: function(instance, event, id)
	{
		event.preventDefault();
		this.target = instance;

		if($(this.target).hasClass('product-item__action_fav_added'))
			odvaHelpers.favorites.delete(id);
		else
			odvaHelpers.favorites.add(id);
	},
	favoritesAdd: function(data)
	{
		if(!data.success)
			return;

		let id = $(this.target).data('favorite-id');

		$(`[data-favorite-id=${id}]`).addClass('product-item__action_fav_added');

		let heart = $(`[data-favorite-id=${id}]`).find('.heart');
		$(heart).addClass('is_animating')
		setTimeout(() =>
		{
			$(heart).addClass('g-dnone')
		}, 500);
	},
	favoritesDelete: function(data)
	{
		if(!data.success)
			return;

		let id = $(this.target).data('favorite-id');

		$(`[data-favorite-id=${id}]`).removeClass('product-item__action_fav_added');

		let heart = $(`[data-favorite-id=${id}]`).find('.heart');
		$(heart).removeClass('is_animating g-dnone');
	},
	notify: function(event, data)
	{
		let callback = event.split(':');
		callback[1] = callback[1].charAt(0).toUpperCase() + callback[1].slice(1);
		callback = callback.join('');

		this[callback](data);
	}
};

odvaHelpers.subscribe(odvaCategorySliderProducts, ['favorites:add', 'favorites:delete']);