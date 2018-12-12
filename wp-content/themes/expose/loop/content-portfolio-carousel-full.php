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

<div class="item fullheight" style="background-image: url(<?php echo esc_url($url[0]); ?>);">
	<div class="intro09-overlay fullheight">
		<div class="valign text-center">
			<?php the_title('<a href="'. esc_url(get_permalink()) .'"><h1><span class="black font2">', '</span></h1></a>'); ?>
		</div>  
	</div>
</div>