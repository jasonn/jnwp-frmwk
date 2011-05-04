<?php
/**
 * Recent Posts Widget
 * Author: SpinSix
 * Version: 1.0
 */
class RecentPostsWidget extends WP_Widget {
  function RecentPostsWidget() {
    $widget_ops = array(
      'classname' => 'widget-recent-posts',
      'description' => __('Displays recent posts with optional excerpt.', 'recent-posts')
    );
		$control_ops = array( 'id_base' => 'recent-posts-widget' );
		$this->WP_Widget( 'recent-posts-widget', __('Recent Posts - Custom', 'recent-posts'), $widget_ops, $control_ops );
	}

	function widget($args, $instance) {
	  extract( $args );
    $title = apply_filters('widget_title', $instance['title']);
    $post_count = $instance['post_count'];
    $show_excerpt = isset( $instance['show_excerpt'] ) ? $instance['show_excerpt'] : false;
    $widget_excerpt_length = $instance['widget_excerpt_length'];
    $show_comment_count = isset( $instance['show_comment_count'] ) ? $instance['show_comment_count'] : false;
    $show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;
    $date_format = $instance['date_format'];
    $exclude = $instance['exclude'];
    if ($exclude == "") $exclude = "0";
    
    // Save the post object.
    global $post;
  	$post_old = $post;
    
  ?>
    <?php echo $before_widget; ?>
      <?php if ( $title )
        echo $before_title . $title . $after_title; ?>
        
      <?php
        
        // Build query args.
        $query_args = array(
          'cat' => $exclude,
          'post_type' => 'post',
          'post_status' => 'publish',
          'showposts' => $post_count
        );
        
        // Get array of posts.
      	$cat_posts = new WP_Query($query_args);
      	
      	if ( $cat_posts->have_posts() ) : ?>
          <ul>
          <?php while ( $cat_posts->have_posts() ) : $cat_posts->the_post(); ?>
      	
        		<li>
        			<h4><a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>

        			<?php if ( $instance['show_date'] ) : ?>
        			  <span class="post-date"><?php the_time($instance['date_format']); ?></span>
        			<?php endif; ?>

        			<?php if ( $instance['show_excerpt'] ) : ?>
        			  <?php
                		$text = get_the_content('');
                		$text = apply_filters('the_content', $text);
                		$text = str_replace(']]>', ']]&gt;', $text);

                		$allowed_tags = array('<p>','<a>');

                    $tag_string = '<' . implode('><', $allowed_tags) . '>';
                    $text = strip_tags($text, $tag_string);

                		$excerpt_length = $widget_excerpt_length;
                		$words = explode(' ', $text, $excerpt_length + 1);
                		if (count($words)> $excerpt_length) {
                			array_pop($words);
                			array_push($words, '');
                			$text = implode(' ', $words);
                		}

                	echo $text;
        			  ?>
        			<?php endif; ?>

        			<?php if ( $instance['show_comment_count'] ) : ?>
        			  <span class="comment-count">(<?php comments_number('0','1','%'); ?>)</span>
        			<?php endif; ?>
        		</li>
      	
        	<?php endwhile; ?>
          </ul>
      	<?php endif; ?>
      	
      	<?php
        	// Restore the post object.
        	$post = $post_old; 
        ?>
        
      <?php echo $after_widget; ?>
    <?php
	}

	function update($new_instance, $old_instance) {
	  $instance = $old_instance;
	  $instance['title'] = strip_tags( $new_instance['title'] );
	  $instance['post_count'] = strip_tags( $new_instance['post_count'] );
	  $instance['show_excerpt'] = $new_instance['show_excerpt'];
	  $instance['widget_excerpt_length'] = strip_tags( $new_instance['widget_excerpt_length'] );
	  $instance['show_comment_count'] = $new_instance['show_comment_count'];
	  $instance['show_date'] = $new_instance['show_date'];
	  $instance['date_format'] = strip_tags( $new_instance['date_format'] );
	  $instance['exclude'] = strip_tags( $new_instance['exclude'] );
	  
	  return $instance;
	}

	function form($instance) {
		$defaults = array( 
		  'title' => __('Recent Posts', 'recent-posts'),
		  'post_count' => __('5', 'recent-posts'),
		  'show_excerpt' => true,
		  'widget_excerpt_length' => __('15', 'recent-posts'),
		  'show_comment_count' => true,
		  'show_date' => true,
		  'date_format' => __('M j', 'recent-posts')
		);
    $instance = wp_parse_args( (array) $instance, $defaults );
    $show_excerpt = $instance['show_excerpt'] ? 'checked="checked"' : '';
    $show_comment_count = $instance['show_comment_count'] ? 'checked="checked"' : '';
    $show_date = $instance['show_date'] ? 'checked="checked"' : '';
    
  ?>
    <p>
      <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $instance['title']; ?>" />
    </p>
    
    <p>
      <label for="<?php echo $this->get_field_id('post_count'); ?>"><?php _e('How many post to show:'); ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id('post_count'); ?>" name="<?php echo $this->get_field_name('post_count'); ?>" type="text" value="<?php echo $instance['post_count']; ?>" />
    </p>
    
    <p>
			<input class="checkbox" type="checkbox" <?php echo $show_excerpt; ?> id="<?php echo $this->get_field_id( 'show_excerpt' ); ?>" name="<?php echo $this->get_field_name( 'show_excerpt' ); ?>" /> 
			<label for="<?php echo $this->get_field_id( 'show_excerpt' ); ?>"><?php _e('Show Excerpt'); ?></label>
		</p>
		
		<p>
		  <label for="<?php echo $this->get_field_id('widget_excerpt_length'); ?>"><?php _e('Excerpt Length:'); ?></label>
		  <input class="widefat" id="<?php echo $this->get_field_id('widget_excerpt_length'); ?>" name="<?php echo $this->get_field_name('widget_excerpt_length'); ?>" type="text" value="<?php echo $instance['widget_excerpt_length']; ?>" />
		  <small>Word Count</small>
		</p>
		
		<p>
			<input class="checkbox" type="checkbox" <?php echo $show_comment_count; ?> id="<?php echo $this->get_field_id( 'show_comment_count' ); ?>" name="<?php echo $this->get_field_name( 'show_comment_count' ); ?>" /> 
			<label for="<?php echo $this->get_field_id( 'show_comment_count' ); ?>"><?php _e('Show Comment Count'); ?></label>
		</p>
		
		<p>
			<input class="checkbox" type="checkbox" <?php echo $show_date; ?> id="<?php echo $this->get_field_id( 'show_date' ); ?>" name="<?php echo $this->get_field_name( 'show_date' ); ?>" /> 
			<label for="<?php echo $this->get_field_id( 'show_date' ); ?>"><?php _e('Show Post Date'); ?></label>
		</p>
		
		<p>
		  <label for="<?php echo $this->get_field_id('date_format'); ?>"><?php _e('Date Format:'); ?></label>
		  <input class="widefat" id="<?php echo $this->get_field_id('date_format'); ?>" name="<?php echo $this->get_field_name('date_format'); ?>" type="text" value="<?php echo $instance['date_format']; ?>" />
		  <small>PHP Date Format</small>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'exclude' ); ?>"><?php _e('Exclude Categories:'); ?></label>
			<input id="<?php echo $this->get_field_id( 'exclude' ); ?>" name="<?php echo $this->get_field_name( 'exclude' ); ?>" type="text" value="<?php echo $instance['exclude']; ?>" style="width:100%;" />
			<small>Format: -1,-2,-3 (comma separated list)</small>
		</p>

    <?php
	}
}


/**
 * Add function to widgets_init that'll load our widgets.
 */
add_action( 'widgets_init', 'load_widgets' );

/**
 * Register widgets.
 */
function load_widgets() {
	register_widget( 'RecentPostsWidget' );
}

?>