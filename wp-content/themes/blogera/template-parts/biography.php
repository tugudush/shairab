<?php
/**
 * The template part for displaying an Author biography
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Blogera
 */
?>

<div class="author-info box_design">
	<div class="author-avatar">
		<?php
		/**
		 * Filter the Blogera author bio avatar size.
		 *
		 */
		$author_bio_avatar_size = apply_filters( 'blogera_author_bio_avatar_size', 50 );

		echo get_avatar( get_the_author_meta( 'user_email' ), $author_bio_avatar_size );
		?>
	</div><!-- .author-avatar -->

	<div class="author-description">
		<h2 class="author-title"><a class="author-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author"><?php echo get_the_author(); ?></a></h2>

		<p class="author-bio">
			<?php the_author_meta( 'description' ); ?>
		</p><!-- .author-bio -->
	</div><!-- .author-description -->
</div><!-- .author-info -->
