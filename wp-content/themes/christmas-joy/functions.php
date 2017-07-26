<?php
/**
 * @package    ChristmasJoy
 * @version    1.0.0
 * @author     Jenny Ragan <jenny@jennyragan.com>
 * @copyright  Copyright (c) 2013, Jenny Ragan
 * @link       http://themehybrid.com/themes/christmas-joy
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

/* Add the child theme setup function to the 'after_setup_theme' hook. */
add_action( 'after_setup_theme', 'christmas_joy_theme_setup' );

/**
 * Setup function. 
 *
 * @since  0.1.0
 * @access public
 * @return void
 */
function christmas_joy_theme_setup() {

	/*
	 * Add a custom background to overwrite the defaults.
	 *
	 * @link http://codex.wordpress.org/Custom_Backgrounds
	 */
	add_theme_support(
		'custom-background',
		array(
			'default-color' => '8d8f57', // c7ac90
			'default-image' => '',
		)
	);

	/*
	 * Add a custom header to overwrite the defaults.  
	 *
	 * @link http://codex.wordpress.org/Custom_Headers
	 */
	add_theme_support( 
		'custom-header', 
		array(
			'default-text-color' => '4c463e',
			'default-image'      => '%2$s/images/headers/christmas-tree.jpg',
			'random-default'     => false,
		)
	);

	/* Registers default headers for the theme. */
	register_default_headers(
		array(
			'christmas-joy-1' => array(
				'url'           => '%2$s/images/headers/christmas-tree.jpg',
				'thumbnail_url' => '%2$s/images/headers/christmas-tree-thumb.jpg',
				/* Translators: Header image description. */
				'description'   => __( 'Christmas Joy default header', 'christmas-joy' )
			)
		)
	);


	/* Add a custom default color for the "primary" color option. */
	add_filter( 'theme_mod_color_primary', 'christmas_joy_color_primary' );

	/* register custom fonts */
	add_action( 'wp_enqueue_scripts', 'christmas_joy_styles' );
}

/**
 * Add a default custom color for the theme's "primary" color option.
 *
 * @since  0.1.0
 * @access public
 * @param  string  $hex
 * @return string
 */
function christmas_joy_color_primary( $hex ) {
	return $hex ? $hex : 'c4555c';
}

/**
 * Registers google fonts for the front end.
 *
 * @since  0.1.0
 * @access public
 * @return void
 */
function christmas_joy_styles() {
	wp_enqueue_style( 
		'christmas-joy-fonts',
		'//fonts.googleapis.com/css?family=Old+Standard+TT:400,400italic,700'
	);
}