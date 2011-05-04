<?php
/**
 *
 * @package WordPress
 * @subpackage ThemeFramework
 */

get_header(); ?>

<section>
  
  <?php get_template_part( 'loop', 'index' ); ?>

</section>

<?php get_sidebar(); ?>
<?php get_footer(); ?>