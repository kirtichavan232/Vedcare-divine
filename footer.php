<?php
/** Site footer. @package VedCare_Divine */
?>
</main>
<footer id="contact" class="site-footer">
	<div class="site-footer__inner site-footer__grid">
		<div class="footer-brand">
			<img src="<?php echo esc_url( vedcare_divine_asset_url( 'assets/images/logo.png' ) ); ?>" alt="<?php esc_attr_e( 'VedCare Divine', 'vedcare-divine' ); ?>" width="76" height="76">
			<p><?php esc_html_e( 'Modern Ayurvedic wellness and nutrition for your transformation journey.', 'vedcare-divine' ); ?></p>
		</div>
		<div><h2><?php esc_html_e( 'Shop', 'vedcare-divine' ); ?></h2><ul><li><a href="<?php echo esc_url( vedcare_divine_shop_url() ); ?>"><?php esc_html_e( 'All products', 'vedcare-divine' ); ?></a></li><li><a href="<?php echo esc_url( home_url( '/shop/#mass-weight-gain' ) ); ?>"><?php esc_html_e( 'Mass / Weight Gain', 'vedcare-divine' ); ?></a></li><li><a href="<?php echo esc_url( home_url( '/shop/#fat-loss-muscle-building' ) ); ?>"><?php esc_html_e( 'Fat Loss / Muscle Building', 'vedcare-divine' ); ?></a></li><li><a href="<?php echo esc_url( home_url( '/shop/#joint-care' ) ); ?>"><?php esc_html_e( 'Joint Care', 'vedcare-divine' ); ?></a></li></ul></div>
		<div><h2><?php esc_html_e( 'Customer support', 'vedcare-divine' ); ?></h2><ul><li><a href="<?php echo esc_url( home_url( '/faqs/' ) ); ?>"><?php esc_html_e( 'FAQs', 'vedcare-divine' ); ?></a></li><li><a href="<?php echo esc_url( home_url( '/shipping-delivery/' ) ); ?>"><?php esc_html_e( 'Shipping & Delivery', 'vedcare-divine' ); ?></a></li><li><a href="<?php echo esc_url( home_url( '/returns-refunds/' ) ); ?>"><?php esc_html_e( 'Returns & Refunds', 'vedcare-divine' ); ?></a></li></ul></div>
		<div><h2><?php esc_html_e( 'Contact', 'vedcare-divine' ); ?></h2><ul><li><a href="tel:+919577377737">9577377737</a></li><li><a href="tel:+917775838777">7775838777</a></li><li><a href="mailto:vedcaredivine@gmail.com">vedcaredivine@gmail.com</a></li></ul></div>
	</div>
	<div class="site-footer__bottom"><div class="container"><p>&copy; <?php echo esc_html( wp_date( 'Y' ) ); ?> <?php esc_html_e( 'Vedcare Divine Private Limited', 'vedcare-divine' ); ?></p><nav aria-label="<?php esc_attr_e( 'Legal navigation', 'vedcare-divine' ); ?>"><a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>"><?php esc_html_e( 'Privacy', 'vedcare-divine' ); ?></a><a href="<?php echo esc_url( home_url( '/terms-conditions/' ) ); ?>"><?php esc_html_e( 'Terms', 'vedcare-divine' ); ?></a></nav></div></div>
</footer>
<a class="vedcare-floating-whatsapp" href="https://wa.me/919577377737" target="_blank" rel="noopener noreferrer" aria-label="<?php esc_attr_e( 'Chat with VedCare Divine on WhatsApp', 'vedcare-divine' ); ?>">
	<svg viewBox="0 0 32 32" aria-hidden="true" focusable="false"><path d="M27.1 4.8A15.3 15.3 0 0 0 16.2.3C7.8.3 1 7.1 1 15.5c0 2.7.7 5.3 2 7.6L.8 31.2l8.3-2.2a15.2 15.2 0 0 0 7.1 1.8h.1c8.4 0 15.2-6.8 15.2-15.2 0-4.1-1.6-7.9-4.4-10.8ZM16.2 28.2h-.1a12.6 12.6 0 0 1-6.4-1.7l-.5-.3-4.9 1.3 1.3-4.8-.3-.5a12.6 12.6 0 0 1-1.9-6.7c0-7 5.7-12.7 12.7-12.7 3.4 0 6.6 1.3 9 3.7a12.6 12.6 0 0 1 3.7 9c0 7-5.7 12.7-12.6 12.7Zm7-9.5c-.4-.2-2.3-1.1-2.6-1.2-.4-.1-.6-.2-.9.2-.3.4-1 1.2-1.3 1.5-.2.3-.5.3-.9.1-1.5-.8-2.6-1.5-3.6-3.4-.3-.4.3-.4.8-1.4.1-.2.1-.5 0-.7-.1-.2-.9-2.1-1.2-2.9-.3-.7-.6-.6-.9-.6h-.7c-.3 0-.7.1-1 .5-.4.4-1.3 1.3-1.3 3.2 0 1.9 1.4 3.7 1.6 3.9.2.3 2.7 4.1 6.5 5.7 2.4 1 3.3 1.1 4.5.9.7-.1 2.3-.9 2.6-1.8.3-.9.3-1.7.2-1.8-.1-.2-.3-.3-.7-.5Z" fill="currentColor"/></svg>
</a>
<?php wp_footer(); ?>
</body>
</html>
