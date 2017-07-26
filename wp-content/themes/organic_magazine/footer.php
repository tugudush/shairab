<div class="clear"></div>

</div> <!-- close container -->

<div class="footerwidgets">

	<div class="row">
        
            <div class="two columns">
				<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer Left') ) : ?> 
                <?php endif; ?>
            </div>
            
            <div class="two columns">
				<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer Mid Left') ) : ?>
                <?php endif; ?>
            </div>
            
            <div class="two columns">
            	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer Mid') ) : ?>
                <?php endif; ?>
            </div>
            
            <div class="two columns">
            	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer Mid Right') ) : ?>
                <?php endif; ?>
            </div>
            
            <div class="four columns">
				<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer Right') ) : ?>
                <?php endif; ?>
            </div>

	</div>

</div>

<div class="footer">

	<div class="row">
		<div class="twelve columns">
    
    	<div class="footerleft">       
            <p><?php _e("Copyright", 'organicthemes'); ?> &copy; <?php echo date(__("Y", 'organicthemes')); ?> &middot; <?php _e("All Rights Reserved", 'organicthemes'); ?> &middot; <?php bloginfo('name'); ?></p>

            <p><a href="http://www.organicthemes.com/themes/magazine-theme/" title="Organic Magazine WordPress Theme" target="_blank"><?php _e("Magazine Theme v4", 'organicthemes'); ?></a> <?php _e("by", 'organicthemes'); ?> <a href="http://www.organicthemes.com" title="Premium WordPress Themes" target="_blank"><?php _e("Organic Themes", 'organicthemes'); ?></a> &middot; <a href="http://kahunahost.com" target="_blank" title="WordPress Hosting"><?php _e("WordPress Hosting", 'organicthemes'); ?></a> &middot; <a href="<?php bloginfo('rss2_url'); ?>"><?php _e("RSS Feed", 'organicthemes'); ?></a> &middot; <?php wp_loginout(); ?></p>
        </div>
        
        <div class="footerright">
    		<a href="http://www.organicthemes.com" title="Designer WordPress Themes" target="_blank"><img src="<?php bloginfo('template_url'); ?>/images/footer_logo.png" alt="<?php _e("Organic Themes",'organicthemes'); ?>" /></a>
    	</div>
		
		</div>
	</div>
	
</div> <!-- close container -->

<?php wp_footer(); ?>

</body>
</html>