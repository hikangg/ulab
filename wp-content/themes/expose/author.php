<?php 
	get_header();
	
	ebor_page_header( get_the_author_meta( 'display_name' ), get_option('blog_header_background','Our Journal') );
	
	$part = (is_active_sidebar('primary')) ? 'blog-sidebar': 'blog';
	get_template_part('loop/loop', $part);
	
	get_footer();