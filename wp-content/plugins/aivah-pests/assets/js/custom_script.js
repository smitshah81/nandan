jQuery(document).ready(function($) {
	'use strict'; 
	/*-- Upload Image Remove-*/
	 jQuery('.iva_cpt_image_remove').live('click', function(event) { 
	   var defaultImage = jQuery(this).parent().siblings('.custom_default_image').text();
	   jQuery(this).parent().siblings('.iva_cpt_upload_image').val('');
	   jQuery(this).parent('.iva-cpt-screenshot').slideUp();
	   return false;
	});
	
	var custom_uploader,clickedID ,formfield = '';
	jQuery('.iva_cpt_upload_image_button').click(function() {
		clickedID = jQuery(this).attr('id');
		formfield = jQuery(this).prev( 'input').attr( 'id' );
			if (custom_uploader) {
				custom_uploader.open();
				return;
			}
		//Extend the wp.media object
		custom_uploader = wp.media.frames.file_frame = wp.media({
			title: 'Choose This',
			button: {
			text: 'Choose This'
			},
				multiple: false
		});
		
				
		custom_uploader.on('select', function() {
			var attachment = custom_uploader.state().get('selection').first().toJSON();
			var image = /(^.*\.jpg|jpeg|png|gif*)/gi;
			if(typeof(attachment.sizes.thumbnail)  === "undefined") {
				if (attachment.url.match(image)) {
				  var  btnContent = '<img src="'+attachment.url+'" alt="" />';
				  btnContent += '<a href="javascript:(void);" class="iva_cpt_image_remove button button-primary">x</a>';
				}
			}else if (attachment.sizes.thumbnail.url.match(image)) {
				var  btnContent = '<img src="'+attachment.sizes.thumbnail.url+'" alt="" />';
				btnContent += '<a href="javascript:(void);" class="iva_cpt_image_remove button button-primary">x</a>'
			}
			
			jQuery( '#' + formfield).val(attachment.url);
			jQuery( '#' + formfield).siblings( '#iva_cpt_imagepreview-'+clickedID).slideDown().html(btnContent); 
		});		 
		//Open the uploader dialog
		custom_uploader.open();
		return false;
	});
});