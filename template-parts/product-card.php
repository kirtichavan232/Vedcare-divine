<?php
/**
 * Product card used on the homepage before products are entered in WooCommerce.
 *
 * @package VedCare_Divine
 *
 * @var array $args Template arguments.
 */

$product = isset( $args['product'] ) ? $args['product'] : array();
$slug    = isset( $args['slug'] ) ? $args['slug'] : '';

if ( empty( $product ) ) {
	return;
}

$product_url = home_url( '/product/' . $slug . '/' );

$wc_product_id = absint( $product['woocommerce']['product_id'] ?? 0 );
$combo_product_ids = array( 117, 121, 123, 125, 127 );
$is_combo_product  = in_array( $wc_product_id, $combo_product_ids, true );
$wc_product        = $is_combo_product && function_exists( 'wc_get_product' ) ? wc_get_product( $wc_product_id ) : false;

if ( $wc_product ) {
	$product_url = $wc_product->get_permalink();
}

$cart_url = $wc_product_id && function_exists( 'wc_get_cart_url' )
	? add_query_arg( 'add-to-cart', $wc_product_id, wc_get_cart_url() )
	: vedcare_divine_shop_url();
?>
<article class="product-card">
	<a class="product-card__image-link" href="<?php echo esc_url( $product_url ); ?>">
		<?php if ( $wc_product && $wc_product->get_image_id() ) : ?>
			<?php echo wp_kses_post( $wc_product->get_image( 'woocommerce_thumbnail', array( 'class' => 'product-card__image' ) ) ); ?>
		<?php else : ?>
			<img class="product-card__image" src="<?php echo esc_url( vedcare_divine_asset_url( $product['image'] ) ); ?>" alt="<?php echo esc_attr( $product['name'] ); ?>">
		<?php endif; ?>
	</a>
	<div class="product-card__content">
		<?php if ( ! empty( $product['badge'] ) ) : ?>
			<span class="badge"><?php echo esc_html( $product['badge'] ); ?></span>
		<?php endif; ?>
		<p class="product-card__category"><?php echo esc_html( $product['category'] ); ?></p>
		<h3 class="product-card__title"><a href="<?php echo esc_url( $product_url ); ?>"><?php echo esc_html( $product['name'] ); ?></a></h3>
		<p class="product-card__description"><?php echo esc_html( $product['description'] ); ?></p>
		<p class="product-card__price"><span><?php echo esc_html( $product['price'] ); ?></span> <del><?php echo esc_html( $product['mrp'] ); ?></del></p>
		<div class="product-card__actions">
			<a class="button button--compact" href="<?php echo esc_url( $cart_url ); ?>"><?php esc_html_e( 'Add to cart', 'vedcare-divine' ); ?></a>
			<a class="text-link" href="<?php echo esc_url( $product_url ); ?>"><?php esc_html_e( 'View details', 'vedcare-divine' ); ?></a>
		</div>
	</div>
</article>
