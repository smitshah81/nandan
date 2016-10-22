<?php

/*
 * Add-on Name: Location for Visual Composer
 */

if ( !class_exists( 'iva_business_hours_holidays' ) )
{
	class iva_business_hours_holidays
	{

		// Constructor
		function __construct()
		{
			add_action( 'init', array( $this, 'iva_bhrs_holidays_init' ) );
			add_shortcode( 'iva_bhrs_holidays', array( $this, 'iva_bhrs_holidays_shortcode' )  );
		}
		
		// Initialize the location function
		function iva_bhrs_holidays_init()
		{
			if ( function_exists( 'vc_map' ) )
			{
				// VC Map
				vc_map(
					array(
					   "name" => __( "Holidays", "iva_business_hours" ),
					   "base" => "iva_bhrs_holidays",
					   "class" => "",
					   "icon" => "",
					   "category" => "Aivah VC Addons",
					   "description" => __( "Holidays", "iva_business_hours"),
					   "params" => array(
							array(
								"type"			 => "textfield",
								"class" 		 => "",
								"heading" 		 => __( "Title", "iva_business_hours" ),
								"param_name" 	 => "title",
								"value" 		 => "",
								"description" 	 => __( "Enter title", "iva_business_hours" ),
							),
						),
					)
				);
			}
		}
		// Shortcode handler function for Location
		function iva_bhrs_holidays_shortcode($atts)
		{			
			extract(shortcode_atts(
			array(
				'title'	=> '',
			), $atts));
			
			$out ='';//stores the output
		
			// Fetch Data
			global $wpdb;
		
			$iva_bhrs_holidays  = get_option('iva_bh_holidays')?get_option('iva_bh_holidays') : '';
			$iva_bh_date_format = get_option('iva_bh_date_format')?get_option('iva_bh_date_format'):'Y/m/d';
			
			if( $iva_bh_hd_title !='' ) { $out .= $iva_bh_hd_title;	}

			if( !empty( $iva_bhrs_holidays )){
			
				$iva_bh_hd_data = json_decode( $iva_bhrs_holidays );
				foreach ( $iva_bh_hd_data as $key => $value ) {
					$name 			= isset( $value->name ) ? strip_tags( $value->name ):'';
					$start 			= isset( $value->start )? @date( $iva_bh_date_format, $value->start  ):'';
					$end 			= isset( $value->end )? @date( $iva_bh_date_format, $value->end ):'';
					$desc 			= isset( $value->desc )? stripslashes( $value->desc ) :'';
					$desc_disable 	= isset( $value->desc_disable ) ? $value->desc_disable : '';
					
					if( $desc_disable != 'on' ){
					
						$out .= '<div class="ivabh-hd-hours"><p>';
						$out .= '<span class="days ">' .$name.'</span>';
						if( $start === $end ) {
							$out .= '<span class="hours ">'.$start.'</span>';
						}else{
							$out .= '<span class="hours ">'.$start.' - '.$end .'</span>';
						}
						$out .= '<small>'.$desc.'</small>';
						$out .= '</p></div>';
					}
				}
			}
			
			return $out; 			
		}
	}
}
if(class_exists('iva_business_hours_holidays'))
{
	$iva_business_hours_holidays = new iva_business_hours_holidays;
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_iva_bhrs_holidays extends WPBakeryShortCode {
    }
}