<?php 

/**
 * Show portfolio filters
 */
if(!( function_exists('ebor_portfolio_filters') )){
	function ebor_portfolio_filters($cats){
		$output = '<ul class="works-filter clearfix"><li><a id="all" href="#" data-filter="*" class="active"><span>'. __('All','expose') .'</span></a></li>';
		
		if(is_array($cats)){
			foreach($cats as $cat){
				$output .= '<li><a href="#" data-filter=".'. $cat->slug .'"><span>'. $cat->name .'</span></a></li>';
			}
		}

		$output .= '</ul>';
		return $output;	
	}
}

/**
 * Expose seperator
 */
if(!( function_exists('ebor_expose_seperator') )){
	function ebor_expose_seperator( $type = 1 ){
		if( 1 == $type ){
			return '<div class="separator"><img alt="expose-seperator" src="'. EBOR_THEME_DIRECTORY .'style/images/separator/01-white.png"/></div>';
		} elseif( 2 == $type ){
			return '<div class="separator2"><img alt="expose-seperator" src="'. EBOR_THEME_DIRECTORY .'style/images/separator/02-color.png"/></div>';
		} elseif( 3 == $type ){
			return '<div class="separator"><img alt="expose-seperator" src="'. EBOR_THEME_DIRECTORY .'style/images/separator/02-white.png"/></div>';
		}
	}
}

/**
 * Page headers
 */
if(!( function_exists('ebor_page_header') )){
	function ebor_page_header($title = false, $background = false, $fullheight = false, $subtitle = false, $colour = false){
		
		$before = $after = false;
		
		if(!( false == $fullheight )){
			$before = '<div class="valign"><div class="container">';
			$after = '</div></div>';	
		}
		
		if( $colour ){
			echo '<style>.ebor-header-hook { border-color: '. $colour.' !important; color: '. $colour .' !important; }</style>';	
		}
		
		echo '<div class="container-fluid"><div class="row"><article class="col-md-12 text-center page-bg parallax '. esc_attr($fullheight) .'" style="background-image: url('. esc_url($background) .');">';
		echo $before;
		
		if( $subtitle ){
			echo '<h3 class="inner-main-heading add-bottom-quarter font2 dark"><span class="ebor-header-hook">'. $subtitle .'</span></h3><h1 class="super-heading black font2"><span class="ebor-header-hook">'. $title .'</span></h1>';
		} else {
			echo '<h1 class="main-heading font2 dark"><span class="ebor-header-hook">'. $title .'</span></h1>';
		}
		
		echo $after;
		echo '</article></div></div>';
	}
}

/**
 * HEX to RGB Converter
 *
 * Converts a HEX input to an RGB array.
 * $param $hex - the inputted HEX code, can be full or shorthand, #ffffff or #fff
 * $since 1.0.0
 * $return string
 * $author tommusrhodus
 */
if(!( function_exists('ebor_hex2rgb') )){
	function ebor_hex2rgb($hex) {
	   $hex = str_replace("#", "", $hex);
	
	   if(strlen($hex) == 3) {
	      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
	      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
	      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
	   } else {
	      $r = hexdec(substr($hex,0,2));
	      $g = hexdec(substr($hex,2,2));
	      $b = hexdec(substr($hex,4,2));
	   }
	   $rgb = array($r, $g, $b);
	   return implode(",", $rgb); // returns the rgb values separated by commas
	   return $rgb; // returns an array with the rgb values
	}
}


/**
 * Portfolio Unlimited
 * Uses pre_get_posts to provide unlimited portfolio posts when viewing the /portfolio/ archive
 * $since 1.0.0
 */
if(function_exists( 'ebor_portfolio_unlimited' )){
	function ebor_portfolio_unlimited( $query ) {
	    if ( is_post_type_archive('portfolio') && !( is_admin() ) && $query->is_main_query() ) {
	        $query->set( 'posts_per_page', '-1' );
	    }    
	    return;
	}
	add_action( 'pre_get_posts', 'ebor_portfolio_unlimited' );
}

/**
 * Set revslider into theme mode
 */
if(function_exists( 'set_revslider_as_theme' )){
	function ebor_set_revslider_as_theme(){
		set_revslider_as_theme();
	}
	add_action( 'init', 'ebor_set_revslider_as_theme' );
}

/**
 * ebor_get_header_layout
 * 
 * Use to conditionally check the page header meta layout against the theme option for the same
 * In short, this function can override the global header option on a post by post basis
 * Call within get_header() for this to override the global header choice
 * 
 * @since 1.0.0
 * @author tommusrhodus
 */
if(!( function_exists('ebor_get_header_layout') )){
	function ebor_get_header_layout(){
		global $post;
		
		if(!( isset($post->ID) ))
			return get_option('header_layout', 'dark');
		
		$header = get_post_meta($post->ID, '_ebor_header_override', 1);
		if( '' == $header || false == $header || 'none' == $header ){
			$header = get_option('header_layout', 'dark');
		}
		
		return $header;	
	}
}

/**
 * Init theme options
 * Certain theme options need to be written to the database as soon as the theme is installed.
 * This is either for the enqueues in ebor-framework, or to override the default image sizes in WooCommerce.
 * Either way this function is only called when the theme is first activated, de-activating and re-activating the theme will result in these options returning to defaults.
 * 
 * $since 1.0.0
 * $author tommusrhodus
 */
if(!( function_exists('ebor_init_theme_options') )){
	/**
	 * Hook in on activation
	 */
	global $pagenow;
	
	/**
	 * Define image sizes
	 */
	function ebor_init_theme_options() {
	  	$catalog = array(
			'width' 	=> '440',	// px
			'height'	=> '295',	// px
			'crop'		=> 1 		// true
		);
	
		$single = array(
			'width' 	=> '600',	// px
			'height'	=> '600',	// px
			'crop'		=> 1 		// true
		);
	
		$thumbnail = array(
			'width' 	=> '113',	// px
			'height'	=> '113',	// px
			'crop'		=> 1 		// false
		);
	
		// Image sizes
		update_option( 'shop_catalog_image_size', $catalog ); 		// Product category thumbs
		update_option( 'shop_single_image_size', $single ); 		// Single product image
		update_option( 'shop_thumbnail_image_size', $thumbnail ); 	// Image gallery thumbs
		
		//Ebor Framework
		$framework_args = array(
			'pivot_shortcodes'      => '0',
			'pivot_widgets'         => '0',
			'portfolio_post_type'   => '1',
			'team_post_type'        => '1',
			'client_post_type'      => '0',
			'testimonial_post_type' => '1',
			'mega_menu'             => '0',
			'aq_resizer'            => '1',
			'page_builder'          => '0',
			'likes'                 => '0',
			'options'               => '1',
			'metaboxes'             => '1',
			'elemis_widgets'        => '0',
			'elemis_shortcodes'     => '0'
		);
		update_option('ebor_framework_options', $framework_args);
	}
	
	/**
	 * Only call this action when we first activate the theme.
	 */
	if ( is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php' ){
		add_action( 'init', 'ebor_init_theme_options', 1 );
	}
}

/**
 * Register Menu Locations For The Theme
 * 
 * $since 1.0.0
 * $author tommusrhodus
 */
if(!( function_exists('ebor_register_nav_menus') )){
	function ebor_register_nav_menus() {
		register_nav_menus( 
			array(
				'primary' => __( 'Standard Navigation', 'expose' )
			) 
		);
	}
	add_action( 'init', 'ebor_register_nav_menus' );
}

if(!( function_exists('ebor_register_sidebars') )){
	function ebor_register_sidebars() {
	
		register_sidebar( 
			array(
				'id' => 'primary',
				'name' => __( 'Blog Sidebar', 'expose' ),
				'description' => __( 'Widgets to be displayed in the blog sidebar.', 'expose' ),
				'before_widget' => '<div id="%1$s" class="sidebox widget %2$s">',
				'after_widget' => '</div>',
				'before_title' => '<h4 class="add-top-half shop-subheading offwhite-bg">',
				'after_title' => '</h4>'
			) 
		);
		
		register_sidebar( 
			array(
				'id' => 'shop',
				'name' => __( 'Shop Sidebar', 'expose' ),
				'description' => __( 'Widgets to be displayed in the shop sidebar.', 'expose' ),
				'before_widget' => '<div id="%1$s" class="sidebox widget %2$s">',
				'after_widget' => '</div>',
				'before_title' => '<h4 class="add-top-half shop-subheading offwhite-bg">',
				'after_title' => '</h4>'
			) 
		);
		
	}
	add_action( 'widgets_init', 'ebor_register_sidebars' );
}
 
/**
 * Ebor Load Scripts
 * Properly Enqueues Scripts & Styles for the theme
 * $since version 1.0
 * $author TommusRhodus
 */ 
if(!( function_exists('ebor_load_scripts') )){
	function ebor_load_scripts() {
				
		//setup variables
		$protocol = is_ssl() ? 'https' : 'http';
		$directory = trailingslashit(get_template_directory_uri());
		
		$font1_url = get_option('font_1_url', $protocol . '://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,400,700');
		$font2_url = get_option('font_2_url', $protocol . '://fonts.googleapis.com/css?family=Montserrat:400,700');
		$font3_url = get_option('font_3_url', $protocol . '://fonts.googleapis.com/css?family=Raleway:400,300,700,900');
		
		//Enqueue Fonts
		if( $font1_url )
			wp_enqueue_style( 'ebor-body-font', $font1_url );
			
		if( $font2_url )
			wp_enqueue_style( 'ebor-heading-font', $font2_url );
			
		if( $font3_url )
			wp_enqueue_style( 'ebor-alt-font', $font3_url );
			
		//Enqueue Styles
		wp_enqueue_style( 'ebor-bootstrap', $directory . 'style/bootstrap/css/bootstrap.min.css' );
		wp_enqueue_style( 'ebor-font-awesome', $directory . 'style/css/font-awesome.min.css' );
		wp_enqueue_style( 'ebor-intro', $directory . 'style/css/intro.css' );
		wp_enqueue_style( 'ebor-plugins', $directory . 'style/css/plugins.css' );
		wp_enqueue_style( 'ebor-shop', $directory . 'style/css/shop.css' );
		wp_enqueue_style( 'ebor-style', get_stylesheet_uri() );
		
		//Enqueue Scripts
		wp_enqueue_script( 'ebor-modernizr', $directory . 'style/js/modernizr.js', array('jquery'), false, false  );
		wp_enqueue_script( 'ebor-pace', $directory . 'style/js/pace.js', array('jquery'), false, false  );
		wp_enqueue_script( 'ebor-bootstrap', $directory . 'style/bootstrap/js/bootstrap.min.js', array('jquery'), false, true  );
		wp_enqueue_script( 'ebor-plugins', $directory . 'style/js/plugins.js', array('jquery'), false, true  );
		wp_enqueue_script( 'ebor-scripts', $directory . 'style/js/main.js', array('jquery'), false, true  );
		
		//Enqueue Comments
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
		
		$color = get_option('color_highlight','#FFC740');
		$white = get_option('color_white','#FFFFFF');
		$grey = get_option('color_grey','#cfccc4');
		$offwhite = get_option('color_offwhite','#EBEBEB');
		$dark = get_option('color_dark','#121212');
		$black = get_option('color_black','#000000');
		$font1 = get_option('font_1','Open Sans');
		$font2 = get_option('font_2','Montserrat');
		$font3 = get_option('font_3','Raleway');
		$header_background = esc_url(get_option('logo_header_background'));
		
		$custom_styles = "
			.white{
				color:$white;
			}
			.offwhite{
				color:$offwhite;
			}
			.dark{
				color:$dark;
			}
			.black{
				color:$black;
			}
			.grey{
				color:$grey ;
			}
			.color{
				color:$color;
			}
			
			.white-bg{
				background:$white;
			}
			.offwhite-bg{
				background:$offwhite;
			}
			.dark-bg{
				background:$dark;
			}
			.black-bg{
				background:$black;
			}
			.grey-bg{
				background:$grey;
			}
			.color-bg{
				background:$color;
			}
			div.curtain,
			.woocommerce .widget_price_filter .ui-slider-horizontal .ui-slider-range, .woocommerce-page .widget_price_filter .ui-slider-horizontal .ui-slider-range {
				background:$color !important;
			}
			.woocommerce .widget_price_filter .ui-slider .ui-slider-handle, .woocommerce-page .widget_price_filter .ui-slider .ui-slider-handle {
				background:$black !important;
			}
			span.white-bg {
				background: $offwhite !important;
			}
			::selection {
			  background: $color;
			  color:$black;
			}
			::-moz-selection {
			  background: $color;
			  color:$black;
			}
			
			a{
				color:$black;
			}
			a:hover{
				color:$color;
			}
			
			.btn-expose-color{
				border-color:$color;
				color:$color;
			}
			.btn-expose-color:hover{
				background-color:$color;
				color:$white;
			}
			.menu-block{
				border-color:$white;
			}
			.menu-block:hover{
				border-color:$dark;
			}
			.menu-block:hover a{
				color:$dark;
			}
			.menu-block a{
				color:$white;
			}
			.main-heading.white span{
				border-color:$white;
			}
			.main-heading.dark span{
				border-color:$dark;
			}
			.main-heading.black span{
				border-color:$black;
			}
			.inner-main-heading.white span{
				border-color:$white;
			}
			.inner-main-heading.dark span{
				border-color:$dark;
			}
			.inner-main-heading.black span{
				border-color:$black;
			}
			.works-filter li a > span, 
			.works-filter li:after{
				color:$grey;
			}
			.works-item a{
			}
			.works-item a:hover{
				border-color:$grey;
			}
			
			.works-item-inner p > span{  
				border-color:$dark;
			}
			.main-nav-menu li a.main-nav-link{
				color:$dark;
			}
			.main-nav-menu li a.main-nav-link:focus{
				color:$black;
				border-color:$black;
			}
			.main-nav-menu li a.main-nav-link:hover{
				color:$black;
			}
			.sub-nav a:hover{
				color:$color;
			}
			.copy-credits{
				border-color:$black;
			}
			.copy-credits h4 > a:hover{
				color:$color;
			}
			
			.showcases-overlay h1.black > span{
				border-color:$black;
			}
			.showcases-overlay h1.white > span{
				border-color:$white;
			}
			.showcases-overlay h1.color > span{
				border-color:$color;
			}
			.intro09-overlay h1.black > span{
				border-color:$black;
			}
			.intro09-overlay h1.white > span{
				border-color:$white;
			}
			.intro09-overlay h1.color > span{
				border-color:$color;
			}
			.showcase-carousels-overlay h1.black > span{
				border-color:$black;
			}
			.showcase-carousels-overlay h1.white > span{
				border-color:$white;
			}
			.showcase-carousels-overlay h1.color > span{
				border-color:$color;
			}
			
			.news-grid .grid li.shown:hover > a::before {
				border-color:$offwhite;
			}
			.pricing-container .pricing-header {
				border-color:$offwhite;
			}
			.grid li.shown:hover h3 {
				color:$color;
			}
			
			.pricing-container .pricing-features, 
			.pricing-container .pricing-features .each h2 { 
				border-color:$offwhite;
			}
			
			.aux-icon-btn-wrap a{
				border-color:$grey;
			}
			.aux-icon-btn-wrap a:hover{
				border-color:$dark;
			}
			.aux-icon-btn:hover span{
				color:$dark;
			}
			
			.agency-service-block .service-inner-wrap{
				border-color:$offwhite;
			}
			.agency-service-block .service-inner-wrap:hover{
				border-color:$black;
			}
			
			.shop-item-2 {
				border-color:$offwhite;
			}
			.shop-item-2:hover {
				border-color:$black;
			} 
			
			.video-title-holder h1 > span{
				border-color:$white;
			}
			.tweet_text{
				color:$black;
			}
			.slide-title.dark{
				border-color:$dark;
			}
			.slide-title.white{
				border-color:$white;
			}
			.slide-title.color{
				border-color:$color;
			}
			
			.client-logo-inner, .client-logo-row{
				border-color:$color;
			}
			#contact-form-wrap textarea:focus, #contact-form-wrap input:focus{
				border-color:$white !important;
				color:$white !important;
			}
			.font1{
				font-family: $font1;
			}
			.font2{
				font-family: $font2;
			}
			.font3{
				font-family: $font3;
			}
			
			body, p{
				font-family: $font3;
			}
			
			
			.btn-expose{
				font-family: $font2;
			}
			.menu-block{
				font-family: $font2;
			}
			
			.works-filter li a > span, .works-filter li:after{
				font-family: $font2;
			}
			.tweet_text, .tweet_time{
				font-family: $font3;
			}
			.menu-panel { 
				background-image: url($header_background);
			}
		";
		wp_add_inline_style( 'ebor-style', $custom_styles );
		
		//Add custom CSS ability
		wp_add_inline_style( 'ebor-style', get_option('custom_css') );
		
		/**
		 * localize script
		 */
		$script_data = array( 
			'color_interactive' => esc_js(ebor_hex2rgb(get_option('color_interactive','#9cd9f9')))
		);
		wp_localize_script( 'ebor-scripts', 'wp_data', $script_data );
	}
	add_action('wp_enqueue_scripts', 'ebor_load_scripts', 10);
}

/**
 * Ebor Load Admin Scripts
 * Properly Enqueues Scripts & Styles for the theme
 * 
 * $since version 1.0
 * $author TommusRhodus
 */
if(!( function_exists('ebor_admin_load_scripts') )){
	function ebor_admin_load_scripts(){
		$directory = trailingslashit(get_template_directory_uri());
		wp_enqueue_style( 'ebor-theme-admin-css', $directory . 'admin/ebor-theme-admin.css' );
		wp_enqueue_script( 'ebor-theme-admin-js', $directory . 'admin/ebor-theme-admin.js', array('jquery'), false, true  );
	}
	add_action('admin_enqueue_scripts', 'ebor_admin_load_scripts', 200);
}

/**
 * Register the required plugins for this theme.
 * 
 * $since 1.0.0
 * $author tommusrhodus
 */
if(!( function_exists('ebor_register_required_plugins') )){
	function ebor_register_required_plugins() {
		$plugins = array(
			array(
			    'name'      => 'Contact Form 7',
			    'slug'      => 'contact-form-7',
			    'required'  => false,
			    'version' 	=> '3.7.2'
			),
			array(
			    'name'      => 'WooCommerce',
			    'slug'      => 'woocommerce',
			    'required'  => false,
			    'version' 	=> '2.0.0'
			),
			array(
				'name'     				=> 'Visual Composer',
				'slug'     				=> 'js_composer',
				'source'   				=> 'http://www.madeinebor.com/plugin-downloads/js_composer.zip',
				'required' 				=> true,
				'external_url' 			=> 'http://www.madeinebor.com/plugin-downloads/js_composer.zip',
			),
			array(
				'name'     				=> 'Ebor Framework',
				'slug'     				=> 'Ebor-Framework-master',
				'source'   				=> 'https://github.com/tommusrhodus/ebor-framework/archive/master.zip',
				'required' 				=> true,
				'version' 				=> '1.0.0',
				'external_url' 			=> 'https://github.com/tommusrhodus/ebor-framework/archive/master.zip',
			),
			array(
				'name'     				=> 'Revolution Slider',
				'slug'     				=> 'revslider',
				'source'   				=> 'http://www.madeinebor.com/plugin-downloads/revslider.zip',
				'required' 				=> false,
				'external_url'   		=> 'http://www.madeinebor.com/plugin-downloads/revslider.zip',
			),
		);
		$config = array(
			'is_automatic' => true,
		);
		tgmpa( $plugins, $config );
	}
	add_action( 'tgmpa_register', 'ebor_register_required_plugins' );
}

/**
 * Custom Comment Markup for Pivot
 * 
 * @since 1.0.0
 * @author tommusrhodus
 */
if(!( function_exists('ebor_custom_comment') )){
	function ebor_custom_comment($comment, $args, $depth) { 
		$GLOBALS['comment'] = $comment; 
	?>
		
		<li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
		  <div class="user"><?php echo get_avatar( $comment->comment_author_email, 70 ); ?></div>
		  <div class="message">
		    <div class="arrow-box">
		      <div class="info">
		        <?php printf('<h2>%s</h2>', get_comment_author_link()); ?>
		        <div class="meta">
		        	<span class="date"><?php echo get_comment_date(); ?></span>
		        	<span class="reply"><?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?></span>
		        </div>
		      </div>
		      <?php echo wpautop( htmlspecialchars_decode( get_comment_text() ) ); ?>
		      <?php if ($comment->comment_approved == '0') : ?>
		      <p><em><?php _e('Your comment is awaiting moderation.', 'expose') ?></em></p>
		      <?php endif; ?>
		    </div>
		  </div>
		</li>
	
	<?php }
}

if(!( function_exists('ebor_pagination') )){
	function ebor_pagination($pages = '', $range = 2){
		$showitems = ($range * 2)+1;
		
		global $paged;
		if(empty($paged)) $paged = 1;
		
		if($pages == ''){
			global $wp_query;
			$pages = $wp_query->max_num_pages;
				if(!$pages) {
					$pages = 1;
				}
		}
		
		$output = '';
		
		if(1 != $pages){
			$output .= "<div class='pagination'><ul>";
			if($paged > 2 && $paged > $range+1 && $showitems < $pages) $output .= "<li><a class='btn btn-expose-dark btn-expose' href='".get_pagenum_link(1)."'>". __('First', 'expose') ."</a></li> ";
			
			for ($i=1; $i <= $pages; $i++){
				if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )){
					$output .= ($paged == $i)? "<li class='active'><a class='btn btn-expose-dark btn-expose btn-active' href='".get_pagenum_link($i)."'>".$i."</a></li> ":"<li><a class='btn btn-expose-dark btn-expose' href='".get_pagenum_link($i)."'>".$i."</a></li> ";
				}
			}
		
			if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) $output .= "<li><a class='btn btn-expose-dark btn-expose' href='".get_pagenum_link($pages)."'>". __('Last', 'expose') ."</a></li> ";
			$output.= "</ul></div>";
		}
		
		return $output;
	}
}

if(!( function_exists('ebor_icons_list') )){
	function ebor_icons_list(){
		$icon = array(
			'none' => 'No Icon',
			'fa-adjust' => 'adjust',
			'fa-anchor' => 'anchor',
			'fa-archive' => 'archive',
			'fa-arrows' => 'arrows',
			'fa-arrows-h' => 'arrows-h',
			'fa-arrows-v' => 'arrows-v',
			'fa-asterisk' => 'asterisk',
			'fa-automobile' => 'automobile',
			'fa-ban' => 'ban',
			'fa-bank' => 'bank',
			'fa-bar-chart-o' => 'bar-chart-o',
			'fa-barcode' => 'barcode',
			'fa-bars' => 'bars',
			'fa-beer' => 'beer',
			'fa-bell' => 'bell',
			'fa-bell-o' => 'bell-o',
			'fa-bolt' => 'bolt',
			'fa-bomb' => 'bomb',
			'fa-book' => 'book',
			'fa-bookmark' => 'bookmark',
			'fa-bookmark-o' => 'bookmark-o',
			'fa-briefcase' => 'briefcase',
			'fa-bug' => 'bug',
			'fa-building' => 'building',
			'fa-building-o' => 'building-o',
			'fa-bullhorn' => 'bullhorn',
			'fa-bullseye' => 'bullseye',
			'fa-cab' => 'cab',
			'fa-calendar' => 'calendar',
			'fa-calendar-o' => 'calendar-o',
			'fa-camera' => 'camera',
			'fa-camera-retro' => 'camera-retro',
			'fa-car' => 'car',
			'fa-caret-square-o-down' => 'caret-square-o-down',
			'fa-caret-square-o-left' => 'caret-square-o-left',
			'fa-caret-square-o-right' => 'caret-square-o-right',
			'fa-caret-square-o-up' => 'caret-square-o-up',
			'fa-certificate' => 'certificate',
			'fa-check' => 'check',
			'fa-check-circle' => 'check-circle',
			'fa-check-circle-o' => 'check-circle-o',
			'fa-check-square' => 'check-square',
			'fa-check-square-o' => 'check-square-o',
			'fa-child' => 'child',
			'fa-circle' => 'circle',
			'fa-circle-o' => 'circle-o',
			'fa-circle-o-notch' => 'circle-o-notch',
			'fa-circle-thin' => 'circle-thin',
			'fa-clock-o' => 'clock-o',
			'fa-cloud' => 'cloud',
			'fa-cloud-download' => 'cloud-download',
			'fa-cloud-upload' => 'cloud-upload',
			'fa-code' => 'code',
			'fa-code-fork' => 'code-fork',
			'fa-coffee' => 'coffee',
			'fa-cog' => 'cog',
			'fa-cogs' => 'cogs',
			'fa-comment' => 'comment',
			'fa-comment-o' => 'comment-o',
			'fa-comments' => 'comments',
			'fa-comments-o' => 'comments-o',
			'fa-compass' => 'compass',
			'fa-credit-card' => 'credit-card',
			'fa-crop' => 'crop',
			'fa-crosshairs' => 'crosshairs',
			'fa-cube' => 'cube',
			'fa-cubes' => 'cubes',
			'fa-cutlery' => 'cutlery',
			'fa-dashboard' => 'dashboard',
			'fa-database' => 'database',
			'fa-desktop' => 'desktop',
			'fa-dot-circle-o' => 'dot-circle-o',
			'fa-download' => 'download',
			'fa-edit' => 'edit',
			'fa-ellipsis-h' => 'ellipsis-h',
			'fa-ellipsis-v' => 'ellipsis-v',
			'fa-envelope' => 'envelope',
			'fa-envelope-o' => 'envelope-o',
			'fa-envelope-square' => 'envelope-square',
			'fa-eraser' => 'eraser',
			'fa-exchange' => 'exchange',
			'fa-exclamation' => 'exclamation',
			'fa-exclamation-circle' => 'exclamation-circle',
			'fa-exclamation-triangle' => 'exclamation-triangle',
			'fa-external-link' => 'external-link',
			'fa-external-link-square' => 'external-link-square',
			'fa-eye' => 'eye',
			'fa-eye-slash' => 'eye-slash',
			'fa-fax' => 'fax',
			'fa-female' => 'female',
			'fa-fighter-jet' => 'fighter-jet',
			'fa-file-archive-o' => 'file-archive-o',
			'fa-file-audio-o' => 'file-audio-o',
			'fa-file-code-o' => 'file-code-o',
			'fa-file-excel-o' => 'file-excel-o',
			'fa-file-image-o' => 'file-image-o',
			'fa-file-movie-o' => 'file-movie-o',
			'fa-file-pdf-o' => 'file-pdf-o',
			'fa-file-photo-o' => 'file-photo-o',
			'fa-file-picture-o' => 'file-picture-o',
			'fa-file-powerpoint-o' => 'file-powerpoint-o',
			'fa-file-sound-o' => 'file-sound-o',
			'fa-file-video-o' => 'file-video-o',
			'fa-file-word-o' => 'file-word-o',
			'fa-file-zip-o' => 'file-zip-o',
			'fa-film' => 'film',
			'fa-filter' => 'filter',
			'fa-fire' => 'fire',
			'fa-fire-extinguisher' => 'fire-extinguisher',
			'fa-flag' => 'flag',
			'fa-flag-checkered' => 'flag-checkered',
			'fa-flag-o' => 'flag-o',
			'fa-flash' => 'flash',
			'fa-flask' => 'flask',
			'fa-folder' => 'folder',
			'fa-folder-o' => 'folder-o',
			'fa-folder-open' => 'folder-open',
			'fa-folder-open-o' => 'folder-open-o',
			'fa-frown-o' => 'frown-o',
			'fa-gamepad' => 'gamepad',
			'fa-gavel' => 'gavel',
			'fa-gear' => 'gear',
			'fa-gears' => 'gears',
			'fa-gift' => 'gift',
			'fa-glass' => 'glass',
			'fa-globe' => 'globe',
			'fa-graduation-cap' => 'graduation-cap',
			'fa-group' => 'group',
			'fa-hdd-o' => 'hdd-o',
			'fa-headphones' => 'headphones',
			'fa-heart' => 'heart',
			'fa-heart-o' => 'heart-o',
			'fa-history' => 'history',
			'fa-home' => 'home',
			'fa-image' => 'image',
			'fa-inbox' => 'inbox',
			'fa-info' => 'info',
			'fa-info-circle' => 'info-circle',
			'fa-institution' => 'institution',
			'fa-key' => 'key',
			'fa-keyboard-o' => 'keyboard-o',
			'fa-language' => 'language',
			'fa-laptop' => 'laptop',
			'fa-leaf' => 'leaf',
			'fa-legal' => 'legal',
			'fa-lemon-o' => 'lemon-o',
			'fa-level-down' => 'level-down',
			'fa-level-up' => 'level-up',
			'fa-life-bouy' => 'life-bouy',
			'fa-life-ring' => 'life-ring',
			'fa-life-saver' => 'life-saver',
			'fa-lightbulb-o' => 'lightbulb-o',
			'fa-location-arrow' => 'location-arrow',
			'fa-lock' => 'lock',
			'fa-magic' => 'magic',
			'fa-magnet' => 'magnet',
			'fa-mail-forward' => 'mail-forward',
			'fa-mail-reply' => 'mail-reply',
			'fa-mail-reply-all' => 'mail-reply-all',
			'fa-male' => 'male',
			'fa-map-marker' => 'map-marker',
			'fa-meh-o' => 'meh-o',
			'fa-microphone' => 'microphone',
			'fa-microphone-slash' => 'microphone-slash',
			'fa-minus' => 'minus',
			'fa-minus-circle' => 'minus-circle',
			'fa-minus-square' => 'minus-square',
			'fa-minus-square-o' => 'minus-square-o',
			'fa-mobile' => 'mobile',
			'fa-mobile-phone' => 'mobile-phone',
			'fa-money' => 'money',
			'fa-moon-o' => 'moon-o',
			'fa-mortar-board' => 'mortar-board',
			'fa-music' => 'music',
			'fa-navicon' => 'navicon',
			'fa-paper-plane' => 'paper-plane',
			'fa-paper-plane-o' => 'paper-plane-o',
			'fa-paw' => 'paw',
			'fa-pencil' => 'pencil',
			'fa-pencil-square' => 'pencil-square',
			'fa-pencil-square-o' => 'pencil-square-o',
			'fa-phone' => 'phone',
			'fa-phone-square' => 'phone-square',
			'fa-photo' => 'photo',
			'fa-picture-o' => 'picture-o',
			'fa-plane' => 'plane',
			'fa-plus' => 'plus',
			'fa-plus-circle' => 'plus-circle',
			'fa-plus-square' => 'plus-square',
			'fa-plus-square-o' => 'plus-square-o',
			'fa-power-off' => 'power-off',
			'fa-print' => 'print',
			'fa-puzzle-piece' => 'puzzle-piece',
			'fa-qrcode' => 'qrcode',
			'fa-question' => 'question',
			'fa-question-circle' => 'question-circle',
			'fa-quote-left' => 'quote-left',
			'fa-quote-right' => 'quote-right',
			'fa-random' => 'random',
			'fa-recycle' => 'recycle',
			'fa-refresh' => 'refresh',
			'fa-reorder' => 'reorder',
			'fa-reply' => 'reply',
			'fa-reply-all' => 'reply-all',
			'fa-retweet' => 'retweet',
			'fa-road' => 'road',
			'fa-rocket' => 'rocket',
			'fa-rss' => 'rss',
			'fa-rss-square' => 'rss-square',
			'fa-search' => 'search',
			'fa-search-minus' => 'search-minus',
			'fa-search-plus' => 'search-plus',
			'fa-send' => 'send',
			'fa-send-o' => 'send-o',
			'fa-share' => 'share',
			'fa-share-alt' => 'share-alt',
			'fa-share-alt-square' => 'share-alt-square',
			'fa-share-square' => 'share-square',
			'fa-share-square-o' => 'share-square-o',
			'fa-shield' => 'shield',
			'fa-shopping-cart' => 'shopping-cart',
			'fa-sign-in' => 'sign-in',
			'fa-sign-out' => 'sign-out',
			'fa-signal' => 'signal',
			'fa-sitemap' => 'sitemap',
			'fa-sliders' => 'sliders',
			'fa-smile-o' => 'smile-o',
			'fa-sort' => 'sort',
			'fa-sort-alpha-asc' => 'sort-alpha-asc',
			'fa-sort-alpha-desc' => 'sort-alpha-desc',
			'fa-sort-amount-asc' => 'sort-amount-asc',
			'fa-sort-amount-desc' => 'sort-amount-desc',
			'fa-sort-asc' => 'sort-asc',
			'fa-sort-desc' => 'sort-desc',
			'fa-sort-down' => 'sort-down',
			'fa-sort-numeric-asc' => 'sort-numeric-asc',
			'fa-sort-numeric-desc' => 'sort-numeric-desc',
			'fa-sort-up' => 'sort-up',
			'fa-space-shuttle' => 'space-shuttle',
			'fa-spinner' => 'spinner',
			'fa-spoon' => 'spoon',
			'fa-square' => 'square',
			'fa-square-o' => 'square-o',
			'fa-star' => 'star',
			'fa-star-half' => 'star-half',
			'fa-star-half-empty' => 'star-half-empty',
			'fa-star-half-full' => 'star-half-full',
			'fa-star-half-o' => 'star-half-o',
			'fa-star-o' => 'star-o',
			'fa-suitcase' => 'suitcase',
			'fa-sun-o' => 'sun-o',
			'fa-support' => 'support',
			'fa-tablet' => 'tablet',
			'fa-tachometer' => 'tachometer',
			'fa-tag' => 'tag',
			'fa-tags' => 'tags',
			'fa-tasks' => 'tasks',
			'fa-taxi' => 'taxi',
			'fa-terminal' => 'terminal',
			'fa-thumb-tack' => 'thumb-tack',
			'fa-thumbs-down' => 'thumbs-down',
			'fa-thumbs-o-down' => 'thumbs-o-down',
			'fa-thumbs-o-up' => 'thumbs-o-up',
			'fa-thumbs-up' => 'thumbs-up',
			'fa-ticket' => 'ticket',
			'fa-times' => 'times',
			'fa-times-circle' => 'times-circle',
			'fa-times-circle-o' => 'times-circle-o',
			'fa-tint' => 'tint',
			'fa-toggle-down' => 'toggle-down',
			'fa-toggle-left' => 'toggle-left',
			'fa-toggle-right' => 'toggle-right',
			'fa-toggle-up' => 'toggle-up',
			'fa-trash-o' => 'trash-o',
			'fa-tree' => 'tree',
			'fa-trophy' => 'trophy',
			'fa-truck' => 'truck',
			'fa-umbrella' => 'umbrella',
			'fa-university' => 'university',
			'fa-unlock' => 'unlock',
			'fa-unlock-alt' => 'unlock-alt',
			'fa-unsorted' => 'unsorted',
			'fa-upload' => 'upload',
			'fa-user' => 'user',
			'fa-users' => 'users',
			'fa-video-camera' => 'video-camera',
			'fa-volume-down' => 'volume-down',
			'fa-volume-off' => 'volume-off',
			'fa-volume-up' => 'volume-up',
			'fa-warning' => 'warning',
			'fa-wheelchair' => 'wheelchair',
			'fa-wrench' => 'wrench',
			'fa-file' => 'file',
			'fa-file-archive-o' => 'file-archive-o',
			'fa-file-audio-o' => 'file-audio-o',
			'fa-file-code-o' => 'file-code-o',
			'fa-file-excel-o' => 'file-excel-o',
			'fa-file-image-o' => 'file-image-o',
			'fa-file-movie-o' => 'file-movie-o',
			'fa-file-o' => 'file-o',
			'fa-file-pdf-o' => 'file-pdf-o',
			'fa-file-photo-o' => 'file-photo-o',
			'fa-file-picture-o' => 'file-picture-o',
			'fa-file-powerpoint-o' => 'file-powerpoint-o',
			'fa-file-sound-o' => 'file-sound-o',
			'fa-file-text' => 'file-text',
			'fa-file-text-o' => 'file-text-o',
			'fa-file-video-o' => 'file-video-o',
			'fa-file-word-o' => 'file-word-o',
			'fa-file-zip-o' => 'file-zip-o',
			'fa-circle-o-notch' => 'circle-o-notch',
			'fa-cog' => 'cog',
			'fa-gear' => 'gear',
			'fa-refresh' => 'refresh',
			'fa-spinner' => 'spinner',
			'fa-check-square' => 'check-square',
			'fa-check-square-o' => 'check-square-o',
			'fa-circle' => 'circle',
			'fa-circle-o' => 'circle-o',
			'fa-dot-circle-o' => 'dot-circle-o',
			'fa-minus-square' => 'minus-square',
			'fa-minus-square-o' => 'minus-square-o',
			'fa-plus-square' => 'plus-square',
			'fa-plus-square-o' => 'plus-square-o',
			'fa-square' => 'square',
			'fa-square-o' => 'square-o',
			'fa-bitcoin' => 'bitcoin',
			'fa-btc' => 'btc',
			'fa-cny' => 'cny',
			'fa-dollar' => 'dollar',
			'fa-eur' => 'eur',
			'fa-euro' => 'euro',
			'fa-gbp' => 'gbp',
			'fa-inr' => 'inr',
			'fa-jpy' => 'jpy',
			'fa-krw' => 'krw',
			'fa-money' => 'money',
			'fa-rmb' => 'rmb',
			'fa-rouble' => 'rouble',
			'fa-rub' => 'rub',
			'fa-ruble' => 'ruble',
			'fa-rupee' => 'rupee',
			'fa-try' => 'try',
			'fa-turkish-lira' => 'turkish-lira',
			'fa-usd' => 'usd',
			'fa-won' => 'won',
			'fa-yen' => 'yen',
			'fa-align-center' => 'align-center',
			'fa-align-justify' => 'align-justify',
			'fa-align-left' => 'align-left',
			'fa-align-right' => 'align-right',
			'fa-bold' => 'bold',
			'fa-chain' => 'chain',
			'fa-chain-broken' => 'chain-broken',
			'fa-clipboard' => 'clipboard',
			'fa-columns' => 'columns',
			'fa-copy' => 'copy',
			'fa-cut' => 'cut',
			'fa-dedent' => 'dedent',
			'fa-eraser' => 'eraser',
			'fa-file' => 'file',
			'fa-file-o' => 'file-o',
			'fa-file-text' => 'file-text',
			'fa-file-text-o' => 'file-text-o',
			'fa-files-o' => 'files-o',
			'fa-floppy-o' => 'floppy-o',
			'fa-font' => 'font',
			'fa-header' => 'header',
			'fa-indent' => 'indent',
			'fa-italic' => 'italic',
			'fa-link' => 'link',
			'fa-list' => 'list',
			'fa-list-alt' => 'list-alt',
			'fa-list-ol' => 'list-ol',
			'fa-list-ul' => 'list-ul',
			'fa-outdent' => 'outdent',
			'fa-paperclip' => 'paperclip',
			'fa-paragraph' => 'paragraph',
			'fa-paste' => 'paste',
			'fa-repeat' => 'repeat',
			'fa-rotate-left' => 'rotate-left',
			'fa-rotate-right' => 'rotate-right',
			'fa-save' => 'save',
			'fa-scissors' => 'scissors',
			'fa-strikethrough' => 'strikethrough',
			'fa-subscript' => 'subscript',
			'fa-superscript' => 'superscript',
			'fa-table' => 'table',
			'fa-text-height' => 'text-height',
			'fa-text-width' => 'text-width',
			'fa-th' => 'th',
			'fa-th-large' => 'th-large',
			'fa-th-list' => 'th-list',
			'fa-underline' => 'underline',
			'fa-undo' => 'undo',
			'fa-unlink' => 'unlink',
			'fa-angle-double-down' => 'angle-double-down',
			'fa-angle-double-left' => 'angle-double-left',
			'fa-angle-double-right' => 'angle-double-right',
			'fa-angle-double-up' => 'angle-double-up',
			'fa-angle-down' => 'angle-down',
			'fa-angle-left' => 'angle-left',
			'fa-angle-right' => 'angle-right',
			'fa-angle-up' => 'angle-up',
			'fa-arrow-circle-down' => 'arrow-circle-down',
			'fa-arrow-circle-left' => 'arrow-circle-left',
			'fa-arrow-circle-o-down' => 'arrow-circle-o-down',
			'fa-arrow-circle-o-left' => 'arrow-circle-o-left',
			'fa-arrow-circle-o-right' => 'arrow-circle-o-right',
			'fa-arrow-circle-o-up' => 'arrow-circle-o-up',
			'fa-arrow-circle-right' => 'arrow-circle-right',
			'fa-arrow-circle-up' => 'arrow-circle-up',
			'fa-arrow-down' => 'arrow-down',
			'fa-arrow-left' => 'arrow-left',
			'fa-arrow-right' => 'arrow-right',
			'fa-arrow-up' => 'arrow-up',
			'fa-arrows' => 'arrows',
			'fa-arrows-alt' => 'arrows-alt',
			'fa-arrows-h' => 'arrows-h',
			'fa-arrows-v' => 'arrows-v',
			'fa-caret-down' => 'caret-down',
			'fa-caret-left' => 'caret-left',
			'fa-caret-right' => 'caret-right',
			'fa-caret-square-o-down' => 'caret-square-o-down',
			'fa-caret-square-o-left' => 'caret-square-o-left',
			'fa-caret-square-o-right' => 'caret-square-o-right',
			'fa-caret-square-o-up' => 'caret-square-o-up',
			'fa-caret-up' => 'caret-up',
			'fa-chevron-circle-down' => 'chevron-circle-down',
			'fa-chevron-circle-left' => 'chevron-circle-left',
			'fa-chevron-circle-right' => 'chevron-circle-right',
			'fa-chevron-circle-up' => 'chevron-circle-up',
			'fa-chevron-down' => 'chevron-down',
			'fa-chevron-left' => 'chevron-left',
			'fa-chevron-right' => 'chevron-right',
			'fa-chevron-up' => 'chevron-up',
			'fa-hand-o-down' => 'hand-o-down',
			'fa-hand-o-left' => 'hand-o-left',
			'fa-hand-o-right' => 'hand-o-right',
			'fa-hand-o-up' => 'hand-o-up',
			'fa-long-arrow-down' => 'long-arrow-down',
			'fa-long-arrow-left' => 'long-arrow-left',
			'fa-long-arrow-right' => 'long-arrow-right',
			'fa-long-arrow-up' => 'long-arrow-up',
			'fa-toggle-down' => 'toggle-down',
			'fa-toggle-left' => 'toggle-left',
			'fa-toggle-right' => 'toggle-right',
			'fa-toggle-up' => 'toggle-up',
			'fa-arrows-alt' => 'arrows-alt',
			'fa-backward' => 'backward',
			'fa-compress' => 'compress',
			'fa-eject' => 'eject',
			'fa-expand' => 'expand',
			'fa-fast-backward' => 'fast-backward',
			'fa-fast-forward' => 'fast-forward',
			'fa-forward' => 'forward',
			'fa-pause' => 'pause',
			'fa-play' => 'play',
			'fa-play-circle' => 'play-circle',
			'fa-play-circle-o' => 'play-circle-o',
			'fa-step-backward' => 'step-backward',
			'fa-step-forward' => 'step-forward',
			'fa-stop' => 'stop',
			'fa-youtube-play' => 'youtube-play',
			'fa-adn' => 'adn',
			'fa-android' => 'android',
			'fa-apple' => 'apple',
			'fa-behance' => 'behance',
			'fa-behance-square' => 'behance-square',
			'fa-bitbucket' => 'bitbucket',
			'fa-bitbucket-square' => 'bitbucket-square',
			'fa-bitcoin' => 'bitcoin',
			'fa-btc' => 'btc',
			'fa-codepen' => 'codepen',
			'fa-css3' => 'css3',
			'fa-delicious' => 'delicious',
			'fa-deviantart' => 'deviantart',
			'fa-digg' => 'digg',
			'fa-dribbble' => 'dribbble',
			'fa-dropbox' => 'dropbox',
			'fa-drupal' => 'drupal',
			'fa-empire' => 'empire',
			'fa-facebook' => 'facebook',
			'fa-facebook-square' => 'facebook-square',
			'fa-flickr' => 'flickr',
			'fa-foursquare' => 'foursquare',
			'fa-ge' => 'ge',
			'fa-git' => 'git',
			'fa-git-square' => 'git-square',
			'fa-github' => 'github',
			'fa-github-alt' => 'github-alt',
			'fa-github-square' => 'github-square',
			'fa-gittip' => 'gittip',
			'fa-google' => 'google',
			'fa-google-plus' => 'google-plus',
			'fa-google-plus-square' => 'google-plus-square',
			'fa-hacker-news' => 'hacker-news',
			'fa-html5' => 'html5',
			'fa-instagram' => 'instagram',
			'fa-joomla' => 'joomla',
			'fa-jsfiddle' => 'jsfiddle',
			'fa-linkedin' => 'linkedin',
			'fa-linkedin-square' => 'linkedin-square',
			'fa-linux' => 'linux',
			'fa-maxcdn' => 'maxcdn',
			'fa-openid' => 'openid',
			'fa-pagelines' => 'pagelines',
			'fa-pied-piper' => 'pied-piper',
			'fa-pied-piper-alt' => 'pied-piper-alt',
			'fa-pied-piper-square' => 'pied-piper-square',
			'fa-pinterest' => 'pinterest',
			'fa-pinterest-square' => 'pinterest-square',
			'fa-qq' => 'qq',
			'fa-ra' => 'ra',
			'fa-rebel' => 'rebel',
			'fa-reddit' => 'reddit',
			'fa-reddit-square' => 'reddit-square',
			'fa-renren' => 'renren',
			'fa-share-alt' => 'share-alt',
			'fa-share-alt-square' => 'share-alt-square',
			'fa-skype' => 'skype',
			'fa-slack' => 'slack',
			'fa-soundcloud' => 'soundcloud',
			'fa-spotify' => 'spotify',
			'fa-stack-exchange' => 'stack-exchange',
			'fa-stack-overflow' => 'stack-overflow',
			'fa-steam' => 'steam',
			'fa-steam-square' => 'steam-square',
			'fa-stumbleupon' => 'stumbleupon',
			'fa-stumbleupon-circle' => 'stumbleupon-circle',
			'fa-tencent-weibo' => 'tencent-weibo',
			'fa-trello' => 'trello',
			'fa-tumblr' => 'tumblr',
			'fa-tumblr-square' => 'tumblr-square',
			'fa-twitter' => 'twitter',
			'fa-twitter-square' => 'twitter-square',
			'fa-vimeo-square' => 'vimeo-square',
			'fa-vine' => 'vine',
			'fa-vk' => 'vk',
			'fa-wechat' => 'wechat',
			'fa-weibo' => 'weibo',
			'fa-weixin' => 'weixin',
			'fa-windows' => 'windows',
			'fa-wordpress' => 'wordpress',
			'fa-xing' => 'xing',
			'fa-xing-square' => 'xing-square',
			'fa-yahoo' => 'yahoo',
			'fa-youtube' => 'youtube',
			'fa-youtube-play' => 'youtube-play',
			'fa-youtube-square' => 'youtube-square',
			'fa-ambulance' => 'ambulance',
			'fa-h-square' => 'h-square',
			'fa-hospital-o' => 'hospital-o',
			'fa-medkit' => 'medkit',
			'fa-plus-square' => 'plus-square',
			'fa-stethoscope' => 'stethoscope',
			'fa-user-md' => 'user-md',
			'fa-wheelchair' => 'wheelchair',
		);
		return $icon;
	}
}