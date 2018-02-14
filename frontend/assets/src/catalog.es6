'use strict';
$(document).ready(function() {


	/**
	 * События при скроле окна
	 */
	$(window).scroll(function() {

		// Если экран опустился ниже 1000px
		if ($(window).scrollTop() > 1000) {
			// показать кнопку 'scroll top'
			scrollTopButton.fadeIn(500);
		} else {
			// спрятать кнопку 'scroll top'
			scrollTopButton.fadeOut(200);
		}
		setPosScrollTopButton();

	});


	/**
	 * События при изменении размера окна
	 */
	$(window).resize(function() {
		// Произвести задержку перед выполненем ф-ии
		waitForFinalEvent(function() {
			// выполним ф-ию
			setPosArrow();
			setPosContacts();
			setPosScrollTopButton();
		}, 250, 'resizeTimer'); // здесь указана задержка в мс

	});

	/**
	 * Данная ф-я позволяет сделать задержку перед выполнением какой либо ф-и при масштабировании окна
	 */
	var waitForFinalEvent = (function() {
		var timers = {};
		return function (callback, ms, uniqueId) {
			if (!uniqueId) {
				uniqueId = "Don't call this twice without a uniqueId";
			}
			if (timers[uniqueId]) {
				clearTimeout(timers[uniqueId]);
			}
			timers[uniqueId] = setTimeout(callback, ms);
		};
	})();















	/*
	 * прячем поле поиск в меню
	 */
	var searchForm = $('#menu').find('.search');
	var searchField = searchForm.find('[type="text"]');
	var searchButton = searchForm.find('[type="submit"]');

	// добавляем класс unfocused,
	searchForm.addClass('unfocused');
	searchField.attr('placeholder', '');	// IE fix

	// добавим событие при нажатии кнопки поиска
	searchField.click(function() {
			if (searchForm.hasClass('unfocused')){
				searchButton.click();
			}
		}
	);

	searchButton.click(function(e) {
		
		if (searchForm.hasClass('unfocused')) {
			// при нажатии добавляем класс focused и убираем unfocused
			searchForm.removeClass('unfocused');
			searchForm.addClass('focused');

			// делаем фокус на поле поиска
			searchField.focus();

			// добавим событие для отслеживания нажатых элементов
			$(document).bind('click.hideSearch', function(el) {
				var clicked = $(el.target);
				// если нажали submit и он находится внутри элемента с классом search или нажато само текстовое поле поиска
				if ( (clicked.attr('type') === 'submit' && clicked.parents('.search').length > 0) || (clicked.attr('id') === 'search') ) {
					// выполним действие по-умолчанию
					return true;
				} else {
					searchForm.addClass('unfocused');
					searchForm.removeClass('focused');
					$(this).unbind('click.hideSearch');
				}
			});

			e.preventDefault();	//		— не даст сработать событию по-умолчанию. Например, если это применить к ссылке, то переход по ссылке не будет работать.
			// e.stopPropagation();	//	— не дает событию «всплывать вверх» (как-то сложно перевести термин bubbling up с английского). Это значит, что отменит событие не только у элемента, но и у любого родительского элемента.
			// return false;	//		— то же самое, что вызвать два предыдущих метода вместе.
		}
	});

















	/*
	 * настройки js columnize для категорий наверху страницы (#fast-menu)
	 */
	if (typeof $(this).columnize === 'function') {
		// $('#fast-menu').find('.subcategories').appendTo($('#fast-menu'));
		// $('#fast-menu').find('.subcategories').hide();

		$('#fast-menu').find('ul.native-columns >li').addClass('dontsplit');
		$('#fast-menu').find('ul.native-columns').css({
			// удалим css значения которые фиксят дерганье верстки при загрузке (см. catalog.sass)
			'column-count': 'auto',
			'-webkit-column-count': 'auto',
			'-moz-column-count': 'auto',
		});
		$('#fast-menu').find('ul.native-columns').columnize({
			width: 250,
			// columns : 4,
			buildOnce : false,
			lastNeverTallest : true,
		});

		// $('#fast-menu').find('.subcategories').appendTo($('#fast-menu').find('.active'));
	}






	/*
	 * настройки js columnize для категорий на странице 'приводная техника' (#product-tree)
	 */
	if (typeof $(this).columnize === 'function') {


		// $('#product-tree').find('ul.native-columns >li').css({'padding-left':'20%'});
		$('#product-tree').find('ul.native-columns >li').addClass('dontsplit');
		$('#product-tree').find('ul.native-columns').columnize({
			// width: 490,
			columns : 2,
			buildOnce : true,
			lastNeverTallest : true,
			/*doneFunc: function() {
				$('#product-tree').css({'padding':'0 5% .75rem 15%'});
			},*/
		});

		// отметить ветвь как активную когда наведен курсор на ссылку
		$('#product-tree').find('a').mouseover(function() {
			$(this).closest('li.dontsplit').addClass('hover');
		}).mouseleave(function() {
			$(this).closest('li.dontsplit').removeClass('hover');
		});

	}





	/*
	 * настройки js columnize для категорий в меню
	 */
	if (typeof $(this).columnize === 'function') {
		$('#products-list').find('.products-list-content').find('li.parent').addClass('dontsplit');
		$('#products-list').find('.products-list-content').find('>ul').removeClass('native-columns').columnize({
			columns : 3,
			buildOnce : true,
			doneFunc: function() {
				// $('#products-list').find('.products-list-content').css({'padding-left':'10%', 'padding-right':'1%'});
			},
		});
	}













	/*
	 * прячем древовидное меню продукции
	 */
  	// берем меню
	var menuProducts = $('#products-list');

	// прячем меню, добавляем css
	menuProducts.hide().addClass('closed').css({ 'position' : 'absolute' });

	var timerProducts;

	$('#menu .products a')
		.mouseover(function() {
			// если меню категорий скрыто
			if (menuProducts.hasClass('closed')){
				// открываем меню категорий
				setPosArrow();
				menuProducts.fadeIn().removeClass('closed');
				$(this).parent().addClass('opened');
			}
		});

	$('#menu .products, #products-list')
		.mouseover(function() {
			// удалим таймер если он есть
			clearTimeout(timerProducts);
		})
		// если курсор за пределами элементов категорий
		.bind('mouseleave.hideProducts', function() {
			// если меню категорий открыто
			if (!menuProducts.hasClass('closed')){
				timerProducts = setTimeout(function() {
					// скрыть меню категорий через N сек
					menuProducts.fadeOut(500).addClass('closed');
					$('#menu .products a').parent().removeClass('opened');
					$(this).unbind('mouseleave.hideProducts');
				}, 300);
			}
		});


	// добавляем и двигаем в правильное положение уголок меню продукции
	menuProducts.prepend($('<div class="menu-products-arrow" />'));
	function setPosArrow(){
		var arrow = $(menuProducts).find('.menu-products-arrow');
		var offsetElement = $('#menu').find('.products a');
		var offset = offsetElement.offset().left + offsetElement.width()/2 - 8;
		arrow.css({ 'left' : offset + 'px' });
	};













	/*
	 * прячем блок контактной информации
	 */
	var contacts = $('#contacts-info');

	// прячем контакты
	contacts.hide().addClass('closed');

	var timerContacts;

	$('#menu .contacts a')
		.mouseover(function() {
			// если контакты скрыты
			if (contacts.hasClass('closed')){
				// открываем контакты
				setPosContacts();
				contacts.fadeIn().removeClass('closed');
				$(this).parent().addClass('active');
			}
		})

	$('#menu, #contacts-info')
		.mouseover(function() {
			// удалим таймер если он есть
			clearTimeout(timerContacts);
		})
		// если курсор за пределами элементов контактов
		.bind('mouseleave.hideContacts', function() {
			// если контакты открыты
			if (!contacts.hasClass('closed')){
				timerContacts = setTimeout(function() {
					// скрыть контакты через N сек
					contacts.fadeOut(500).addClass('closed');
					$('#menu .contacts a').parent().removeClass('active');
					$(this).unbind('mouseleave.hideContacts');
				}, 500);
			}
		});

	/*
	 * позиционируем блок контактов
	 */
	function setPosContacts() {
		contacts.css({ 'left' : (getContentRightEdge() - contacts.outerWidth() + 17) + 'px' });
	}
















	/**
	 *	Добавляем кнопку 'scroll to up' на страницу
	 */
	var scrollTopButton = $('<a href="#" class="scrollTop">Наверх</a>')
		.appendTo('body')
		.click(function() {
			$('html, body').animate({scrollTop : 0}, 600);
			return false;
		});

	/**
	 *	Позиционируем кнопку 'scroll to up'
	 */
	function setPosScrollTopButton() {
		var scrollTopButtonWidth = scrollTopButton.outerWidth();

		function getLeftPos () {
			var windowWidth = $(window).width();
			var contentWidth = $('#wrap').outerWidth();

			// если ширина окна меньше чем ширина блока #wrap
			if (windowWidth < contentWidth)
				return windowWidth - scrollTopButtonWidth - 20;

			// если ширина окна больше чем ширина блока содержимого+кнопки
			if (windowWidth > (contentWidth + scrollTopButtonWidth + 120))
				return getContentRightEdge() + 20;

			// иначе
			return getContentRightEdge() - scrollTopButtonWidth - 20;
		}

		function getTopPos () {
			var windowScrollTop = $(window).scrollTop();
			var windowHeight = $(window).height();
			var footerTopEdge = $('#footer').position().top;

			// если страница ниже чем подвал #footer
			if ((windowScrollTop + windowHeight) > footerTopEdge)
				return windowScrollTop + windowHeight - footerTopEdge + 20;

			// иначе
			return '20';
			// return windowHeight - scrollTopButtonWidth - 20;
		}

		// this.getTopPos();

		scrollTopButton.css({
			'top' : 'auto',
			'bottom' : getTopPos() + 'px',
			// 'bottom' : '20px',
			'left' : getLeftPos() + 'px',
		});
	}
	setPosScrollTopButton();
















	/**
	 *	Берем правый край содержимого
	 */
	function getContentRightEdge() {
		return $('#wrap').offset().left +  $('#wrap').outerWidth();
	}






});