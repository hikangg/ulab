<?php 
	get_header();
	the_post();
	
	$thumbnail = has_post_thumbnail();
	$class = ( is_active_sidebar('primary') ) ? 'col-md-8': 'col-md-10 col-md-offset-1';
	
	if( $thumbnail ){
		$url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full');
		ebor_page_header( get_the_title(), $url[0], 'fullheight', get_the_time(get_option('date_format')), get_post_meta($post->ID, '_ebor_header_colour', 1) );
	}
?>

<div class="container">
	<div class="row add-top add-bottom">
		<article class="col-md-12">
			<section class="inner-section pricing-info">
				<section class="container">
					<div class="row">
					
						<article class="<?php echo esc_attr($class); ?>">
						
							<div class="text-center">
								<?php 
									get_template_part('inc/content','post-meta');
									
									if(!( $thumbnail ))
										the_title( '<h1 class="super-heading grey font2"><span>', '</span></h1>'  . ebor_expose_seperator(1) );
								?>
							</div>
							
							<?php
								the_content();
								wp_link_pages();
								the_tags(__('Tags: ', 'expose'),', ','');
							?>
							
						</article>
						
						<?php get_sidebar(); ?>
						
					</div>
				</section>
			</section>	
		</article>
	</div>
</div>

<?php 
	if( comments_open() )
		comments_template();
		
	get_template_part('inc/content-post','nav');
	
	get_footer();