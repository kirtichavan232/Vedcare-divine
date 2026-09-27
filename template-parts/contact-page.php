<?php
/**
 * Contact page content.
 *
 * @package VedCare_Divine
 */

$contact_status = isset( $_GET['contact_status'] ) ? sanitize_key( wp_unslash( $_GET['contact_status'] ) ) : '';
$maps_url       = 'https://www.google.com/maps/search/?api=1&query=' . rawurlencode( 'Vedcare Divine, Shop No. 07, Roongta Garndezza, Prabhat Colony, Badade Nagar, Bhamare Misal Backside, Appt B/H Kuber Lawns, Nashik 422009' );
?>

<main class="contact-page">
	<section class="contact-hero">
		<div class="contact-hero__inner container">
			<p class="contact-hero__eyebrow">WE'RE HERE TO HELP</p>
			<h1 class="contact-hero__title">Connect With VedCare Divine</h1>
			<p class="contact-hero__text">Have questions about our products, orders or wellness guidance? We're here to help.</p>
		</div>
	</section>

	<section class="contact-main">
		<div class="contact-main__grid container">
			<div class="contact-details">
				<h2 class="contact-section__title">Let's Connect</h2>
				<div class="contact-details__block">
					<h3 class="contact-details__label">Office</h3>
					<address class="contact-details__text">Vedcare Divine<br>Shop No. 07<br>Roongta Garndezza<br>Prabhat Colony,<br>Badade Nagar,<br>Bhamare Misal Backside<br>Appt B/H Kuber Lawns<br>Nashik – 422009</address>
				</div>
				<div class="contact-details__block">
					<h3 class="contact-details__label">Contact</h3>
					<p class="contact-details__text"><a href="tel:+919577377737">95 7737 7737</a><br><a href="tel:+917775838777">77758 38777</a></p>
				</div>
				<div class="contact-details__block">
					<h3 class="contact-details__label">Email</h3>
					<p class="contact-details__text"><a href="mailto:vedcaredivine@gmail.com">vedcaredivine@gmail.com</a></p>
				</div>
				<div class="contact-details__actions">
					<a class="button button--whatsapp" href="https://wa.me/919577377737" target="_blank" rel="noopener noreferrer">WhatsApp Us</a>
					<a class="button button--secondary" href="<?php echo esc_url( $maps_url ); ?>" target="_blank" rel="noopener noreferrer">Get Directions</a>
				</div>
			</div>

			<div class="contact-form-wrap">
				<h2 class="contact-section__title">Send Us a Message</h2>
				<?php if ( 'sent' === $contact_status ) : ?>
					<p class="contact-form__notice contact-form__notice--success" role="status">Thank you. Your message has been sent.</p>
				<?php elseif ( 'invalid' === $contact_status ) : ?>
					<p class="contact-form__notice" role="alert">Please complete the required fields with valid details.</p>
				<?php elseif ( 'error' === $contact_status ) : ?>
					<p class="contact-form__notice" role="alert">Your message could not be sent. Please try WhatsApp or call us.</p>
				<?php endif; ?>
				<form class="contact-form" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post">
					<input type="hidden" name="action" value="vedcare_divine_contact_form">
					<?php wp_nonce_field( 'vedcare_divine_contact_form', 'vedcare_divine_contact_nonce' ); ?>
					<div class="contact-form__grid">
						<p class="contact-form__field"><label for="contact-name">Name<sup>*</sup></label><input id="contact-name" name="contact_name" type="text" autocomplete="name" required></p>
						<p class="contact-form__field"><label for="contact-mobile">Mobile Number<sup>*</sup></label><input id="contact-mobile" name="contact_mobile" type="tel" autocomplete="tel" inputmode="numeric" required></p>
						<p class="contact-form__field"><label for="contact-email">Email</label><input id="contact-email" name="contact_email" type="email" autocomplete="email"></p>
						<p class="contact-form__field"><label for="contact-subject">Subject</label><select id="contact-subject" name="contact_subject"><option value="">Select a subject</option><option value="Product Information">Product Information</option><option value="Order Support">Order Support</option><option value="Product Guidance">Product Guidance</option><option value="General Enquiry">General Enquiry</option><option value="Other">Other</option></select></p>
					</div>
					<p class="contact-form__field"><label for="contact-message">Message<sup>*</sup></label><textarea id="contact-message" name="contact_message" rows="6" required></textarea></p>
					<button class="button contact-form__submit" type="submit">Send Message</button>
				</form>
			</div>
		</div>
	</section>

	<section class="contact-guidance">
		<div class="contact-guidance__inner container">
			<h2 class="contact-guidance__title">Not Sure Which Product Is Right for You?</h2>
			<p class="contact-guidance__text">If you're unsure which VedCare Divine product best suits your goals, our team is here to guide you.</p>
			<a class="button button--gold" href="https://wa.me/919577377737" target="_blank" rel="noopener noreferrer">Talk to an Expert</a>
		</div>
	</section>

	<section class="contact-faq-cta">
		<div class="contact-faq-cta__inner container">
			<h2 class="contact-section__title">Have More Questions?</h2>
			<p>Find answers to common questions about our products, orders, payments and delivery.</p>
			<a class="button button--secondary" href="<?php echo esc_url( home_url( '/faqs/' ) ); ?>">Visit FAQs</a>
		</div>
	</section>

	<section class="contact-final-cta">
		<div class="contact-final-cta__inner container">
			<h2 class="contact-final-cta__title">We're Here When You Need Us</h2>
			<div class="contact-final-cta__actions">
				<a class="button button--whatsapp" href="https://wa.me/919577377737" target="_blank" rel="noopener noreferrer">WhatsApp Us</a>
				<a class="button button--outline-light" href="tel:+919577377737">Call Us</a>
			</div>
		</div>
	</section>
</main>
