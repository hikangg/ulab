<?php 
	get_header(); 
	ebor_page_header( woocommerce_page_title(false), get_option('shop_header_background', get_option('blog_header_background')) );
?>

<div class="container">
	<section id="shop" class="whitegray-bg shop fullheightmin">
		<section class="container">
    		<div class="row add-top add-bottom">
  
				<article class="col-md-9">
					<div class="row">
						
						<div class="col-md-12">
							<?php do_action( 'woocommerce_before_shop_loop' ); ?>
						</div>
						
						<?php 
							if ( have_posts() ) : while ( have_posts() ) : the_post();
								
								wc_get_template_part( 'content', 'product' );
							
							endwhile;	
							else : 
								
								/**
								 * Display no posts message if none are found.
								 */
								get_template_part('loop/content','none');
								
							endif;
						?>
						
						<div class="col-md-12">
							<?php
								/**
								 * Post pagination, use ebor_pagination() first and fall back to default
								 */
								echo function_exists('ebor_pagination') ? ebor_pagination() : posts_nav_link();
							?>
						</div>
						
					</div>  
				</article>
				
				<article class="col-md-3 shop-sidebar">
					<?php
						/**
						 * woocommerce_sidebar hook
						 *
						 * @hooked woocommerce_get_sidebar - 10
						 */
						do_action( 'woocommerce_sidebar' );
					?>
				</article>

			</div>
		</section>
	</section>
</div>

<?php 
	get_template_part('loop/loop','latest-products');
	get_footer();