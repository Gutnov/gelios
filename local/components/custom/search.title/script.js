function JCTitleSearch(arParams)
{
	var _this = this;

	this.arParams = {
		'AJAX_PAGE': arParams.AJAX_PAGE,
		'CONTAINER_ID': arParams.CONTAINER_ID,
		'INPUT_ID': arParams.INPUT_ID,
		'MIN_QUERY_LEN': parseInt(arParams.MIN_QUERY_LEN)
	};
	if(arParams.WAIT_IMAGE)
		this.arParams.WAIT_IMAGE = arParams.WAIT_IMAGE;
	if(arParams.MIN_QUERY_LEN <= 0)
		arParams.MIN_QUERY_LEN = 1;

	this.cache = [];
	this.cache_key = null;

	this.startText = '';
	this.running = false;
	this.runningCall = false;
	this.currentRow = -1;
	this.RESULT = null;
	this.CONTAINER = null;
	this.INPUT = document.getElementById(arParams.INPUT_ID);
	this.WAIT = null;
	this.id;
	this.getContent = function()
	{
		BX.ajax.post(
			_this.arParams.AJAX_PAGE,
			{
				'ajax_call':'y',
				'INPUT_ID':_this.arParams.INPUT_ID,
				'q':_this.INPUT.value,
				'l':_this.arParams.MIN_QUERY_LEN
			},
			function(result)
			{
				if($(result).find("li").length > 0)
				{
					$(".search-input__items-wr").html(result);
					$(".search-input__items-wr").show();
					let clickOutsideListener = _this.clickOutside($('.search-input__items-wr'), (element) =>
					{
						$(".search-input__items-wr").hide();
					});
				}
				else
				{
					$(".search-input__items-wr").hide();
				}
			}
		);
	};
	this.clickOutside = function(element, callback)
	{
		var outsideChecker = (event) =>
		{
			var container = $(element);

			if (!container.is(event.target) && container.has(event.target).length === 0)
				{
					document.removeEventListener('click', outsideChecker);
					callback(container);
				}
		};

		document.addEventListener('click', outsideChecker);
		return outsideChecker;
	}
	this.update = function()
	{
		clearTimeout(_this.id);
		_this.id = setTimeout(
			function()
			{
				_this.getContent();
			},1000);
	};
	this.onFocusLost = function()
	{
		$(".search-input__items-wr").hide();
	};
	this.Init = function()
	{
		this.CONTAINER = document.getElementById(this.arParams.CONTAINER_ID);
		BX.addCustomEvent(this.CONTAINER, "OnNodeLayoutChange", this._onContainerLayoutChange);
		if(document.getElementsByClassName("search-input__items-wr").length == 0)
		{
			this.RESULT = document.getElementsByClassName("header")[0].appendChild(document.createElement("DIV"));
			this.RESULT.className = 'search-input__items-wr';
		}
		this.INPUT = document.getElementById(this.arParams.INPUT_ID);
		this.startText = this.oldValue = this.INPUT.value;
		this.INPUT.onkeydown = this.onKeyDown;

		if(this.arParams.WAIT_IMAGE)
		{
			this.WAIT = document.body.appendChild(document.createElement("DIV"));
			this.WAIT.style.backgroundImage = "url('" + this.arParams.WAIT_IMAGE + "')";
			if(!BX.browser.IsIE())
				this.WAIT.style.backgroundRepeat = 'none';
			this.WAIT.style.display = 'none';
			this.WAIT.style.position = 'absolute';
			this.WAIT.style.zIndex = '1100';
		}

		BX.bind(this.INPUT, 'bxchange', function()
			{_this.update()});
		// BX.bind(document, 'click', function()
		// 	{_this.onFocusLost()});

		var fixedParent = BX.findParent(this.CONTAINER, BX.is_fixed);
		if(BX.type.isElementNode(fixedParent))
		{
			BX.bind(window, 'scroll', BX.throttle(this.onScroll, 100, this));
		}
	}
	BX.ready(function ()
		{_this.Init(arParams)});
}

