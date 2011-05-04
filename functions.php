<?php
/**
 *
 * @package WordPress
 * @subpackage ThemeFramework
 */

// ThemeFramework Version
define( 'VERSION', '1.1' );

// Load ThemeFramework
require_once( TEMPLATEPATH . '/framework/framework.php' );

// Bootstrap ThemeFramework
ThemeFramework::init();
?>