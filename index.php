<?php
/**
 *
 * @package WordPress
 * @subpackage ThemeFramework
 */

get_header(); ?>

<section>
  
  <p>
    Stylesheetpath = <?php echo(STYLESHEETPATH); ?><br />
    Templatepath = <?php echo(TEMPLATEPATH); ?></p>
  
  <dl>
  <dt>type: checkbox</dt>
  <dd>of_get_option('example_checkbox'): <?php echo of_get_option('example_checkbox', 'no entry' ); ?></dd>
  </dl>
  
  <?php get_template_part( 'loop', 'index' ); ?>

</section>

<?php get_sidebar(); ?>
<?php get_footer(); ?>