<?php
	get_header();
	the_post();
	
	global $post, $woocommerce, $product;
	
	$attachment_ids = false;
	$thumbnail = has_post_thumbnail();
	
	if( $thumbnail ){
		$url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full');
		ebor_page_header( get_the_title(), $url[0], 'fullheight', false, get_post_meta($post->ID, '_ebor_header_colour', 1) );
	}
	
	$attachment_ids = $product->get_gallery_attachment_ids();
	$attachment_ids[] = get_post_thumbnail_id();
?>
	
<div class="container">
	<section id="shop" class="whitegray-bg shop fullheightmin">
		<section class="container">
			
			<?php if ( $attachment_ids ) : ?>
				<div class="row add-top">
					<article class="col-md-12 text-center">
						<div class="post-slider owl-carousel">
							<?php
								foreach ( $attachment_ids as $id => $attachment ) {
								   echo '<div class="item">'. wp_get_attachment_image($attachment, 'large') .'</div>';
								}   
							?>
						</div>
					</article>
				</div>
			<?php endif; ?>

			<div class="row add-top-half add-bottom">
			
				<div class="col-md-12">
					<?php do_action( 'woocommerce_before_shop_loop' ); ?>
				</div>
			
				<div class="col-md-8 product-details-content">
				
					<?php
						/**
						 * woocommerce_single_product_summary hook
						 *
						 * @hooked woocommerce_template_single_title - 5
						 * @hooked woocommerce_template_single_rating - 10
						 * @hooked woocommerce_template_single_price - 10
						 * @hooked woocommerce_template_single_excerpt - 20
						 * @hooked woocommerce_template_single_add_to_cart - 30
						 * @hooked woocommerce_template_single_meta - 40
						 * @hooked woocommerce_template_single_sharing - 50
						 */
						do_action( 'woocommerce_single_product_summary' );
					?> 
					
					<div class="product-choices">
					
						<?php
							/**
							 * woocommerce_after_single_product_summary hook
							 *
							 * @hooked woocommerce_output_product_data_tabs - 10
							 * @hooked woocommerce_upsell_display - 15
							 * @hooked woocommerce_output_related_products - 20
							 */
							do_action( 'woocommerce_after_single_product_summary' );
						?>
						
					</div>                                   
				
				</div>  
			
				<article class="col-md-4 shop-sidebar">
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