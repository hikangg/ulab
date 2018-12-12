<?php
	$copyright = get_option('copyright', 'Configure this message in "appearance" => "customize"');
	$logo = get_option('dark_logo',  EBOR_THEME_DIRECTORY . 'style/images/logo-dark.png' );
	$protocols = array('http', 'https', 'ftp', 'ftps', 'mailto', 'news', 'irc', 'gopher', 'nntp', 'feed', 'telnet', 'skype');
?>

<footer id="mastfoot" class="mastfoot white-bg">
	<section class="inner-section social-wrap">
		<div class="container-fluid">
			<div class="row">

				<article class="pull-right text-left">
				    <ul class="foot-social" style="margin-top: 0; margin-bottom: 5px; margin-left: 5px;">
						<li>
											<a href="https://www.facebook.com/uniqornlab/" target="_blank" style="
        background-color: #3b5998;
    font-size: 15px;
    width: 20px;
    height: 20px;
    line-height: 20px;
">
											  <i class="fa fa-facebook" style="font-size: 13px;"></i>
										    </a>
										  </li><li>
											<a href="https://twitter.com/Uniqornlabs" target="_blank" style="
    background-color: #4099FF;
    height: 20px;
    width: 20px;
    line-height: 16.7px;
">
											  <i class="fa fa-twitter" style="font-size: 13px;"></i>
										    </a>
										  </li>
<li style="padding-left: 8px;">
											<a href="https://vimeo.com/user43421115" target="_blank" style="
        background-color: #45bbff;
    font-size: 15px;
    width: 20px;
    height: 20px;
    line-height: 20px;
">
											  <i class="fa fa-vimeo-square" style="font-size: 13px;"></i>
										    </a>
										  </li>


					</ul>
				</article>

				<?php if( $logo ) : ?>
					<article class="pull-right text-right foot-logo" style="margin-top: 0">
						<a href="<?php echo esc_url( home_url('/') ); ?>">
							<img alt="<?php esc_attr(bloginfo('name')); ?>" src="<?php echo esc_url($logo); ?>" />
						</a>
					</article>
				<?php endif; ?>

				<?php if( $copyright ) : ?>
					<article class="pull-right text-right foot-logo" style="margin-right: 20px;margin-top: 3px">
						<p class="credits font2 dark">
							<?php echo htmlspecialchars_decode($copyright); ?>
						</p>
					</article>
				<?php endif; ?>



			</div>
		</div>
	</section>
</footer>

<?php wp_footer(); ?>
<!-- Start of ulab Zendesk Widget script -->
<!--<script type='text/javascript' src='/wp-content/themes/expose/style/js/retina.js'></script>

<script>/*<![CDATA[*/window.zEmbed||function(e,t){var n,o,d,i,s,a=[],r=document.createElement("iframe");window.zEmbed=function(){a.push(arguments)},window.zE=window.zE||window.zEmbed,r.src="javascript:false",r.title="",r.role="presentation",(r.frameElement||r).style.cssText="display: none",d=document.getElementsByTagName("script"),d=d[d.length-1],d.parentNode.insertBefore(r,d),i=r.contentWindow,s=i.document;try{o=s}catch(c){n=document.domain,r.src='javascript:var d=document.open();d.domain="'+n+'";void(0);',o=s}o.open()._l=function(){var o=this.createElement("script");n&&(this.domain=n),o.id="js-iframe-async",o.src=e,this.t=+new Date,this.zendeskHost=t,this.zEQueue=a,this.body.appendChild(o)},o.write('<body onload="document._l();">'),o.close()}("https://assets.zendesk.com/embeddable_framework/main.js","ulab.zendesk.com");
/*]]>*/</script>-->
<!-- End of ulab Zendesk Widget script -->

</body>
</html>
