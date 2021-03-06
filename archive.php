<?php
/**
 *
 * @package WordPress
 * @subpackage ThemeFramework
 */

get_header(); ?>

<section>
  <?php
  	if ( have_posts() )
  		the_post();
  ?>

	<h1 class="page-title">
  <?php if ( is_day() ) : ?>
    <?php printf( __( 'Daily Archives for %s', 'themeframework' ), get_the_date() ); ?>
  <?php elseif ( is_month() ) : ?>
    <?php printf( __( 'Monthly Archives for %s', 'themeframework' ), get_the_date('F Y') ); ?>
  <?php elseif ( is_year() ) : ?>
    <?php printf( __( 'Yearly Archives for %s', 'themeframework' ), get_the_date('Y') ); ?>
  <?php elseif ( is_category() ) : ?>
    <?php printf( __( 'Category Archives for &#8216;%s&#8217;', 'themeframework' ), single_cat_title( '', false ) ); ?>
  <?php elseif ( is_author() ) : ?>
    <?php printf( __( 'Author Archives for %s', 'themeframework' ), esc_attr( get_the_author() ) ); ?>
  <?php elseif ( is_tag() ) : ?>
    <?php printf( __( 'Posts Tagged with &#8216;%s&#8217;', 'themeframework' ), single_tag_title( '', false ) ); ?>
  <?php else : ?>
  	<?php _e( 'Blog Archives', 'themeframework' ); ?>
  <?php endif; ?>
	</h1>

  <?php
  	rewind_posts();

  	get_template_part( 'loop', 'archive' );
  ?>
</section>

<?php get_sidebar(); ?>
<?php get_footer(); ?>