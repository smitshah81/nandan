/* Animation jQuery */
function iva_animation(){
    jQuery('.iva_anim:not(.animated)').waypoint(function () {
		var animatedclass = jQuery(this).attr('data-id');
		if (typeof animatedclass !== 'undefined' && animatedclass !== false) {
			jQuery(this).addClass('animate');
			jQuery(this).addClass('animated  ' + animatedclass + '');
		}
	}, { offset:'85%' });
}

/* Testimonials Slider */
function iva_mySlider(interval, id) {
		var slides;
		var cnt;
		var amount;
		var i;

		function run() {
			// hiding previous image and showing next
			jQuery(slides[i]).fadeOut('slow', function () {
				// Animation complete.
				i++;
				if (i >= amount) i = 0;
				jQuery(slides[i]).fadeIn('slow');

				// updating counter
				cnt.text(i + 1 + ' / ' + amount);
			});


			// loop
			setTimeout(run, interval);
		}

		//slides = $('.testimonials > li');
		slides = jQuery('#' + id + ' .testimonials > li');
		cnt = jQuery('#counter');
		amount = slides.length;
		i = 0;

		// updating counter
		cnt.text(i + 1 + ' / ' + amount);

		if (amount > 1) setTimeout(run, interval);
	}

/* Progressbar */	
function iva_progressbar() {
    jQuery('.bar-color').each(function () {
		jQuery(this).appear(function() {
	         var percent = jQuery(this).attr('data-width');
	         jQuery(this).animate({
	              width: percent
	         }, 1500);
		},{accX: 0, accY: -150});
   });
}

/* Accordion */
function iva_accordion() {
  	jQuery('.ac_wrap ').each(function () {
         tabid = jQuery(this).attr('id');
             jQuery("#" + tabid + " .ac_content:not('.active')").hide();
    });

	jQuery(".ac_wrap .ac_title").click(function () {
		jQuery(this).next(".ac_content").slideToggle(400, 'swing').siblings(".ac_content:visible").slideUp(400, 'swing');
		jQuery(this).toggleClass("active");
		jQuery(this).siblings(".ac_title").removeClass("active");
	});
}

/* Toggle */	
function iva_toggle() {

jQuery(".toggle-title").click(function () {
			jQuery(this).next(".toggle_content").slideToggle({
				duration: 200
			});
		});

		jQuery(".toggle-title").click(function () {
			jQuery(this).toggleClass('active');
		});
}

/* Tabs */	
function iva_tabs(){
	jQuery('.systabspane ').each(function () {
		tabid = jQuery(this).attr('id');

		jQuery("#" + tabid + " .tab_content").hide(); // Hide all tab conten divs by default

		if(document.location.hash && jQuery(this).find("ul.tabs li a[href='"+document.location.hash+"']").length >= 1) {

			jQuery(this).find("ul.tabs li a[href='"+document.location.hash+"']").parent().addClass("current");
			jQuery(this).find(document.location.hash+".tab_content").show(); 

		}else{

			jQuery("#" + tabid + " .tab_content:first").show(); // Show the first div of tab content by default
			jQuery("#" + tabid + " ul.tabs li:first").addClass("current"); // Show the current by default
		}

		jQuery(".systabspane ul.tabs li a").click(function(e) {
				e.preventDefault();
		});


});
	jQuery(".systabspane ul.tabs li").click(function () { //Fire the click event
		tab_id = jQuery(this).parents('.systabspane').attr("id");
		var activeTab = jQuery(this).attr("id"); // Catch the click link
		jQuery("#" + tab_id + " ul li").removeClass("current"); // Remove pre-highlighted link
		jQuery(this).addClass("current"); // set clicked link to highlight state
		jQuery("#" + tab_id + " .tab_content").hide(); // hide currently visible tab content div
		jQuery(activeTab).fadeIn(600); // show the target tab content div by matching clicked link.
	}); 
}

/* Button*/	
function iva_buttondata(){
	jQuery(".btn").hover(function () {
			var hoverBg = jQuery(this).attr('data-btn-hoverBg');
			var hoverColor = jQuery(this).attr('data-btn-hoverColor');
			var borderhoverColor = jQuery(this).attr('data-btn-hoverborder');
			if (hoverBg !== undefined) {
				jQuery(this).css('background-color', hoverBg);
			} else {}
		
			if (borderhoverColor !== undefined) {
				jQuery(this).css('border-color', borderhoverColor);
			} else {}
			if (hoverColor !== undefined) {
				jQuery(this).css('color', hoverColor);
			} else {}
	}, function () {
		var btnbg = jQuery(this).attr('data-btn-bg');
		var btncolor = jQuery(this).attr('data-btn-color');
		 var btnborder = jQuery(this).attr('data-btn-border');
		//jQuery(this).removeAttr('style');
		
		if (btnbg !== undefined) {
			jQuery(this).css('background-color', btnbg);
		}
		if (btncolor !== undefined) {
			jQuery(this).css('color', btncolor);
		}
		if (btnborder !== undefined) {
			jQuery(this).css('border-color', btnborder);
		}
	});
}
/* Counter */	
function iva_counter(){
		
		jQuery(function ($) {

			// custom formatting example
			$('#count-number').data('countToOptions', {
			formatter: function (value, options) {
				return value.toFixed(options.decimals).replace(/\B(?=(?:\d{3})+(?!\d))/g, '');
			}
		});

		// start all the timers
	 $('.timer').appear(function() {	$(this).each(count);  },{accX: 0, accY: -150});
			function count(options) {
				//var thiscount = $('.timer');
				options = $.extend({}, options || {}, $('.timer').data('countToOptions') || {});
				$('.timer').countTo(options);
			}
		});


}

/* Message close*/	
function iva_messagebox_close(){
	jQuery("span.close").click(function () {
		jQuery(this).hide();
		jQuery(this).parent().parent().animate({
			opacity : '0'
		}).slideUp(400);
	});
}
function iva_parallax_bg(){
	jQuery('.parallaxsection').each(function($){
		var id = jQuery(this).attr('id');
		jQuery('#'+id + ".parallaxsection").parallax("50%", 0.4);
	});
}

jQuery(document).ready(function($){
	iva_animation();
	iva_progressbar();
	iva_tabs();
	iva_accordion();
	iva_mySlider();
	iva_toggle();
	iva_buttondata();
	iva_counter();
	iva_messagebox_close();
    iva_parallax_bg();
});

/**
 * jQuery.ScrollTo - Easy element scrolling using jQuery.
 * Copyright (c) 2007-2009 Ariel Flesler - aflesler(at)gmail(dot)com | http://flesler.blogspot.com
 * Dual licensed under MIT and GPL.
 * Date: 5/25/2009
 * @author Ariel Flesler
 * @version 1.4.2
 *
 * http://flesler.blogspot.com/2007/10/jqueryscrollto.html
 */
;(function(d){var k=d.scrollTo=function(a,i,e){d(window).scrollTo(a,i,e)};k.defaults={axis:'xy',duration:parseFloat(d.fn.jquery)>=1.3?0:1};k.window=function(a){return d(window)._scrollable()};d.fn._scrollable=function(){return this.map(function(){var a=this,i=!a.nodeName||d.inArray(a.nodeName.toLowerCase(),['iframe','#document','html','body'])!=-1;if(!i)return a;var e=(a.contentWindow||a).document||a.ownerDocument||a;return d.browser.safari||e.compatMode=='BackCompat'?e.body:e.documentElement})};d.fn.scrollTo=function(n,j,b){if(typeof j=='object'){b=j;j=0}if(typeof b=='function')b={onAfter:b};if(n=='max')n=9e9;b=d.extend({},k.defaults,b);j=j||b.speed||b.duration;b.queue=b.queue&&b.axis.length>1;if(b.queue)j/=2;b.offset=p(b.offset);b.over=p(b.over);return this._scrollable().each(function(){var q=this,r=d(q),f=n,s,g={},u=r.is('html,body');switch(typeof f){case'number':case'string':if(/^([+-]=)?\d+(\.\d+)?(px|%)?$/.test(f)){f=p(f);break}f=d(f,this);case'object':if(f.is||f.style)s=(f=d(f)).offset()}d.each(b.axis.split(''),function(a,i){var e=i=='x'?'Left':'Top',h=e.toLowerCase(),c='scroll'+e,l=q[c],m=k.max(q,i);if(s){g[c]=s[h]+(u?0:l-r.offset()[h]);if(b.margin){g[c]-=parseInt(f.css('margin'+e))||0;g[c]-=parseInt(f.css('border'+e+'Width'))||0}g[c]+=b.offset[h]||0;if(b.over[h])g[c]+=f[i=='x'?'width':'height']()*b.over[h]}else{var o=f[h];g[c]=o.slice&&o.slice(-1)=='%'?parseFloat(o)/100*m:o}if(/^\d+$/.test(g[c]))g[c]=g[c]<=0?0:Math.min(g[c],m);if(!a&&b.queue){if(l!=g[c])t(b.onAfterFirst);delete g[c]}});t(b.onAfter);function t(a){r.animate(g,j,b.easing,a&&function(){a.call(this,n,b)})}}).end()};k.max=function(a,i){var e=i=='x'?'Width':'Height',h='scroll'+e;if(!d(a).is('html,body'))return a[h]-d(a)[e.toLowerCase()]();var c='client'+e,l=a.ownerDocument.documentElement,m=a.ownerDocument.body;return Math.max(l[h],m[h])-Math.min(l[c],m[c])};function p(a){return typeof a=='object'?a:{top:a,left:a}}})(jQuery);
/*
Plugin: jQuery Parallax
Version 1.1.3
Author: Ian Lunn
Twitter: @IanLunn
Author URL: http://www.ianlunn.co.uk/
Plugin URL: http://www.ianlunn.co.uk/plugins/jquery-parallax/

Dual licensed under the MIT and GPL licenses:
http://www.opensource.org/licenses/mit-license.php
http://www.gnu.org/licenses/gpl.html
*/

(function( $ ){
	var $window = $(window);
	var windowHeight = $window.height();

	$window.resize(function () {
		windowHeight = $window.height();
	});

	$.fn.parallax = function(xpos, speedFactor, outerHeight) {

		var $this = $(this);
		var getHeight;
		var firstTop;
		var paddingTop = 0;
		
		//get the starting position of each element to have parallax applied to it      
		$this.each(function(){
			firstTop = $this.offset().top;
		});

		if (outerHeight) {
			getHeight = function(jqo) {
				return jqo.outerHeight(true);
			};
		} else {
			getHeight = function(jqo) {
				return jqo.height();
			};
		}
			
		// setup defaults if arguments aren't specified
		if (arguments.length < 1 || xpos === null) xpos = "50%";
		if (arguments.length < 2 || speedFactor === null) speedFactor = 0.1;
		if (arguments.length < 3 || outerHeight === null) outerHeight = true;
		
		// function to be called whenever the window is scrolled or resized
		function update(){
			var pos = $window.scrollTop();              

			$this.each(function(){
				var $element = $(this);
				var top = $element.offset().top;
				var height = getHeight($element);

				// Check if totally above or totally below viewport
				if (top + height < pos || top > pos + windowHeight) {
					return;
				}

				$this.css('backgroundPosition', xpos + " " + Math.round((firstTop - pos) * speedFactor) + "px");
			});
		}       

		$window.bind('scroll', update).resize(update);
		update();
	};
})(jQuery);