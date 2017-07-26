<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Blogera
 */


get_header(); ?>
<div class="col-8">
  <div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
      <?php if ( have_posts() ) : ?>
      <header class="page-header">
        		<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="taxonomy-description">', '</div>' );
				?>
      </header>
      <!-- .page-header -->
      
      <?php
			// Start the Loop.
			while ( have_posts() ) : the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_format() );

			// End the loop.
			endwhile;

			// Previous/next page navigation.
			the_posts_pagination( array(
				'mid_size' => 2,
				'prev_text'          => __( '&laquo;', 'blogera' ),
				'next_text'          => __( '&raquo;', 'blogera' ),
			) );

		// If no content, include the "No posts found" template.
		else :
			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>
    </main>
    <!-- .site-main --> 
  </div>
  <!-- .content-area --> 
</div>
<?php
get_sidebar();
get_footer();

