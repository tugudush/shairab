<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Blogera
 */

?>
</div>
</div>
</div>
<!-- .site-content -->

<footer id="colophon" class="site-footer" role="contentinfo">
  <?php
            if(
                is_active_sidebar( 'footer-one' ) ||
                is_active_sidebar( 'footer-two' ) ||
                is_active_sidebar( 'footer-three' ) ||
				is_active_sidebar( 'footer-four' )
            ){
                ?>
  <div class="footer-top">
    <div class="site-wrapper">
      <div class="footer-columns row">
        <?php if( is_active_sidebar( 'footer-one' ) ) : ?>
        <div class="footer-sidebar col-3">
          <?php dynamic_sidebar( 'footer-one' ); ?>
        </div>
        <?php endif; ?>
        <?php if( is_active_sidebar( 'footer-two' ) ) : ?>
        <div class="footer-sidebar col-3">
          <?php dynamic_sidebar( 'footer-two' ); ?>
        </div>
        <?php endif; ?>
        <?php if( is_active_sidebar( 'footer-three' ) ) : ?>
        <div class="footer-sidebar col-3">
          <?php dynamic_sidebar( 'footer-three' ); ?>
        </div>
        <?php endif; ?>
        <?php if( is_active_sidebar( 'footer-four' ) ) : ?>
        <div class="footer-sidebar col-3">
          <?php dynamic_sidebar( 'footer-four' ); ?>
        </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
  <!-- #foter-top -->
  
  <?php } ?>
  <div class="footer-copyright">
    <div class="site-wrapper">
      <div class="site-info">
        <p> <?php printf( esc_html__( 'Copyright &copy; %1$s %2$s. All Rights Reserved. Blogera by ZOLO Themes', 'blogera' ), date('Y'), get_bloginfo( 'name' ) ); ?></p>
      </div>
      <!-- .site-info --> 
      
    </div>
  </div>
</footer>
<!-- .site-footer -->
<?php wp_footer(); ?>
</body></html>