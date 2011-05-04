<?php
/**
 *
 * @package WordPress
 * @subpackage jNWP_Framework
 */

get_header(); ?>

<section>
  <article id="error-404" class="post error-404 not-found">
    <header>
		  <h2><?php _e( 'Not Found', 'jnwpframwork' ); ?></h2>
		</header>
		<section>
		  <p><?php _e( 'Apologies, but the page you requested could not be found. Perhaps searching will help.', 'jnwpframwork' ); ?></p>
			<?php get_search_form(); ?>
		</section>
	</article>
</section>

<?php get_sidebar(); ?>
<?php get_footer(); ?>