jQuery.noConflict();
jQuery(document).ready(function() {
	
	/* 
	 * Tab functions
	 */
	if(jQuery('ul.tabs').length > 0){
		jQuery('ul.tabs').tabs('> .tabs_content');
	}
	if(jQuery('ul.tabs_framed').length > 0){
		jQuery('ul.tabs_framed').tabs('> .tabs_framed_content');
	}
	if(jQuery('ul.tabs_button').length > 0){
		jQuery('ul.tabs_button').tabs('> .tabs_button_content');
	}
	if(jQuery('.tabs_vertical_frame').length > 0){
		jQuery('.tabs_vertical_frame').tabs('> .tabs_vertical_content');
		jQuery('.tabs_vertical li').click(function(){ jQuery(this).parent().children().removeClass('current'); 
			jQuery(this).addClass('current');
		});
	}
	if(jQuery('ul.blog_tabs').length > 0){
		jQuery('ul.blog_tabs').tabs('> .blog_tabs_content');
		jQuery('ul.blog_tabs').data('tabs').onClick(function(index) {
			Cufon.refresh();
		});
	}
	
	/* 
	 * Hover fade
	 */
	jQuery('.hover_fade_js').live('hover', function(e) {
		if( e.type == 'mouseenter' )
			jQuery(this).stop().animate({opacity:0.7},400);

		if( e.type == 'mouseleave' )
			jQuery(this).stop().animate({opacity:1},400);
	});
	
	/* 
	 * toggle functions 
	 */
	jQuery('.toggle').toggle(function(){
		jQuery(this).addClass('active');
		}, function () {
		jQuery(this).removeClass('active');
	});

	jQuery('.toggle').click(function(){
		jQuery(this).next('.toggle_content').slideToggle();
	});
	
	jQuery('.toggle_frame_set').each(function(i) {
		var _this = jQuery(this),
		    toggle = _this.find('.toggle_accordion');
		
		toggle.click(function(){
			if( jQuery(this).next().is(':hidden') ) {
				_this.find('.toggle_accordion').removeClass('active').next().slideUp();
				jQuery(this).toggleClass('active').next().slideDown();
			}
			return false;
		});
	});
	
	/* 
	 * Testimonial functions
	 */
	var testimonialsEl = jQuery('.widget_testimonial_module');
	
	if(testimonialsEl.length>0){
		testimonialsEl.each(function(i) {
			testimonialsElChildren = jQuery(this).children(':not(span)'),
			testimonialsCount = testimonialsElChildren.length;
			testimonialNext = jQuery(this).find('.testimonial_next'),
			testimonialPrev = jQuery(this).find('.testimonial_prev'),
			nextTestimonials = '',
			prevTestimonials = '';

			testimonialNext.click(function () {
				testimonialsElChildren.each(function(i) {
					if(jQuery(this).is(':visible')){
						nextTestimonials = jQuery(this).next();
						if(nextTestimonials.hasClass('testimonial_nav'))
							nextTestimonials = testimonialsElChildren.eq(0);
					}
				});

				testimonialsElChildren.hide();
				nextTestimonials.show();
			});

			testimonialPrev.click(function () {
				testimonialsElChildren.each(function(i) {
					if(jQuery(this).is(':visible')){
						prevTestimonials = jQuery(this).prev();
						if(prevTestimonials.length == 0)
							prevTestimonials = testimonialsElChildren.eq(testimonialsCount-1);
					}
				});

				testimonialsElChildren.hide();
				prevTestimonials.show();
			});

		});
	}
	
	/* 
	 * image reflect functions 
	 */
	jQuery('img.reflect').reflect({height:0.5,opacity:0.5});
	
	/*
	 * prettyPhoto 
	 */
	jQuery("a[rel^='prettyPhoto'], a[rel^='lightbox']").prettyPhoto({
		overlay_gallery: false, social_tools: '', 'theme': prettyphotoTheme /* light_square / dark_rounded / light_square / dark_square / facebook */															
	});
	
	/* 
	 * spam protction on mailto: links
	 */
	jQuery('a.email_link_noreplace').nospam({
      replaceText: false,
      filterLevel: 'normal'
    });

	jQuery('a.email_link_replace').nospam({
      replaceText: true,
      filterLevel: 'normal'
    });

	/* 
	 * Contact form submit
	 */
	jQuery('.contact_form_submit').click(function() {
		clearInterval(preLoaderSmall);
		preLoaderCount = 0;
		mysitePreloaderSmall('.mysite_contact_feedback');
		jQuery(this).next().css('display','inline-block');
	});
	
	/* 
	 * "target_blank" links
	 */
	jQuery('.flickr_badge_image a').attr('target', '_blank');
	jQuery('.target_blank').attr('target', '_blank');
	
});


/*
 * Preload image function
 */
(function($) {
  var cache = [];
  // Arguments are image paths relative to the current page.
  $.preLoadImages = function() {
    var args_len = arguments.length;
    for (var i = args_len; i--;) {
      var cacheImage = document.createElement('img');
      cacheImage.src = arguments[i];
      cache.push(cacheImage);
    }
  }
})(jQuery)

// Preload loading images
jQuery.preLoadImages(
assetsUri+ '/transparent.gif',
assetsUri+ '/preloader.png'
);

/*
 * Preloader image
 */
var preLoader = null;
var preLoaderCount = 0;
function mysitePreloader(img_class) {
    var i,
	positions;
	i=0;
		
	positions=[-26,-52,-78,-104,-130,-156,-182,-208,-234,-260,-286,0];
	positionsClass = 'center';
	
	preLoader=setInterval(function(){
	jQuery(img_class +' img').css('background-position',positions[i]+'px ' +positionsClass);
	i++;
	preLoaderCount++;
	if(preLoaderCount===200){clearInterval(preLoader);preLoaderCount = 0;}
	if(i===12){i=0;}
	},70);
}

var preLoaderSmall = null;
var preLoaderSmallCount = 0;
function mysitePreloaderSmall(img_class) {
    var i,
	positions;
	i=0;
	
	positionsSmall=[-16,-32,-48,-64,-80,-96,-112,-128,-144,-160,-176,0];
	positionsClassSmall = 'bottom';
	
	preLoaderSmall=setInterval(function(){
	jQuery(img_class +' img').css('background-position',positionsSmall[i]+'px ' +positionsClassSmall);
	i++;
	preLoaderSmallCount++;
	if(preLoaderSmallCount===200){clearInterval(preLoaderSmall);preLoaderSmallCount = 0;}
	if(i===12){i=0;}
	},70);
}

var preLoaderLarge = null;
var preLoaderLargeCount = 0;
function mysitePreloaderLarge(img_class) {
    var i,
	positions;
	i=0;
	
	positionsLarge=[-35,-70,-105,-140,-175,-210,-245,-280,-315,-350,-385,0];
	positionsClassLarge = 'top';
	
	preLoaderLarge=setInterval(function(){
	jQuery(img_class +' img').css('background-position',positionsLarge[i]+'px ' +positionsClassLarge);
	i++;
	preLoaderLargeCount++;
	if(preLoaderLargeCount===200){clearInterval(preLoaderLarge);preLoaderLargeCount = 0;}
	if(i===12){i=0;}
	},70);
}

mysitePreloader('.mysite_preloader');
mysitePreloaderLarge('.mysite_preloader_large');

/*
 * YouTube api events
 */
function onYouTubePlayerAPIReady(id) {
  new YT.Player(id, {
    height: '',
    width: '',
    videoId: '',
    events: {
      'onStateChange': onPlayerStateChange
    }
  });
}

function onPlayerStateChange(event) {
	if( event.data == YT.PlayerState.PLAYING ) {
		if( jQuery('#mysite_scrolling_slider').length>0){
			jQuery('#mysite_scrolling_slider').data('scrollable').stop();
			jQuery('#slider_module_inner').mouseout(function() {
				jQuery('#mysite_scrolling_slider').data('scrollable').stop();
			});
		}
		if( jQuery('#fading_slides').length>0){
			jQuery('.slider_nav').data('slideshow').stop();
		}
	}
}

/*
 * Vimeo api events
 */
var VimeoEmbed = {};

VimeoEmbed.vimeo_player_loaded = function(player_id) {
	VimeoEmbed.setupAPIEventListeners(player_id);
};

VimeoEmbed.setupAPIEventListeners = function(target) {
	iframe_player = document.getElementById(target);
	iframe_player.addEvent( 'onPlay', VimeoEmbed.vimeo_on_play);
};

VimeoEmbed.vimeo_on_play = function(player_id) {
    if( jQuery('#mysite_scrolling_slider').length>0){
		jQuery('#mysite_scrolling_slider').data('scrollable').stop();
		jQuery('#slider_module_inner').mouseout(function() {
			jQuery('#mysite_scrolling_slider').data('scrollable').stop();
		});
	}
	if( jQuery('#fading_slides').length>0){
		jQuery('.slider_nav').data('slideshow').stop();
	}
};

/*
 * Contact ajaxForm
 */
(function($)
{
	$(function() {
		try {
			
			$('div.mysite_form > form').ajaxForm({
				
				data: { '_mysite_form_ajax_submit': 1 },
				dataType: 'json',
				success: function(data) {
					if($.browser.safari){ bodyelem = $('body') } else { bodyelem = $('html') }
					
					jQuery(data.into).find(':input').each(function() {
						jQuery(this).removeClass('required_error');
					});
					
					if(data.errors) {
						
						if(data.errored_fields){
							$('.mysite_message').remove();
							for(var i in data.errored_fields){
							    $('#' +data.errored_fields[i]).addClass('required_error');
							}
							bodyelem.animate({ scrollTop: $(data.into).offset().top-80
					  		}, 'slow', function(){
								jQuery('.mysite_contact_feedback').css('display','none');
							});
						}
						
						if(data.errored_fields == '' || !data.sidebar){
							if(data.errors) {
							  	bodyelem.animate({
							    	scrollTop: $(data.into).offset().top-80
							  		}, 'slow', function(){
										$('.mysite_message').remove();
										$(data.errors).css('display', 'none').prependTo(data.into).slideDown('slow');
										jQuery('.mysite_contact_feedback').css('display','none');
								});
							}
						}
					}
					 
					if( data.mail_sent ) {
						$('.mysite_message').remove();
						$(data.into + ' > form').remove(); 
						bodyelem.animate({
					    	scrollTop: $(data.into).offset().top-80
					  		}, 'slow', function(){
								$(data.success).css('display', 'none').prependTo(data.into).slideDown('slow');
								jQuery('.mysite_contact_feedback').css('display','none');
						});
					}
				}
				 
			});
			
		} catch (e) {
			//suppress error
		}
	});
	
})(jQuery);

/*
 * Mysitemyway image preloader
 */
(function($)
{
	$.fn.preloader = function(options) {
		var defaults = {
			selector: '',
			imgSelector: 'img:not(.nopreload)',
			imgAppend: 'a',
			fade: true,
			delay: 500,
			fadein: 400,
			slider: false,
			imageResize: imageResize,
			resizeDisabled: resizeDisabled,
			nonce: imageNonce,
			beforeShowAll: function(){},
			onDone: function(){},
			oneachload: function(image){}
			
		},
		options = $.extend({}, defaults, options);
		
		var ua = $.browser,
			uaVersion = ua.version.substring(0,1);
		
		if(options.imageResize == 'wordpress')
			options.delay = 0;
			
		return this.each(function() {
			
			options.beforeShowAll.call(this);
			
			var $this = $(this),
				 images = $this.find(options.imgSelector),
				 count = images.length;
				
			$this.load = {
				
				preload: function(count) {
					if(count>0) {
						$this.load.loadImage(0,count);
					} else if (options.slider && $this.find('.video_frame').length>0){
						options.onDone.call(this);
					} else {
						return;
					}
				},
				
				loadImage: function(i,count) {
					if(i<count) {
						var imgId = Math.floor(Math.random()*1000)+'_img_';
						$this.load.append(i,imgId);

						if(options.imageResize == 'timthumb' || options.resizeDisabled == 'true')
							$this.load.loader(i,$(images[i]).attr('src'),imgId);
							
						if( (options.imageResize == 'wordpress') && (options.resizeDisabled == false) )
								$this.load.resize(i,imgId);
						
					} else {
						options.onDone.call(this);
					}
				},
				
				append: function(i,imgId) {
						$('<span id="'+imgId+(i+1)+'"></span>').each(function() {
							if( options.imgAppend ) {
								$(this).appendTo($this.find(options.imgAppend).eq(i));
							} else {
								$(this).appendTo($(options.selector));
							}
						   	
						});
				},
				
				loader: function(i,image,imgId) {
					var newImage = new Image(),
						currImage = $('#'+imgId+(i+1)),
						title = ( $(images[i]).attr('title') ) ? $(images[i]).attr('title') : '';
						
		        $(newImage).load(function () {
					var currImgWidth = $(images[i]).attr('width'),
						currImgHeight = $(images[i]).attr('height');
			
					$(this).attr('width', currImgWidth);
					$(this).attr('height', currImgHeight);
					
						if(responsiveSite == 'true' && options.fade){
							paddingBottom = currImgHeight*100/$(images[i]).attr('width');
							$(images[i]).parent().parent().prepend('<span class="placeholder" style="padding-bottom:'+paddingBottom+'%;display:block;padding-top:'+imagePadding+'px;height:0;width:100%;"></span>');
							$(images[i]).parent().remove();
						
						} else {
							$(images[i]).parent().remove()
						}
					
						
						if( options.fade ) {
							$(this).css('display','none');
							$(currImage).append(this);

							j = i+1;
							
							// Remove preloader
							$(this).parent().prev().delay(j*options.delay).queue(function() {
								$(this).remove();
								
								if(responsiveSite == 'true'){
									currImage.prev().remove();
								}
							});
							
							// FadeIn image
							$(this).delay(j*options.delay).fadeIn(options.fadein).queue(function() {
								$(this).addClass($(images[i]).attr('class'));
								if( $(this).parent().parent().is('a')) {
									if(($(this).parent().parent().attr('rel'))){
										if($(this).parent().parent().attr('rel').match('prettyPhoto')){
											var filename = $(this).parent().parent().attr('href'),
												videos=['swf','youtube','vimeo','mov'];
											for(var v in videos){
											    if(filename.match(videos[v])){
													var video_icon = true;
												}else{
													var zoom_icon = true;
												}
											}
										}
									}
									
									//$(this).parent().prev().remove();
									
								} else {
									//$(this).parent().prev().remove();
								}
								
							if( video_icon ){
								$(this).parent().parent().css('backgroundImage','url(' +assetsUri+ '/play.png)');
								
							}else if(zoom_icon){
								$(this).parent().parent().css('backgroundImage','url(' +assetsUri+ '/zoom.png)');
							}
							
							options.oneachload.call(this, this);
						});
						if( (!ua.msie) || (uaVersion >= '9' && ua.msie) ){
							$this.load.loadImage(i+1,count);
						}
						
					} else {
						$(this).addClass($(images[i]).attr('class'));
						$(currImage).append(this);
						if( (!ua.msie) || (uaVersion >= '9' && ua.msie) ){
							$this.load.loadImage(i+1,count);
						}
						options.oneachload.call(this, this);
					}
						
		        }).error(function () {
					// try to load next item
					$this.load.loadImage(i+1,count);
		        })
				  .attr('src', image)
				  .attr('title', title)
				  .attr('alt', $(images[i]).attr('alt'));
				
			 	  if(uaVersion <= '8' && ua.msie){
					  $this.load.loadImage(i+1,count);
				  }
				
				},
				
				resize: function(i,imgId) {
					var imgResize = $('<input>', { type: 'text', name:'ajax_image_resize_url', val: $(images[i]).attr('src') })
						imgWidth = $('<input>', { type: 'text', name:'img_width', val: $(images[i]).attr('width') }),
						imgHeight = $('<input>', { type: 'text', name:'img_height', val: $(images[i]).attr('height') }),
						j5M5601 = $('<input>', { type: 'text', name:'j5M5601', val: options.nonce });
						
					postData = imgResize.add(imgWidth).add(imgHeight).add(j5M5601).serialize();
					
					$.ajax({
						type: 'POST',
						dataType: 'json',
						data: postData,
						beforeSend: function(x) {
					        if(x && x.overrideMimeType) {
					            x.overrideMimeType('application/json;charset=UTF-8');
					        }
					    },
						success: function(data) {
							$this.load.loader(i,data.url,imgId);
					    }
					});
				}
				
			};
			
			$this.load.preload(count);
		});
	}
})(jQuery);


/*********************
//* jQuery Multi Level CSS Menu #2- By Dynamic Drive: http://www.dynamicdrive.com/
//* Last update: Nov 7th, 08': Limit # of queued animations to minmize animation stuttering
//* Menu avaiable at DD CSS Library: http://www.dynamicdrive.com/style/
*********************/

//Update: April 12th, 10: Fixed compat issue with jquery 1.4x

//Specify full URL to down and right arrow images (23 is padding-right to add to top level LIs with drop downs):
var arrowimages={down:['', ''], right:['', '']}

var jqueryslidemenu={

animateduration: {over: 200, out: 25}, //duration of slide in/ out animation, in milliseconds

buildmenu:function(menuid, arrowsvar){
	jQuery(document).ready(function($){
		$(" #main_navigation a").removeAttr("title");

		var $mainmenu=$("."+menuid+">ul")
		var $headers=$mainmenu.find("ul").parent()
		$headers.each(function(i){
			var $curobj=$(this)
			var $subul=$(this).find('ul:eq(0)')
			this._dimensions={w:this.offsetWidth, h:this.offsetHeight, subulw:$subul.outerWidth(), subulh:$subul.outerHeight()}
			this.istopheader=$curobj.parents("ul").length==1? true : false
			$subul.css({top:this.istopheader? this._dimensions.h+"px" : 0})
			
			/*
			$curobj.children("a:eq(0)").css(this.istopheader? {paddingRight: arrowsvar.down[2]} : {}).append(
				'<img src="'+ (this.istopheader? arrowsvar.down[1] : arrowsvar.right[1])
				+'" class="' + (this.istopheader? arrowsvar.down[0] : arrowsvar.right[0])
				+ '" style="border:0;" />'
			)*/
			
			$curobj.hover(
				function(e){
					var $targetul=$(this).children("ul:eq(0)")
					this._offsets={left:$(this).offset().left, top:$(this).offset().top}
					
					if(jQuery.browser.msie){
						var menuleft=this.istopheader? 0 : this._dimensions.w +2
						menuleft=(this._offsets.left+menuleft+this._dimensions.subulw>$(window).width())? (this.istopheader? -this._dimensions.subulw+this._dimensions.w : -this._dimensions.w) -4 : menuleft
					}
					if(!jQuery.browser.msie){
						var menuleft=this.istopheader? 0 : this._dimensions.w
						menuleft=(this._offsets.left+menuleft+this._dimensions.subulw>$(window).width())? (this.istopheader? -this._dimensions.subulw+this._dimensions.w : -this._dimensions.w) : menuleft
					}
					if ($targetul.queue().length<=1){
						$targetul.css({left:menuleft+"px", width:this._dimensions.subulw+'px'}).slideDown(jqueryslidemenu.animateduration.over, function() {
						    // Animation complete
							jQuery(this).find('li a span').css('display','block')
						  })
						
						if(jQuery.browser.msie){
							ieVersion = jQuery.browser.version.substring(0,1);
							if( ieVersion == 7 ){ var disableArrors = true; }
					    }
						if( !disableArrors ) {
							if(this.istopheader && jQuery(this).children().eq(0).find('span.menu_arrow').length<1) {
								$curobj.children("a:eq(0)").append(
										'<span class="menu_arrow"></span>'
								)
							}
						}
					} //if 1 or less queued animations
						
				},
				function(e){
					var $targetul=$(this).children("ul:eq(0)")
					$targetul.slideUp(jqueryslidemenu.animateduration.out)
				}
			) //end hover
			$curobj.click(function(){
				$(this).children("ul:eq(0)").hide()
			})
		}) //end $headers.each()
		$mainmenu.find("ul").css({display:'none', visibility:'visible'})
	}) //end document.ready
}
};
//build menu with ID="main_navigation" on page:
if(disableSlidemenu == 'false' ){
	jqueryslidemenu.buildmenu("jqueryslidemenu", arrowimages);
}


/*
    reflection.js for jQuery v1.03
    (c) 2006-2009 Christophe Beyls <http://www.digitalia.be>
    MIT-style license.
*/
(function(a){a.fn.extend({reflect:function(b){b=a.extend({height:1/3,opacity:0.5},b);return this.unreflect().each(function(){var c=this;if(/^img$/i.test(c.tagName)){function d(){var g=c.width,f=c.height,l,i,m,h,k;i=Math.floor((b.height>1)?Math.min(f,b.height):f*b.height);if(a.browser.msie){l=a("<img />").attr("src",c.src).css({width:g,height:f,marginBottom:i-f,filter:"flipv progid:DXImageTransform.Microsoft.Alpha(opacity="+(b.opacity*100)+", style=1, finishOpacity=0, startx=0, starty=0, finishx=0, finishy="+(i/f*100)+")"})[0]}else{l=a("<canvas />")[0];if(!l.getContext){return}h=l.getContext("2d");try{a(l).attr({width:g,height:i});h.save();h.translate(0,f-1);h.scale(1,-1);h.drawImage(c,0,0,g,f);h.restore();h.globalCompositeOperation="destination-out";k=h.createLinearGradient(0,0,0,i);k.addColorStop(0,"rgba(255, 255, 255, "+(1-b.opacity)+")");k.addColorStop(1,"rgba(255, 255, 255, 1.0)");h.fillStyle=k;h.rect(0,0,g,i);h.fill()}catch(j){return}}a(l).css({display:"block",border:0});m=a(/^a$/i.test(c.parentNode.tagName)?"<span />":"<div />").insertAfter(c).append([c,l])[0];m.className=c.className;a.data(c,"reflected",m.style.cssText=c.style.cssText);a(m).css({width:g,height:f+i,overflow:"hidden"});c.style.cssText="display: block; border: 0px";c.className="reflected"}if(c.complete){d()}else{a(c).load(d)}}})},unreflect:function(){return this.unbind("load").each(function(){var c=this,b=a.data(this,"reflected"),d;if(b!==undefined){d=c.parentNode;c.className=d.className;c.style.cssText=b;a.removeData(c,"reflected");d.parentNode.replaceChild(c,d)}})}})})(jQuery);

/**
* hoverIntent r5 // 2007.03.27 // jQuery 1.1.2+
* <http://cherne.net/brian/resources/jquery.hoverIntent.html>
* 
* @param  f  onMouseOver function || An object with configuration options
* @param  g  onMouseOut function  || Nothing (use configuration options object)
* @author    Brian Cherne <brian@cherne.net>
*/
(function($){$.fn.hoverIntent=function(f,g){var cfg={sensitivity:7,interval:100,timeout:0};cfg=$.extend(cfg,g?{over:f,out:g}:f);var cX,cY,pX,pY;var track=function(ev){cX=ev.pageX;cY=ev.pageY;};var compare=function(ev,ob){ob.hoverIntent_t=clearTimeout(ob.hoverIntent_t);if((Math.abs(pX-cX)+Math.abs(pY-cY))<cfg.sensitivity){$(ob).unbind("mousemove",track);ob.hoverIntent_s=1;return cfg.over.apply(ob,[ev]);}else{pX=cX;pY=cY;ob.hoverIntent_t=setTimeout(function(){compare(ev,ob);},cfg.interval);}};var delay=function(ev,ob){ob.hoverIntent_t=clearTimeout(ob.hoverIntent_t);ob.hoverIntent_s=0;return cfg.out.apply(ob,[ev]);};var handleHover=function(e){var p=(e.type=="mouseover"?e.fromElement:e.toElement)||e.relatedTarget;while(p&&p!=this){try{p=p.parentNode;}catch(e){p=this;}}if(p==this){return false;}var ev=jQuery.extend({},e);var ob=this;if(ob.hoverIntent_t){ob.hoverIntent_t=clearTimeout(ob.hoverIntent_t);}if(e.type=="mouseover"){pX=ev.pageX;pY=ev.pageY;$(ob).bind("mousemove",track);if(ob.hoverIntent_s!=1){ob.hoverIntent_t=setTimeout(function(){compare(ev,ob);},cfg.interval);}}else{$(ob).unbind("mousemove",track);if(ob.hoverIntent_s==1){ob.hoverIntent_t=setTimeout(function(){delay(ev,ob);},cfg.timeout);}}};return this.mouseover(handleHover).mouseout(handleHover);};})(jQuery);

/*
 * jQuery Easing v1.3 - http://gsgd.co.uk/sandbox/jquery/easing/
 *
 * Uses the built in easing capabilities added In jQuery 1.1
 * to offer multiple easing options
 *
 * TERMS OF USE - jQuery Easing
 * 
 * Open source under the BSD License. 
 * 
 * Copyright © 2008 George McGinley Smith
 * All rights reserved.
 * 
 * Redistribution and use in source and binary forms, with or without modification, 
 * are permitted provided that the following conditions are met:
 * 
 * Redistributions of source code must retain the above copyright notice, this list of 
 * conditions and the following disclaimer.
 * Redistributions in binary form must reproduce the above copyright notice, this list 
 * of conditions and the following disclaimer in the documentation and/or other materials 
 * provided with the distribution.
 * 
 * Neither the name of the author nor the names of contributors may be used to endorse 
 * or promote products derived from this software without specific prior written permission.
 * 
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY 
 * EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF
 * MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
 *  COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL,
 *  EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE
 *  GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED 
 * AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING
 *  NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED 
 * OF THE POSSIBILITY OF SUCH DAMAGE. 
 *
*/

jQuery.easing['jswing']=jQuery.easing['swing'];jQuery.extend(jQuery.easing,{def:'easeOutQuad',swing:function(x,t,b,c,d){return jQuery.easing[jQuery.easing.def](x,t,b,c,d);},easeInQuad:function(x,t,b,c,d){return c*(t/=d)*t+b;},easeOutQuad:function(x,t,b,c,d){return-c*(t/=d)*(t-2)+b;},easeInOutQuad:function(x,t,b,c,d){if((t/=d/2)<1)return c/2*t*t+b;return-c/2*((--t)*(t-2)-1)+b;},easeInCubic:function(x,t,b,c,d){return c*(t/=d)*t*t+b;},easeOutCubic:function(x,t,b,c,d){return c*((t=t/d-1)*t*t+1)+b;},easeInOutCubic:function(x,t,b,c,d){if((t/=d/2)<1)return c/2*t*t*t+b;return c/2*((t-=2)*t*t+2)+b;},easeInQuart:function(x,t,b,c,d){return c*(t/=d)*t*t*t+b;},easeOutQuart:function(x,t,b,c,d){return-c*((t=t/d-1)*t*t*t-1)+b;},easeInOutQuart:function(x,t,b,c,d){if((t/=d/2)<1)return c/2*t*t*t*t+b;return-c/2*((t-=2)*t*t*t-2)+b;},easeInQuint:function(x,t,b,c,d){return c*(t/=d)*t*t*t*t+b;},easeOutQuint:function(x,t,b,c,d){return c*((t=t/d-1)*t*t*t*t+1)+b;},easeInOutQuint:function(x,t,b,c,d){if((t/=d/2)<1)return c/2*t*t*t*t*t+b;return c/2*((t-=2)*t*t*t*t+2)+b;},easeInSine:function(x,t,b,c,d){return-c*Math.cos(t/d*(Math.PI/2))+c+b;},easeOutSine:function(x,t,b,c,d){return c*Math.sin(t/d*(Math.PI/2))+b;},easeInOutSine:function(x,t,b,c,d){return-c/2*(Math.cos(Math.PI*t/d)-1)+b;},easeInExpo:function(x,t,b,c,d){return(t==0)?b:c*Math.pow(2,10*(t/d-1))+b;},easeOutExpo:function(x,t,b,c,d){return(t==d)?b+c:c*(-Math.pow(2,-10*t/d)+1)+b;},easeInOutExpo:function(x,t,b,c,d){if(t==0)return b;if(t==d)return b+c;if((t/=d/2)<1)return c/2*Math.pow(2,10*(t-1))+b;return c/2*(-Math.pow(2,-10*--t)+2)+b;},easeInCirc:function(x,t,b,c,d){return-c*(Math.sqrt(1-(t/=d)*t)-1)+b;},easeOutCirc:function(x,t,b,c,d){return c*Math.sqrt(1-(t=t/d-1)*t)+b;},easeInOutCirc:function(x,t,b,c,d){if((t/=d/2)<1)return-c/2*(Math.sqrt(1-t*t)-1)+b;return c/2*(Math.sqrt(1-(t-=2)*t)+1)+b;},easeInElastic:function(x,t,b,c,d){var s=1.70158;var p=0;var a=c;if(t==0)return b;if((t/=d)==1)return b+c;if(!p)p=d*.3;if(a<Math.abs(c)){a=c;var s=p/4;}
else var s=p/(2*Math.PI)*Math.asin(c/a);return-(a*Math.pow(2,10*(t-=1))*Math.sin((t*d-s)*(2*Math.PI)/p))+b;},easeOutElastic:function(x,t,b,c,d){var s=1.70158;var p=0;var a=c;if(t==0)return b;if((t/=d)==1)return b+c;if(!p)p=d*.3;if(a<Math.abs(c)){a=c;var s=p/4;}
else var s=p/(2*Math.PI)*Math.asin(c/a);return a*Math.pow(2,-10*t)*Math.sin((t*d-s)*(2*Math.PI)/p)+c+b;},easeInOutElastic:function(x,t,b,c,d){var s=1.70158;var p=0;var a=c;if(t==0)return b;if((t/=d/2)==2)return b+c;if(!p)p=d*(.3*1.5);if(a<Math.abs(c)){a=c;var s=p/4;}
else var s=p/(2*Math.PI)*Math.asin(c/a);if(t<1)return-.5*(a*Math.pow(2,10*(t-=1))*Math.sin((t*d-s)*(2*Math.PI)/p))+b;return a*Math.pow(2,-10*(t-=1))*Math.sin((t*d-s)*(2*Math.PI)/p)*.5+c+b;},easeInBack:function(x,t,b,c,d,s){if(s==undefined)s=1.70158;return c*(t/=d)*t*((s+1)*t-s)+b;},easeOutBack:function(x,t,b,c,d,s){if(s==undefined)s=1.70158;return c*((t=t/d-1)*t*((s+1)*t+s)+1)+b;},easeInOutBack:function(x,t,b,c,d,s){if(s==undefined)s=1.70158;if((t/=d/2)<1)return c/2*(t*t*(((s*=(1.525))+1)*t-s))+b;return c/2*((t-=2)*t*(((s*=(1.525))+1)*t+s)+2)+b;},easeInBounce:function(x,t,b,c,d){return c-jQuery.easing.easeOutBounce(x,d-t,0,c,d)+b;},easeOutBounce:function(x,t,b,c,d){if((t/=d)<(1/2.75)){return c*(7.5625*t*t)+b;}else if(t<(2/2.75)){return c*(7.5625*(t-=(1.5/2.75))*t+.75)+b;}else if(t<(2.5/2.75)){return c*(7.5625*(t-=(2.25/2.75))*t+.9375)+b;}else{return c*(7.5625*(t-=(2.625/2.75))*t+.984375)+b;}},easeInOutBounce:function(x,t,b,c,d){if(t<d/2)return jQuery.easing.easeInBounce(x,t*2,0,c,d)*.5+b;return jQuery.easing.easeOutBounce(x,t*2-d,0,c,d)*.5+c*.5+b;}});

/* 
 * No Spam (1.3)
 * by Mike Branski (www.leftrightdesigns.com)
 * mikebranski@gmail.com
 *
 * Copyright (c) 2008 Mike Branski (www.leftrightdesigns.com)
 * Licensed under GPL (www.leftrightdesigns.com/library/jquery/nospam/gpl.txt)
 *
 * NOTE: This script requires jQuery to work.  Download jQuery at www.jquery.com
 *
 * Thanks to Bill on the jQuery mailing list for the double slash idea!
 *
 * CHANGELOG:
 * v 1.3   - Added support for e-mail addresses with multiple dots (.) both before and after the at (@) sign
 * v 1.2.1 - Included GPL license
 * v 1.2   - Finalized name as No Spam (was Protect Email)
 * v 1.1   - Changed switch() to if() statement
 * v 1.0   - Initial release
 *
 */

jQuery.fn.nospam = function(settings) {
	settings = jQuery.extend({
		replaceText: false, 	// optional, accepts true or false
		filterLevel: 'normal' 	// optional, accepts 'low' or 'normal'
	}, settings);
	
	return this.each(function(){
		e = null;
		if(settings.filterLevel == 'low') { // Can be a switch() if more levels added
			if(jQuery(this).is('a[rel]')) {
				e = jQuery(this).attr('rel').replace('//', '@').replace(/\//g, '.');
			} else {
				e = jQuery(this).text().replace('//', '@').replace(/\//g, '.');
			}
		} else { // 'normal'
			if(jQuery(this).is('a[rel]')) {
				e = jQuery(this).attr('rel').split('').reverse().join('').replace('//', '@').replace(/\//g, '.');
			} else {
				e = jQuery(this).text().split('').reverse().join('').replace('//', '@').replace(/\//g, '.');
			}
		}
		if(e) {
			if(jQuery(this).is('a[rel]')) {
				jQuery(this).attr('href', 'mailto:' + e);
				if(settings.replaceText) {
					jQuery(this).text(e);
				}
			} else {
				jQuery(this).text(e);
			}
		}
	});
};


/*

CUSTOM FORM ELEMENTS

Created by Ryan Fait
www.ryanfait.com

The only things you may need to change in this file are the following
variables: checkboxHeight, radioHeight and selectWidth (lines 24, 25, 26)

The numbers you set for checkboxHeight and radioHeight should be one quarter
of the total height of the image want to use for checkboxes and radio
buttons. Both images should contain the four stages of both inputs stacked
on top of each other in this order: unchecked, unchecked-clicked, checked,
checked-clicked.

You may need to adjust your images a bit if there is a slight vertical
movement during the different stages of the button activation.

The value of selectWidth should be the width of your select list image.

Visit http://ryanfait.com/ for more information.

*/

var checkboxHeight = "25";
var radioHeight = "25";
var selectWidth = "190";


/* No need to change anything after this */


document.write('<style type="text/css">input.styled { display: none; } select.styled { position: relative; width: ' + selectWidth + 'px; opacity: 0; filter: alpha(opacity=0); z-index: 5; } .disabled { opacity: 0.5; filter: alpha(opacity=50); }</style>');

var Custom = {
	init: function() {
		var inputs = document.getElementsByTagName("input"), span = Array(), textnode, option, active;
		for(a = 0; a < inputs.length; a++) {
			if((inputs[a].type == "checkbox" || inputs[a].type == "radio") && jQuery(inputs[a]).hasClass('styled')) {
				span[a] = document.createElement("span");
				span[a].className = inputs[a].type;

				if(inputs[a].checked == true) {
					if(inputs[a].type == "checkbox") {
						position = "0 -" + (checkboxHeight*2) + "px";
						span[a].style.backgroundPosition = position;
					} else {
						position = "0 -" + (radioHeight*2) + "px";
						span[a].style.backgroundPosition = position;
					}
				}
				inputs[a].parentNode.insertBefore(span[a], inputs[a]);
				inputs[a].onchange = Custom.clear;
				if(!inputs[a].getAttribute("disabled")) {
					span[a].onmousedown = Custom.pushed;
					span[a].onmouseup = Custom.check;
				} else {
					span[a].className = span[a].className += " disabled";
				}
			}
		}
		inputs = document.getElementsByTagName("select");
		for(a = 0; a < inputs.length; a++) {
			if(jQuery(inputs[a]).hasClass('styled')) {
				option = inputs[a].getElementsByTagName("option");
				active = option[0].childNodes[0].nodeValue;
				textnode = document.createTextNode(active);
				for(b = 0; b < option.length; b++) {
					if(option[b].selected == true) {
						textnode = document.createTextNode(option[b].childNodes[0].nodeValue);
					}
				}
				span[a] = document.createElement("span");
				span[a].className = "select";
				span[a].id = "select" + inputs[a].name;
				span[a].appendChild(textnode);
				inputs[a].parentNode.insertBefore(span[a], inputs[a]);
				if(!inputs[a].getAttribute("disabled")) {
					inputs[a].onchange = Custom.choose;
				} else {
					inputs[a].previousSibling.className = inputs[a].previousSibling.className += " disabled";
				}
			}
		}
		document.onmouseup = Custom.clear;
	},
	pushed: function() {
		element = this.nextSibling;
		if(element.checked == true && element.type == "checkbox") {
			this.style.backgroundPosition = "0 -" + checkboxHeight*3 + "px";
		} else if(element.checked == true && element.type == "radio") {
			this.style.backgroundPosition = "0 -" + radioHeight*3 + "px";
		} else if(element.checked != true && element.type == "checkbox") {
			this.style.backgroundPosition = "0 -" + checkboxHeight + "px";
		} else {
			this.style.backgroundPosition = "0 -" + radioHeight + "px";
		}
	},
	check: function() {
		element = this.nextSibling;
		if(element.checked == true && element.type == "checkbox") {
			this.style.backgroundPosition = "0 0";
			element.checked = false;
		} else {
			if(element.type == "checkbox") {
				this.style.backgroundPosition = "0 -" + checkboxHeight*2 + "px";
			} else {
				this.style.backgroundPosition = "0 -" + radioHeight*2 + "px";
				group = this.nextSibling.name;
				inputs = document.getElementsByTagName("input");
				for(a = 0; a < inputs.length; a++) {
					if(inputs[a].name == group && inputs[a] != this.nextSibling) {
						inputs[a].previousSibling.style.backgroundPosition = "0 0";
					}
				}
			}
			element.checked = true;
		}
	},
	clear: function() {
		inputs = document.getElementsByTagName("input");
		for(var b = 0; b < inputs.length; b++) {
			if(inputs[b].type == "checkbox" && inputs[b].checked == true && jQuery(inputs[b]).hasClass('styled')) {
				inputs[b].previousSibling.style.backgroundPosition = "0 -" + checkboxHeight*2 + "px";
			} else if(inputs[b].type == "checkbox" && jQuery(inputs[b]).hasClass('styled')) {
				inputs[b].previousSibling.style.backgroundPosition = "0 0";
			} else if(inputs[b].type == "radio" && inputs[b].checked == true && jQuery(inputs[b]).hasClass('styled')) {
				inputs[b].previousSibling.style.backgroundPosition = "0 -" + radioHeight*2 + "px";
			} else if(inputs[b].type == "radio" && jQuery(inputs[b]).hasClass('styled')) {
				inputs[b].previousSibling.style.backgroundPosition = "0 0";
			}
		}
	},
	choose: function() {
		option = this.getElementsByTagName("option");
		for(d = 0; d < option.length; d++) {
			if(option[d].selected == true) {
				document.getElementById("select" + this.name).childNodes[0].nodeValue = option[d].childNodes[0].nodeValue;
			}
		}
	}
}
window.onload = Custom.init;


/* Copyright 2011, Ben Lin (http://dreamerslab.com/)
* Licensed under the MIT License (LICENSE.txt).
*
* Version: 1.0.5
*
* Requires: jQuery 1.2.3+
*/
;(function(a){a.fn.extend({actual:function(b,k){var c,d,h,g,f,j,e,i;if(!this[b]){throw'$.actual => The jQuery method "'+b+'" you called does not exist';}h=a.extend({absolute:false,clone:false,includeMargin:undefined},k);d=this;if(h.clone===true){e=function(){d=d.filter(":first").clone().css({position:"absolute",top:-1000}).appendTo("body");};i=function(){d.remove();};}else{e=function(){c=d.parents().andSelf().filter(":hidden");g=h.absolute===true?{position:"absolute",visibility:"hidden",display:"block"}:{visibility:"hidden",display:"block"};f=[];c.each(function(){var m={},l;for(l in g){m[l]=this.style[l];this.style[l]=g[l];}f.push(m);});};i=function(){c.each(function(m){var n=f[m],l;for(l in g){this.style[l]=n[l];}});};}e();j=d[b](h.includeMargin);i();return j;}});})(jQuery);

// ####################################################################################
// #######                                                                      #######
// ####### Plugin:      jScroll                                                 #######
// ####### Author:      William Duffy                                           #######
// ####### Website:     http://www.wduffy.co.uk/jScroll                         #######
// ####### Version:     1.1	                                                    #######
// #######                                                                      #######
// ####### Copyright (c) 2011, William Duffy - www.wduffy.co.uk                 #######
// #######                                                                      #######
// ####### Permission is hereby granted, free of charge, to any person          #######
// ####### obtaining a copy of this software and associated documentation       #######
// ####### files (the "Software"), to deal in the Software without              #######
// ####### restriction, including without limitation the rights to use,         #######
// ####### copy, modify, merge, publish, distribute, sublicense, and/or sell    #######
// ####### copies of the Software, and to permit persons to whom the            #######
// ####### Software is furnished to do so, subject to the following             #######
// ####### conditions:                                                          #######
// #######                                                                      #######
// ####### The above copyright notice and this permission notice shall be       #######
// ####### included in all copies or substantial portions of the Software.      #######
// #######                                                                      #######
// ####### THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,      #######
// ####### EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES      #######
// ####### OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND             #######
// ####### NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT          #######
// ####### HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY,         #######
// ####### WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING         #######
// ####### FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR        #######
// ####### OTHER DEALINGS IN THE SOFTWARE.                                      #######
// #######                                                                      #######
// ####################################################################################

(function($){$.fn.jScroll=function(e){var f=$.extend({},$.fn.jScroll.defaults,e);return this.each(function(){var a=$(this);var b=$(window);var c=new location(a);b.scroll(function(){a.stop().animate(c.getMargin(b),f.speed)})});function location(d){this.min=d.offset().top;this.originalMargin=parseInt(d.css("margin-top"),10)||0;this.getMargin=function(a){var b=d.parent().height()-d.outerHeight();var c=this.originalMargin;if(a.scrollTop()>=this.min)c=c+f.top+a.scrollTop()-this.min;if(c>b)c=b;return({"marginTop":c+'px'})}}};$.fn.jScroll.defaults={speed:"slow",top:10}})(jQuery);


/*!
* FitVids 1.0
*
* Copyright 2011, Chris Coyier - http://css-tricks.com + Dave Rupert - http://daverupert.com
* Credit to Thierry Koblentz - http://www.alistapart.com/articles/creating-intrinsic-ratios-for-video/
* Released under the WTFPL license - http://sam.zoy.org/wtfpl/
*
* Date: Thu Sept 01 18:00:00 2011 -0500
*/
(function(a){a.fn.fitVids=function(b){var c={customSelector:null};var e=document.createElement("div"),d=document.getElementsByTagName("base")[0]||document.getElementsByTagName("script")[0];e.className="fit-vids-style";e.innerHTML="&shy;<style>.fluid-width-video-wrapper{width:100%;position: relative;padding:0;}.fluid-width-video-wrapper iframe,.fluid-width-video-wrapper object,.fluid-width-video-wrapper embed {position:absolute;top: 0;left: 0;width:100%!important;height:100%!important;}</style>";d.parentNode.insertBefore(e,d);if(b){a.extend(c,b)}return this.each(function(){var f=["iframe[src*='player.vimeo.com']","iframe[src*='www.youtube.com']","iframe[src*='www.kickstarter.com']","object","embed"];if(c.customSelector){f.push(c.customSelector)}var g=a(this).find(f.join(","));g.each(function(){var k=a(this);if(this.tagName.toLowerCase()=="embed"&&k.parent("object").length||k.parent(".fluid-width-video-wrapper").length){return}var h=this.tagName.toLowerCase()=="object"?k.attr("height"):k.height(),i=h/k.width();if(!k.attr("id")){var j="fitvid"+Math.floor(Math.random()*999999);k.attr("id",j)}k.wrap('<div class="fluid-width-video-wrapper"></div>').parent(".fluid-width-video-wrapper").css("padding-top",(i*100)+"%");k.removeAttr("height").removeAttr("width")})})}})(jQuery);


/**
 * Vimeo Api
 * http://github.com/vimeo/froogaloop/raw/master/froogaloop.min.js
 */
var Froogaloop=function(){var e={hasWindowEvent:false,PLAYER_DOMAIN:"",eventCallbacks:{},iframe_pattern:/player\.(([a-zA-Z0-9_\.]+)\.)?vimeo(ws)?\.com\/video\/([0-9]+)/i},j=function(b){b||(b=document.getElementsByTagName("iframe"));for(var a,c=0,f=b.length,g;c<f;c++){a=b[c];if(g=e.iframe_pattern.test(a.getAttribute("src"))){a.api=h.api;a.get=h.get;a.addEvent=h.addEvent}}},h={api:function(b,a){i(b,a,this)},get:function(b,a){k(b,a,this.id!=""?this.id:null);i(b,null,this)},addEvent:function(b,a){k(b,
a,this.id!=""?this.id:null);b!="onLoad"&&i("api_addEventListener",[b,a.name],this);if(e.hasWindowEvent)return false;e.PLAYER_DOMAIN=d.getDomainFromUrl(this.getAttribute("src"));window.addEventListener?window.addEventListener("message",l,false):window.attachEvent("onmessage",l,false);e.hasWindowEvent=true}},i=function(b,a,c){if(!c.contentWindow.postMessage)return false;if(a===undefined||a===null)a="";var f=c.getAttribute("src").split("?")[0];b=d.serialize({method:b,params:a,id:c.getAttribute("id")});
c.contentWindow.postMessage(b,f)},k=function(b,a,c){if(c){e.eventCallbacks[c]||(e.eventCallbacks[c]={});e.eventCallbacks[c][b]=a}else e.eventCallbacks[b]=a},l=function(b){if(b.origin!=e.PLAYER_DOMAIN)return false;var a=d.unserialize(b.data);b=a.params?a.params.split('"').join("").split(","):"";a=a.method;var c=b[b.length-1];if(c=="")c=null;if(a=c?e.eventCallbacks[c][a]:e.eventCallbacks[a])b.length>0?a.apply(null,b):a.call()},d={r20:/%20/g,isArray:function(b){return Object.prototype.toString.call(b)===
"[object Array]"},isFunction:function(b){return Object.prototype.toString.call(b)==="[object Function]"},unserialize:function(b){if(!b)return false;var a={};b=b.split("&");for(var c,f,g=0;g<b.length;g++){c=unescape(b[g].split("=")[0]);f=unescape(b[g].split("=")[1]);if(f.indexOf("=")>-1)f=d.unserialize(f);a[c]=f}return a},s:false,serialize:function(b){d.s=[];for(var a in b)d.buildParams(a,b[a]);return d.s.join("&").replace(d.r20,"+")},buildParams:function(b,a){var c=0;if(d.isArray(a)){for(;c<a.length;c++)a[c]=
encodeURIComponent(a[c]);d.addToParam(encodeURIComponent(b),a.join(","))}else d.addToParam(encodeURIComponent(b),encodeURIComponent(a))},addToParam:function(b,a){a=d.isFunction(a)?a():a;d.s[d.s.length]=b+"="+a},getDomainFromUrl:function(b){b=b.split("/");for(var a="",c=0;c<b.length;c++){if(c<3)a+=b[c];else break;if(c<2)a+="/"}return a}};j();return{init:j}}();


/**
 * YouTube Api
 */
(function(){var f=void 0,g=null,i=!1,j,l=this,m=function(a){for(var a=a.split("."),c=l,b;b=a.shift();)if(c[b]!=g)c=c[b];else return g;return c},n=function(a){return"string"==typeof a},q="closure_uid_"+Math.floor(2147483648*Math.random()).toString(36),aa=0,ba=function(a,c,b){return a.call.apply(a.bind,arguments)},ca=function(a,c,b){if(!a)throw Error();if(2<arguments.length){var d=Array.prototype.slice.call(arguments,2);return function(){var b=Array.prototype.slice.call(arguments);Array.prototype.unshift.apply(b,
d);return a.apply(c,b)}}return function(){return a.apply(c,arguments)}},s=function(a,c,b){s=Function.prototype.bind&&-1!=Function.prototype.bind.toString().indexOf("native code")?ba:ca;return s.apply(g,arguments)},t=function(a,c){var b=a.split("."),d=l;!(b[0]in d)&&d.execScript&&d.execScript("var "+b[0]);for(var e;b.length&&(e=b.shift());)!b.length&&c!==f?d[e]=c:d=d[e]?d[e]:d[e]={}},u=function(a,c){function b(){}b.prototype=c.prototype;a.s=c.prototype;a.prototype=new b};
Function.prototype.bind=Function.prototype.bind||function(a,c){if(1<arguments.length){var b=Array.prototype.slice.call(arguments,1);b.unshift(this,a);return s.apply(g,b)}return s(this,a)};var v=function(a){this.stack=Error().stack||"";a&&(this.message=""+a)};u(v,Error);v.prototype.name="CustomError";var da=function(a,c){for(var b=1;b<arguments.length;b++)var d=(""+arguments[b]).replace(/\$/g,"$$$$"),a=a.replace(/\%s/,d);return a};var w=function(a,c){c.unshift(a);v.call(this,da.apply(g,c));c.shift()};u(w,v);w.prototype.name="AssertionError";var x=function(a,c,b){if(!a){var d=Array.prototype.slice.call(arguments,2),e="Assertion failed";if(c)var e=e+(": "+c),h=d;throw new w(""+e,h||[]);}};var y=Array.prototype,ea=y.indexOf?function(a,c,b){x(a.length!=g);return y.indexOf.call(a,c,b)}:function(a,c,b){b=b==g?0:0>b?Math.max(0,a.length+b):b;if(n(a))return!n(c)||1!=c.length?-1:a.indexOf(c,b);for(;b<a.length;b++)if(b in a&&a[b]===c)return b;return-1},fa=y.forEach?function(a,c,b){x(a.length!=g);y.forEach.call(a,c,b)}:function(a,c,b){for(var d=a.length,e=n(a)?a.split(""):a,h=0;h<d;h++)h in e&&c.call(b,e[h],h,a)},ga=function(a,c,b){x(a.length!=g);return 2>=arguments.length?y.slice.call(a,c):
y.slice.call(a,c,b)};var ha=function(a){var c=z,b;for(b in c)if(a.call(f,c[b],b,c))return b};var A,B,C,D,ia=function(){return l.navigator?l.navigator.userAgent:g};D=C=B=A=i;var E;if(E=ia()){var ja=l.navigator;A=0==E.indexOf("Opera");B=!A&&-1!=E.indexOf("MSIE");C=!A&&-1!=E.indexOf("WebKit");D=!A&&!C&&"Gecko"==ja.product}var F=B,G=D,H=C,I;
a:{var J="",K;if(A&&l.opera)var L=l.opera.version,J="function"==typeof L?L():L;else if(G?K=/rv\:([^\);]+)(\)|;)/:F?K=/MSIE\s+([^\);]+)(\)|;)/:H&&(K=/WebKit\/(\S+)/),K)var ka=K.exec(ia()),J=ka?ka[1]:"";if(F){var M,la=l.document;M=la?la.documentMode:f;if(M>parseFloat(J)){I=""+M;break a}}I=J}
var ma=I,na={},N=function(a){var c;if(!(c=na[a])){c=0;for(var b=(""+ma).replace(/^[\s\xa0]+|[\s\xa0]+$/g,"").split("."),d=(""+a).replace(/^[\s\xa0]+|[\s\xa0]+$/g,"").split("."),e=Math.max(b.length,d.length),h=0;0==c&&h<e;h++){var k=b[h]||"",r=d[h]||"",xa=RegExp("(\\d*)(\\D*)","g"),ya=RegExp("(\\d*)(\\D*)","g");do{var o=xa.exec(k)||["","",""],p=ya.exec(r)||["","",""];if(0==o[0].length&&0==p[0].length)break;c=((0==o[1].length?0:parseInt(o[1],10))<(0==p[1].length?0:parseInt(p[1],10))?-1:(0==o[1].length?
0:parseInt(o[1],10))>(0==p[1].length?0:parseInt(p[1],10))?1:0)||((0==o[2].length)<(0==p[2].length)?-1:(0==o[2].length)>(0==p[2].length)?1:0)||(o[2]<p[2]?-1:o[2]>p[2]?1:0)}while(0==c)}c=na[a]=0<=c}return c},oa={},pa=function(){return oa[9]||(oa[9]=F&&!!document.documentMode&&9<=document.documentMode)};!F||pa();!G&&!F||F&&pa()||G&&N("1.9.1");F&&N("9");var qa=function(){};var O=function(){this.d=[];this.f={}};u(O,qa);O.prototype.l=1;O.prototype.h=0;var ra=function(a,c,b){var d=a.f[c];d||(d=a.f[c]=[]);var e=a.l;a.d[e]=c;a.d[e+1]=b;a.d[e+2]=f;a.l=e+3;d.push(e)};
O.prototype.r=function(a,c){var b=this.f[a];if(b){this.h++;for(var d=ga(arguments,1),e=0,h=b.length;e<h;e++){var k=b[e];this.d[k+1].apply(this.d[k+2],d)}this.h--;if(this.g&&0==this.h)for(;b=this.g.pop();)if(0!=this.h)this.g||(this.g=[]),this.g.push(b);else if(d=this.d[b]){if(d=this.f[d])e=d,d=ea(e,b),0<=d&&(x(e.length!=g),y.splice.call(e,d,1));delete this.d[b];delete this.d[b+1];delete this.d[b+2]}}};var sa=RegExp("^(?:([^:/?#.]+):)?(?://(?:([^/?#]*)@)?([\\w\\d\\-\\u0100-\\uffff.%]*)(?::([0-9]+))?)?([^?#]+)?(?:\\?([^#]*))?(?:#(.*))?$"),ta=function(a){if(P){P=i;var c=l.location;if(c){var b=c.href;if(b&&(b=(b=ta(b)[3]||g)&&decodeURIComponent(b))&&b!=c.hostname)throw P=!0,Error();}}return a.match(sa)},P=H;var Q=m("yt.dom.getNextId_");if(!Q){Q=function(){return++ua};t("yt.dom.getNextId_",Q);var ua=0};var va=function(a){if(a=a||m("window.event")){this.type=a.type;var c=a.target||a.srcElement;c&&3==c.nodeType&&(c=c.parentNode);this.target=c;if(c=a.relatedTarget)try{c=c.nodeName&&c}catch(b){c=g}else"mouseover"==this.type?c=a.fromElement:"mouseout"==this.type&&(c=a.toElement);this.relatedTarget=c;this.data=a.data;this.source=a.source;this.origin=a.origin;this.state=a.state;this.clientX=a.clientX!==f?a.clientX:a.pageX;this.clientY=a.clientY!==f?a.clientY:a.pageY;if(a.pageX||a.pageY)this.pageX=a.pageX,
this.pageY=a.pageY;else if((a.clientX||a.clientY)&&document.body&&document.documentElement)this.pageX=a.clientX+document.body.scrollLeft+document.documentElement.scrollLeft,this.pageY=a.clientY+document.body.scrollTop+document.documentElement.scrollTop;this.keyCode=a.keyCode?a.keyCode:a.which;this.charCode=a.charCode||("keypress"==this.type?this.keyCode:0);this.altKey=a.altKey;this.ctrlKey=a.ctrlKey;this.shiftKey=a.shiftKey;0==this.type.indexOf("touch")&&(this.touches=a.touches,this.changedTouches=
a.changedTouches);0==this.type.indexOf("gesture")&&(this.scale=a.scale,this.rotation=a.rotation)}};j=va.prototype;j.type="";j.target=g;j.relatedTarget=g;j.currentTarget=g;j.data=g;j.source=g;j.origin=g;j.state=g;j.keyCode=0;j.charCode=0;j.altKey=i;j.ctrlKey=i;j.shiftKey=i;j.clientX=0;j.clientY=0;j.pageX=0;j.pageY=0;j.touches=g;j.changedTouches=g;var z=m("yt.events.listeners_")||{};t("yt.events.listeners_",z);var wa=m("yt.events.counter_")||{count:0};t("yt.events.counter_",wa);var za=function(a,c){return ha(function(b){return b[0]==a&&"message"==b[1]&&b[2]==c&&b[4]==i})},Aa=function(a,c){if(a&&(a.addEventListener||a.attachEvent)){var b=za(a,c);if(!b){var b=++wa.count+"",d=function(b){b=new va(b);b.currentTarget=a;return c.call(a,b)};z[b]=[a,"message",c,d,i];a.addEventListener?a.addEventListener("message",d,i):a.attachEvent("onmessage",d)}}};t("yt.config_",window.yt&&window.yt.config_||{});t("yt.globals_",window.yt&&window.yt.globals_||{});t("yt.msgs_",window.yt&&window.yt.msgs_||{});t("yt.timeouts_",window.yt&&window.yt.timeouts_||[]);var Ba=window.yt&&window.yt.intervals_||[];t("yt.intervals_",Ba);eval("/*@cc_on!@*/false");var Ca=window.YTConfig||{},R=function(a){this.p=a||{};this.c={};this.c.width=640;this.c.height=390;this.c.title="";this.c.host=("https:"==document.location.protocol?"https:":"http:")+"//www.youtube.com"},S=g,T=function(a,c){return a.p[c]||Ca[c]||a.c[c]};R.prototype.o=function(a){a.origin==T(this,"host")&&(a=JSON.parse(a.data),S[a.id].m(a))};
var U=function(a,c){this.b=c;this.j=this.a=g;this.i=this.id=0;this.pubsub=g;var b=n(a)?document.getElementById(a):a;if(b){if("iframe"!=b.tagName.toLowerCase()){var d=document.createElement("div");d.innerHTML+=m("YT.embed_template");d=d||document;d=d.querySelectorAll&&d.querySelector&&(!H||"CSS1Compat"==document.compatMode||N("528"))?d.querySelectorAll("IFRAME"):d.getElementsByTagName("IFRAME");for(var d=d.length?d[0]:g,e=0,h=b.attributes.length;e<h;e++)d.setAttribute(b.attributes[e].name,b.attributes[e].value);
d.removeAttribute("width");d.removeAttribute("height");d.removeAttribute("src");d.setAttribute("title","YouTube "+T(this.b,"title"));d.height=T(this.b,"height");d.width=T(this.b,"width");d.src=this.k();this.j=b;(e=b.parentNode)&&e.replaceChild(d,b);b=d}this.a=b;this.id=this[q]||(this[q]=++aa);if(window.JSON&&window.postMessage){this.pubsub=new O;b=this.b;d=this.id;S||(S={},Aa(window,s(b.o,b)));S[d]=this;b=s(this.n,this);b=window.setInterval(b,250);Ba.push(b);this.i=b;var b=T(this.b,"events"),k;for(k in b)b.hasOwnProperty(k)&&
this.addEventListener(k,b[k])}}};U.prototype.destroy=function(){if(this.j){var a=this.a,c=a.parentNode;c&&c.replaceChild(this.j,a)}else(a=this.a)&&a.parentNode&&a.parentNode.removeChild(a)};U.prototype.n=function(){this.a&&this.a.contentWindow?Da(this,{event:"listening"}):window.clearInterval(this.i)};U.prototype.addEventListener=function(a,c){var b=c;"string"==typeof c&&(b=function(){window[c].apply(window,arguments)});ra(this.pubsub,a,b);return this};
var V=function(a,c,b){a.pubsub.r(c,{target:a,data:b})},Ea=function(a,c,b){b=b||[];b=Array.prototype.slice.call(b);Da(a,{event:"command",func:c,args:b})},Da=function(a,c){c.id=a.id;var b=JSON.stringify(c),d=ta(a.a.src),e=d[1],h=d[2],k=d[3],d=d[4],r=[];e&&r.push(e,":");k&&(r.push("//"),h&&r.push(h,"@"),r.push(k),d&&r.push(":",d));a.a.contentWindow.postMessage(b,r.join(""))};U.prototype.setSize=function(a,c){this.a.width=a;this.a.height=c;return this};U.prototype.q=function(){return this.a};var Fa={"0":"onEnded",1:"onPlaying",2:"onPaused",3:"onBuffering",5:"onVideoCued"},W=function(a){R.call(this,a);this.c.title="video player";this.c.apiReady="onYouTubePlayerAPIReady";this.c.videoId=""};u(W,R);var X=function(a,c){U.call(this,a,new W(c));this.e={}};u(X,U);
X.prototype.k=function(){var a=T(this.b,"playerVars")||[];a.enablejsapi=1;window.location.host&&(a.origin=window.location.protocol+"//"+window.location.host);var c=[],b;for(b in a)a.hasOwnProperty(b)&&c.push(b+"="+a[b]);return T(this.b,"host")+"/embed/"+T(this.b,"videoId")+"?"+c.join("&")};
X.prototype.m=function(a){switch(a.event){case "onReady":window.clearInterval(this.i);V(this,"onReady");break;case "onStateChange":var c=a.info.playerState;Y(this,a);V(this,"onStateChange",c);-1!=c&&V(this,Fa[c]);break;case "onPlaybackQualityChange":Y(this,a);V(this,"onPlaybackQualityChange",this.e.playbackQuality);break;case "onError":V(this,"onError",a.error);break;case "infoDelivery":Y(this,a);break;case "initialDelivery":Ga(this,a.apiInterface),Y(this,a)}};
var Y=function(a,c){var b=c.info||{},d;for(d in b)a.e[d]=b[d]},Ga=function(a,c){fa(c,function(a){this[a]||(this[a]=0==a.search("cue")||0==a.search("load")?function(){this.e={};Ea(this,a,arguments);return this}:0==a.search("get")||0==a.search("is")?function(){var c=this.e,e=0;0==a.search("get")?e=3:0==a.search("is")&&(e=2);return c[a.charAt(e).toLowerCase()+a.substr(e+1)]}:function(){Ea(this,a,arguments);return this})},a)};
X.prototype.getVideoEmbedCode=function(){var a=this.a.cloneNode(i),c=this.e.videoData,b=T(this.b,"host");a.src=c&&c.video_id?b+"/embed/"+c.video_id:a.src;c=document.createElement("div");c.appendChild(a);return c.innerHTML};var Z=function(a){R.call(this,a);this.c.title="upload widget";this.c.apiReady="onYouTubeUploadWidgetReady"};u(Z,R);var $=function(a,c){U.call(this,a,new Z(c))};u($,U);$.prototype.k=function(){return T(this.b,"host")+"/upload_embed?action_widget=1"};$.prototype.m=function(a){switch(a.event){case "onUploadSuccess":V(this,"onUploadSuccess",a.videoId)}};t("YT.PlayerState.ENDED",0);t("YT.PlayerState.PLAYING",1);t("YT.PlayerState.PAUSED",2);t("YT.PlayerState.BUFFERING",3);t("YT.PlayerState.CUED",5);t("YT.Player",X);t("YT.UploadWidget",$);X.prototype.destroy=X.prototype.destroy;X.prototype.setSize=X.prototype.setSize;X.prototype.getVideoEmbedCode=X.prototype.getVideoEmbedCode;X.prototype.getIframe=X.prototype.q;X.prototype.addEventListener=X.prototype.addEventListener;var Ha=function(a){(a=m(T(a,"apiReady")))&&a()};Ha(new W);Ha(new Z);})();
