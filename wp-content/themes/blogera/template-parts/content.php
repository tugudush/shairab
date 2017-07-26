<?php
/**
 * The template part for displaying content
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Blogera
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('post_list'); ?>>
  <?php blogera_post_thumbnail();?>
  <div class="post_content_area">
    <div class="post_content_box">
      <header class="entry-header">
        <?php blogera_entry_meta(0, 1 , 0, 0, 0, 0); ?>
        
        <h2 class="entry-title">
		<?php if ( is_sticky() && is_home() && ! is_paged() ) : ?>
        <i class="fa fa-star sticky-post" aria-hidden="true"></i>
        <?php endif; ?>
		<?php the_title( sprintf( '<a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a>' ); ?></h2>
        
        <div class="entry_meta">
          <?php blogera_entry_meta(1, 0 , 0, 1, 0, 0); ?>
        </div>
      </header>
      <!-- .entry-header -->
      
      <div class="entry-content">
        <?php
			the_excerpt();

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
