/* client carousel */
jQuery(document).ready(function() {
	
	// Well, try this on for size!
	jQuery(".boundary").resize(function(e){
	  unhide();
	});

	/* initialize dropdown menu */
	jQuery(function(){
		jQuery('.sf-menu').superfish();
	});
	
	function initCarousel() {
		var elem = jQuery(this);
		
		/* this "unhides" the carousel after page load */
		jQuery(".widget").css({
		    "position":"absolute", 
		    "top": "-9999",
		    "left": "0"
		});
		
		jQuery(".widget_style").jCarouselLite({
			btnPrev: ".prev",
			btnNext: ".next",
			/*this makes it a true carousel rather than a slideshow*/
			circular: true,
			speed: 450,
			scroll: 1
		});
	}
	
	function unhide() {
		
		/* this "unhides" the carousel after page load */
		jQuery(".widget").css({
		    "position":"relative", 
		    "top": "0",
		    "left": "0"
		});
	
	}
	initCarousel();
	unhide();
	
});

//####################################################
// search
//####################################################
jQuery(document).ready(function(){
	jQuery('#s').focus(function(){
		if( jQuery(this).val() == 'Search' ){
			jQuery(this).val('');
		}
	});
	jQuery('#s').blur(function(){
		if( jQuery(this).val() == '' ){
			jQuery(this).val('Search');
		}
	});
	
	jQuery('#search').submit(function(e){
		var searchval = jQuery('#s').val();
		if( searchval != 'Search' ){
			jQuery("#search").attr("action", "/");
			return true;
		} else {
			return false;
		}
	});
});


/* launch external links in new window */
jQuery(document).ready(function(){
	jQuery("a[href^='http:']")
		.not("[href*='smarterremarketer.com']")
		.not("[href^=mailto]")
		.attr('target','_blank');
	}
);
jQuery(document).ready(function(){
	jQuery("a[href^='https:']")
		.not("[href*='smarterremarketer.com']")
		.not("[href^=mailto]")
		.attr('target','_blank');
	}
);

  jQuery.noConflict();
  jQuery(document).ready(function() {
    jQuery('#banner').cycle({fx: 'scrollHorz', timeout:5000, speed:1000, pause:1 });
    jQuery('#banner img').click(function (){
      document.location.href = jQuery(this).attr('rel');
    }).css('cursor', 'pointer');
  });