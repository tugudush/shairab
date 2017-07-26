<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Blogera
 */

get_header(); ?>

<div class="col-8">
  <div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
      <section class="error-404 not-found">
        <header class="page-header">
          <h1 class="page-title">
            <?php _e( 'Oops! That page can&rsquo;t be found.', 'blogera' ); ?>
          </h1>
        </header>
        <!-- .page-header -->
        
        <div class="page-content">
          <p>
            <?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'blogera' ); ?>
          </p>
          <?php get_search_form(); ?>
        </div>
        <!-- .page-content --> 
      </section>
      <!-- .error-404 --> 
      
    </main>
    <!-- .site-main --> 
    
  </div>
  <!-- .content-area --> 
</div>
<?php
get_sidebar();
get_footer();

