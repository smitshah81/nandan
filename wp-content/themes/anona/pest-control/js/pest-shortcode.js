//Pest shortcode	
function extra(){
	'use strict'; 
	var shortcode_select = jQuery('#primary_select').val();
	if( shortcode_select == 'appt_callout' ){
		var title		= jQuery('[name="appt_callout_title"]').val();
		var buttontext	= jQuery('[name="appt_callout_btntext"]').val();
		var buttoncolor	= jQuery('[name="appt_callout_btncolor"]').val();
		var bgcolor 	= jQuery('[name="appt_callout_bgcolor"]').val();
		var textcolor 	= jQuery('[name="appt_callout_textcolor"]').val();
		var shortinfo	= jQuery('[name="appt_callout_shortinfo"]').val();

		if ( title !== '' ) 	{ title = ' title="' + title + '"';	}
		if ( buttontext !== '') { buttontext = ' buttontext="' + buttontext + '"'; }
		if ( bgcolor !== '') 	{	bgcolor = ' bgcolor="' + bgcolor + '"';	}
		if ( buttoncolor !== '') {	buttoncolor = ' buttoncolor="' + buttoncolor + '"';	}
		if ( textcolor !== '')	{ textcolor = ' textcolor="' + textcolor + '"'; }
		if ( shortinfo !== '')	{ shortinfo = ' shortinfo="' + shortinfo + '"'; }

		return '[appointment_callout' + title + shortinfo + textcolor + buttoncolor + bgcolor + buttontext + ']';
	}
	//Pest categories
	if( shortcode_select == 'pestcategory' ){
		var pest_cat_orderby 	= jQuery('[name="pestcategory_orderby"]').val();
		var pest_cat_cats 		= jQuery('[name="pestcategory_cats[]"]').val();
		var pest_cat_order 		= jQuery('[name="pestcategory_order"]').val();
		var pest_cat_title 		= jQuery('[name="pestcategory_title"]');
		var pest_cat_columns 	= jQuery('[name="pestcategory_gridcolumns"]').val();
		var pest_cat_limit 		= jQuery('[name="pestcategory_limit"]').val();
		
		var order,limit,cats,orderby;
		
		// Title
		if ( pest_cat_title.is('.iva-button')){
			if( pest_cat_title.is(':checked') ){
				pest_cat_title= ' title="true"';	
			}else{
				pest_cat_title= ' title="false"';		
			}
		}
		
		// Order
		if( pest_cat_order!=''){ 
			order = ' order= "'+ pest_cat_order + '"';	
		}else{	
			order = '';
		}
	
		//Limit
		if( pest_cat_limit!=''){ 
			limit = ' limit= "'+ pest_cat_limit + '"';	
		}else{	
			limit = '';
		}

		// Categories
		if ( pest_cat_cats == null) {
			pest_cat_cats = '';
		}
		if( pest_cat_cats!='' ){
			cats = ' cats="'+ pest_cat_cats + '"';
		}else{	
			cats = ' cats=""';
		}
		
		// Orderby
		if( pest_cat_orderby!='')	{ 
			orderby = ' orderby="'+ pest_cat_orderby +'"';
		}else{	
			orderby = '';
		}
		//Columns
		if (pest_cat_columns !== '') {
			pest_cat_columns = ' columns="' + pest_cat_columns + '"';
		}
		return '[pest_categories' + order + orderby + cats + pest_cat_title + limit + pest_cat_columns +']';
	}

	// Pest Posts by Categories
	if( shortcode_select == 'pests' ){
		var pest_orderby 	= jQuery('[name="pests_orderby"]').val();
		var pest_cats 		= jQuery('[name="pests_cats[]"]').val();
		var pest_order 		= jQuery('[name="pests_order"]').val();
		var pest_pagination = jQuery('[name="pests_pagination"]');
		var pest_limit 		= jQuery('[name="pests_limit"]').val();
		var pest_title 		= jQuery('[name="pests_title"]');
		var pest_columns 	= jQuery('[name="pests_gridcolumns"]').val();
		
		var order,limit,cats,orderby;
		
		// Pagination
		if ( pest_pagination.is('.iva-button')){
			if( pest_pagination.is(':checked') ){
				pest_pagination= ' pagination="true"';	
			}else{
				pest_pagination= ' pagination="false"';		
			}
		}
		
		// Title
		if ( pest_title.is('.iva-button')){
			if( pest_title.is(':checked') ){
				pest_title= ' title="true"';	
			}else{
				pest_title= ' title="false"';		
			}
		}
		
		// Order
		if( pest_order!=''){ 
			order = ' order= "'+ pest_order + '"';	
		}else{	
			order = '';
		}
		//Limit
		if( pest_limit!=''){ 
			limit = ' limit= "'+ pest_limit + '"';	
		}else{	
			limit = '';
		}
		// Categories
		if ( pest_cats == null) {
			pest_cats = '';
		}

		if( pest_cats!='' ){
			cats = ' cats="'+ pest_cats + '"';
		}else{	
			cats = ' cats=""';
		}
		
		// Orderby
		if( pest_orderby!='')	{ 
			orderby = ' orderby="'+ pest_orderby +'"';
		}else{	
			orderby = '';
		}
		//Columns
		if (pest_columns !== '') {
			pest_columns = ' columns="' + pest_columns + '"';
		}
		return '[pests' + order + orderby + cats + pest_title + limit + pest_pagination + pest_columns +']';
	}
}