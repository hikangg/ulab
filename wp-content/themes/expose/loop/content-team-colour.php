<article id="team-<?php the_ID(); ?>" <?php post_class('col-md-4 col-sm-4 text-center color-bg no-pad team-block'); ?>>
	<?php 
		the_post_thumbnail('team', array('class' => 'img-responsive'));
		the_title('<h3 class="dark"><a href="'. get_permalink() .'">', '</a></h3><p class="dark">'. esc_html(get_post_meta( $post->ID, '_ebor_the_job_title', true )) .'</p>'); 
	?>
</article>