<?php
/**
 * Custom VedCare Divine WooCommerce shop archive.
 *
 * @package VedCare_Divine
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );

$catalogue = vedcare_divine_products();
$sections  = array(
	array(
		'id'          => 'mass-weight-gain',
		'number'      => '01',
		'title'       => 'Mass / Weight Gain',
		'description' => 'Build your body with a focused Ayurvedic approach.',
		'products'    => array( 'vedcare-gold', 'vedcare-gold-buy-2-get-1-free', 'vedcare-build', 'vedcare-build-buy-2-get-1-free', 'vedcare-build-mini', 'vedcare-build-mini-buy-2-get-1-free' ),
	),
	array(
		'id'          => 'fat-loss-muscle-building',
		'number'      => '02',
		'title'       => 'Fat Loss / Muscle Building',
		'description' => 'Support your weight-management and muscle-building goals.',
		'products'    => array( 'vedcare-lean', 'vedcare-lean-buy-2-get-1-free' ),
	),
	array(
		'id'          => 'joint-care',
		'number'      => '03',
		'title'       => 'Joint Pain & Support',
		'description' => 'Ayurvedic support for everyday joint wellness and mobility.',
		'products'    => array( 'ortho-care', 'ortho-care-buy-2-get-1-free' ),
	),
);
?>

<style>
	.shop-archive { background: #fcf8ed; color: var(--vedcare-green-deep, #174634); }
	.shop-archive__hero { position: relative; overflow: hidden; padding: clamp(3.5rem, 6vw, 5.5rem) 0 clamp(3rem, 5vw, 4.5rem); background: linear-gradient(135deg, #fffaf0, #f1e5cc); text-align: center; }
	.shop-archive__hero::after { position: absolute; right: -4rem; bottom: -6rem; width: 19rem; height: 19rem; background: url('<?php echo esc_url( vedcare_divine_asset_url( 'assets/images/decorative/ayurvedic-botanical-frame.png' ) ); ?>') center / contain no-repeat; content: ''; opacity: .32; pointer-events: none; }
	.shop-archive__hero .container { position: relative; z-index: 1; max-width: 58rem; }
	.shop-archive__hero h1 { max-width: 18ch; margin: .65rem auto 0; font-size: clamp(2.65rem, 5vw, 4.8rem); line-height: 1.02; }
	.shop-archive__goals { position: relative; z-index: 2; margin-top: -1.2rem; }
	.shop-archive__goals .container { display: flex; flex-wrap: wrap; justify-content: center; gap: .7rem; }
	.shop-archive__goals a { padding: .8rem 1.15rem; border: 1px solid rgb(205 165 72 / 55%); border-radius: 999px; background: #fffdf8; box-shadow: 0 .4rem 1rem rgb(27 47 31 / 7%); color: var(--vedcare-green-deep, #174634); font-size: .88rem; font-weight: 700; text-decoration: none; }
	.shop-archive__goals a:hover { background: var(--vedcare-green, #235d40); color: #fffaf0; }
	.shop-archive__section { padding-block: clamp(3.75rem, 6vw, 5.75rem); scroll-margin-top: 1rem; }
	.shop-archive__section:nth-of-type(even) { background: #fffdf8; }
	.shop-archive__section .container { max-width: 75rem; }
	.shop-archive__section .section-heading { max-width: 42rem; margin: 0 auto clamp(2rem, 4vw, 3.25rem); text-align: center; }
	.shop-archive__section .section-heading h2 { margin: .4rem 0 .75rem; font-size: clamp(2.2rem, 4vw, 3.5rem); }
	.shop-archive__section .text-lead { margin-inline: auto; }
	.shop-archive__products { grid-template-columns: repeat(3, minmax(0, 1fr)); gap: clamp(1rem, 2vw, 1.65rem); max-width: 68rem; margin-inline: auto; }
	.shop-archive__products--single { grid-template-columns: minmax(0, 22rem); justify-content: center; }
	.shop-archive__product { position: relative; min-height: 100%; border-color: rgb(205 165 72 / 43%); border-radius: 1rem; background: #fffdf8; box-shadow: 0 .75rem 1.75rem rgb(27 47 31 / 8%); }
	.shop-archive__product:hover { box-shadow: 0 1.1rem 2.2rem rgb(27 47 31 / 14%); }
	.shop-archive__promotion { position: absolute; z-index: 1; top: .9rem; left: .9rem; border: 1px solid #e8c66f; background: #174634; color: #fffaf0; }
	.shop-archive__product .product-card__image-link { display: grid; min-height: clamp(14rem, 20vw, 17rem); place-items: center; padding: 1.2rem; background: linear-gradient(145deg, #f7eedc, #fffdf8); }
	.shop-archive__product .product-card__image-link img { width: 100%; height: 100%; max-height: 16rem; object-fit: contain; mix-blend-mode: multiply; }
	.shop-archive__product .product-card__content { gap: .7rem; padding: 1.35rem 1.3rem 1.45rem; }
	.shop-archive__product .product-card__title { font-size: 1.35rem; }
	.shop-archive__product .product-card__price { font-size: 1.18rem; }
	.shop-archive__product .product-card__actions { margin-top: .45rem; }
	.shop-archive__product .button { min-height: 2.8rem; background: var(--vedcare-green, #235d40); }
	.shop-archive__product .button:hover { background: var(--vedcare-green-deep, #174634); }
	@media (max-width: 52rem) { .shop-archive__products { grid-template-columns: repeat(2, minmax(0, 1fr)); max-width: 48rem; } .shop-archive__products--single { grid-template-columns: minmax(0, 22rem); } }
	@media (max-width: 34rem) { .shop-archive__hero { padding-top: 3.25rem; } .shop-archive__goals { margin-top: -1rem; } .shop-archive__goals .container { align-items: stretch; flex-direction: column; } .shop-archive__goals a { text-align: center; } .shop-archive__section { padding-block: 3.25rem; } .shop-archive__products, .shop-archive__products--single { grid-template-columns: repeat(2, minmax(0, 1fr)); max-width: none; } .shop-archive__product .product-card__image-link { min-height: 8.1rem; padding: .65rem; } .shop-archive__product .product-card__image-link img { max-height: 8rem; } .shop-archive__product .product-card__content { padding: .78rem; } .shop-archive__product .product-card__title { font-size: .92rem; } .shop-archive__product .product-card__price { font-size: 1rem; } .shop-archive__promotion { top: .5rem; left: .5rem; } }
</style>

<article class="shop-archive">
	<section class="shop-archive__hero">
		<div class="container">
			<p class="section__eyebrow">Shop VedCare Divine</p>
			<h1>Wellness Inspired by Ayurveda. Designed for You.</h1>
		</div>
	</section>

	<nav class="shop-archive__goals" aria-label="Shop by wellness goal">
		<div class="container">
			<a href="#mass-weight-gain">Mass / Weight Gain</a>
			<a href="#fat-loss-muscle-building">Fat Loss / Muscle Building</a>
			<a href="#joint-care">Joint Pain &amp; Support</a>
		</div>
	</nav>

	<?php foreach ( $sections as $section ) : ?>
		<section id="<?php echo esc_attr( $section['id'] ); ?>" class="shop-archive__section section">
			<div class="container">
				<header class="section-heading">
					<p class="section__eyebrow"><?php echo esc_html( $section['number'] ); ?></p>
					<h2><?php echo esc_html( $section['title'] ); ?></h2>
					<p class="text-lead"><?php echo esc_html( $section['description'] ); ?></p>
				</header>

				<div class="products-grid shop-archive__products<?php echo 1 === count( $section['products'] ) ? ' shop-archive__products--single' : ''; ?>">
					<?php foreach ( $section['products'] as $slug ) : ?>
						<?php
						$product_id = absint( $catalogue[ $slug ]['woocommerce']['product_id'] ?? 0 );
						$product    = $product_id ? wc_get_product( $product_id ) : false;

						if ( ! $product ) {
							continue;
						}

						$current_price = $product->get_price();
						$regular_price = $product->get_regular_price();
						?>
						<article <?php wc_product_class( 'product-card shop-archive__product', $product ); ?>>
							<?php if ( in_array( $product_id, array( 117, 121, 123, 125, 127 ), true ) ) : ?>
								<span class="badge shop-archive__promotion">BUY 2 + GET 1 FREE</span>
							<?php endif; ?>
							<a class="product-card__image-link" href="<?php echo esc_url( $product->get_permalink() ); ?>">
								<?php echo wp_kses_post( $product->get_image( 'woocommerce_thumbnail' ) ); ?>
							</a>
							<div class="product-card__content">
								<h3 class="product-card__title"><a href="<?php echo esc_url( $product->get_permalink() ); ?>"><?php echo esc_html( $product->get_name() ); ?></a></h3>
								<p class="product-card__price">
									<?php if ( '' !== $current_price ) : ?>
										<span><?php echo wp_kses_post( wc_price( $current_price ) ); ?></span>
									<?php endif; ?>
									<?php if ( '' !== $regular_price && $regular_price !== $current_price ) : ?>
										<del><?php echo wp_kses_post( wc_price( $regular_price ) ); ?></del>
									<?php endif; ?>
								</p>
								<div class="product-card__actions">
									<a class="button button--compact" href="<?php echo esc_url( $product->add_to_cart_url() ); ?>"><?php esc_html_e( 'Add to Cart', 'vedcare-divine' ); ?></a>
									<a class="text-link" href="<?php echo esc_url( $product->get_permalink() ); ?>"><?php esc_html_e( 'View Details', 'vedcare-divine' ); ?></a>
								</div>
							</div>
						</article>
					<?php endforeach; ?>
				</div>
			</div>
		</section>
	<?php endforeach; ?>
</article>

<?php get_footer( 'shop' ); ?>
