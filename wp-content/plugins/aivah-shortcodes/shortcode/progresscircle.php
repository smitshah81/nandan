<?php
	// EASY PIE CHART
 if( !function_exists('iva_sc_easypiecharts')){
	function iva_sc_easypiecharts( $atts, $content = null ){
		extract(shortcode_atts(array(
			'percent'		=> '',
			'title'			=> '',
			'color'			=> '',
			'trackcolor'	=>'',
			'size'			=> '',
			'linewidth'		=> '',
		), $atts));
		
		$count = 0;
		$percentage = (int)$percent;
		$datacolor = ( $color !== '' ) ? ' data-bar-color="'.$color.'"' : '' ;
		$datasize = ( $size !== '' ) ? ' data-size="'.$size.'"' : '' ;
		$datawidth = ( $linewidth !== '' ) ? ' data-line-width="'.$linewidth.'"' : '' ;
		$trackcolor = ( $trackcolor !== '' ) ? ' data-track-color="'.$trackcolor.'"' : '' ;
		$datapercentage = ( $percentage !== '' ) ? ' data-percent="'.$percentage.'"' : '' ;

		$out = 	'<div class="chart">';
		$out .= '<div data-percent="'.$percentage.'" class="CircleBar" '.$datacolor.' '.$datasize.' '.$datawidth.' '.$datapercentage.' '.$trackcolor.'>';
		if( $content !='' ){
			$out .= '<span>'.do_shortcode($content).'</span>';
			}else{
				$out .= '<span>'.$percent.'%</span>';
			}
		$out .= '</div>';
		$out .= '<div class="label">'.$title.'</div>';
		$out .=	'</div>';
		return $out;
	}
	add_shortcode('progress', 'iva_sc_easypiecharts');
 }
	

 if( !function_exists('iva_sc_progresscircle_script')){
	function iva_sc_progresscircle_script() {
		wp_print_scripts( 'atp-progresscircle' );
		wp_print_scripts( 'atp-excanvas' );

		//$size='400';
		echo '<script type="text/javascript">
			jQuery(document).ready(function() {
				jQuery(".CircleBar").each(function () {
					jQuery(this).appear(function() {
							jQuery(this).easyPieChart({
								barColor: function(percent) {
									percent /= 100;
									return "rgb(" + Math.round(255 * (1-percent)) + ", " + Math.round(255 * percent) + ", 0)";
			                    },
								animate: 4000,	
								scaleColor: false,
								lineCap: "butt",
								rotate: 0
		
							});
				},{accX: 0, accY: -150});
				});
			});
		</script>';
	}
 }
  if( !function_exists('iva_sc_easypiechart')){
	function iva_sc_easypiechart( $atts, $content = null ) {
		extract(shortcode_atts(array(
					'animation'	=> '',
					'color'	=> ''
		), $atts));
		
		add_action('wp_footer', 'iva_sc_progresscircle_script');
	
		// Animation Effects
		//--------------------------------------------------------					
		
		$out = '<div  class="CircleBarWrap  iva_anim '.$animation.'">'. do_shortcode($content) . '</div><div style="clear:both;"></div>';
		return $out;
	}
	add_shortcode('progresscircle', 'iva_sc_easypiechart');
}
	
?>