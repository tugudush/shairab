<?php
/**
 * The template part for displaying single posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Blogera
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('post_list'); ?>>
  <?php blogera_post_thumbnail(); ?>
  <div class="post_content_area">
    <div class="post_content_box">
      <header class="entry-header">
        <?php blogera_entry_meta(0, 1 , 0, 0, 0, 0); ?>
        <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
        <div class="entry_meta">
          <?php blogera_entry_meta(1, 0 , 0, 1, 0, 0); ?>
        </div>
      </header>
      <!-- .entry-header -->
      
      <div class="entry-content">
        <?php
			the_content();

			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'blogera' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'blogera' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );

		?>
      </div>
      <!-- .entry-content --> 
    </div>
  </div>
  <footer class="entry-footer entry_meta">
    <?php blogera_entry_meta(0, 0 , 1, 0, 1, 1); ?>
  </footer>
</article>
<!-- #post-## -->

<?php if ( '' !== get_the_author_meta( 'description' ) ) {
				get_template_part( 'template-parts/biography' );
			}?>
