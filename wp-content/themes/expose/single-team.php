<?php 
	get_header();
	the_post();
	
	$thumbnail = has_post_thumbnail();
	
	if( $thumbnail ){
		$url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full');
		ebor_page_header( get_the_title(), $url[0], 'fullheight', ebor_the_terms('team_category', ', ', 'name'), get_post_meta($post->ID, '_ebor_header_colour', 1) );
	}
?>

<div class="container">
	<div class="row add-top add-bottom">
		<article class="col-md-12">
			<section class="inner-section pricing-info">
				<section class="container">
					<div class="row">
						<article class="col-md-10 col-md-offset-1">
							<?php
								if(!( $thumbnail ))
									the_title( '<div class="text-center"><h1 class="super-heading grey font2"><span>', '</span></h1>'  . ebor_expose_seperator(1) . '</div>' );
									
								the_content();
								wp_link_pages();
							?>
						</article>
					</div>
				</section>
			</section>	
		</article>
	</div>
</div>

<?php 
	get_footer();