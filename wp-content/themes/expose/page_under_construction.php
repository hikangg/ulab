<?php 
	get_header(); 
	the_post();
	
	ebor_page_header( get_the_title(), get_option('blog_header_background','Our Journal') );
?>
	
	<div class="container-fluid offwhite-bg">
		<div class="container">
			<div class="row add-top add-bottom">
				<article class="col-md-10 col-md-offset-1 text-center">
					<h1 class="super-heading grey font2"><span><?php echo get_the_content(); ?></span></h1>
				</article>
			</div>
		</div>
	</div>

<?php 
	get_footer();