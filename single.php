<?php
/**
 *
 * @package WordPress
 * @subpackage ThemeFramework
 */

get_header(); ?>

<section>

  <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

  	<article id="post-<?php the_ID(); ?>" <?php post_class('article'); ?>>
		  <header>
			  <h1><?php the_title(); ?></h1>
			  <p><?php twentyten_posted_on(); ?></p>
      </header>
      
			<section>
        <?php the_content(); ?>
			</section>
			
			<footer>
			  <p>
			  	<?php if ( count( get_the_category() ) ) : ?>
  						<?php printf( __( '<span class="%1$s">Posted in</span> %2$s', 'themeframework' ), 'entry-utility-prep entry-utility-prep-cat-links', get_the_category_list( ', ' ) ); ?>
  				<?php endif; ?>
					<?php
  					$tags_list = get_the_tag_list( '', ', ' );
  					if ( $tags_list ):
  				?>
  						<?php printf( __( '<span class="meta-sep">|</span> <span class="%1$s">Tagged</span> %2$s', 'themeframework' ), 'entry-utility-prep entry-utility-prep-tag-links', $tags_list ); ?>
  				<?php endif; ?>
  			  <span class="meta-sep">|</span>
  			  <span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'themeframework' ), __( '1 Comment', 'themeframework' ), __( '% Comments', 'themeframework' ) ); ?></span>
          <?php edit_post_link( __( 'Edit', 'themeframework' ), '<span class="meta-sep">|</span> <span class="edit-link">', '</span>' ); ?>
				</p>
			</footer>
		</article>

    <?php comments_template( '', true ); ?>

  <?php endwhile; ?>
	
</section>

<?php get_sidebar(); ?>
<?php get_footer(); ?>