<?php
/*
** Template to Render Social Icons on Menu Bar
*/
echo '<ul class="social-navigation">';
for ($i = 1; $i < 9; $i++) : 
	$social = esc_attr( get_theme_mod('blogera_social_'.$i) );
	if ( ($social != 'none') && ($social != '') ) : ?>
	<li><a href="<?php echo esc_url( get_theme_mod('blogera_social_url'.$i) ); ?>"><span class="genericon genericon-<?php echo $social; ?>"></span></a></li>
	<?php endif;

endfor;

echo '</ul>';
?>