<?php 

/**
 * Build theme options
 * Uses the Ebor_Options class found in the ebor-framework plugin
 * Panels are WP 4.0+!!!
 * 
 * @since 1.0.0
 * @author tommusrhodus
 */
if( class_exists('Ebor_Options') ){
	$ebor_options = new Ebor_Options;
	
	/**
	 * Variables
	 */
	 $theme = wp_get_theme();
	 $theme_name = $theme->get( 'Name' );
	 $social_options = ebor_icons_list();
	 $fonts_description = 'Fonts: ' . $theme_name . ' uses Google Fonts, <a href="https://www.google.com/fonts" target="_blank">all of which are viewable here</a>. Unlike some themes, ' . $theme_name . ' does not load all of these fonts into these options, in avoiding this ' . $theme_name . ' can work faster and more reliably.<br /><br />
	 
	 To customize the fonts on your website use the URL above and the inputs below accordingly. Full details of this process (and the default values) can be found in the theme documentation!';
	 
	
	/**
	 * Panels
	 * 
	 * add_panel($name, $priority, $description)
	 * 
	 * @since 1.0.0
	 * @author tommusrhodus
	 */
	$ebor_options->add_panel( $theme_name . ': Demo Data', 5, '');
	$ebor_options->add_panel( $theme_name . ': Styling Settings', 205, 'All of the controls in this section directly relate to the styling page of ' . $theme_name);
	$ebor_options->add_panel( $theme_name . ': Header Settings', 215, 'All of the controls in this section directly relate to the header and logos of ' . $theme_name);
	$ebor_options->add_panel( $theme_name . ': Blog Settings', 225, 'All of the controls in this section directly relate to the control of blog items within ' . $theme_name);
	$ebor_options->add_panel( $theme_name . ': Portfolio Settings', 230, 'All of the controls in this section directly relate to the control of portfolio items within ' . $theme_name);
	$ebor_options->add_panel( $theme_name . ': Shop Settings', 235, 'All of the controls in this section directly relate to the control of shop items within ' . $theme_name);
	$ebor_options->add_panel( $theme_name . ': Footer Settings', 290, 'All of the controls in this section directly relate to the control of the footer within ' . $theme_name);
	
	/**
	 * Sections
	 * 
	 * add_section($name, $title, $priority, $panel, $description)
	 * 
	 * @since 1.0.0
	 * @author tommusrhodus
	 */
	//Demo Data
	//Demo Data
	$ebor_options->add_section('demo_data_section', 'Import Demo Data', 10, $theme_name . ': Demo Data', '<strong>Please read this before importing demo data via this control:</strong><br /><br />The demo data this will install includes images from my demo site with <strong>heavy blurring applied</strong> this is due to licensing restrictions. Simply replace these images with your own.<br /><br />Note that this process can take up to 15mins on slower servers, go make a cup of tea. If you havn\'t had a notification in 30mins, use the fallback method outlined in the written documentation.<br /><br />');
	
	//Header Settings
	$ebor_options->add_section('logo_settings_section', 'Logo Settings', 10, $theme_name . ': Header Settings');
	$ebor_options->add_section('header_settings_section', 'Header Settings', 15, $theme_name . ': Header Settings');
	$ebor_options->add_section('header_social_settings_section', 'Header Icons Settings', 40, $theme_name . ': Header Settings', 'These social icons are only shown in certain header layouts.');
	
	$ebor_options->add_section('favicon_section', 'Favicons', 30, $theme_name . ': Styling Settings');
	
	$ebor_options->add_section('shop_settings', 'Shop Settings', 1, $theme_name . ': Shop Settings');
	
	//Blog Settings
	$ebor_options->add_section('blog_settings', 'Blog Settings', 1, $theme_name . ': Blog Settings');
	$ebor_options->add_section('blog_text_section', 'Blog Texts', 5, $theme_name . ': Blog Settings');
	
	//Footer settings
	$ebor_options->add_section('subfooter_settings_section', 'Sub-Footer Settings', 30, $theme_name . ': Footer Settings');
	$ebor_options->add_section('footer_social_settings_section', 'Footer Icons Settings', 40, $theme_name . ': Footer Settings', '');
	
	$ebor_options->add_section('fonts_section', 'Fonts', 5, $theme_name . ': Styling Settings', $fonts_description);
	$ebor_options->add_section('custom_css_section', 'Custom CSS', 40, $theme_name . ': Styling Settings');
	
	/**
	 * Settings (The Actual Options)
	 * Repeated settings are stepped using a for() loop and counter
	 * 
	 * add_setting($type, $option, $title, $section, $default, $priority, $select_options)
	 * 
	 * @since 1.0.0
	 * @author tommusrhodus
	 */
	//Demo Data
	$ebor_options->add_setting('demo_import', 'demo_import', 'Import Demo Data', 'demo_data_section', '', 10);
	
	//Fonts
	$ebor_options->add_setting('input', 'font_1', 'Font 1', 'fonts_section', 'Open Sans', 10);
	$ebor_options->add_setting('textarea', 'font_1_url', 'Font 1 URL Parameter', 'fonts_section', 'http://fonts.googleapis.com/css?family=Raleway:400,300,700,900', 15);
	
	$ebor_options->add_setting('input', 'font_2', 'Font 2', 'fonts_section', 'Montserrat', 20);
	$ebor_options->add_setting('textarea', 'font_2_url', 'Font 2 URL Parameter', 'fonts_section', 'http://fonts.googleapis.com/css?family=Montserrat:400,700', 25);
	
	$ebor_options->add_setting('input', 'font_3', 'Font 3', 'fonts_section', 'Raleway', 30);
	$ebor_options->add_setting('textarea', 'font_3_url', 'Font 3 URL Parameter', 'fonts_section', 'http://fonts.googleapis.com/css?family=Raleway:400,300,700,900', 35);

	
	//Favicons
	$ebor_options->add_setting('image', 'custom_favicon', 'Custom Favicon Upload (Use .png)', 'favicon_section', '', 10);
	$ebor_options->add_setting('image', 'mobile_favicon', 'Mobile Favicon Upload (Use .png)', 'favicon_section', '', 15);
	$ebor_options->add_setting('image', '72_favicon', '72x72px Favicon Upload (Use .png)', 'favicon_section', '', 20);
	$ebor_options->add_setting('image', '114_favicon', '114x114px Favicon Upload (Use .png)', 'favicon_section', '', 25);
	$ebor_options->add_setting('image', '144_favicon', '144x144px Favicon Upload (Use .png)', 'favicon_section', '', 30);
	
	//Header Options
	$ebor_options->add_setting('image', 'logo_header_background', 'Logo Area Background Image', 'header_settings_section', '', 10);
	
	//Blog Options
	$ebor_options->add_setting('image', 'blog_header_background', 'Blog Archives: Header Background', 'blog_settings', '', 10);
	$ebor_options->add_setting('input', 'blog_title', 'Blog Archives: Title', 'blog_text_section', 'Our Journal', 20);
	
	$ebor_options->add_setting('image', 'shop_header_background', 'Shop Header Background', 'shop_settings', '', 10);
	
	//Colours
	$ebor_options->add_setting('color', 'color_highlight', 'Highlight Color', 'colors', '#FFC740', 120);
	$ebor_options->add_setting('color', 'color_white', 'White Color', 'colors', '#ffffff', 125);
	$ebor_options->add_setting('color', 'color_grey', 'Grey Color', 'colors', '#cfccc4', 130);
	$ebor_options->add_setting('color', 'color_offwhite', 'Offwhite Color', 'colors', '#EBEBEB', 135);
	$ebor_options->add_setting('color', 'color_dark', 'Dark Color', 'colors', '#121212', 140);
	$ebor_options->add_setting('color', 'color_black', 'Black Color', 'colors', '#000000', 145);
	$ebor_options->add_setting('color', 'color_interactive', 'Interactive Homepage Element Color', 'colors', '#9cd9f9', 150);
	
	//Logo Options
	$ebor_options->add_setting('image', 'dark_badge_logo', 'Dark Badge Logo', 'logo_settings_section', EBOR_THEME_DIRECTORY . 'style/images/logo.png', 5);
	$ebor_options->add_setting('image', 'dark_badge_logo_retina', 'Dark Badge Retina Logo', 'logo_settings_section', EBOR_THEME_DIRECTORY . 'style/images/logo@2x.png', 10);
	$ebor_options->add_setting('image', 'dark_logo', 'Dark Logo', 'logo_settings_section', EBOR_THEME_DIRECTORY . 'style/images/logo-dark.png', 15);
	$ebor_options->add_setting('image', 'dark_logo_retina', 'Dark Retina Logo', 'logo_settings_section', EBOR_THEME_DIRECTORY . 'style/images/logo-dark@2x.png', 20);
	
	$ebor_options->add_setting('image', 'light_badge_logo', 'Light Badge Logo', 'logo_settings_section', EBOR_THEME_DIRECTORY . 'style/images/logo-badge-white.png', 25);
	$ebor_options->add_setting('image', 'light_badge_logo_retina', 'Light Badge Retina Logo', 'logo_settings_section', EBOR_THEME_DIRECTORY . 'style/images/logo-badge-white.png', 30);
	$ebor_options->add_setting('image', 'light_logo', 'Light Logo', 'logo_settings_section', EBOR_THEME_DIRECTORY . 'style/images/logo-white.png', 35);
	$ebor_options->add_setting('image', 'light_logo_retina', 'Light Retina Logo', 'logo_settings_section', EBOR_THEME_DIRECTORY . 'style/images/logo-white@2x.png', 40);
	
	$ebor_options->add_setting('textarea', 'custom_css', 'Custom CSS', 'custom_css_section', '', 30);
	
	//Copyright
	$ebor_options->add_setting('textarea', 'copyright', 'Copyright Message', 'subfooter_settings_section', '', 20);
	
	//Header Icons
	for( $i = 1; $i < 7; $i++ ){
		$ebor_options->add_setting('select', 'header_social_icon_' . $i, 'Header Social Icon ' . $i, 'header_social_settings_section', 'none', 20 + $i + $i, $social_options);
		$ebor_options->add_setting('input', 'header_social_url_' . $i, 'Header Social URL ' . $i, 'header_social_settings_section', '', 21 + $i + $i);
	}
	
	//Footer Social
	for( $i = 1; $i < 5; $i++ ){
		$ebor_options->add_setting('select', 'footer_social_icon_' . $i, 'Footer Social Icon ' . $i, 'footer_social_settings_section', 'none', 20 + $i + $i, $social_options);
		$ebor_options->add_setting('input', 'footer_social_url_' . $i, 'Footer Social URL ' . $i, 'footer_social_settings_section', '', 21 + $i + $i);
	}
}