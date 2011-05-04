<?php
/**
 * A section taken from the 'Optimize Scripts' plugin by Weston Ruter
 * http://wordpress.org/extend/plugins/optimize-scripts/
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

add_filter('script_loader_src', 'optimizescripts_set_src_query_params', 10, 2); // Removed the ver number on loaded scripts if the value is null
?>