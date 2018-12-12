<?php 
	get_header();
	global $wp_query;
	$total_results = $wp_query->found_posts;
	$items = ( $total_results == '1' ) ? __(' Item','expose') : __(' Items','expose'); 
	
	ebor_page_header( get_search_query(), get_option('blog_header_background','Our Journal'), false, __('Found ','expose') . $total_results . $items );
	
	$part = (is_active_sidebar('primary')) ? 'blog-sidebar': 'blog';
	get_template_part('loop/loop', $part);
	
	get_footer();