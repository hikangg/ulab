<?php
if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly
	exit;
}

global $product;

$heading = apply_filters( 'woocommerce_product_additional_information_heading', __( 'Additional Information', 'woocommerce' ) );
?>

<?php if ( $heading ): ?>
	<h2 class="shop-subheading font2 offwhite-bg"><?php echo $heading; ?></h2>
<?php endif; ?>

<?php $product->list_attributes(); ?>