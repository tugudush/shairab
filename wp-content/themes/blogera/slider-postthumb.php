<?php if (get_theme_mod('blogera_postslider_enable') && is_front_page() ) : 
    $args = array( 
        'post_type' => 'post',
        'posts_per_page' => 4, 
        'cat' =>  esc_html( get_theme_mod('blogera_postslider_cat',0) ) ,
        'ignore_sticky_posts' => true,
        
    );
    ?>

<div class="featured_post_slider slider">
  <?php  
        $loop = new WP_Query( $args );
        $i = 1;
        while ( $loop->have_posts() ) : $loop->the_post();  
		$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'blogera-featured-slider' );
		?>
  <div class="featured_post_item">
    <div class="featured_post_bg" style="background-image: url('<?php echo $image[0]; ?>');">
      <div class="post_slider_caption">
        <?php blogera_entry_meta(0, 1 , 0, 0, 0, 0); ?>
        <?php 
		if ( get_the_title() != '' ) echo '<h2 class="entry-title"><a href="' . get_permalink() . '">'. get_the_title().'</a></h2>';
		echo '<div class="entry_meta">';
		blogera_entry_meta(1, 0 , 0, 1, 1, 0);
		echo '</div>';
		?>
      </div>
    </div>
  </div>
  <?php
        $i++;
        endwhile;
        wp_reset_query(); ?>
</div>
<?php 
wp_reset_postdata(); 
endif; 
?>
