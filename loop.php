<?php
/**
 *
 * @package WordPress
 * @subpackage jNWP_Framework
 */
 
?>

<?php if ( ! have_posts() ) : ?>
	<article id="not-found" class="post error-404 not-found">
    <header>
		  <h2><?php _e( 'Not Found', 'jnwpframwork' ); ?></h2>
		</header>
		<section>
		  <p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'jnwpframwork' ); ?></p>
			<?php get_search_form(); ?>
		</section>
	</article>
	
	
<?php endif; ?>


<?php while ( have_posts() ) : the_post(); ?>

<?php /* Posts in the Gallery category. */ ?>

	<?php if ( in_category( _x('gallery', 'gallery category slug', 'twentyten') ) ) : ?>
		<h1>gallery loop</h1>

<?php /* Posts in the asides category */ ?>

	<?php elseif ( in_category( _x('asides', 'asides category slug', 'twentyten') ) ) : ?>
	<h1>asides loop</h1>

<?php /* All other posts. */ ?>

	<?php else : ?>
	  <article id="post-<?php the_ID(); ?>" <?php post_class('article'); ?>>
		  <header>
		    <?php if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) : the_post_thumbnail(); endif; ?>
			  <h2><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php printf( esc_attr__( 'Permalink to %s', 'jnwpframwork' ), the_title_attribute( 'echo=0' ) ); ?>"><?php the_title(); ?></a></h2>
			  <p><?php twentyten_posted_on(); ?></p>
      </header>
      
			<section>
				<?php if ( is_archive() || is_search() ) : ?>
      	  <?php the_excerpt(); ?>
      	<?php else : ?>
      		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'jnwpframwork' ) ); ?>
      	<?php endif; ?>
			</section>
			
			<footer>
			  <p>
			  	<?php if ( count( get_the_category() ) ) : ?>
  						<?php printf( __( '<span class="%1$s">Posted in</span> %2$s', 'jnwpframwork' ), 'entry-utility-prep entry-utility-prep-cat-links', get_the_category_list( ', ' ) ); ?>
  				<?php endif; ?>
					<?php
  					$tags_list = get_the_tag_list( '', ', ' );
  					if ( $tags_list ):
  				?>
  						<?php printf( __( '<span class="meta-sep">|</span> <span class="%1$s">Tagged</span> %2$s', 'jnwpframwork' ), 'entry-utility-prep entry-utility-prep-tag-links', $tags_list ); ?>
  				<?php endif; ?>
  			  <span class="meta-sep">|</span>
  			  <span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'jnwpframwork' ), __( '1 Comment', 'jnwpframwork' ), __( '% Comments', 'jnwpframwork' ) ); ?></span>
          <?php edit_post_link( __( 'Edit', 'jnwpframwork' ), '<span class="meta-sep">|</span> <span class="edit-link">', '</span>' ); ?>
				</p>
			</footer>
		</article>

		<?php comments_template( '', true ); ?>

	<?php endif; ?>

<?php endwhile; ?>

<?php if (show_posts_nav()) : ?>
  <?php include ( TEMPLATEPATH . '/navigation.php' ); ?>
<?php endif; ?>
