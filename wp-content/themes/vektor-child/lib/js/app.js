/*
 * App
 */

function App(){

	var self = this,
		doc = $(document),
		win = $(window),

		windowHeight,
		windowWidth,
		chromeframeHeight,
		currentScroll,
		lastScroll,

		headerHeight,

		$html = $('html'),
		$body = $('body'),

		postsLoading = false,

		$header = $('#header'),
		$nav = $('#nav'),
		$content = $('#content'),
		$footer = $('#footer'),
		$chromeframe = $('.chromeframe'),

		isHome = $body.hasClass('home'),
		isExplorer = $html.hasClass('lt-ie9'),
		isMobile = (/Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent)),

		isTouch = Modernizr.touch;

	/*
	 * Init
	 */

	self.init = function(){
		win.bind('scroll', self.windowScroll);
		win.resize(self.windowResize);

		self.windowResize();
		self.windowScroll();
		self.load();
	}

	/*
	 * Load
	 */

	self.load = function(){

		self.imagesloaded();
		//self.flowtype();
		self.backgroundvideo();
		self.parallaximagescroll();
		self.slick();
		self.superslides();
		self.selecter();
		self.tabber();
		self.accordion();
		self.isotope();
		self.fancybox();
		self.googlemaps();

		win.load(function(){
			$body.addClass('state--window-loaded');
		});

		if(isTouch){
			$body.addClass('state--is-touch');
		}

		FastClick.attach(document.body);

	}

	/*
	 * Window scroll
	 */

	self.windowScroll = function(){
		currentScroll = win.scrollTop();

		if(currentScroll > headerHeight && !isExplorer){
			$body.addClass('state--scrolled');
		} else {
			$body.removeClass('state--scrolled');
		}

		if(currentScroll > lastScroll || currentScroll < headerHeight){
			$body.addClass('state--scrolled-down');
		} else {
			if(currentScroll < lastScroll - 10){
				$body.removeClass('state--scrolled-down');
			}
		}

		lastScroll = currentScroll;
	} // end self.windowScroll

	/*
	 * Window resize
	 */

	self.windowResize = function(){
		windowHeight = win.height();
		windowWidth = win.width();

		headerHeight = $header.outerHeight();
		footerHeight = $footer.outerHeight();

		chromeframeHeight = $chromeframe.outerHeight();

		// Set height on video (depending if it's explorer with chromeframe or not)
		if(!isExplorer){
			$('#video').height(windowHeight);
		} else {
			$('#video').height(windowHeight - chromeframeHeight);
		}

		if(windowWidth < 768){
			$('#nav').height(windowHeight - headerHeight);
		} else {
			$('#nav').height('100%');
		}

	} // end self.windowResize

	/*
	 * ImagesLoaded
	 * https://github.com/desandro/imagesloaded
	 */

	self.imagesloaded = function(){
		var imgLoad = imagesLoaded('body');
		imgLoad.on('always', function(){
			$body.addClass('state--images-loaded');
		});
	} // end self.imagesloaded

	/*
	 * FlowType
	 * https://github.com/simplefocus/FlowType.JS
	 */

	self.flowtype = function(){
		$('h1, h2, h3, h4, h5, h6').flowtype({
			minFont : 16,
			maxFont : 72,
			fontRatio: 25
		});
	} // end self.flowtype

	/*
	 * Parallax image scroll
	 * https://github.com/pederan/Parallax-ImageScroll
	 */

	self.parallaximagescroll = function(){
		$('.parallax-image').imageScroll({
			imageAttribute: (isTouch === true) ? 'image-mobile' : 'image',
			touch: isTouch
		});
	} // end self.parallaxsimagescroll

	self.isotope = function() {
		$('.isotope-container').isotope({
			itemSelector: '.isotope-item'
		});
	}

	/*
	 * Slick
	 * https://github.com/kenwheeler/slick
	 */

	self.slick = function(){
		$('.slick-slider').slick({
			autoplay: true,
			autoplaySpeed: 6000,
			dots: true
		});

		$('.logo-slider').slick({
			autoplay: false,
			autoplaySpeed: 6000,
			dots: false,
			slidesToShow: 5,
			slidesToScroll: 1,
			responsive: [
				{
					breakpoint: 1024,
					settings: {
						slidesToShow: 3
					}
				},
				{
					breakpoint: 600,
					settings: {
						autoplay: false,
						slidesToShow: 1
					}
				}
			]
		});

		$('.news-slider').slick({
		   	autoplay: true,
			autoplaySpeed: 6000,
			dots: false,
			slidesToShow: 3,
			slidesToScroll: 1,
			responsive: [
				{
					breakpoint: 1024,
					settings: {
						slidesToShow: 2
					}
				},
				{
					breakpoint: 600,
					autoplay: false,
					settings: {
						slidesToShow: 1
					}
				}
			]
		});
	} // end self.slick

	/*
	 * Superslides
	 * https://github.com/nicinabox/superslides
	 */

	self.superslides = function(){
		var $superslides = $('.superslides');

		// Loop trough each superslide
		$superslides.each(function(){
			var keys,
				play;

			// Enable key navigation and autoplay if there are more than one slide
			if($(this).find('.slides-container li').length > 1){
				keys = true;
				play = 6000;
			} else {
				keys = false;
				play = 0;
			}

			keys = $(this).attr('data-keys') ? $(this).attr('data-keys') : keys;
			play = $(this).attr('data-play') ? $(this).attr('data-play') : play;

			$(this).superslides({
				play: play,
				animation: "slide",
				pagination: true,
				keys: keys
			});
		});
	} // end self.superslides

	/*
	 * Selecter
	 * https://github.com/Formstone/Selecter
	 */

	self.selecter = function(){
		$('select').each(function(){
			var label = $(this).attr('data-label') ? $(this).attr('data-label') : '';
			$(this).selecter({
				label: label
			});
		});
	} // end self.selecter

	/*
	 * Tabber
	 * https://github.com/Formstone/Tabber
	 */

	self.tabber = function(){
		$(".tabbed").tabber();
	} // end self.tabber()

	/*
	 * Accordion
	 * http://jqueryui.com/accordion/
	 */

	self.accordion = function(){
		$('.accordion').accordion({
			collapsible: true,
			header: '.accordion-header',
			heightStyle: 'content'
		});
	} // end self.accordion

	/*
	 * fancyBox
	 * http://jqueryui.com/accordion/
	 */

	self.fancybox = function(){

		// init fancyBox
		$("a[href$='.jpg'],a[href$='.jpeg'],a[href$='.png'],a[href$='.gif'], .fancybox").attr('rel', 'gallery').fancybox({
			maxWidth: '90%',
			maxHeight: '90%',
			openEffect: 'none',
			closeEffect: 'none',
			nextEffect: 'none',
			prevEffect: 'none',
			helpers: {
				overlay: {
					speedOut: 0
				}
			}
		});

		// fancyBox loading extension
		loadingExtension = {
			oldShowLoading: $.fancybox.showLoading,
			oldHideLoading: $.fancybox.hideLoading,
			showLoading: function () {
				H = $("html");
				W = $(window);
				D = $(document);
				F = $.fancybox;
				var el, viewport;

				F.hideLoading();
				el = $('<div id="fancybox-loading"><div class="spinner"><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div></div></div>').click(F.cancel).appendTo('body');

				// If user will press the escape-button, the request will be canceled
				D.bind('keydown.loading', function (e) {
					if ((e.which || e.keyCode) === 27) {
						e.preventDefault();

						F.cancel();
					}
				});

				if (!F.defaults.fixed) {
					viewport = F.getViewport();

					el.css({
						position: 'absolute',
						top: (viewport.h * 0.5) + viewport.y,
						left: (viewport.w * 0.5) + viewport.x
					});
				}

				F.trigger('onLoading');
			},
			hideLoading: function () {
				$(document).unbind('.loading');
				$('#fancybox-loading').remove();
			}

		};

		$.extend($.fancybox, loadingExtension);

	} // end self.fancybox

	/*
	 * Background Video
	 * https://github.com/Victa/HTML5-Background-Video
	 */

	self.backgroundvideo = function(){

		// Exclude the iPad
		Modernizr.addTest('ipad', function () {
			return !!navigator.userAgent.match(/iPad/i);
		});

		// Exclude the iPhone
		Modernizr.addTest('iphone', function () {
			return !!navigator.userAgent.match(/iPhone/i);
		});

		// Exclude the iPod touch
		Modernizr.addTest('ipod', function () {
			return !!navigator.userAgent.match(/iPod/i);
		});

		// Exclude android phones and tablets
		Modernizr.addTest('android', function () {
			return !!navigator.userAgent.match(/android/i);
		});

		// Add a  test to Modernizr combining all platforms
		Modernizr.addTest('excludedplatforms', function () {
			return (Modernizr.ipad || Modernizr.ipod || Modernizr.iphone || Modernizr.android);
		});

		// Specified platforms won't be able to play background video,
		// But we serve them a nice extensible background image (see CSS).
		if (!Modernizr.excludedplatforms) {

			Modernizr.load({

				// If the platform can play any of these video types…
				test: Modernizr.video.webm || Modernizr.video.h264 || Modernizr.video.ogg,

				complete: function(){

					new $.backgroundVideo($('#video'), {
						"align": "centerXY",
						"width": 1280,
						"height": 720,
						"startOnLoad": true,
						"path": vektor.themepath + "/lib/media/",
						"filename": "video",
						"types": ["mp4", "webm"]
					});

					// Mute the video
					$('#video').find('video').attr('muted', '');

				} // end complete: funciton()

			}); // end Modernizr.load()

		} // end if (!Modernizr.excludedplatforms)

	} // end self.backgroundvideo

	/*
	 * Google maps
	 * https://developers.google.com/maps/documentation/
	 */

	self.googlemaps = function(){

		if(!vektor.contact_location)
            return;

        var $map = $('#map-canvas'),
            zoomControl = true;

        if($map.length > 0){
            google.maps.event.addDomListener(window, 'load', initialize);
        }

		function initialize() {

			/*
			 * Google Map Styles
			 * Styled Map Wizard: http://gmaps-samples-v3.googlecode.com/svn/trunk/styledmaps/wizard/index.html
			 */

			var styles = [
				{
					"elementType": "geometry",
					"stylers": [
						{ "saturation": -100 },
						{ "lightness": 30 },
					]
				}, {
					"elementType": "labels.text",
					"stylers": [
						{ "color": "#666666" },
						{ "weight": 0.2 }
					]
				}, {
					"featureType": "road",
					"elementType": "geometry",
					"stylers": [
						{ "visibility": "simplified" }
					]
				}, {
					"featureType": "road",
					"elementType": "labels.icon",
					"stylers": [
						{ "visibility": "off" }
					]
				}
			];

			var latLng = new google.maps.LatLng(vektor.contact_location.lat, vektor.contact_location.lng);

			/*
			 * Map Options
			 * https://developers.google.com/maps/documentation/javascript/reference?hl=sv#MapOptions
			 */

			var mapOptions = {
				center: latLng,
				mapTypeId: google.maps.MapTypeId.ROADMAP,
				panControl: false,
				streetViewControl: false,
				scrollwheel: false,
				zoomControl: false,
				styles: styles,
				zoom: 15,
				mapTypeControl: false,
				mapTypeControlOptions: {
					position: google.maps.ControlPosition.TOP_LEFT
				}
			}

			// Create map
			var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);


			// Set infoWindow content
			var infoWindowContent = "<div class='infowindow-content'>" +
				"<h3 class='h4'>" + vektor.contact_name + "</h3>" +
				"<ul>" +
				"<li>" + vektor.contact_address + "</li>" +
				"<li>" + vektor.contact_phone + "</li>" +
				"<li>" + vektor.contact_zip + " " + vektor.contact_city + "</li>" +
				"<ul>" +
				"</div>";

			// Create infoWindow
			var infoWindow = new google.maps.InfoWindow({
				content: infoWindowContent
			});

			// Create marker
			var marker = new google.maps.Marker({
				position: latLng,
				map: map,
				icon: Modernizr.svg ? vektor.themepath + "/lib/img/pin.svg" : vektor.themepath + "/lib/img/pin.png"
			});

			// Open infoWindow when click on marker
			google.maps.event.addListener(marker, 'click', function() {
				infoWindow.open(map, marker);
			});

		} // end initialize()

	} // end self.googlemaps


	$('.news-section .load_more').on('click',function(e){
		e.preventDefault();

		if(!postsLoading) {
			postsLoading = true;
			self.getPosts();
		}
	});

	self.getPosts = function() {
		var $load_more_btn = $('.load_more'),
			posts = $('.news-section').attr('data-amount'),
			nonce = $load_more_btn.attr('data-nonce'),
			offset = $('.news-section article.article').length;


		$load_more_btn.addClass('loading').find('i').addClass('fa-spin');

		$.ajax({
			type : "post",
			context: this,
			dataType : "json",
			url : vektor.ajaxurl,
			data : {action: "load_more", offset:offset, nonce:nonce, posts_per_page:posts},
			success: function(response) {
				if (response['have_posts'] == 1){
					var $newElems = $(response['html']);
					var $container = $('.isotope-container');
					$container.append($newElems).isotope('appended', $newElems).isotope('layout');
					//If there are no more posts left
					if (!response['have_posts_next']){
						$load_more_btn.fadeOut();
					}

				} else {
					$load_more_btn.fadeOut();
				}
				$load_more_btn.removeClass('loading').find('i').removeClass('fa-spin');
				postsLoading = false;
			},
			error: function(msg) {
				postsLoading = false;
			}
		});

	}


	/*
	 * Toggle
	 */

	$('#toggle').click(function(e){
		e.preventDefault();
		if(!$nav.hasClass('open')){
			$body.addClass('state--nav-open').removeClass('state--nav-closed');;
			$nav.stop().slideDown().addClass('open');
		} else {
			$body.removeClass('state--nav-open').addClass('state--nav-closed');
			$nav.stop().slideUp().removeClass('open');
		}
	});

	/*
	 * Scroll To
	 */

	$('.scroll-to').on('click',function(e){
		e.preventDefault();
		var target = this.hash,
			$target = $(target),
			currentHeaderHeight = $('#header').outerHeight();
		$.scrollTo($target, 600, {
			offset: -currentHeaderHeight,
			easing: 'easeOutQuart'
		});
	});

	$('.scroll-to-next').on('click',function(e){
		e.preventDefault();

		var that = $(this),
			thisSection = that.parents('section'),
			nextSection = thisSection.next('section'),
			currentHeaderHeight = $('#header').outerHeight();
		
		if(!nextSection.length > 0){
			nextSection = $('#footer');
		}
		
		$.scrollTo(nextSection, 600, {
			offset: -currentHeaderHeight,
			easing: 'easeOutQuart'
		});

	});

	/*
	 * Scroll Top
	 */

	$('.scroll-top').on('click', function(e){
		e.preventDefault();
		$.scrollTo(0, 600, { easing: 'easeOutQuart' });
	});

}

/*
 * Document ready
 */

$(document).ready(function(){

	var app = new App();
	app.init();

});