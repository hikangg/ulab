<?php $sticky = (is_sticky()) ? __('Sticky &bull; ','expose'): ''; ?>

<li id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<a href="<?php the_permalink(); ?>">
		<?php 
			the_post_thumbnail('blog');
			the_title('<h3 class="offwhite-bg dark font2">', ' <span class="grey">' . $sticky . get_the_time( get_option('date_format') ) .'</span></h3>');
		?>
	</a>
</li>