<?php 
	get_header(); 
	ebor_page_header( get_option('blog_title','Our Journal'), get_option('blog_header_background','Our Journal') );
	$cats = get_categories('taxonomy=portfolio_category');
?>

<div class="container">

	<div class="row add-top">
		<article class="col-md-10 col-md-offset-1 text-center">
			<?php 
				echo ebor_portfolio_filters($cats); 
				echo ebor_expose_seperator(1); 
			?>
		</article>
	</div>

	<div class="row add-bottom">
		<?php get_template_part('loop/loop-portfolio', 'grid'); ?>
	</div>
	
</div>

<?php	
	get_footer(); 