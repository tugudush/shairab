<?php
/**
 * The template for displaying all single posts.
 *
 * @package llorix-one-lite
 */

get_header(); ?>

	</div>
	<!-- /END COLOR OVER IMAGE -->
</header>
<!-- /END HOME / HEADER  -->

<div class="content-wrap">
	<div class="container">

		<div id="primary" class="content-area col-md-12">
			<main itemscope itemtype="http://schema.org/WebPageElement" itemprop="mainContentOfPage" id="main" class="site-main" role="main">

			<?php
			while ( have_posts() ) :
the_post();
?>

				<?php get_template_part( 'content', 'single-download' ); ?>

			<?php
			endwhile; // end of the loop.
			?>

			</main><!-- #main -->
		</div><!-- #primary -->

	</div>
</div><!-- .content-wrap -->

<?php get_footer(); ?>
