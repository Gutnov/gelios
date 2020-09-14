var odvaCatalogCategories = {
	showMore: function(e)
	{
		e.preventDefault();

		var $button = $(e.target),
			page = +$button.data('page') + 1;

		$button.css({opacity: .3, 'pointer-events': 'none'});

		$.ajax({
			url: '/ajax/categories.php',
			data: {
				PAGE       : page,
				SECTION_ID : $button.data('parent'),
				AJAX       : 1
			},
			dataType: 'json',
			success: function(msg)
			{
				$button.data('page', page).css({opacity: 1, 'pointer-events': 'auto'}).before(msg.html);

				if(o2)
					o2.lazyLoad.lazy.update();

				if(msg.nav.isLastPage)
					$button.hide();
			}
		});
	}
};