<?php
	get_header();
	the_post();
	
	$thumbnail = has_post_thumbnail();
	
	if( $thumbnail ){
		$url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full');
		ebor_page_header( get_the_title(), $url[0], false, false, get_post_meta($post->ID, '_ebor_header_colour', 1) );
	}
?>
	
	<div class="container">
	
		<div class="row add-top">
			<article class="col-md-10 col-md-offset-1 text-center">
				<?php 
					if(!( $thumbnail ))
						the_title('<h1 class="super-heading grey font2"><span>', '</span></h1>' . ebor_expose_seperator(1) );
				?>
			</article>
		</div>
	
		<div class="row add-bottom">
			<article id="page-<?php the_ID(); ?>" <?php post_class('col-md-10 col-md-offset-1'); ?>>
				<?php 
					the_content();
					wp_link_pages();
				?>
			</article>
		</div>
		
	</div>

<?php 
	get_footer();