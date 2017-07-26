<?php
/**
 * Blogera Theme Customizer.
 *
 * @package Blogera
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function blogera_customize_register( $wp_customize ) {
	

	// Custom WP default control & settings.
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

    /*------------------------------------------------------------------------*/
	
	//Logo Settings
	$wp_customize->add_section( 'title_tagline' , array(
	    'title'      => __( 'Title, Tagline & Logo', 'blogera' ),
	    'priority'   => 30,
	) );
	
	// Header Area
	$wp_customize->add_section('heder_sec',array(
		'title'	=> __('Top Bar Contact','blogera'),
		'description' => '',				
		'priority'		=> 31,
	));
	
	$wp_customize->add_setting('head_email',array(
		'default'	=> 'info@blogera.com',
		'sanitize_callback'	=> 'sanitize_email'	
	));
	$wp_customize->add_control('head_email',array(
		'label'	=> __('Add header email here','blogera'),
		'section'	=> 'heder_sec',
		'setting'	=> 'head_email'
	));	
	
	$wp_customize->add_setting('head_number',array(
		'default'	=> '0978 456 321',
		'sanitize_callback'	=> 'sanitize_text_field'	
	));
	$wp_customize->add_control('head_number',array(
		'label'	=> __('Add header phone number here','blogera'),
		'section'	=> 'heder_sec',
		'setting'	=> 'head_number'
	));	
	
	// Social Icons
	$wp_customize->add_section('blogera_social_section', array(
			'title' => __('Social Icons','blogera'),
			'priority' => 32 ,
	));
	
	$social_networks = array( //Redefinied in Sanitization Function.
					'none' => __('-','blogera'),
					'facebook-alt' => __('Facebook','blogera'),
					'twitter' => __('Twitter','blogera'),
					'googleplus' => __('Google Plus','blogera'),
					'instagram' => __('Instagram','blogera'),
					'feed' => __('RSS Feeds','blogera'),
					'vimeo' => __('Vimeo','blogera'),
					'youtube' => __('Youtube','blogera'),
					'flickr' => __('Flickr','blogera'),
				);
				
	$social_count = count($social_networks);
				
	for ($x = 1 ; $x <= ($social_count - 1) ; $x++) :
			
		$wp_customize->add_setting(
			'blogera_social_'.$x, array(
				'sanitize_callback' => 'blogera_sanitize_social',
				'default' => 'none'
			));

		$wp_customize->add_control( 'blogera_social_'.$x, array(
					'settings' => 'blogera_social_'.$x,
					'label' => __('Icon ','blogera').$x,
					'section' => 'blogera_social_section',
					'type' => 'select',
					'choices' => $social_networks,			
		));
		
		$wp_customize->add_setting(
			'blogera_social_url'.$x, array(
				'sanitize_callback' => 'esc_url_raw'
			));

		$wp_customize->add_control( 'blogera_social_url'.$x, array(
					'settings' => 'blogera_social_url'.$x,
					'description' => __('Icon ','blogera').$x.__(' Url','blogera'),
					'section' => 'blogera_social_section',
					'type' => 'url',
					'choices' => $social_networks,			
		));
		
	endfor;
	
	function blogera_sanitize_social( $input ) {
		$social_networks = array(
					'none' ,
					'facebook-alt',
					'twitter',
					'googleplus',
					'instagram',
					'feed',
					'vimeo',
					'youtube',
					'flickr'
				);
		if ( in_array($input, $social_networks) )
			return $input;
		else
			return '';	
	}
	
	// Primary color setting and control.
	$wp_customize->add_setting( 'primary_color', array(
		'default'           => '#00b9ed',
		'sanitize_callback' => 'sanitize_hex_color',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'primary_color', array(
		'label'       => __( 'Primary Color', 'blogera' ),
		'section'     => 'colors',
	) ) );

	// Add main text color setting and control.
	$wp_customize->add_setting( 'main_text_color', array(
		'default'           => '#3e3e3e',
		'sanitize_callback' => 'sanitize_hex_color',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'main_text_color', array(
		'label'       => __( 'Main Text Color', 'blogera' ),
		'section'     => 'colors',
	) ) );
	
	
	// Featured Post Slider 
	$wp_customize->add_section( 'blogera_postslider', array(
		'title'     => __('Featured Posts Slider','blogera'),
		'priority'  => 35,
	) );
	
	$wp_customize->add_setting( 'blogera_postslider_enable', array( 
		'sanitize_callback' => 'blogera_sanitize_checkbox' 
	) );
	
	$wp_customize->add_control( 'blogera_postslider_enable', array(
		    'settings' => 'blogera_postslider_enable',
		    'label'    => __( 'Enable', 'blogera' ),
		    'section'  => 'blogera_postslider',
		    'type'     => 'checkbox',
	) );	
	
	$wp_customize->add_setting( 'blogera_postslider_cat', array( 
		'sanitize_callback' => 'blogera_sanitize_category' )
	);	
		
	$wp_customize->add_control( new blogera_WP_Customize_Category_Control(	$wp_customize,	'blogera_postslider_cat',	array(
		'label'    => __('Category For Featured Posts Slider','blogera'),
		'settings' => 'blogera_postslider_cat',
		'section'  => 'blogera_postslider'
	) )	);	



	function blogera_sanitize_checkbox( $input ){
		if ( $input == 1 || $input == 'true' || $input === true ) {
			return 1;
		} else {
			return 0;
		}
	}
	function blogera_sanitize_category( $input ) {
			if ( term_exists(get_cat_name( $input ), 'category') )
				return $input;
			else 
				return '';	
	}


}
add_action( 'customize_register', 'blogera_customize_register' );



/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function blogera_customize_preview_js() {
	wp_enqueue_script( 'blogera_customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), '20161025', true );
}
add_action( 'customize_preview_init', 'blogera_customize_preview_js' );
