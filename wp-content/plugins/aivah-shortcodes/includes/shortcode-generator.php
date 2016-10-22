<?php 
//  shortcodes  generator
add_action('admin_footer','iva_shortcodes');
function iva_shortcodes(){
	
	global $iva_sc_obj;

	/**
	 * sociable icons array.
	 */
	$staff_social = array(
		'' => 'Select Sociable',
		'blogger'       => 'Blogger',
		'delicious'     => 'Delicious',
		'digg'          => 'Digg',
		'facebook'      => 'Facebook',
		'flickr'        => 'Flickr',
		'forrst'        => 'Forrst',
		'google'        => 'Goolge',
		'linkedin'      => 'Linkedin',
		'pinterest'     => 'Pinterest',
		'skype'         => 'Skype',
		'stumbleupon'   => 'Stumbleupon',
		'twitter'       => 'Twitter',
		'dribbble'      => 'Dribbble',
		'yahoo'         => 'Yahoo',
		'youtube'       => 'Youtube',
		'instagram'		=> 'instagram'
	);
	ksort( $staff_social );//sort alphabetical order.

	/**
	 * animation effects array.
	 */
	$iva_anim = array(
		''  			=> 'Select Animation',
		'fadeIn'		=>	'fadeIn',
		'fadeInLeft'	=> 	'fadeInLeft',
		'fadeInRight'	=>	'fadeInRight',
		'fadeInUp'      =>  'fadeInUp',
		'fadeInDown'    =>  'fadeInDown'
	);


// Background Position
	$bg_position = array(
		'left_top'		=> 'Left Top',
		'left_center'	=> 'Left Center',
		'left_bottom'	=> 'Left Bottom',
		'right_top'		=> 'Right Top',
		'right_center'	=> 'Right Center',
		'right_bottom'	=> 'Right Bottom',
		'center top'	=> 'Center Top',
		'center_center'	=> 'Center Center',
		'center_bottom'	=> 'Center Bottom'
	);

	$aivah_shortcodes['Column Layouts'] = array(
		'name'		=> __('Column Layouts','aivah_shortcodes'),
		'value'		=>'Layouts',
		'subtype'	=> true,
		'options'	=> array(
			// L A Y O U T (1/2 - 1/2)
			//--------------------------------------------------------
			array(
				'name'		=> __('1/2 + 1/2','aivah_shortcodes'),
				'value'		=>'one_half_layout',
				'options'	=> array(
					
				)
			),
			// L A Y O U T (1/3 -1/3)
			//--------------------------------------------------------
			array(
				'name'		=> __('1/3 + 1/3 + 1/3','aivah_shortcodes'),
				'value'		=> 'one_third_layout',
				'options'	=> array(
					
				)
			),
			// L A Y O U T (1/4 -1/4 - 1/4 - 1/4)
			//--------------------------------------------------------
			array( 
				'name'		=> __('1/4 + 1/4 + 1/4 + 1/4','aivah_shortcodes'),
				'value'		=> 'one_fourth_layout',
				'options'	=> array(
					
				)
			),
			// L A Y O U T (1/5 - 1/5 - 1/5 - 1/5 - 1/5 - 1/5)
			//--------------------------------------------------------
			array( 
				'name'		=> __('1/5 + 1/5 + 1/5 + 1/5 + 1/5','aivah_shortcodes'),
				'value'		=> 'one5thlayout',
				'options'	=> array(
					
				)
			),
			// L A Y O U T (1/6 - 1/6 - 1/6 - 1/6 - 1/6 - 1/6)
			//--------------------------------------------------------
			array( 
				'name'		=> __('1/6 + 1/6 + 1/6 + 1/6 + 1/6 + 1/6','aivah_shortcodes'),
				'value'		=> 'one6thlayout',
				'options'	=> array(
					
				)
			),
			// L A Y O U T (1/3 -2/3)
			//--------------------------------------------------------
			array( 
				'name'		=> __('1/3 + 2/3','aivah_shortcodes'),
				'value'		=> 'one_3rd_2rd',
				'options'	=> array(
					
				)
			),
			// L A Y O U T (2/3 -1/3)
			//--------------------------------------------------------
			array( 
				'name'		=> __('2/3 + 1/3','aivah_shortcodes'),
				'value'		=> 'two_3rd_1rd',
				'options'	=> array(
					
				)
			),
			// L A Y O U T  (1/4 -3/4)
			//--------------------------------------------------------
			array( 
				'name'		=> __('1/4 + 3/4','aivah_shortcodes'),
				'value'		=> 'One_4th_Three_4th',
				'options'	=> array(
					
				)
			),
			// L A Y O U T (3/4 -1/4)
			//--------------------------------------------------------
			array( 
				'name'		=> __('3/4 + 1/4','aivah_shortcodes'),
				'value'		=> 'Three_4th_One_4th',
				'options'	=> array(
					
				)
			),
			// L A Y O U T (1/4 - 1/4 - 1/2)
			//--------------------------------------------------------
			array( 
				'name'		=> __('1/4 + 1/4 + 1/2','aivah_shortcodes'),
				'value'		=> 'One_4th_One_4th_One_half',
				'options'	=> array(
					
				)
			),
			// L A Y O U T  (1/2 - 1/4 - 1/4)
			//--------------------------------------------------------
			array( 
				'name'		=> __('1/2 + 1/4 + 1/4','aivah_shortcodes'),
				'value'		=> 'One_half_One_4th_One_4th',
				'options'	=> array(
					
				)
			),
			// L A Y O U T  (1/4 - 1/2 - 1/4)
			//--------------------------------------------------------
			array( 
				'name'		=> __('1/4 + 1/2 + 1/4','aivah_shortcodes'),
				'value'		=> 'One_4th_One_half_One_4th',
				'options'	=> array(
					
				)
			),
			// L A Y O U T (1/5 - 4/5)
			//--------------------------------------------------------
			array( 
				'name'		=> __('1/5 + 4/5','aivah_shortcodes'),
				'value'		=> 'One_5th_Four_5th',
				'options'	=> array(
					
				)
			),
			// L A Y O U T (4/5 - 1/5)
			//--------------------------------------------------------
			array( 
				'name'		=> __('4/5 + 1/5','aivah_shortcodes'),
				'value'		=> 'Four_5th_One_5th',
				'options'	=> array(
					
				)
			),
			// L A Y O U T (2/5 - 3/5)
			//--------------------------------------------------------
			array( 
				'name'		=> __('2/5 + 3/5','aivah_shortcodes'),
				'value'		=> 'Two_5th_Three_5th',
				'options'	=> array(
					
				)
			),
			// L A Y O U T (3/5 - 2/5)
			//--------------------------------------------------------
			array( 
				'name'		=> __('3/5 + 2/5','aivah_shortcodes'),
				'value'		=> 'Three_5th_Two_5th',
				'options'	=> array(
					
				)
			),
		),
	);
	// E N D   - Column Layouts
	
	// B L O C K Q U O T E 
    //--------------------------------------------------------
    $aivah_shortcodes['Block Quotes'] = array(
        'name' => __('Block Quotes', 'aivah_shortcodes'),
        'value' => 'blockquote',
        'options' => array(
            array(
				'name'	=> __('Content','aivah_shortcodes'),
				'desc'	=> 'Type the text you wish to display as a blockquote.',
				'id'	=> 'content',
				'std'	=> '',
				'type'	=> 'textarea'
			),
			array(
				'name'	=> __('Align','aivah_shortcodes'),
				'desc'	=> 'Select the alignment for your blockquote.',
				'info'	=> '(optional)',
				'id'	=> 'align',
				'std'	=> '',
				'options'=> array(
								'left'		=> 'Left',
								'right'		=> 'Right',
								'center'	=> 'Center',
							),
				'type' => 'radio',
			),
			array(
				'name'	=> __('Cite','aivah_shortcodes'),
				'desc'	=> 'Type the name of the author which displays at the end of the blockquote.',
				'info'	=> '(optional)',
				'id'	=> 'cite',
				'std'	=> '',
				'type'	=> 'text',
				'inputsize'=>'53',
				),
			array(
				'name'	=> __('Cite Link','aivah_shortcodes'),
				'desc'	=> 'The link displays after the Citation.',
				'info'	=> '(optional)',
				'id'	=> 'citelink',
				'std'	=> '',
				'type'	=> 'text',
				'inputsize'=>'53',
			),
			array(
				'name'	=> __('Width','aivah_shortcodes'),
				'desc'	=> 'Type the width in % or px, if you wish to use the blockquote in a specific width.',
				'info'	=> '(optional)',
				'id'	=> 'width',
				'std'	=> '',
				'type'	=> 'text',
				'inputsize'=>'53',
				),

			array(
				'name' 		=> __('Background Color','aivah_shortcodes'),
				'desc'  	=> '',
				'info'   	=> '(Optional)',
				'id'  		=> 'background_color',
				'class'  	=> '',
				'std'  		=> '',
				'type'  	=> 'color',
				'inputsize' => '',
			),
			array(
				'name' 		=> __('Text Color','aivah_shortcodes'),
				'desc'  	=> '',
				'info'   	=> '(Optional)',
				'id'  		=> 'text_color',
				'class'  	=> '',
				'std'  		=> '',
				'type'  	=> 'color',
				'inputsize' => '',
			),
			array(
				'name'		=> __('Animations', 'aivah_shortcodes'),
				'desc' 		=> 'Select an animation effect for the element',
				'info' 		=> '(Optional)',
				'id' 		=> 'animation',
				'std' 		=> '',
				'type' 		=> 'select',
				'options' 	=> $iva_anim
			),
        )
    );
	// E N D   - Block Quotes
	
	// D R O P  C A P
    //--------------------------------------------------------
	$aivah_shortcodes['Drop Cap']= array(
        'name' 		=> __('Drop Cap', 'aivah_shortcodes'),
        'value' 	=> 'dropcap',
        'options' 	=> array(
            array(
				'name'	=> __('Dropcap Type','aivah_shortcodes'),
				'desc'	=> 'Use Predefined Color for the Dropcap Background',
				'info'	=> '(optional)',
				'id'	=> 'type',
				'std'	=> '',
				'options'	=> array(
								'dropcap1'	=> 'Drop cap 1',
								'dropcap2'	=> 'Drop cap 2',
								'dropcap3'	=> 'Drop cap 3',
								
				),
				'type' => 'select',
			),
			array(
				'name'	=> __('DropCap Text','aivah_shortcodes'),
				'desc'	=> 'Type the letter you want to display as Dropcap',
				'id'	=> 'text',
				'std'	=> '',
				'type'	=> 'text',
				'inputsize'=> '30',
			),
			
			array(
				'name'	=> __('DropCap BG Color','aivah_shortcodes'),
				'desc'	=> 'Use Colorpicker to choose your desired color for the DropCap Background',
				'id'	=> 'bgcolor',
				'info'	=> '(optional)',
				'std'	=> '',
				'class' => 'iva-dropcap dropcap1 dropcap2',
				'type'	=> 'color',
			),
			array(
				'name'	=> __('DropCap Text Color','aivah_shortcodes'),
				'desc'	=> 'Use Colorpicker to choose your desired color for the DropCap Text',
				'id'	=> 'textcolor',
				'info'	=> '(optional)',
				'std'	=> '',
				'class' => 'iva-dropcap dropcap1 dropcap2 dropcap3',
				'type'	=> 'color',
			),		
        )
    );
    // E N D   - Drop Cap
	
    // G O O G L E   F O N T
    //--------------------------------------------------------
	 $aivah_shortcodes['Google Font'] = array(
		'name'		=> __('Google Font','aivah_shortcodes'),
		'value'		=> 'googlefont',
		'options'	=> array (
			array(
				'name'	=> __('Google Font Name','aivah_shortcodes'),
				'desc'	=> __('Type the font you want to display.','aivah_shortcodes'),
				'id'	=> 'font',
				'std'	=> '',
				'type'	=> 'text',
				'inputsize'=> '53',
			),
			array(
				'name'	=> __('Google Font Size','aivah_shortcodes'),
				'desc'	=> __('Type the font size in px.','aivah_shortcodes'),
				'id'	=> 'size',
				'std'	=> '',
				'type'	=> 'text',
				'inputsize'=> '53',
			),
			array(
				'name'	=> __('Font Margin','aivah_shortcodes'),
				'desc'	=> __('Type the font margin in px.','aivah_shortcodes'),
				'id'	=> 'margin',
				'std'	=> '',
				'type'	=> 'text',
				'inputsize'=> '53',
			),
			array(
				'name'	=> __('Font weight','aivah_shortcodes'),
				'desc'	=> __('Type the font weight (optional).','aivah_shortcodes'),
				'id'	=> 'weight',
				'std'	=> '',
				'type'	=> 'text',
				'inputsize'=> '53',
			),
			array(
				'name'	=> __('Font style','aivah_shortcodes'),
				'desc'	=> __('Check this if u want to display in Italic.','aivah_shortcodes'),
				'id'	=> 'font_style',
				'std'	=> '',
				'type'	=> 'checkbox',
				'inputsize'=> '53',
			),
			array(
				'name'	=> __('Font extend','aivah_shortcodes'),
				'desc'	=> __('Type the font extendibility (optional).','aivah_shortcodes'),
				'id'	=> 'extend',
				'std'	=> '',
				'type'	=> 'text',
				'inputsize'=> '53',
			),
			array(
				'name'	=> __('Content Here','aivah_shortcodes'),
				'desc'	=> __('Type the text you wish to display .','aivah_shortcodes'),
				'id'	=> 'text',
				'std'	=> '',
				'type'	=> 'textarea',
			),
			array(
				'name'	=> __('Color','aivah_shortcodes'),
				'desc'	=> __('Choose the color you wish to display .','aivah_shortcodes'),
				'id'	=> 'color',
				'std'	=> '',
				'type'	=> 'color',
			),
		)
	);
	// E N D   - Google Font
	
	// F O N T  A W E S O M E I C O N S
	//--------------------------------------------------------
	$aivah_shortcodes['Font Awesome Icons'] = array(
		'name'		=> __('Font Awesome Icons','aivah_shortcodes'),
		'value'		=> 'icons',
		'options'	=> array(
			array(
			'name'	=> __('Fontawesome Icon','aivah_shortcodes'),
			'desc'  => 'Go to Example http://fortawesome.github.io/Font-Awesome/examples/',
			'id'	=> 'icon',
			'std'	=> '',
			'type'	=> 'text'
			),
			array(
				'name' 	=> __('Color','aivah_shortcodes'),
				'desc'	=> 'Select the color variation',
				'info'	=> '(optional)',
				'id' 	=> 'color',
				'std' 	=> '',
				'type' 	=> 'color',
			),
			array(
				'name'	=> __('Select Icon Size','aivah_shortcodes'),
				'desc'	=> 'Choose the size of the icon.',
				'info'	=> '(optional)',
				'id'	=> 'size',
				'std'	=> '',
				'options'=> array(
					''			=> 'Choose one...',
					'14px'		=> '14px',
					'28px'      => '28px',
					'38px'      => '38px',
					'56px'      => '56px',
					'112px'     => '112px',
					'140px'     => '140px',
					'280px'     => '280px',
					),
				'type'	=> 'select',
			),			
		)
	);
	// E N D   - Font Awesome Icons
	
	// I C O N
	//--------------------------------------------------------
	$aivah_shortcodes['Icon Box'] = array(
		'name'		=> __('Icon Box','aivah_shortcodes'),
		'value'		=> 'iconbox',
		'options'	=> array(
			array(
				'name'		=> __( 'Style Type','aivah_shortcodes'),
				'desc'  	=> '',
				'id'		=> 'style',
				'std'		=> '',
				'options'	=> array(
								''			=> 'Choose one...',
								'style1'	=> 'Style1',
								'style2'	=> 'Style2',
								'style3'	=> 'Style3',
								'style4'	=> 'Style4',
							),
				'type'	=> 'select',
			),	

			array(
				'name'	=> __('Add Font Awesome Icon Name','aivah_shortcodes'),
				'desc'  => 'Go to Example http://fortawesome.github.io/Font-Awesome/examples/',
				'id'	=> 'icon',
				'std'	=> '',
				'class' => 'iconbox style1 style2 style3 style4',
				'type'	=> 'text',
			),	
			array(
				'name'	=> __('Align','aivah_shortcodes'),
				'desc'	=> 'Select the alignment for Icon.',
				'info'	=> '(optional)',
				'id'	=> 'align',
				'std'	=> '',
				'class' => 'iconbox style1 style3 style4',
				'options'=> array(
							''			=> 'Choose one...',
							'left'		=> 'Left',
							'right'		=> 'Right',
							'center'	=> 'Center',
							),
				'type' => 'select',
			),
			
			array(
				'name'	=> __('icon Color','aivah_shortcodes'),
				'desc'	=> 'Choose Icon Color',
				'id'	=> 'icon_color',
				'std'	=> '',
				'class' => 'iconbox style1 style4',
				'type'	=> 'color',
			),
			array(
				'name'	=> __('Default Color','aivah_shortcodes'),
				'desc'	=> 'Choose Icon Color',
				'id'	=> 'def_icon_color',
				'std'	=> '',
				'class' => 'iconbox style2 style3',
				'options' => array(
					''			=> 'Choose one...',
					'gray'		=> 'Gray',
					'brown'		=> 'Brown',
					'cyan'		=> 'Cyan',
					'orange'	=> 'Orange',
					'red'		=> 'Red',
					'magenta'	=> 'Magenta',
					'yellow'	=> 'Yellow',
					'blue'		=> 'Blue',
					'pink'		=> 'Pink',
					'green'		=> 'Green',
					'black'		=> 'Black',
					'white'		=> 'White'
				),
				'type'	=> 'select',
			),
			array(
				'name'	=> __('Title','aivah_shortcodes'),
				'desc'	=> 'Type the title you wish to display for the service',
				'id'	=> 'title',
				'std'	=> '',
				'class' => 'iconbox style1 style2 style3 style4',
				'type'	=> 'text',
			),				
			array(
				'name'	=> __('Content','aivah_shortcodes'),
				'desc'	=> 'Type the content you wish to display for the service',
				'id'	=> 'text',
				'std'	=> '',
				'class' => 'iconbox style1 style2 style3 style4',
				'type'	=> 'textarea',
			),
					
		)
	);
	// E N D   - Icon Box

	// S E R V I C E S
	//--------------------------------------------------------
	$aivah_shortcodes['Services'] = array(
		'name'		=> __('Services','aivah_shortcodes'),
		'value'		=> 'services',
		'options'	=> array(
			array(
				'name'	=> __('Upload Image','aivah_shortcodes'),
				'desc'	=> 'Image / Icon to represent the services box',
				'id'	=> 'image',
				'std'	=> '',
				'type'	=> 'upload',
			),	
			array(
				'name'	=> __('Title','aivah_shortcodes'),
				'desc'	=> 'Type the title you wish to display for the service',
				'id'	=> 'title',
				'std'	=> '',
				'type'	=> 'text',
			),
			array(
				'name'	=> __('Link','aivah_shortcodes'),
				'desc'	=> 'Type the title you wish to display for the service',
				'id'	=> 'link',
				'std'	=> '',
				'type'	=> 'text',
			),
	
			array(
				'name'    => __('Animations', 'aivah_shortcodes'),
				'desc'    => 'Select an animation effect for the element.',
				'info'    => '(Optional)',
				'id'      => 'animation',
				'std'     => '',
				'type'    => 'select',
				'options' => $iva_anim
			),					
		)
	);
	// E N D  - SERVICES




	// S T Y L E D   L I S T S 
	//--------------------------------------------------------
    $aivah_shortcodes['List'] = array(
        'name' => __('List', 'aivah_shortcodes'),
        'value' => 'styledlist',
        'options' => array(
            array(
				'name'	=> __('Font Awesome Icon','aivah_shortcodes'),
				'desc'  => 'Go to Example http://fortawesome.github.io/Font-Awesome/examples/',
				'id'	=> 'icon',
				'std'	=> '',
				'type'	=> 'text'
			),
		
			
			array(
				'name' 	=> __('List Style', 'aivah_shortcodes'),
				'desc' 	=> 'Select the list styles',
				'id' 	=> 'liststyle',
				'std' 	=> '',
				'type' 	=> 'select',
				'options' => array(
					'default' => 'Default',
					'circle'  => 'Circle'
				)
			),

			array(
				'name'		=> __('Icon Color','aivah_shortcodes'),
				'desc'		=> 'Choose Icon Color',
				'id'		=> 'color',
				'std'		=> '',
				'class'	=> 'default',
				'type'	=> 'color',
			),

			array(
				'name'		=> __('Icon bgColor','aivah_shortcodes'),
				'desc'		=> 'Choose Icon bgColor',
				'id'		=> 'circle_bg',
				'std'		=> '',
				'class'		=> 'circle',
				'type'		=> 'color',
			),

			array(
				'name'	=> __('Content','aivah_shortcodes'),
				'desc'	=> 'For List Items use HTML Elements ex:List item1(press enter)',
				'id'	=> 'content',
				'std'	=> '',
				'type'	=> 'textarea'
			),
        )
    );
	// E N D   - List
	
	// B U T T O N
	//--------------------------------------------------------
	 $aivah_shortcodes['Button'] =  array(
		'name' => __('Button', 'aivah_shortcodes'),
		'value' => 'button',
		'options' => array(
			array(
				'name' 	=> __('Button Style', 'aivah_shortcodes'),
				'desc' 	=> 'Select the button Style',
				'id' 	=> 'btn-style',
				'std' 	=> '',
				'type' 	=> 'select',
				'options' => array(
					'' 		=> 'Choose Style...',
					'flat' 	=> 'Flat',
					'border'=> 'Border'
				)
			),
			array(
				'name' => __('Button Size', 'aivah_shortcodes'),
				'desc' => 'Select the button size',
				'id' => 'btn-size',
				'std' => '',
				'type' => 'select',
				
				'options' => array(
					'' => 'Choose one...',
					'small' => 'Small',
					'medium'=> 'Medium',
					'large'	=> 'Large'
				)
			),
			 array(
				'name' 	=> __('Defualt Colors', 'aivah_shortcodes'),
				'desc' 	=> 'Select the color variation',
				'info' 	=> '(Optional)',
				'id' 	=> 'btn-color',
				'std' 	=> '',
				'class'	=> 'button_style flat',
				'options' => array(
					''			=> 'Choose one...',
					'gray'		=> 'Gray',
					'brown'		=> 'Brown',
					'cyan'		=> 'Cyan',
					'orange'	=> 'Orange',
					'red'		=> 'Red',
					'magenta'	=> 'Magenta',
					'yellow'	=> 'Yellow',
					'blue'		=> 'Blue',
					'pink'		=> 'Pink',
					'green'		=> 'Green',
					'black'		=> 'Black',
					'white'		=> 'White',
					'custom'    => 'custom',
								),
				'type' => 'select'
			),
			array(
				'name' 	=> __('Default Colors', 'aivah_shortcodes'),
				'desc' 	=> 'Select the color variation',
				'info'	=> '(Optional)',
				'id' 	=> 'btn-border-color',
				'std' 	=> '',
				'class'	=> 'button_style border',
				'options' => array(
					''		=> 'Choose one...',
					'light'	=> 'Light',
					'dark'	=> 'Dark',
					
								),
				'type' => 'select'
			),
			
			array(
				'name'	=> __('BG Color', 'aivah_shortcodes'),
				'desc' 	=> 'Button background color default state',
				'info' 	=> '(Optional)',
				'id' 	=> 'btn-bgcolor',
				'std' 	=> '',
				'class'	=> 'button_style flat btn_custom',
				'type' 	=> 'color'
			),
			array(
				'name' 	=> __('Hover BG Color', 'aivah_shortcodes'),
				'desc' 	=> 'Button background color on hover state',
				'info' 	=> '(Optional)',
				'id' 	=> 'btn-hoverbgcolor',
				'std' 	=> '',
				'class'	=> 'button_style flat btn_custom',
				'type' 	=> 'color'
			),
			array(
				'name' 	=> __('Text Color', 'aivah_shortcodes'),
				'desc' 	=> 'Button Text color default state',
				'info' 	=> '(Optional)',
				'id' 	=> 'btn-textcolor',
				'std' 	=> '',
				'class'	=> 'button_style flat btn_custom',
				'type' 	=> 'color'
			),
			array(
				'name' 	=> __('Hover Text Color', 'aivah_shortcodes'),
				'desc' 	=> 'Button Text color on hover state',
				'info' 	=> '(Optional)',
				'id' 	=> 'btn-hovertextcolor',
				'std' 	=> '',
				'class'	=> 'button_style flat btn_custom',
				'type' 	=> 'color'
			),
			array(
				'name' 		=> __('Button Text', 'aivah_shortcodes'),
				'desc' 		=> 'Type the text you wish to display for button',
				'id' 		=> 'btn-text',
				'std' 		=> '',
				'type' 		=> 'text',
				'class'		=> '',	
				'inputsize' => '53'
			),
			array(
				'name' 		=> __('Button Icon', 'aivah_shortcodes'),
				'desc' 		=> '',
				'info' 		=> '(Optional)',
				'id' 		=> 'btn-icon',
				'std' 		=> '',
				'type' 		=> 'text',
				'class'		=> '',	
				'inputsize' => '53'
			),
			array(
				'name' 		=> __('ID', 'aivah_shortcodes'),
				'info' 		=> '(Optional)',
				'id' 		=> 'btn-id',
				'std' 		=> '',
				'type' 		=> 'text',
				'inputsize' => '53'
			),
			array(
				'name' 		=> __('Class', 'aivah_shortcodes'),
				'info' 		=> '(Optional)',
				'id' 		=> 'btn-subclass',
				'std' 		=> '',
				'type' 		=> 'text',
				'inputsize' => '53'
			),
			array(
				'name' 		=> __('Link URL', 'aivah_shortcodes'),
				'id' 		=> 'btn-link',
				'std' 		=> '',
				'type' 		=> 'text',
				'inputsize' => '53'
			),
		
			array(
				'name' 	=> __('Link Target ', 'aivah_shortcodes'),
				'desc' 	=> 'Choose option when reader clicks on the link.',
				'info' 	=> '(Optional)',
				'id' 	=> 'btn-linktarget',
				'std' 	=> '',
				'type' => 'checkbox'
			),
			array(
				'name' 	=> __('Lightbox', 'aivah_shortcodes'),
				'desc' 	=> 'Check this if you wish to display button Lightbox.',
				'info' 	=> '(Optional)',
				'id' 	=> 'btn-lightbox',
				'std' 	=> '',
				'type' 	=> 'checkbox'
			),
		   
			array(
				'name' 	=> __('Align', 'aivah_shortcodes'),
				'desc' 	=> 'Select the alignment for a button',
				'info' 	=> '(Optional)',
				'id' 	=> 'btn-align',
				'std' 	=> '',
				'options' => array(
					'' 		=> 'Choose one...',
					'left' 	=> 'Left',
					'right' => 'Right',
					'center'=> 'Center'
				),
				'type' => 'select'
			),
			array(
				'name' 	=> __('Full Width', 'aivah_shortcodes'),
				'desc' 	=> 'Check this if you wish to display button in full width and uncheck if you wish to use specific width below.',
				'info' 	=> '(Optional)',
				'id' 	=> 'btn-fullwidth',
				'std' 	=> '',
				'type' 	=> 'checkbox'
			),
			array(
				'name' 		=> __('Button Width', 'aivah_shortcodes'),
				'desc' 		=> 'Use px as units for width, do not leave only integers.',
				'info' 		=> '(Optional)',
				'id' 		=> 'btn-width',
				'std' 		=> '',
				'type' 		=> 'text',
				'inputsize' => '53'
			),
			
		)
	);
	// E N D   - Button
	
	// C A L L O U T  B O X
	//--------------------------------------------------------
		$aivah_shortcodes['Callout Box'] = array(
			'name'		=> __('Callout Box','aivah_shortcodes'),
			'value'		=> 'calloutbox',
			'options'	=> array(
				array(
					'name'	=> __('BG Color','aivah_shortcodes'),
					'desc'	=> 'Choose the color for background',
					'info'	=> '(Optional)',
					'id'	=> 'bgcolor',
					'std'	=> '',
					'type' => 'color',
				),

				array(
					'name'	=> __('Text Color','aivah_shortcodes'),
					'desc'	=> 'Choose the color for text',
					'info'	=> '(Optional)',
					'id'	=> 'textcolor',
					'std'	=> '',
					'type' => 'color',
				),
				array(
					'name'	=> __('Link URL','aivah_shortcodes'),
					'id'	=> 'buttonlink',
					'std'	=> '',
					'type'	=> 'text',
					'inputsize'=> '53',
				),
				array(
					'name'	=> __('Full Width ','aivah_shortcodes'),
					'desc'	=> '',
					'info'	=> '(Optional)',
					'id'	=> 'full_width',
					'std'	=> '',
					'options'=> array(
						''		=> 'Choose one...',
						'yes'	=> 'Yes',
						'no'	=> 'No',
					),
					'type'	=> 'select',
				),
				
				array(
					'name'	=> __('Button Style ','aivah_shortcodes'),
					'desc'	=> '',
					'info'	=> '(Optional)',
					'id'	=> 'callout_button_style',
					'std'	=> 'flat',
					'options'=> array(
						'flat'	=> 'Flat',
						'border'=> 'Border',
					),
					'type'	=> 'select',
				),
				
				array(
					'name' 	=> __('Defualt Colors', 'aivah_shortcodes'),
					'desc' 	=> 'Select the color variation',
					'info' 	=> '(Optional)',
					'id' 	=> 'btn_color',
					'std' 	=> '',
					'class'	=> 'callout_button flat',
					'options' => array(
						'gray'		=> 'Gray',
						'brown'		=> 'Brown',
						'cyan'		=> 'Cyan',
						'orange'	=> 'Orange',
						'red'		=> 'Red',
						'magenta'	=> 'Magenta',
						'yellow'	=> 'Yellow',
						'blue'		=> 'Blue',
						'pink'		=> 'Pink',
						'green'		=> 'Green',
						'black'		=> 'Black',
						'white'		=> 'White'),
					'type' => 'select'
				),
				array(
					'name' 	=> __('Defualt Colors', 'aivah_shortcodes'),
					'desc' 	=> 'Select the color variation',
					'info'	=> '(Optional)',
					'id' 	=> 'border_colors',
					'std' 	=> '',
					'class'	=> 'callout_button border',
					'options' => array(
						'light'	=> 'Light',
						'dark'	=> 'Dark',
						
					),
					'type' => 'select'
				),
				
				
				array(
					'name'	=> __('Link Target ','aivah_shortcodes'),
					'desc'	=> 'Choose option when reader clicks on the link.',
					'info'	=> '(Optional)',
					'id'	=> 'linktarget',
					'std'	=> '',
					'type'	=> 'checkbox',
				),
				
				array(
					'name'	=> __('Button Size','aivah_shortcodes'),
					'desc'	=> 'Select the button size',
					'id'	=> 'buttonsize',
					'std'	=> 'medium',
					'type'	=> 'select',
					'options'=> array(
							'small'	=> 'Small',
							'medium'=> 'Medium',
							'large'	=> 'Large',
					),
				),

				array(
					'name'	=> __('Button Text','aivah_shortcodes'),
					'desc'	=> 'Type the text you wish to display for button',
					'id'	=> 'buttontext',
					'std'	=> '',
					'type'	=> 'text',
					'inputsize'=> '53',
				),

				array(
					'name'	=> __('Callout Content','aivah_shortcodes'),
					'desc'	=> 'Type content you wish to display for Teaser Box',
					'id'	=> 'text',
					'std'	=> '',
					'type' => 'textarea',
				),

				array(
					'name' => __('Animations', 'aivah_shortcodes'),
					'desc' => 'Select an animation effect for the element',
					'info' => '(Optional)',
					'id' => 'animation',
					'std' => '',
					'type' => 'select',
					'options' => $iva_anim
				),							
			)
		);
		//End :Callout Box

    
      
	// D I V I D E R S
    //--------------------------------------------------------
    $aivah_shortcodes['Divider'] = array(
        'name' => __('Divider', 'aivah_shortcodes'),
        'value' => 'divider',
        'subtype' => true,
        'options' => array(
           	array(
				'name'		=> __('Clear Both','aivah_shortcodes'),
				'value'		=>'clear',
				'options'	=> array()
				),
			array( 
				'name'		=> __('Divider','aivah_shortcodes'),
				'value'		=>'divider',
				'options'	=> array(
					array(
						'name'	=> __('Style:','aivah_shortcodes'),
						'desc'	=> 'Select the Style for your Divider.',
						'id'	=> 'dividertype',
						'std'	=> '',
						'options'=> array(
							'thin'		=> 'Thin Divider',
							'fat'		=> 'Fat Divider',
							'dotted'	=> 'Dotted Divider',
							'dashed'	=> 'Dashed Divider',
						),
						'type' => 'select',
					),
					array(
						'name'	=> __('Margin:','aivah_shortcodes'),
						'desc'	=> 'Enter margin property using px.',
						'id'	=> 'margin',
						'info'	=> '(optional)',
						'std'	=> '',
						'type'	=> 'text',
						'inputsize'	=> '33',
					),
					array(
						'name'	=> __('Border Color:','aivah_shortcodes'),
						'desc'	=> 'Select the border color',
						'id'	=> 'bordercolor',
						'info'	=> '(optional)',
						'std'	=> '',
						'type'	=> 'color',
					),
				)
			), 
			array(
				'name'		=> __('Demo Space','aivah_shortcodes'),
				'value'		=>'demo_space',
				'options'	=> array(
					array(
						'name'	=> __('Height','aivah_shortcodes'),
						'desc'	=> 'Enter integer value for demo space',
						'id'	=> 'height',
						'std'	=> '',
						'type'	=> 'text',
						'inputsize'	=> '33',
					),
				)
			),
			array(
				'name'		=> __('Custom Divider','aivah_shortcodes'),
				'value'		=>'custom_divider',
				'options'	=> array(
					array(
						'name'	=> __('Upload Image','aivah_shortcodes'),
						'desc'	=> 'Upload Image for the Divider.',
						'id'	=> 'dividerimg',
						'std'	=> '',
						'type'	=> 'upload',
						'inputsize'	=> '33',
					),
				)
			),
        )
    );
	// End - Dividers
	
	// A L E R T B O X E S  
	//--------------------------------------------------------
	 $aivah_shortcodes['Alert Boxes'] = array(
		'name'		=> __('Alert Boxes','aivah_shortcodes'),
		'value'		=> 'messagebox',
		'options'	=> array(
			array(
				'name'	=> __('Title','aivah_shortcodes'),
				'desc'	=> 'Type the title you wish to display for the message box',
				'id'	=> 'note',
				'std'	=> '',
				'type'	=> 'text',
			),
			array(
				'name'	=> __('Message Type','aivah_shortcodes'),
				'desc'	=> 'Choose the Message Box Type Error, Notice, Success etc',
				'id'	=> 'msgtype',
				'std'	=> '',
				'options'=> array(
					'error'		=> 'Error',
					'info'		=> 'Info',
					'alert'		=> 'Alert',
					'success'	=> 'Success',
					'lightgray'	=> 'Light Gray',
					'dark'		=> 'Dark',
					'custom'    => 'Custom'
				),
				'type' => 'select',
			),

			array(
				'name'	=> __('Background Color','aivah_shortcodes'),
				'desc'	=> 'Choose the color for background',
				'info'	=> '',
				'class' => 'boxbackgroundcolor custom',	
				'id'	=> 'boxbgcolor',
				'std'	=> '',
				'type'  => 'color'
			),

			array(
				'name'	=> __('Text Color','aivah_shortcodes'),
				'desc'	=> 'Choose the color for text',
				'info'	=> '',
				'class' => 'boxtxtcolor custom',
				'id'	=> 'txtcolor',
				'std'	=> '',
				'type' => 'color',
			),

			array(
				'name'	=> __('Message Text','aivah_shortcodes'),
				'desc'	=> 'Type the content you wish to display for the message box',
				'id'	=> 'text',
				'std'	=> '',
				'type'	=> 'textarea',
			),
			array(
				'name'	=> __('Border','aivah_shortcodes'),
				'desc'	=> 'Choose the Border Type Error, Notice, Success etc',
				'id'	=> 'border',
				'std'	=> '',
				'options'=> array(
					''		=> 'None',
					'solid'	=> 'Solid',
					'dashed'=> 'Dashed'
				),
				'type' => 'select',
			),
			array(
				'name'	=> __('Size','aivah_shortcodes'),
				'desc'	=> 'Choose the Border Type Error, Notice, Success etc',
				'id'	=> 'size',
				'std'	=> '',
				'options'=> array(
					'large'	=> 'Large',
					'normal'=> 'Normal'
				),
				'type' => 'select',
			),
			array(
				'name'	=> __('Close','aivah_shortcodes'),
				'desc'	=> 'If You checked close Button Display',
				'id'	=> 'close',
				'std'	=> '',
				'type'	=> 'checkbox',
			),
		)
	);

	// E N D  - messagebox
	
	// F A N C Y B O X
	//--------------------------------------------------------
	$aivah_shortcodes['Fancy Box'] = array(
		'name'		=> __('Fancy Box','aivah_shortcodes'),
		'value'		=> 'fancybox',
		'options'	=> array(
			array(
				'name'	=> __('Title','aivah_shortcodes'),
				'desc'	=> 'Type text you wish to display as Title for Fancy Box',
				'id'	=> 'title',
				'std'	=> '',
				'type'	=> 'text',
				'inputsize'	=> '33',
			),
			array(
				'name'	=> __('Box Content','aivah_shortcodes'),
				'desc'	=> 'Type content you wish to display for Fancy Box',
				'id'	=> 'text',
				'std'	=> '',
				'type' => 'textarea',
			),
			array(
				'name'	=> __('Title Color','aivah_shortcodes'),
				'desc'	=> 'Choose the color for title',
				'info'	=> '(Optional)',
				'id'	=> 'titlecolor',
				'std'	=> '',
				'type' => 'color',
			),
			array(
				'name'	=> __('Title BG Color','aivah_shortcodes'),
				'desc'	=> 'Choose the color for title background.',
				'info'	=> '(Optional)',
				'id'	=> 'titlebgcolor',
				'std'	=> '',
				'type' => 'color',
			),
			
			array(
				'name'	=> __('Content BG Color','aivah_shortcodes'),
				'desc'	=> 'Choose the color for Content Background.',
				'info'	=> '(Optional)',
				'id'	=> 'boxbgcolor',
				'std'	=> '',
				'type' => 'color',
			),
			array(
				'name'	=> __('Content Text Color','aivah_shortcodes'),
				'desc'	=> 'Choose the color for Content Background.',
				'info'	=> '(Optional)',
				'id'	=> 'boxtextcolor',
				'std'	=> '',
				'type' => 'color',
			),

			array(
				'name'	=> __('Corner Ribben','aivah_shortcodes'),
				'desc'	=> 'Choose the color for Box Background',
				'info'	=> '(Optional)',
				'id'	=> 'box_ribbon',
				'std'	=> '',
				'type'  => 'checkbox',
			),
			array(
				'name'	=> __('Ribbon Text','aivah_shortcodes'),
				'desc'	=> 'Choose the color for Box Background',
				'info'	=> '(Optional)',
				'id'	=> 'rib_text',
				'class' => 'fancy_box',
				'std'	=> '',
				'type'  => 'text',
			),
			array(
				'name'	=> __('Ribbon Color','aivah_shortcodes'),
				'desc'	=> 'Choose the color for Box Background',
				'info'	=> '(Optional)',
				'id'	=> 'rib_color',
				'class' => 'fancy_box',
				'std'	=> '',
				'options' => array(
					''			=> 'Choose one...',
					'gray'		=> 'Gray',
					'brown'		=> 'Brown',
					'cyan'		=> 'Cyan',
					'orange'	=> 'Orange',
					'red'		=> 'Red',
					'magenta'	=> 'Magenta',
					'yellow'	=> 'Yellow',
					'blue'		=> 'Blue',
					'pink'		=> 'Pink',
					'green'		=> 'Green',
					'black'		=> 'Black',
					'white'		=> 'White',
					'custom'    => 'Custom',
				),
				'type'  => 'select',
			),
			array(
				'name'	=> __('Ribbon Custom Color','aivah_shortcodes'),
				'desc'	=> 'Choose the color for Box Background',
				'info'	=> '(Optional)',
				'id'	=> 'rib_custom_color',
				'class' => 'fancy_box_custom',
				'std'	=> '',
				'type'  => 'color',
			),
			array(
				'name'	=> __('Ribbon Size','aivah_shortcodes'),
				'desc'	=> 'Choose the color for Box Background',
				'info'	=> '(Optional)',
				'id'	=> 'rib_size',
				'class' => 'fancy_box',
				'std'	=> '',
				'options'=> array(
					'small'	=> 'Small',
					'medium'=> 'Medium',
					'large'	=> 'Large',
				),
				'type'  => 'select',
			),
								
			array(
				'name' => __('Animations', 'aivah_shortcodes'),
				'desc' => 'Select an animation effect for the element',
				'info' => '(Optional)',
				'id' => 'animation',
				'std' => '',
				'type' => 'select',
				'options' => $iva_anim
			),		
		)
	);
	// E N D  - fancybox
	
		// P A R T I A L  S E C T I O N
	// ----------------------------------------------------- 
	$aivah_shortcodes['Partial Section'] = array(
	
		'name' 		=> __('Partial Section', 'aivah_shortcodes'),
		'value' 	=> 'partial_section',
		'options' 	=> array(
		
			array(
				'name'	=> __('Partail Section ','aivah_shortcodes'),
				'desc'	=> '',
				'info'	=> '(Optional)',
				'id'	=> 'align',
				'std'	=> '',
				'options'=> array(
					''		=> 'Choose one...',
					'left'	=> 'Left',
					'right' => 'Right',
				),
				'type'	=> 'select',
			),
	
			array(
				'name'	=> __('BG Image', 'aivah_shortcodes'),
				'desc'	=> 'Upload Image you want to display for the Section background.',
				'id'	=> 'bg_image',
				'class'	=> 'partial_section pleft',
				'std'	=> '',
				'type'	=> 'upload'
			),
   
			array(
				'name' 		=> __('Bg Attachment', 'aivah_shortcodes'),
				'desc' 		=> 'The background-attachment property .',
				'id' 		=> 'bg_attachment',
				'class'		=> 'partial_section pleft',
				'std' 		=> '',
				'options'	=> array( 				
									''			=> 'Select Option', 
									'fixed'		=> 'fixed',
									'scroll'	=> 'scroll'
								),
				'type' => 'select'
			),

			array(
				'name'		=> __('Bg Repeat', 'aivah_shortcodes'),
				'desc'		=> 'The Background Repeat .',
				'id'		=> 'bg_repeat',
				'class'		=> 'partial_section pleft',
				'std'		=> '',
				'options'	=> array(
									'repeat'	=> 'Repeat',
									'no-repeat'	=> 'No Repeat',
									'repeat-x'	=> 'Repeat X',
									'repeat-y'	=> 'Repeat Y'
									),
				'type' => 'select'
			),
			array(
				'name' 		=> __('Bg Position', 'aivah_shortcodes'),
				'desc' 		=> 'The Background Position .',
				'id' 		=> 'bg_position',
				'class'		=> 'partial_section pleft',
				'std' 		=> '',
				'options' 	=> array(
									'left top'			=> 'Left Top',
									'left center'		=> 'Left Center',
									'left bottom'		=> 'Left Bottom',
									'right top'			=> 'Right Top',
									'right center'		=> 'Right Center',
									'right bottom'		=> 'Right Bottom',
									'center top'		=> 'Center Top',
									'center center'		=> 'Center Center',
									'center bottom'		=> 'Center Bottom'
									),
				'type'		=> 'select'
			),
			
			array(
				'name' 		=> __('BG Color', 'aivah_shortcodes'),
				'desc' 		=> 'Choose the color you want to display for the Section background.',
				'id' 		=> 'bg_color',
				'class'		=> 'partial_section pleft',
				'std' 		=> '',
				'type'		=> 'color'
			),
			
			array(
				'name' 	=> __('Content', 'aivah_shortcodes'),
				'desc' 	=> '',
				'id' 	=> 'content',
				'class'	=> 'partial_section pleft',
				'std' 	=> '',
				'type' 	=> 'textarea'
			),
			
			array(
				'name' 		=> __('Content BG Color', 'aivah_shortcodes'),
				'desc' 		=> 'Choose the color you want to display for the Section background.',
				'id' 		=> 'content_bg_color',
				'class'		=> 'partial_section pleft',
				'std' 		=> '',
				'type'		=> 'color'
			),

			array(
				'name' 	=> __('Content Text Color', 'aivah_shortcodes'),
				'desc' 	=> 'Choose the color you want to display for the text.',
				'id' 	=> 'content_text_color',
				'class'	=> 'partial_section pleft',
				'std' 	=> '',
				'type' 	=> 'color'
			),
			
		)
	);
    
    // A C C O R D I O N
    //--------------------------------------------------------
    $aivah_shortcodes['Accordion'] = array(
        'name' => __('Accordion', 'aivah_shortcodes'),
        'value' => 'accordion',
        'options' => array(
            array(
				'name' 		=> __('Accordion Type', 'aivah_shortcodes'),
				'desc' 		=> 'Accordion Type.',	
				'id' 		=> 'accordion_type',
				'std' 		=> '',
				'type' 		=> 'select',
				'options' 	=> array(
					'normal' => 'Normal',
					'faq'    => 'FAQ'
				)
			),
			
			array(
				'name' 		=> __('Accordion Mode', 'aivah_shortcodes'),
				'desc' 		=> 'Accordion Mode.',
				'id' 		=> 'accordion_mode',
				'std' 		=> '',
				'type' 		=> 'select',
				'options' 	=> array(
					'toggle' 	=> 'Toggle',
					'accordion' => 'Accordion'
				)
			),
			array(
				'name' 	=> __('Accordion Limit', 'aivah_shortcodes'),
				'desc' 	=> 'Select howmany toggle rows you wish to display.',
				'id' 	=> 'accordion_col',
				'std' 	=> '',
				'type' 	=> 'select',
				'options' => array(
					'02' => 'Two Toggle',
					'03' => 'Three Toggle',
					'04' => 'Four Toggle'
				)
			),
			array(
				'name' 		=> __('Animations', 'aivah_shortcodes'),
				'desc' 		=> 'Select an animation effect for the element',
				'info' 		=> '(Effects)',
				'id' 		=> 'animation',
				'std' 		=> '',
				'type' 		=> 'select',
				'options' 	=> $iva_anim
			),	
        )
    );
    // End - Accordion

    // I M A G E
    //--------------------------------------------------------
    $aivah_shortcodes['Image'] = array(
        'name' => __('Image', 'aivah_shortcodes'),
        'value' => 'image',
        'options' => array(
            array(
                'name' 	=> __('Image URL', 'aivah_shortcodes'),
                'desc' 	=> 'Type the URL of the image from the media library that you wish to use.',
                'id' 	=> 'imagesrc',
                'std' 	=> '',
                'type' 	=> 'upload',
                'inputsize' => '53'
            ),
            array(
                'name' 	=> __('Title', 'aivah_shortcodes'),
                'desc' 	=> 'Enter the title attribute for the image',
                'id' 	=> 'title',
                'std' 	=> '',
                'type' 	=> 'text',
                'inputsize' => '53'
            ),
            array(
                'name' 	=> __('Caption', 'aivah_shortcodes'),
                'desc' 	=> 'Enter the caption text for the image',
                'info' 	=> '(Optional)',
                'id' 	=> 'caption',
                'std' 	=> '',
                'type' 	=> 'text',
                'inputsize' => '53'
            ),
			
			 array(
                'name' 	=> __('Tooltip Position', 'aivah_shortcodes'),
                'desc' 	=> '',
				'std' 	=> '',
                'id' 	=> 'tooltip_position',
                'type' 	=> 'select',
				'options' 		=> array(
                    'top' 		=> 'Top',
                    'bottom' 	=> 'Bottom',
                    'left'	 	=> 'Left',
                    'right' 	=> 'Right'
                ),
                'inputsize' => '53'
            ),
            array(
                'name' 	=> __('Class', 'aivah_shortcodes'),
                'desc' 	=> 'Add sub class for the image if you want to assign any new class for the image',
                'info' 	=> '(Optional)',
                'id' 	=> 'class',
                'std' 	=> '',
                'type' 	=> 'text',
                'inputsize' => '53'
            ),
            array(
                'name' 	=> __('Link URL', 'aivah_shortcodes'),
                'desc' 	=> 'Link url to the if you wish to link to any specific location when clicked on the image',
                'info' 	=> '(Optional)',
                'id' 	=> 'alink',
                'std' 	=> '',
                'type' 	=> 'text',
                'inputsize' => '53'
            ),
            array(
                'name' 	=> __('Link Target', 'aivah_shortcodes'),
                'desc' 	=> 'Choose option when reader clicks on the image linked.',
                'info' 	=> '(Optional)',
                'id' 	=> 'target',
                'std' 	=> '',
                'type' => 'checkbox'
            ),
            array(
                'name' 	=> __('Lightbox', 'aivah_shortcodes'),
                'desc' 	=> 'Check this if you wish to use Lightbox for the image',
                'info' 	=> '(Optional)',
                'id' 	=> 'lightbox',
                'std' 	=> '',
                'type' 	=> 'checkbox'
            ),
            array(
                'name' => __('Align', 'aivah_shortcodes'),
                'desc' => 'Select the alignment for your image.',
                'info' => '(Optional)',
                'id' => 'align',
                'std' => '',
                'options' => array(
                    '' => 'Choose one...',
                    'left' => 'Left',
                    'right' => 'Right',
                    'center' => 'Center'
                ),
                'type' => 'select'
            ),
            array(
                'name' => __('Width', 'aivah_shortcodes'),
                'desc' => 'Use px as units for width',
                'id' => 'width',
                'std' => '',
                'type' => 'text',
                'inputsize' => '53'
            ),
            array(
                'name' => __('Height', 'aivah_shortcodes'),
                'desc' => 'Use px as units for height',
                'id' => 'height',
                'std' => '',
                'type' => 'text',
                'inputsize' => '53'
            ),
			array(
				'name' => __('Animations', 'aivah_shortcodes'),
				'desc' => 'Select an animation effect for the element',
				'info' => '(Optional)',
				'id' => 'animation',
				'std' => '',
				'type' => 'select',
				'options' => $iva_anim
			)
            
        )
    );
	// End - Image
	
	// B L O G 
    //--------------------------------------------------------
    $aivah_shortcodes['Blog'] = array(
        'name' => __('Blog', 'aivah_shortcodes'),
        'value' => 'blog',
        'options' => array(
            array(
                'name' => __('Category', 'aivah_shortcodes'),
                'desc' => 'Hold Control/Command key to select multiple categories',
                'id' => 'cat',
                'std' => '',
                'options' => $iva_sc_obj->iva_variable('posts'),
                'type' => 'multiselect'
            ),
            array(
                'name' => __('Blog Posts Limit', 'aivah_shortcodes'),
                'desc' => 'Number of items to show per page',
                'id' => 'limit',
                'std' => '-1',
                'type' => 'text'
            ),
            array(
                'name' => __('Blog Post Meta', 'aivah_shortcodes'),
                'desc' => 'Check this if you wish to display  Post Meta for the blog.',
                'id' => 'postmeta',
                'std' => true,
                'type' => 'checkbox'
            ),
            array(
                'name' => __('Pagination', 'aivah_shortcodes'),
                'desc' => 'Check this if you wish to display pagination for the blog.',
                'id' => 'pagination',
                'std' => true,
                'type' => 'checkbox'
            )
        )
    );
    //  End - Blog
	


	// C A R O U S E L  S L I D E R 
	//--------------------------------------------------------
	$aivah_shortcodes['Blog Carousel'] = array(
		'name' 		=> __('Blog Carousel', 'aivah_shortcodes'),
		'value' 	=> 'blog_carousel',
		'desc' 		=> '',
		'inputsize' => '',
		'options' 	=> array(
				array(
					'name' 		=> __('Category', 'aivah_shortcodes'),
					'id' 		=> 'cat',
					'std' 		=> '',
					'desc' 		=> __('Hold Control/Command key to select multiple categories', 'aivah_shortcodes'),
					'options' 	=> $iva_sc_obj->iva_variable('posts'),
					'type' 		=> 'multiselect'
				),
				array(
					'name' 		=> __('Blog Posts Limit', 'aivah_shortcodes'),
					'desc' 		=> __('Number of posts to fetch from database.', 'aivah_shortcodes'),
					'id' 		=> 'limit',
					'std'		=> '4',
					'type' 		=> 'text'
				),
				array(
					'name' 		=> __('Carousel Items', 'aivah_shortcodes'),
					'desc' 		=> __('Number of Items to show per carousel', 'aivah_shortcodes'),
					'id' 		=> 'items',
					'std' 		=> '4',
					'type' 		=> 'text'
				),
			),
		);
    	// E N D   - Blog Carousel

		// LOGO  C A R O U S E L
		//--------------------------------------------------------
		$aivah_shortcodes['Logo Carousel'] = array(
			'name'		=> __('Logos Showcase','aivah_shortcodes'),
			'value'		=> 'logosshowcase',
			'options'	=> array(
				array(
					'name'		=> __('Category','aivah_shortcodes'),
					'desc'		=> 'Hold Control/Command key to select multiple categories',
					'info'		=> '(optional)',
					'id'		=> 'cat',
					'std'		=> '',
					'options'	=> $iva_sc_obj->iva_variable('logosc_categories'),
					'type'		=> 'multiselect',
					),
				array(
					'name'	=> __('Logo Limits','aivah_shortcodes'),
					'desc'	=> 'Number of logos to show as per post items',
					'id'	=> 'limit',
					'std'	=> '-1',
					'type'	=> 'text',
					),
				array(
					'name'	=> __('Logo Title','aivah_shortcodes'),
					'desc'	=> 'Check this if you wish to display title for the logo showcase.',
					'id'	=> 'title',			
					'std'	=> '',
					'type'	=> 'checkbox'
					),
				array(
					'name'	=> __('Carousel Speed','aivah_shortcodes'),
					'desc'	=> 'Carousel speed',
					'id'	=> 'speed',
					'std'	=> '3000',
					'type'	=> 'text',
					),
				array(
					'name'	=> __('Items display','aivah_shortcodes'),
					'desc'	=> 'Number of Items to show on carousel',
					'id'	=> 'items_display',
					'std'	=> '',
					'type'	=> 'text',
					),
			),
		);
	// E N D   - Logo Carousel
	
  	// H I G H L I G H T
	//--------------------------------------------------------
	$aivah_shortcodes['Highlight'] = array(
		'name' => __('Highlight', 'aivah_shortcodes'),
		'value' => 'highlight',
		'options' => array(
			array(
				'name'	=> __('Highlight Types ','aivah_shortcodes'),
				'desc'	=> 'Choose the color you want to display for the highlight background.',
				'id'	=> 'type',
				'std'	=> '',
				'options'	=> array(
					''           => 'Choose',
					'highlight1' => 'Highlight1',
					'highlight2' => 'Highlight2',
					),
				'type'	=> 'select',
			),
			array(
				'name'	=> __('Highlight BG Color','aivah_shortcodes'),
				'desc'	=> 'Choose the color you want to display for the highlight background.',
				'id'	=> 'bgcolor',
				'std'	=> '',
				'class' => 'highlight highlight1',
				'type'	=> 'color',
			),
			array(
				'name'	=> __('Highlight Text Color','aivah_shortcodes'),
				'desc'	=> 'Choose the color you want to display for the text.',
				'id'	=> 'textcolor',
				'std'	=> '',
				'class' => 'highlight highlight1 highlight2',
				'type'	=> 'color',
			),
			array(
				'name'	=> __('Highlight Text','aivah_shortcodes'),
				'desc'	=> 'Type the text you wish to display as highlight.',
				'id'	=> 'text',
				'std'	=> '',
				'class' => 'highlight highlight1 highlight2',
				'type'	=> 'textarea',
			),
		)
	);
	// E N D   - Highlight
	
	// F A N C Y   A M P E R S A N D 
	//--------------------------------------------------------
	$aivah_shortcodes['Fancy Ampersand'] = array(
		'name' => __('Fancy Ampersand', 'aivah_shortcodes'),
		'value' => 'fancy_ampersand',
		'options' => array(
			array(
				'name' => __('Ampersand Color', 'aivah_shortcodes'),
				'desc' => 'Choose the color you want to use for ampersand.',
				'id' => 'color',
				'std' => '',
				'type' => 'color'
			),
			array(
				'name' => __('Ampersand Size', 'aivah_shortcodes'),
				'desc' => 'Enter size you want display. Example: 24px',
				'id' => 'size',
				'std' => '',
				'type' => 'text',
				'inputsize' => '44'
			)
		)
	);
	// E N D   - Fancy Ampersand
	
	// F A N C Y   H E A D I N G 
	//--------------------------------------------------------
	$aivah_shortcodes['Fancy Heading'] = array(
		'name' 		=> __('Fancy Heading', 'aivah_shortcodes'),
		'value' 	=> 'fancyheading',
		'options' 	=> array(
			array(
				'name'	=> __('Heading Size','aivah_shortcodes'),
				'desc'	=> 'Choose the heading size you wish to use.',
				'id'	=> 'heading',
				'std'	=> '',
				'options' => array('' => 'Choose Heading Size','h1' => 'h1','h2' => 'h2','h3' => 'h3','h4' => 'h4','h5' => 'h5','h6' => 'h6','large' => 'large','xlarge' => 'xlarge'), 
				'type'	=> 'select',
			),
			array(
				'name'	=> __('Heading Text Color','aivah_shortcodes'),
				'desc'	=> 'Choose the text color you wish to use.',
				'info'	=> '(optional)',
				'id'	=> 'textcolor',
				'std'	=> '',
				'type'	=> 'color',
			),
			
			array(
				'name'	=> __('Heading Align','aivah_shortcodes'),
				'desc'	=> 'Choose the Heading alignment you wish to display.',
				'info'	=> '(optional)',
				'id'	=> 'align',
				'std'	=> '',
				'options' => array( ''=> 'Choose one...', 'textleft' => 'Left','textright' => 'Right','textcenter' => 'Center'), 
				'type'	=> 'select',
			),
			
			array(
				'name'		=> __('Heading style','js_composer'),
				'desc'		=> 'Choose the Heading style you wish to display.',
				'info'		=> '(optional)',
				'id'		=> 'heading_style',
				'std'		=> '',
				'options' 	=> array( 'normal_heading' => 'Normal Heading','border_heading' => 'Border Heading'), 
				'type'		=> 'select',
			),
			
			array(
				'name'		=> __('Border Width','js_composer'),
				'desc'		=> '',
				'info'		=> '(optional)',
				'id'		=> 'border_width',
				'std'		=> '',
				'class'     => 'border_heading',
				'type'		=> 'text',
			),
			
			array(
				'name'		=> __('Border styles','js_composer'),
				'desc'		=> '',
				'info'		=> '(optional)',
				'id'		=> 'border_style',
				'std'		=> '',
				'class'     => 'border_heading',
				'options' 	=> array( 'solid' => 'Solid','dotted' => 'Dotted','dashed' => 'Dashed','double' => 'Double','groove' => 'Groove','ridge' => 'Ridge','inset' => 'Inset','outset'=> 'Outlet' ), 
				'type'		=> 'select',
			),
			
			array(
				'name'		=> __('Border Color','js_composer'),
				'desc'		=> '',
				'info'		=> '(optional)',
				'id'		=> 'border_color',
				'std'		=> '',
				'class'     => 'border_heading',
				'type'		=> 'color',
			),
			
			array(
				'name'	=> __('Heading Text','aivah_shortcodes'),
				'desc'	=> 'Type the text you wish to use for Heading.',
				'id'	=> 'text',
				'std'	=> '',
				'type'	=> 'text',
			),
			array(
				'name'	=> __('Heading Description','aivah_shortcodes'),
				'desc'	=> 'Type the text you wish to use for Heading.',
				'id'	=> 'description',
				'std'	=> '',
				'type'	=> 'textarea',
			),

			array(
				'name'	=> __('Margin Bottom','aivah_shortcodes'),
				'desc'	=> 'Enter Marign without px.',
				'info'	=> '(optional)',
				'id'	=> 'marginbottom',
				'std'	=> '',
				'type'	=> 'text',
			),
			
		)
	);
	// E N D   - Fancy Heading

	// P R O G R E S S B A R
	//--------------------------------------------------------
	 $aivah_shortcodes['Progressbar'] = array(
		'name'		=> __('Progress Bar','aivah_shortcodes'),
		'value'		=> 'progressbar',
		'options'	=> array(
			array(
				'name'	=> __('Percentage','aivah_shortcodes'),
				'desc'	=> 'Enter the percentage for the progress bar.',
				'id'	=> 'percentage',
				'std'	=> '',
				'type'	=> 'text',
				'inputsize'	=> '53',
			),
			array(
				'name'	=> __('Title','aivah_shortcodes'),
				'desc'	=> 'Type the text you wish to display for Bar Title',
				'id'	=> 'title',
				'std'	=> '',
				'type'	=> 'text',
				'inputsize'=> '53',
			),
			array(
				'name'	=> __('Color','aivah_shortcodes'),
				'desc'	=> 'Select the color for the Progress Bar',
				'id'	=> 'color',
				'std'	=> '',
				'type'	=> 'color',
				'inputsize'=> '',
			),
							
		)
	);
	// E N D   - Progressbar
	// P R O G R E S S  C I R C L E
	//--------------------------------------------------------
	 $aivah_shortcodes['Progress Circle'] = array(
		'name' => __('Progress Circle', 'aivah_shortcodes'),
		'value' => 'progresscircle',
		'options' => array(
			array(
				'name' 	=> __('Progress Circle Columns', 'aivah_shortcodes'),
				'desc' 	=> 'Progress Circle Columns.',
				'id' 	=> 'pcirclecolumns',
				'std' 	=> '',
				'type' 	=> 'select',
				'options' => array(
					'01' => 'One Columns',
					'02' => 'Two Columns',
					'03' => 'Three Columns',
					'04' => 'Four Columns'
				)
			),
			array(
				'name' 	=> __('Animations', 'aivah_shortcodes'),
				'desc' 	=> 'Select an animation effect for the element',
				'info' 	=> '(Optional)',
				'id'   	=> 'animation',
				'std' 	=> '',
				'type' 	=> 'select',
				'options' => $iva_anim
			)
		)
	);
	// E N D   - Progress Circle
	
	//C O U N T D O W N 
	//--------------------------------------------------------
	$aivah_shortcodes['Count Down'] = array(
		'name'		=> __('Count Down','aivah_shortcodes'),
		'value'		=>'countdown',
		'options'	=> array(
			array(
				'name'	=> __('Title','aivah_shortcodes'),
				'desc'  => 'Type title.',
				'id'	=> 'cd_text',
				'std'	=> '',
				'type'	=> 'text'
			),					
			array(
				'name' 	=> __('Year','aivah_shortcodes'),
				'desc'	=> 'Type year.',
				'id' 	=> 'cd_year',
				'std' 	=> '',
				'options'=> range(date('Y'),date('Y')+5),
					'type'	=> 'keyselect',
			),
			array(
				'name'	=> __('Month','aivah_shortcodes'),
				'desc'	=> 'Type month.',
				'id'	=> 'cd_month',
				'std'	=> '',
				'options'=> array(
					'01' 	=> 'January',
					'02' 	=> 'February',
					'03' 	=> 'March',
					'04' 	=> 'April',
					'05' 	=> 'May',
					'06' 	=> 'June',
					'07' 	=> 'July',
					'08' 	=> 'August',
					'09'	=> 'September',
					'10' 	=> 'October',
					'11' 	=> 'November',
					'12' 	=> 'December'
					),
					'type'	=> 'select',
			),
			array(
				'name'	=> __('Day','aivah_shortcodes'),
				'desc'	=> 'Type Day.',
				'id'	=> 'cd_day',
				'std'	=> '',
				'options'=> range(1,31),
					'type'	=> 'keyselect',
			),
			array(
				'name'	=> __('Hour','aivah_shortcodes'),
				'desc'	=> 'Type hour.',
				'id'	=> 'cd_hour',
				'std'	=> '',
				'options'=> range(1,24),
					'type'	=> 'keyselect',
			),
			array(
				'name' 	=> __('Minute','aivah_shortcodes'),
				'desc'	=> 'Type minute.',
				'id' 	=> 'cd_minute',
				'std' 	=> '',
				'options'=> range(1,59),
					'type'	=> 'keyselect',
			),
			array(
				'name' 	=> __('Class name','aivah_shortcodes'),
				'desc'	=> 'Type class',
				'id' 	=> 'cd_class',
				'std' 	=> '',
				'type' 	=> 'text',
			),
		),
	);
	// E N D   - Count Down	

	// S E C T I O N
	// ----------------------------------------------------- 
	$aivah_shortcodes['Section Fullwidth'] = array(
		'name' => __('Section Fullwidth', 'aivah_shortcodes'),
		'value' => 'section',
		'options' => array(
				array(
				    'name'	=> __('Section BG Image', 'aivah_shortcodes'),
				    'desc'	=> 'Upload Image you want to display for the Section background.',
				    'id'	=> 'bgimage',
				    'std'	=> '',
				    'type'	=> 'upload'
				),
   
				array(
				    'name' 		=> __('Background Attachment', 'aivah_shortcodes'),
				    'desc' 		=> 'The background-attachment property .',
				    'id' 		=> 'bg_attachment',
				    'std' 		=> '',
					'options'	=> array( 				
										''			=> 'Select Option', 
			 							'fixed'		=> 'fixed',
					 					'scroll'	=> 'scroll'
						 			),
					'type' => 'select'
				),

				array(
					'name'		=> __('Background Repeat', 'aivah_shortcodes'),
					'desc'		=> 'The Background Repeat .',
					'id'		=> 'bg_repeat',
					'std'		=> '',
					'options'	=> array(
										'repeat'	=> 'Repeat',
										'no-repeat'	=> 'No Repeat',
										'repeat-x'	=> 'Repeat X',
										'repeat-y'	=> 'Repeat Y'
									    ),
					'type' => 'select'
				),
				array(
					'name' 		=> __('Background Position', 'aivah_shortcodes'),
					'desc' 		=> 'The Background Position .',
					'id' 		=> 'bg_position',
					'std' 		=> '',
					'options' 	=> $bg_position,
					'type'		=> 'select'
				    ),
				array(
					'name' 		=> __('patterns', 'aivah_shortcodes'),
					'desc' 		=> 'Enter video url.',
					'id' 		=> 'videopattern',
					'std' 		=> '',
					'options'  => array(
							  ''    => IVA_SC_IMG_URI . '/patterns/no-pat.png',
							  'pat_01.png' => IVA_SC_IMG_URI . '/patterns/pattern-1-Preview.jpg',
							  'pat_02.png' => IVA_SC_IMG_URI . '/patterns/pattern-2-Preview.jpg',
							  'pat_03.png' => IVA_SC_IMG_URI . '/patterns/pattern-3-Preview.jpg',
							  'pat_04.png' => IVA_SC_IMG_URI . '/patterns/pattern-4-Preview.jpg',
							  'pat_05.png' => IVA_SC_IMG_URI . '/patterns/pattern-5-Preview.jpg',
							  'pat_06.png' => IVA_SC_IMG_URI . '/patterns/pattern-6-Preview.jpg',
							  'pat_07.png' => IVA_SC_IMG_URI . '/patterns/pattern-7-Preview.jpg',
							  'pat_08.png' => IVA_SC_IMG_URI . '/patterns/pattern-8-Preview.jpg'
							  ),
					'type'		=> 'pattern_bg'
					),
				array(
					'name' 		=> __('Section Opacity', 'aivah_shortcodes'),
					'desc' 		=> 'Choose Opactity Section background.',
					'id' 		=> 'opacity',
					'std' 		=> '0.2',
					'options' 	=> array(	
										'' => 'Select Option',
										'0.0' => '0.0',
										'0.1' => '0.1',
										'0.2' => '0.2',
										'0.3' => '0.3',
										'0.4' => '0.4',
										'0.5' => '0.5',
										'0.6' => '0.7',
										'0.8' => '0.8',
										'0.9' => '0.9',
										'1.0' => '1.0'
									),
					'type'		=> 'select'
					),

				array(
					'name'		=> __('Background Video?', 'aivah_shortcodes'),
					'desc'		=> 'Background Video Select.',
					'id'		=> 'videobg',
					'std'		=> '',
					'options'	=>array(
											''	=>'Select Option',
										'bgyes'	=>'yes',
										'bgno'	=>'No'
								),
					'type'		=> 'select'
				),

				array(
					'name'		=> __('Section Video URL', 'aivah_shortcodes'),
					'desc'		=> 'Enter video url.',
					'class'		=> 'video_bg bgyes',
					'id'		=> 'video',
					'std'		=> '',
					'type'		=> 'text'
				),
				 array(
					'name'		=> __('Parallax Background', 'aivah_shortcodes'),
					'desc'		=> 'Check this if you wish Parallax Background',
					'id'		=> 'parallax',
					'std'		=> '',
					'type'		=> 'checkbox',
					'inputsize'	=> '53'
				),

				array(
					'name' 		=> __('Section BG Color', 'aivah_shortcodes'),
					'desc' 		=> 'Choose the color you want to display for the Section background.',
					'id' 		=> 'bgcolor',
					'std' 		=> '',
					'type'		=> 'color'
				), 

				array(
					'name' 	=> __('Section Text Color', 'aivah_shortcodes'),
					'desc' 	=> 'Choose the color you want to display for the text.',
					'id' 	=> 'textcolor',
					'std' 	=> '',
					'type' 	=> 'color'
				),

				array(
					'name' 		=> __('Section Border color', 'aivah_shortcodes'),
					'desc' 		=> 'Choose the color you want to display for the border color.',
					'id' 		=> 'border_color',
					'std' 		=> '',
					'type'		=> 'color'
				),

				array(
					'name' 		=> __('Section Border width', 'aivah_shortcodes'),
					'desc' 		=> 'Enter the border width.For ex:1px or 1.',
					'id' 		=> 'border_width',
					'std' 		=> '',
					'type'		=> 'text'
				),
				
				array(
					'name' 	=> __('Section Padding', 'aivah_shortcodes'),
					'desc' 	=> 'Enter padding ex: 20px 0px 20px 0px. Make sure you don\'t use padding on left and right side. If you don\'t want padding then make it 0px not just 0',
					'id' 	=> 'padding',
					'std' 	=> '',
					'type' 	=> 'text'
				)
		)
	);
	// E N D   - Section Fullwidth
	
	// S O U N D C L O U D
	//--------------------------------------------------------
	$aivah_shortcodes['SoundCloud'] = array(
		'name' => __('SoundCloud', 'aivah_shortcodes'),
		'value' => 'soundcloud',
		'options' => array(
			
			array(
				'name' => __('Sound Type', 'aivah_shortcodes'),
				'desc' => __('Select the audio type', 'aivah_shortcodes'),
				'id' => 'type',
				'std' => '',
				'options' => array(
					'html5' => __('HTML5', 'aivah_shortcodes'),
					'flash' => __('Flash', 'aivah_shortcodes')
				),
				'type' => 'select'
			),
			array(
				'name' => __('Width', 'aivah_shortcodes'),
				'desc' => __('Use px as units for width', 'aivah_shortcodes'),
				'id' => 'width',
				'std' => '',
				'type' => 'text',
				'inputsize' => '30'
			),
			array(
				'name' => __('Height', 'aivah_shortcodes'),
				'desc' => __('Use px as units for height', 'aivah_shortcodes'),
				'id' => 'height',
				'std' => '',
				'type' => 'text',
				'inputsize' => '30'
			),
			array(
				'name' => __('Audio ID', 'aivah_shortcodes'),
				'desc' => __('Enter the ID only from the clips URL (e.g. http://api.soundcloud.com/tracks/<span style="color:red">123456789</span>)', 'aivah_shortcodes'),
				'id' => 'audio_id',
				'std' => '',
				'type' => 'text',
				'inputsize' => '30'
			),
			array(
				'name' => __('Show Artwork', 'aivah_shortcodes'),
				'desc' => __('Check this if you wish to enable Artwork option.', 'aivah_shortcodes'),
				'id' => 'show_art',
				'std' => '',
				'type' => 'checkbox'
			),
			array(
				'name' => __('Autoplay', 'aivah_shortcodes'),
				'desc' => __('Check this if you wish to enable auto play option.', 'aivah_shortcodes'),
				'id' => 'autoplay',
				'std' => '',
				'type' => 'checkbox'
			),
			array(
				'name' => __('Color', 'aivah_shortcodes'),
				'desc' => __('Select the color for the playes', 'aivah_shortcodes'),
				'id' => 'color',
				'std' => '',
				'type' => 'color'
			)
		)
	);
	// E N D   - SoundCloud
	
	//S T A F F
	//--------------------------------------------------------
	$aivah_shortcodes['Staff'] = array(
		'name' => __('Staff Box', 'aivah_shortcodes'),
		'value' => 'staff',
		'options' => array(
			array(
				'name' => __('Photo', 'aivah_shortcodes'),
				'desc' => 'Select the photo from media library or from your desktop but make sure its width should not be less than 420px to make it responsive.',
				'id' => 'photo',
				'std' => '',
				'type' => 'upload',
				'inputsize' => '53'
			),
			array(
				'name' => __('Name', 'aivah_shortcodes'),
				'desc' => 'Type the text or title you wish to display as Name',
				'id' => 'title',
				'std' => '',
				'type' => 'text',
				'inputsize' => '53'
			),
			array(
				'name' => __('Role', 'aivah_shortcodes'),
				'desc' => 'Type the text to resemble to role of a person',
				'id' => 'role',
				'std' => '',
				'type' => 'text',
				'inputsize' => '53'
			),
			array(
				'name' => __('Sociables', 'aivah_shortcodes'),
				'desc' => 'Add Sociables to the relevant Staff.',
				'id' => 'selectsociable',
				'std' => '',
				'type' => 'select',
				'options' => $staff_social,
				'inputsize' => '70'
			),
			
			array(
				'name' => __('Blogger', 'aivah_shortcodes'),
				'desc' => 'Enter Blogger URL ',
				'id' => 'blogger',
				'class' => 'class_hide',
				'std' => '',
				'type' => 'text_rm',
				'inputsize' => '70'
			),
			array(
				'name' => __('Dribbble', 'aivah_shortcodes'),
				'desc' => 'Enter Dribble URL',
				'id' => 'dribbble',
				'class' => 'class_hide',
				'std' => '',
				'type' => 'text_rm',
				'inputsize' => '70'
			),
			
			array(
				'name' => __('Delicious', 'aivah_shortcodes'),
				'desc' => 'Enter Delicous URL',
				'id' => 'delicious',
				'std' => '',
				'class' => 'class_hide',
				'type' => 'text_rm',
				'inputsize' => '70'
			),
			array(
				'name' => __('Digg', 'aivah_shortcodes'),
				'desc' => 'Enter Digg URL',
				'id' => 'digg',
				'class' => 'class_hide',
				'std' => '',
				'type' => 'text_rm',
				'inputsize' => '70'
			),
			array(
				'name' => __('Facebook', 'aivah_shortcodes'),
				'desc' => 'Enter Facebook URL',
				'id' => 'facebook',
				'class' => 'class_hide',
				'std' => '',
				'type' => 'text_rm',
				'inputsize' => '70'
			),
			array(
				'name' => __('Flickr', 'aivah_shortcodes'),
				'desc' => 'Enter Flickr URL',
				'id' => 'flickr',
				'std' => '',
				'class' => 'class_hide',
				'type' => 'text_rm',
				'inputsize' => '70'
			),
			array(
				'name' => __('Forrst', 'aivah_shortcodes'),
				'desc' => 'Enter Forrst URL',
				'id' => 'forrst',
				'class' => 'class_hide',
				'std' => '',
				'type' => 'text_rm',
				'inputsize' => '70'
			),
			array(
				'name' => __('Google', 'aivah_shortcodes'),
				'desc' => 'Enter Google URL',
				'id' => 'google',
				'class' => 'class_hide',
				'std' => '',
				'type' => 'text_rm',
				'inputsize' => '70'
			),
			array(
				'name' => __('Linkedin', 'aivah_shortcodes'),
				'desc' => 'Enter Linkedin URL',
				'id' => 'linkedin',
				'class' => 'class_hide',
				'std' => '',
				'type' => 'text_rm',
				'inputsize' => '70'
			),
			array(
				'name' => __('Pinterest', 'aivah_shortcodes'),
				'desc' => 'Enter Pinterest URL',
				'id' => 'pinterest',
				'class' => 'class_hide',
				'std' => '',
				'type' => 'text_rm',
				'inputsize' => '70'
			),
			array(
				'name' => __('Skype', 'aivah_shortcodes'),
				'desc' => 'Enter Skype URL',
				'id' => 'skype',
				'class' => 'class_hide',
				'std' => '',
				'type' => 'text_rm',
				'inputsize' => '70'
			),
			array(
				'name' => __('Stumbleupon', 'aivah_shortcodes'),
				'desc' => 'Enter Stumbleupon URL',
				'id' => 'stumbleupon',
				'class' => 'class_hide',
				'std' => '',
				'type' => 'text_rm',
				'inputsize' => '70'
			),
			array(
				'name' => __('Twitter', 'aivah_shortcodes'),
				'desc' => 'Enter Twitter URL',
				'id' => 'twitter',
				'class' => 'class_hide',
				'std' => '',
				'type' => 'text_rm',
				'inputsize' => '70'
			),
			array(
				'name' => __('Yahoo', 'aivah_shortcodes'),
				'desc' => 'Enter Yahoo URL',
				'id' => 'yahoo',
				'class' => 'class_hide',
				'std' => '',
				'type' => 'text_rm',
				'inputsize' => '70'
			),
			array(
				'name' => __('Youtube', 'aivah_shortcodes'),
				'desc' => 'Enter Youtube URL',
				'id' => 'youtube',
				'class' => 'class_hide',
				'std' => '',
				'type' => 'text_rm',
				'inputsize' => '70'
			),
			
			array(
				'name' => __('Content', 'aivah_shortcodes'),
				'desc' => 'Type the text you wish to display for the staff box or profile summary.',
				'id' => 'content',
				'std' => '',
				'type' => 'textarea',
				'inputsize' => '70'
			),
			 array(
				'name' => __('Animations', 'aivah_shortcodes'),
				'desc' => 'Select an animation effect for the element',
				'info' => '(Optional)',
				'id' => 'animation',
				'std' => '',
				'type' => 'select',
				'options' => $iva_anim
			)
		)
	);
	// E N D   - Staff

	// M I N I   G A L L E R Y 
	//--------------------------------------------------------
	$aivah_shortcodes['Mini Gallery'] = array(
		'name'		=> __('Mini Gallery','aivah_shortcodes'),
		'value'		=> 'minigallery',
		'options'	=> array(
				
				array(
					'name'	=> __('Image Width','aivah_shortcodes'),
					'desc'	=> 'Use px as units for width, do not leave only numbers.',
					'id'	=> 'width',
					'std'	=> '',
					'type'	=> 'text',
					'inputsize'=> '53',
				),
				array(
					'name'	=> __('Image Height','aivah_shortcodes'),
					'desc'	=> 'Use px as units for width, do not leave only numbers.',
					'id'	=> 'height',
					'std'	=> '',
					'type'	=> 'text',
					'inputsize'=> '53',
				),
				array(
					'name'	=> __('Class','aivah_shortcodes'),
					'desc'	=> 'Add sub class for the images if you want to assign any new class for the images but use spaces between multiple classes no commas',
					'info'	=> '(Optional)',
					'id'	=> 'class',
					'std'	=> '',
					'type'	=> 'text',
					'inputsize'=> '53',
				),
				array( 
					'name'	=> __('Images URL','aivah_shortcodes'),
					'desc'	=> 'Enter image url(s) in each separated lines.',
					'id'	=> 'textarea_url',
					'std'	=> '',
					'type'	=> 'textarea',
					'options'	=>'',
					'inputsize' => '53'
				)
		)
	);

	// G O O G L E  M A P
	//--------------------------------------------------------
	$aivah_shortcodes['Google Map'] = array(
		'name' 		=> __('Google Map', 'aivah_shortcodes'),
		'value' 	=> 'gmap',
		'options' 	=> array(
			array(
				'name' 		=> __('Width', 'aivah_shortcodes'),
				'desc' 		=> 'Use px as units for Width, do not leave only numbers.',
				'id' 		=> 'width',
				'std' 		=> '',
				'type' 		=> 'text',
				'inputsize' => '53'
			),
			array(
				'name' 		=> __('Height', 'aivah_shortcodes'),
				'desc' 		=> 'Use px as units for Height, do not leave only numbers.',
				'id' 		=> 'height',
				'std' 		=> '300',
				'type' 		=> 'text',
				'inputsize' => '53'
			),
			array(
				'name' 	=> __('Address', 'aivah_shortcodes'),
				'desc' 	=> 'Type the address you wish to display for the map u can use multiple address EX: Address1 | Address2 | Address3 .',
				'info' 	=> '(optional)',
				'id' 	=> 'address',
				'std' 	=> '',
				'type' 	=> 'text',
				'inputsize' => '53'
			),
			array(
				'name' => __('Latitude', 'aivah_shortcodes'),
				'id' => 'latitude',
				'std' => '',
				'type' => 'text',
				'inputsize' => '30'
			),
			array(
				'name' => __('longitude', 'aivah_shortcodes'),
				'id' => 'longitude',
				'std' => '',
				'type' => 'text',
				'inputsize' => '30'
			),
			array(
				'name' => __('Zoom', 'aivah_shortcodes'),
				'desc' => 'The initial Map zoom level. Required. (Zoom Range : 1-19)',
				'id' => 'zoom',
				'std' => '12',
				'type' => 'text',
				'inputsize' => '53'
			),
			array(
				'name' => __('Marker Description', 'aivah_shortcodes'),
				'desc' => 'You can use multiple Marker Description - Example: Description1 | Description2 | Description3.',
				'id' => 'marker_desc',
				'std' => '',
				'type' => 'text',
				'inputsize' => '53'
			),
			array(
				'name' => __('Info Window', 'aivah_shortcodes'),
				'desc' => 'Check this if you wish to open the marker window by default',
				'id' => 'infowindow',
				'std' => '',
				'type' => 'checkbox',
				'inputsize' => '53'
			),
			array(
				'name' => __('Controller', 'aivah_shortcodes'),
				'desc' => 'Check this if you wish to enable the Controller',
				'id' => 'controller',
				'std' => '',
				'type' => 'checkbox',
				'inputsize' => '53'
			),
			array(
				'name' => __('Visibility', 'aivah_shortcodes'),
				'desc' => 'Check this if you wish to view the visibility of roadmap',
				'id' => 'visibility',
				'std' => '',
				'type' => 'checkbox',
				'inputsize' => '53'
			),
			array(
				'name' => __('Google map stylers Color', 'aivah_shortcodes'),
				'desc' => 'Use Colorpicker to Googlemap stylers color',
				'id' => 'stylerscolor',
				'std' => '',
				'type' => 'color'
			),
			array(
				'name' => __('Gmap Types', 'aivah_shortcodes'),
				'desc' => 'HYBRID: <em>This map type displays a transparent layer of major streets on satellite images.</em> <br> ROADMAP: <em>This map type displays a normal street map.<br> SATELLITE: This map type displays satellite images.</em><br> TERRAIN: <em>This map type displays maps with physical features such as terrain and vegetation.</em>',
				'id' => 'types',
				'std' => 'ROADMAP',
				'options' => array(
					'ROADMAP' => 'Default road map',
					'SATELLITE' => 'Google Earth satellite',
					'HYBRID' => 'Hybrid',
					'TERRAIN' => 'Terain'
				),
				'type' => 'select'
			)
		)
	);
	// E N D   - Google Map
	
	// T W I T T E R
	//--------------------------------------------------------
	$aivah_shortcodes['Twitter'] = array(
		'name'		=> __('Twitter Tweets','aivah_shortcodes'),
		'value'		=>'twitter',
		'options'	=> array(
			array(
				'name'	=> __('Twitter Id','aivah_shortcodes'),
				'desc'	=> 'Twitter ID: <small>Use your Id from twitter url <em>http://twitter.com/<span style="color:red">username</span></em></small>',
				'id'	=> 'username',
				'std'	=> '',
				'type'	=> 'text',
				'inputsize'	=> '30',
			),
			array(
				'name'	=> __('Twitter API key','aivah_shortcodes'),
				'desc'	=> 'Twitter Consumer key',
				'id'	=> 'apikey',
				'std'	=> '',
				'type'	=> 'text',
				'inputsize'	=> '30',
			),
			array(
				'name'	=> __('Twitter API secret','aivah_shortcodes'),
				'desc'	=> 'Twitter Consumer secret',
				'id'	=> 'apisecret',
				'std'	=> '',
				'type'	=> 'text',
				'inputsize'	=> '30',
			),
			array(
				'name'	=> __('Twitter Access token','aivah_shortcodes'),
				'desc'	=> 'Twitter Access token',
				'id'	=> 'accesstoken',
				'std'	=> '',
				'type'	=> 'text',
				'inputsize'	=> '30',
			),
			array(
				'name'	=> __('Twitter Token secret','aivah_shortcodes'),
				'desc'	=> 'Twitter Access secret',
				'id'	=> 'tokensecret',
				'std'	=> '',
				'type'	=> 'text',
				'inputsize'	=> '30',
			),
			array(
				'name'	=> __('Limit','aivah_shortcodes'),
				'desc'	=> 'Type the number of tweets you wish to display.',
				'id'	=> 'limit',
				'std'	=> '4',
				'type'	=> 'text',
				'inputsize'	=> '30',
			),
			array(
				'name'	=> __('Color','aivah_shortcodes'),
				'desc'	=> 'Select color',
				'id'	=> 'color',
				'std'	=> 'dark',
				'options'=> array(
								'dark'	=> 'Dark',
								'light'	=> 'light',
							),
				'type' => 'select',
			),
			array(
				'name'    => __('Animations', 'aivah_shortcodes'),
				'desc'    => 'Select an animation effect for the element',
				'info'    => '(Optional)',
				'id'      => 'animation',
				'std'     => '',
				'type'    => 'select',
				'options' => $iva_anim
			),									
		)
	);
	// END Twitter
	
	
	// F L I C K R
	//--------------------------------------------------------
	$aivah_shortcodes['Flickr'] = array(
		'name' => __('Flickr Photos', 'aivah_shortcodes'),
		'value' => 'flickr',
		'options' => array(
			array(
				'name' => __('Flickr Id', 'aivah_shortcodes'),
				'desc' => 'Flickr ID: Find your Id from http://idgettr.com',
				'id' => 'id',
				'std' => '',
				'type' => 'text',
				'inputsize' => '30'
			),
			array(
				'name' => __('Limit', 'aivah_shortcodes'),
				'desc' => 'Flickr Photos Limit.',
				'id' => 'limit',
				'std' => '3',
				'type' => 'text',
				'inputsize' => '30'
			),
			array(
				'name' => __('Type', 'aivah_shortcodes'),
				'desc' => 'Choose Photos Type',
				'id' => 'type',
				'std' => 'user',
				'options' => array(
					'user' => 'User',
					'group' => 'Group'
				),
				'type' => 'select'
			),
			array(
				'name' => __('Display', 'aivah_shortcodes'),
				'desc' => 'Choose Display Type',
				'id' => 'display',
				'std' => 'random',
				'options' => array(
					'random' => 'Random',
					'latest' => 'Latest'
				),
				'type' => 'select'
			)
		)
	);
	// END - Flickr
	
	// T A B S
	//------------------------------------------------------------------
	 $aivah_shortcodes['Tabs'] = array(
		'name'		=> __('Tabs','aivah_shortcodes'),
		'value'		=>'Tabs',
		'subtype'	=> true,
		'options'	=> array(
			array(
				'name'		=> __('2 Tabs','aivah_shortcodes'),
				'value'		=>'t2',
				'options'	=> array(
					array(
						'name'	=> __('Tab 1 Title','aivah_shortcodes'),
						'desc'	=> 'Type the text for Tab 1',
						'id'	=> 'title_1',
						'std'	=> '',
						'type'	=> 'text',
						'inputsize'	=>'53',
					),
					array(
						'name'	=> __('Tab 1 Content','aivah_shortcodes'),
						'desc'	=> 'Type the content for Tab 1',
						'id'	=> 'text_1',
						'std'	=> '',
						'type'	=> 'textarea'
					),
					array(
						'name'	=> __('Tab 1 Bgcolor','aivah_shortcodes'),
						'info'	=> '(Optional)',
						'id'	=> 'titlebgcolor_1',
						'std'	=> '',
						'type'	=> 'color',
					),
					array(
						'name'	=> __('Tab 1 Title Color','aivah_shortcodes'),
						'info'	=> '(Optional)',
						'id'	=> 'titlecolor_1',
						'std'	=> '',
						'type'	=> 'color',
					),
					//------------------------- S E P A R A T O R
					array('name' => __('Separator','aivah_shortcodes'),'type' => 'separator', ),

					array(
						'name'	=> __('Tab 2 Title','aivah_shortcodes'),
						'desc'	=> 'Type the text for Tab 2',
						'id'	=> 'title_2',
						'std'	=> '',
						'type'	=> 'text',
						'inputsize'	=>'53',
					),
					array(
						'name'	=> __('Tab 2 Content','aivah_shortcodes'),
						'desc'	=> 'Type the content for Tab 2',
						'id'	=> 'text_2',
						'std'	=> '',
						'type'	=> 'textarea'
					),
					array(
						'name'	=> __('Tab 2 Bgcolor','aivah_shortcodes'),
						'info'	=> '(Optional)',
						'id'	=> 'titlebgcolor_2',
						'std'	=> '',
						'type'	=> 'color',
					),
					array(
						'name'	=> __('Tab 2 Title Color','aivah_shortcodes'),
						'info'	=> '(Optional)',
						'id'	=> 'titlecolor_2',
						'std'	=> '',
						'type'	=> 'color',
					),
					//------------------------- S E P A R A T O R
					array('name' => __('Separator','aivah_shortcodes'),'type' => 'separator', ),

					array(
						'name'	=> __('Tabs Type  ','aivah_shortcodes'),
						'desc'	=> 'Choose Tabs Type Horizontal/Vertical',
						'id'	=> 'ctabs',
						'std'	=> '',
						'options'=> array(
									'horitabs' => 'Horizontal',
									'vertabs' => 'Vertical',
						),
						'type'	=> 'select',
					),
					array(
						'name'    => __('Animations', 'aivah_shortcodes'),
						'desc'    => 'Select an animation effect for the element.',
						'info'    => '(Optional)',
						'id'      => 'animation',
						'std'     => '',
						'type'    => 'select',
						'options' => $iva_anim
					),					
				
				),
			),
			// 3 T A B S
			array(
				'name'		=> __('3 Tabs','aivah_shortcodes'),
				'value'		=>'t3',
				'options'	=> array(
					array(
						'name'	=> __('Tab 1 Title','aivah_shortcodes'),
						'desc'	=> 'Type the text for Tab 1',
						'id'	=> 'title_1',
						'std'	=> '',
						'type'	=> 'text',
						'inputsize'	=>'53',
					),
					array(
						'name'	=> __('Tab 1 Content','aivah_shortcodes'),
						'desc'	=> 'Type the content for Tab 1',
						'id'	=> 'text_1',
						'std'	=> '',
						'type'	=> 'textarea'
					),
					array(
						'name'	=> __('Tab 1 Bgcolor','aivah_shortcodes'),
						'info'	=> '(Optional)',
						'id'	=> 'titlebgcolor_1',
						'std'	=> '',
						'type'	=> 'color',
					),
					array(
						'name'	=> __('Tab 1 Title Color','aivah_shortcodes'),
						'info'	=> '(Optional)',
						'id'	=> 'titlecolor_1',
						'std'	=> '',
						'type'	=> 'color',
					),
					//------------------------- S E P A R A T O R
					array('name' => __('Separator','aivah_shortcodes'),'type' => 'separator', ),

					array(
						'name'	=> __('Tab 2 Title','aivah_shortcodes'),
						'desc'	=> 'Type the text for Tab 2',
						'id'	=> 'title_2',
						'std'	=> '',
						'type'	=> 'text',
						'inputsize'	=>'53',
					),
					array(
						'name'	=> __('Tab 2 Content','aivah_shortcodes'),
						'desc'	=> 'Type the content for Tab 2',
						'id'	=> 'text_2',
						'std'	=> '',
						'type'	=> 'textarea'
					),
					array(
						'name'	=> __('Tab 2 Bgcolor','aivah_shortcodes'),
						'info'	=> '(Optional)',
						'id'	=> 'titlebgcolor_2',
						'std'	=> '',
						'type'	=> 'color',
					),
					array(
						'name'	=> __('Tab 2 Title Color','aivah_shortcodes'),
						'info'	=> '(Optional)',
						'id'	=> 'titlecolor_2',
						'std'	=> '',
						'type'	=> 'color',
					),
					//------------------------- S E P A R A T O R
					array('name' => __('Separator','aivah_shortcodes'),'type' => 'separator', ),

					array(
						'name'	=> __('Tab 3 Title','aivah_shortcodes'),
						'desc'	=> 'Type the text for Tab 3',
						'id'	=> 'title_3',
						'std'	=> '',
						'type'	=> 'text',
						'inputsize'	=>'53',
					),
					array(
						'name'	=> __('Tab 3 Content','aivah_shortcodes'),
						'desc'	=> 'Type the content for Tab 3',
						'id'	=> 'text_3',
						'std'	=> '',
						'type'	=> 'textarea'
					),
					array(
						'name'	=> __('Tab 3 Bgcolor','aivah_shortcodes'),
						'info'	=> '(Optional)',
						'id'	=> 'titlebgcolor_3',
						'std'	=> '',
						'type'	=> 'color',
					),
					array(
						'name'	=> __('Tab 3 Title Color','aivah_shortcodes'),
						'info'	=> '(Optional)',
						'id'	=> 'titlecolor_3',
						'std'	=> '',
						'type'	=> 'color',
					),
					//------------------------- S E P A R A T O R
					array('name' => __('Separator','aivah_shortcodes'),'type' => 'separator', ),

					array(
						'name'	=> __('Tabs Type  ','aivah_shortcodes'),
						'desc'	=> 'Choose Tabs Type Horizontal/Vertical',
						'id'	=> 'ctabs',
						'std'	=> '',
						'options'=> array(
									'horitabs' => 'Horizontal',
									'vertabs' => 'Vertical',
						),
						'type'	=> 'select',
					),
					array(
						'name'    => __('Animations', 'aivah_shortcodes'),
						'desc'    => 'Select an animation effect for the element.',
						'info'    => '(Optional)',
						'id'      => 'animation',
						'std'     => '',
						'type'    => 'select',
						'options' => $iva_anim
					),						
				),
			),	
		)
	);
	// END - Tabs
	
	// C O N T A C T  I N F O
	//--------------------------------------------------------
	$aivah_shortcodes['Contact Info'] = array(
		'name'		=> __('Contact Info','aivah_shortcodes'),
		'value'		=>'contactinfo',
		'options'	=> array(
			array(
				'name'	=> __('Name','aivah_shortcodes'),
				'desc'	=> 'Type the Name or Company Name you wish to display.',
				'id'	=> 'name',
				'std'	=> '',
				'type'	=> 'text',
				'inputsize'	=> '',
			),
			array(
				'name'	=> __('Address','aivah_shortcodes'),
				'desc'	=> 'Type the Address you wish to display.',
				'id'	=> 'address',
				'std'	=> '',
				'type'	=> 'textarea',
				'inputsize'	=> '',
			),
			array(
				'name'	=> __('Phone','aivah_shortcodes'),
				'desc'	=> 'Type the Phone Number you wish to display.',
				'id'	=> 'phone',
				'std'	=> '',
				'type'	=> 'text',
				'inputsize'	=> '',
			),
			array(
				'name'	=> __('Email','aivah_shortcodes'),
				'desc'	=> 'Type the Email-ID you wish to display.',
				'id'	=> 'email',
				'std'	=> '',
				'type'	=> 'text',
				'inputsize'	=> '',
			),
			array(
				'name'	=> __('Website','aivah_shortcodes'),
				'desc'	=> 'Type the Link URL you wish to display. excluding http',
				'id'	=> 'website_name',
				'std'	=> '',
				'type'	=> 'text',
				'inputsize'	=> '',
			),
			array(
				'name'	=> __('Website URL','aivah_shortcodes'),
				'desc'	=> 'Type the Link URL you wish to display. excluding http',
				'id'	=> 'website_url',
				'std'	=> '',
				'type'	=> 'text',
				'inputsize'	=> '',
			),
			array(
				'name'	=> __('Fax','aivah_shortcodes'),
				'desc'	=> 'Type the Link URL you wish to display. excluding http',
				'id'	=> 'fax',
				'std'	=> '',
				'type'	=> 'text',
				'inputsize'	=> '',
			),
			array(
				'name'    => __('Animations', 'aivah_shortcodes'),
				'desc'    => 'Select an animation effect for the element.',
				'info'    => '(Optional)',
				'id'      => 'animation',
				'std'     => '',
				'type'    => 'select',
				'options' => $iva_anim
			),
		)
	);
	// END Contact Info
	
	// N U M B E R  C O U N T E R 
	//--------------------------------------------------------
	$aivah_shortcodes['Milestone'] = array(
		'name'		=> __('Milestone','aivah_shortcodes'),
		'value'		=>'counter',
		'options'	=> array(
			array(
				'name'	=> __('Fontawesome Icon','aivah_shortcodes'),
				'desc'  => 'Go to Example http://fortawesome.github.io/Font-Awesome/examples/',
				'id'	=> 'counter_iconstyle',
				'std'	=> '',
				'type'	=> 'text'
			),					
			array(
				'name' 	=> __('Icon Color','aivah_shortcodes'),
				'desc'	=> 'Select the color variation',
				'id' 	=> 'icon_color',
				'std' 	=> '',
				'type' 	=> 'color',
			),
			array(
				'name'	=> __('Milestone','aivah_shortcodes'),
				'desc'	=> 'Type the number that display on the counter.',
				'id'	=> 'data_to',
				'std'	=> '',
				'type'	=> 'text',
			),
			array(
				'name'	=> __('Milestone Speed','aivah_shortcodes'),
				'desc'	=> 'Type the speed ( e.g: 1000 to 10000).',
				'id'	=> 'data_speed',
				'std'	=> '',
				'type'	=> 'text',
			),
			array(
				'name'	=> __('Subject Text','aivah_shortcodes'),
				'desc'	=> 'Type the text if you wish to display title on the counter.',
				'id'	=> 'counter_text',
				'std'	=> '',
				'type'	=> 'text',
			),
			array(
				'name' 	=> __('Milestone Color','aivah_shortcodes'),
				'desc'	=> 'Select the color variation for number',
				'id' 	=> 'numbercolor',
				'std' 	=> '',
				'type' 	=> 'color',
			),
		)
	);
	// END - NUMBER COUNTER 
	
	// P R O C E S S  I C O N
	//--------------------------------------------------------
	$aivah_shortcodes['Process Steps'] = array(
		'name'		=> __('Process Steps','aivah_shortcodes'),
		'value'		=>'processsteps',
		'options'	=> array(
			
			array(
				'name'		=> __( 'Steps','aivah_shortcodes'),
				'desc'  	=> '',
				'id'		=> 'step',
				'std'		=> '',
				'options'	=> array(
								''	=> 'Choose Steps...',
								'3'	=> '3 Steps',
								'4'	=> '4 Steps',
								'5'	=> '5 Steps',
							),
				'type'	=> 'select',
			),	
			
			array(
				'name'	=> __('Color','aivah_shortcodes'),
				'desc'	=> 'Choose Icon Color',
				'id'	=> 'color',
				'std'	=> '',
				'class' => '',
				'options' => array(
					''			=> 'Choose one...',
					'gray'		=> 'Gray',
					'brown'		=> 'Brown',
					'cyan'		=> 'Cyan',
					'orange'	=> 'Orange',
					'red'		=> 'Red',
					'magenta'	=> 'Magenta',
					'yellow'	=> 'Yellow',
					'blue'		=> 'Blue',
					'pink'		=> 'Pink',
					'green'		=> 'Green',
					'black'		=> 'Black',
					'white'		=> 'White'
				),
				'type'	=> 'select',
			),
		)
	);
	//END - Processicon
	// V I M E O 
	//--------------------------------------------------------
	$aivah_shortcodes['Vimeo']  = array(
		'name' => __('Vimeo', 'aivah_shortcodes'),
		'value' => 'vimeo',
		'options' => array(
			array(
				'name' => __('Clip id', 'aivah_shortcodes'),
				'desc' => 'Enter the ID only from the clips URL (e.g. http://vimeo.com/<span style="color:red">123456<span style="color:red">)',
				'id' => 'clipid',
				'std' => '',
				
				'type' => 'textarea'
			),
			array(
				'name' => __('Autoplay', 'aivah_shortcodes'),
				'desc' => 'Check this if you wish to enable auto play option.',
				'id' => 'autoplay',
				'std' => 'true',
				'type' => 'checkbox'
			)
		)
	);
	//END - Vimeo
	
	// Y O U T U B E 
	//--------------------------------------------------------
	$aivah_shortcodes['Youtube'] = array(
		'name' => __('Youtube', 'aivah_shortcodes'),
		'value' => 'youtube',
		'options' => array(
			array(
				'name' => __('Clip id', 'aivah_shortcodes'),
				'desc' => 'The id from the clip URL after v= (e.g. http://www.youtube.com/watch?v=<span style="color:red">GgR6dyzkKHI</span>)',
				'id' => 'clipid',
				'std' => '',
				'type' => 'textarea'
			),
			array(
				'name' => __('Autoplay', 'aivah_shortcodes'),
				'desc' => 'Check this if you wish to start playing the video after the player intialized.',
				'id' => 'autoplay',
				'type' => 'checkbox'
			)
		)
	);
	//END - Youtube
	
	// P R I C I N G T A B L E
	//--------------------------------------------------------
	$aivah_shortcodes['Pricing Table'] = array(
		'name' => __('Pricing Table', 'aivah_shortcodes'),
		'value' => 'pricing',
		'options' => array(
			array(
				'name' 	=> __('Pricing Columns', 'aivah_shortcodes'),
				'desc' 	=> 'Price Columns.',
				'id' 	=> 'price',
				'std' 	=> '',
				'type' 	=> 'select',
				'options' 	=> array(
					'03' 	=> 'Three Columns',
					'04' 	=> 'Four Columns'
				)
			)
		)
	);
	// END PRICING TABLE
		
	// S E R V I C E S  B O X
	//--------------------------------------------------------
	$aivah_shortcodes['Services Box'] = array(
		'name'		=> __('Services Box','aivah_shortcodes'),
		'value'		=> 'services_box',
		'options'	=> array(
	
			array(
				'name'	=> __('Title','aivah_shortcodes'),
				'desc'	=> 'Type the title you wish to display for the services box',
				'id'	=> 'title',
				'std'	=> '',
				'type'	=> 'text',
			),
			array(
				'name'	=> __('Content','aivah_shortcodes'),
				'desc'	=> 'Type the text you wish to display for the services box content',
				'id'	=> 'sb_content',
				'std'	=> '',
				'type'	=> 'textarea',
			),
			array(
				'name'	=> __('Background Color','aivah_shortcodes'),
				'desc'	=> 'Choose Background Color for the services box',
				'id'	=> 'bg_color',
				'std'	=> '',
				'class' => '',
				'type'	=> 'color',
			),
			array(
				'name'	=> __('Text Color','aivah_shortcodes'),
				'desc'	=> 'Choose Text Color for the services box',
				'id'	=> 'text_color',
				'std'	=> '',
				'class' => '',
				'type'	=> 'color',
			),
			
			array(
				'name'	=> __('Button Text','aivah_shortcodes'),
				'desc'	=> 'Choose button Text the services box',
				'id'	=> 'btn_text',
				'std'	=> '',
				'class' => '',
				'type'	=> 'text',
			),
			
			array(
				'name'	=> __('Button Color','aivah_shortcodes'),
				'desc'	=> 'Choose Button Color for the services box',
				'id'	=> 'btn_color',
				'std'	=> '',
				'class' => '',
				'options' => array(
								''		=> 'Choose one...',
								'light'	=> 'Light',
								'dark'	=> 'Dark',
							),
				'type' => 'select'
			),

			array(
				'name'	=> __('Margin Top','aivah_shortcodes'),
				'desc'	=> 'Type the font margin top in px.',
				'id'	=> 'margin_top',
				'std'	=> '',
				'type'	=> 'text',
			),
		)
	);
	// E N D  - SERVICES	
		
//pest Shortcodes
$aivah_shortcodes = apply_filters('iva_shorcode_meta',$aivah_shortcodes );
?>
<div id="iva-sc-generator"  class="mfp-hide mfp-with-anim">
	<div class="atp_meta_options"> 
		<div class="glowborder">
			<div class="atp_scgen">
				<div class="primary_select">
					<h2>Shortcode Generator</h2>
					<table class="shortcodestab" cellspacing="0"  cellpadding="0">
						<tr>
							<th scope="row">Shortcodes</th>
							<td><div class="meta_page_selectwrap">
								<div><select id="primary_select">
								<option value="">choose</option>
								<?php
								ksort( $aivah_shortcodes );
								foreach($aivah_shortcodes as $shortcodes) {
									echo '<option value="'.$shortcodes['value'].'">'.$shortcodes['name'].'</option>';
								} ?>
								</select>
							</div></div></td>
						</tr>
					</table>
				</div>
				<?php
				foreach( $aivah_shortcodes as $shortcodes ) {
					echo '<div class="secondary_select" id="secondary_'.$shortcodes['value'].'">'; 

					if( isset( $shortcodes['subtype'] ) ){
						echo '<div class="secondaryselect">';
						echo '<table class="shortcodestab" cellspacing="0" cellpadding="8"><tr><th scope="row">Type:</th><td>';
						// Start Select ----------
						echo '<div class="meta_page_selectwrap"><div><select name="atp_'.$shortcodes['value'].'_selector">';
						echo '<option value=" ">Choose one...</option>';
						foreach( $shortcodes['options'] as $sub_shortcode ) {
							echo '<option value="'.$sub_shortcode['value'].'">'.$sub_shortcode['name'].'</option>';
						}
						echo '</select></div></div>';
						// End Select ----------
						echo '</td></tr>';
						echo '</table></div>';

						foreach( $shortcodes['options'] as $sub_shortcode ) {
							echo '<div id="atp-'.$sub_shortcode['value'].'" class="tertiary_select">';
							echo '<table class="shortcodestab" cellspacing="0"  cellpadding="8">';

							foreach( $sub_shortcode['options'] as $option ){
								if( ! isset( $option['id'] ) ) { $option['id']=''; }
								echo '<tr class="'.$option['id'].'">';
								$option['id']=''.$shortcodes['value'].'_'.$sub_shortcode['value'].'_'.$option['id'];
								if( !isset( $option['desc'] ) ) { $option['desc']=''; }
								
								if( ! isset( $option['inputsize'] ) ) { $option['inputsize']=''; }
								if( ! isset( $option['std']) ) { $option['std']=''; }
								if( ! isset( $option['options']) ) { $option['options']=''; }
								if( ! isset( $option['info']) ) { $option['info']=''; }
								typeeditor($option['type'],$option['id'],$option['options'],$option['name'],$option['desc'],$option['info'],$option['std'],$option['inputsize']);	
								echo '</tr>';
							}
							echo '</table></div>';
						}
					} 
					else {
						echo '<table class="shortcodestab" cellspacing="0" cellpadding="8">';
						foreach( $shortcodes['options'] as $option ){
							if( ! isset( $option['class'] ) ) { $option['class']=''; }
							echo '<tr class="'.$option['id'].'  '.$option['class'].'">';
							$option['id']=''.$shortcodes['value'].'_'.$option['id'];
							if( ! isset( $option['desc'] ) ) { $option['desc']=''; }
							if( ! isset( $option['id'] ) ) { $option['id']=''; }
							if( ! isset( $option['inputsize'] ) ) { $option['inputsize']=''; }
							if( ! isset( $option['std'] ) ) { $option['std']=''; }
							if( ! isset( $option['options'] ) ) { $option['options']=''; }
							if( ! isset( $option['info'] ) ) { $option['info']=''; }
							typeeditor($option['type'],$option['id'],$option['options'],$option['name'],$option['desc'],$option['info'],$option['std'],$option['inputsize']); 	echo '</tr>';
						} 
						echo '</table>';
					} 
					echo'</div>';
				}
				?>
			</div>
			<div class="sendbox">
				<input type="button" id="sendtoeditor" class="button button-primary button-hero" value="Send to Editor"/>
				<input type="hidden" name="atp-sociables-result" id="atp-sociables-result" value="" />
			</div>
		</div>
	</div>
</div>
<?php
}
// E D I T O R   T Y P E S 
//--------------------------------------------------------
function typeeditor($type,$id,$ivaoptions,$name,$desc,$info,$std,$inputsize) {

	switch ($type) {
		case 'upload':
				echo '<th scope="row">Upload Image</th>';
				echo '<td><label for="upload_image">';
				echo '<input name="'.$id.'" id="'.$id.'"  type="text" class="custom_upload_image" value="" />';
				echo '<input class="upload_sc button-primary" type="button" value="Choose Image" />';
				echo '</label></td>';
				break;
		case 'keyselect':
				echo '<th scope="row">',$name,'<span class="info">',$info,'</span></th>';
				echo '<td><div class="meta_page_selectwrap"><div class="', $id, '"><select  name="', $id, '" id="', $id, '">';
				echo '<option value=" ">Select Option</option>';
				foreach ($ivaoptions as $optionkey => $option) {
					echo '<option value="',$option,'">', $option, '</option>';
				}
				echo '</select></div></div> <span class="desc">', $desc,'</span></td>';
				break;
		case 'color':
				$inputsize = isset($inputsize) ? $inputsize : '10';
				echo '<script>
				jQuery(document).ready(function(){
					jQuery("#',$id,'").wpColorPicker({
						color: "#0000ff",
						onShow: function (colpkr) {
							jQuery(colpkr).fadeIn(500);
							return false;
						},
						onHide: function (colpkr) {
							jQuery(colpkr).fadeOut(500);
							return false;
						},
						onChange: function (hsb, hex, rgb) {
							jQuery("#',$id,' div").css("backgroundColor", "#" + hex);
							jQuery("#',$id,'").next("input").attr("value","#" + hex);
							jQuery("#',$id,'").val("#" + hex);
						}
					});
				});
				</script>';
				echo '<th scope="row">',$name,'<span class="info">',$info,'</span></th>';
				echo '<td><div class="meta_page_selectwrap"><input class="color" type="text" name="', $id, '" id="', $id, '" value="', $std, '" size="', $inputsize, '" /><div id="', $id, '" class="wpcolorSelector"><div></div></div></div></td>';
				break;
	
		case 'text':
				$inputsize = isset($inputsize) ? $inputsize : '10';
				echo '<th scope="row">',$name,'<span class="info">',$info,'</span></th>';
				echo '<td><input type="text" name="', $id, '" id="', $id, '" value="', $std, '" size="', $inputsize, '" /> <span class="desc">', $desc,'</span></td>';
				break;
		case 'text_rm':
				$inputsize = isset($inputsize) ? $inputsize : '10';
				echo '<th scope="row">',$name,'<span class="info">',$info,'</span></th>';
				echo '<td><input type="text" name="', $id, '" id="', $id, '" value="', $std, '" size="', $inputsize, '" /><span class="button-primary staff_delete">remove</span><span class="desc">', $desc,'</span></td>';
				break;
		case 'textarea':
				echo '<th scope="row">',$name,'<span class="info">',$info,'</span></th>';
				echo '<td><textarea name="', $id, '" id="', $id, '" cols="60" rows="4" style="width:300px"></textarea><span class="desc">', $desc,'</span></td>';
				break;
		case 'select':
				echo '<th scope="row">',$name,'<span class="info">',$info,'</span></th>';
				echo '<td><div class="meta_page_selectwrap"><div class=""><select  name="', $id, '" id="', $id, '" class="">';
				foreach ( $ivaoptions as $optionkey => $option ) {
					echo '<option value="',$optionkey,'">', $option, '</option>';
				}
				echo '</select></div></div> <span class="desc">', $desc,'</span></td>';
				break;
		case 'optgroupselect':
				echo '<th scope="row">',$name,'<span class="info">',$info,'</span></th>';
				echo '<td><div class="meta_page_selectwrap"><div class="', $id, '"><select  name="', $id, '" id="', $id, '">';
				foreach ( $ivaoptions as $optiongroupkey => $optiongroup ) {
				 echo '<optgroup label="'.$optiongroupkey.'">';
					foreach( $optiongroup as $optionkey => $option ) {
					
					echo '<option value="',$optionkey,'">', $option, '</option>';
					}
				echo '</optgroup>';
				}
				echo '</select></div></div> <span class="desc">', $desc,'</span></td>';
				break;
		case 'multiselect':           
				echo '<th scope="row">',$name,'<span class="info">',$info,'</span></th>';
				echo '<td><div class="', $id, '"><select style="width:300px; height:auto;" multiple="multiple" name="', $id, '[]" id="', $id, '">';	
				foreach ($ivaoptions as $optionkey => $option) {
					echo '<option value="',$optionkey,'">', $option, '</option>';
				}
				echo '</select> <span class="desc">', $desc,'</span></td>';
				break;
		
		case 'checkbox':
				echo '<th scope="row">',$name,'<span class="info">',$info,'</span></th>';
				echo '<td><input class="iva-button" type="checkbox" value="',$std,'" name="', $id, '" id="', $id, '"', $std ? ' checked="checked"' : '', ' />';
				echo '<span class="desc">', $desc,'</span></td>';
				break;
		case 'progressbar':
				echo '<th scope="row">',$name,'<span class="info">',$info,'</span></th>';
				echo '<td>'; ?>
				<div id="circleWrap">
					<div class="CircleCount">
						<div><span>Title: </span> <input type="text" name="title" class="title" id="title"></div>
						<div><span>Percent: </span> <input type="text" name="percent" class="percent" id="percent"></div>
						<div><span>Color: </span> <input class="color" name="color" type="text" class="skill-title color"  name="<?php echo  $id; ?>" id="<?php echo  $id; ?>" value="" size="<?php echo $inputsize; ?>" /><div  class="colorSelector"><div ></div></div></br></div>
						<a href="#" class="close button button-primary button-large">Remove</a>	
					</div>
				</div>
				<a href="#" id="add-progressbar" class="add button button-primary button-large"><?php _e('Add More', ''); ?></a>
			
				<?php
				echo '<span class="desc">', $desc,'</span></td>';
				break;
		case 'radio':
				echo '<th scope="row">',$name,'<span class="info">',$info,'</span></th><td>';
				foreach  ($ivaoptions as $key =>$value ) {
					echo '<label for="', $key,'">', $value,'</label><input class="iva-button rb_align" type="radio" id="', $key, '" name="', $id, '" value="', $key, '"/>';	
				}
				echo '</td>';
				break;
		case 'pattern_bg':
				  echo '<th scope="row">',$name,'<span class="info">',$info,'</span></th><td>';
				  $i = 0;
				  foreach ( $ivaoptions as $key => $value ) {
				   $i++;
				   echo '<input value="'.$key.'"  class="checkbox atp-radio-img-radio" type="radio" id="', $id,$i,'" name="', $id,'"/>';
				   echo '<img width="35" src="'.$value.'" alt="" class="atp-radio-option" onClick="document.getElementById(\''. $id.$i.'\').checked = true;" />';
				  }
				  echo '</td>';
				  break;
		case 'separator':
				echo '<th scope="row" class="sc_separator"></th>';
				echo '<td class="sc_separator"></td>';
				break;
	}
}
?>