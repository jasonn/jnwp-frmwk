<?php
/**
 *
 * @package WordPress
 * @subpackage jNWP_Framework
 */

get_header(); ?>

<section>
  
  <?php get_template_part( 'loop', 'index' ); ?>

</section>

<?php get_sidebar(); ?>
<?php get_footer(); ?>