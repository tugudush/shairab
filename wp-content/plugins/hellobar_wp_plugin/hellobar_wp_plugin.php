<?php

/*
Plugin Name: Hello Bar (Official)
Plugin URI: http://www.hellobar.com
Description: Inserts your custom Hello Bar on shairab.com. Because of the WordPress User Bar, you might need to log out and visit your WordPress site again to see your Hello Bar. Please note that this plugin is only valid for shairab.com. If you want to edit your Hello Bar click "Visit plugin site" below.
Version: 1.0
Author: Hello Bar
Author URI: http://www.hellobar.com
License: GPL v2

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
function add_hellobar_script()
{
  echo "<script src=\"//my.hellobar.com/b6d6916290535261d7841b8d701ecd00cd2fa8db.js\" type=\"text/javascript\" async=\"async\"></script>";
}

add_action( 'wp_footer',  'add_hellobar_script');

?>
