<?php
	$query_args = array(
		'post_type' => 'product',
		'posts_per_page' => '4'
	);
	$block_query = new WP_Query( $query_args );
?>

<section class="call-to-action offwhite-bg">
	<div class="container">

		<div class="row">
			<article class="col-md-12">
				<h3 class="shop-subheading font2 white-bg"><?php _e('Latest Products','expose'); ?></h3>
			</article>
		</div>
		
		<div class="row related-thumbs-wrap">
			<?php 
				if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
					
					if(!( has_post_thumbnail() ))
						continue;
					
					echo '<article class="col-md-3 col-xs-6 related-thumbs"><div class="related-thumbs-inner white-bg"><a href="'. get_permalink() .'">';
					the_post_thumbnail('team', array('class' => 'img-responsive'));	
					echo '</a></div></article>';
				
				endwhile;	
				else : 
					
					/**
					 * Display no posts message if none are found.
					 */
					get_template_part('loop/content','none');
					
				endif;
				wp_reset_query();
			?>
		</div>
			
	</div>
</section>