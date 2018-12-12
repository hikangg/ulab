<?php 

/**
 * Force Visual Composer to initialize as "built into the theme". This will hide certain tabs under the Settings->Visual Composer page
 */
if( function_exists('vc_set_as_theme') ){
	function ebor_vcSetAsTheme() {
		vc_set_as_theme();
	}
	add_action( 'vc_before_init', 'ebor_vcSetAsTheme' );
}

/**
 * Add additional functions to certain blocks.
 * vc_map runs before custom post types and taxonomies are created, so this function is used
 * to add custom taxonomy selectors to VC blocks, a little annoying, but works perfectly.
 */
if(!( function_exists('ebor_vc_add_att') )){
	function ebor_vc_add_attr(){

		/**
		 * Add background atrributes to VC Rows
		 */
		$attributes = array(
			'type' => 'dropdown',
			'heading' => "Background Style",
			'param_name' => 'background_style',
			'value' => array_flip(array(
				'white-bg' => 'White Background',
				'offwhite-bg' => 'Grey Background',
				'color-bg' => 'Color Background',
				'full' => 'Fullwidth Section',
			)),
			'description' => "Choose Background Style For This Row"
		);
		vc_add_param('vc_row', $attributes);
		
		/**
		 * Add team category selectors
		 */
		$team_args = array(
			'orderby'                  => 'name',
			'hide_empty'               => 0,
			'hierarchical'             => 1,
			'taxonomy'                 => 'team_category'
		);
		$team_cats = get_categories( $team_args );
		$final_team_cats = array( 'Show all categories' => 'all' );
		
		foreach( $team_cats as $cat ){
			$final_team_cats[$cat->name] = $cat->term_id;
		}
		
		$attributes = array(
			'type' => 'dropdown',
			'heading' => "Show Specific Team Category?",
			'param_name' => 'filter',
			'value' => $final_team_cats
		);
		vc_add_param('expose_team', $attributes);
		
		/**
		 * Add portfolio category selectors
		 */
		$portfolio_args = array(
			'orderby'                  => 'name',
			'hide_empty'               => 0,
			'hierarchical'             => 1,
			'taxonomy'                 => 'portfolio_category'
		);
		$portfolio_cats = get_categories( $portfolio_args );
		$final_portfolio_cats = array( 'Show all categories' => 'all' );
		
		foreach( $portfolio_cats as $cat ){
			$final_portfolio_cats[$cat->name] = $cat->term_id;
		}
		
		$attributes = array(
			'type' => 'dropdown',
			'heading' => "Show Specific Portfolio Category?",
			'param_name' => 'filter',
			'value' => $final_portfolio_cats
		);
		vc_add_param('expose_portfolio', $attributes);
		
		/**
		 * Add blog category selectors
		 */
		$blog_args = array(
			'orderby'                  => 'name',
			'hide_empty'               => 0,
			'hierarchical'             => 1,
			'taxonomy'                 => 'category'
		);
		$blog_cats = get_categories( $blog_args );
		$final_blog_cats = array( 'Show all categories' => 'all' );
		
		foreach( $blog_cats as $cat ){
			$final_blog_cats[$cat->name] = $cat->term_id;
		}
		
		$attributes = array(
			'type' => 'dropdown',
			'heading' => "Show Specific blog Category?",
			'param_name' => 'filter',
			'value' => $final_blog_cats
		);
		vc_add_param('expose_blog', $attributes);

	}
	add_action('init', 'ebor_vc_add_attr', 999);
}

/**
 * Redirect page template if vc_row shortcode is found in the page.
 * This lets us use a dedicated page template for Visual Composer pages
 * without the need for on page checks, or custom page templates.
 * 
 * It's buyer-proof basically.
 */
if(!( function_exists('ebor_vc_page_template') )){
	function ebor_vc_page_template( $template ){
		global $post;
		
		if(!( isset($post->post_content) ) || is_search())
			return $template;
			
		if( has_shortcode($post->post_content, 'vc_row') ){
			$new_template = locate_template( array( 'page_visual_composer.php' ) );
			if (!( '' == $new_template )){
				return $new_template;
			}
		}
		return $template;
	}
	add_filter( 'template_include', 'ebor_vc_page_template', 99 );
}

/**
 * Page builder blocks below here
 * Whoop-dee-doo
 */
if(!( function_exists('ebor_service_shortcode') ))
	require_once('vc_blocks/vc_service_block.php');
	
if(!( function_exists('ebor_clients_shortcode') ))
	require_once('vc_blocks/vc_clients_block.php');
	
if(!( function_exists('ebor_call_to_action_shortcode') ))
	require_once('vc_blocks/vc_call_to_action_block.php');
	
if(!( function_exists('ebor_services_carousel_shortcode') ))
	require_once('vc_blocks/vc_services_carousel_block.php');
	
if(!( function_exists('ebor_services_tabs_shortcode') ))
	require_once('vc_blocks/vc_services_tabs_block.php');
	
if(!( function_exists('ebor_section_title_shortcode') ))
	require_once('vc_blocks/vc_section_title_block.php');
	
if(!( function_exists('ebor_contact_form_shortcode') ))
	require_once('vc_blocks/vc_contact_block.php');
	
if(!( function_exists('ebor_pricing_table_shortcode') ))
	require_once('vc_blocks/vc_pricing_table_block.php');
	
if(!( function_exists('ebor_fullscreen_parallax_shortcode') ))
	require_once('vc_blocks/vc_fullscreen_parallax_block.php');
	
if(!( function_exists('ebor_page_header_shortcode') ))
	require_once('vc_blocks/vc_page_header_block.php');
	
if(!( function_exists('ebor_canvas_page_header_shortcode') ))
	require_once('vc_blocks/vc_canvas_page_header_block.php');
	
if(!( function_exists('ebor_portfolio_shortcode') ))
	require_once('vc_blocks/vc_portfolio_block.php');
	
if(!( function_exists('ebor_blog_shortcode') ))
	require_once('vc_blocks/vc_blog_block.php');
	
if(!( function_exists('ebor_team_shortcode') ))
	require_once('vc_blocks/vc_team_block.php');
	
if(!( function_exists('ebor_video_background_shortcode') ))
	require_once('vc_blocks/vc_video_background_block.php');
	
if(!( function_exists('ebor_agency_tiles_shortcode') ))
	require_once('vc_blocks/vc_agency_tiles_block.php');
	
if(!( function_exists('ebor_testimonials_shortcode') ))
	require_once('vc_blocks/vc_testimonials_block.php');