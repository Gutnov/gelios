var smartFilter = {
	url: '',
	filters: {},
	sorters: {},
	page: false,
	container: false,

	regex: {
		filters: /filter\/(.*?)\/apply/i,
		sorters: /sort\/(.*)/i,
		page: /nav\/page-(\d+)/i
	},

	init(container)
	{
		this.container = container;

		this.parseUrl();
	},

	changeSortersCheckbox(el)
	{
		if($(el).prop('checked'))
			this.sorters[$(el).attr('name')] = 'desc'
		else
			delete this.sorters[$(el).attr('name')];

		this.applyFilters();
	},

	changePriceSorter(el)
	{
		if($(el).hasClass('catalog-filter__sort-price--down'))
			this.sorters['price'] = 'asc';
		else
			this.sorters['price'] = 'desc';

		$(el).toggleClass('catalog-filter__sort-price--down');

		this.applyFilters();
	},

	changeFilterCheckbox(el, fieldCode)
	{
		if(!this.filters.hasOwnProperty(fieldCode))
			this.filters[fieldCode] = [];

		let value = encodeURI($(el).val());

		if($(el).prop('checked'))
			this.filters[fieldCode].push(value);
		else
		{
			let pos = this.filters[fieldCode].indexOf(value);

			if(pos >= 0)
			{
				this.filters[fieldCode].splice(pos, 1);

				if(!this.filters[fieldCode].length)
					delete this.filters[fieldCode];
			}
		}

		this.applyFilters();
	},

	changeFilterRadio(el, fieldCode)
	{
		if(!$(el).prop('checked'))
			return;

		this.filters[fieldCode] = [encodeURI($(el).val())];
		this.applyFilters();
	},

	changeFilterPrice(el)
	{
		let $parent = $(el).closest('.price-slider'),
			priceMin = parseFloat($parent.find('[name=price-min]').val()),
			priceMax = parseFloat($parent.find('[name=price-max]').val());

		this.filters['price'] = [priceMin, priceMax];
		this.applyFilters();
	},

	applyFilters()
	{
		window.location.pathname = this.makeUrl();
	},

	makeUrl()
	{
		let url = [this.url];

		let filters = [];
		for(let param in this.filters)
		{
			filters.push(param);
			filters.push(this.filters[param].join('-'));
		}

		if(filters.length)
			url = url.concat(['filter'], filters, ['apply']);

		let sorters = [];
		for(let param in this.sorters)
		{
			sorters.push(param);
			sorters.push(this.sorters[param]);
		}

		if(sorters.length)
			url = url.concat(['sort'], sorters);

		if(this.page)
			url = url.concat(['nav', `page-${this.page}`]);

		url.unshift('');
		url.push('');

		url = url.join('/');

		return url;
	},

	parseUrl()
	{
		let url = window.location.pathname;

		let filters = url.match(this.regex.filters);

		if(!!filters && filters.length)
		{
			filters = filters[1].split('/');

			for (let i = 0, j = filters.length; i < j; i += 2)
			{
				let filter = filters.slice(i,i+2);
				this.filters[filter[0]] = filter[1].split('-');
			}

			url = url.replace(this.regex.filters, '').replace(/\/{2,}/, '/');
		}
		url = url.replace(/^\//, '').replace(/\/$/, '');

		let page = url.match(this.regex.page);

		if(!!page && page.length)
		{
			page = page[1];

			if(!!page)
				this.page = page;

			url = url.replace(this.regex.page, '').replace(/\/{2,}/, '/');
		}
		url = url.replace(/^\//, '').replace(/\/$/, '');

		let sorters = url.match(this.regex.sorters);

		if(!!sorters && sorters.length)
		{
			sorters = sorters[1].split('/');

			for (let i = 0, j = sorters.length; i < j; i += 2)
			{
				let sorter = sorters.slice(i,i+2);
				this.sorters[sorter[0]] = sorter[1];
			}

			url = url.replace(this.regex.sorters, '').replace(/\/{2,}/, '/');
		}
		url = url.replace(/^\//, '').replace(/\/$/, '');

		this.url = url;
	}
};

$(function(){
	smartFilter.init($('.catalog-filter'));
});