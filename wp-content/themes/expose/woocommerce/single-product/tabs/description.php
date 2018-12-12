<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post;

$heading = esc_html( apply_filters( 'woocommerce_product_description_heading', __( 'Product Description', 'woocommerce' ) ) );
?>

<?php if ( $heading ): ?>
  <h2 class="shop-subheading font2 offwhite-bg"><?php echo $heading; ?></h2>
<?php endif; ?>

<?php the_content(); ?>
