<?php $protocols = array('http', 'https', 'ftp', 'ftps', 'mailto', 'news', 'irc', 'gopher', 'nntp', 'feed', 'telnet', 'skype'); ?>

<div class="copy-credits">
	<ul class="nav-social">
		<?php 
			for( $i = 0; $i < 7; $i++ ){
				if( get_option("header_social_url_$i") ) {
					echo '<li><a href="' . esc_url(get_option("header_social_url_$i"), $protocols) . '" target="_blank">
							  <i class="fa ' . get_option("header_social_icon_$i") . '"></i>
						  </a></li>';
				}
			} 
		?>
	</ul>
</div>