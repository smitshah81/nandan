var shortcode = {
    init: function () {
		//jQuery('.primary_select select').val('');
        jQuery('.primary_select select').change(function () {
            jQuery('.secondary_select').hide();
            if (this.value != '') {
                if (jQuery('#secondary_' + this.value).show().children('.tertiary_select').size() == 0) {
                    jQuery('#secondary_' + this.value).show();
                }
            }
        }).change();
		
        jQuery('#sendtoeditor').click(function () {
            shortcode.sendToEditor();
        });

       // jQuery('.secondaryselect select').val('');
        jQuery('.secondaryselect select').change(function () {
            jQuery(this).closest('.secondary_select').children('.tertiary_select').hide();
            if (this.value != '') {
                jQuery('#atp-' + this.value).show();
            }
        }).change();
    },
    generate: function () {
        var type = jQuery('.primary_select select').val();
        switch (type) {

            // C O L U M N   L A Y O U T S 
            //--------------------------------------------------------
        case 'Columns':
			
            var types = jQuery('[name="Columns_type"]').val();
            if (types != '') {
                var content = jQuery('[name="Columns_content"]').val();
                return '\n[' + types + ']\n' + content + '\n[/' + types + ']\n';
            } else {
                return '';
            }
            break;

           // Layouts
		case 'Layouts':
			var secondary_type = jQuery('#secondary_Layouts select').val();
			switch (secondary_type) {
			// 1/2 - 1/2
			case 'one_half_layout':
				return '[one_half no_margin="false"]' + 'Content here' + '[/one_half]\n[one_half_last no_margin="false"]' + 'Content here' + '[/one_half_last]';
				break;
			// 1/3 - 1/3 - 1/3
			case 'one_third_layout':
				return '[one_third no_margin="false"]' + 'Content here' + '[/one_third]\n[one_third no_margin="false"]' + 'Content here' + '[/one_third]\n[one_third_last no_margin="false"]' + 'Content here' + '[/one_third_last]\n';
			
				break;
			// 1/4 - 1/4 - 1/4 - 1/4
			case 'one_fourth_layout':
				return '[one_fourth no_margin="false"]' + 'Content here' + '[/one_fourth]\n[one_fourth no_margin="false"]' + 'Content here' + '[/one_fourth]\n[one_fourth no_margin="false"]' + 'Content here' + '[/one_fourth]\n[one_fourth_last no_margin="false"]' + 'Content here' + '[/one_fourth_last]\n';
				break;
			// 1/5 - 1/5 - 1/5 - 1/5 - 1/5 
			case 'one5thlayout':
				return '[one_fifth no_margin="false"]' + 'Content here' + '[/one_fifth]\n[one_fifth no_margin="false"]' + 'Content here' + '[/one_fifth]\n[one_fifth no_margin="false"]' + 'Content here' + '[/one_fifth]\n[one_fifth no_margin="false"]' + 'Content here' + '[/one_fifth]\n[one_fifth_last no_margin="false"]' + 'Content here' + '[/one_fifth_last]\n';
				break;
			//  1/6 - 1/6 - 1/6 - 1/6 - 1/6 - 1/6
			case 'one6thlayout':
				return '[one_sixth no_margin="false"]' + 'Content here' + '[/one_sixth]\n[one_sixth no_margin="false"]' + 'Content here' + '[/one_sixth]\n[one_sixth no_margin="false"]' + 'Content here' + '[/one_sixth]\n[one_sixth no_margin="false"]' + 'Content here' + '[/one_sixth]\n[one_sixth no_margin="false"]' + 'Content here' + '[/one_sixth]\n[one_sixth_last no_margin="false"]' + 'Content here' + '[/one_sixth_last]\n';
				break;
			// 1/3 - 2/3
			case 'one_3rd_2rd':
				return '[one_third no_margin="false"]' + 'Content here' + '[/one_third]\n[two_third_last no_margin="false"]' + 'Content here' + '[/two_third_last]\n';
				break;
			// 2/3 - 1/3
			case 'two_3rd_1rd':
				return '[two_third no_margin="false"]' + 'Content here' + '[/two_third]\n[one_third_last no_margin="false"]' + 'Content here' + '[/one_third_last]\n';
				break;
			// 1/4 - 3/4
			case 'One_4th_Three_4th':
				return '[one_fourth no_margin="false"]' + 'Content here' + '[/one_fourth]\n[three_fourth_last no_margin="false"]' + 'Content here' + '[/three_fourth_last]\n';
				break;
			// 3/4 - 1/4
			case 'Three_4th_One_4th':
				return '[three_fourth no_margin="false"]' + 'Content here' + '[/three_fourth]\n[one_fourth_last no_margin="false"]' + 'Content here' + '[/one_fourth_last]\n';
				break;
			// 1/4 - 1/4 - 1/2
			case 'One_4th_One_4th_One_half':
				return '[one_fourth no_margin="false"]' + 'Content here' + '[/one_fourth]\n[one_fourth no_margin="false"]' + 'Content here' + '[/one_fourth]\n[one_half_last no_margin="false"]' + 'Content here' + '[/one_half_last]\n';
				break;
			//  1/2 - 1/2 - 1/4 -
			case 'One_half_One_4th_One_4th':
				return '[one_half no_margin="false"]' + 'Content here' + '[/one_half]\n[one_fourth no_margin="false"]' + 'Content here' + '[/one_fourth]\n[one_fourth_last no_margin="false"]' + 'Content here' + '[/one_fourth_last]\n';
				break;
			//  1/4 - 1/2 - 1/4
			case 'One_4th_One_half_One_4th':
				return '[one_fourth no_margin="false"]' + 'Content here' + '[/one_fourth]\n[one_half no_margin="false"]' + 'Content here' + '[/one_half]\n[one_fourth_last no_margin="false"]' + 'Content here' + '[/one_fourth_last]\n';
				break;
			//  1/5 - 4/5
			case 'One_5th_Four_5th':
				return '[one_fifth no_margin="false"]' + 'Content here' + '[/one_fifth]\n[four_fifth_last no_margin="false"]' + 'Content here' + '[/four_fifth_last]\n';
				break;
			//  4/5 - 1/5
			case 'Four_5th_One_5th':
				return '[four_fifth no_margin="false"]' + 'Content here' + '[/four_fifth]\n[one_fifth_last no_margin="false"]' + 'Content here' + '[/one_fifth_last]\n';
				break;
			// 2/5 - 3/5
			case 'Two_5th_Three_5th':
				return '[two_fifth no_margin="false"]' + 'Content here' + '[/two_fifth]\n[three_fifth_last no_margin="false"]' + 'Content here' + '[/three_fifth_last]\n';
				break;
			// 3/5 - 2/5
			case 'Three_5th_Two_5th':
				return '[three_fifth no_margin="false"]' + 'Content here' + '[/three_fifth]\n[two_fifth_last no_margin="false"]' + 'Content here' + '[/two_fifth_last]\n';
				break;
			}
			break;
		
		
		// Partial Section
        //--------------------------------------------------------
		 case 'partial_section':
			var ps_align 				= jQuery('[name="partial_section_align"]').val();
			var ps_bgimage       		= jQuery('[name="partial_section_bg_image"]').val();
			var ps_attachment 			= jQuery('[name="partial_section_bg_attachment"]').val();
			var ps_repeat     	 		= jQuery('[name="partial_section_bg_repeat"]').val();
			var ps_position   	 		= jQuery('[name="partial_section_bg_position"]').val();
			var ps_bgcolor    	 		= jQuery('[name="partial_section_bg_color"]').val();
			var ps_content  		  	= jQuery('[name="partial_section_content"]').val();
			var ps_content_bgcolor   	= jQuery('[name="partial_section_content_bg_color"]').val();
			var ps_content_text_color	= jQuery('[name="partial_section_content_text_color"]').val();
	
			if (ps_align !== '') {
				ps_align = ' ps_align="' + ps_align + '"';
			}
	
			if ( ps_bgimage !== '' ) {
				ps_bgimage = ' ps_image="' + ps_bgimage + '"';
			}
			if ( ps_bgcolor !== '') {
				ps_bgcolor = ' ps_bgcolor="' + ps_bgcolor + '"';
			}else { ps_bgcolor =''};
			
			if ( ps_attachment !== '' ) {
				ps_attachment = ' ps_attachment="' + ps_attachment + '"';
			}
			if ( ps_repeat !== '' ) {
				ps_repeat = ' ps_repeat="' + ps_repeat + '"';
			}
			if ( ps_position !== '') {
				ps_position = ' ps_position="' + ps_position + '"';
			}
			
			if ( ps_content !== '') {
				ps_content =  ps_content;
			}else{
				ps_content =  'Content Here...';
			}
			
			if ( ps_content_bgcolor !== '') {
				ps_content_bgcolor = ' ps_content_bgcolor="' + ps_content_bgcolor + '"';
			}else { ps_content_bgcolor =''};
			
			if ( ps_content_text_color !== '') {
				ps_content_text_color = ' ps_content_text_color="' + ps_content_text_color + '"';
			}else { ps_content_text_color =''};
			
			return '\n[partial_section' + ps_align + ps_bgimage + ps_bgcolor + ps_attachment + ps_repeat + ps_position +  ps_content_bgcolor + ps_content_text_color +']'+ ps_content +'[/partial_section]';
			break;

            // D R O P C A P 
            //--------------------------------------------------------
        case 'dropcap':
			var type			= jQuery('[name="dropcap_type"]').val();
			var text			= jQuery('[name="dropcap_text"]').val();
			var text_color		= jQuery('[name="dropcap_textcolor"]').val();
			var bgcolor			= jQuery('[name="dropcap_bgcolor"]').val();
			var droptype		= jQuery('#dropcap_type').val();

			if ( type )			{ type = ' type="' + type + '"'; }
			if ( text )			{ text = ' letter="' + text + '"'; }
			if ( text_color )	{ text_color = ' text_color="' + text_color + '"'; }	
			if ( bgcolor )		{ bgcolor = ' bgcolor="' + bgcolor + '"'; }

			if(droptype == 'dropcap3'){
				return '[dropcap'+ type + text_color + text +']';
			}else{
				return '[dropcap'+ type + bgcolor + text_color + text +']';
			}
			break;
            
            // G O O G L E   F O N T
            //--------------------------------------------------------
        case 'googlefont':
			var font	= jQuery('[name="googlefont_font"]').val();
			var size	= jQuery('[name="googlefont_size"]').val();
			var margin	= jQuery('[name="googlefont_margin"]').val();
			var text	= jQuery('[name="googlefont_text"]').val();
			var weight	= jQuery('[name="googlefont_weight"]').val();
			var extend	= jQuery('[name="googlefont_extend"]').val();
			var fontstyle	= jQuery('[name="googlefont_font_style"]');
			var color	= jQuery('[name="googlefont_color"]').val();
			
			if ( font ) 	{ font = ' font="' + font + '"'; }
			if ( size ) 	{ size = ' size="' + size + '"'; }
			if ( margin ) 	{ margin = ' margin="' + margin + '"'; }
			if( weight ) 	{ weight = ' weight="' + weight + '"'; }
			if( extend ) 	{ extend = ' extend="' + extend + '"'; }
			if ( text ) 	{ text = '' + text + ''; }
			if ( color ) 	{ color = ' color="' + color + '"'; }
			if (fontstyle.is(':checked')) {
				fontstyle = ' fontstyle="true"';
			} else {
				fontstyle = ' fontstyle="false"';
			}
			
			return '[googlefont' + font + size + margin + weight + color + extend + fontstyle + ']' + text + '[/googlefont]';
			break;
            // H I G H L I G H T 
            //--------------------------------------------------------
        case 'highlight':
            var text_color 		= jQuery('[name="highlight_textcolor"]').val();
			var bgcolor 		= jQuery('[name="highlight_bgcolor"]').val();
			var text 			= jQuery('[name="highlight_text"]').val();
			var type 			= jQuery('[name="highlight_type"]').val();
			var highlight_type 	= jQuery('#highlight_type').val();

			if ( text )				{ text = '' + text + ''; }
			if ( bgcolor )			{ bgcolor = ' bgcolor="' + bgcolor + '" '; }
			if ( type )				{ type = ' type="' + type + '" '; }
			if ( text_color )		{ text_color = ' text_color="' + text_color + '" '; }

			if(highlight_type == 'highlight1'){
				return '[highlight' + bgcolor + text_color + type +']' + text + '[/highlight]';
			}else{
				return '[highlight' +  text_color + type +']'+text +'[/highlight]';
			}
			break;
            
            // F A N C Y   H E A D I N G 
            //--------------------------------------------------------
        case 'fancyheading':
            var textcolor 			= jQuery('[name="fancyheading_textcolor"]').val();
			var heading 			= jQuery('[name="fancyheading_heading"]').val();
			var align 				= jQuery('[name="fancyheading_align"]').val();
			var text 				= jQuery('[name="fancyheading_text"]').val();
			var text_description 	= jQuery('[name="fancyheading_description"]').val();
			var heading_style       = jQuery('[name="fancyheading_heading_style"]').val();
			var border_style		= jQuery('[name="fancyheading_border_style"]').val();
			var border_width        = jQuery('[name="fancyheading_border_width"]').val();
			var border_color        = jQuery('[name="fancyheading_border_color"]').val();
			var margin_bottom 	= jQuery('[name="fancyheading_marginbottom"]').val();
			
			
			if (text !== '') {
				text = ' text="' + text + '"';
			}
			if (textcolor !== '') {
				textcolor = ' textcolor="' + textcolor + '"';
			}
			
			if(border_style !== ''){
				border_style = ' border_style="' + border_style + '"';
			}
			if(border_width !== ''){
				border_width = ' border_width="' + border_width + '"';
			}
			if(border_color !== ''){
				border_color = ' border_color="' + border_color + '"';
			}
			if (heading !== '') {
				heading = ' heading="' + heading + '"';
			}
			if (align !== '') {
				align = ' align="' + align + '"';
			}
			if (margin_bottom !== '') {
				margin_bottom = ' margin_bottom="' + margin_bottom + '"';
			}
			
			if(heading_style == 'border_heading'){
				if(heading_style !== ''){
					heading_style = ' heading_style="' + heading_style + '"';
				}
				return '\n[fancyheading' + textcolor + heading + align  + text + heading_style + border_style +  border_width + border_color + margin_bottom+']' + text_description + '[/fancyheading]\n';
			}else{
				return '\n[fancyheading' + textcolor + heading + align  + text + margin_bottom +']' + text_description + '[/fancyheading]\n';
			}
			break;

			// C O U N  T E R
			//--------------------------------------------------------
		case 'counter':
			var counter_title 	= jQuery('[name="counter_counter_text"]').val();
			var icon_style 		= jQuery('[name="counter_counter_iconstyle"]').val();
			var icon_color 		= jQuery('[name="counter_icon_color"]').val();
			var datato 			= jQuery('[name="counter_data_to"]').val();
			var number_color 	= jQuery('[name="counter_numbercolor"]').val();
			var data_speed 		= jQuery('[name="counter_data_speed"]').val();
		  
			if (icon_style !== '') {
				icon_style = ' icon_style="' + icon_style + '"';
			}
			if (icon_color !== '') {
				icon_color = ' icon_color="' + icon_color + '"';
			}
			if (counter_title !== '') {
				counter_title = ' counter_title="' + counter_title + '"';
			}
			
			if (datato !== '') {
				datato = ' datato="' + datato + '"';
			}
			if ( number_color !== '') {
				number_color = ' number_color="' + number_color + '"';
			}
			if (data_speed !== '') {
				data_speed = '  data_speed="' + data_speed + '"';
			}
			return '\n[counter' + icon_style + datato + data_speed + icon_color + counter_title + number_color+ ']\n';
			break;
			
            // Section Row
            //--------------------------------------------------------
        case 'section':
         	var textcolor   = jQuery('[name="section_textcolor"]').val();
			var bgimage     = jQuery('[name="section_bgimage"]').val();
			var bgcolor     = jQuery('[name="section_bgcolor"]').val();
			var text        = jQuery('[name="section_text"]').val();
			var padding     = jQuery('[name="section_padding"]').val();
			var video       = jQuery('[name="section_video"]').val();
			var attachment  = jQuery('[name="section_bg_attachment"]').val();
			var repeat      = jQuery('[name="section_bg_repeat"]').val();
			var position    = jQuery('[name="section_bg_position"]').val();
			var opacity     = jQuery('[name="section_opacity"]').val();
			var parallax    = jQuery('[name="section_parallax"]'); 
			var border_width  = jQuery('[name="section_border_width"]').val();
			var border_color  = jQuery('[name="section_border_color"]').val();
			var pattern     =jQuery("input[name='section_videopattern']:checked").val();
			if (text !== '') {
				text = '' + text + '';
			}
			if (bgcolor !== '') {
				bgcolor = ' bgcolor="' + bgcolor + '"';
			}
			else {bgcolor =''};
			if (bgimage !== '') {
				bgimage = ' image="' + bgimage + '"';
			}
			if (textcolor !== '') {
				textcolor = ' textcolor="' + textcolor + '"';
			}
			if (padding !== '') {
				padding = ' padding="' + padding + '"';
			}

		   if (position !== '') {
				position = ' position="' + position + '"';
			}

			if (attachment !== '') {
				attachment = ' attachment="' + attachment + '"';
			}
		   if (repeat !== '') {
				repeat = ' repeat="' + repeat + '"';
			}
			if (border_width !== '') {
				border_width = ' border_width="' + border_width + '"';
			}
			if (border_color !== '') {
				border_color = ' border_color="' + border_color + '"';
			}
		   if (pattern) {
				pattern = ' pattern="' + pattern + '"';
			}else{
				pattern='';
			}
			if (video !== '') {
					video = ' video="' + video + '"';
				}
			if (opacity !== '') {
					opacity = ' opacity="' + opacity + '"';
				}			if (parallax.is('.iva-button')){
			if (parallax.is(':checked')) {
				parallax = ' parallax="true"';
			} else {
				parallax = ' parallax="false"';
				}
			}
			return '\n[section' + bgcolor + textcolor + padding + bgimage + video + opacity +border_width + border_color + parallax + pattern + position + repeat + attachment +  ']Content Here[/section]\n';
			break;

            // B L O C K Q U O T E 
            //--------------------------------------------------------
        case 'blockquote':
			var qalign				= jQuery('[name="blockquote_align"]:checked').val();
			var cite 				= jQuery('[name="blockquote_cite"]').val();
			var citelink 			= jQuery('[name="blockquote_citelink"]').val();
			var content				= jQuery('[name="blockquote_content"]').val();
			var width 				= jQuery('[name="blockquote_width"]').val();
			var animation   		= jQuery('[name="blockquote_animation"]').val();
			var background_color 	= jQuery('[name="blockquote_background_color"]').val();
			var text_color 			= jQuery('[name="blockquote_text_color"]').val();
			
			var bg_color = txt_color = '';

			if (content !== '') {
				content = '' + content + '';
			}

			if( typeof( qalign )  === "undefined") {
				qalign = '';
			}else{
				qalign = ' align="' + qalign + '"';
			}

			if (animation !== '') {
				animation = ' animation="' + animation + '"';
			}

			if (cite !== '') {
				cite = ' cite="' + cite + '"';
			}
			if (citelink !== '') {
				citelink = ' citelink="' + citelink + '"';
			}
			if (width !== '') {
				width = ' width="' + width + '"';
			}
			if (background_color !== '') {
				bg_color = ' bg_color="' + background_color + '"';
			}
			if (text_color !== '') {
				txt_color = ' txt_color="' + text_color + '"';
			}
			return '[blockquote' + qalign + width + cite + citelink + animation + bg_color + txt_color + ']' + content + '[/blockquote]\n';
			break;

			// C U S T O M   A N I M A T I O N
            //--------------------------------------------------------
			case 'custom_animation':
				var animation 	= jQuery('[name="custom_animation_animation"]').val();
				var content 	= jQuery('[name="custom_animation_content"]').val();
				var position 	= jQuery('[name="custom_animation_tooltip_position"]').val();
				var caption     = jQuery('[name="custom_animation_caption"]').val();
				if(position){
					position = ' position="' + position + '"';
				}
				if(caption){
					caption = ' caption="' + caption + '"';
				}
				if (animation !== '') {
					animation = ' animation="' + animation + '"';
				}
				if (content !== '') {
					content = '' + content + '';
				}
				return '[custom_animation' + position + caption + animation + ']' + content + '[/custom_animation]\n';
				break;

            // S T Y L E D   L I S T S 
            //--------------------------------------------------------
        case 'styledlist':
           	var icon = jQuery('[name="styledlist_icon"]').val();
            var color = jQuery('[name="styledlist_color"]').val();
			var circle_bg = jQuery('[name="styledlist_circle_bg"]').val();
            var liststyle = jQuery('[name="styledlist_liststyle"]').val();
			var content = jQuery('[name="styledlist_content"]').val();
		
            cont = content.split("\n");
            var  html ='';
            for( i = 0; i < cont.length; i++ ) {
                html += "<li>"+cont[i]+"</li>\n"; ; 
            }
               
            if ( content ) { content = '' + content + ''; }
            if ( icon ) { icon = ' icon="' + icon + '"';
            }
            if (color ) {
                color = ' color="' + color + '"';
            }
			if (circle_bg ) {
                circle_bg = ' bgcolor="' + circle_bg + '"';
            }
            if (liststyle ) {
                liststyle = ' liststyle="' + liststyle + '"';
            }

            return '\n[list' + icon + color + circle_bg + liststyle +  ']\n' + "<ul>\n" +html+"</ul>" +'\n[/list]\n';
            break;

           
        	// I C O N S  S T Y L E S
		//---------------------------------------------------------
	   case 'icons':
            var style = jQuery('[name="icons_icon"]').val();
            var size = jQuery('[name="icons_size"]').val();
            var color = jQuery('[name="icons_color"]').val();
            if (style !== '') {
                style = ' style="' + style + '"';
            }
            if (size !== '') {
                size = '  size="' + size + '"';
            }
            if (color !== '') {
                color = ' color="' + color + '"';
            }
            return '\n[icons' + style + size + color + ']\n';
            break;

			// Icon
			//--------------------------------------------------------
		case 'iconbox':
			var style 			= jQuery('[name="iconbox_style"]').val();
			var icon 			= jQuery('[name="iconbox_icon"]').val();
			var text 			= jQuery('[name="iconbox_text"]').val();
			var title 			= jQuery('[name="iconbox_title"]').val();
			var def_icon_color 	= jQuery('[name="iconbox_def_icon_color"]').val();
			//var icon_bgcolor 	= jQuery('[name="iconbox_icon_bgcolor"]').val();
			var icon_color 		= jQuery('[name="iconbox_icon_color"]').val();
			var align 			= jQuery('[name="iconbox_align"]').val();
			var style_type      = jQuery('#iconbox_style').val();

			if ( animation ) {
				animation = ' animation="' + animation + '"';
			}	
			if ( style  ) {
				style = ' style="' + style + '"';
			}	
			if ( text ) {
				text = '' + text + '';
			}
			if ( align  ) {
				align = ' align="' + align + '"';
			}
			if ( title ) {
				title = ' title="' + title + '"';
			}
			if ( def_icon_color ) {
				def_icon_color = ' def_icon_color="' + def_icon_color + '"';
			}
			if ( icon ) {
				icon = ' icon="' + icon + '"';
			}
			
			if ( icon_color ) {
				icon_color = ' icon_color="' + icon_color + '"';
			}
			
			if( style_type == 'style1' || style_type == 'style4' || style_type == 'style5'){
				return '[iconbox' + style + align + icon +   icon_color +  title + ']' + text + '[/iconbox]\n';
			}else{
				return '[iconbox' + style + align + icon +  def_icon_color + title + ']' + text + '[/iconbox]\n';
			}
			break;

			// Services
			//--------------------------------------------------------
		case 'services':
			
			var imagesrc 	= jQuery('[name="services_image"]').val();
			var title 		= jQuery('[name="services_title"]').val();
			var link 		= jQuery('[name="services_link"]').val();
			var animation 	= jQuery('[name="services_animation"]').val();
				
			if (style !== '') {
				style = ' style="' + style + '"';
			}		
			if (title !== '') {
				title = ' title="' + title + '"';
			}
			if (link !== '') {
				link = ' link="' + link + '"';
			}
				
			if (imagesrc !== '') {
				imagesrc = ' image="' + imagesrc + '"';
			}
			if (animation !== '') {
				animation = ' animation="' + animation + '"';
			}

			return '\n[services' +  animation + imagesrc + title + link + '][/services]\n';
			break;

			// Pest
			//--------------------------------------------------------
		case 'pest':
			
			var imagesrc 	= jQuery('[name="pest_image"]').val();
			var title 		= jQuery('[name="pest_title"]').val();
			var link 		= jQuery('[name="pest_link"]').val();
			var animation 	= jQuery('[name="pest_animation"]').val();
				
			if (style !== '') {
				style = ' style="' + style + '"';
			}		
			if (title !== '') {
				title = ' title="' + title + '"';
			}
			if (link !== '') {
				link = ' link="' + link + '"';
			}
		
			if (imagesrc !== '') {
				imagesrc = ' image="' + imagesrc + '"';
			}
			if (animation !== '') {
				animation = ' animation="' + animation + '"';
			}

			return '\n[services' +  animation + imagesrc + title + link + '][/services]\n';
			break;

            // F A N C Y   A M P E R S A N D
            //--------------------------------------------------------
        case 'fancy_ampersand':
            var size = jQuery('[name="fancy_ampersand_size"]').val();
            var color = jQuery('[name="fancy_ampersand_color"]').val();
            if (size !== '') {
                size = ' size="' + size + '"';
            }
            if (color !== '') {
                color = ' color="' + color + '"';
            }

            return '[fancy_ampersand' + size + color + ']';
            break;

            // I C O N   L I N K S
            //--------------------------------------------------------
        case 'iconlinks':
            var style = jQuery('[name="iconlinks_style"]').val();
            var color = jQuery('[name="iconlinks_color"]').val();
            var href = jQuery('[name="iconlinks_href"]').val();
            var target = jQuery('[name="iconlinks_target"]').val();
            var text = jQuery('[name="iconlinks_text"]').val();
            if (text !== '') {
                text = '' + text + '';
            }
            if (style !== '') {
                style = ' style="' + style + '"';
            }
            if (color !== '') {
                color = ' color="' + color + '"';
            }
            if (href !== '') {
                href = ' href="' + href + '"';
            }
            if (target !== '') {
                target = ' target="' + target + '"';
            }

            return '\n[icon' + style + color + href + target + ']' + text + '[/icon]\n';
            break;
		// CAROUSEL SLIDER  
		//--------------------------------------------------------
		case 'carouselslider':
			var carouselslider_cat 			= jQuery('[name="carouselslider_category_cat[]"]').val();
			var carouselslider_max 			= jQuery('[name="carouselslider_category_limit"]').val();
			var carouselslider_cat_items 	= jQuery('[name="carouselslider_category_items"]').val();

			if(carouselslider_cat!="")			{ cat = ' cat="'+carouselslider_cat+'"';	}else{	cat = '';}
			if(carouselslider_max!="")			{ max = ' limit="'+carouselslider_max+'"';}else{max	 = '';}
			if(carouselslider_cat_items!="")			{ items = ' items="'+carouselslider_cat_items+'"';	}else{	items = '';}

			return '[carousel_list'+cat+max+items+']';
			break;

            // B U T T O N  
            //--------------------------------------------------------
        case 'button':

			var id 				= jQuery('[name="button_btn-id"]').val();
			var sub_class 		= jQuery('[name="button_btn-subclass"]').val();
			var link 			= jQuery('[name="button_btn-link"]').val();
			var link_target 	= jQuery('[name="button_btn-linktarget"]');
			var button_color 	= jQuery('[name="button_btn-color"]').val();
			var align 			= jQuery('[name="button_btn-align"]').val();
			var bgcolor 		= jQuery('[name="button_btn-bgcolor"]').val();
			var hover_bgcolor 	= jQuery('[name="button_btn-hoverbgcolor"]').val();
			var text 			= jQuery('[name="button_btn-text"]').val();
			var text_color 		= jQuery('[name="button_btn-textcolor"]').val();
			var hover_textcolor = jQuery('[name="button_btn-hovertextcolor"]').val(); 
			var size 			= jQuery('[name="button_btn-size"]').val();
			var style 			= jQuery('[name="button_btn-style"]').val();
			var width 			= jQuery('[name="button_btn-width"]').val();
			var full_width 		= jQuery('[name="button_btn-fullwidth"]');
			var lightbox 		= jQuery('[name="button_btn-lightbox"]');
			var border_color 	= jQuery('[name="button_btn-border-color"]').val();
			var button_icon 	= jQuery('[name="button_btn-icon"]').val();
			var def_color 		= jQuery('#button_btn-color').val();
			
			if ( full_width.is('.iva-button') ) {
				if (full_width.is(':checked')) {
					full_width = ' full_width="true"';
				} else {
					full_width = ' full_width="false"';
				}
			}
		
			if (lightbox.is(':checked')) {
				lightbox = ' lightbox="true"';
			} else {
				lightbox = '';
			}
		
		   
			if (link_target.is(':checked')) {
				link_target = ' link_target="true"';
			} else {
				link_target = '';
			}
		

			if ( id !== '' ) {
				id = ' id="' + id + '"';
			}
			if ( sub_class !== '' ) {
				sub_class = ' class="' + sub_class + '"';
			}
			if ( link !== '' ) {
				link = ' link="' + link + '"';
			}
		
			if ( button_color !== '') {
				button_color = ' button_color="' + button_color + '"';
			}
			if ( border_color !== '' ) {
				border_color = ' border_color="' + border_color + '"';
			}
			if ( align !== '' ) {
				align = ' align="' + align + '"';
			}
			if ( bgcolor !== '' ) {
				bgcolor = ' bgcolor="' + bgcolor + '"';
			}
			if ( hover_bgcolor !== '' ) {
				hover_bgcolor = ' hover_bgcolor="' + hover_bgcolor + '"';
			}
			if( button_icon !== '' ){
				button_icon = ' button_icon="' + button_icon + '"';
			}
			
			if ( hover_textcolor !== '' ) {
				hover_textcolor = ' hover_textcolor="' + hover_textcolor + '"';
			}
			if ( text_color !== '' ) {
				text_color = ' text_color="' + text_color + '"';
			}
			if ( size !== '' ) {
				size = ' size="' + size + '"';
			}
			if ( style !== '' ) {
				style = ' style="' + style + '"';
			}
			if ( width !== '' ) {
				width = ' width="' + width + '"';
			}
			
			var btnstyle = jQuery('#button_btn-style').val();
		
			if( btnstyle != 'border' ){
				if(def_color == 'custom'){
					return '[button' + style +  size +  button_color +  bgcolor + hover_bgcolor + hover_textcolor + text_color +  id + sub_class +  link +  link_target +  lightbox +  align + full_width +   width + button_icon +']' + text + '[/button]';
				}
				else if( def_color != 'custom' ){
					return '[button' + style +  size +  button_color +  id + sub_class +  link +  link_target +  lightbox +  align + full_width +   width + button_icon +']' + text + '[/button]';	
				}
			}else if( btnstyle == 'border' ){

				return '[button' + style +  size +  border_color + id + sub_class +  link +  link_target +  lightbox +  align + full_width +   width + button_icon +']' + text + '[/button]';
			}  
			break;

            // D I V I D E R S 
            //--------------------------------------------------------
        case 'divider':
            var shortcodesub_type = jQuery('#secondary_divider select').val();
			if (shortcodesub_type == 'custom_divider') {
				var img = jQuery("[name=divider_custom_divider_dividerimg]").val();
				if (img != '') {
					img = ' img="' + img + '"';
				} else {
					img = '';
				}
				return '\n[custom_divider' + img + ']\n';
			} else if (shortcodesub_type == 'demo_space') {
				var height = jQuery("[name=divider_demo_space_height]").val();
				if (height != '') {
					height = ' height="' + height + '"';
				} else {
					height = '';
				}
				return '\n[demo_space' + height + ']\n';
			} else if (shortcodesub_type == 'divider') {
				var margin = jQuery("[name=divider_divider_margin]").val();
				var dividertype = jQuery('[name="divider_divider_dividertype"]').val();
				var bordercolor = jQuery('[name="divider_divider_bordercolor"]').val();
				if (margin != '') {
					margin = ' margin="' + margin + '"';
				} else {
					margin = '';
				}
				if (bordercolor != '') {
					bordercolor = ' bordercolor="' + bordercolor + '"';
				}
				if (dividertype !== '') {
					dividertype = ' style="' + dividertype + '"';
				}
				return '\n[divider' + dividertype + margin + bordercolor + ']\n';
			} else {
				return '\n[' + jQuery('#secondary_divider select').val() + ']\n';
			}
           

			// F A N C Y  B O X 
			//--------------------------------------------------------
		case 'fancybox':
			var title 			= jQuery('[name="fancybox_title"]').val();
			var animation 		= jQuery('[name="fancybox_animation"]').val();
			var title_bgcolor 	= jQuery('[name="fancybox_titlebgcolor"]').val();
			var title_color 	= jQuery('[name="fancybox_titlecolor"]').val();
			var box_textcolor 	= jQuery('[name="fancybox_boxtextcolor"]').val();
			var box_bgcolor 	= jQuery('[name="fancybox_boxbgcolor"]').val();
			var ribbon 			= jQuery('[name="fancybox_ribbon"]').val();
			var text 			= jQuery('[name="fancybox_text"]').val();
			//var box_rib_check 	= jQuery('[name="fancybox_box_ribbon"]').val();
			var ribbon_text 	= jQuery('[name="fancybox_rib_text"]').val();
			var rib_custom_color= jQuery('[name="fancybox_rib_custom_color"]').val();
			var default_color 	= jQuery('[name="fancybox_rib_color"]').val();
			var def_color_type  = jQuery('#fancybox_rib_color').val();
			var ribbon_size 	= jQuery('[name="fancybox_rib_size"]').val();
			var ribbon_check 	= jQuery('[name="fancybox_box_ribbon"]');

			var rib_check 		= jQuery("#fancybox_box_ribbon").is(':checked');

			

			if ( text  ) {
				text = '' + text + '';
			}
			if ( title ) {
				title = ' title="' + title + '"';
			}
			if ( animation ) {
				animation = ' animation="' + animation + '"';
			}				
			if ( title_bgcolor  ) {
				title_bgcolor = ' title_bgcolor="' + title_bgcolor + '"';
			}

			if (ribbon_check.is(':checked')) {
				ribbon_check = ' ribbon_check="true"';
			} else {
				ribbon_check = ' ribbon_check="false"';
			}
			/*
			if ( ribbon_check  ) {
				ribbon_check = ' ribbon_check="' + ribbon_check + '"';
			}
			*/
			if ( title_color ) {
				title_color = ' title_color="' + title_color + '"';
			}
			if ( box_textcolor ) {
				box_textcolor = ' box_textcolor="' + box_textcolor + '"';
			}
			if ( box_bgcolor ) {
				box_bgcolor = ' box_bgcolor="' + box_bgcolor + '"';
			}
			if( ribbon_text ){
				ribbon_text = ' ribbon_text="' + ribbon_text + '"';
			}
			if( rib_custom_color ){
                rib_custom_color = ' rib_custom_color="' + rib_custom_color + '"';
            }
			if( default_color ){
				default_color = ' default_color="' + default_color + '"';
			}
			if( ribbon_size ){
				ribbon_size = ' ribbon_size="' + ribbon_size + '"';
			}
			
			if( rib_check == false ){
				return '\n[fancybox' + title + title_bgcolor + title_color + box_textcolor + box_bgcolor + ribbon_check + animation +']' + text + '[/fancybox]\n';
			}else{
				if(def_color_type == 'custom'){
					return '\n[fancybox' + title + title_bgcolor + title_color + box_textcolor + box_bgcolor +  ribbon_text + rib_custom_color + default_color + ribbon_size + ribbon_check + animation +']' + text + '[/fancybox]\n';
				}else if(def_color_type != 'custom'){
					return '\n[fancybox' + title + title_bgcolor + title_color + box_textcolor + box_bgcolor +  ribbon_text +  default_color + ribbon_size + ribbon_check + animation +']' + text + '[/fancybox]\n';	
				}
			}
			break;

    		// M I N I   G A L L E R Y 
            //--------------------------------------------------------
        case 'minigallery':
            var width = jQuery('[name="minigallery_width"]').val();
            var height = jQuery('[name="minigallery_height"]').val();
            var imageclass = jQuery('[name="minigallery_class"]').val();
            var minigallery_textareaurl = jQuery('[name="minigallery_textarea_url"]').val();
            if (minigallery_textareaurl != "") {
                content = '' + minigallery_textareaurl + '';
            }
            if (width != '') {
                width = ' width="' + width + '"';
            } else {
                width = ' width="200"';
            }
            if (height != '') {
                height = ' height="' + height + '"';
            } else {
                height = ' height="200"';
            }
            if (imageclass != '') {
                imageclass = ' class="' + imageclass + '"';
            }
            return '\n[minigallery' + imageclass + width + height + ']' + content + '[/minigallery]\n';;
            break;
			
            // T A B S 
            //--------------------------------------------------------
        case 'Tabs':
		
			var shortcodesub_tabs = jQuery('#secondary_Tabs select').val();
			count = shortcodesub_tabs.replace('t', '');
			var stabstype = jQuery('[name="Tabs_' + shortcodesub_tabs + '_ctabs' + '"]').val();
			var animation = jQuery('[name="Tabs_' + shortcodesub_tabs + '_animation' + '"]').val();
			if (animation !== '') {
					animation = ' animation="' + animation + '"';
				}	
			var outputs = '[minitabs ' +animation+ ' tabtype="' + stabstype + '"]';
			for (var i = 1; i <= count; i++) {
				
				var title 		= jQuery('[name="Tabs_' + shortcodesub_tabs + '_title_' + i + '"]').val();
				var bgcolor 	= jQuery('[name="Tabs_' + shortcodesub_tabs + '_titlebgcolor_' + i + '"]').val();
				var color 		= jQuery('[name="Tabs_' + shortcodesub_tabs + '_titlecolor_' + i + '"]').val();
				var content 	= jQuery('[name="Tabs_' + shortcodesub_tabs + '_text_' + i + '"]').val();
				var stabstype 	= jQuery('[name="Tabs_' + shortcodesub_tabs + '_ctabs' + '"]').val();
							
				if (title !== '') {
					title = ' title="' + title + '"';
				}
				if (bgcolor !== '') {
					bgcolor = ' tabcolor="' + bgcolor + '"';
				}
				if (color !== '') {
					color = ' textcolor="' + color + '"';
				}
				if (content !== '') {
					content = '' + content + '';
				}
				outputs += '[tab' + title + color + bgcolor + ']\n' + content + '\n[/tab]\n';
			}
			outputs += '[/minitabs]';
			return outputs;
			break;  	
            // A C C O R D I O N 
            //--------------------------------------------------------
        case 'accordion':
           	var type 			= jQuery('[name="accordion_accordion_type"]').val();
			var accordion_col 	= jQuery('[name="accordion_accordion_col"]').val();
			var iva_anim 		= jQuery('[name="accordion_animation"]').val();
			var mode 			= jQuery('[name="accordion_accordion_mode"]').val();
			var accordion_type  = jQuery("#accordion_accordion_type").val();
			//var accordion_mode  = jQuery("#accordion_accordion_mode").val();

			if ( type )			{ type = ' type="' + type + '"'; }	
			if ( iva_anim )		{ iva_anim = ' animation="' + iva_anim + '"'; }	
			if ( mode )			{ mode = ' mode="' + mode + '"';	}

			if( accordion_type == 'normal' ){	
				var outputs = '[accordion-wrap' + iva_anim + type  + mode +']\n';

				for ( var i = 1; i <= accordion_col; i++ ) {
					outputs += '[accordion title="Title Here" icon="fa-leaf" active="false"]Content Here[/accordion]\n';
				}
				outputs += '[/accordion-wrap]';
			} 
			if( accordion_type == 'faq' ){
				var outputs = '[accordion-wrap' + iva_anim + type +  mode + ']\n';
				for ( var i = 1; i <= accordion_col; i++ ) {
					outputs += '[accordion title="Title Here" icon="fa-leaf" active="false"]Content Here[/accordion]\n';
				}
				outputs += '[/accordion-wrap]';
			}	
			return outputs;
            break;
            
            // I M A G E 
            //-------------------------------------------------------------
        case 'image':
			var animation 	= jQuery('[name="image_animation"]').val();
            var title 		= jQuery('[name="image_title"]').val();
            var caption 	= jQuery('[name="image_caption"]').val();
            var lightbox 	= jQuery('[name="image_lightbox"]');
            var width 		= jQuery('[name="image_width"]').val();
            var height 		= jQuery('[name="image_height"]').val();
            var align 		= jQuery('[name="image_align"]').val();
            var alink 		= jQuery('[name="image_alink"]').val();
            var imgclass 	= jQuery('[name="image_class"]').val();
            var target 		= jQuery('[name="image_target"]');
            var imagesrc 	= jQuery('[name="image_imagesrc"]').val();
			var tooltip_pos = jQuery('[name="image_tooltip_position"]').val();
            if (imagesrc != '') {
                imagesrc = ' src="' + imagesrc + '"';
            }
			if(tooltip_pos !=''){
				 position = ' position="' + tooltip_pos + '"';
			}
            if (width != '') {
                width = ' width="' + width + '"';
            } else {
                width = ' width="200"';
            }
            if (height != '') {
                height = ' height="' + height + '"';
            } else {
                height = ' height="200"';
            }
            if (title != '') {
                title = ' title="' + title + '"';
            }
            if (caption != '') {
                caption = ' caption="' + caption + '"';
            }
            if (alink != '') {
                alink = ' link="' + alink + '"';
            }

			if (target.is(':checked')) {
            	target = ' target="true"';
            } else {
            	target = ' target="false"';
            }
           
            if (imgclass != '') {
                imgclass = ' class="' + imgclass + '"';
            }
            if (align != '') {
                align = ' align="' + align + '"';
            }
			if (animation !== '') {
				animation = ' animation="' + animation + '"';
			}
            if (lightbox.is('.iva-button')) {
                if (lightbox.is(':checked')) {
                    lightbox = ' lightbox="true"';
                } else {
                    lightbox = ' lightbox="false"';
                }
            }

            return '\n[image' + width + height + title + caption + lightbox + align + alink + target + imagesrc + imgclass + position + animation + ']\n';
            break;
           
            
            // G O O G L E   M A P 
        case 'gmap':
            var width = jQuery('[name="gmap_width"]').val();
            var height = jQuery('[name="gmap_height"]').val();
            var address = jQuery('[name="gmap_address"]').val();
            var latitude = jQuery('[name="gmap_latitude"]').val();
            var longitude = jQuery('[name="gmap_longitude"]').val();
            var stylerscolor = jQuery('[name="gmap_stylerscolor"]').val();
            var zoom = jQuery('[name="gmap_zoom"]').val();
            var marker_desc = jQuery('[name="gmap_marker_desc"]').val();
            var popup = jQuery('[name="gmap_infowindow"]');
            var maptype = jQuery('[name="gmap_types"]').val();
            var controller = jQuery('[name="gmap_controller"]');
			var visibility = jQuery('[name="gmap_visibility"]');
			
            if (popup.is('.iva-button')) {
                if (popup.is(':checked')) {
                    popup = ' infowindow="true"';
                } else {
                    popup = ' infowindow="false"';
                }
            }
            if (controller.is('.iva-button')) {
                if (controller.is(':checked')) {
                    controller = ' controller="true"';
                } else {
                    controller = ' controller="false"';
                }
            }
			if (visibility.is('.iva-button')) {
                if (visibility.is(':checked')) {
                    visibility = ' visibility="on"';
                } else {
                    visibility = ' visibility="off"';
                }
            }
			
            if (width != '') {
                width = ' width="' + width + '"';
            }
            if (height != '') {
                height = ' height="' + height + '"';
            }
            if (address != '') {
                address = ' address="' + address + '"';
            }
            if (latitude != '') {
                latitude = ' latitude="' + latitude + '"';
            }
            if (longitude != '') {
                longitude = ' longitude="' + longitude + '"';
            }
            if (stylerscolor != '') {
                stylerscolor = ' color="' + stylerscolor + '"';
            }

            if (content != '') {
                html = ' html="' + marker_desc + '"';
            }
            if (zoom != '') {
                zoom = ' zoom="' + zoom + '"';
            }
            if (maptype != '') {
                maptype = ' maptype="' + maptype + '"';
            }

            return '[gmap' + width + height + latitude + longitude + address + zoom + html + popup + controller + visibility + maptype + stylerscolor + ']';
            break;

            // T W I T T E R
            //--------------------------------------------------------
       case 'twitter':
			var animation   		= jQuery('[name="twitter_animation"]').val();
			var username    		= jQuery('[name="twitter_username"]').val();
			var consumerkey   		= jQuery('[name="twitter_apikey"]').val();
			var consumersecret   	= jQuery('[name="twitter_apisecret"]').val();
			var accesstoken   		= jQuery('[name="twitter_accesstoken"]').val();
			var accesstokensecret   = jQuery('[name="twitter_tokensecret"]').val();
			var limit       		= jQuery('[name="twitter_limit"]').val();
			var color       		= jQuery('[name="twitter_color"]').val();

			if ( animation )	{ animation = ' animation="' + animation + '"'; }
			if ( username )		{ username = ' username="' + username + '"'; }
			if ( consumerkey )	{ consumerkey = ' consumerkey="' + consumerkey + '"'; }
			if ( consumersecret )	{ consumersecret = ' consumersecret="' + consumersecret + '"'; }
			if ( accesstoken )	{ accesstoken = ' accesstoken="' + accesstoken + '"'; }
			if ( accesstokensecret )	{ accesstokensecret = ' accesstokensecret="' + accesstokensecret + '"'; }			
			if ( limit )		{ limit = ' limit="' + limit + '"'; }
			if ( color )		{ color = ' color="' + color + '"'; }

			return '\n[twitter' + animation + username + limit + color + consumerkey + consumersecret + accesstoken + accesstokensecret + ']\n';
			break;
            // F L I C K R 
            //--------------------------------------------------------
        case 'flickr':
            var id = jQuery('[name="flickr_id"]').val();
            var limit = jQuery('[name="flickr_limit"]').val();
            var type = jQuery('[name="flickr_type"]').val();
            var display = jQuery('[name="flickr_display"]').val();
            if (id != '') {
                id = ' id="' + id + '"';
            }
            if (limit != '') {
                limit = ' limit="' + limit + '"';
            }
            if (type != '') {
                type = ' type="' + type + '"';
            }
            if (display != '') {
                display = ' display="' + display + '"';
            }

            return '\n[flickr' + id + limit + display + type + ']\n';
            break;
            // P O P U L A R   P O S T S 
            //--------------------------------------------------------
        case 'popularposts':
            var thumb = jQuery('[name="popularposts_thumb"]');
            var limit = jQuery('[name="popularposts_limit"]').val();
            if (thumb.is('.iva-button')) {
                if (thumb.is(':checked')) {
                    thumb = ' thumb="true"';
                } else {
                    thumb = ' thumb="false"';
                }
            }
            if (limit != '') {
                limit = ' limit="' + limit + '"';
            }

            return '\n[popularpost ' + thumb + limit + ']\n';
            break;
            // R E C E N T   P O S T S 
            //--------------------------------------------------------
        case 'recentposts':
            var thumb = jQuery('[name="recentposts_thumb"]');
            var limit = jQuery('[name="recentposts_limit"]').val();
            var cat_id = jQuery('[name="recentposts_cat_id[]"]').val();
            if (thumb.is('.iva-button')) {
                if (thumb.is(':checked')) {
                    thumb = ' thumb="true"';
                } else {
                    thumb = ' thumb="false"';
                }
            }
            if (limit != '') {
                limit = ' limit="' + limit + '"';
            }
            if (cat_id != '') {
                cat_id = ' cat_id="' + cat_id + '"';
            }

            return '\n[recentpost ' + thumb + limit + cat_id + ']\n';
            break;
           
       	 	// C O N T A C T   I N F O 
			//--------------------------------------------------------
		case 'contactinfo':
			var animation 	= jQuery('[name="contactinfo_animation"]').val();
			var name 		= jQuery('[name="contactinfo_name"]').val();
			var address 	= jQuery('[name="contactinfo_address"]').val();
			var email 		= jQuery('[name="contactinfo_email"]').val();
			var phone 		= jQuery('[name="contactinfo_phone"]').val();
			var website_name = jQuery('[name="contactinfo_website_name"]').val();
            var website_url = jQuery('[name="contactinfo_website_url"]').val();
			var fax = jQuery('[name="contactinfo_fax"]').val();

			if (animation != '') {
				animation = ' animation="' + animation + '"';
			}
			if (name != '') {
				name = ' name="' + name + '"';
			}
			if (address != '') {
				address = ' address="'+ address + '"';
			}
			if (email != '') {
				email = ' email="' + email + '"';
			}
			if (phone != '') {
				phone = ' phone="' + phone + '"';
			}
			if (website_name != '') {
                website_name = ' website_name="' + website_name + '"';
            }
			if (website_url != '') {
                website_url = ' website_url="' + website_url + '"';
            }
			if (fax != '') {
                fax = ' fax="' + fax + '"';
            }
			return '\n[contactinfo '+ animation + name + address + email + phone + website_name + website_url + fax + ']\n';
			break;
            // V I M E O 
            //--------------------------------------------------------
        case 'vimeo':
            var clip_id = jQuery('[name="vimeo_clipid"]').val();
            var autoplay = jQuery('[name="vimeo_autoplay"]');
            if (clip_id != '') {
                clip_id = ' clip_id="' + clip_id + '"';
            }
            if (autoplay.is('.iva-button')) {
                if (autoplay.is(':checked')) {
                    autoplay = ' autoplay="1"';
                } else {
                    autoplay = ' autoplay="0"';
                }
            }

            return '\n[vimeo' + clip_id + autoplay + ']\n';
            break;
            // Y O U T U B E
            //--------------------------------------------------------
        case 'youtube':
            var clipid = jQuery('[name="youtube_clipid"]').val();
            var autoplay = jQuery('[name="youtube_autoplay"]');
            if (clipid != '') {
                clip_id = ' clipid="' + clipid + '"';
            }
            if (autoplay.is('.iva-button')) {
                if (autoplay.is(':checked')) {
                    autoplay = ' autoplay="1"';
                } else {
                    autoplay = ' autoplay="0"';
                }
            }

            return '\n[youtube' + clip_id + autoplay + ']\n';
            break;
            // P O R T F O L I O
            //--------------------------------------------------------
        case 'portfolio':
            var shortcodesub_type = jQuery('#secondary_portfolio select').val();
            switch (shortcodesub_type) {
            case 'normal':
                var columns = jQuery('[name="portfolio_normal_column"]').val();
                var portfolio_cat = jQuery('[name="portfolio_normal_cat[]"]').val();
                var portfoliotitle = jQuery('[name="portfolio_normal_title"]');
                var portfoliodesc = jQuery('[name="portfolio_normal_description"]');
                var portfolio_sidebar = jQuery('[name="portfolio_normal_sidebar"]');
                var portfolio_limit = jQuery('[name="portfolio_normal_limit"]').val();
                var portfolio_readmoretxt = jQuery('[name="portfolio_normal_readmore"]').val();
                var portfoliomorebutton = jQuery('[name="portfolio_normal_morebutton"]');
                var portfolio_limitcontent = jQuery('[name="portfolio_normal_limitcontent"]').val();
                var portfoliopagination = jQuery('[name="portfolio_normal_pagination"]');
                if (columns != "") {
                    columns = ' columns="' + columns + '"';
                } else {
                    columns = ' columns="4"';
                }
                if (portfoliotitle.is('.iva-button')) {
                    if (portfoliotitle.is(':checked')) {
                        title = ' title="false"';
                    } else {
                        title = ' title="true"';
                    }
                }
                if (portfoliodesc.is('.iva-button')) {
                    if (portfoliodesc.is(':checked')) {
                        desc = ' desc="false"';
                    } else {
                        desc = ' desc="true"';
                    }
                }

                if (portfolio_cat == null) {
                    portfolio_cat = "";
                }
                if (portfolio_cat != "") {
                    cat = ' cat="' + portfolio_cat + '"';
                } else {
                    cat = ' cat=""';
                }
                if (portfolio_limit != "") {
                    limit = ' limit="' + portfolio_limit + '"';
                } else {
                    limit = '';
                }
                if (portfolio_readmoretxt != "") {
                    readmoretext = ' readmoretext="' + portfolio_readmoretxt + '"';
                } else {
                    readmoretext = '';
                }
                if (portfoliomorebutton.is('.iva-button')) {
                    if (portfoliomorebutton.is(':checked')) {
                        readmore = ' readmore="false"';
                    } else {
                        readmore = ' readmore="true"';
                    }
                }
                if (portfolio_sidebar.is('.iva-button')) {
                    if (portfolio_sidebar.is(':checked')) {
                        sidebar = ' sidebar="false"';
                    } else {
                        sidebar = ' sidebar="true"';
                    }
                }

                if (portfoliopagination.is('.iva-button')) {
                    if (portfoliopagination.is(':checked')) {
                        pagination = ' pagination="false"';
                    } else {
                        pagination = ' pagination="true"';
                    }
                }
                if (portfolio_limitcontent != "") {
                    charlimits = ' charlimits="' + portfolio_limitcontent + '"';
                } else {
                    charlimits = '';
                }

                return '[portfolio' + columns + cat + title + desc + limit + readmoretext + readmore + charlimits + pagination + sidebar + ']';
                break;
            case 'sortable':
                var columns = jQuery('[name="portfolio_sortable_column"]').val();
                var portfolio_cat = jQuery('[name="portfolio_sortable_cat[]"]').val();
                var portfoliotitle = jQuery('[name="portfolio_sortable_title"]');
                var portfolio_sidebar = jQuery('[name="portfolio_sortable_sidebar"]');
                var portfolio_limit = jQuery('[name="portfolio_sortable_limit"]').val();
                var portfoliopagination = jQuery('[name="portfolio_sortable_pagination"]');
                if (columns != "") {
                    columns = ' columns="' + columns + '"';
                } else {
                    columns = ' columns="4"';
                }
                if (portfoliotitle.is('.iva-button')) {
                    if (portfoliotitle.is(':checked')) {
                        title = ' title="false"';
                    } else {
                        title = ' title="true"';
                    }
                }
                if (portfolio_cat == null) {
                    portfolio_cat = "";
                }
                if (portfolio_cat != "") {
                    cat = ' cat="' + portfolio_cat + '"';
                } else {
                    cat = ' cat=""';
                }
                if (portfolio_limit != "") {
                    limit = ' limit="' + portfolio_limit + '"';
                } else {
                    limit = '';
                }
                if (portfolio_sidebar.is('.iva-button')) {
                    if (portfolio_sidebar.is(':checked')) {
                        sidebar = ' sidebar="false"';
                    } else {
                        sidebar = ' sidebar="true"';
                    }
                }
                if (portfoliopagination.is('.iva-button')) {
                    if (portfoliopagination.is(':checked')) {
                        pagination = ' pagination="false"';
                    } else {
                        pagination = ' pagination="true"';
                    }
                }
                sortable = ' sortable="true"';

                return '[portfolio' + columns + cat + title + limit + pagination + sidebar + sortable + ']';
                break;
            }

            break;
            // B L O G 
            //--------------------------------------------------------
        case 'blog':
            var blog_cat = jQuery('[name="blog_cat[]"]').val();
            var blog_max = jQuery('[name="blog_limit"]').val();
            var blogpagination = jQuery('[name="blog_pagination"]');
            var postmeta = jQuery('[name="blog_postmeta"]');
            if (blogpagination.is('.iva-button')) {
                if (blogpagination.is(':checked')) {
                    pagination = ' pagination="true"';
                } else {
                    pagination = ' pagination="false"';
                }
            }
            if (postmeta.is('.iva-button')) {
                if (postmeta.is(':checked')) {
                    postmeta = ' postmeta="true"';
                } else {
                    postmeta = ' postmeta="false"';
                }
            }
			if( blog_cat  == null ) {
				blog_cat = '';
			}
            if (blog_cat != "") {
                cat = ' cat="' + blog_cat + '"';
            } else {
                cat = '';
            }
            if (blog_max != "") {
                max = ' limit="' + blog_max + '"';
            } else {
                max = '';
            }

            return '[blog' + cat + max + pagination + postmeta + ']';
            break;

             // P R O G R E S S B A R
        case 'progressbar':
			var animation 		= jQuery('[name="progressbar_animation"]').val();
			var progress_width 	= jQuery('[name="progressbar_percentage"]').val();
			var progresstitle 	= jQuery('[name="progressbar_title"]').val();
			var progress_color 	= jQuery('[name="progressbar_color"]').val();

			if (progress_width != '') {
				progress = ' progress="' + progress_width + '"';
			} else {
				progress = '';
			}
			if (progresstitle != '') {
				title = ' title="' + progresstitle + '"';
			} else {
				title = '';
			}
			if (progress_color != '') {
				color = ' color="' + progress_color + '"';
			} else {
				color = '';
			}
						
			return '\n[progressbar' +  progress + color + title + ']\n';
			break;
			
            // P R O G R E S S C I R C L E
            //---------------------------------------------------------
       case 'progresscircle':			
			var pcirclecount = jQuery('[name="progresscircle_pcirclecolumns"]').val();
			var animation = jQuery('[name="progresscircle_animation"]').val();
			if (animation != '') {
				animation = ' animation="' + animation + '"';
			} 
			var outputs = '[progresscircle ' + animation + ']\n';
			for (var i = 1; i <= pcirclecount; i++) {
				outputs += '[progress title="Content" percent="50" color="#9f5bb4"  trackcolor="#eeeeee"  size="110" linewidth="10"]Text[/progress]\n';
			}
			outputs += '[/progresscircle]';

			return outputs;
			break;

			// C O U N T D O W N
            //---------------------------------------------------------
		case 'countdown':
			var cd_title   	= jQuery('[name="countdown_cd_text"]').val();
			var cd_year    	= jQuery('[name="countdown_cd_year"]').val();
			var cd_month   	= jQuery('[name="countdown_cd_month"]').val();
			var cd_day     	= jQuery('[name="countdown_cd_day"]').val();
			var cd_hour    	= jQuery('[name="countdown_cd_hour"]').val();
			var cd_minute  	= jQuery('[name="countdown_cd_minute"]').val();
			
			var cd_class	= jQuery('[name="countdown_cd_class"]').val();
			
			
			if ( cd_title != '' ) {
				title = ' title="' + cd_title + '"';
			}else {
                title = '';
            }
			if ( cd_year ) {
				year = ' year="' + cd_year + '"';
			} 
			
			if ( cd_month ) {
				month = ' month="' + cd_month + '"';
			} 
			
			if ( cd_day ) {
				day = ' day="' + cd_day + '"';
			}
			
			if ( cd_hour ) {
				hour = ' hour="' + cd_hour + '"';
			}
			
			if ( cd_minute ) {
				minute = ' minute="' + cd_minute + '"';
			}
			
		
			if ( cd_class ) {
				cd_class = ' class="' + cd_class + '"';
			}
			
			return '\n[countdown' + title + year + month + day + hour  + minute +  cd_class +']\n';
			break;
			
            // S T A F F
            //-------------------------------------------------------
        case 'staff':
            var staff_photo = jQuery("[name=staff_photo]").val();
			var animation = jQuery('[name="staff_animation"]').val();
            var staff_title = jQuery('[name="staff_title"]').val();
            var staff_role = jQuery('[name="staff_role"]').val();
            var staff_content = jQuery('[name="staff_content"]').val();
            var arr = ['blogger', 'delicious', 'digg', 'facebook', 'flickr', 'forrst', 'google', 'linkedin', 'pinterest', 'skype', 'stumbleupon', 'twitter', 'dribbble', 'yahoo', 'youtube'];
            jQuery.each(arr, function (key, value) {
                if (jQuery('[name="staff_' + value + '"]').val() !== 'undefined' && jQuery('[name="staff_' + value + '"]').val() !== '') {
                    jQuery('#atp-sociables-result').val(jQuery('#atp-sociables-result').val() + ' ' + value + '="' + jQuery('[name="staff_' + value + '"]').val() + '"');
                }
            });
            jQuery('#atp-sociables-result').val(jQuery('#atp-sociables-result').val());
            var staff_sociables = jQuery('#atp-sociables-result').val();
            if (staff_photo != '') {
                photo = ' photo="' + staff_photo + '"';
            } else {
                photo = '';
            }
            if (staff_title != '') {
                title = ' title="' + staff_title + '"';
            } else {
                title = '';
            }
            if (staff_role != '') {
                role = ' role="' + staff_role + '"';
            } else {
                role = '';
            }
            if (staff_content !== '') {
                content = '' + staff_content + '';
            } else {
                content = '';
            }
			if (animation !== '') {
				animation = ' animation="' + animation + '"';
			}			
            jQuery('#atp-sociables-result').val('');

            return '[staff' + animation + photo + title + role + staff_sociables + ']' + content + '[/staff]\n';
            break;
       
        	// T E S T I M O N I A L  C A R O U S E L  
			//--------------------------------------------------------				
		case 'testimonials':
			var tm_select_type					= jQuery('#testimonials_tm_select').val();
			var testimonials_cat				= jQuery('[name="testimonials_category[]"]').val();
			var testimonials_limit				= jQuery('[name="testimonials_limit"]').val();
			var testimonials_speed				= jQuery('[name="testimonials_speed"]').val();
			var testimonials_itemslimit			= jQuery('[name="testimonials_itemslimit"]').val();
			var testimonials_gridcolumns		= jQuery('[name="testimonials_gridcolumns"]').val();
			var tm_pagination 					= jQuery('[name="testimonials_pagination"]');
		  
			if (tm_select_type != "") {
				style = ' style="' + tm_select_type + '"';
			} else {
				style = '';
			}
		
			if ( testimonials_cat == null ) {
				testimonials_cat = "";
			}
		   
			
			if (testimonials_cat != "") {
				cat = ' cat="' + testimonials_cat + '"';
			} else {
				cat = '';
			}
		   
			if (testimonials_speed != "") {
				speed = ' speed="' + testimonials_speed + '"';
			} else {
				speed = '';
			}
			
			if (testimonials_limit != "") {
				limit = ' limit="' + testimonials_limit + '"';
			} else {
				limit = '';
			}
			
			if (testimonials_itemslimit != "") {
				itemslimit = ' itemslimit="' + testimonials_itemslimit + '"';
			} else {
				itemslimit = '';
			}

			if (testimonials_gridcolumns != "") {
				gridcolumns = ' gridcolumns="' + testimonials_gridcolumns + '"';
			} else {
				gridcolumns = '';
			}
			
			if (tm_pagination.is('.iva-button')) {
				if (tm_pagination.is(':checked')) {
					pagination = ' pagination="true"';
				} else {
					pagination = ' pagination="false"';
				}
			}
		
			if ( tm_select_type == 'list') {
				return '[testimonials' + style + cat + limit + pagination +']';
			}else if( tm_select_type == 'fade_tm') {
				return '[testimonials' + style + cat + limit + speed + ']';
			}else if( tm_select_type == 'carousel') {
				return '[testimonials' + style + cat + limit + itemslimit + ']';
			}else if( tm_select_type == 'grid') {
				return '[testimonials' + style + cat + limit + gridcolumns + ']';
			}
			break;	
	
         // C A R O U S E L  S L I D E R  
		//--------------------------------------------------------
		case 'blog_carousel':
			var carouselslider_cat 		 = jQuery('[name="blog_carousel_cat[]"]').val();
			var carouselslider_max 		 = jQuery('[name="blog_carousel_limit"]').val();
			var carouselslider_cat_items = jQuery('[name="blog_carousel_items"]').val();

			if ( carouselslider_cat == null ){
				carouselslider_cat = '';
			}
			if( carouselslider_cat !='' ){
				cat = ' cat="'+ carouselslider_cat + '"';	
			}else{	cat = ' cat=""';}
			
			if( carouselslider_max !='' ){
				max = ' limit="'+ carouselslider_max + '"';
			}else{ max = '';}
			
			if( carouselslider_cat_items !=='' ){
				items = ' items="'+carouselslider_cat_items+'"';
			}else{	items = '';}

			return '[blog_carousel' + cat + max + items + ']';
			break;

		// LOGO SHOWCASE  
		//--------------------------------------------------------					
		case 'logosshowcase':			
			var logos_cat 			= jQuery('[name="logosshowcase_cat[]"]').val();
            var logocarousel_limit 	= jQuery('[name="logosshowcase_limit"]').val();
			var items_display		= jQuery('[name="logosshowcase_items_display"]').val();
			var logo_title 			= jQuery('[name="logosshowcase_title"]');
			var logocarousel_speed 	= jQuery('[name="logosshowcase_speed"]').val();
				
			if (logo_title.is('.iva-button')) {
				if (logo_title.is(':checked')) {
					title = ' title="true"';
				} else {
					title = ' title="false"';
				}
			}
			
		    if (logos_cat == null) {
                logos_cat = "";
            }
			if (logocarousel_limit != "") {
                max = ' limit="' + logocarousel_limit + '"';
            } else {
                max = '';
            }
			if (logos_cat != "") {
                cat = ' categories="' + logos_cat + '"';
            } else {
                cat = ' categories=""';
            }
			  
			if (items_display != "") {
                items = ' items="' + items_display + '"';
            } else {
               items = '';
            }
            return '[logos_showcase' + cat + max + title + items +']';
            break;
			
        // E V E N T C A R O U S E L
		//--------------------------------------------------------
        case 'eventcarousel':
            var events_cat = jQuery('[name="eventcarousel_cat[]"]').val();
            var eventstitle = jQuery('[name="eventcarousel_title"]').val();
            var events_max = jQuery('[name="eventcarousel_limit"]').val();
            if (events_cat == null) {
                events_cat = "";
            }
            if (events_max != "") {
                max = ' limit="' + events_max + '"';
            } else {
                max = '';
            }
            if (events_cat != "") {
                cat = ' cat="' + events_cat + '"';
            } else {
                cat = ' cat=""';
            }
            if (eventstitle != "") {
                title = ' title="' + eventstitle + '"';
            } else {
                title = "";
            }

            return '[event_carousel' + cat + title + max + ']';
            break;

		// T E A S E R   B O X 
		//--------------------------------------------------------
		case 'calloutbox':
			var btn_style = jQuery('#calloutbox_callout_button_style').val();
			var animation 	= jQuery('[name="calloutbox_animation"]').val();
			var bgcolor 	= jQuery('[name="calloutbox_bgcolor"]').val();
			var buttonlink 	= jQuery('[name="calloutbox_buttonlink"]').val();
			var linktarget 	= jQuery('[name="calloutbox_linktarget"]');
			var btn_flatcolor = jQuery('[name="calloutbox_btn_color"]').val();
			var btn_bordercolor = jQuery('[name="calloutbox_border_colors"]').val();
			var buttonsize 	= jQuery('[name="calloutbox_buttonsize"]').val();
			var buttontext 	= jQuery('[name="calloutbox_buttontext"]').val();
			var fullwidth 	= jQuery('[name="calloutbox_full_width"]').val();
			var buttontext 	= jQuery('[name="calloutbox_buttontext"]').val();
			
			var textcolor = jQuery('[name="calloutbox_textcolor"]').val();
			var text = jQuery('[name="calloutbox_text"]').val();

			if (animation !== '') {
				animation = ' animation="' + animation + '"';
			}				
			if (buttonlink !== '') {
				buttonlink = ' buttonlink="' + buttonlink + '"';
			}
			
			if (linktarget.is(':checked')) {
				linktarget = ' linktarget="true"';
			} else {
				linktarget = ' linktarget="false"';
			}
		
			if (buttontext !== '') {
				buttontext = ' buttontext="' + buttontext + '"';
			}
			if (bgcolor !== '') {
				bgcolor = ' bgcolor="' + bgcolor + '"';
			}
			if (textcolor !== '') {
				textcolor = ' textcolor="' + textcolor + '"';
			}
			if (buttonsize !== '') {
				buttonsize = ' buttonsize="' + buttonsize + '"';
			}
			if (fullwidth !== '') {
				fullwidth = ' fullwidth="' + fullwidth + '"';
			}
			if (btn_flatcolor !== '') {
				btn_flatcolor = ' btn_color="' + btn_flatcolor + '"';
			}
			if (btn_bordercolor !== '') {
				btn_bordercolor = ' btn_border="' + btn_bordercolor + '"';
			}
			if (text !== '') {
				text = '' + text + '';
			}
			
			if(btn_style == 'flat'){
				return '\n[calloutbox' + bgcolor + textcolor + buttonlink + linktarget +  buttontext + buttonsize + fullwidth + btn_flatcolor + animation + ']' + text + '[/calloutbox]\n';
			}else if(btn_style == 'border'){
				return '\n[calloutbox' + bgcolor + textcolor + buttonlink + linktarget + buttontext + buttonsize + fullwidth + btn_bordercolor + animation +']' + text + '[/calloutbox]\n';
			
			}
			break; 	
			
			// M E S S A G E   B O X 
			//--------------------------------------------------------
		case 'messagebox':
			var note   		= jQuery('[name="messagebox_note"]').val();
			var text 		= jQuery('[name="messagebox_text"]').val();
			var msg_type 	= jQuery('[name="messagebox_msgtype"]').val();
			var size 		= jQuery('[name="messagebox_size"]').val();
			var border 		= jQuery('[name="messagebox_border"]').val();
			var bgcolor 	= jQuery('[name="messagebox_boxbgcolor"]').val();
			var text_color 	= jQuery('[name="messagebox_txtcolor"]').val();
			var messagetype = jQuery('#messagebox_msgtype').val();
			var close_box 	= jQuery('[name="messagebox_close"]');

			if ( close_box.is('.iva-button') ) {
				if (close_box.is(':checked')) {
					close_box = ' close="true"';
				} else {
					close_box = '';
				}
			}
			if ( text !== '' ) {
				text = '' + text + '';
			}

			if ( note !== '' ) {
				note = ' note="' + note + '"';
			}
			if ( size !== '' ) {
				size = ' size="' + size + '"';
			}
			if ( msg_type !== '' ) {
				msg_type = ' msg_type="' + msg_type + '"';
			}
			if ( border !== '' ) {
				border = ' border="' + border + '"';
			}
			
			if ( bgcolor !='' ){
				bgcolor =  ' bgcolor="' + bgcolor + '"';
			}
			if ( text_color !='' ){
				text_color =  ' text_color="' + text_color + '"';
			}

		   if ( messagetype == 'custom' ) {
				return '\n[message' + note + size + msg_type + border + bgcolor + text_color + close_box + ']\n' + text + '\n[/message]';
			}else{
				return '\n[message' + note + size + msg_type + border +  close_box + ']\n' + text + '\n[/message]';
			}
			break;
			
			 // P R O C E S S  I C O N
            //--------------------------------------------------------
		case 'processsteps':

		
			var process_step 		= jQuery('[name="processsteps_step"]').val();
			var color 			= jQuery('[name="processsteps_color"]').val();
			if(process_step ==''){
				process_step =3;
			}
			
			if( process_step )  { 
		  		steps = ' steps="' + process_step + '"';
		  	}
		  	
		  	if( color ){
		  		color = ' color="' + color + '"';
		  	}
			
	  		var outputs = '[process-steps' + steps +']\n';
	  	
			
	  		for ( var i = 1; i <= process_step; i++ ) {
				outputs += '[step' +  color  +' icon="fa-leaf"]<strong>Title</strong> Description [/step]\n';
			}
			outputs += '[/process-steps]';
			return outputs;	
			break;
			
			
            // F E A T U R E B O X
            //--------------------------------------------------------
        case 'featurebox':
            var imagesrc = jQuery('[name="featurebox_image"]').val();
            var text = jQuery('[name="featurebox_text"]').val();
            var color = jQuery('[name="featurebox_color"]').val();
            if (text !== '') {
                text = '' + text + '';
            }
            if (color !== '') {
                color = ' bgcolor="' + color + '"';
            }
            if (imagesrc !== '') {
                imagesrc = ' image="' + imagesrc + '"';
            }

            return '\n[featurebox' + color + imagesrc + ']\n' + text + '\n[/featurebox]\n';
            break;
			
            // S O U N D   C L O U D M A W K S T A R T
            //--------------------------------------------------------
        case 'soundcloud':
            var width 		= jQuery('[name="soundcloud_width"]').val();
            var height 		= jQuery('[name="soundcloud_height"]').val();
            var type 		= jQuery('[name="soundcloud_type"]').val();
            var show_art 	= jQuery('[name="soundcloud_show_art"]');
            var color 		= jQuery('[name="soundcloud_color"]').val();
            var audio_id 	= jQuery('[name="soundcloud_audio_id"]').val();
            var autoplay 	= jQuery('[name="soundcloud_autoplay"]');
            if (width != '') {
                width = ' width="' + width + '"';
            }
            if (height != '') {
                height = ' height="' + height + '"';
            }
            if (type != '') {
                type = ' type="' + type + '"';
            }
            if (color != '') {
                color = ' color="' + color + '"';
            }
            if (audio_id != '') {
                audio_id = ' audio_id="' + audio_id + '"';
            }
            if (autoplay.is('.iva-button')) {
                if (autoplay.is(':checked')) {
                    autoplay = ' autoplay="true"';
                } else {
                    autoplay = ' autoplay="false"';
                }
            }
            if (show_art.is('.iva-button')) {
                if (show_art.is(':checked')) {
                    show_art = ' show_art="true"';
                } else {
                    show_art = ' show_art="false"';
                }
            }

            return '\n[soundcloud' + type + width + height + audio_id + autoplay + color + show_art + ']\n';
            break;
			
			// P R I C I N G  T A B L E
			//--------------------------------------------------------
		case 'pricing':
			var pt = jQuery('[name="pricing_price"]').val();
				
			var outputs = '[pricingcolumns]\n';
			for (var i = 1; i <= pt; i++) {

				outputs += '[col title="Title Here" headingbgcolor="" headingcolor="" textcolor="" price="" ]Content Here[/col]\n';
			}
			outputs += '[/pricingcolumns]';

			return outputs;
			break;
			
			// Services Box
			//--------------------------------------------------------
		case 'services_box':
			var title 		= jQuery('[name="services_box_title"]').val();
			var sb_content	= jQuery('[name="services_box_sb_content"]').val();
			var bg_color	= jQuery('[name="services_box_bg_color"]').val();
			var text_color	= jQuery('[name="services_box_text_color"]').val();
			var btn_text	= jQuery('[name="services_box_btn_text"]').val();
			var btn_color	= jQuery('[name="services_box_btn_color"]').val();
			var margin_top	= jQuery('[name="services_box_margin_top"]').val();
			
			if ( title !== '') {
				title = ' title=" ' + title + '"';
			}		
			if ( sb_content !== '') {
				sb_content = ' sb_content=" ' + sb_content + '"';
			}
			if ( bg_color !== '') {
				bg_color = ' bg_color=" ' + bg_color + '"';
			}
			if ( text_color !== '') {
				text_color = ' text_color=" ' + text_color + '"';
			}
			
			if ( btn_text !== '') {
				btn_text = ' btn_text=" ' + btn_text + '"';
			}
			if ( btn_color !== '') {
				btn_color = ' btn_color=" ' + btn_color + '"';
			}
			
			if ( margin_top !== '') {
				margin_top = ' margin_top=" ' + margin_top + '"';
			}
			return '\n[services_box' + title + sb_content + btn_text + btn_color + bg_color + text_color + margin_top +'][/services_box]\n';
			break;		
			
		default:
			return extra();	
       
        }
    },
    sendToEditor: function () {
        send_to_editor(shortcode.generate());
    }
}

jQuery(document).ready(function () {
    jQuery('.staff_delete').on("click", function () {
        jQuery(this).closest('tr').hide();
        e.preventDefault();
    });
    shortcode.init();
    jQuery("select[name=staff_selectsociable]").on('change', function (e) {
        jQuery('#secondary_staff table').find("." + this.value).show();
        e.preventDefault();
    });

	//List Style
	 jQuery("#styledlist_liststyle").on('change',function (){
		jQuery('.circle').hide();
		var styledlist_liststyle = jQuery('#styledlist_liststyle option:selected').val();
		if( styledlist_liststyle !=''){
			jQuery("."+styledlist_liststyle).show();
		}
	}).change();
	
	//Fancy Heading
	 jQuery("#fancyheading_heading_style").on('change',function (){
		jQuery('.border_heading').hide();
		var fancy_heading_select = jQuery('#fancyheading_heading_style option:selected').val();
		if( fancy_heading_select == 'border_heading'){
			jQuery("."+fancy_heading_select).show();
		}
	}).change();
	
	//Callout Box
	jQuery("#calloutbox_callout_button_style").change( function () {
		jQuery('.callout_button').hide();
		var call_select = jQuery('#calloutbox_callout_button_style option:selected').val();
		if( call_select != ''){
			jQuery("."+call_select).show();
		}
	}).change();

		
	//Testimonial Select
	jQuery("#testimonials_tm_select").change( function () {
	jQuery('tr.showtestimonials').hide();
		var tm_select = jQuery('#testimonials_tm_select option:selected').val();
		if( tm_select!=''){
			jQuery('.'+tm_select).show();
		}
	}).change();


	//fancy box
	jQuery("tr.fancy_box_custom").hide();
	jQuery("tr.fancy_box").hide();
	jQuery("#fancybox_box_ribbon").click(function () {
		if(jQuery(this).is(':checked') == false){
			jQuery("tr.fancy_box").hide();
		}else{
			jQuery("tr.fancy_box").show();
			jQuery("tr.fancy_box_custom").hide();
			jQuery("#fancybox_rib_color").change(function () {
				var selected_divider = jQuery("#fancybox_rib_color option:selected").val();
				jQuery("tr.fancy_box_custom").hide();
				if(selected_divider == 'custom'){
					jQuery("tr.fancy_box_custom").show();
				}
			});
		}
	});

	 // Iconbox Shortcode
	 jQuery("#iconbox_style").change(function () {
	  jQuery(".iconbox").hide();
	  var selected_iconbox = jQuery("#iconbox_style option:selected").val();
	  if(selected_iconbox){
	   jQuery("tr."+selected_iconbox).show();
	  }
	 }).change();

	// Dropcap Shortcode
	jQuery("#dropcap_type").change(function () {
		jQuery(".iva-dropcap").hide();
		var selected_dropcap = jQuery("#dropcap_type option:selected").val();
		if(selected_dropcap){
			jQuery("tr."+selected_dropcap).show();
		}
	}).change();
	
	//Message box
	jQuery("#messagebox_msgtype").change(function () {
		jQuery(".custom").hide();
		var selected_messagebox = jQuery("#messagebox_msgtype option:selected").val();
		if(selected_messagebox == 'custom'){
			jQuery("tr."+selected_messagebox).show();
		}
	}).change();
	
	//Highlight
	jQuery("#highlight_type").change( function () {
	jQuery('tr.highlight').hide();
		var tm_select = jQuery('#highlight_type option:selected').val();
		if( tm_select != ''){
			jQuery("tr."+tm_select).show();
		}
	}).change();
	
	
	
	//Button
	jQuery("#button_btn-style").change(function () {
		jQuery(".button_style").hide();
		var selected_button = jQuery("#button_btn-style option:selected").val();
		if(selected_button == 'flat'){
			jQuery(".flat").show();
			jQuery(".border").hide();
			jQuery("#button_btn-color").change(function(){
				var selected_but_color = jQuery("#button_btn-color option:selected").val();
				if( selected_but_color == 'custom' ){
					jQuery(".btn_custom").show();
				}else{
					jQuery(".btn_custom").hide();
				}
			}).change();
			//jQuery("."+selected_button).show();
		}
		else if(selected_button == 'border'){
			jQuery(".flat").hide();
			jQuery(".border").show();
		}
	}).change();
});