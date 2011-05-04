<?php
/**
 *
 * @package WordPress
 * @subpackage jNWP_Framework
 */


/**
 * framework_media() loads javascripts and styles
 *
 */
function framework_media() {
	if( is_admin() ) return;
	
	wp_deregister_script('jquery');	//remove locally jQuery in favor of Google's
	
	wp_enqueue_script(
	   'jquery',
	   'http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js',
	   array(),
	   null, //since empty, no ver parameter in query string
	   true //in_footer
	);
	
	wp_enqueue_script('modernizr', JS . 'modernizr.js', array(), '1.5', false);
	
  wp_enqueue_style('reset', CSS . 'reset.css', array(), '', 'screen');
  wp_enqueue_style('typography', CSS . 'typography.css', array(), '', 'screen');
}


/**
 * Improve cacheability of scripts: Removes 'ver' query parameter if it is empty
 * (false or null). This is important for scripts that are loaded from Google's
 * CDN, for example, because with the query arg it breaks Web-wide caching.
 * If desiring jQuery, you'll need to replace the script URL, for example:
 *   wp_deregister_script('jquery');
 *   wp_enqueue_script('jquery',
 *       'http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js',
 *       array(),
 *       false, //version (set to empty so that ver param not included)
 *       true   //in_footer
 *   );
 * When enqueueing other scripts, be sure to include the filemtime as the
 * version so that when the file is modified, clients will not continue to use
 * the previously cached far-future expires version, for example:
 *   wp_enqueue_script(
 *       'mymain',
 *       get_template_directory_uri().'/main.js'
 *       filemtime(TEMPLATEPATH . '/main.js'), //don't allow stale cache
 *       true //in_footer
 *   );
 * @todo We could iterate over all handles and just supply a filemtime as the ver
 */
function optimizescripts_set_src_query_params($src, $handle = null){
	global $wp_scripts;
	
	//Always remove the WordPress-supplied ver query parameter if version is empty
	if($handle){
		if(empty($wp_scripts->registered[$handle]->ver))
			$src = remove_query_arg('ver', $src);
		else
			$src = add_query_arg(array('ver' => $wp_scripts->registered[$handle]->ver), $src);
	}
	
	return $src;
}


/**
 * post_gallery_filter stops [gallery] styles from being added to the page. making html invalid
 *
 */
function gallery_style_filter( $gallery ) { return '<div class="gallery">'; }


/**
 * list_pages_post_name_css - adds a class of 'last' to the last item in the list.
 *
 */
function list_pages_post_name_css($output) {
	// Add a class to the last <li>
	$content_rev = strrev($output);
	$last_class = 'last';

	// match an <li... next to a </ul> or and EOL
	$content_rev = preg_replace('/(\A|>lu\/<)[\s](.*)"=ssalc([\s]*("[\w_-]+"|\'[\w_-]+\')=di[\s]*)? il</imu', "$1$2 " . strrev($last_class) . "\"=ssalc$3 il<", $content_rev, -1);

	$output = strrev($content_rev);

	return $output;
}


/**
 * extend_body_class adds a class for post_name and category
 *
 */
function extend_body_class($classes = '') {
  $post_data = get_post($post->ID, ARRAY_A);
  $category = get_the_category();
  
  if (is_page()) $classes[] = $post_data['post_name'];
  if (is_single()) {
    $classes[] = $post_data['post_name'];
    $classes[] = $category[0]->slug;
  }
	return $classes;
}


/**
 * show_posts_nav returns true or false to show/hide the post navigation
 *
 */
function show_posts_nav() {
  global $wp_query;
  return ($wp_query->max_num_pages > 1);
}


/**
 * remove_recent_comments_style removes the WordPress default action
 *
 */
function remove_recent_comments_style() {
    global $wp_widget_factory;
    remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'  ) );
}


/**
 * framework_get Gets template files
 *
 */
function framework_get( $file = NULL ) {
	do_action( 'framework_get' ); // Available action: framework_get
	$error = "Sorry, but <code>{$file}</code> does <em>not</em> seem to exist. Please make sure this file exist in <strong>" . get_stylesheet_directory() . "</strong>\n";
	$error = apply_filters( 'framework_get_error', (string) $error ); // Available filter: framework_get_error
	if ( isset( $file ) && file_exists( get_stylesheet_directory() . "/{$file}.php" ) )
		locate_template( get_stylesheet_directory() . "/{$file}.php" );
	else
        echo $error;
}

/**
 * include_all() A function to include all files from a directory path
 *
 */
function include_all( $path, $ignore = false ) {

	/* Open the directory */
	$dir = @dir( $path ) or die( 'Could not open required directory ' . $path );
	
	/* Get all the files from the directory */
	while ( ( $file = $dir->read() ) !== false ) {
		/* Check the file is a file, and is a PHP file */
		if ( is_file( $path . $file ) and ( !$ignore or !in_array( $file, $ignore ) ) and preg_match( '/\.php$/i', $file ) ) {
			require_once( $path . $file );
		}
	}		
	$dir->close(); // Close the directory, we're done.
}

?>