<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>

<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

<p class="cart">
	<a href="<?php echo esc_url( $product_url ); ?>" rel="nofollow" class="single_add_to_cart_button btn-expose btn-expose-dark alt"><?php echo $button_text; ?></a>
</p>

<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>