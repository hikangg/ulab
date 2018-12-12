<?php global $product; ?>

<div class="col-md-6">
	<div class="shop-item-2">
		
		<?php if ( $product->is_on_sale() ) : ?>
			<div class="shop-item-tag black-bg">
				<div class="valign"><?php _e('Offer Price','expose'); ?></div>
			</div>
		<?php endif; ?>
		
		<?php woocommerce_template_loop_product_thumbnail(); ?>
		
		<?php the_title('<div class="shop-item-name font2"><a href="'. get_permalink() .'">', '</a></div>'); ?>
		
		<?php if ( $price_html = $product->get_price_html() ) : ?>
			<div class="shop-item-price dark">
				<span class="shop-item-price-old color font4"><?php echo $price_html; ?></span>
			</div>
		<?php endif; ?>
		
		<div class="shop-item-cart">
			<?php
				echo apply_filters( 'woocommerce_loop_add_to_cart_link',
					sprintf( '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" data-quantity="%s" class="btn btn-small btn-expose btn-expose-dark %s product_type_%s">%s</a>',
						esc_url( $product->add_to_cart_url() ),
						esc_attr( $product->id ),
						esc_attr( $product->get_sku() ),
						esc_attr( isset( $quantity ) ? $quantity : 1 ),
						$product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
						esc_attr( $product->product_type ),
						'<i class="glyphicon glyphicon-shopping-cart"></i>' . $product->add_to_cart_text()
					),
				$product );
			?>
		</div> 
		                         
	</div>        
</div>