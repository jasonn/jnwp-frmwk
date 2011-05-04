<?php
/**
 *
 * @package WordPress
 * @subpackage jNWP_Framework
 */

get_header(); ?>

<section>

  <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

  	<article id="post-<?php the_ID(); ?>" <?php post_class('page'); ?>>
		  <header>
			  <h1><?php the_title(); ?></h1>
			  <?php edit_post_link( __( 'Edit', 'jnwpframwork' ), '<span class="edit-link">', '</span>' ); ?>
      </header>
      
			<section>
        <?php the_content(); ?>
			</section>
		</article>

    <?php comments_template( '', true ); ?>

  <?php endwhile; ?>
	
</section>

<?php get_sidebar(); ?>
<?php get_footer(); ?>