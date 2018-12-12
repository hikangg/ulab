<?php 

/**
 * Filter previous post link
 */
if(!( function_exists('ebor_prev_post_link_attributes') )){ 
	function ebor_prev_post_link_attributes($output) {
	    $class = 'class="aux-icon-btn"';
	    return str_replace('<a href=', '<a '.$class.' href=', $output);
	}
	add_filter('previous_post_link', 'ebor_prev_post_link_attributes');
}

/**
 * Filter next post link
 */
if(!( function_exists('ebor_next_post_link_attributes') )){ 
	function ebor_next_post_link_attributes($output) {
	    $class = 'class="aux-icon-btn"';
	    return str_replace('<a href=', '<a '.$class.' href=', $output);
	}
	add_filter('next_post_link', 'ebor_next_post_link_attributes');
}

/**
 * Add a clearfix to the end of the_content()
 */
if(!( function_exists('ebor_add_clearfix') )){ 
	function ebor_add_clearfix( $content ) { 
	    $content = $content .= '<div class="clearfix"></div>';
	    return $content;
	}
	add_filter( 'the_content', 'ebor_add_clearfix' ); 
}

/**
 * Add additional settings to gallery shortcode
 */
if(!( function_exists('ebor_add_gallery_settings') )){ 
	function ebor_add_gallery_settings(){
	?>
	
		<script type="text/html" id="tmpl-expose-gallery-setting">
			<h3>Expose Theme Gallery Settings</h3>
			<label class="setting">
				<span><?php _e('Gallery Layout', 'expose'); ?></span>
				<select data-setting="layout">
					<option value="default">Default Layout</option>
					<option value="slider">Expose Slider</option>              
				</select>
			</label>
		</script>
	
		<script>
			jQuery(document).ready(function(){
				_.extend(wp.media.gallery.defaults, { layout: 'default' });
				
				wp.media.view.Settings.Gallery = wp.media.view.Settings.Gallery.extend({
					template: function(view){
					  return wp.media.template('gallery-settings')(view)
					       + wp.media.template('expose-gallery-setting')(view);
					}
				});
			});
		</script>
	  
	<?php
	}
	add_action('print_media_templates', 'ebor_add_gallery_settings');
}

/**
 * Filter gallery shortcode
 */
if(!( function_exists('ebor_post_gallery') )){ 
	function ebor_post_gallery( $output, $attr) {
	
		global $post, $wp_locale;
		static $instance = 0;
		$instance++;
	
		if ( ! empty( $attr['ids'] ) ) {
			// 'ids' is explicitly ordered, unless you specify otherwise.
			if ( empty( $attr['orderby'] ) ) {
				$attr['orderby'] = 'post__in';
			}
			$attr['include'] = $attr['ids'];
		}
	
		// We're trusting author input, so let's at least make sure it looks like a valid orderby statement
		if ( isset( $attr['orderby'] ) ) {
			$attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
			if ( ! $attr['orderby'] ) {
				unset( $attr['orderby'] );
			}
		}
	
		$html5 = current_theme_supports( 'html5', 'gallery' );
		$atts = shortcode_atts( array(
			'order'      => 'ASC',
			'orderby'    => 'menu_order ID',
			'id'         => $post ? $post->ID : 0,
			'itemtag'    => $html5 ? 'figure'     : 'dl',
			'icontag'    => $html5 ? 'div'        : 'dt',
			'captiontag' => $html5 ? 'figcaption' : 'dd',
			'columns'    => 3,
			'size'       => 'thumbnail',
			'include'    => '',
			'exclude'    => '',
			'link'       => '',
			'layout'     => ''
		), $attr, 'gallery' );
	
		$id = intval( $atts['id'] );
		if ( 'RAND' == $atts['order'] ) {
			$atts['orderby'] = 'none';
		}
	
		if ( ! empty( $atts['include'] ) ) {
			$_attachments = get_posts( array( 'include' => $atts['include'], 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $atts['order'], 'orderby' => $atts['orderby'] ) );
	
			$attachments = array();
			foreach ( $_attachments as $key => $val ) {
				$attachments[$val->ID] = $_attachments[$key];
			}
		} elseif ( ! empty( $atts['exclude'] ) ) {
			$attachments = get_children( array( 'post_parent' => $id, 'exclude' => $atts['exclude'], 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $atts['order'], 'orderby' => $atts['orderby'] ) );
		} else {
			$attachments = get_children( array( 'post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $atts['order'], 'orderby' => $atts['orderby'] ) );
		}
	
		if ( empty( $attachments ) ) {
			return '';
		}
	
		if ( is_feed() ) {
			$output = "\n";
			foreach ( $attachments as $att_id => $attachment ) {
				$output .= wp_get_attachment_link( $att_id, $atts['size'], true ) . "\n";
			}
			return $output;
		}
		
		/**
		 * Return the Expose Slider
		 */
		if( $atts['layout'] == 'slider' ){
			$output = '<div class="post-slider owl-carousel">';
			foreach ( $attachments as $id => $attachment ) {
			   $output .= '<div class="item">'. wp_get_attachment_image($id, 'large') .'</div>';
			}   
			$output .= '</div>';
			return $output;
		}
		
		/**
		 * Return the Expose Lightbox Grid
		 */
		if(!( $atts['layout'] == 'slider' )){
			$i = 0;
			$output = '<div class="row add-top-quarter zoom">';
			foreach ( $attachments as $id => $attachment ) {
				$i++;
				$image = wp_get_attachment_image_src($id, 'full');
			    $output .= '<article class="col-md-6"><a class="venobox" data-gall="portfolio-gallery" href="'. $image[0] .'">'. wp_get_attachment_image($id, 'grid') .'</a></article>';
			    if($i % 2 == 0)
			    	$output .= '</div><div class="row add-top-quarter zoom">';
			}
			$output .= '</div>';
			return $output;
		}

	}
	add_filter( 'post_gallery', 'ebor_post_gallery', 10, 2 );
}