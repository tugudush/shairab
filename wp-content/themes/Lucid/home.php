<?php get_header(); ?>

<?php if ( 'on' == et_get_option('lucid_featured', 'on') && is_home() ) get_template_part( 'includes/featured', 'home' ); ?>

<?php
	$recent_sidebars = array('recent-area-1','recent-area-2','recent-area-3');
	if ( is_active_sidebar( $recent_sidebars[0] ) || is_active_sidebar( $recent_sidebars[1] ) || is_active_sidebar( $recent_sidebars[2] ) ) {
		echo '<div id="recent-categories" class="clearfix">';
		foreach ( $recent_sidebars as $key => $recent_sidebar ){
			if ( is_active_sidebar( $recent_sidebar ) ) {
				echo '<div class="recent-category' . (  2 == $key ? ' last' : '' ) . '">';
				dynamic_sidebar( $recent_sidebar );
				echo '</div> <!-- end .recent-category -->';
			}
		}
		echo '</div> <!-- end #recent-categories -->';
	}
?>

<div id="content-area" class="clearfix">
	<div id="left-area">
	<?php if ( 'on' == et_get_option('lucid_video_slider_home','on') ){ ?>
		<?php
			$video_postsnum = (int) et_get_option( 'lucid_video_postsnum', 4 );
			$video_posts_query = new WP_Query( apply_filters( 'et_video_post_args', array(
						'tax_query' => array(
							array(
								'taxonomy' => 'post_format',
								'field' => 'slug',
								'terms' => 'post-format-video'
							)
						),
						'posts_per_page' => $video_postsnum
					)
				)
			);
		?>

		<?php if ( $video_posts_query->have_posts() ){ ?>
			<div id="recent-videos">
				<h3 class="main-title"><?php esc_html_e( 'Recent videos', 'Lucid' ); ?></h3>
				<a href="<?php echo esc_url( get_post_format_link( 'video' ) ); ?>" class="more"><?php esc_html_e( 'More', 'Lucid' ); ?></a>
				<div id="video-slider-section">
					<div id="video-content" class="flexslider">
						<ul class="slides">
							<?php
								$video_info = array();
								$i = 0;
								global $wp_embed;
							?>
							<?php while ( $video_posts_query->have_posts() ) : $video_posts_query->the_post(); ?>
								<?php
									$thumb = '';
									$width = apply_filters('et_video_image_width',136);
									$height = apply_filters('et_video_image_height',77);
									$classtext = '';
									$titletext = get_the_title();
									$thumbnail = get_thumbnail($width,$height,$classtext,$titletext,$titletext,false,'Videoimage');

									$video_info[$i]['thumb'] = $thumbnail["thumb"];
									$video_info[$i]['thumbnail'] = $thumbnail["use_timthumb"];
									$video_info[$i]['titletext'] = $titletext;
									$video_info[$i]['width'] = $width;
									$video_info[$i]['height'] = $height;

									$video_info[$i]['post_id'] = get_the_ID();

									$et_video_url = get_post_meta( $post->ID, '_et_lucid_video_url', true );
								?>
								<li>
								<?php
									if ( ( $embed_custom_code = get_post_meta( get_the_ID(), 'et_videolink_embed', true ) ) && '' != $embed_custom_code )
										$video_embed = $embed_custom_code;
									else
										$video_embed = apply_filters( 'the_content', $wp_embed->shortcode( '', esc_url( $et_video_url ) ) );

									$video_embed = preg_replace('/<embed /','<embed wmode="transparent" ',$video_embed);
									$video_embed = preg_replace('/<\/object>/','<param name="wmode" value="transparent" /></object>',$video_embed);
									$video_embed = preg_replace("/height=\"[0-9]*\"/", "height={$height}", $video_embed);
									$video_embed = preg_replace("/width=\"[0-9]*\"/", "width={$width}", $video_embed);

									echo $video_embed;
								?>
								</li>
								<?php $i++; ?>
							<?php endwhile; ?>
							<?php wp_reset_postdata();; ?>
						</ul> <!-- end .slides -->
					</div> <!-- end #video-content -->

				<?php if ( $video_postsnum < 5 ) { ?>
					<ul id="video-switcher" class="clearfix">
						<?php for ( $i = 0; $i < count( $video_info ); $i++ ) { ?>
							<li<?php if ( 0 == $i ) echo ' class="active_video"'; ?>>
								<div class="video_image">
								<?php
									print_thumbnail( array(
										'thumbnail' 	=> $video_info[$i]['thumb'],
										'use_timthumb' 	=> $video_info[$i]['thumbnail'],
										'alttext'		=> $video_info[$i]['titletext'],
										'width'			=> $video_info[$i]['width'],
										'height'		=> $video_info[$i]['height'],
										'et_post_id'	=> $video_info[$i]['post_id'],
									) );
								?>
									<span class="et_video_play"></span>
								</div> <!-- end .video_image -->
							</li>
						<?php } ?>
					</ul>
				<?php } ?>
				</div> <!-- end #video-slider-section -->
			</div> <!-- end #recent-videos -->
		<?php } ?>
	<?php } ?>

	<?php if ( have_posts() ){ ?>
		<div id="recent-articles">
			<h3 class="main-title"><?php esc_html_e( 'Most recent articles', 'Lucid' ); ?></h3>

			<div id="articles-content">
			<?php while ( have_posts() ) : the_post(); ?>
			<?php
				$index_postinfo = et_get_option('lucid_postinfo1');

				$thumb = '';
				$width = apply_filters('et_blog_image_width',128);
				$height = apply_filters('et_blog_image_height',128);
				$classtext = '';
				$titletext = get_the_title();
				$thumbnail = get_thumbnail($width,$height,$classtext,$titletext,$titletext,false,'Blogimage');
				$thumb = $thumbnail["thumb"];
			?>
				<article id="post-<?php the_ID(); ?>" <?php post_class( 'article clearfix' ); ?>>
					<div class="thumb">
						<a href="<?php the_permalink(); ?>">
							<?php print_thumbnail($thumb, $thumbnail["use_timthumb"], $titletext, $width, $height, $classtext); ?>
							<span class="overlay"></span>
						</a>
					</div> 	<!-- end .thumb -->
					<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>

				<?php
					if ( $index_postinfo ){
						echo '<p class="meta-info">';
						et_postinfo_meta( $index_postinfo, et_get_option('lucid_date_format'), esc_html__('0 comments','Lucid'), esc_html__('1 comment','Lucid'), '% ' . esc_html__('comments','Lucid') );
						echo '</p>';
					}

					if ( 'on' == et_get_option('lucid_blog_style') ) the_content('');
					else echo '<p>' . truncate_post( 110, false ) . '</p>';
				?>
				</article> 	<!-- end .article -->
			<?php endwhile; ?>
			</div> <!-- end #articles-content -->
		</div> <!-- end #recent-articles -->

		<?php
			if( function_exists('wp_pagenavi') ) wp_pagenavi();
			else get_template_part('includes/navigation','home');
		?>
	<?php } ?>
	</div> <!-- end #left-area -->

	<?php get_sidebar(); ?>
</div> <!-- end #content-area -->

<?php get_footer(); ?>