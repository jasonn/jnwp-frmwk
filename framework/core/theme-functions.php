<?php
/**
 *
 * @package WordPress
 * @subpackage ThemeFramework
 */

/**
 * framework_media() loads javascripts and css
 *
 */
function framework_media() {
	if( is_admin() ) return;
	
	wp_deregister_script('jquery');	//remove locally jQuery in favor of Google's
	wp_deregister_script('l10n'); //remove the l10n.js added in WP 3.1
	
	wp_enqueue_script(
	   'jquery',
	   'http://ajax.googleapis.com/ajax/libs/jquery/1.5.2f/jquery.min.js',
	   array(),
	   null, //since empty, no ver parameter in query string
	   true //in_footer
	);
	
	/**
   * jquery_fallback() loads local jQuery if CDN fails
   *
   */
  function jquery_fallback( $src, $handle = null )
  {
    static $run_next = false;

    if ( $run_next ) {
      $local = JS . 'jquery.min.js';
echo <<<FALLBACK
        <script>window.jQuery || document.write('<script src="$local"><\/script>')</script>
FALLBACK;
        $run_next = false;
    }

    if ( $handle === 'jquery' )
        $run_next = true;
    return $src;
  }
  add_filter( 'script_loader_src', 'jquery_fallback', 10, 2 );
  add_action( 'print_footer_scripts', 'jquery_fallback', 2 );
	
	// Continue loading scripts after jQuery
	wp_enqueue_script('modernizr', JS . 'modernizr-2.0.min.js', array(), '2.0.custom', false);
	
  wp_enqueue_style('reset', CSS . 'reset.css', array(), VERSION, 'screen');
  wp_enqueue_style('typography', CSS . 'typography.css', array(), VERSION, 'screen');
  
  // Loads the style.css from the parent theme
  if (STYLESHEETPATH !== TEMPLATEPATH) wp_enqueue_style('base', get_bloginfo('template_url') . '/style.css', array(), VERSION, 'screen');
}


/**
 * post_gallery_filter stops [gallery] styles from being added to the page. making html invalid
 *
 */
function gallery_style_filter( $gallery ) { return '<div class="gallery">'; }


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