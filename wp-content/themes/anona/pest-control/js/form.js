jQuery(document).ready(function($){
	'use strict';
	jQuery('#iva_submit').click(function(){
        validateForm();   
    });
    

	jQuery('#iva_update').click(function(){
        validateForm_update();   
    });
	function validateForm_update(){
	
        var nameReg     = /^[A-Za-z]+$/;
        var numberReg   =  /^[0-9]+$/;
        var emailReg    = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
		var iva_postid =  jQuery('#res_post_id').val();
        var iva_fname   = jQuery('#fname').val();
        var iva_email   = jQuery('#email').val();
        var iva_phone  	= jQuery('#phone').val();
		var iva_addr    = jQuery('#address').val();
		var iva_notes    = jQuery('#notes').val();
        var iva_timings = jQuery('#appt_timings').val();        
	    
		var proceed 	= true;
		
		// First name
        if( iva_fname == ""){
			jQuery("#fname").addClass("error");
			 proceed = false;
        } 
		if( iva_fname ){
			jQuery("#fname").removeClass("error");
		}
		
		// Email
		if( emailReg.test( iva_email ) ){
			jQuery("#email").removeClass("error");
			proceed = true;
		}else{
		 	jQuery("#email").addClass("error");
			proceed = false;
		}	
	
		// Phone number
		if( numberReg.test(iva_phone)){
			jQuery("#phone").removeClass("error");
            proceed = true;
        }else{
		 	jQuery("#phone").addClass("error");
			proceed = false;
		}
		
		// address
		if( iva_addr == ""){
			jQuery("#address").addClass("error");
			 proceed = false;
        } 
		if( iva_addr){
            jQuery("#address").removeClass("error");
			 proceed = true;
        } 

		// notes
		if( iva_notes == ""){
			jQuery("#notes").addClass("error");
			 proceed = false;
        } 
		if( iva_notes){
            jQuery("#notes").removeClass("error");
			 proceed = true;
        }
		
		// timings
        if( iva_timings == ""){
			jQuery("#appt_timings").addClass("error");
			 proceed = false;
        } 
		if( iva_timings ){
            jQuery("#appt_timings").removeClass("error");
			 proceed = true;
        } 
		// If  no error proceed
        if( proceed ){
            iva_bookings_update();
        }
    }
	function iva_bookings_update(){ 
			var iva_postid =  jQuery('#res_post_id').val();  
        jQuery.ajax({
            url: iva_panel.ajaxurl,
            type: 'post',
            dataType: 'html',
            data: {
                action   : 'iva_appt_form_update',
				upost_id : iva_postid,
                data     : jQuery("#iva-appt-form-update").serialize()
            },
            success: function( response ){ 
                jQuery('#formstatus').html(response);
				if( jQuery( '#appoint_msg' ).hasClass( "success" ) ){
					document.appt_form.reset();
				}
           }
        });
    }

   
    function validateForm(){
        var nameReg     = /^[A-Za-z]+$/;
        var numberReg   =  /^[0-9]+$/;
        var emailReg    = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
        var iva_fname   = jQuery('#fname').val();
        var iva_email   = jQuery('#email').val();
        var iva_phone  	= jQuery('#phone').val();
		var iva_addr    = jQuery('#address').val();
		var iva_notes   = jQuery('#notes').val();
        var iva_timings = jQuery('#appt_timings').val();        
	    var proceed 	= true;
		
		


		// First name
        if( iva_fname == ""){
			jQuery("#fname").addClass("error");
			 proceed = false;
        } 
		if( iva_fname ){
			jQuery("#fname").removeClass("error");
		}
		
		// Email
		if( emailReg.test( iva_email ) ){
			jQuery("#email").removeClass("error");
			proceed = true;
		}else{
		 	jQuery("#email").addClass("error");
			proceed = false;
		}	
	
		// Phone number
		if( numberReg.test(iva_phone)){
			jQuery("#phone").removeClass("error");
            proceed = true;
        }else{
		 	jQuery("#phone").addClass("error");
			proceed = false;
		}
		
		// address
		if( iva_addr == ""){
			jQuery("#address").addClass("error");
			 proceed = false;
        } 
		if( iva_addr){
            jQuery("#address").removeClass("error");
			 proceed = true;
        } 

		// Notes
		if( iva_notes == ""){
			jQuery("#notes").addClass("error");
			 proceed = false;
        } 
		if( iva_notes){
            jQuery("#notes").removeClass("error");
			 proceed = true;
        }
		
		// timings
        if( iva_timings == ""){
			jQuery("#appt_timings").addClass("error");
			 proceed = false;
        } 
		if( iva_timings ){
            jQuery("#appt_timings").removeClass("error");
			 proceed = true;
        } 

		// If  no error proceed
        if( proceed ){
            iva_bookings();
        }      
    }   
    function iva_bookings(){   
        jQuery.ajax({
            url: iva_panel.ajaxurl,
            type: 'post',
            dataType: 'html',
            data: {
                action   : 'iva_appt_form_insert',
                data     : jQuery("#iva-appt-form").serialize()
            },
            success: function( response ){ 
                jQuery('#formstatus').html(response);
				if( jQuery( '#appoint_msg' ).hasClass( "success" ) ){
					document.appt_form.reset();
				}
           }
        });
    }
});