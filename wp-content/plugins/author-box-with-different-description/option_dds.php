<?php

function author_box_menu() {
	$page = add_submenu_page( 'options-general.php', 'Author Box Options', 'Author Box', 'manage_options', 'author-box-dds-plugin', 'author_box_options' );
}
	
function author_box_options() {
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	if ($_POST['action'] == 'update') {
                if ($_POST[empty_title] == 'on') { $authortitle = '';
                } elseif ($_POST['author_box_title'] == NULL) { $authortitle = 'About The Author';
                  } else { $authortitle = $_POST['author_box_title']; } 
		$_POST['show_pages'] == 'on' ? update_option('bio_on_page', 'checked') : update_option('bio_on_page', '');
		$_POST['show_posts'] == 'on' ? update_option('bio_on_post', 'checked') : update_option('bio_on_post', '');
		$_POST['show_top'] == 'on' ? update_option('bio_on_top', 'checked') : update_option('bio_on_top', '');
		$_POST['show_twitter'] == 'on' ? update_option('twitter_on_profile', 'checked') : update_option('twitter_on_profile', '');
		$_POST['show_facebook'] == 'on' ? update_option('facebook_on_profile', 'checked') : update_option('facebook_on_profile', '');
		$_POST['show_gplus'] == 'on' ? update_option('gplus_on_profile', 'checked') : update_option('gplus_on_profile', '');
		$_POST['show_linkedin'] == 'on' ? update_option('linkedin_on_profile', 'checked') : update_option('linkedin_on_profile', '');
		$_POST['show_youtube'] == 'on' ? update_option('youtube_on_profile', 'checked') : update_option('youtube_on_profile', '');
		$_POST['show_pinterest'] == 'on' ? update_option('pinterest_on_profile', 'checked') : update_option('pinterest_on_profile', '');
		$_POST['show_messanger'] == 'on' ? update_option('messanger_on_profile', 'checked') : update_option('messanger_on_profile', '');
		$_POST['show_css'] == 'on' ? update_option('css_on_profile', 'checked') : update_option('css_on_profile', '');
		$_POST['show_images'] == 'on' ? update_option('images_on_profile', 'checked') : update_option('images_on_profile', '');
		$_POST['show_email'] == 'on' ? update_option('email_on_profile', 'checked') : update_option('email_on_profile', '');
                $authortitle == NULL ? update_option('ab_box_title', '') : update_option('ab_box_title', $authortitle);
                $_POST['custom_profile_field'] == NULL ? update_option('custom_profile_field', '') : update_option('custom_profile_field', $_POST['custom_profile_field']);
		$message = '<div id="message" class="updated fade"><p><strong>Options Saved</strong></p></div>';
	}
	?>
	<div class="wrap">
	<h2>Author Box Plugin With Different Description</h2>
	<div class="metabox-holder columns-2">	
	<div id="postbox-container-1" class="postbox-container" style="width:65%; padding:1.0em;">
	<div class="meta-box-sortables ui-sortable">
	<div id="optionboxdesc" class="postbox">
		<h3 class="hndle"><span><b><u>Settings:</u></b></span></h3>
		<div class="inside">
			This plugin will add an author box to your single post and pages. The box will show user description from the user profile. It also give you an option to add an custom field (author_desc) with the author description to post or page, if you want to use different author description.
			<p>You can add a custom field (author_desc) to your post and your author box for that post will show the custom description, otherwise a description from user profile will be used.</p>
			<p><b>Plugin By <a href="http://ichatter.tv/">Sanjeev Mohindra</a></b></p><hr>
		<?php
		echo $message;
		$options['page'] = get_option('bio_on_page');
		$options['post'] = get_option('bio_on_post');
		$options['posttop'] = get_option('bio_on_top');
		$options['twitter'] = get_option('twitter_on_profile');
		$options['facebook'] = get_option('facebook_on_profile');
		$options['gplus'] = get_option('gplus_on_profile');
		$options['linkedin'] = get_option('linkedin_on_profile');
		$options['youtube'] = get_option('youtube_on_profile');
		$options['pinterest'] = get_option('pinterest_on_profile');
		$options['messanger'] = get_option('messanger_on_profile');
		$options['css'] = get_option('css_on_profile');
		$options['images'] = get_option('images_on_profile');
		$options['profileemail'] = get_option('email_on_profile');
                $customprofilefield = get_option('custom_profile_field');
                $boxtitle = get_option('ab_box_title');
                if ($boxtitle == NULL) { $emptytitle = 'checked';}
                ?>
		<form method="post" action="">
			<input type="hidden" name="action" value="update" />
			<p><b>1. Where to display Author Box with Different Description</b></p>
			<?php
			echo '<input name="show_pages" type="checkbox" id="show_pages" '.$options['page'].' /> Display Author box on Pages<br />
			<input name="show_posts" type="checkbox" id="show_posts" '.$options['post'].' /> Display Author box on Posts<br />
			<p><b>2. Author Box location on the pages </b>(By default it will be displayed at bottom of the post)</p>
			<input name="show_top" type="checkbox" id="show_top" '.$options['posttop'].' /> Display Author box at Top of the Posts<br />
			<p><b>3. Add and Remove Contact Fields to User profile</b></p>
			<input name="show_messanger" type="checkbox" id="show_messanger" '.$options['messanger'].' /> Remove AOL, Yahoo and Google Messanger<br />
			<input name="show_twitter" type="checkbox" id="show_twitter" '.$options['twitter'].' /> Add Twitter<br />
			<input name="show_facebook" type="checkbox" id="show_facebook" '.$options['facebook'].' /> Add Facebook<br />
			<input name="show_gplus" type="checkbox" id="show_gplus" '.$options['gplus'].' /> Add Google Plus<br />
			<input name="show_linkedin" type="checkbox" id="show_linkedin" '.$options['linkedin'].' /> Add Linkedin<br />
			<input name="show_youtube" type="checkbox" id="show_youtube" '.$options['youtube'].' /> Add Youtube<br />
			<input name="show_pinterest" type="checkbox" id="show_pinterest" '.$options['pinterest'].' /> Add Pinterest<br />
			<br /><hr /><p><b>4. Author Box Customization</b></p>
                        <b>Author Box Title: </b><input name="author_box_title" type="text" id="author_box_title" value="'. $boxtitle. '" />
                        <input name="empty_title" type="checkbox" id="empty_title" '.$emptytitle.' /> Remove Title From Author Box<br />
                        <p><b>5. Social Media Profiles</b></p>
			<input name="show_images" type="checkbox" id="show_images" '.$options['images'].' /> Show images rather than text for Social Media Profiles<br />
			<input name="show_email" type="checkbox" id="show_email" '.$options['profileemail'].' /> Do not Show Authors Email on Social Media Profiles<br />
			<p><b>6. Default description from custom field in User Profile</b></p>
                        <b>Custom Field Name: </b><input name="custom_profile_field" type="text" id="custom_profile_field" value="'. $customprofilefield . '" />
                        <p>By default plugin picks the description field from user profile as a fallback description (If there is no author_desc field in post or pages). If you would like to fall back on any other custom field in user profile, define it here.</p>    
                        <p><b>4. CSS for Author Box Display</b></p>
			<input name="show_css" type="checkbox" id="show_css" '.$options['css'].' /> Do Not Load the CSS for Author Box Display.<p>If you check this option, Author Box CSS will not be loaded and you need to define your own CSS for the Author Box. This is to give you flexibility to choose your own Author Box Style.</p>
			'; ?>
			<br />
			<input type="submit" class="button-primary" value="Save Changes" />
			</form>
		</div>
	</div>
	<div id="faqbox" class="postbox">
		<h3 class="hndle"><span><b><u>F.A.Q.:</u></b></span></h3>
		<div class="inside">
			<p><b>1. I am not seeing any custom field after installing the plugin?</b> <br />
			<b>Ans.</b> You will not be seeing it first time. Go ahead and enter it manually in your custom field box. You should give a name as author_desc and enter the description of the author. Next time onwards you can just select this field from the custom field dropdown menu.</p>
			<p><b>2. If I decide to uninstall the plugin, will I lose my custom author description?</b><br />
			<b>Ans.</b> Custom Author Description is saved in post meta and if you decide to uninstall the plugin because of any reason, you will not lose your custom description. If you reinstall it again, it will start fatching the custom Description for you.</p>
			<p><b>3. Do I need to donate to use this plugin?</b><br />
			<b>Ans.</b> No, The plugin is free and you can use it on any site you want. If you really like the plugin and want to help development then you are more than welcome to donate.
			<p><b>4. Which Option to select if I want to show Author Box at bottom of the post?</b><br />
			<b>Ans.</b> By default Author box will be shown at the bottom of the post. If you have selected to show the author box than it will come at the bottom of the post. If you want to show it on top of the post than check the option in the settings and it will be moved to the top.
			<p><b>5. How to create your own CSS?</b><br />
			<b>Ans.</b> You can select an option to not load the Author Box CSS. If you do that you need to define your ouw CSS to display the author box correctly. Author box uses author_info, author_photo and author_email CSS tags, you can define it in a way you want.
		</div>
	</div>
	</div>
	</div>
	<div id="postbox-container-2" class="postbox-container" style="width:25%; padding:1.0em;">
	<div class="meta-box-sortables ui-sortable">
	<div id="likebox" class="postbox">
		<h3 class="hndle"><span><b><u>Like the Plugin</u></b></span></h3>
		<div class="inside">
		<p><div id="fb-root"></div>
			<script>(function(d, s, id) {
			  var js, fjs = d.getElementsByTagName(s)[0];
			  if (d.getElementById(id)) return;
			  js = d.createElement(s); js.id = id;
			  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=206579272749132";
			  fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));</script>
			<div class="fb-like" data-href="http://www.facebook.com/MakeWebWorld" data-send="false" data-width="200" data-show-faces="true"></div></p> 
		<p><!-- Place this tag where you want the widget to render. -->
                    <div class="g-page" data-width="273" data-href="//plus.google.com/106123958131751689609" data-layout="landscape" data-showtagline="false" data-rel="publisher"></div>

                    <!-- Place this tag after the last widget tag. -->
                    <script type="text/javascript">
                      (function() {
                        var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
                        po.src = 'https://apis.google.com/js/plusone.js';
                        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
                      })();
                    </script></p>
                <p><a href="https://twitter.com/sanjeevmohindra" class="twitter-follow-button" data-show-count="true" data-lang="en"></a><script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script></p> 
                <p><script src="https://apis.google.com/js/platform.js"></script><div class="g-ytsubscribe" data-channel="Makewebworld" data-layout="default" data-count="default"></div></p>
		<p><a href="http://wordpress.org/extend/plugins/author-box-with-different-description/" title="Author Box Plugin with Different Description" target="_blank">Give rating on Wordpress.org</a></p>
                <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                <input type="hidden" name="cmd" value="_s-xclick">
                <input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----
                ">
                <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
                </form>
        </div>
	</div>
	<div id="supportbox" class="postbox">
		<h3 class="hndle"><span><b><u>Plugin Support:</u></b></span></h3>
		<div class="inside">
			<p><a href="https://docs.google.com/forms/d/1eypcTatZ5wWsWyleEuiDvKViJXryJrZDg__9UPsctJc/viewform" target="_blank">Request New Features</a></p> 
		</div>
	</div>
	</div>
	</div>
	</div>
	</div>
<?php
}
?>