jQuery(document).ready(function($) {
	"use strict";
	$("select.orderby, .variations select").customSelect();
	$("a[data-rel^='prettyPhoto']").each(function() {	
			var $image = $(this).contents("img");
	
		if($(this).attr('href').match(/(jpg|gif|jpeg|png|tif)/)) 
		var $hoverclass = 'hover_image';
			
		if ($image.length > 0)
		{	
			var $hoverbg = $("<span class='"+$hoverclass+"'></span>").appendTo($(this));			
				$(this).bind('mouseenter', function(){
				var $height = $image.height();
				var $width = $image.width();
				var $pos =  $image.position();	
				$hoverbg.css({height:$height, width:$width, top:$pos.top, left:$pos.left});
		});
	}

	$("a[data-rel^='prettyPhoto']").contents("img").hover(function() {	
			$(this).stop().animate({"opacity": "0.2"}, 200);
			$("span[class^=hover]").stop().animate({"opacity": "1"});
			},function() {
			$(this).stop().animate({"opacity": "1"},200);
			$("span[class^=hover]").stop().animate({"opacity": "0"});
		});
	});
	
	$('.product_wrapper .hoverimg a').hover(function(){
       $(this).find("img:first").fadeToggle();	   
    });
	
});
jQuery(function(a) {
    jQuery(document).off('click', '.add_to_cart_button');
    return "undefined" == typeof wc_add_to_cart_params ? !1 : void a(document).on("click", ".add_to_cart_button", function() {
        var text = '<i class="fa  fa-check"></i>';
        var b = a(this);
        if (b.is(".product_type_simple")) {
            if (!b.attr("data-product_id")) return !0;
            b.removeClass("added"), b.addClass("loading");
            var c = {};
            return a.each(b.data(), function(a, b) {
                c[a] = b
            }), a(document.body).trigger("adding_to_cart", [b, c]), a.post(wc_add_to_cart_params.wc_ajax_url.toString().replace("%%endpoint%%", "add_to_cart"), c, function(c) {
                if (c) {
                    var d = window.location.toString();
                    if (d = d.replace("add-to-cart", "added-to-cart"), c.error && c.product_url) return void(window.location = c.product_url);
                    if ("yes" === wc_add_to_cart_params.cart_redirect_after_add) return void(window.location = wc_add_to_cart_params.cart_url);
                    b.removeClass("loading");
                    var e = c.fragments,
                        f = c.cart_hash;
                    e && a.each(e, function(b) {
                        a(b).addClass("updating")
                    }), a(".shop_table.cart, .updating, .cart_totals").fadeTo("400", "0.6").block({
                        message: null,
                        overlayCSS: {
                            opacity: .6
                        }
                    }), b.addClass("added"), wc_add_to_cart_params.is_cart || 0 !== b.parent().find(".added_to_cart").size() || b.after(' <a href="' + wc_add_to_cart_params.cart_url + '" class="added_to_cart wc-forward" title="' + wc_add_to_cart_params.i18n_view_cart + '">' + text + "</a>"),
					setTimeout(function() {
                        b.parent().parent().removeClass('loading');
                        b.removeClass('added');
                        jQuery('.added_to_cart').fadeOut(300);
                    }, 3000),
					e && a.each(e, function(b, c) {
                        a(b).replaceWith(c)
                    }), a(".widget_shopping_cart, .updating").stop(!0).css("opacity", "1").unblock(), a(".shop_table.cart").load(d + " .shop_table.cart:eq(0) > *", function() {
                        a(".shop_table.cart").stop(!0).css("opacity", "1").unblock(), a(document.body).trigger("cart_page_refreshed")
                    }), a(".cart_totals").load(d + " .cart_totals:eq(0) > *", function() {
                        a(".cart_totals").stop(!0).css("opacity", "1").unblock()
                    }), a(document.body).trigger("added_to_cart", [e, f, b])
                }
            }), !1
        }
        return !0
    })
});