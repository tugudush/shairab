<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Blogera
 */

get_header(); ?>

<div class="col-8">
	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'blogera' ), '<span>' . esc_html( get_search_query() ) . '</span>' ); ?></h1>
			</header><!-- .page-header -->
			<?php
			// Start the loop.
			while ( have_posts() ) : the_post(); 
				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'search' );
			 // End the loop.
			endwhile;?>
            
			<?php // Previous/next page navigation.
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

		</main><!-- .site-main -->
	</section><!-- .content-area -->
</div>
<?php
get_sidebar();
get_footer();
