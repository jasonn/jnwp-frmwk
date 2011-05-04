<?php
/**
 * Template: Sidebar.php
 *
 * @package WordPress
 * @subpackage ThemeFramework
 */

?>

    <aside>
      <section>
  			<?php	/* Widgetized Area */
        		if ( !dynamic_sidebar() ) : ?>


        <?php endif; ?>
      </section>
		</aside>