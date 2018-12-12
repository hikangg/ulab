<?php 
	get_header();
	$term = get_queried_object();
	
	ebor_page_header( $term->name, get_option('blog_header_background','Our Journal') );
	
	$part = (is_active_sidebar('primary')) ? 'blog-sidebar': 'blog';
	get_template_part('loop/loop', $part);
	
	get_footer();