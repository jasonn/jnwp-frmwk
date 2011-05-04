<?php
/**
 *
 * @package WordPress
 * @subpackage ThemeFramework
 */
 
//set the random id length 
$search_id_length = 4; 

//generate a random id encrypt it and store it in $search_id 
$search_id = crypt(uniqid(rand(),1)); 

//to remove any slashes that might have come 
$search_id = strip_tags(stripslashes($search_id)); 

//Removing any . or / and reversing the string 
$search_id = str_replace(".","",$search_id); 
$search_id = strrev(str_replace("/","",$search_id)); 

//finally I take the first 4 characters from the $search_id 
$search_id = substr($search_id,0,$search_id_length);
?>

<form role="search" id="searchform<?php echo '-'.$search_id ?>" method="get" action="<?php get_option('home'); ?>/">
  <div class="form-field">
    <label for="s<?php echo '-'.$search_id ?>"><?php echo __('Search'); ?></label>
    <input type="text" class="text" name="s" id="s<?php echo '-'.$search_id ?>" size="15" value="<?php the_search_query(); ?>" />
    <button class="search" type="submit"><?php echo esc_attr__('Search'); ?></button>
  </div>
</form>