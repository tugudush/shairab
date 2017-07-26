<?php

function add_new_contactmethod($contactmethods) {

  if (get_option('messanger_on_profile')) {
	unset($contactmethods['aim']);
	unset($contactmethods['jabber']);
	unset($contactmethods['yim']);
  }
  if (get_option('twitter_on_profile')) { 
	$contactmethods['twitter'] = 'Twitter Url';
  } 
  if (get_option('facebook_on_profile')) {
	$contactmethods['facebook'] = 'Facebook Url';
  }
  if (get_option('gplus_on_profile')) {
	$contactmethods['google_profile'] = 'Google Profile Url';
  }
  if (get_option('linkedin_on_profile')) {
	$contactmethods['linkedin_profile'] = 'Linkedin Url';
  }
  if (get_option('youtube_on_profile')) {
	$contactmethods['youtube_profile'] = 'Youtube Url';
  }
  if (get_option('pinterest_on_profile')) {
	$contactmethods['pinterest_profile'] = 'Pinterest Url';
  }
  return $contactmethods;
}

function author_box_styles() {
        wp_register_style('authorbox_css', plugins_url('Author_Box_disp.css', __FILE__) );
        wp_enqueue_style( 'authorbox_css');
}

function add_author_box($content) {
    If (author_box_display_status()) {
       if(is_single() && get_option('bio_on_post')) {
		if (get_option('bio_on_top')) {
			$content = (display_author_box() . '<br />' . $content);
		}
		else {
			$content.= display_author_box();
		}
    }
    If(is_page() && get_option('bio_on_page')) {
		If (get_option('bio_on_top')) {
			$content = (display_author_box() . '<br />' . $content);
		}
		else {
			$content.= display_author_box();
		}
    }    
    }
    return $content;
}

function author_description() {
    global $post;
    $source = get_post_meta($post->ID, 'author_desc', true);
    if (get_option('custom_profile_field')) {
        $customprofilefield = get_the_author_meta( get_option('custom_profile_field'), $user->ID );
    }
    if ($source) {
        return $source; }
    elseif ($customprofilefield) {
        return $customprofilefield;
    } else {
        return get_the_author_description(); 
    }
}

function author_box_display_status() {
global $post;
$source = get_post_meta($post->ID, 'author_disp', true);
  if (strtolower($source) == 'no') {
    return false; }
  else {
    return true; }
}

function display_author_box() {
	$author_post_line='<p><a rel="nofollow" href="'.get_the_author_meta( 'user_url' ).'">'.get_the_author_meta('display_name').'</a> &ndash; who has written <a rel="author" href="'.get_author_posts_url(get_the_author_meta( 'ID' )).'">'. get_the_author_posts().'</a> posts on <a href="'.get_bloginfo("home").'">'.get_bloginfo("name").'</a>.</p>';
	If (!get_option('email_on_profile'))	{
        If (get_option('images_on_profile')) {
		$display_author_email='<a href="mailto:'.get_the_author_email().'" title="Send an Email to the Author of this Post"><img src="'.plugins_url('/image/email.png', __FILE__).'" alt="Email" width="48" height="48"></a>';
	}
	else {
		$display_author_email='<a href="mailto:'.get_the_author_email().'" title="Send an Email to the Author of this Post">Email</a>';
	}
        }
        $author_title = get_option('ab_box_title');
	$author_box='
	<div class="author_info">
	<p><span class="author_photo">'.get_avatar(get_the_author_id() ).'</span></p><p><b><u>' .$author_title. '</u></b></p><p>'.author_description().'</p>'.$author_post_line.'<hr />';
	//Fetch the User Social Contact Infomation
	$twitter = get_the_author_meta( 'twitter' );
	$facebook = get_the_author_meta( 'facebook' );
	$google_profile = get_the_author_meta( 'google_profile' );
	$youtube_profile = get_the_author_meta('youtube_profile');
	$linkedin_profile = get_the_author_meta('linkedin_profile');
	$pinterest_profile = get_the_author_meta('pinterest_profile');
	if($google_profile){
		If (get_option('images_on_profile')) {
			$display_google_profile='&nbsp;<a title="My Google +" rel="me nofollow" href="' . esc_url($google_profile) . '" target="_blank"><img src="'.plugins_url('/image/googleplus.png', __FILE__).'" alt="Google Plus" width="48" height="48"></a>';
		}
		else {
			$display_google_profile='&nbsp;&#8226;&nbsp;<a title="My Google +" rel="me nofollow" href="' . esc_url($google_profile) . '" target="_blank">Google +</a>';
		}
	}
	if($facebook){
		If (get_option('images_on_profile')) {
			$display_facebook_profile='&nbsp;<a title="My facebook" rel="me nofollow" href="' . esc_url($facebook) . '" target="_blank"><img src="'.plugins_url('/image/facebook.png', __FILE__).'" alt="Facebook" width="48" height="48"></a>';
		}
		else {
			$display_facebook_profile='&nbsp;&#8226;&nbsp;<a title="My facebook" rel="me nofollow" href="' . esc_url($facebook) . '" target="_blank">Facebook </a>';
		}
	}
	if($twitter){
		If (get_option('images_on_profile')) {
			$display_twitter_profile='&nbsp;<a title="My Twitter" rel="me nofollow" href="' . esc_url($twitter) . '" target="_blank"><img src="'.plugins_url('/image/twitter.png', __FILE__).'" alt="Twitter" width="48" height="48"></a>';
		}
		else {
			$display_twitter_profile='&nbsp;&#8226;&nbsp;<a title="My Twitter" rel="me nofollow" href="' . esc_url($twitter) . '" target="_blank">Twitter</a>';
		}
	}
	if($youtube_profile){
		If (get_option('images_on_profile')) {
			$display_youtube_profile='&nbsp;<a title="My YouTube" rel="me nofollow" href="' . esc_url($youtube_profile) . '" target="_blank"><img src="'.plugins_url('/image/youtube.png', __FILE__).'" alt="YouTube" width="48" height="48"></a>';
		}
		else {
			$display_youtube_profile='&nbsp;&#8226;&nbsp;<a title="YouTube" rel="me nofollow" href="' . esc_url($youtube_profile) . '" target="_blank">YouTube</a>';
		}
	}
	if($linkedin_profile){
		If (get_option('images_on_profile')) {
			$display_linkedin_profile='&nbsp;<a title="My Linkedin" rel="me nofollow" href="' . esc_url($linkedin_profile) . '" target="_blank"><img src="'.plugins_url('/image/linkedin.png', __FILE__).'" alt="Linkedin" width="48" height="48"></a>';
		}
		else {
			$display_linkedin_profile='&nbsp;&#8226;&nbsp;<a title="Linkedin" rel="me nofollow" href="' . esc_url($linkedin_profile) . '" target="_blank">LinkedIn</a>';
		}
	}
	if($pinterest_profile){
		If (get_option('images_on_profile')) {
			$display_pinterest_profile='&nbsp;<a title="My Pinterest" rel="me nofollow" href="' . esc_url($pinterest_profile) . '" target="_blank"><img src="'.plugins_url('/image/pinterest.png', __FILE__).'" alt="Pinterest" width="48" height="48"></a>';
		}
		else {
			$display_pinterest_profile='&nbsp;&#8226;&nbsp;<a title="Pinterest" rel="me nofollow" href="' . esc_url($pinterest_profile) . '" target="_blank">Pinterest</a>';
		}
	}
        
        $author_box_content = $author_box.'<div class="author_social_link">'.$display_author_email.$display_google_profile.$display_facebook_profile.$display_twitter_profile.$display_youtube_profile.$display_linkedin_profile.$display_pinterest_profile.'</p></div></div>';
	//Dynamic Output of the Author Box (Show Info you've set)
        return $author_box_content;
}
?>