<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Blogera
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<a class="skip-link screen-reader-text" href="#main">
<?php esc_html_e( 'Skip to content', 'blogera' ); ?>
</a>
<header id="masthead" class="site-header" role="banner">
  <div class="site-topbar">
    <div class="site-wrapper">
      <?php get_template_part('header', 'contact'); ?>
    </div>
  </div>
  <div class="site-header-main">
    <div class="site-wrapper">
      <div class="site-branding">
        <?php 
		if ( function_exists( 'has_custom_logo' ) && has_custom_logo() ) :
		the_custom_logo(); ?>
        <p class="site-description">
          <?php bloginfo( 'description' ); ?>
        </p>
        <?php
        else :
			if ( is_front_page() ) : ?>
        <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
          <?php bloginfo( 'name' ); ?>
          </a></h1>
        <?php else : ?>
        <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
          <?php bloginfo( 'name' ); ?>
          </a></p>
        <?php endif; ?>
        <p class="site-description">
          <?php bloginfo( 'description' ); ?>
        </p>
        <?php endif; ?>
      </div>
      <!-- .site-branding --> 
    </div>
  </div>
  <!-- .site-header-main -->
  <div class="site-navigation-bar">
    <div class="site-wrapper">
      <div class="row">
        <div class="col-2 social_box">
          <?php //social Icon
		 get_template_part('social', 'header'); ?>
        </div>
        <div class="col-8">
          <div class="navigation-menu-area">
            <?php if ( has_nav_menu( 'primary' ) ) : ?>
            <button id="menu-toggle" class="menu-toggle">
            <?php _e( 'Menu', 'blogera' ); ?>
            </button>
            <div id="site-header-menu" class="site-header-menu">
              <?php if ( has_nav_menu( 'primary' ) ) : ?>
              <nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'blogera' ); ?>">
                <?php
                        wp_nav_menu( array(
                            'theme_location' => 'primary',
                            'menu_class'     => 'primary-menu',
                         ) );
                    ?>
              </nav>
              <!-- .main-navigation -->
              <?php endif; ?>
            </div>
            <!-- .site-header-menu -->
            <?php endif; ?>
          </div>
        </div>
        <div class="col-2 search_box">
          <div class="navigation-area-search">
            <form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
              <input type="text" name="s" id="search" value="<?php the_search_query(); ?>" placeholder="<?php esc_html_e('Type and hit enter...', 'blogera') ?>" />
              <span class="genericon genericon-search"></span>
            </form>
          </div>
        </div>
      </div>
      <!--.row--> 
    </div>
  </div>
</header>
<?php get_template_part('slider', 'postthumb' ); ?>
<div id="content" class="site-content">
<div class="site-wrapper">
<div class="row">
