<?php 
	/**
	 * This loop is used to create items for the portfolio archives and also the homepage template.
	 * Any custom functions prefaced with ebor_ are found in /ebor_framework/theme_functions.php
	 * First let's declare $post so that we can easily grab everthing needed.
	 */
	 global $post;
	 
	 /**
	  * Next, we need to grab the featured image URL of this post, so that we can trim it to the correct size for the chosen size of this post.
	  */
	 $url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full');
	 
	 /**
	  * Leave this portfolio item out if we didn't find a featured image.
	  */
	 if(!( $url[0] ))
	 	return false;
?>

<section class="parallax parallax-slide fullheight text-left" style="background-image: url(<?php echo esc_url($url[0]); ?>);">
	<div class="valign">
		<?php the_title('<h1 class="black font2">', '</h1><div class="featured-action"><a class="btn btn-expose-small btn-expose-dark" href="'. get_permalink() .'">'. __('More Info','expose') .'</a></div>'); ?>
	</div>
</section>