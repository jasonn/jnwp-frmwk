<?php
/**
 *
 * @package WordPress
 * @subpackage ThemeFramework
 */
 
?>

<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js ie ie6" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--> <html class="<?php if(class_exists('browser')) : echo browser::css() ?> <?php endif; ?>no-js" <?php language_attributes(); ?>> <!--<![endif]-->

<head>

	<title><?php wp_title( '-', true, 'right' ); ?></title>

	<meta charset="<?php bloginfo('charset'); ?>" />
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
  
  <?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>
<?php wp_head(); ?>
	
	<link rel="stylesheet" href="<?php bloginfo( 'stylesheet_url' ); ?>" type="text/css" media="all" />
	
</head>

<body <?php body_class(); ?>>
  <?php wp_nav_menu( array( 'container' => 'nav', 'container_class' => 'primary-navigation', 'theme_location' => 'primary' ) ); ?>
  
  <p>
    Stylesheetpath = <?php echo(STYLESHEETPATH); ?><br />
    Templatepath = <?php echo(TEMPLATEPATH); ?></p>
  
  <header>
		<?php if ( is_home() || is_front_page() ) { ?>
      <h1 class="title"><?php bloginfo('name'); ?></h1>
    <?php } else { ?>
      <div class="title">
        <a href="<?php echo get_option('home'); ?>/" title="<?php bloginfo('name'); ?> - Home"><?php bloginfo('name'); ?></a>
      </div>
    <?php } ?>
    <h2><?php bloginfo('description'); ?></h2>
	</header>
	
	<div id="content-container">