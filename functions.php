<?php
/**
 * VedCare Divine theme functions.
 *
 * @package VedCare_Divine
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function vedcare_divine_setup() {
	load_theme_textdomain( 'vedcare-divine', get_template_directory() . '/languages' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'custom-logo', array( 'height' => 96, 'width' => 320, 'flex-height' => true, 'flex-width' => true ) );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'html5', array( 'comment-form', 'comment-list', 'gallery', 'caption', 'script', 'style', 'search-form' ) );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'woocommerce' );
	register_nav_menus( array( 'primary' => __( 'Primary Menu', 'vedcare-divine' ), 'footer' => __( 'Footer Menu', 'vedcare-divine' ) ) );
}
add_action( 'after_setup_theme', 'vedcare_divine_setup' );

function vedcare_divine_enqueue_assets() {
	$theme_version = wp_get_theme()->get( 'Version' );
	$css_file      = get_template_directory() . '/assets/css/theme.css';
	$js_file       = get_template_directory() . '/assets/js/theme.js';
	wp_enqueue_style( 'vedcare-divine', get_stylesheet_uri(), array(), $theme_version );
	wp_enqueue_style( 'vedcare-divine-theme', get_template_directory_uri() . '/assets/css/theme.css', array( 'vedcare-divine' ), file_exists( $css_file ) ? filemtime( $css_file ) : $theme_version );
	wp_enqueue_script( 'vedcare-divine-theme', get_template_directory_uri() . '/assets/js/theme.js', array(), file_exists( $js_file ) ? filemtime( $js_file ) : $theme_version, true );
	if ( is_singular( 'post' ) ) {
		$post_css_file = get_template_directory() . '/assets/css/single-post.css';
		wp_enqueue_style( 'vedcare-divine-single-post', get_template_directory_uri() . '/assets/css/single-post.css', array( 'vedcare-divine-theme' ), file_exists( $post_css_file ) ? filemtime( $post_css_file ) : $theme_version );
	}
	if ( is_checkout() ) {
	$phone_validation_file = get_template_directory() . '/assets/js/checkout-phone-validation.js';

	wp_enqueue_script(
		'vedcare-divine-checkout-phone-validation',
		get_template_directory_uri() . '/assets/js/checkout-phone-validation.js',
		array( 'wp-data' ),
		file_exists( $phone_validation_file ) ? filemtime( $phone_validation_file ) : $theme_version,
		true
	);
}

	if ( get_query_var( 'vedcare_faq' ) ) {
		$faq_css_file = get_template_directory() . '/assets/css/faq.css';
		$faq_js_file  = get_template_directory() . '/assets/js/faq.js';

		wp_enqueue_style( 'vedcare-divine-faq', get_template_directory_uri() . '/assets/css/faq.css', array( 'vedcare-divine-theme' ), file_exists( $faq_css_file ) ? filemtime( $faq_css_file ) : $theme_version );
		wp_enqueue_script( 'vedcare-divine-faq', get_template_directory_uri() . '/assets/js/faq.js', array(), file_exists( $faq_js_file ) ? filemtime( $faq_js_file ) : $theme_version, true );
	}

	if ( get_query_var( 'vedcare_contact' ) ) {
		$contact_css_file = get_template_directory() . '/assets/css/contact.css';

		wp_enqueue_style( 'vedcare-divine-contact', get_template_directory_uri() . '/assets/css/contact.css', array( 'vedcare-divine-theme' ), file_exists( $contact_css_file ) ? filemtime( $contact_css_file ) : $theme_version );
	}

	if ( is_page( 'blog' ) ) {
		$blog_css_file = get_template_directory() . '/assets/css/blog.css';

		wp_enqueue_style( 'vedcare-divine-blog', get_template_directory_uri() . '/assets/css/blog.css', array( 'vedcare-divine-theme' ), file_exists( $blog_css_file ) ? filemtime( $blog_css_file ) : $theme_version );
	}
}
add_action( 'wp_enqueue_scripts', 'vedcare_divine_enqueue_assets' );

/**
 * Add the delivery estimate to the WooCommerce Cart and Checkout Blocks.
 *
 * The classic checkout submit hook is not rendered by the block-based flows.
 */
function vedcare_divine_block_delivery_estimate() {
	if ( ( ! is_checkout() || is_order_received_page() ) && ! is_cart() ) {
		return;
	}
	?>
	<div id="vedcare-block-delivery-estimate" class="vedcare-checkout-delivery-estimate" hidden><?php esc_html_e( 'Estimated Delivery: 4–7 Days', 'vedcare-divine' ); ?></div>
	<script>
	(function() {
		var notice = document.getElementById( 'vedcare-block-delivery-estimate' );
		var isCheckout = document.body.classList.contains( 'woocommerce-checkout' );
		var selector = isCheckout ? '.wc-block-checkout__actions, [data-block-name="woocommerce/checkout-actions-block"]' : '.wc-block-cart__totals-footer, [data-block-name="woocommerce/cart-order-summary-block"]';

		function placeNotice() {
			var target = document.querySelector( selector );

			if ( ! target || target.contains( notice ) ) {
				return;
			}

			notice.hidden = false;
			target.insertBefore( notice, target.firstChild );
		}

		placeNotice();
		new MutationObserver( placeNotice ).observe( document.body, { childList: true, subtree: true } );
	}());
	</script>
	<?php
}
add_action( 'wp_footer', 'vedcare_divine_block_delivery_estimate', 20 );

/**
 * Return a URL for a bundled theme asset.
 *
 * @param string $path Asset path relative to the theme directory.
 * @return string
 */
function vedcare_divine_asset_url( $path ) {
	return get_template_directory_uri() . '/' . ltrim( $path, '/' );
}

/**
 * Load editable product data bundled with the theme.
 *
 * @param string $slug Product slug.
 * @return array<string, mixed>
 */
function vedcare_divine_get_product_data( $slug ) {
	$slug = sanitize_title( $slug );
	$file = get_theme_file_path( 'assets/data/products/' . $slug . '.json' );

	if ( ! $slug || ! is_readable( $file ) ) {
		return array();
	}

	$data = json_decode( file_get_contents( $file ), true ); // phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents

	return is_array( $data ) ? $data : array();
}

function vedcare_divine_get_about_data() {
	$file = get_theme_file_path( 'assets/data/about-us.json' );

	if ( ! is_readable( $file ) ) {
		return array();
	}

	$data = json_decode( file_get_contents( $file ), true ); // phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents

	return is_array( $data ) ? $data : array();
}

function vedcare_divine_get_faq_data() {
	$file = get_theme_file_path( 'assets/data/faqs.json' );

	if ( ! is_readable( $file ) ) {
		return array();
	}

	$data = json_decode( file_get_contents( $file ), true ); // phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents

	return is_array( $data ) ? $data : array();
}

function vedcare_divine_product_rewrite_rule() {
	add_rewrite_rule( '^product/([^/]+)/?$', 'index.php?vedcare_product=$matches[1]', 'top' );
	add_rewrite_rule( '^about-us/?$', 'index.php?vedcare_about=1', 'top' );
	add_rewrite_rule( '^faqs/?$', 'index.php?vedcare_faq=1', 'top' );
	add_rewrite_rule( '^contact/?$', 'index.php?vedcare_contact=1', 'top' );
}
add_action( 'init', 'vedcare_divine_product_rewrite_rule' );

function vedcare_divine_ensure_contact_page() {
	if ( get_page_by_path( 'contact', OBJECT, 'page' ) ) {
		return;
	}

	wp_insert_post(
		array(
			'post_title'  => 'Contact',
			'post_name'   => 'contact',
			'post_status' => 'publish',
			'post_type'   => 'page',
		)
	);
}
add_action( 'init', 'vedcare_divine_ensure_contact_page', 20 );

function vedcare_divine_ensure_blog_page_and_categories() {
	if ( ! get_page_by_path( 'blog', OBJECT, 'page' ) ) {
		wp_insert_post(
			array(
				'post_title'  => 'Blog',
				'post_name'   => 'blog',
				'post_status' => 'publish',
				'post_type'   => 'page',
			)
		);
	}

	$categories = array(
		'ayurveda'          => 'Ayurveda',
		'nutrition'         => 'Nutrition',
		'fitness-muscle'    => 'Fitness & Muscle',
		'weight-management' => 'Weight Management',
		'joint-wellness'    => 'Joint Wellness',
		'healthy-living'    => 'Healthy Living',
	);

	foreach ( $categories as $slug => $name ) {
		if ( ! get_term_by( 'slug', $slug, 'category' ) ) {
			wp_insert_term( $name, 'category', array( 'slug' => $slug ) );
		}
	}
}
add_action( 'init', 'vedcare_divine_ensure_blog_page_and_categories', 21 );

function vedcare_divine_product_query_var( $vars ) {
	$vars[] = 'vedcare_product';
	$vars[] = 'vedcare_about';
	$vars[] = 'vedcare_faq';
	$vars[] = 'vedcare_contact';
	return $vars;
}
add_filter( 'query_vars', 'vedcare_divine_product_query_var' );

function vedcare_divine_product_request( $wp ) {
	if ( empty( $wp->query_vars['vedcare_product'] ) && preg_match( '#^product/([^/]+)/?$#', $wp->request, $matches ) ) {
		$wp->query_vars['vedcare_product'] = $matches[1];
	}

	if ( 'about-us' === trim( $wp->request, '/' ) ) {
		$wp->query_vars['vedcare_about'] = 1;
	}

	if ( 'faqs' === trim( $wp->request, '/' ) ) {
		$wp->query_vars['vedcare_faq'] = 1;
	}

	if ( 'contact' === trim( $wp->request, '/' ) ) {
		$wp->query_vars['vedcare_contact'] = 1;
	}
}
add_action( 'parse_request', 'vedcare_divine_product_request' );

function vedcare_divine_product_template( $template ) {
	if ( is_page( 'blog' ) ) {
		return get_template_directory() . '/blog-page.php';
	}

	if ( get_query_var( 'vedcare_about' ) && vedcare_divine_get_about_data() ) {
		return get_template_directory() . '/about-page.php';
	}

	if ( get_query_var( 'vedcare_faq' ) && vedcare_divine_get_faq_data() ) {
		return get_template_directory() . '/faq-page.php';
	}

	if ( get_query_var( 'vedcare_contact' ) ) {
		return get_template_directory() . '/contact-page.php';
	}

	$slug = get_query_var( 'vedcare_product' );

	if ( $slug && vedcare_divine_get_product_data( $slug ) ) {
		return get_template_directory() . '/product-page.php';
	}

	return $template;
}
add_filter( 'template_include', 'vedcare_divine_product_template' );

function vedcare_divine_blog_query_var( $vars ) {
	$vars[] = 'journal_category';
	return $vars;
}
add_filter( 'query_vars', 'vedcare_divine_blog_query_var' );

function vedcare_divine_contact_menu_url( $items, $args ) {
	if ( empty( $args->theme_location ) || 'primary' !== $args->theme_location ) {
		return $items;
	}

	foreach ( $items as $item ) {
		if ( 'Contact' === trim( wp_strip_all_tags( $item->title ) ) ) {
			$item->url = home_url( '/contact/' );
		}
	}

	return $items;
}
add_filter( 'wp_nav_menu_objects', 'vedcare_divine_contact_menu_url', 10, 2 );

function vedcare_divine_flush_product_rewrite_rules() {
	vedcare_divine_product_rewrite_rule();
	flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'vedcare_divine_flush_product_rewrite_rules' );

function vedcare_divine_flush_contact_rewrite_rule() {
	if ( '1' === get_option( 'vedcare_divine_contact_rewrite_version' ) ) {
		return;
	}

	flush_rewrite_rules( false );
	update_option( 'vedcare_divine_contact_rewrite_version', '1' );
}
add_action( 'init', 'vedcare_divine_flush_contact_rewrite_rule', 99 );

function vedcare_divine_handle_contact_form() {
	$nonce = isset( $_POST['vedcare_divine_contact_nonce'] ) ? sanitize_text_field( wp_unslash( $_POST['vedcare_divine_contact_nonce'] ) ) : '';

	if ( ! $nonce || ! wp_verify_nonce( $nonce, 'vedcare_divine_contact_form' ) ) {
		wp_die( esc_html__( 'Invalid form request.', 'vedcare-divine' ), '', array( 'response' => 403 ) );
	}

	$name    = isset( $_POST['contact_name'] ) ? sanitize_text_field( wp_unslash( $_POST['contact_name'] ) ) : '';
	$mobile  = isset( $_POST['contact_mobile'] ) ? preg_replace( '/[^0-9+]/', '', wp_unslash( $_POST['contact_mobile'] ) ) : '';
	$email   = isset( $_POST['contact_email'] ) ? sanitize_email( wp_unslash( $_POST['contact_email'] ) ) : '';
	$subject = isset( $_POST['contact_subject'] ) ? sanitize_text_field( wp_unslash( $_POST['contact_subject'] ) ) : '';
	$message = isset( $_POST['contact_message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['contact_message'] ) ) : '';
	$subjects = array( 'Product Information', 'Order Support', 'Product Guidance', 'General Enquiry', 'Other' );

	if ( ! $name || strlen( preg_replace( '/\D/', '', $mobile ) ) < 10 || ! $message || ( $email && ! is_email( $email ) ) ) {
		wp_safe_redirect( home_url( '/contact/?contact_status=invalid' ) );
		exit;
	}

	if ( ! in_array( $subject, $subjects, true ) ) {
		$subject = 'General Enquiry';
	}

	$mail_subject = sprintf( 'Website enquiry: %s', $subject );
	$mail_body    = "Name: {$name}\nMobile: {$mobile}\nEmail: {$email}\nSubject: {$subject}\n\nMessage:\n{$message}";
	$headers      = array( 'Content-Type: text/plain; charset=UTF-8' );

	if ( $email ) {
		$headers[] = 'Reply-To: ' . $email;
	}

	$status = wp_mail( 'vedcaredivine@gmail.com', $mail_subject, $mail_body, $headers ) ? 'sent' : 'error';

	wp_safe_redirect( home_url( '/contact/?contact_status=' . $status ) );
	exit;
}
add_action( 'admin_post_vedcare_divine_contact_form', 'vedcare_divine_handle_contact_form' );
add_action( 'admin_post_nopriv_vedcare_divine_contact_form', 'vedcare_divine_handle_contact_form' );

/**
 * Return the appropriate shop URL when WooCommerce is active.
 *
 * @return string
 */
function vedcare_divine_shop_url() {
	if ( function_exists( 'wc_get_page_permalink' ) ) {
		return wc_get_page_permalink( 'shop' );
	}

	return home_url( '/shop/' );
}

/**
 * Return the confirmed product catalogue used before WooCommerce products exist.
 *
 * @return array<string, array<string, string>>
 */
function vedcare_divine_products() {
	return array(
		'vedcare-gold' => array(
			'name'        => 'VedCare Gold',
			'category'    => 'Mass / Weight Gain',
			'price'       => '₹3,399',
			'mrp'         => '₹3,799',
			'description' => "Premium weight and mass gain formulation with 47 herbs. \r\n 𝟰-𝟭𝟮 𝗞𝗴 𝗠𝘂𝘀𝗰𝗹𝗲𝘀 𝗚𝗮𝗶𝗻",
			'image'       => 'assets/images/vedcare-gold.png',
			'badge'       => 'Bestseller',
			'woocommerce' => array(
		'product_id' => 12,
		),
		),
		'vedcare-build' => array(
			'name'        => 'VedCare Build',
			'category'    => 'Mass / Weight Gain',
			'price'       => '₹2,399',
			'mrp'         => '₹2,599',
			'description' => "One-month weight-gain positioning with 38 herbs. \r\n 𝟯-𝟴 𝗞𝗴 𝗠𝘂𝘀𝗰𝗹𝗲𝘀 𝗚𝗮𝗶𝗻",
			'image'       => 'assets/images/vedcare-build.png',
			'badge'       => '',
			'woocommerce' => array(
		'product_id' => 23,
		)
		),
		'vedcare-build-mini' => array(
			'name'        => 'VedCare Build Mini',
			'category'    => 'Mass / Weight Gain',
			'price'       => '₹1,399',
			'mrp'         => '₹1,599',
			'description' => "15-day trial pack with 38 herbs. \r\n 𝟭-𝟯 𝗞𝗴 𝗠𝘂𝘀𝗰𝗹𝗲𝘀 𝗚𝗮𝗶𝗻",
			'image'       => 'assets/images/vedcare-build-mini.png',
			'badge'       => '15-day trial',
			'woocommerce' => array(
		'product_id' => 25,
		)
		),
		'vedcare-lean' => array(
			'name'        => 'VedCare Lean',
			'category'    => 'Fat Loss / Muscle Building',
			'price'       => '₹2,399',
			'mrp'         => '₹2,599',
			'description' => "Weight and fat loss with muscle-building positioning and 42 herbs. \r\n 𝟯-𝟭𝟬 𝗞𝗴 𝗳𝗮𝘁 𝗹𝗼𝘀𝘀",
			'image'       => 'assets/images/vedcare-lean.png',
			'badge'       => '',
			'woocommerce' => array(
		'product_id' => 28,
		)
		),
		'ortho-care' => array(
			'name'        => 'Ortho Care',
			'category'    => 'Joint Care',
			'price'       => '₹2,299',
			'mrp'         => '₹2,499',
			'description' => "Joint wellness and care formulation with 42 herbs. \r\n 𝗥𝗲𝗹𝗶𝗲𝗳 𝗶𝗻 𝟴-𝟭𝟬 𝗱𝗮𝘆𝘀",
			'image'       => 'assets/images/ortho-care.png',
			'badge'       => '',
			'woocommerce' => array(
				'product_id' => 31,
		)
		),
		'vedcare-gold-buy-2-get-1-free' => array(
			'name'        => 'VedCare Gold – Buy 2 Get 1 Free',
			'category'    => 'Mass / Weight Gain',
			'price'       => '₹7,598',
			'mrp'         => '₹11,397',
			'description' => 'Buy 2 Get 1 Free combo offer.',
			'image'       => 'assets/images/vedcare-gold.png',
			'badge'       => 'Buy 2 Get 1 Free',
			'woocommerce' => array(
				'product_id' => 117,
			),
		),
		'vedcare-build-buy-2-get-1-free' => array(
			'name'        => 'VedCare Build – Buy 2 Get 1 Free',
			'category'    => 'Mass / Weight Gain',
			'price'       => '₹4,798',
			'mrp'         => '₹7,797',
			'description' => 'Buy 2 Get 1 Free combo offer.',
			'image'       => 'assets/images/vedcare-build.png',
			'badge'       => 'Buy 2 Get 1 Free',
			'woocommerce' => array(
				'product_id' => 121,
			),
		),
		'vedcare-build-mini-buy-2-get-1-free' => array(
			'name'        => 'VedCare Build Mini – Buy 2 Get 1 Free',
			'category'    => 'Mass / Weight Gain',
			'price'       => '₹2,798',
			'mrp'         => '₹4,797',
			'description' => 'Buy 2 Get 1 Free combo offer.',
			'image'       => 'assets/images/vedcare-build-mini.png',
			'badge'       => 'Buy 2 Get 1 Free',
			'woocommerce' => array(
				'product_id' => 123,
			),
		),
		'vedcare-lean-buy-2-get-1-free' => array(
			'name'        => 'VedCare Lean – Buy 2 Get 1 Free',
			'category'    => 'Fat Loss / Muscle Building',
			'price'       => '₹4,798',
			'mrp'         => '₹7,797',
			'description' => 'Buy 2 Get 1 Free combo offer.',
			'image'       => 'assets/images/vedcare-lean.png',
			'badge'       => 'Buy 2 Get 1 Free',
			'woocommerce' => array(
				'product_id' => 125,
			),
		),
		'ortho-care-buy-2-get-1-free' => array(
			'name'        => 'Ortho Care – Buy 2 Get 1 Free',
			'category'    => 'Joint Care',
			'price'       => '₹4,598',
			'mrp'         => '₹7,497',
			'description' => 'Buy 2 Get 1 Free combo offer.',
			'image'       => 'assets/images/ortho-care.png',
			'badge'       => 'Buy 2 Get 1 Free',
			'woocommerce' => array(
				'product_id' => 127,
			),
		),
	);
}

/**
 * Display a useful menu before the WordPress menu is assigned.
 */
function vedcare_divine_primary_menu_fallback() {
	$items = array(
		__( 'Home', 'vedcare-divine' )        => home_url( '/' ),
		__( 'Shop', 'vedcare-divine' )        => vedcare_divine_shop_url(),
		__( 'Why VedCare', 'vedcare-divine' ) => home_url( '/#why-vedcare' ),
		__( 'About Us', 'vedcare-divine' )    => home_url( '/about-us/' ),
		__( 'FAQs', 'vedcare-divine' )        => home_url( '/faqs/' ),
		__( 'Blog', 'vedcare-divine' )        => home_url( '/blog/' ),
		__( 'Contact', 'vedcare-divine' )     => home_url( '/contact/' ),
	);

	echo '<ul class="primary-navigation__list">';
	foreach ( $items as $label => $url ) {
		echo '<li><a href="' . esc_url( $url ) . '">' . esc_html( $label ) . '</a></li>';
	}
	echo '</ul>';
}
