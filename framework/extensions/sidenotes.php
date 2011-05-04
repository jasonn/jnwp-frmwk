<?php
/**
 *
 * Sidenotes
 * Author: Jason Newlin
 * Version: 1.0
 * Description: Adds a couple attributes to make it easy to have an 'aside' or 'sidenote' category display, and link to external link.
 */


function sidenote_link() { 
	global $post; 
	$permalink = get_permalink(get_post($post->ID));
	$sidenote_keys = get_post_custom_keys($post->ID); 
	if ($sidenote_keys) {
  		foreach ($sidenote_keys as $sidenote_key) {
    			if ($sidenote_key == 'SidenoteURL') {
      				$sidenote_vals = get_post_custom_values($sidenote_key);
    			}
  		}
  		if ($sidenote_vals) {
			echo $sidenote_vals[0];
  		} else {
    			echo $permalink;
  		}
	} else {
  		echo $permalink;
	}
}


add_filter('the_permalink_rss', 'sidenote_feed_title');

function sidenote_feed_title($permalink) {
	global $wp_query;
	if ($url = get_post_meta($wp_query->post->ID, 'SidenoteURL', true)) {
		return $url;
	}
	return $permalink;
}

?>