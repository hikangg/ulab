<?php global $wp_query; ?>

<div class="row about-team">
	<?php 
		if ( have_posts() ) : while ( have_posts() ) : the_post();
			
			$layout = ( ($wp_query->current_post + 1) % 2 == 0 ) ? 'colour': 'white';
			
			/**
			 * Get blog posts by blog layout.
			 */
			get_template_part('loop/content-team', $layout);
			
			if( ($wp_query->current_post + 1) % 3 == 0 )
				echo '<div class="clearfix"></div>';
		
		endwhile;	
		else : 
			
			/**
			 * Display no posts message if none are found.
			 */
			get_template_part('loop/content','none');
			
		endif;
	?>
</div>