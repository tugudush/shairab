<?php
/**
 * The template part for displaying results in search pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Blogera
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('post_list'); ?>>
  <div class="post_content_area">
    <div class="post_content_box">
      <header class="entry-header">
        <?php if ( 'post' === get_post_type() ) : ?>
        <?php blogera_entry_meta(0, 1 , 0, 0, 0, 0); ?>
        <?php endif; ?>
 		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
        <div class="entry_meta">
          <?php blogera_entry_meta(1, 0 , 0, 1, 0, 0); ?>
        </div>
      </header>
      <div class="entry-content">
        <?php blogera_excerpt(); ?>
      </div>
    </div>
  </div>
  <?php if ( 'post' === get_post_type() ) : ?>
  <footer class="entry-footer entry_meta">
    <?php blogera_entry_meta(0, 0 , 1, 0, 1, 1); ?>
  </footer>
  <?php else : ?>
  <footer class="entry-footer entry_meta">
    <?php blogera_entry_meta(0, 0 , 0, 0, 0, 1); ?>
  </footer>
  <?php endif; ?>
</article>
<!-- #post-## -->

