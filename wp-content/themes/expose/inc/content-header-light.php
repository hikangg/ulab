<?php
		/**
		 * Set up vars
		 */
		$protocols = array(  'http', 'https', 'ftp', 'ftps', 'mailto', 'news', 'irc', 'gopher', 'nntp', 'feed', 'telnet', 'skype' );
		$logo = get_option('light_badge_logo',  EBOR_THEME_DIRECTORY . 'style/images/logo.png' );
		$nav_logo = get_option('light_badge_logo',  EBOR_THEME_DIRECTORY . 'style/images/logo-badge-white.png' );
		$tagline = get_bloginfo('description');
	?>

	<div class="main-nav visible-lg white-bg">
		<div class="mobile-toggle">
		    <span class="white-bg"></span>
		    <span class="white-bg"></span>
		    <span class="white-bg"></span>
		</div>
	</div>
	
	<?php if( $logo ) : ?>
		<header class="masthead visible-lg">
			<a href="<?php echo esc_url(home_url('/')); ?>">
				<img alt="<?php esc_attr(bloginfo('name')); ?>" src="<?php echo esc_url($logo); ?>" />
			</a>
		</header>
	<?php endif; ?>
	
	<section class="menu-panel fullheight">
		<div class="row">
		
			<article class="col-md-6 fullheight">
				<div class="valign text-center slogan-holder">
					<div class="nav-logo-wrap">
						
						<?php if( $nav_logo ) : ?>
							<a href="<?php echo esc_url(home_url('/')); ?>">
								<img alt="<?php esc_attr(bloginfo('name')); ?>" src="<?php echo esc_url($nav_logo); ?>"/>
							</a>
						<?php endif; ?>
						
						<?php if( $tagline ) : ?>
							<div class="slogan-wrap">
								<h3 class="white font3 slogan-text"><?php echo $tagline; ?></h3>
							</div>
						<?php endif; ?>
						
					</div>
				</div>
			</article>
		
			<article class="col-md-6 fullheight nav-list-holder white-bg">
				<div class="valign">
				
					<nav class="nav-item-wrap">
						<?php
							if ( has_nav_menu( 'primary' ) ){
							    wp_nav_menu( 
							    	array(
								        'theme_location'    => 'primary',
								        'depth'             => 2,
								        'container'         => false,
								        'container_class'   => false,
								        'menu_class'        => 'main-nav-menu main-nav-menu-effect'
							        )
							    );
							} else {
								echo '<ul class="main-nav-menu main-nav-menu-effect">
										<li class="trigger-sub-nav"><a href="'. admin_url('nav-menus.php') .'" class="main-nav-link">Set up a navigation menu now</a></li>
									  </ul>';
							}
						?>
					</nav>
		
					<?php get_template_part('inc/content-header','social'); ?>
					
				</div>
			</article>
		
		</div>
	</section>
	
	<div class="mobile-nav hidden-lg">
		<?php
			if ( has_nav_menu( 'primary' ) ){
			    wp_nav_menu( 
			    	array(
				        'theme_location'    => 'primary',
				        'depth'             => 2,
				        'container'         => false,
				        'container_class'   => false,
				        'menu_class'        => 'slimmenu'
			        )
			    );
			}
		?>
	</div>
	
	<section class="mastwrap page-top-space">