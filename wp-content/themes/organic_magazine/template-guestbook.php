<?php
/*
Template Name: Guestbook
*/
?>

<?php get_header(); ?>

<?php if ( has_post_thumbnail()) { ?>
	<div class="row">
		<div class="banner"><?php the_post_thumbnail( 'page' ); ?></div>
	</div>
<?php } ?>

<div id="content" class="row">

	<div class="eight columns">

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
	            
	            <p><?php edit_post_link(__("(Edit)", 'organicthemes'), '', ''); ?></p>
	            
            </div>
            
            <div class="postcomments">
            	<?php comments_template('',true); ?>
            </div>
            
            <?php endwhile; else: ?>
            
            <p><?php _e("Sorry, no posts matched your criteria.", 'organicthemes'); ?></p>
			
			<?php endif; ?>
            
        </div>
        
    </div>

    <div class="four columns">
    	<?php get_sidebar(); ?>
    </div>

</div>

<?php get_footer(); ?>