
(function($) {

	'use strict';

	//////////////////////////////////////////////////////////////////////////////////////////////////////
	// HEADER
	//////////////////////////////////////////////////////////////////////////////////////////////////////
	var headerSettings = {

		selector   : '#grve-inner-header',
		container  : '#grve-header',

		init: function(){
			if(!$(this.container).length) {
				return;
			}
			// Add Helper wrapper for sticky header.
			var $selector = $(this.selector);
			$selector.wrap('<div id="grve-header-wrapper"></div>');
			$selector.css({ 'top' : 0 });
			headerSettings.stickyHeader();

			// Fixed Header integration with top bar
			headerSettings.fixedHeader();
			$(window).smartresize( function() {
				headerSettings.fixedHeader();
			});
		},
		stickyHeader: function(){
			var $selector        = $(this.selector),
				innerHeight      = $selector.height(),
				stickyStyle      = $(this.container).attr('data-sticky-header'),
				headerOffset     = $selector.offset().top,
				safeButtonHeight = $selector.find('.grve-open-button').outerHeight();
			// General Setting
			if( stickyStyle != 'none' ) {
				if( headerOffset === 0 ) {
					$selector.css({ 'position' : 'fixed', 'top' : 0 });
				}
				$(window).on('scroll', function() {
					headerSettings.stickySettings( headerOffset );
					if( stickyStyle == 'shrink' ) {
						headerSettings.shrinkSettings( innerHeight, headerOffset, safeButtonHeight );
					}
				});
			}
		},
		stickySettings: function( headerOffset ){
			var scroll     = $(window).scrollTop(),
				$selector  = $(this.selector),
				$container = $(this.container);
			if( scroll > headerOffset ){
				$container.addClass('grve-header-sticky');
				$selector.css({ 'position' : 'fixed', 'top' : wpBarHeight });
			} else {
				$container.removeClass('grve-header-sticky');
				if( headerOffset > 0 ) {
					$selector.css({ 'position' : 'absolute', 'top' : 0 });
				}
			}
		},
		shrinkSettings: function( innerHeight, headerOffset, safeButtonHeight ){
			var scroll     = $(window).scrollTop(),
				$selector  = $(this.selector);
			if( scroll > headerOffset + innerHeight *4 ) {
				$selector.css({ 'height' : innerHeight/2, 'line-height' : innerHeight/2 + 'px' });
				$selector.find('h1.grve-logo img').css({ 'max-height' : innerHeight/2});
				if( safeButtonHeight > innerHeight/2 ) {
					$selector.find('.grve-open-button').css({ 'height' : innerHeight/2, 'line-height' : innerHeight/2 + 'px' });
				}
			} else {
				$selector.css({ 'height' : innerHeight, 'line-height' : innerHeight + 'px' });
				$selector.find('h1.grve-logo img').css({ 'max-height' : innerHeight});
				if( safeButtonHeight > innerHeight/2 ) {
					$selector.find('.grve-open-button').css({ 'height' : safeButtonHeight, 'line-height' : safeButtonHeight + 'px' });
				}
			}
		},
		fixedHeader: function(){
			var $header        = $(this.container),
				$topBar        = $('#grve-top-bar'),
				integration    = $header.data('overlap'),
				headerPosition = $header.data('header-position');

			if( $topBar.length && integration == 'yes' && headerPosition == 'above-feature'  ){
				var topBarHeight = $topBar.outerHeight(),
					$headerWrapper = $('#grve-header-wrapper');

				$headerWrapper.css('top',topBarHeight);
			}
		}
	};
	//////////////////////////////////////////////////////////////////////////////////////////////////////
	// MAIN MENU
	//////////////////////////////////////////////////////////////////////////////////////////////////////
	var  mainMenu = {

		menu      : '#grve-main-menu',
		menuItem  : '#grve-main-menu li',

		init: function() {
			$(this.menuItem).mouseenter(function() {
				var itemHover = $(this);
				// Mega Menu Position
				mainMenu.menuPosition(itemHover);

				if( itemHover.hasClass('megamenu') ) {
					itemHover.find( ' > ul ' ).addClass('active');
				} else {
					itemHover.find( ' > ul > li > a' ).addClass('active');
				}
			});
			$(this.menuItem).mouseleave(function() {
				var itemHover = $(this);
				if( itemHover.hasClass('megamenu') ) {
					itemHover.find( ' > ul ' ).removeClass('active');
				} else {
					itemHover.find( ' > ul > li > a' ).removeClass('active');
				}
			});
			$(this.menuItem).find( ' > a[href=#]').on('click',function(e){
				e.preventDefault();
			});
			mainMenu.responsiveMenu();
		},
		menuPosition: function(item){
			var containerWidth  = $(this.menu).parent().outerWidth(),
				subMenu         = item.find(' > ul '),
				subMenuWidth    = subMenu.width(),
				windowWidth     = $(window).width(),
				menuPositionX   = item.offset().left;
			if( (menuPositionX + subMenuWidth) > ( windowWidth - containerWidth )/2 + containerWidth ) {
				if( item.hasClass('megamenu')) {
					subMenu.css('left', - ((menuPositionX + subMenuWidth) - (( windowWidth - containerWidth )/2 + containerWidth )) +'px' );
				} else {
					subMenu.addClass('grve-position-right');
				}
			}
		},
		responsiveMenu: function(){
			var menu          = $('#grve-main-menu-responsive'),
				btnOpenMenu   = $('.grve-menu-button'),
				btnCloseMenu  = $('.grve-close-menu-button'),
				themeWrapper  = $('#grve-theme-wrapper'),
				menuLinks     = menu.find('a[href*=#]:not( [href=#] )');

			btnOpenMenu.click(function(e){
				e.preventDefault();
				themeWrapper.toggleClass('grve-slide-left');
				menu.toggleClass('grve-slide-left');
			});
			btnCloseMenu.click(function(e){
				e.preventDefault();
				themeWrapper.removeClass('grve-slide-left');
				menu.removeClass('grve-slide-left');
			});
			themeWrapper.click(function(e){
				if ( !menu.is(e.target) && menu.has(e.target).length === 0 && !btnOpenMenu.is(e.target) && btnOpenMenu.has(e.target).length === 0  ) {
					themeWrapper.removeClass('grve-slide-left');
					menu.removeClass('grve-slide-left');
				}
			});
			menuLinks.click(function(e) {
				setTimeout(function(){
					themeWrapper.removeClass('grve-slide-left');
					menu.removeClass('grve-slide-left');
				}, 1000);
			});
		}
	};
	//////////////////////////////////////////////////////////////////////////////////////////////////////
	// FEATURE SECTION SETTINGS
	//////////////////////////////////////////////////////////////////////////////////////////////////////
	var featureSection = {

		container         : '#grve-feature-section .grve-feature-section-inner',
		featureItem       : $( '#grve-feature-section .grve-feature-section-inner' ).attr('data-item'),
		fullScreenMode    : $('#grve-header').attr('data-fullscreen'),

		init: function(){
			if( this.featureItem == 'image' || this.featureItem == 'slider' || this.featureItem == 'video' ) {
				featureSection.featureImageLoad();
			}
			if( this.fullScreenMode == 'yes' ){
				featureSection.fullScreen();
				$(window).smartresize( function() {
					featureSection.fullScreen();
				});
			} else {
				featureSection.customSize();
			}
		},
		fullScreen: function(){
			var windowHeight    = $(window).height(),
				headerHeight    = $('#grve-header').attr('data-overlap') == 'yes' ? 0 : $('#grve-inner-header').height(),
				topBarHeight    = $('#grve-header').attr( 'data-topbar' ) == 'yes' ? $('#grve-top-bar').height() : 0,
				$section        = $(this.container);
			if( isMobile.any() &&  window.location !== window.parent.location ) {
				windowHeight  = window.screen.height;
			}
			var sectionHeight = windowHeight - headerHeight - wpBarHeight - topBarHeight;
			$section.css({ 'height' : sectionHeight });
			$section.parent().css({ 'height' : sectionHeight });
			if( this.featureItem == 'slider' ) {
				$section.find('.grve-slider-item ').css({ 'height' : sectionHeight });
			}
			if( this.featureItem == 'map' ) {
				$section.find('.grve-map ').css({ 'height' : sectionHeight });
			}
			if( this.featureItem == 'video' ) {
				// Add Animation Class
				$(featureSection.container).addClass('animated');
				videoResize.init( { selector : $section.find('.grve-bg-video'), container : $section } );
				$(window).smartresize( function() {
					videoResize.init( { selector : $section.find('.grve-bg-video'), container : $section } );
				});
			}
			if(this.featureItem == 'title') {
				// Add Animation Class
				$(featureSection.container).addClass('animated');
			}
		},
		customSize: function(){
			var $section       = $(this.container),
				customHeight   = $section.attr('data-height');
			featureSection.resizeFeature( $section, customHeight );
			$(window).smartresize( function() {
				featureSection.resizeFeature( $section, customHeight );
			});
			if(this.featureItem == 'title') {
				// Add Animation Class
				$(featureSection.container).addClass('animated');
			}
			if(this.featureItem == 'video') {
				// Add Animation Class
				$(featureSection.container).addClass('animated');
			}
		},
		resizeFeature: function( section, customHeight ){
			if( $(window).width() >= 1200 ) {
				section.css({ 'height' : customHeight });
				section.parent().css({ 'height' : customHeight });
				if( this.featureItem == 'slider' ) {
					section.find('.grve-slider-item ').css({ 'height' : customHeight });
				}
				if( this.featureItem == 'map' ) {
					section.find('.grve-map ').css({ 'height' : customHeight });
				}
			} else {
				var ratio          = customHeight / 1200,
					resizeHeight   = parseInt($(window).width() * ratio);
				section.css({ 'height' : resizeHeight });
				section.parent().css({ 'height' : resizeHeight });
				if( this.featureItem == 'slider' ) {
					section.find('.grve-slider-item ').css({ 'height' : resizeHeight });
				}
				if( this.featureItem == 'map' ) {
					section.find('.grve-map ').css({ 'height' : resizeHeight });
				}
			}
		},
		featureImageLoad: function(){
			var $bgImage       = $(this.container).find('.grve-bg-image'),
				totalBgImage   = $bgImage.length;
			if (!totalBgImage) {
				return;
			}
			var waitImgDone = function() {
				totalBgImage--;
				if (!totalBgImage) {
					if( $(featureSection.container).find( '.grve-slider').length ) {
						featureSlider.init();
					} else {
						$bgImage.addClass('show');
						// Add Animation Class
						$(featureSection.container).addClass('animated');

						// Zoom Image Effect
						if( $(featureSection.container).data('bg-effect') == 'zoom') {
							sectionSettings.animatedBg( $(featureSection.container) );
						}
					}
				}
			};
			$bgImage.each(function () {
				function imageUrl(input) {
					return input.replace(/"/g,"").replace(/url\(|\)$/ig, "");
				}
				var image = new Image(),
					$that = $(this);
				image.src = imageUrl($that.css('background-image'));
				$(image).load(waitImgDone).error(waitImgDone);
			});
		}
	};
	//////////////////////////////////////////////////////////////////////////////////////////////////////
	// FEATURE SLIDER
	//////////////////////////////////////////////////////////////////////////////////////////////////////
	var featureSlider = {
		init: function(){
			var owl             = $('#grve-feature-slider'),
				sliderItem      = owl.find('.grve-slider-item '),
				sliderSpeed     = ( parseInt( owl.attr('data-slider-speed') ) ) ? parseInt( owl.attr('data-slider-speed') ) : 3500,
				pauseHover      = owl.attr('data-slider-pause') == 'yes' ? true : '',
				transition      = owl.attr('data-slider-transition') != 'slide' ? owl.attr('data-slider-transition') : false;
			// Init Slider
			owl.owlCarousel({
				navigation      : false,
				pagination      : false,
				autoHeight      : false,
				slideSpeed      : 400,
				paginationSpeed : 400,
				afterAction     : featureSlider.afterAction,
				singleItem      : true,
				autoPlay        : true,
				stopOnHover     : pauseHover,
				baseClass       : 'grve-slider',
				theme           : 'grve-slider-style',
				transitionStyle : transition
			});
			owl.trigger('owl.play',sliderSpeed);
			// Slider Navigation
			owl.parent().find('.grve-carousel-next').click(function(){
				owl.trigger('owl.next');
			});
			owl.parent().find('.grve-carousel-prev').click(function(){
				owl.trigger('owl.prev');
			});
			sliderItem.find('.grve-bg-image').addClass('show');
			$(window).on('scroll', function() {
				var $scroll = $(window).scrollTop();
				if( $scroll > 10 ){
					owl.trigger('owl.stop');//Stop Carousel
				} else {
					owl.trigger('owl.play',sliderSpeed);//Play Carousel
				}
			});

			if ( !Modernizr.csstransforms3d ) {
				sliderItem.find('.grve-bg-image').css({ 'width' : $(window).width() });
				$(window).smartresize( function() {
					sliderItem.find('.grve-bg-image').css({ 'width' : $(window).width() });
				});
			}
		},
		afterAction: function(){
			var currentSlide     = this.$owlItems.eq(this.currentItem),
				sliderColor      = currentSlide.find('.grve-slider-item').attr('data-style'),
				color            = 'grve-' + sliderColor;
			// Add Animation Class
			if ( !Modernizr.csstransforms3d ) {
				currentSlide.fadeIn('slow').addClass('animated').siblings().hide().removeClass('animated');
			} else {
			currentSlide.addClass('animated').siblings().removeClass('animated');
			}
			// Set Header Color
			$('#grve-header').removeClass().addClass(color);
		}
	};
	//////////////////////////////////////////////////////////////////////////////////////////////////////
	// VIDEO RESIZE
	//////////////////////////////////////////////////////////////////////////////////////////////////////
	var videoResize = {
		init: function(settings){

			videoResize.config = {
				selector   : '.grve-section .grve-bg-video',
				container  : '.grve-section'
			},

			// allow overriding the default config
			$.extend(videoResize.config, settings);

			var $video            = $(videoResize.config.selector).find('video'),
				videoWidth        = $video.width(),
				videoHeight       = $video.height(),
				containerWidth    = $(videoResize.config.container).outerWidth(),
				containerHeight   = $(videoResize.config.container).outerHeight(),
				newSize           = videoResize.settings( containerWidth, containerHeight, videoWidth, videoHeight );

			$video.width(newSize.newWidth).height(newSize.newHeight);
		},
		settings: function( containerWidth, containerHeight, videoWidth, videoHeight ){
			var initW = videoWidth,
				initH = videoHeight,
				ratio = initH / initW;
			videoWidth   = containerWidth;
			videoHeight  = containerWidth * ratio;
			if(videoHeight < containerHeight){
				videoHeight  = containerHeight;
				videoWidth   = videoHeight / ratio;
			}
			return {
				newWidth: parseInt(videoWidth),
				newHeight: parseInt(videoHeight)
			};
		}
	};
	//////////////////////////////////////////////////////////////////////////////////////////////////////
	// SECTION SETTINGS
	//////////////////////////////////////////////////////////////////////////////////////////////////////
	var sectionSettings = {

		config : {
			section       : '#grve-main-content .grve-section',
			parentSection : '#grve-content-area, #grve-post-area, #grve-portfolio-area'
		},

		init: function(){

			$(sectionSettings.config.section).each(function(){
				var $section      = $(this),
					heightMode    = $section.attr('data-full-height'),
					sectionType   = $section.attr('data-section-type'),
					bgImageType   = $section.attr('data-image-type');

				if( $section.parent().parent().is('.grve-blog-item') ) {
					$section.css({ 'visibility': 'visible' });
					return;
				}
				if( sectionType == 'fullwidth-background' ){
					sectionSettings.fullBg($section);
					$(window).smartresize( function() {
						sectionSettings.fullBg($section);
					});
				}
				if( sectionType == 'fullwidth-element' ){
					sectionSettings.fullElement($section);
					$(window).smartresize( function() {
						sectionSettings.fullElement($section);
					});
				}
				if( heightMode == 'yes' ) {
					sectionSettings.fullHeight($section);
					$(window).smartresize( function() {
						sectionSettings.fullHeight($section);
					});
				}
				if( bgImageType == 'animated' && !isMobile.any() ) {
					sectionSettings.animatedBg($section);
				}

			});

		},
		fullBg: function(section){
			var windowWidth      = $(window).width(),
				contentWidth     = $(sectionSettings.config.parentSection).outerWidth(),
				sidebarWidth     = $('#grve-sidebar').length && ( windowWidth + scrollBarWidth >= 1024 ) ? $('#grve-sidebar').outerWidth() : 0,
				conteinerWidth   = contentWidth + sidebarWidth,
				space            = (windowWidth - conteinerWidth)/2,
				sidebarSpace     = windowWidth - contentWidth;
			if( $('.grve-right-sidebar').length && ( windowWidth + scrollBarWidth >= 1024 ) ) {
				section.css({ 'visibility': 'visible', 'padding-left':space, 'padding-right': sidebarSpace, 'margin-left': -space, 'margin-right': -sidebarSpace});
			}
			else if( $('.grve-left-sidebar').length && ( windowWidth + scrollBarWidth >= 1024 ) ) {
				section.css({ 'visibility': 'visible', 'padding-left':sidebarSpace, 'padding-right': space, 'margin-left': -sidebarSpace, 'margin-right': -space});
			} else {
				section.css({ 'visibility': 'visible', 'padding-left':space, 'padding-right': space, 'margin-left': -space, 'margin-right': -space});
			}
		},
		fullElement: function(section){
			var windowWidth      = $(window).width(),
				contentWidth     = $(sectionSettings.config.parentSection).outerWidth(),
				sidebarWidth     = $('#grve-sidebar').length && ( windowWidth + scrollBarWidth >= 1024 ) ? $('#grve-sidebar').outerWidth() : 0,
				conteinerWidth   = contentWidth + sidebarWidth,
				space            = (windowWidth - conteinerWidth)/2,
				sidebarSpace     = windowWidth - contentWidth;
			if( $('.grve-right-sidebar').length && ( windowWidth + scrollBarWidth >= 1024 ) ) {
				section.css({ 'visibility': 'visible', 'padding-left':0, 'padding-right': sidebarSpace, 'margin-left': -space, 'margin-right': -sidebarSpace});
			}
			else if( $('.grve-left-sidebar').length && ( windowWidth + scrollBarWidth >= 1024 ) ) {
				section.css({ 'visibility': 'visible', 'padding-left':sidebarSpace, 'padding-right': 0, 'margin-left': -sidebarSpace, 'margin-right': -space});
			} else {
				section.css({ 'visibility': 'visible', 'padding-left':0, 'padding-right': 0, 'margin-left': -space, 'margin-right': -space});
			}
		},
		fullHeight: function(section){
			var windowHeight    = $(window).height(),
				headerHeight    = $('#grve-header').attr('data-sticky-header') != 'none' ? $('#grve-inner-header').outerHeight() : 0,
				fieldBarHeight  = $('.grve-fields-bar').length ? $('.grve-fields-bar').outerHeight() : 0,
				sectionHeight   = section.find('.grve-row').outerHeight(),
				space           = (windowHeight - headerHeight - fieldBarHeight - sectionHeight)/2;
			section.css({ 'visibility': 'visible',  'padding-top' : 0, 'padding-bottom' : 0});
			if(sectionHeight > (windowHeight - headerHeight)){
				section.css({ 'visibility': 'visible', 'padding-top':40, 'padding-bottom': 40});
			} else {
				section.css({ 'visibility': 'visible', 'padding-top':space, 'padding-bottom': space});
			}
		},
		animatedBg: function(section){
			section.mouseenter(function() {
				section.addClass('zoom');
			});
			section.mouseleave(function() {
				section.removeClass('zoom');
			});
		}
	};
	//////////////////////////////////////////////////////////////////////////////////////////////////////
	// CONTENT SETTINGS
	//////////////////////////////////////////////////////////////////////////////////////////////////////
	var pageSettings = {
		init: function() {

			// HOVERS
			pageSettings.hovers();

			// BACKGROUND LOAD
			pageSettings.bgLoader();

			// LIGHT BOX
			pageSettings.lightBox();

			// Social Share
			pageSettings.socialShareLinks();

			// Post Socials
			pageSettings.postSocials();

			// Animation Title
			pageSettings.titleAnimation();

			// Fit Video
			pageSettings.fitVid();

			// Resize Page, Post, Portfolio Title
			pageSettings.resizeTitle();

			// Anchor Bar
			pageSettings.anchorBar();

			// Back to top
			pageSettings.backtoTop();

			// Goto Section
			pageSettings.gotoSection();

			// Sticky Sidebar
			pageSettings.stickySidebar();

			// Footer Settings
			pageSettings.footerSettings();

			// Grve Pop up
			pageSettings.grvePopup();

			// Image Load
			pageSettings.imageLoader();

		},
		hovers: function(){
			var hoverItem = $('.grve-image-hover');
			if ( !isMobile.any() ) {
				hoverItem.unbind('click');
				hoverItem.unbind('mouseenter mouseleave').bind('mouseenter mouseleave', function() {
					$(this).toggleClass('hover');
				});
			} else {
				hoverItem.unbind('mouseenter mouseleave');
				hoverItem.unbind('click').bind('click', function() {
					hoverItem.removeClass('hover');
					$(this).toggleClass('hover');
				});
			}
		},
		bgLoader: function() {
			$('#grve-main-content .grve-bg-image').each(function () {
				var opacity = 1;
				if ( $(this).parents('.grve-section-effect').length ) {
					opacity = 0.6;
					var videoElement = $(this).parent().find('.grve-bg-video');
					$(this).parent().find('.grve-bg-video source').each(function(){
						if ( videoElement.get(0).canPlayType( $(this).attr('type') ) ) {
							opacity = 0;
						}
					});
				}
				function imageUrl(input) {
					return input.replace(/"/g,"").replace(/url\(|\)$/ig, "");
				}
				var image = new Image(),
					$that = $(this);
				image.src = imageUrl($that.css('background-image'));
				image.onload = function () {
					$that.addClass('show');
				};
			});

		},
		lightBox: function(){
			//IMAGE
			$('.grve-image-popup').each(function() {
				$(this).magnificPopup({
					type: 'image',
					preloader: false,
					fixedBgPos: true,
					fixedContentPos: true,
					removalDelay: 1200,
					callbacks: {
						beforeOpen: function() {
							var mfpWrap = this.wrap;
							this.bgOverlay.fadeIn(200);
							pageSettings.addSpinner( mfpWrap );
						},
						imageLoadComplete: function() {
							var $spinner = this.wrap.find('.grve-loader'),
								$content = this.container;
							pageSettings.removeSpinner( $spinner, $content );

						},
						beforeClose: function() {
							this.wrap.fadeOut(600);
							this.bgOverlay.fadeOut(600);
						},
					},
					image: {
						verticalFit: true
					}
				});
			});
			$('.grve-gallery-popup, .grve-post-gallery-popup').each(function() {
				$(this).magnificPopup({
					delegate: 'a',
					type: 'image',
					preloader: false,
					fixedBgPos: true,
					fixedContentPos: true,
					removalDelay: 1200,
					callbacks: {
						beforeOpen: function() {
							var mfpWrap = this.wrap;
							this.bgOverlay.fadeIn(200);
							pageSettings.addSpinner( mfpWrap );
						},
						imageLoadComplete: function() {
							var $spinner = this.wrap.find('.grve-loader'),
								$content = this.container;
							pageSettings.removeSpinner( $spinner, $content );

						},
						beforeClose: function() {
							this.wrap.fadeOut(600);
							this.bgOverlay.fadeOut(600);
						},
					},
					gallery: {
						enabled:true
					},
					image: {
						tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
						titleSrc: function(item) {
							var title   = item.el.find('.grve-title').html() ? item.el.find('.grve-title').html() : '',
								caption = item.el.find('.grve-caption').html() ? '<br><small>' + item.el.find('.grve-caption').html() + '</small>' : '';
							return title + caption;
						}
					}
				});
			});
			//VIDEOS
			$('.grve-youtube-popup, .grve-vimeo-popup, .grve-video-popup').each(function() {
				$(this).magnificPopup({
					disableOn: 700,
					type: 'iframe',
					preloader: false,
					fixedBgPos: true,
					fixedContentPos: true,
					removalDelay: 1200,
					callbacks: {
						beforeOpen: function() {
							var mfpWrap = this.wrap;
							this.bgOverlay.fadeIn(200);
							pageSettings.addSpinner( mfpWrap );
						},
						open: function() {
							var $spinner = this.wrap.find('.grve-loader'),
								$content = this.container;
							pageSettings.removeSpinner( $spinner, $content );
						},
						beforeClose: function() {
							this.wrap.fadeOut(600);
							this.bgOverlay.fadeOut(600);
						},
					}
				});
			});
		},
		addSpinner: function( mfpWrap ){
			var spinner = '<div class="grve-loader"></div>';
			$(spinner).appendTo( mfpWrap );
		},
		removeSpinner: function( spinner, content){
			setTimeout(function(){
				spinner.fadeOut(1000, function(){
					content.animate({'opacity':1},600);
				});
			}, 700);
		},
		socialShareLinks: function(){
			$('.grve-social-share-facebook').click(function (e) {
				e.preventDefault();
				window.open( 'https://www.facebook.com/sharer/sharer.php?u=' + $(this).attr('href'), "facebookWindow", "height=380,width=660,resizable=0,toolbar=0,menubar=0,status=0,location=0,scrollbars=0" );
				return false;
			});
			$('.grve-social-share-twitter').click(function (e) {
				e.preventDefault();
				window.open( 'http://twitter.com/intent/tweet?text=' + $(this).attr('title') + ' ' + $(this).attr('href'), "twitterWindow", "height=450,width=660,resizable=0,toolbar=0,menubar=0,status=0,location=0,scrollbars=0" );
				return false;
			});
			$('.grve-social-share-linkedin').click(function (e) {
				e.preventDefault();
				window.open( 'http://www.linkedin.com/shareArticle?mini=true&url=' + $(this).attr('href') + '&title=' + $(this).attr('title'), "linkedinWindow", "height=500,width=820,resizable=0,toolbar=0,menubar=0,status=0,location=0,scrollbars=0" );
				return false;
			});
			$('.grve-social-share-googleplus').click(function (e) {
				e.preventDefault();
				window.open( 'https://plus.google.com/share?url=' + $(this).attr('href'), "googleplusWindow", "height=600,width=600,resizable=0,toolbar=0,menubar=0,status=0,location=0,scrollbars=0" );
				return false;
			});
			$('.grve-social-share-pinterest').click(function (e) {
				e.preventDefault();
				window.open( 'http://pinterest.com/pin/create/button/?url=' + $(this).attr('href') + '&media=' + $(this).data('pin-img') + '&description=' + $(this).attr('title'), "pinterestWindow", "height=600,width=600,resizable=0,toolbar=0,menubar=0,status=0,location=0,scrollbars=0" );
				return false;
			});
			$('.grve-social-share-reddit').click(function (e) {
				e.preventDefault();
				window.open( '//www.reddit.com/submit?url=' + $(this).attr('href'), "redditWindow", "height=600,width=820,resizable=0,toolbar=0,menubar=0,status=0,location=0,scrollbars=0" );
				return false;
			});
			$('.grve-like-counter-link').click(function (e) {
				e.preventDefault();
				var link = $(this);
				var id = link.data('post-id'),
					counter = link.parent().find('.grve-like-counter');

				var ajaxurl = grve_form_data.ajaxurl;

				$.ajax({type: 'POST', url: ajaxurl, data: 'action=grve_likes_callback&grve_likes_id=' + id, success: function(result) {
					counter.html(result);
				}});
				return false;
			});
		},
		postSocials: function(){
			var $selector = $('#grve-post-title #grve-social-share');
			if(!$selector.length || isMobile.any()) {
				return;
			}
			stickyItems.init({ element : $selector, offset : 10 });
			$(window).scroll(function(){
				var socialTop     = $selector.offset().top,
					fieldsBarTop  = $('.grve-fields-bar').offset().top;
				if( socialTop ==  fieldsBarTop + 10 ) {
					$selector.addClass('in-bar');
				} else {
					$selector.removeClass('in-bar');
				}
			});
		},
		titleAnimation: function(){
			var titleContainer = $('#grve-page-title, #grve-post-title, #grve-portfolio-title');
			titleContainer.find('.grve-container').addClass('animated');
		},
		fitVid: function(){
			$('.grve-video, .grve-media').fitVids();
		},
		resizeTitle: function(){
			var titleContainer =  $(' #grve-page-title-content');
			if( $('#grve-post-title').length ) {
				titleContainer =  $(' #grve-post-title-content');
			}
			if( $('#grve-portfolio-title').length ) {
				titleContainer =  $(' #grve-portfolio-title-content');
			}
			if( titleContainer.length ) {
				featureSection.resizeFeature( titleContainer, titleContainer.attr('data-height') );
				$(window).smartresize( function() {
					featureSection.resizeFeature( titleContainer, titleContainer.attr('data-height') );
				});
			}
		},
		anchorBar: function(){
			var $selector   = $('#grve-anchor-menu'),
				$menu       = $selector.find('ul'),
				$menuIcon   = $selector.find('.grve-icon-menu');
			if(!$selector.length) {
				return;
			}
			pageSettings.anchorBarUpdate( $selector, $menu );
			$(window).smartresize( function() {
				pageSettings.anchorBarUpdate( $selector, $menu );
			});
			$menuIcon.click(function(){
				$menu.slideToggle(100);
			});
		},
		anchorBarUpdate: function( selector, menu ){
			var $selector   = selector,
				$menu       = menu,
				menuWidth   = $menu.outerWidth(),
				windowWidth = $(window).width();
			if( menuWidth >= windowWidth ) {
				$selector.addClass('grve-responsive-bar');
				$menu.css('display', 'none');
			}
		},
		backtoTop: function() {
			var selectors  = {
				topBtn     : '.grve-top-btn',
				dividerBtn : '.grve-divider-backtotop',
				topLink    : 'a[href="#grve-goto-header"]'
			}
			// Show backtoTop Button
			if( $('#grve-header').attr('data-backtotop') != 'no' ) {
				var btnUp = $('<div/>', {'class':'grve-top-btn grve-icon-nav-up'});
					btnUp.appendTo('#grve-theme-wrapper');

				$(window).on('scroll', function() {
					if ($(this).scrollTop() > 600) {
						$('.grve-top-btn').addClass('show');
					} else {
						$('.grve-top-btn').removeClass('show');
					}
				});
			}
			$.each(selectors, function(key, value){
				$(value).on('click', function(){
					$('html, body').animate({scrollTop: 0}, 900);
				});
			});

		},
		gotoSection: function(){
			var $selector    = $('#grve-feature-section .grve-goto-section'),
				$nextSection = $('#grve-main-content .grve-section').first(),
				topOffset       = !isMobile.any() && $('#grve-header').data('sticky-header') != 'none' ? $('#grve-inner-header').height() : 0,
				fieldBarHeight  = $('.grve-fields-bar').length ? $('.grve-fields-bar').outerHeight() : 0;
			$selector.on('click',function(){
				$('html,body').animate({
					scrollTop: $nextSection.offset().top - topOffset - fieldBarHeight
				}, 1000);
				return false;
			});
		},
		stickySidebar: function(){
			var $item    = $('#grve-sidebar.grve-fixed-sidebar'),
				$content = $('#grve-content-area, #grve-post-area, #grve-portfolio-area');
			if( !$item.length ) {
				return;
			}
			var itemId          = $item.attr('id'),
				itemHeight      = $item.outerHeight(),
				itemWidth       = $item.outerWidth() - 1,
				itemFloat       = $item.css('float'),
				headerHeight    = $('#grve-inner-header').outerHeight(),
				titleHeight     = $('#grve-page-title').length ? $('#grve-page-title').outerHeight() : 0,
				fieldBarHeight  = $('.grve-fields-bar').length ? $('.grve-fields-bar').outerHeight() : 0,
				topBarHeight    = $('#grve-top-bar').length ? $('#grve-top-bar').outerHeight() : 0,
				offset          = headerHeight + fieldBarHeight + 30,
				windowHeight    = $(window).height();
			if( itemHeight > windowHeight || isMobile.any() ) {
				return false;
			}
			// Create A Helper Wrapper
			$item.wrap('<div id="' + itemId + '-wrapper"></div>' );
			$item.parent().css({
				'width'    : itemWidth,
				'height'   : itemHeight,
				'float'    : itemFloat,
				'position' : 'relative'
			});
			$item.css({
				'width'    : itemWidth,
				'position' : 'static'
			});
			$(window).on('scroll', function() {
				var contentHeight = $content.outerHeight(),
					contentTop    = $content.offset().top,
					contentBottom = contentTop + contentHeight;
				if( ( $(window).scrollTop() > contentTop - offset ) && ( $(window).scrollTop() < contentBottom - ( offset + itemHeight ) )){
					$item.css({'position':'fixed', 'width' : itemWidth, 'top': offset });
				}
				else if( $(window).scrollTop() > contentTop ){
					$item.css({'position':'absolute', 'top': contentHeight - itemHeight });
				}
				else if( $(window).scrollTop() < contentTop ){
					$item.css({'position':'static', 'top':'auto' });
				}
			});
		},
		footerSettings: function() {
			$('#grve-footer .grve-section').each(function(){
				var $that = $(this),
					sectionType = $that.attr('data-section-type');
				if( sectionType == 'fullwidth-background' ){
					pageSettings.footerFullBg($that);
					$(window).smartresize( function() {
						pageSettings.footerFullBg($that);
					});
				}
				if( sectionType == 'fullwidth-element' ){
					pageSettings.footerFullElement($that);
					$(window).smartresize( function() {
						pageSettings.footerFullElement($that);
					});
				}
			});
		},
		footerFullBg: function(element){
			var windowWidth    = $(window).width(),
				contentWidth   = element.parent().width(),
				space          = (windowWidth - contentWidth)/2;
			element.css({ 'visibility': 'visible', 'padding-left':space, 'padding-right': space, 'margin-left': -space, 'margin-right': -space});
		},
		footerFullElement: function(element){
			var windowWidth   = $(window).width(),
				contentWidth  = element.parent().width(),
				space         = (windowWidth - contentWidth)/2;
			element.css({ 'visibility': 'visible', 'padding-left':0, 'padding-right': 0, 'margin-left': -space, 'margin-right': -space});
		},
		grvePopup: function(){
			var $selector = $('.grve-open-popup-link');
			$selector.on( "click", function(e){
				e.preventDefault();
				var target = $(this).attr('href');
				if( !$(target).length ){
					return;
				} else {
					$(target).addClass('grve-show-modal');
					$('.grve-popup-overlay, .grve-close-modal').on( "click", function(e){
						if ( !$(target).is(e.target) ) {
							$(target).removeClass('grve-show-modal');
						}
					});
				}
			});
		},
		imageLoader: function(){
			var selectors  = {
				singleImage  : '.grve-image',
				media        : '.grve-media'
			}
			$.each(selectors, function(key, value){
				if( $(this).length ){
					var item     = $(this),
						imgLoad  = imagesLoaded( item );
					imgLoad.on( 'always', function() {
						if( $(value).parent().is('#grve-single-media') ){
							$(value).find('img').animate({ 'opacity': 1 },1000);
						} else {
							$(value).find('img').css('opacity', 1);
						}
					});
				}
			});
		}
	};

	// -------------------------------------------------------------------------------------------
	// SIDE MENU OPEN
	// -------------------------------------------------------------------------------------------
	var menuOpen = false;

	var headerOptions = {

		menuIcon     : $('#grve-header-options > li'),
		menuWrapper  : $('.grve-options-wrapper'),

		init: function(){
			this.menuIcon.on('click',function(e){
				e.preventDefault();
				if(menuOpen) {
					headerOptions.closeMenu();
				} else {
					headerOptions.openMenu();
				}
			});

			if( isMobile.any() ) {
				return;
			} else {
				this.menuIcon.on( 'mouseover', function() { headerOptions.openIconMenu(); } );
				this.menuWrapper.on( 'mouseover', function() { headerOptions.openMenu(); } );
				this.menuIcon.on( 'mouseout', function() { headerOptions.closeMenu(); });
			}
		},
		openIconMenu: function(){
			this.menuWrapper.addClass('grve-open-part');
			this.menuIcon.addClass('grve-open');
		},
		openMenu: function(){
			this.menuWrapper.addClass('grve-open-all');
			this.menuIcon.addClass('grve-open');
			menuOpen = true;
		},
		closeMenu: function(){
			this.menuWrapper.removeClass('grve-open-part grve-open-all');
			this.menuIcon.removeClass('grve-open');
			menuOpen = false;
		}
	};

	//////////////////////////////////////////////////////////////////////////////////////////////////////
	// CLASSIC ELEMENTS
	//////////////////////////////////////////////////////////////////////////////////////////////////////
	var classicElements = {
		init: function(){
			//Accordion Toggle
			classicElements.accordionToggle();

			// Animation Appear
			classicElements.animAppear();

			//Progress Bars
			classicElements.progressBars();

			// Tabs
			classicElements.tabs();

			// Info Box
			classicElements.infoBox();

			// Counters
			classicElements.counter();

			// Partner Advanced
			classicElements.partnerAdvanced();

			// Icon Box
			classicElements.iconBox();

			// Woo Product
			classicElements.wooProduct();

		},

		accordionToggle: function(){
			$('.grve-toggle-wrapper.grve-first-open').each(function(){
				$(this).find('li').first().addClass('active');
			});
			$('.grve-toggle-wrapper li.active').find('.grve-title').addClass('active');
			$('.grve-toggle-wrapper li .grve-title').click(function () {
				$(this)
					.toggleClass('active')
					.next().slideToggle(350);
			});
			$('.grve-accordion-wrapper.grve-first-open').each(function(){
				$(this).find('li').first().addClass('active');
			});
			$('.grve-accordion-wrapper li.active').find('.grve-title').addClass('active');
			$('.grve-accordion-wrapper li .grve-title').click(function () {
				$(this)
					.toggleClass('active').next().slideToggle(350)
					.parent().siblings().find('.grve-title').removeClass('active')
					.next().slideUp(350);
			});
		},
		animAppear: function(){
			if(isMobile.any()) {
				$('.grve-animated-item').css('opacity',1);
			} else {
				$('.grve-animated-item').each(function() {
					var timeDelay = $(this).attr('data-delay');
					$(this).appear(function() {
					var $that = $(this);
						setTimeout(function () {
							$that.addClass('animated');
						}, timeDelay);
					},{accX: 0, accY: -150});
				});
			}
		},
		progressBars: function(){
			var selector = '.grve-progress-bar';
			$(selector).each(function() {
				$(this).appear(function() {

					var val         = $(this).attr('data-value'),
						percentage  = $('<div class="grve-percentage">'+ val + '%'+'</div>');

					$(this).find('.grve-bar-line').animate({ width: val + '%' }, 1600);

					percentage.appendTo($(this).find('.grve-bar'));

					$(this).find('.grve-percentage').animate({ left: val + '%' }, 1600);
				});
			});
		},
		tabs: function(){
			$('.grve-tabs-title li').click(function () {
				$(this).addClass('active').siblings().removeClass('active');
				$(this).parent().parent().find('.grve-tabs-wrapper').find('.grve-tab-content').eq($(this).index()).addClass('active').siblings().removeClass('active');
			});
			$('.grve-tabs-title').each(function(){
				$(this).find('li').first().click();
			});
		},
		infoBox: function(){
			var infoMessage = $('.grve-message'),
			closeBtn = infoMessage.find($('.grve-close'));
			closeBtn.click(function () {
				$(this).parent().slideUp(150);
			});
		},
		counter: function(){
			var selector = '.grve-counter-item span';
			$(selector).each(function(i){
				var elements = $(selector)[i];
				$(elements).attr('id','grve-counter-' + i );
				var delay = $(this).parents('.grve-counter').attr('data-delay') !== '' ? parseInt( $(this).parents('.grve-counter').attr('data-delay') ) : 200,
					options = {
						useEasing    : true,
						useGrouping  : true,
						separator    : ',',
						decimal      : '.',
						prefix       : $(this).attr('data-prefix') != '' ? $(this).attr('data-prefix') : '',
  						suffix       : $(this).attr('data-suffix') != '' ? $(this).attr('data-suffix') : ''
					},
					counter = new countUp( $(this).attr('id') , $(this).attr('data-start-val'), $(this).attr('data-end-val'), $(this).attr('data-decimal-points'), 2.5, options);
				$(this).appear(function() {
					setTimeout(function () {
						counter.start();
					}, delay);
				});
			});
		},
		partnerAdvanced: function(){
			var partner = $('.grve-partner-advanced');

			partner.parents('.grve-section').hover(function(){
				$(this).css('cursor','pointer');
			});

			partner.parents('.grve-section').on('click',function(){
				var $that = $(this),
					$element = $that.find('.grve-partner-advanced'),
					offset = $that.offset().top,
					headerHeight    = $('#grve-header').attr('data-sticky-header') != 'none' ? $('#grve-inner-header').outerHeight() : 0,
					fieldBarHeight  = $('.grve-fields-bar').length ? $('.grve-fields-bar').outerHeight() : 0,
					distance = offset - ( headerHeight + fieldBarHeight - 1 );

				if( distance > 0 && !$element.hasClass('active') ) {
					$('html,body').animate({
						scrollTop: distance
					}, 600,function(){
						$element.addClass('active').find('.grve-partner-content').slideDown(function(){
							$(this).addClass('animated');
							return;
						});
					});
				} else {
					$element.toggleClass('active').find('.grve-partner-content').slideToggle(function(){
						$(this).toggleClass('animated');
					});
				}

			});
		},
		iconBox: function(){
			var $selector = $('.grve-box-icon.grve-advanced-hover');
			if( isMobile.any() ) {
				$selector.css({ 'visibility' : 'visible' });
				$selector.find('p').css({ 'opacity' : 1 });
				return false;
			}
			classicElements.iconBoxSettings( $selector );
			$(window).smartresize( function() {
				classicElements.iconBoxSettings( $selector );
			});
			$selector.unbind('mouseenter mouseleave').bind('mouseenter mouseleave', function() {
				$(this).toggleClass('hover').addClass('active');
			});
		},
		iconBoxSettings: function( $selector ){
			$selector.each(function(){
				var $icon         = $(this).find('.grve-icon'),
					$title        = $(this).find('.grve-box-title'),
					$contnet      = $(this).find('p'),
					iconHeight    = $icon.height(),
					titleHeight   = $title.height(),
					contnetHeight = $contnet.height(),
					boxHeight     = iconHeight + titleHeight + contnetHeight + 50,
					topPadding    = (boxHeight - (iconHeight + titleHeight + 30))/2;

				$(this).css({ 'height': boxHeight, 'padding-top': topPadding, 'visibility' : 'visible' });
				$contnet.css({ 'padding-top': topPadding });
			});
		},
		wooProduct: function(){
			var $product = $('.grve-product-item'),
				$productOptions = $('.grve-product-options');
			$product.unbind('mouseenter mouseleave').bind('mouseenter mouseleave', function() {
				$(this).toggleClass('hover');
			});
			$productOptions.unbind('mouseenter mouseleave').bind('mouseenter mouseleave', function() {
				var $addButton = $(this).find('.grve-add-cart');
				if( $addButton.length ){
					$(this).toggleClass('hover');
				}
			});
			$('.grve-product-options .grve-add-cart').click(function(){
				$(this).parents('.grve-product-media').addClass('grve-product-added-to-cart');
			});
		}
	};

	//////////////////////////////////////////////////////////////////////////////////////////////////////
	// STICKY ELEMENTS
	//////////////////////////////////////////////////////////////////////////////////////////////////////
	var stickyItems = {

		config : {
			element    : '.grve-fields-bar',
			offset     : 0
		},

		init: function(settings){
			// allow overriding the default config
			$.extend(this.config, settings);

			if( !$(this.config.element).length || isMobile.any() ) {
				return;
			}
			var $item       = $(this.config.element),
				itemOffset  = this.config.offset,
				positionX   = $item.offset().left,
				itemId      = $item.attr('id'),
				itemWidth   = $item.outerWidth() + 2,
				itemHeight  = $item.outerHeight();
			// Create A Helper Wrapper
			$item.wrap('<div id="' + itemId + '-wrapper"></div>' );
			$item.parent().css({
				'height' : itemHeight,
				'position' : 'relative'
			});
			$(window).scroll(function(){
				var scroll       = $(window).scrollTop(),
					elementTop   = $item.parent().offset().top,
					headerHeight = $('#grve-header').attr('data-sticky-header') != 'none' ? $('#grve-inner-header').outerHeight() : 0,
					offsetTop    = headerHeight + itemOffset + wpBarHeight;
				if( scroll > elementTop - offsetTop ) {
					$item.css({
						'position' : 'fixed',
						'top'      : offsetTop,
						'left'     : positionX,
						'width'    : itemWidth
					}).addClass('sticky');
				}
				else {
					$item.css({
						'position' : '',
						'top'      : '',
						'left'     : '',
						'width'    : ''
					}).removeClass('sticky');
				}
			});
		}
	};

	//////////////////////////////////////////////////////////////////////////////////////////////////////
	// TITLE PARALLAX
	//////////////////////////////////////////////////////////////////////////////////////////////////////
	var titleParallax = {

		selector: '.grve-feature-content',
		container: '#grve-feature-section',

		init: function(){
			if( isMobile.any() || $(this.container).data('effect') != 'parallax' ) {
				return;
			}
			$(window).scroll(function(){
				titleParallax.update();
			});
		},
		update: function(){

			$(this.selector).transition({ y: $(window).scrollTop()*.5},0)
							.css( 'opacity', 1 - ( $(window).scrollTop()*.002 ) );
		}
	};
	//////////////////////////////////////////////////////////////////////////////////////////////////////
	// ONEPAGE SETTINGS
	//////////////////////////////////////////////////////////////////////////////////////////////////////
	var onePageSettings = {
		init: function(){
			var topOffset       = $('#grve-header').data('sticky-header') != 'none' ? $('#grve-inner-header').height() : 0,
				fieldBarHeight  = $('.grve-fields-bar').length ? $('.grve-fields-bar').outerHeight() : 0;
			$('a[href*=#]:not( [href=#] )').click(function(e) {
				if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname ) {
					var target = $(this.hash);
					target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
					if ( target.length && target.hasClass('grve-section') ) {
						$('html,body').animate({
							scrollTop: target.offset().top - topOffset - fieldBarHeight
						}, 1000);
						window.location.hash = "";
						return false;
					} else {
						e.preventDefault();
					}
				}
			});
			if (window.location.hash) {
				setTimeout(function() {
					$('html, body').scrollTop(0);
					$('#grve-main-content').css('opacity',1);
					var target = window.location.hash;

					if ($(target).length) {
						$('html, body').delay(600).animate({
							scrollTop: $(target).offset().top - topOffset - fieldBarHeight
						}, 600);
					}
					window.location.hash = "";
				}, 0);
			}
			else {
				$('#grve-main-content').css('opacity',1);
			}
		}
	};
	//////////////////////////////////////////////////////////////////////////////////////////////////////
	// CAROUSEL
	//////////////////////////////////////////////////////////////////////////////////////////////////////
	var  carousels = {

		init: function() {
			var $elements = $('.grve-carousel-element');

			$elements.each(function(){
				var	carousel = $(this);

				var carouselSettings = {
					sliderSpeed : ( parseInt( carousel.attr('data-slider-speed') ) ) ? parseInt( carousel.attr('data-slider-speed') ) : 3000,
					autoHeight  : carousel.attr('data-slider-autoheight') == 'yes' ? true : '',
					sliderPause : carousel.attr('data-slider-pause') == 'yes' ? true : false,
					itemNum     : carousel.hasClass('grve-carousel') ? parseInt( carousel.attr('data-items')) : 1,
					itemsTablet : carousel.hasClass('grve-carousel') ? [768,2] : [768,1],
					baseClass   : 'grve-carousel',
					pagination  : false
				};
				if ( carousel.hasClass('grve-testimonial') ) {
					// Testimonial Navigation
					carouselSettings.pagination = true;
				}
				else if ( carousel.hasClass('grve-carousel') ) {
					// Custom Navigation
					carousels.customNav(carousel);
				}
				else if ( carousel.hasClass('grve-slider') ) {
					// Custom Navigation
					carousels.customNav(carousel);
					carousels.customPause(carousel, carouselSettings);
				}
				// Carousel Settings
				carousels.carouselInit(carousel, carouselSettings);
			});

		},
		carouselInit: function(carousel, settings){
			carousel.owlCarousel({

				navigation        : false,
				pagination        : settings.pagination,
				autoHeight        : settings.autoHeight,
				slideSpeed        : 400,
				paginationSpeed   : 400,
				singleItem        : false,
				items             : settings.itemNum,
				autoPlay          : true,
				stopOnHover       : settings.sliderPause,
				baseClass         : 'grve-carousel-element',
				theme             : '',
				itemsDesktop      : false,
				itemsDesktopSmall : false,
			 	itemsTablet       : settings.itemsTablet

			});
			// Carousel Element Speed
			carousel.trigger('owl.play',settings.sliderSpeed);
			carousel.css('visibility','visible');
		},
		customNav: function(carousel){
			// Carousel Navigation
			carousel.parent().find('.grve-carousel-next').click(function(){
				carousel.trigger('owl.next');
			});
			carousel.parent().find('.grve-carousel-prev').click(function(){
				carousel.trigger('owl.prev');
			});
		},
		// Fixed Pause on Hover ( Slider with Custom Title )
		customPause: function(carousel, settings){
			var customTitle = carousel.parent().find('.grve-custom-title-wrapper');
			if(settings.sliderPause){
				customTitle.hover(function(){
					carousel.trigger('owl.stop');
					carousel.find('.grve-image-hover').addClass('hover');
				},function(){
					carousel.trigger('owl.play',settings.sliderSpeed);
					carousel.find('.grve-image-hover').removeClass('hover');
				});
			}
			if(customTitle.length){
				customTitle.hover(function(){
					carousel.find('.grve-image-hover').addClass('hover');
				},function(){
					carousel.find('.grve-image-hover').removeClass('hover');
				});
			}
		}
	};
	//////////////////////////////////////////////////////////////////////////////////////////////////////
	// ISOTOPE
	//////////////////////////////////////////////////////////////////////////////////////////////////////
	var iso = {

		init: function() {
			var $selector = $('.grve-isotope');
			$selector.each(function(){
				var $that        = $(this),
					$container   = $that.find('.grve-isotope-container'),
					$isotopItem  = $container.find('.grve-isotope-item'),
					layout       = $that.data('layout') != '' ? $that.data('layout') : 'fitRows';

				iso.isotopeSetup( $container, layout);
				$(window).smartresize( function() {
					if(layout == 'packery') {
						iso.packeryStyleFix( $container );
					}
				});
				$that.find('.grve-filter li').click(function(){
					var selector = $(this).attr('data-filter');
					$container.isotope({
						filter: selector
					});
					$(this).addClass('selected').siblings().removeClass('selected');
				});
			});
		},
		isotopeSetup: function( $container, layout ){
			$container.isotope({
				resizable: true,
				itemSelector: '.grve-isotope-item',
				layoutMode: layout
			});
			if(layout == 'packery') {
				iso.packeryStyleFix( $container );
			}
			$container.isotope('layout');
			$container.animate({'opacity': 1},600);
			$(window).smartresize( function() {
				setTimeout(function() {
					$container.isotope('layout');
				},1000);
			});
		},
		packeryStyleFix: function( $container ) {
			var smallItem = $container.find('.grve-isotope-item.grve-packery-image').first(),
				standardHeight = smallItem.width(),
				wideTallHeight = (standardHeight * 2)  + parseInt(smallItem.css('margin-bottom'), 10);
			if (standardHeight > 0) {
				$container.find('.grve-isotope-item.grve-packery-image .grve-media').css('height', standardHeight);
				$container.find('.grve-isotope-item.grve-packery-w2 .grve-media').css('height', standardHeight);
				$container.find('.grve-isotope-item.grve-packery-h2 .grve-media').css('height', wideTallHeight);
				$container.find('.grve-isotope-item.grve-packery-h2-w2 .grve-media').css('height', wideTallHeight);
			}
			$container.isotope('layout');
		}
	};
	//////////////////////////////////////////////////////////////////////////////////////////////////////
	// PARALLAX
	//////////////////////////////////////////////////////////////////////////////////////////////////////
	var parallax = {

		selector : 'div[data-stellar-ratio]',

		init: function(){

			if( isMobile.any() || !$(this.selector).length ) {
				return;
			}

			$(window).stellar({
				horizontalScrolling: false,
				verticalOffset: 0,
				horizontalOffset: 0,
				responsive: true,
				scrollProperty: 'scroll',
				positionProperty: 'transform',
				parallaxBackgrounds: false,
				parallaxElements: true,
				hideDistantElements: false,
			});
			parallax.settings();
			$(window).smartresize( function() {
				parallax.settings();
			});
		},
		settings: function(){

			$(parallax.selector).each(function (){
				var $parallax           = $(this),
					$container          = $parallax.parent(),
					containerHeight     = $container.outerHeight(),
					windowHeight        = $(window).height();

				$parallax.css({
					'height': containerHeight + windowHeight * 0.5 + 50,
					'top': -1 * windowHeight * 0.5 / 2
				});

				if( $parallax.is('.grve-bg-video') ) {
					videoResize.init( { selector : $parallax, container : $parallax.parent() } );
				}
			});
		}
	};
	//////////////////////////////////////////////////////////////////////////////////////////////////////
	// GLOBAL VARIABLES
	//////////////////////////////////////////////////////////////////////////////////////////////////////
	var wpBarHeight = $('#grve-body').hasClass('admin-bar') ? 32 : 0;
	var isMobile = {
		Android: function() {
			return navigator.userAgent.match(/Android/i);
		},
		BlackBerry: function() {
			return navigator.userAgent.match(/BlackBerry/i);
		},
		iOS: function() {
			return navigator.userAgent.match(/iPhone|iPad|iPod/i);
		},
		Opera: function() {
			return navigator.userAgent.match(/Opera Mini/i);
		},
		Windows: function() {
			return navigator.userAgent.match(/IEMobile/i);
		},
		any: function() {
			return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
		}
	};

	// Scrollbar Width
	var parent, child, scrollBarWidth;

	if( scrollBarWidth === undefined ) {
		parent          = $('<div style="width:50px;height:50px;overflow:auto"><div/></div>').appendTo('body');
		child           = parent.children();
		scrollBarWidth  = child.innerWidth()-child.height(99).innerWidth();
		parent.remove();
	};



	$(document).ready( function() {

		// FEATURE SECTION SETTINGS
		featureSection.init();

		// HEADER
		headerSettings.init();

		// MAIN MENU
		mainMenu.init();

		// STICKY ELEMENTS
		stickyItems.init();

		// SIDE MENU
		headerOptions.init();

		// CLASSIC ELEMENTS
		classicElements.init();

		// PAGE SETTINGS
		pageSettings.init();

		// TITLE PARALLAX
		titleParallax.init();

		// SECTIONS
		sectionSettings.init();

		// ONEPAGE SETTINGS
		onePageSettings.init();

	});

	$(window).load( function() {

		// CAROUSELS
		carousels.init();

		// ISOTOPE
		iso.init();

		// PARALLAX
		parallax.init();
	});

})(jQuery);