<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Blogera
 */
 
if ( ! function_exists( 'blogera_entry_meta' ) ) :
/**
 * Prints HTML with meta information for the date, categories, tags , author, comments and edit link.
 */
function blogera_entry_meta( $show_date = 1, $show_cat = 1, $show_tag = 1 , $show_author =  1, $show_comment =  1 ,$edit_post =  1 ) {
	
	if ( 'post' === get_post_type() ) {
		
		// Show date
		if( 1 == $show_date ){
			blogera_entry_date();
		}
		
		// Show category
		if( 1 == $show_cat ){
			$categories_list = get_the_category_list( esc_html__( ' ', 'blogera' ) );
			if ( $categories_list) {
				printf( '<span class="cat-links">' . esc_html__( '%1$s', 'blogera' ) . '</span>', $categories_list ); // WPCS: XSS OK.
			}
		}

		// Show tags
		if( 1 == $show_tag ){
			$tags_list = get_the_tag_list( '', esc_html__( ', ', 'blogera' ) );
			if ( $tags_list ) {
			printf( '<span class="tags-links"><strong>%1$s </strong>%2$s</span>',
			_x( 'Tagged : ', 'Used before tag names.', 'blogera' ),
			$tags_list
				);
			}
		}
		
		// Show author		
		if( 1 == $show_author ){
			printf( '<span class="byline">%1$s <a class="url fn n" href="%2$s">%3$s</a></span>',
				_x( 'By :', 'Used before post author name.', 'blogera' ),
				esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
				get_the_author()
				);
			}
	}
		
		// Show comments
		if( 1 == $show_comment ){
			if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
				echo '<span class="comments-link">';
				comments_popup_link( esc_html__( '0 comment', 'blogera' ), esc_html__( '1 Comment', 'blogera' ), esc_html__( '% Comments', 'blogera' ) );
				echo '</span>';
			}
		}
		
		// Show edit post link
		if( $edit_post == 1 ){
		edit_post_link(
			sprintf(
			/* translators: %s: Name of current post */
				esc_html__( 'Edit %s', 'blogera' ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
				),
				'<span class="edit-link"><i class="fa fa-edit "></i>',
				'</span>'
			);	
		}

}
endif;


if ( ! function_exists( 'blogera_entry_date' ) ) :
/**
 * Prints HTML with date information for current post.
 *
 * Create your own blogera_entry_date() function to override in a child theme.
 *
* @package Blogera
 */
function blogera_entry_date() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		get_the_date(),
		esc_attr( get_the_modified_date( 'c' ) ),
		get_the_modified_date()
	);

	printf( '<span class="posted-on"><span class="screen-reader-text">%1$s </span><a href="%2$s" rel="bookmark">%3$s</a></span>',
		_x( 'Posted on', 'Used before publish date.', 'blogera' ),
		esc_url( get_permalink() ),
		$time_string
	);
}
endif;

if ( ! function_exists( 'blogera_post_thumbnail' ) ) :
/**
 * Displays an optional post thumbnail.
 *
 * Wraps the post thumbnail in an anchor element on index views, or a div
 * element when on single views.
 *
 * Create your own blogera_post_thumbnail() function to override in a child theme.
 *
 * @package Blogera
 */
function blogera_post_thumbnail() {
	if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
		return;
	}

	if ( is_singular() ) :
	?>

	<div class="post-thumbnail">
		<?php the_post_thumbnail( 'blogera-blog-thumb', array( 'alt' => the_title_attribute( 'echo=0' ) ) ); ?>
	</div><!-- .post-thumbnail -->

	<?php else : ?>

	<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
		<?php the_post_thumbnail( 'blogera-blog-thumb', array( 'alt' => the_title_attribute( 'echo=0' ) ) ); ?>
	</a>

	<?php endif; // End is_singular()
}
endif;

if ( ! function_exists( 'blogera_excerpt' ) ) :
/**
 * Displays the optional excerpt.
 *
 * Wraps the excerpt in a div element.
 *
 * Create your own blogera_excerpt() function to override in a child theme.
 *
 * @package Blogera
 */
function blogera_excerpt( $class = 'entry-summary' ) {
	$class = esc_attr( $class );

	if ( has_excerpt() || is_search() ) : ?>
		<div class="<?php echo $class; ?>">
			<?php the_excerpt(); ?>
		</div><!-- .<?php echo $class; ?> -->
	<?php endif;
}
endif;

if ( ! function_exists( 'blogera_excerpt_more' ) && ! is_admin() ) :
/**
 * Replaces "[...]" (appended to automatically generated excerpts) with  a 'Continue Reading' link.
 *
 * Create your own blogera_excerpt_more() function to override in a child theme.
 *
 * @package Blogera
 */
function blogera_excerpt_more() {
	$link = sprintf( '<span class="readmore"><a href="%1$s" class="more-link">%2$s</a></span>',
		esc_url( get_permalink( get_the_ID() ) ),
		/* translators: %s: Name of current post */
		sprintf( __( 'Continue Reading<span class="screen-reader-text"> "%s"</span>', 'blogera' ), get_the_title( get_the_ID() ) )
	);
	return $link;
}
add_filter( 'excerpt_more', 'blogera_excerpt_more' );
endif;

if ( ! function_exists( 'blogera_categorized_blog' ) ) :
/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function blogera_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'blogera_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'blogera_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so blogera_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so blogera_categorized_blog should return false.
		return false;
	}
}
endif;

/**
 * Flushes out the transients used in blogera_categorized_blog().
 */
function blogera_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'blogera_categories' );
}
add_action( 'edit_category', 'blogera_category_transient_flusher' );
add_action( 'save_post',     'blogera_category_transient_flusher' );



/**
 * Custom styling
 *
 * @return string
 */
function blogera_get_custom_style(){
    $css = '';
    $primary_color = esc_attr( get_theme_mod( 'primary_color' ) );
	$main_text_color = esc_attr( get_theme_mod( 'main_text_color' ) );
	
	if ( $main_text_color ) {
		$css .= '
.author-info h2.author-title .author-link,
.entry-footer,
.entry-footer a,
article.page .entry-header h1,
article.post_list .entry-header h1,
article.post_list .entry-header h2,
article.post_list h1 a,
article.post_list h2 a,
.comment-metadata,
.pingback .edit-link,
.comment-metadata a,
.pingback .comment-edit-link,
.post_slider_caption h2,
.post_slider_caption h2 a,
.page-links > .page-links-title,
.main-navigation a,
body,
button,
input,
select,
textarea,
h1,
h2,
h3,
h4,
h5,
h6,
a{
    color: '.$main_text_color.';
}';
	}
    if ( $primary_color ) {

/**
* @TODO beautiful output code

*/
$css .= '
.image-navigation a:hover,
.comment-navigation a:hover,
mark, ins,
.readmore a:hover,
.widget_calendar tbody #today a, .widget_calendar tbody #today,
.sidebar .widget .widget-title:after,.footer-top .widget-title::after,
.post_slider_caption h2:after,
.cat-links a,
.cat-links a:hover,
.page-links a:hover,
.page-links a:focus,
article.page .entry-header h1:after,
article.post_list .entry-header h1:after,
article.post_list .entry-header h2:after,
.page-links > span,
.menu-toggle.toggled-on,
.menu-toggle.toggled-on:hover,
.menu-toggle.toggled-on:focus,
.tagcloud a:hover,
.tagcloud a:focus,
.menu-toggle:focus,
.menu-toggle:hover,
.pagination .page-numbers:hover,
.pagination .page-numbers.current,
button,
button[disabled]:hover,
button[disabled]:focus,
input[type="button"],
input[type="button"][disabled]:hover,
input[type="button"][disabled]:focus,
input[type="reset"],
input[type="reset"][disabled]:hover,
input[type="reset"][disabled]:focus,
input[type="submit"],
input[type="submit"][disabled]:hover,
input[type="submit"][disabled]:focus{
    background: '.$primary_color.';
}';
$css .= '
.image-navigation a,
.comment-navigation a,
.readmore a:hover,
.comment-reply-link,
.readmore a,
.page-links a,
.page-links > span,
.widget_calendar tbody #today a,
.widget_calendar tbody #today,
.tagcloud a:hover,
.tagcloud a:focus,
.menu-toggle:focus,
.menu-toggle:hover,
.menu-toggle.toggled-on,
.menu-toggle.toggled-on:hover,
.menu-toggle.toggled-on:focus,
.pagination .page-numbers:hover,
.pagination .page-numbers.current,
.pagination .page-numbers,
input[type="date"]:focus,
input[type="time"]:focus,
input[type="datetime-local"]:focus,
input[type="week"]:focus,
input[type="month"]:focus,
input[type="text"]:focus,
input[type="email"]:focus,
input[type="url"]:focus,
input[type="password"]:focus,
input[type="search"]:focus,
input[type="tel"]:focus,
input[type="number"]:focus,
textarea:focus,
blockquote{
    border-color: '.$primary_color.';
}';
$css .= '
.image-navigation a,
.comment-navigation a,
.entry-content a,
.entry-summary a,
.taxonomy-description a,
.comment-content a,
.page-header h1 span,
.post_slider_caption h2 a:hover,
article.post_list h1 a:hover, 
article.post_list h2 a:hover,
.readmore a,
.comment-metadata a:hover,
.comment-metadata a:focus,
.pingback .comment-edit-link:hover,
.pingback .comment-edit-link:focus,
.comment-reply-link,
.page-links a,
.author-info h2.author-title .author-link:hover,
.entry-footer a:hover,
.entry-footer a:focus,
.widget_calendar tbody a,
.pagination .page-numbers,
.post-navigation a:hover .post-title,
.post-navigation a:focus .post-title,
.main-navigation li:hover > a,
.main-navigation li.focus > a,
.main-navigation .current-menu-item > a,
.main-navigation .current-menu-ancestor > a,
.site-header a:hover,
a:hover,
a:focus,
a:active,
.sticky-post{
    color: '.$primary_color.';
}';


    }
	

    return $css;
}

