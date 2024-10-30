<?php
/*
Plugin Name: Cheatsheet
Plugin URI: http://cultivate.it/apps/cheatsheet/
Description: This plugin helps manage a cheat sheet of tips that can be referred to when using Wordpress.
Version: 1.2
Author: Hans Vedo
Author URI: http://cultivate.it
*/

/*
Copyright 2010  Hans Vedo  (email : hans@cultivate.it)

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

// Settings
define('cheatsheet_version','1.2');

// Hook into Wordpress
add_action('admin_menu','cheatsheet_add_theme_page');

// Add the theme page.
function cheatsheet_add_theme_page(){
	add_theme_page('Cheatsheet','Cheatsheet','edit_themes',basename(__FILE__),'cheatsheet_page');
	
	// Add the CSS
	if(!function_exists('do_css')){
		function do_css(){
			wp_enqueue_style('thickbox');
		}
		
		add_action('admin_print_styles', 'do_css' );
	}
	
	// Add the Javascript
	if(!function_exists('do_jslibs')){
		function do_jslibs(){
			wp_enqueue_script('editor');
			wp_enqueue_script('jquery');
			wp_enqueue_script('thickbox');
			wp_enqueue_script('media-upload');
			add_action( 'admin_head','wp_tiny_mce');
		}
		
		add_action('admin_print_scripts','do_jslibs');
	}
}

// Create the page.
function cheatsheet_page(){
	// Include the code and layout files.
	ob_start();
		include(dirname(__FILE__).'/admin/code/page.php');
		include(dirname(__FILE__).'/admin/html/page.html');
				
		$plugin_output = ob_get_contents();
	ob_end_clean();
	
	// Liquid Templating
	$plugin_output = str_replace('{cheatsheet.text}',$cheatsheet_text,$plugin_output);
	$plugin_output = str_replace('{cheatsheet.editor}',$editor_html,$plugin_output);
	$plugin_output = str_replace('{page}',$_GET['page'],$plugin_output);
	echo($plugin_output);
}

// Include the Javascript and CSS for the admin side.
add_action('admin_head','cheatsheet_admin_head');

// Include the functions for the expert pages.
function cheatsheet_admin_head(){
	echo('<script language="javascript" type="text/javascript" src="'.get_bloginfo('url').'/wp-content/plugins/cheatsheet/admin/functions.js?'.cheatsheet_version.'"></script>');
}
?>