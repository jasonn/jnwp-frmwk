<?php
/**
 * Template: Search.php
 *
 * @package WordPress
 * @subpackage ThemeFramework
 */

get_header(); ?>

<section>
	<?php if ( have_posts() ) : ?>

    <?php while ( have_posts() ) : the_post(); ?>

		  <article id="post-<?php the_ID(); ?>" <?php post_class('article'); ?>>
        <header>
  		    <?php if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) : the_post_thumbnail(); endif; ?>
  			  <h2><a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2>
  			  <p><?php the_time('n/j/Y') ?>
  				<span class="author vcard">by <?php printf( '<a class="url fn" href="' . get_author_posts_url( $authordata->ID, $authordata->user_nicename ) . '" title="' . sprintf( 'View all posts by %s', $authordata->display_name ) . '">' . get_the_author() . '</a>' ) ?></span>
  				|
  				<?php the_category(', ') ?>
  				|
  				<a href="<?php comments_link(); ?>"><?php comments_number( 'Add a comment', '1 Comment', '% Comments' ); ?></a>
  				<?php edit_post_link( 'Edit', '', '' ); ?></p>
        </header>

  			<section>
  				<?php the_excerpt(); ?>
  				<nav>
    			  <a href="<?php the_permalink(); ?>" class="more-link" title="Read more - <?php the_title(); ?>">Read more</a>
    			</nav>
  			</section>
  		</article>

		<?php endwhile; ?>
  		<?php if (show_posts_nav()) : ?>
        <?php include ( TEMPLATEPATH . '/navigation.php' ); ?>
    	<?php endif; ?>
    	
    <?php else : ?>
    	<article id="post-not-found">
        <header>
          <h2>No Results</h2>
    		  <?php get_search_form(); ?>
    		</header>
    		<section>
    		  <p>Sorry, but the requested resource was not found on this site.</p>
    		  <?php get_search_form(); ?>
    		</section>
    	</article>

    <?php endif; ?>
</section>

  <?php get_sidebar(); ?>
<?php get_footer(); ?>