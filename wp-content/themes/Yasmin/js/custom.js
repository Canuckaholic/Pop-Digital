jQuery(document).ready(function() {

/* Banner class */

	jQuery('.squarebanner ul li:nth-child(even)').addClass('rbanner');
	
	jQuery('ul.foliocontainer li:nth-child(4n)').after('<div class="clear"></div>');

	jQuery('#web2feel').mobileMenu();
	
	jQuery(".projectbox").fitVids();
	

/* Navigation */
	jQuery('#subnav ul.sfmenu').superfish({ 
		delay:       500,								// 0.1 second delay on mouseout 
		animation:   {opacity:'show',height:'show'},	// fade-in and slide-down animation 
		dropShadows: true								// disable drop shadows 
	});	

/* Slider */	
	
	 jQuery('.flexslider').flexslider({
		controlNav: false,
	 	directionNav:true,
		animation: "fade",              //String: Select your animation type, "fade" or "slide"
		slideshow: true                //Boolean: Animate slider automatically
	 	});
/* overlay */
	
jQuery('.rightbox').hover( function() {
			jQuery(this).find('.overlay').fadeIn(150);
		}, function() {
			jQuery(this).find('.overlay').fadeOut(150);
		});
		

	
	
});

