<?php
/**
 *
 * @package WordPress
 * @subpackage ThemeFramework
 */

/**
 * register_widgets()
 *
 */

function sidebars_init($sidebars) {
  foreach($sidebars as $sb) {
  	register_sidebar(array(
  	  'name'=> $sb,
  		'before_widget' => '<div id="%1$s" class="widget %2$s">',
  		'after_widget' 	=> '</div>',
  		'before_title' 	=> '<h3 class="widget-title">',
  		'after_title' 	=> '</h3>',
  	));
  }
}

add_action( 'widgets_init', sidebars_init(array('Sidebar')) );

/**
 * widget_area_active() Checks to see if a widget area is active based on ID
 *
 * @since 0.4
 */
function widget_area_active( $index ) {
	global $wp_registered_sidebars;
	
	$widgetarea = wp_get_sidebars_widgets();
	if ( isset($widgetarea[$index]) ) return true;
	
	return false;
}

/**
 * framework_widget_area() Get's Widget Area if widgets are active in that spot
 *
 * @since 0.4
 */
function framework_widget_area( $name = false ) {
	if ( !isset($name) ) {
		$widget[] = "widget.php";
	} else {
		$widget[] = "widget-{$name}.php";
	}
	locate_template( $widget, true );
}
?>