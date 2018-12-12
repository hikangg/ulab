<?php global $woocommerce; ?>

<h4 class="shop-subheading font2 offwhite-bg"><?php _e('Your cart','expose'); ?></h4>
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

<div class="shop-cart-checkout">
	<a href="<?php echo esc_url($woocommerce->cart->get_checkout_url()); ?>" class="btn btn-small btn-expose btn-expose-dark">
		<i class="glyphicon glyphicon-check"></i>
		<?php _e('Checkout','expose'); ?>
	</a>
</div>

<?php if( is_single() ) : ?>
	<div class="shop-cart-goback">
		<a href="<?php echo esc_url(get_permalink( woocommerce_get_page_id( 'shop' ) )); ?>" class="btn btn-small btn-expose btn-expose-dark">
			<i class="glyphicon glyphicon-th"></i> 
			<?php _e('Go back','expose'); ?>
		</a>
	</div>
<?php endif; ?>

<?php dynamic_sidebar('shop'); ?>