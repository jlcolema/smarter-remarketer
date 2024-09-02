jQuery.noConflict();

	
	/*-------------------------------------------    
		Let's wait for the DOM to load
	-------------------------------------------*/
	jQuery(document).ready(function($) {
	
		/*-------------------------------------------    
			Search Functions
		-------------------------------------------*/
		jQuery('#s').focus(function(){
			if( jQuery(this).val() == 'Search' ){
				jQuery(this).val('');
			}
			jQuery('#main > header .buttons span a').removeClass("idleField").addClass("focusField");  
		});
		jQuery('#s').blur(function(){
			if( jQuery(this).val() == '' ){
				jQuery(this).val('Search');
			}
			jQuery('#main > header .buttons span a').removeClass("focusField").addClass("idleField");  
		});
		
		jQuery('#search span a').click(function(e){
			var searchval = jQuery('#s').val();
			if( searchval != 'Search' ){
				console.log(searchval);
				jQuery("#search").removeAttr("action");
				jQuery("#search").attr("action", "/");
				document.search.submit();
			} else {
				return false;
			}
		});
		
		/*-------------------------------------------    
			Client Carousel
		-------------------------------------------*/
		// Well, try this on for size!
		/* jQuery(".boundary").resize(function(e){
		  unhide();
		}); */
	
		/* initialize dropdown menu */
		/* jQuery(function(){
			jQuery('.sf-menu').superfish();
		});
		
		function initCarousel() {
			var elem = jQuery(this); */
			
			/* this "unhides" the carousel after page load */
			/* jQuery(".widget").css({
			    "position":"absolute", 
			    "top": "-9999",
			    "left": "0"
			});
			
			jQuery(".widget_style").jCarouselLite({
				btnPrev: ".prev",
				btnNext: ".next", */
				/*this makes it a true carousel rather than a slideshow*/
				/* circular: true,
				speed: 450,
				scroll: 1
			});
		} */
		
		/* function unhide() { */
			
			/* this "unhides" the carousel after page load */
			/* jQuery(".widget").css({
			    "position":"relative", 
			    "top": "0",
			    "left": "0"
			});
		
		}
		initCarousel();
		unhide(); */

		/*-------------------------------------------    
			New Client Carousel
		-------------------------------------------*/

		$(".client-list").carouFredSel({

			responsive: true,
			width: "100%",
			scroll: 1,
			items: {
				width: 178,
				height: 40,
				visible: {
					min: 1,
					max: 4
				}
			},
			auto: {
				timeoutDuration: 5000
			},
			prev: ".widget_new .prev",
			next: ".widget_new .next"

		});
	
		/*-------------------------------------------    
			launch external links in new window
		-------------------------------------------*/
		jQuery("a[href^='http:']")
			.not("[href*='smarterremarketer.com']")
			.not("[href^=mailto]")
			.attr('target','_blank');
			
		jQuery("a[href^='https:']")
			.not("[href*='smarterremarketer.com']")
			.not("[href^=mailto]")
			.attr('target','_blank');
		
		/*-------------------------------------------    
			Navigation Toggle
		-------------------------------------------*/
		jQuery("h3.collapsible-navigation").click(function(){
			jQuery(this).toggleClass("active");
			jQuery('.menu-header').toggleClass("active");
	
		});
	
		/*-------------------------------------------    
			Footer Column Toggle
		-------------------------------------------*/
		jQuery(".footer-links h3").click(function(){
			jQuery(this).toggleClass("active");
			jQuery(this).next('.textwidget').toggleClass("active");
	
		});
			
		/*-------------------------------------------    
			toggle footer links
		-------------------------------------------*/
		jQuery(".toggler.more").click(function () {
			jQuery(".slidebox").slideToggle(1000);
			jQuery(".toggler.more").slideToggle(0);
			jQuery(".toggler.less").slideToggle(0);
		}); 
		jQuery(".toggler.less").click(function () {
			jQuery(".slidebox").slideToggle((1000));
			jQuery(".toggler.more").slideToggle(0);
			jQuery(".toggler.less").slideToggle(0);
		});
		
		/*-------------------------------------------    
			Sidebar Column Toggle
		-------------------------------------------*/
		jQuery("aside .subnav h3").click(function(){
			jQuery(this).toggleClass("active");
			jQuery(this).next('ul').toggleClass("active");
	
		});

		
		/*-------------------------------------------    
			toggle newsletter form
		-------------------------------------------*/
		jQuery('.button.newsletter').click(function() {
		  jQuery('#gform_wrapper_1').slideToggle('slow', function() {
		    // Animation complete.
		  });
		});
	
	});
