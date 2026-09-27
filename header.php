<?php
/** Site header. @package VedCare_Divine */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link screen-reader-text" href="#main-content"><?php esc_html_e( 'Skip to content', 'vedcare-divine' ); ?></a>
<header class="site-header">
	<div class="announcement-bar"><p><?php esc_html_e( 'Premium Ayurvedic wellness and nutrition', 'vedcare-divine' ); ?></p></div>
	<div class="site-header__inner">
		<a class="site-branding" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
			<img src="<?php echo esc_url( vedcare_divine_asset_url( 'assets/images/logo.png' ) ); ?>" alt="<?php esc_attr_e( 'VedCare Divine', 'vedcare-divine' ); ?>" width="86" height="86">
			<span class="site-branding__name"><strong>VedCare Divine</strong><small><?php esc_html_e( 'Ayurvedic Supplement', 'vedcare-divine' ); ?></small></span>
		</a>
		<button class="menu-toggle" type="button" aria-expanded="false" aria-controls="primary-menu"><span class="screen-reader-text"><?php esc_html_e( 'Toggle navigation', 'vedcare-divine' ); ?></span><span></span><span></span><span></span></button>
		<nav id="primary-menu" class="primary-navigation" aria-label="<?php esc_attr_e( 'Primary navigation', 'vedcare-divine' ); ?>">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'container'      => false,
					'menu_class'     => 'primary-navigation__list',
					'fallback_cb'    => 'vedcare_divine_primary_menu_fallback',
				)
			);
			?>
		</nav>
		<div class="header-actions">
			<a href="<?php echo esc_url( vedcare_divine_shop_url() ); ?>" aria-label="<?php esc_attr_e( 'Search products', 'vedcare-divine' ); ?>" class="header-action">⌕</a>
			<a href="<?php echo esc_url( home_url( '/my-account/' ) ); ?>" aria-label="<?php esc_attr_e( 'My account', 'vedcare-divine' ); ?>" class="header-action"><svg aria-hidden="true" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="3.5"/><path d="M5.5 20a6.5 6.5 0 0 1 13 0"/></svg></a>
			<a href="<?php echo esc_url( home_url( '/cart/' ) ); ?>" aria-label="<?php esc_attr_e( 'Shopping cart', 'vedcare-divine' ); ?>" class="header-action"><svg aria-hidden="true" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M3 4h2l2.4 11.2a2 2 0 0 0 2 1.6h8.8a2 2 0 0 0 2-1.6L22 8H6"/><circle cx="10" cy="20" r="1"/><circle cx="18" cy="20" r="1"/></svg></a>
		</div>
	</div>
</header>
<main id="main-content" class="site-main">
