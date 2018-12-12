<?php 

/**
 * Build theme metaboxes
 * Uses the cmb metaboxes class found in the ebor framework plugin
 * More details here: https://github.com/WebDevStudios/Custom-Metaboxes-and-Fields-for-WordPress
 * 
 * @since 1.0.0
 * @author tommusrhodus
 */
if(!( function_exists('ebor_custom_metaboxes') )){
	function ebor_custom_metaboxes( $meta_boxes ) {
		
		/**
		 * Setup variables
		 */
		$prefix = '_ebor_';
		
		/**
		 * Post & Portfolio Header Images
		 */
		$meta_boxes[] = array(
			'id' => 'post_header_metabox',
			'title' => __('Page Overrides', 'expose'),
			'object_types' => array('page', 'team', 'post', 'portfolio', 'product'), // post type
			'context' => 'normal',
			'priority' => 'low',
			'show_names' => true, // Show field names on the left
			'fields' => array(
				array(
					'name'         => __( 'Override Header?', 'expose' ),
					'desc'         => __( 'Header Layout is set in "appearance" -> "customise". To override this for this page only, use this control.', 'expose' ),
					'id'           => $prefix . 'header_override',
					'type'         => 'select',
					'options'      => array(
						'dark' => 'Dark Logo & Menu Icon',
						'light' => 'Light Logo & Menu Icon'
					),
					'std'          => 'dark'
				),
				array(
					'name' => __('Page Title Text Colour', 'expose'),
					'desc' => '(Optional)',
					'id'   => $prefix . 'header_colour',
					'type' => 'colorpicker',
					'default' => ''
				),
			)
		);
		
		/**
		 * Social Icons for Team Members
		 */
		$meta_boxes[] = array(
			'id' => 'social_metabox',
			'title' => __('Team Details', 'expose'),
			'object_types' => array('team'), // post type
			'context' => 'normal',
			'priority' => 'high',
			'show_names' => true, // Show field names on the left
			'fields' => array(
				array(
					'name' => __('Job Title', 'expose'),
					'desc' => '(Optional) Enter a Job Title for this Team Member',
					'id'   => $prefix . 'the_job_title',
					'type' => 'text',
				),
			)
		);
		
		return $meta_boxes;
	}
	add_filter( 'cmb2_meta_boxes', 'ebor_custom_metaboxes' );
}