<?php 
	get_header();
	
	ebor_page_header( get_option('blog_title','Our Journal'), get_option('blog_header_background') );
	
	$part = (is_active_sidebar('primary')) ? 'blog-sidebar': 'blog';
	get_template_part('loop/loop', $part);
	
	get_footer();