<?php
/**
 * blogera functions and definitions
 *
 * @package Blogera
 */

if ( ! function_exists( 'blogera_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function blogera_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on blogera, use a find and replace
	 * to change 'blogera' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'blogera', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );
	
	/*
	 * Enable support for custom logo.
	 *
	 * @link https://developer.wordpress.org/reference/functions/add_theme_support/#custom-logo
	 */
	add_theme_support( 'custom-logo', array(
		'height'      => 120,
		'width'       => 488,
		'flex-width'  => true,
		'flex-height' => true,
		'header-text' => array( 'site-title', 'site-description' ),
	) );
	
	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	
	/*
	 * Custom image sizes
	 */
	add_image_size( 'blogera-featured-slider', 1300, 500, true );
	add_image_size( 'blogera-blog-thumb', 810, 466, true );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'blogera' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	//$primary_color = esc_attr( get_theme_mod( 'primary_color' ) );
	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'blogera_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	
	add_theme_support( 'woocommerce' );
}
endif; // blogera_setup
add_action( 'after_setup_theme', 'blogera_setup' );

/**
 * Sets the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function blogera_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'blogera_content_width', 840 );
}
add_action( 'after_setup_theme', 'blogera_content_width', 0 );


/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function blogera_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'blogera' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer One', 'blogera' ),
		'id'            => 'footer-one',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Two', 'blogera' ),
		'id'            => 'footer-two',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Three', 'blogera' ),
		'id'            => 'footer-three',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Four', 'blogera' ),
		'id'            => 'footer-four',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title title-font">',
		'after_title'   => '</h1>',
	) );

}
add_action( 'widgets_init', 'blogera_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function blogera_scripts() {
	wp_enqueue_style( 'blogera-fonts', blogera_fonts_url(), array(), null );
	wp_enqueue_style( 'blogera-slick', get_template_directory_uri() . '/assets/css/slick.css', array());
	wp_enqueue_style( 'blogera-genericons', get_template_directory_uri() . '/assets/fonts/genericons/genericons.css', array(), '3.4.1' );
	wp_enqueue_style( 'blogera-style', get_stylesheet_uri() );

	//We don't need to prefix owl-carousel to avoid duplicate load just like genericons.
	wp_enqueue_script( 'blogera-slick', get_template_directory_uri() . '/assets/js/slick.js', array('jquery'), true );
	wp_enqueue_script( 'blogera-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), '20161025', true );
	wp_enqueue_script( 'blogera-themejs', get_template_directory_uri() . '/assets/js/theme.js', array( 'jquery' ), '20161025', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	
	if ( function_exists( 'blogera_get_custom_style' ) ) {
        wp_add_inline_style( 'blogera-style', blogera_get_custom_style() );
    }
	
	wp_localize_script( 'blogera-themejs', 'screenReaderText', array(
		'expand'   => __( 'expand child menu', 'blogera' ),
		'collapse' => __( 'collapse child menu', 'blogera' ),
	) );
}
add_action( 'wp_enqueue_scripts', 'blogera_scripts' );



if ( ! function_exists( 'blogera_fonts_url' ) ) :
/**
* Register Google fonts.
* Create your own blogera_fonts_url() function to override in a child theme.
*/
function blogera_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	/* translators: If there are characters in your language that are not supported by Open Sans, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Open Sans font: on or off', 'blogera' ) ) {
		$fonts[] = 'Open Sans:300,300i,400,400i,600,600i,700,700i';
	}
	
	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), 'https://fonts.googleapis.com/css' );
	}

	return $fonts_url;
}
endif;

/**
 * Date display functions
 *
 */
if ( ! function_exists( 'blogera_date_display' ) ) :

    function blogera_date_display( $format = 'l, F j, Y') {
        echo esc_html( date_i18n( $format ,current_time( 'timestamp' ) ) );
    }

endif;

/*
** Customizer Controls 
*/
if (class_exists('WP_Customize_Control')) {
	class blogera_WP_Customize_Category_Control extends WP_Customize_Control {
        /**
         * Render the control's content.
         */
        public function render_content() {
            $dropdown = wp_dropdown_categories(
                array(
                    'name'              => '_customize-dropdown-categories-' . $this->id,
                    'echo'              => 0,
                    'show_option_none'  => __( '&mdash; Select &mdash;', 'blogera' ),
                    'option_none_value' => '0',
                    'selected'          => $this->value(),
                )
            );
 
            $dropdown = str_replace( '<select', '<select ' . $this->get_link(), $dropdown );
 
            printf(
                '<label class="customize-control-select"><span class="customize-control-title">%s</span> %s</label>',
                $this->label,
                $dropdown
            );
        }
    }
}  

/**
 * Wrap widget category post count in span
 */
add_filter('wp_list_categories', 'blogera_cat_count_span');
function blogera_cat_count_span( $links ) {
	 $links = str_replace('</a> (', '</a> <span>(', $links);
	 $links = str_replace(')', ')</span>', $links);
	 return $links;
}

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';




