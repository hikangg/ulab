<section class="call-to-action white-bg">
	<div class="container">
		<div class="row">
		
			<div class="col-md-3"> </div>
			
			<?php 
				previous_post_link('<article class="col-md-2 text-center"><div class="aux-icon-btn-wrap">%link</div></article>', '<span class="glyphicon glyphicon-arrow-left grey"></span>'); 
				if(!( get_previous_post_link() ))
					echo '<article class="col-md-2 text-center"></article>';
			?>
			
			<article class="col-md-2 text-center">
				<div class="aux-icon-btn-wrap">
					<a class="aux-icon-btn" href="<?php echo ( get_option( 'show_on_front' ) == 'page' ) ? esc_url(get_permalink(get_option('page_for_posts'))) : esc_url(home_url('/')); ?>">
						<span class="glyphicon glyphicon-th grey"></span>
					</a>
				</div>
			</article>
			
			<?php next_post_link('<article class="col-md-2 text-center"><div class="aux-icon-btn-wrap">%link</div></article>', '<span class="glyphicon glyphicon-arrow-right grey"></span>'); ?>
	
		</div>
	</div>
</section>