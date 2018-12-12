<?php 
	get_header(); 
	ebor_page_header( get_option('blog_title','Our Journal'), get_option('blog_header_background','Our Journal') );
?>

<div class="container">
	<div class="row add-top add-bottom">
		<?php get_template_part('loop/loop', 'team'); ?>
	</div>
</div>

<?php	
	get_footer(); 