<?php
/**
 * Template: Sidebar.php
 *
 * @package WordPress
 * @subpackage jNWP_Framework
 */

?>

    <aside>
      <section>
  			<?php	/* Widgetized Area */
        		if ( !dynamic_sidebar() ) : ?>


        <?php endif; ?>
      </section>
		</aside>