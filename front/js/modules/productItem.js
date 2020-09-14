const o2ProductItem = {
	init()
	{
		this.setRatingOfProduct();
	},
	setRatingOfProduct()
	{
		const productItems = $('._product-rating');
		const starTotal = 5;

		if (!productItems.length) return false;

		productItems.each((index, product) =>
		{
			let ratingOfCurrentProd = +$(product).data('rating');
			let starsPercentage = (ratingOfCurrentProd / starTotal) * 100;
			let starsPercentageRounded = `${(Math.round(starsPercentage / 10) * 10)}%`;
			$(product).find('.product__rating-stars_fill-wr').css('width', starsPercentageRounded);
		});
	},
	addToCart(instance, e)
	{
		e.preventDefault();
		$(instance).addClass('product-item__button-in-cart').text('В корзине');
	},
	addToFavorite(instance, e)
	{
		e.preventDefault();
		$(instance).toggleClass('product-item__action_fav_added');

		let heart = $(instance).find('.heart');
		$(heart).toggleClass('is_animating')
		setTimeout(() =>
		{
			$(heart).toggleClass('g-dnone')
		}, 500);
	},
	openProductImages(instance)
	{
		$(instance).addClass('active');
		$(instance).siblings().removeClass('active');

		let src = $(instance).attr('src');
		$('.product-detail__slider-left-img').attr('src',src)
	}
};