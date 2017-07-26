<?php
add_action( 'after_setup_theme', 'et_setup_theme' );
if ( ! function_exists( 'et_setup_theme' ) ){
	function et_setup_theme(){
		global $themename, $shortname, $et_store_options_in_one_row, $default_colorscheme;
		$themename = 'Lucid';
		$shortname = 'lucid';
		$et_store_options_in_one_row = true;

		$default_colorscheme = "Default";

		$template_directory = get_template_directory();

		require_once( $template_directory . '/epanel/custom_functions.php' );

		require_once( $template_directory . '/includes/functions/comments.php' );

		require_once( $template_directory . '/includes/functions/sidebars.php' );

		load_theme_textdomain( 'Lucid', $template_directory . '/lang' );

		require_once( $template_directory . '/epanel/core_functions.php' );

		require_once( $template_directory . '/epanel/post_thumbnails_lucid.php' );

		include( $template_directory . '/includes/widgets.php' );

		require_once( $template_directory . '/includes/additional_functions.php' );

		add_action( 'init', 'et_register_main_menus' );

		add_action( 'wp_enqueue_scripts', 'et_load_lucid_scripts' );

		add_action( 'wp_enqueue_scripts', 'et_add_google_fonts' );

		add_action( 'wp_head', 'et_add_viewport_meta' );

		add_action( 'pre_get_posts', 'et_home_posts_query' );

		add_action( 'et_epanel_changing_options', 'et_delete_featured_ids_cache' );
		add_action( 'delete_post', 'et_delete_featured_ids_cache' );
		add_action( 'save_post', 'et_delete_featured_ids_cache' );

		add_filter( 'wp_page_menu_args', 'et_add_home_link' );

		add_filter( 'et_get_additional_color_scheme', 'et_remove_additional_stylesheet' );

		add_theme_support( 'post-formats', array( 'video' ) );

		add_filter( 'body_class', 'et_sidebar_left_class' );

		add_action( 'wp_head', 'et_color_schemes_styles' );

		add_action( 'et_header_menu', 'et_add_mobile_navigation' );

		add_action( 'et_secondary_menu', 'et_add_secondary_mobile_navigation' );

		add_action( 'wp_enqueue_scripts', 'et_add_responsive_shortcodes_css', 11 );
	}
}

function et_register_main_menus() {
	register_nav_menus(
		array(
			'primary-menu' => __( 'Primary Menu', 'Lucid' ),
			'secondary-menu' => __( 'Secondary Menu', 'Lucid' ),
			'footer-menu' => __( 'Footer Menu', 'Lucid' )
		)
	);
}

function et_add_home_link( $args ) {
	// add Home link to the custom menu WP-Admin page
	$args['show_home'] = true;
	return $args;
}

function et_sidebar_left_class( $body_classes ){
	global $post;

	if ( is_singular() && 'on' == get_post_meta( $post->ID, '_et_left_sidebar', true ) ) $body_classes[] = 'et_left_sidebar';

	if ( is_home() && 'on' == et_get_option( 'lucid_home_left_sidebar', 'false' ) ) $body_classes[] = 'et_left_sidebar';

	return $body_classes;
}

function et_add_mobile_navigation(){
	echo '<a href="#" class="mobile_nav closed">' . esc_html__( 'Pages Menu', 'Lucid' ) . '<span></span></a>';
}

function et_add_secondary_mobile_navigation(){
	echo '<a href="#" class="mobile_nav closed">' . esc_html__( 'Categories Menu', 'Lucid' ) . '<span></span></a>';
}

function et_color_schemes_styles(){
	$color_scheme = et_get_option( 'lucid_color_scheme', 'Orange' );
	$theme_folder = trailingslashit( get_template_directory_uri() );

	echo '<style>';
	if ( 'Orange' == $color_scheme ){
		echo "
		#featured .flex-direction-nav a:hover, #video-slider-section .flex-direction-nav a:hover { background-color: #ffb600; }
			#featured_section .active-slide .post-meta, #featured_section .switcher_hover .post-meta, .et_tab_link_hover .post-meta { background: #ffa500; }
			h3.main-title { background-color: #ffa500; -moz-box-shadow: inset 0 0 10px rgba(255,140,0,0.1); -webkit-box-shadow: inset 0 0 10px rgba(255,140,0,0.1); box-shadow: inset 0 0 10px rgba(255,140,0,0.1); border: 1px solid #ff8c00; }
				.widget li { background: url({$theme_folder}images/widget-bullet.png) no-repeat 24px 24px; }
				.footer-widget li { background: url({$theme_folder}images/widget-bullet.png) no-repeat 0 4px; }
				.et_mobile_menu li a { background-image: url({$theme_folder}images/widget-bullet.png); }
		a { color: #ffa300; }
		.et_video_play { background-color: #ffa500; }
		#second-menu > ul > li > a:hover { background-color: #ffa500; }
		#second-menu ul ul li a:hover { background-color: #ffb122; }
		#second-menu ul.nav li ul { background: #ffa500; }
		#second-menu ul ul li a { border-top: 1px solid #ffb122; }
		";
	} elseif ( 'Blue' == $color_scheme ){
		echo "
		#featured .flex-direction-nav a:hover, #video-slider-section .flex-direction-nav a:hover { background-color: #00befe; }
			#featured_section .active-slide .post-meta, #featured_section .switcher_hover .post-meta, .et_tab_link_hover .post-meta { background: #009cff; }
			h3.main-title { background-color: #009cff; -moz-box-shadow: inset 0 0 10px rgba(0,133,245,0.1); -webkit-box-shadow: inset 0 0 10px rgba(0,133,245,0.1); box-shadow: inset 0 0 10px rgba(0,133,245,0.1); border: 1px solid #0085f5; }
				.widget li { background: url({$theme_folder}images/widget-blue-bullet.png) no-repeat 24px 24px; }
				.footer-widget li { background: url({$theme_folder}images/widget-blue-bullet.png) no-repeat 0 4px; }
				.et_mobile_menu li a { background-image: url({$theme_folder}images/widget-blue-bullet.png); }
		a { color: #009cff; }
		.et_video_play { background-color: #009cff; }
		#second-menu > ul > li > a:hover { background-color: #009cff; -moz-box-shadow: inset 0 0 10px rgba(0,0,0,0.3); -webkit-box-shadow: inset 0 0 10px rgba(0,0,0,0.3); box-shadow: inset 0 0 10px rgba(0,0,0,0.3); }
		#second-menu ul ul li a:hover { background-color: #33b0ff; }
		#second-menu ul.nav li ul { background: #009cff; }
		#second-menu ul ul li a { border-top: 1px solid #33b0ff; }
		";
	} elseif ( 'Green' == $color_scheme ) {
		echo "
		#featured .flex-direction-nav a:hover, #video-slider-section .flex-direction-nav a:hover { background-color: #66e700; }
			#featured_section .active-slide .post-meta, #featured_section .switcher_hover .post-meta, .et_tab_link_hover .post-meta { background: #31d200; }
			h3.main-title { background-color: #31d200; -moz-box-shadow: inset 0 0 10px rgba(38,184,0,0.1); -webkit-box-shadow: inset 0 0 10px rgba(38,184,0,0.1); box-shadow: inset 0 0 10px rgba(38,184,0,0.1); border: 1px solid #26b800; }
				.widget li { background: url({$theme_folder}images/widget-green-bullet.png) no-repeat 24px 24px; }
				.footer-widget li { background: url({$theme_folder}images/widget-green-bullet.png) no-repeat 0 4px; }
				.et_mobile_menu li a { background-image: url({$theme_folder}images/widget-green-bullet.png); }
		a { color: #31d200; }
		.et_video_play { background-color: #31d200; }
		#second-menu > ul > li > a:hover { background-color: #31d200; -moz-box-shadow: inset 0 0 10px rgba(0,0,0,0.3); -webkit-box-shadow: inset 0 0 10px rgba(0,0,0,0.3); box-shadow: inset 0 0 10px rgba(0,0,0,0.3); }
		#second-menu ul ul li a:hover { background-color: #36e600; }
		#second-menu ul.nav li ul { background: #31d200; }
		#second-menu ul ul li a { border-top: 1px solid #36e600; }
		";
	} elseif ( 'Red' == $color_scheme ) {
		echo "
		#featured .flex-direction-nav a:hover, #video-slider-section .flex-direction-nav a:hover { background-color: #f00d0d; }
			#featured_section .active-slide .post-meta, #featured_section .switcher_hover .post-meta, .et_tab_link_hover .post-meta { background: #f00d0d; }
			h3.main-title { background-color: #f00d0d; -moz-box-shadow: inset 0 0 10px rgba(207,8,8,0.1); -webkit-box-shadow: inset 0 0 10px rgba(207,8,8,0.1); box-shadow: inset 0 0 10px rgba(207,8,8,0.1); border: 1px solid #cf0808; }
				.widget li { background: url({$theme_folder}images/widget-red-bullet.png) no-repeat 24px 24px; }
				.footer-widget li { background: url({$theme_folder}images/widget-red-bullet.png) no-repeat 0 4px; }
				.et_mobile_menu li a { background-image: url({$theme_folder}images/widget-red-bullet.png); }
		a { color: #f00d0d; }
		.et_video_play { background-color: #f00d0d; }
		#second-menu > ul > li > a:hover { background-color: #f00d0d; -moz-box-shadow: inset 0 0 10px rgba(0,0,0,0.3); -webkit-box-shadow: inset 0 0 10px rgba(0,0,0,0.3); box-shadow: inset 0 0 10px rgba(0,0,0,0.3); }
		#second-menu ul ul li a:hover { background-color: #f72b2b; }
		#second-menu ul.nav li ul { background: #f00d0d; }
		#second-menu ul ul li a { border-top: 1px solid #f72b2b; }
		";
	} elseif ( 'Purple' == $color_scheme ) {
		echo "
		#featured .flex-direction-nav a:hover, #video-slider-section .flex-direction-nav a:hover { background-color: #de3ef7; }
			#featured_section .active-slide .post-meta, #featured_section .switcher_hover .post-meta, .et_tab_link_hover .post-meta { background: #c30df0; }
			h3.main-title { background-color: #c30df0; -moz-box-shadow: inset 0 0 10px rgba(171,11,210,0.1); -webkit-box-shadow: inset 0 0 10px rgba(171,11,210,0.1); box-shadow: inset 0 0 10px rgba(171,11,210,0.1); border: 1px solid #ab0bd2; }
				.widget li { background: url({$theme_folder}images/widget-purple-bullet.png) no-repeat 24px 24px; }
				.footer-widget li { background: url({$theme_folder}images/widget-purple-bullet.png) no-repeat 0 4px; }
				.et_mobile_menu li a { background-image: url({$theme_folder}images/widget-purple-bullet.png); }
		a { color: #c30df0; }
		.et_video_play { background-color: #c30df0; }
		#second-menu > ul > li > a:hover { background-color: #c30df0; -moz-box-shadow: inset 0 0 10px rgba(0,0,0,0.3); -webkit-box-shadow: inset 0 0 10px rgba(0,0,0,0.3); box-shadow: inset 0 0 10px rgba(0,0,0,0.3); }
		#second-menu ul ul li a:hover { background-color: #cd29f6; }
		#second-menu ul.nav li ul { background: #c30df0; }
		#second-menu ul ul li a { border-top: 1px solid #cd29f6; }
		";
	}

	echo '</style>';
}

function et_load_lucid_scripts(){
	if ( !is_admin() ){
		$template_dir = get_template_directory_uri();

		wp_enqueue_script('superfish', $template_dir . '/js/superfish.js', array('jquery'), '1.0', true);
		wp_enqueue_script('flexslider', $template_dir . '/js/jquery.flexslider-min.js', array('jquery'), '1.0', true);
		wp_enqueue_script('fitvids', $template_dir . '/js/jquery.fitvids.js', array('jquery'), '1.0', true);
		wp_enqueue_script('custom_script', $template_dir . '/js/custom.js', array('jquery'), '1.0', true);
	}
	if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' );

	$et_gf_enqueue_fonts = array();
	$et_gf_heading_font = sanitize_text_field( et_get_option( 'heading_font', 'none' ) );
	$et_gf_body_font = sanitize_text_field( et_get_option( 'body_font', 'none' ) );

	if ( 'none' != $et_gf_heading_font ) $et_gf_enqueue_fonts[] = $et_gf_heading_font;
	if ( 'none' != $et_gf_body_font ) $et_gf_enqueue_fonts[] = $et_gf_body_font;

	if ( ! empty( $et_gf_enqueue_fonts ) ) et_gf_enqueue_fonts( $et_gf_enqueue_fonts );
}

function et_add_google_fonts(){
	wp_enqueue_style( 'google_font_open_sans', 'http://fonts.googleapis.com/css?family=Open+Sans:400,700,300' );
	wp_enqueue_style( 'google_font_open_sans_condensed', 'http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700' );
}

function et_add_viewport_meta(){
	echo '<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />';
}

function et_remove_additional_stylesheet( $stylesheet ){
	global $default_colorscheme;
	return $default_colorscheme;
}

/**
 * Gets featured posts IDs from transient, if the transient doesn't exist - runs the query and stores IDs
 */
function et_get_featured_posts_ids(){
	if ( false === ( $et_featured_post_ids = get_transient( 'et_featured_post_ids' ) ) ) {
		$featured_query = new WP_Query( apply_filters( 'et_featured_post_args', array(
			'posts_per_page'	=> (int) et_get_option( 'lucid_featured_num' ),
			'cat'				=> (int) get_catId( et_get_option( 'lucid_feat_posts_cat' ) )
		) ) );

		if ( $featured_query->have_posts() ) {
			while ( $featured_query->have_posts() ) {
				$featured_query->the_post();

				$et_featured_post_ids[] = get_the_ID();
			}

			set_transient( 'et_featured_post_ids', $et_featured_post_ids );
		}

		wp_reset_postdata();
	}

	return $et_featured_post_ids;
}

/**
 * Filters the main query on homepage
 */
function et_home_posts_query( $query = false ) {
	/* Don't proceed if it's not homepage or the main query */
	if ( ! is_home() || ! is_a( $query, 'WP_Query' ) || ! $query->is_main_query() ) return;

	/* Set the amount of posts per page on homepage */
	$query->set( 'posts_per_page', (int) et_get_option( 'lucid_homepage_posts', '6' ) );

	/* Exclude categories set in ePanel */
	$exclude_categories = et_get_option( 'lucid_exlcats_recent', false );
	if ( $exclude_categories ) $query->set( 'category__not_in', array_map( 'intval', et_generate_wpml_ids( $exclude_categories, 'category' ) ) );

	/* Exclude slider posts, if the slider is activated, pages are not featured and posts duplication is disabled in ePanel  */
	if ( 'on' == et_get_option( 'lucid_featured', 'on' ) && 'false' == et_get_option( 'lucid_use_pages', 'false' ) && 'false' == et_get_option( 'lucid_duplicate', 'on' ) )
		$query->set( 'post__not_in', et_get_featured_posts_ids() );
}

/**
 * Deletes featured posts IDs transient, when the user saves, resets ePanel settings, creates or moves posts to trash in WP-Admin
 */
function et_delete_featured_ids_cache(){
	if ( false !== get_transient( 'et_featured_post_ids' ) ) delete_transient( 'et_featured_post_ids' );
}

if ( ! function_exists( 'et_list_pings' ) ){
	function et_list_pings($comment, $args, $depth) {
		$GLOBALS['comment'] = $comment; ?>
		<li id="comment-<?php comment_ID(); ?>"><?php comment_author_link(); ?> - <?php comment_excerpt(); ?>
	<?php }
}

if ( ! function_exists( 'et_get_the_author_posts_link' ) ){
	function et_get_the_author_posts_link(){
		global $authordata, $themename;

		$link = sprintf(
			'<a href="%1$s" title="%2$s" rel="author">%3$s</a>',
			esc_url( get_author_posts_url( $authordata->ID, $authordata->user_nicename ) ),
			esc_attr( sprintf( __( 'Posts by %s', $themename ), get_the_author() ) ),
			get_the_author()
		);
		return apply_filters( 'the_author_posts_link', $link );
	}
}

if ( ! function_exists( 'et_get_comments_popup_link' ) ){
	function et_get_comments_popup_link( $zero = false, $one = false, $more = false ){
		global $themename;

		$id = get_the_ID();
		$number = get_comments_number( $id );

		if ( 0 == $number && !comments_open() && !pings_open() ) return;

		if ( $number > 1 )
			$output = str_replace('%', number_format_i18n($number), ( false === $more ) ? __('% Comments', $themename) : $more);
		elseif ( $number == 0 )
			$output = ( false === $zero ) ? __('No Comments',$themename) : $zero;
		else // must be one
			$output = ( false === $one ) ? __('1 Comment', $themename) : $one;

		return '<span class="comments-number">' . '<a href="' . esc_url( get_permalink() . '#respond' ) . '">' . apply_filters('comments_number', $output, $number) . '</a>' . '</span>';
	}
}

if ( ! function_exists( 'et_postinfo_meta' ) ){
	function et_postinfo_meta( $postinfo, $date_format, $comment_zero, $comment_one, $comment_more ){
		global $themename;

		$postinfo_meta = '';

		if ( in_array( 'author', $postinfo ) ){
			$postinfo_meta .= ' ' . esc_html__('by',$themename) . ' ' . et_get_the_author_posts_link();
		}

		if ( in_array( 'date', $postinfo ) )
			$postinfo_meta .= ' ' . esc_html__('on',$themename) . ' ' . get_the_time( $date_format );

		if ( in_array( 'categories', $postinfo ) )
			$postinfo_meta .= ' ' . esc_html__('in',$themename) . ' ' . get_the_category_list(', ');

		if ( in_array( 'comments', $postinfo ) )
			$postinfo_meta .= ' | ' . et_get_comments_popup_link( $comment_zero, $comment_one, $comment_more );

		if ( '' != $postinfo_meta ) $postinfo_meta = __('Posted',$themename) . ' ' . $postinfo_meta;

		echo $postinfo_meta;
	}
}

function et_epanel_custom_colors_css(){
	global $shortname; ?>

	<style type="text/css">
		body { color: #<?php echo esc_html(et_get_option($shortname.'_color_mainfont')); ?>; }
		#content-area a { color: #<?php echo esc_html(et_get_option($shortname.'_color_mainlink')); ?>; }
		ul.nav li a { color: #<?php echo esc_html(et_get_option($shortname.'_color_pagelink')); ?> !important; }
		ul.nav > li.current_page_item > a, ul#top-menu > li:hover > a, ul.nav > li.current-cat > a { color: #<?php echo esc_html(et_get_option($shortname.'_color_pagelink_active')); ?>; }
		h1, h2, h3, h4, h5, h6, h1 a, h2 a, h3 a, h4 a, h5 a, h6 a { color: #<?php echo esc_html(et_get_option($shortname.'_color_headings')); ?>; }

		#sidebar a { color:#<?php echo esc_html(et_get_option($shortname.'_color_sidebar_links')); ?>; }
		.footer-widget { color:#<?php echo esc_html(et_get_option($shortname.'_footer_text')); ?> }
		#footer a, ul#bottom-menu li a { color:#<?php echo esc_html(et_get_option($shortname.'_color_footerlinks')); ?> }
	</style>

<?php }

if ( function_exists( 'get_custom_header' ) ) {
	// compatibility with versions of WordPress prior to 3.4

	add_action( 'customize_register', 'et_lucid_customize_register' );
	function et_lucid_customize_register( $wp_customize ) {
		$google_fonts = et_get_google_fonts();

		$font_choices = array();
		$font_choices['none'] = 'Default Theme Font';
		foreach ( $google_fonts as $google_font_name => $google_font_properties ) {
			$font_choices[ $google_font_name ] = $google_font_name;
		}

		$wp_customize->remove_section( 'title_tagline' );
		$wp_customize->remove_section( 'background_image' );
		$wp_customize->remove_section( 'colors' );

		$wp_customize->add_section( 'et_google_fonts' , array(
			'title'		=> __( 'Fonts', 'Lucid' ),
			'priority'	=> 50,
		) );

		$wp_customize->add_setting( 'et_lucid[heading_font]', array(
			'default'		=> 'none',
			'type'			=> 'option',
			'capability'	=> 'edit_theme_options'
		) );

		$wp_customize->add_control( 'et_lucid[heading_font]', array(
			'label'		=> __( 'Header Font', 'Lucid' ),
			'section'	=> 'et_google_fonts',
			'settings'	=> 'et_lucid[heading_font]',
			'type'		=> 'select',
			'choices'	=> $font_choices
		) );

		$wp_customize->add_setting( 'et_lucid[body_font]', array(
			'default'		=> 'none',
			'type'			=> 'option',
			'capability'	=> 'edit_theme_options'
		) );

		$wp_customize->add_control( 'et_lucid[body_font]', array(
			'label'		=> __( 'Body Font', 'Lucid' ),
			'section'	=> 'et_google_fonts',
			'settings'	=> 'et_lucid[body_font]',
			'type'		=> 'select',
			'choices'	=> $font_choices
		) );
	}

	add_action( 'wp_head', 'et_lucid_add_customizer_css' );
	add_action( 'customize_controls_print_styles', 'et_lucid_add_customizer_css' );
	function et_lucid_add_customizer_css(){ ?>
		<style>
		<?php
			$et_gf_heading_font = sanitize_text_field( et_get_option( 'heading_font', 'none' ) );
			$et_gf_body_font = sanitize_text_field( et_get_option( 'body_font', 'none' ) );

			if ( 'none' != $et_gf_heading_font || 'none' != $et_gf_body_font ) :

				if ( 'none' != $et_gf_heading_font )
					et_gf_attach_font( $et_gf_heading_font, 'h1, h2, h3, h4, h5, h6' );

				if ( 'none' != $et_gf_body_font )
					et_gf_attach_font( $et_gf_body_font, 'body' );

			endif;
		?>
		</style>
	<?php }

	add_action( 'customize_controls_print_footer_scripts', 'et_load_google_fonts_scripts' );
	function et_load_google_fonts_scripts() {
		wp_enqueue_script( 'et_google_fonts', get_template_directory_uri() . '/epanel/google-fonts/et_google_fonts.js', array( 'jquery' ), '1.0', true );
	}

	add_action( 'customize_controls_print_styles', 'et_load_google_fonts_styles' );
	function et_load_google_fonts_styles() {
		wp_enqueue_style( 'et_google_fonts_style', get_template_directory_uri() . '/epanel/google-fonts/et_google_fonts.css', array(), null );
	}
}