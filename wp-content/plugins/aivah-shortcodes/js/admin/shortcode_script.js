//magnific Popup
jQuery(document).ready(function($){
	jQuery('body').on('click','.iva-shortcode-generator',function(){
		jQuery.magnificPopup.open({
			items: {
				src: '#iva-sc-generator'
			},
			type: 'inline',
			/*
			mainClass: 'mfp-fade',
			removalDelay: 300,
			*/

	    }, 0);
	}); 
	jQuery('#sendtoeditor').click(function(){
		jQuery.magnificPopup.close();
		
	});
});	
