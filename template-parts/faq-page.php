<?php
/**
 * FAQ page content.
 *
 * @package VedCare_Divine
 */

$faq      = isset( $args['faq'] ) && is_array( $args['faq'] ) ? $args['faq'] : array();
$page     = isset( $faq['page'] ) && is_array( $faq['page'] ) ? $faq['page'] : array();
$sections = isset( $faq['sections'] ) && is_array( $faq['sections'] ) ? $faq['sections'] : array();
$cta      = isset( $faq['cta'] ) && is_array( $faq['cta'] ) ? $faq['cta'] : array();
?>

<main class="faq-page">
	<section class="faq-hero">
		<div class="faq-hero__inner container">
			<?php if ( ! empty( $page['tagline'] ) ) : ?>
				<p class="faq-hero__tagline"><?php echo esc_html( $page['tagline'] ); ?></p>
			<?php endif; ?>
			<h1 class="faq-hero__title"><?php echo esc_html( $page['title'] ?? '' ); ?></h1>
			<?php if ( ! empty( $page['subtitle'] ) ) : ?>
				<p class="faq-hero__subtitle"><?php echo esc_html( $page['subtitle'] ); ?></p>
			<?php endif; ?>
			<?php if ( ! empty( $page['intro'] ) ) : ?>
				<p class="faq-hero__intro"><?php echo esc_html( $page['intro'] ); ?></p>
			<?php endif; ?>
		</div>
	</section>

	<div class="faq-sections container">
		<?php foreach ( $sections as $section_index => $section ) : ?>
			<?php if ( empty( $section['faqs'] ) || ! is_array( $section['faqs'] ) ) { continue; } ?>
			<section class="faq-section" aria-labelledby="faq-section-<?php echo esc_attr( $section_index ); ?>">
				<h2 class="faq-section__title" id="faq-section-<?php echo esc_attr( $section_index ); ?>"><?php echo esc_html( $section['title'] ?? '' ); ?></h2>
				<div class="faq-list">
					<?php foreach ( $section['faqs'] as $question_index => $item ) : ?>
						<?php
						$button_id = 'faq-question-' . $section_index . '-' . $question_index;
						$panel_id  = 'faq-answer-' . $section_index . '-' . $question_index;
						?>
						<article class="faq-item">
							<h3 class="faq-item__heading">
								<button class="faq-trigger" type="button" id="<?php echo esc_attr( $button_id ); ?>" aria-expanded="false" aria-controls="<?php echo esc_attr( $panel_id ); ?>">
									<span class="faq-trigger__text"><?php echo esc_html( $item['question'] ?? '' ); ?></span>
									<span class="faq-trigger__icon" aria-hidden="true"></span>
								</button>
							</h3>
							<div class="faq-panel" id="<?php echo esc_attr( $panel_id ); ?>" role="region" aria-labelledby="<?php echo esc_attr( $button_id ); ?>" hidden>
								<div class="faq-panel__answer"><?php echo wp_kses_post( nl2br( esc_html( $item['answer'] ?? '' ) ) ); ?></div>
							</div>
						</article>
					<?php endforeach; ?>
				</div>
			</section>
		<?php endforeach; ?>
	</div>

	<?php if ( $cta ) : ?>
		<section class="faq-cta">
			<div class="faq-cta__inner container">
				<?php if ( ! empty( $cta['heading'] ) ) : ?>
					<p class="faq-cta__heading"><?php echo esc_html( $cta['heading'] ); ?></p>
				<?php endif; ?>
				<h2 class="faq-cta__title"><?php echo esc_html( $cta['title'] ?? '' ); ?></h2>
				<?php if ( ! empty( $cta['text'] ) ) : ?>
					<p class="faq-cta__text"><?php echo wp_kses_post( nl2br( esc_html( $cta['text'] ) ) ); ?></p>
				<?php endif; ?>
				<?php if ( ! empty( $cta['subtext'] ) ) : ?>
					<p class="faq-cta__subtext"><?php echo esc_html( $cta['subtext'] ); ?></p>
				<?php endif; ?>
				<?php if ( ! empty( $cta['buttons'] ) && is_array( $cta['buttons'] ) ) : ?>
					<div class="faq-cta__buttons">
						<?php foreach ( $cta['buttons'] as $button_index => $button ) : ?>
							<a class="button faq-cta__button<?php echo 0 === $button_index ? '' : ' faq-cta__button--outline'; ?>" href="<?php echo esc_url( home_url( $button['url'] ?? '/' ) ); ?>"><?php echo esc_html( $button['label'] ?? '' ); ?></a>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
			</div>
		</section>
	<?php endif; ?>
</main>
