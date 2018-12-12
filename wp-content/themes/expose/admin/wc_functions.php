<?php 

function woocommerce_template_loop_product_thumbnail(){
	global $post;
	global $product;
	echo '<div class="shop-image"><a href="'. get_permalink() .'">';
	the_post_thumbnail('large', array('class' => 'img-responsive'));
	echo '</a></div>';
}

function woocommerce_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;
	ob_start();
?>
	<div class="shop-cart-header font2">
		<div class="shop-cart-header-logo">
			<a href="<?php echo esc_url($woocommerce->cart->get_cart_url()); ?>"><span class="glyphicon glyphicon-shopping-cart"></span></a>
		</div>
		<div class="shop-cart-header-text">
			<?php echo $woocommerce->cart->get_cart_total(); ?>
			<span class="shop-cart-header-text-2 color">
				<?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'expose'), $woocommerce->cart->cart_contents_count);?>
			</span>
		</div>
	</div>
<?php
	$fragments['div.shop-cart-header'] = ob_get_clean();
	return $fragments;
}
add_filter('add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment');

function ebor_remove_woo_lightbox() {
    wp_dequeue_style( 'woocommerce_prettyPhoto_css' );
    wp_dequeue_script( 'prettyPhoto' );
    wp_dequeue_script( 'prettyPhoto-init' );
}
add_action( 'wp_enqueue_scripts', 'ebor_remove_woo_lightbox', 99 );