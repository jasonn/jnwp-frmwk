<?php
/**
 *
 * @package WordPress
 * @subpackage jNWP_Framework
 */

class jNWPFramework {
	
	function init() {		
		$theme = new jNWPFramework;
		
		$theme->enviroment();
		$theme->framework();
		$theme->extentions();
		$theme->defaults();
		$theme->ready();
		
		do_action('framework_init');
	}
	
	/**
	 * enviroment() defines jNWPFramework directory constants
	 *
	 */
	function enviroment() {	
		define('FRAMEWORK', TEMPLATEPATH . '/framework');
		define('THEMECORE', FRAMEWORK . '/functions/');
		define('EXTENSIONS', FRAMEWORK . '/extensions/');
		define('THEMEUI', TEMPLATEPATH . '/ui');
		
		// URI shortcuts
		define('THEME', get_bloginfo('template_url'), true);
		
		if (STYLESHEETPATH !== TEMPLATEPATH) define('UI', get_bloginfo('template_url') . '/ui', true);
		else define('UI', THEME . '/ui', true);

		define('CSS', UI . '/stylesheets/');
		define('IMAGES', UI . '/images/');
		define('JS', UI . '/javascripts/');

		do_action('enviroment');
	}
	
	/**
	 * framework() includes all the core functions for jN_Framework
	 */
	function framework() {
		require_once(THEMECORE . '/functions.php'); // load Framework functions
		require_once(THEMECORE . '/widgets.php'); // load Widget functions
	}
	
	/**
	 * extentions() includes all extentions files - if they exist
	 *
	 */
	function extentions() {
		include_all(EXTENSIONS);
	}
	
	/**
	 * defaults() jN_Framework defaults
	 *
	 */
	function defaults() {
		remove_action('wp_head', 'wp_generator'); // removes the generator link
		remove_action('wp_head', 'wlwmanifest_link'); // removes the wlw manifest link
    remove_action('wp_head', 'rsd_link'); // removes the rsd link
		
		add_filter('wp_nav_menu', 'list_pages_post_name_css'); // adds css class name to the <li>'s in the menu, also adds 'last' class to last <li>
		add_filter('body_class','extend_body_class'); // adds a 'post_slug' css class to the body
		add_filter('script_loader_src', 'optimizescripts_set_src_query_params', 10, 2); // Removed the ver number on loaded scripts if the value is null
		add_action( 'widgets_init', 'remove_recent_comments_style' ); // Removes default css in the head
		
		add_action( 'init', 'framework_media' ); // loads scripts and styles
		
		add_theme_support( 'automatic-feed-links' ); // Add default posts and comments RSS feed links to head
		add_theme_support( 'post-thumbnails' ); // Adds post thumbnail support
		
		add_editor_style(); // Adds support to have the visual editor match the theme style
	}
	
	function ready() {
		if (file_exists(FRAMEWORK . '/widgets.php')) include_once(FRAMEWORK . '/widgets.php'); // include widgets.php if that file exist
		if (file_exists(FRAMEWORK . '/custom-functions.php')) include_once(FRAMEWORK . '/custom-functions.php'); // include custom-functions.php if that file exist
		do_action('framework_init'); // Available action: framework_init
		register_widgets();
	}

} // end of jNWPFramework;
?>