<?php
/*
Template Name: Slideshow
*/
?>

<?php get_header(); ?>

<!-- BEGIN .row -->
<div class="row">
	
	<!-- BEGIN #slideshow -->
	<div id="slideshow" class="slideshow-page">
		
		<!-- BEGIN .flexslider -->
		<div class="flexslider" data-speed="<?php echo of_get_option('transition_interval'); ?>">
			<!-- BEGIN .slides -->
			<ul class="slides">
					
				<?php $data = array(
			    	'post_parent'		=> $post->ID,
			    	'post_type' 		=> 'attachment',
			    	'post_mime_type' 	=> 'image',
			    	'order'         	=> 'ASC',
			    	'orderby'	 		=> 'menu_order',
			        'numberposts' 		=> -1
				); ?>
				
				<?php 
				$images = get_posts($data); foreach( $images as $image ) { 
					$imageurl = wp_get_attachment_url($image->ID);
					echo '<li><img src="'.$imageurl.'" /></li>' . "\n";
				} ?>
				
			<!-- END .slides -->
			</ul>
		<!-- END .flexslider -->
		</div>
	
	<!-- END #slideshow -->
	</div>

<!-- END .row -->
</div>

<?php if(of_get_option('display_slideshow_info') == '1') { ?>
	
<!-- BEGIN #content -->
<div id="content" class="row">

	<!-- BEGIN .twelve columns -->
	<div class="twelve columns">
		
		<div <?php post_class(); ?> id="page-<?php the_ID(); ?>">
	
	        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	        
	        <h1 class="headline page"><?php the_title(); ?></h1>
	        
	        <div class="article">
		        
		        <?php the_content(); ?>
		        
		        <?php wp_link_pages(array(
		            'before' => '<p class="page-links"><span class="link-label">' . __('Pages:') . '</span>',
		            'after' => '</p>',
		            'link_before' => '<span>',
		            'link_after' => '</span>',
		            'next_or_number' => 'next_and_number',
		            'nextpagelink' => __('Next'),
		            'previouspagelink' => __('Previous'),
		            'pagelink' => '%',
		            'echo' => 1 )
		        ); ?>
		        
		        <div class="clear"></div>
		        
		        <?php edit_post_link(__("(Edit)", 'organicthemes'), '', ''); ?>
		        
	        </div>
	        
	        <?php endwhile; else: ?>
	        
	        <p><?php _e("Sorry, no posts matched your criteria.", 'organicthemes'); ?></p>
	        
	        <?php endif; ?>
	        
	    </div>
	
	<!-- END .twelve columns -->
	</div>

<!-- END #content -->
</div>

<?php } ?>		

<?php get_footer(); ?>