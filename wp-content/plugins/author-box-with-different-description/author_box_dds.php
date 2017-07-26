<?php
/*
Plugin Name: Author Box With Different Description
Plugin URI: http://makewebworld.com/author-box-plugin/
Description: A Plugin which will show different author description in the author box based on the post meta data.
Version: 1.3.5
Author: Sanjeev Mohindra
Author URI: http://makewebworld.com/
License: GPL2
*/

/*  Copyright 2012  Sanjeev Mohindra  (email : admin_makewebworld@makewebworld.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

include_once 'option_dds.php';
include_once 'author_box_display.php';

/* Create Author Box Setting Page */
add_action( 'admin_menu', 'author_box_menu' );

/* Add the new Contact Methods to the User Profile */
add_filter('user_contactmethods','add_new_contactmethod',99);

/*Add CSS for the Author Box Display*/
if (!get_option('css_on_profile')) {
    add_action('wp_enqueue_scripts', 'author_box_styles');
}

/*Display the author Box*/
add_filter('the_content', 'add_author_box', 05);

?>