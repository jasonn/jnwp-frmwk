<?php
/**
 *
 * @package WordPress
 * @subpackage jNWP_Framework
 */
 
?>

<nav class="page-nav">
  <?php if(function_exists('wp_pagenavi')) : wp_pagenavi(); else : ?>
	<span class="nav-next"><?php next_posts_link( '<span class="nav-meta">&laquo;</span> Older Entries' ); ?></span>
	<span class="nav-previous"><?php previous_posts_link( 'Newer Entries <span class="nav-meta">&raquo;</span>' ); ?></span>
	<?php endif; ?>
</nav>