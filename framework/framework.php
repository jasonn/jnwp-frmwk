<?php
/**
 *
 * @package WordPress
 * @subpackage ThemeFramework
 */

class ThemeFramework {
	
	function init() {		
		$theme = new ThemeFramework;
		
		$theme->enviroment();
		$theme->framework();
		$theme->extensions();
		$theme->widgets();
		$theme->defaults();
		$theme->ready();
		
		do_action('framework_init');
	}
	
	/**
	 * enviroment() defines ThemeFramework directory constants
	 *
	 */
	function enviroment() {	
		define('FRAMEWORK', TEMPLATEPATH . '/framework');
		define('CORE', FRAMEWORK . '/core/');
		define('EXTENSIONS', FRAMEWORK . '/extensions/');
		define('OPTIONS', FRAMEWORK . '/options/');
		define('WIDGETS', FRAMEWORK . '/widgets/');
		define('UI', get_bloginfo('template_url') . '/framework/ui');
		define('CSS', UI . '/stylesheets/');
		define('IMAGES', UI . '/images/');
		define('JS', UI . '/javascripts/');

		do_action('enviroment');
	}
	
	/**
	 * framework() includes all the core functions for ThemeFramework
	 */
	function framework() {
		require_once(CORE . '/theme-functions.php'); // load Framework functions
		require_once(CORE . '/widgets.php'); // load Widget functions
		require_once(OPTIONS . '/options-framework.php'); // load Framework options panel
	}
	
	/**
	 * extensions() includes all extensions files
	 *
	 */
	function extensions() {
		include_all(EXTENSIONS);
	}
	
	/**
	 * widgets() includes all widget files
	 *
	 */
	function widgets() {
		include_all(WIDGETS);
	}
	
	/**
	 * defaults() ThemeFramework defaults
	 *
	 */
	function defaults() {
	  // Remove Actions
		remove_action('wp_head', 'wp_generator'); // removes the generator link
		remove_action('wp_head', 'wlwmanifest_link'); // removes the wlw manifest link
    remove_action('wp_head', 'rsd_link'); // removes the rsd link
		
		// Add Filters
		add_filter('body_class','extend_body_class'); // adds a 'post_slug' css class to the body
		add_filter( 'show_recent_comments_widget_style', '__return_false' ); // Removes default Recent Comments widget css
		
		// Add Actions
		add_action( 'init', 'framework_media' ); // loads scripts and styles
		
		// Theme Support
		add_theme_support( 'automatic-feed-links' ); // Add default posts and comments RSS feed links to head
		

    // Editor CSS
		add_editor_style(); // Adds support to have the visual editor match the theme style
	}
	
	function ready() {
		if (file_exists(FRAMEWORK . '/functions.php')) include_once(FRAMEWORK . '/functions.php'); // include custom-functions.php if that file exist
		do_action('framework_init'); // Available action: framework_init
	}

} // end of ThemeFramework;
?>