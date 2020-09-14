"use strict"
/**
 * Объект для работы со слайдерами
*/
const o2Sliders = 
{
	/**
	 * Инициализация всех слайдеров
	*/
	init()
	{
		this.mainSlider();
		this.productsCarousel('.products-carousel', 4);
		this.productsCarousel('.products-carousel_small', 6);
		this.sliderNews();
		this.initSlider('.simple-slider', 4, 3);
		this.bannersSLider();
		this.productDescriptionSlider();
		this.detailMobSlider();
		this.initSliderDefault('.catalog-carousel');
		this.initSliderDefault('.catalog-carousel_small');
		this.contactsSlider.init()
		this.contactsSlider.ClickOnItem()
	},
	setWidthOnWindowResize(sliderClass)
	{
		const setWidth = () => {
			if ($(window).width() < 440)
			{
				const calcMargin = -1 * ($(window).width() - $(sliderClass).width()) / 2;
				$(sliderClass).find('.slick-initialized').css('margin-right', calcMargin);
			}
			else
			{
				$(sliderClass).find('.slick-initialized').css('margin-right', '-20px');
				$(sliderClass).find('.simple-slider_news').css('margin-right', '-20px');
			}
		};
		$(window).resize(() =>
		{
			setWidth();
		});
		setWidth();
	},
	resizeSlider(myClass)
	{
		$(myClass).slick('init');
	},
	setSliderHelpers(slider)
	{
		$(slider)[0].slick.getNavigableIndexes = function ()
		{
			var _ = this,
				breakPoint = 0,
				counter = 0,
				indexes = [],
				max;

			if (_.options.infinite === false)
			{
				max = _.slideCount;
			}
			else
			{
				breakPoint = _.options.slideCount * -1;
				counter = _.options.slideCount * -1;
				max = _.slideCount * 2;
			}

			while (breakPoint < max)
			{
				indexes.push(breakPoint);
				breakPoint = counter + _.options.slidesToScroll;
				counter += _.options.slidesToScroll <= _.options.slidesToShow ? _.options.slidesToScroll : _.options.slidesToShow;
			}

			return indexes;
		}

		// fix lazyload content
		$(slider).on('beforeChange', () =>
		{
			o2.lazyLoad.lazy.update();
		});
	},
	productsCarousel(sliderClass, slidesCount)
	{
		if (!sliderClass.length) return false;

		$(sliderClass).each((index, slider) =>
		{
			if ($(slider).find('.product-carousel-slide-wr').length > 4)
			{
				const sliderContainer = $(slider).find('.products-carousel-wr');
				const isSmallSlider = slider == '.products-carousel_small' ? true : false
				const sliderOptions = {
					slidesToShow: slidesCount,
					slidesToScroll: isSmallSlider ? 5 : 3,
					infinite: true,
					arrows: true,
					swipe: true,
					prevArrow: $(sliderContainer).prev().find('.slider-prev'),
					nextArrow: $(sliderContainer).prev().find('.slider-next'),
					responsive: [
						{
							breakpoint: 1050,
							settings:
							{
								slidesToShow: 4,
								slidesToScroll: 3,
							}
						},
						{
							breakpoint: 768,
							settings:
							{
								slidesToShow: 3,
								slidesToScroll: 2,
								variableWidth: isSmallSlider ? false : true,
							}
						},
						{
							breakpoint: 440,
							settings:
							{
								slidesToShow: isSmallSlider ? 2 : 1,
								variableWidth: isSmallSlider ? false : true,
								slidesToScroll: 1,
							}
						}
					]
				};
				sliderContainer.slick(sliderOptions);
				this.setSliderHelpers(sliderContainer);
				this.setWidthOnWindowResize(slider);
			};
		});
	},
	mainSlider()
	{
		const mainSlider = $('.main-slider__wrapper');
		$(mainSlider).slick(
			{
				autoplay: true,
				dots: false,
				slidesToShow: 1,
				arrows: true,
				slidesToScrol: 1,
				prevArrow: $(mainSlider).parents('.main-slider').find('.slider-prev'),
				nextArrow: $(mainSlider).parents('.main-slider').find('.slider-next'),
				responsive:
					[
						{
							breakpoint: 1200,
							settings:
							{
								arrows: false
							}
						}
					]
			});
	},
	productDescriptionSlider()
	{
		if (!$('.detail-description__menu-mob-slider').length)
			return false;

		$('.detail-description__menu-mob-slider').slick({
			slidesToShow: 2,
			variableWidth: true,
			slidesToScroll: 1,
			mobileFirst: true,
			arrows: false,
			dots: false,
			responsive: [
				{
					breakpoint: 500,
					settings: 'unslick'
				}
			]
		});
		this.setSliderHelpers('.detail-description__menu-mob-slider');
		$(window).resize(function ()
		{
			if ($(window).width() <= 500)
			{
				o2Sliders.resizeSlider('.detail-description__menu-mob-slider');
			}
		});
	},
	bannersSLider()
	{
		if (!$('.banners').length) return false;
		$('.banners').slick({
			slidesToShow: 1,
			slidesToScroll: 1,
			mobileFirst: true,
			arrows: false,
			dots: true,
			responsive: [
				{
					breakpoint: 768,
					settings: 'unslick'
				}
			]
		});

		$(window).resize(function ()
		{
			if ($(window).width() <= 768)
			o2Sliders.resizeSlider('.banners')
		});
	},
	detailMobSlider()
	{
		$('.product-detail__slider-right').slick({
			slidesToShow: 1,
			slidesToScroll: 1,
			mobileFirst: true,
			arrows: false,
			dots: true,
			responsive: [
				{
					breakpoint: 768,
					settings: 'unslick'
				}
			]
		});

		$(window).resize(function ()
		{
			if ($(window).width() <= 768)
				o2Sliders.resizeSlider('.product-detail__slider-right')
		})
	},
	initSlider(item, quantity, mdQuantity)
	{

		o2.sliders.sliderOn(item, quantity, mdQuantity);

		$(window).resize( function()
		{
			if ($(window).width() > 475)
			{
				o2.sliders.sliderOn(item, quantity, mdQuantity)
			}
		});
	},
	sliderOn(item, quantity, mdQuantity)
	{
		const simpleSlider = $(item),
			itemsLength = $(item + ' ' + '.simple-slider__item').toArray().length;
		if(itemsLength > 3)
		{
			simpleSlider.not('.slick-initialized').slick(
			{
				autoplay: false,
				dots: false,
				slidesToShow: quantity,
				arrows: true,
				slidesToScrol: 1,
				prevArrow: $(item).prev().find('.simple-slider__prev'),
				nextArrow: $(item).prev().find('.simple-slider__next'),
				responsive:
				[
					{
						breakpoint: 768,
						settings:
						{
							slidesToShow: mdQuantity,
						}
					},
					{
						breakpoint: 475,
						settings: 'unslick'
					}
				]
			})
			this.setSliderHelpers(simpleSlider);
			$(simpleSlider).css('margin-right', '-20px');
		}
		else
		{
			$('.simple-slider__arrows_insta').hide()
		}
	},
	sliderNews()
	{
		let items = $('.simple-slider_news .simple-slider__item').toArray().length;
		if(items > 3)
		{
			$('.simple-slider_news').slick(
			{
				slidesToShow: 3,
				arrows: true,
				slidesToScrol: 1,
				prevArrow: $('.simple-slider_news').prev().find('.simple-slider__prev'),
				nextArrow: $('.simple-slider_news').prev().find('.simple-slider__next'),
				responsive:
				[
					{
						breakpoint: 768,
						settings:
						{
							slidesToShow: 2,
						}
					},
					{
						breakpoint: 475,
						settings:
						{
							slidesToShow: 1	,
							variableWidth: true
						}
					}
				]
			})
			this.setSliderHelpers('.simple-slider_news');
			this.setWidthOnWindowResize('.simple-slider__wrapper');
		}
		else
		{
			$('.simple-slider__arrows_news').hide()
			$('.simple-slider_news').addClass('few-images')
		}
	},
	initSliderDefault(sliderClass)
	{
		const isCatalogCarousel = sliderClass === '.catalog-carousel';

		$(sliderClass).each((index, slider) =>
		{
			const sliderContainer = $(slider).find('.products-carousel-wr');
			$(sliderContainer).slick(
				{
					autoplay: false,
					dots: false,
					slidesToShow: isCatalogCarousel ? 3 : 4,
					variableWidth: isCatalogCarousel ? false : true,
					arrows: true,
					slidesToScrol: 1,
					prevArrow: $(sliderContainer).prev().find('.slider-prev'),
					nextArrow: $(sliderContainer).prev().find('.slider-next'),
					responsive: [
						{
							breakpoint: 475,
							settings:
							{
								slidesToShow: isCatalogCarousel ? 1 : 2,
								variableWidth: isCatalogCarousel ? true : false
							}
						},
					]
				});
			this.setSliderHelpers(sliderContainer);
			this.setWidthOnWindowResize(slider);
		});
	},
	contactsSlider:
	{
		init()
		{
			$('.contacts__items').slick(
			{
				slidesToShow: 3,
				slidesToScrol: 1,
				dots: false,
				arrows: false,
				responsive: 
				[
					{
						breakpoint: 768,
						settings:
						{
							slidesToShow: 2,
						}
					},
					{
						breakpoint: 540,
						settings:
						{
							slidesToShow: 1,
							variableWidth: true
						}
					}
				]
			})
		},
		ClickOnItem()
		{
			let item = $('.contacts__wr .slick-slide');
			item.on('click', (e) =>
			{
				item.removeClass('slick-current');
				$(e.target).parents('.slick-slide').addClass('slick-current');
			})
		}
	}
}
