<?php
/**
 * Blog page content.
 *
 * @package VedCare_Divine
 */

$category_links = array(
	'ayurveda'          => 'Ayurveda',
	'nutrition'         => 'Nutrition',
	'fitness-muscle'    => 'Fitness & Muscle',
	'weight-management' => 'Weight Management',
	'joint-wellness'    => 'Joint Wellness',
	'healthy-living'    => 'Healthy Living',
);
$selected_category = sanitize_title( (string) get_query_var( 'journal_category' ) );
$paged             = max( 1, absint( get_query_var( 'paged' ) ), absint( get_query_var( 'page' ) ) );
$default_post      = get_post( 1 );
$excluded_posts    = array();

if ( $default_post && 'post' === $default_post->post_type && 'Hello world!' === $default_post->post_title ) {
	$excluded_posts[] = (int) $default_post->ID;
}

$featured_query    = new WP_Query(
	array(
		'posts_per_page'      => 1,
		'post_status'         => 'publish',
		'ignore_sticky_posts' => true,
		'post__not_in'        => $excluded_posts,
	)
);
$featured_id       = $featured_query->have_posts() ? (int) $featured_query->posts[0]->ID : 0;
$latest_query_args = array(
	'posts_per_page'      => 6,
	'paged'               => $paged,
	'post_status'         => 'publish',
	'ignore_sticky_posts' => true,
	'post__not_in'        => $excluded_posts,
);

if ( $featured_id ) {
	$latest_query_args['post__not_in'][] = $featured_id;
}

if ( $selected_category && array_key_exists( $selected_category, $category_links ) ) {
	$latest_query_args['category_name'] = $selected_category;
}

$latest_query = new WP_Query( $latest_query_args );
$blog_url     = home_url( '/blog/' );
?>

<main class="blog-page">
	<section class="blog-hero">
		<div class="blog-hero__inner container">
			<p class="blog-hero__eyebrow">VEDCARE DIVINE JOURNAL</p>
			<h1 class="blog-hero__title">Ayurveda, Wellness &amp; Better Living</h1>
			<p class="blog-hero__text">Discover practical insights on Ayurveda, nutrition, fitness, healthy living and everyday wellness — thoughtfully shared by VedCare Divine.</p>
		</div>
	</section>

	<section class="blog-featured container" aria-label="Featured article">
		<?php if ( $featured_query->have_posts() ) : ?>
			<?php while ( $featured_query->have_posts() ) : $featured_query->the_post(); ?>
				<article class="blog-featured__card">
					<a class="blog-featured__image" href="<?php the_permalink(); ?>" aria-label="<?php echo esc_attr( get_the_title() ); ?>">
						<?php if ( has_post_thumbnail() ) : ?>
							<?php the_post_thumbnail( 'large', array( 'loading' => 'eager' ) ); ?>
						<?php else : ?>
							<span class="blog-featured__image-fallback" aria-hidden="true"></span>
						<?php endif; ?>
					</a>
					<div class="blog-featured__content">
						<?php $categories = get_the_category(); if ( $categories ) : ?><p class="blog-card__category"><?php echo esc_html( $categories[0]->name ); ?></p><?php endif; ?>
						<h2 class="blog-featured__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						<p class="blog-featured__excerpt"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 34 ) ); ?></p>
						<p class="blog-card__meta"><?php echo esc_html( get_the_date() ); ?> <span aria-hidden="true">·</span> <?php echo esc_html( get_the_author() ); ?></p>
						<a class="blog-featured__link" href="<?php the_permalink(); ?>">Read Article <span aria-hidden="true">→</span></a>
					</div>
				</article>
			<?php endwhile; ?>
		<?php else : ?>
			<div class="blog-featured__placeholder">
				<div class="blog-featured__placeholder-visual" aria-hidden="true"><span>✦</span></div>
				<div class="blog-featured__placeholder-content">
					<p class="blog-card__category">Featured Article</p>
					<h2 class="blog-featured__title">Thoughtful wellness reading is on its way.</h2>
					<p class="blog-featured__excerpt">The VedCare Divine Journal will soon share practical insights to support your everyday wellness journey.</p>
				</div>
			</div>
		<?php endif; wp_reset_postdata(); ?>
	</section>

	<section class="blog-journal container">
		<h2 class="blog-section__title">Explore Our Journal</h2>
		<nav class="blog-categories" aria-label="Blog categories">
			<a class="blog-categories__link<?php echo $selected_category ? '' : ' is-active'; ?>" href="<?php echo esc_url( $blog_url ); ?>">All</a>
			<?php foreach ( $category_links as $slug => $label ) : ?>
				<a class="blog-categories__link<?php echo $selected_category === $slug ? ' is-active' : ''; ?>" href="<?php echo esc_url( add_query_arg( 'journal_category', $slug, $blog_url ) ); ?>"><?php echo esc_html( $label ); ?></a>
			<?php endforeach; ?>
		</nav>

		<h2 class="blog-section__title blog-section__title--latest">Latest From VedCare Divine</h2>
		<?php if ( $latest_query->have_posts() ) : ?>
			<div class="blog-grid">
				<?php while ( $latest_query->have_posts() ) : $latest_query->the_post(); ?>
					<article class="blog-card">
						<a class="blog-card__image" href="<?php the_permalink(); ?>" aria-label="<?php echo esc_attr( get_the_title() ); ?>">
							<?php if ( has_post_thumbnail() ) : ?>
								<?php the_post_thumbnail( 'medium_large', array( 'loading' => 'lazy' ) ); ?>
							<?php else : ?>
								<span class="blog-card__image-fallback" aria-hidden="true"></span>
							<?php endif; ?>
						</a>
						<div class="blog-card__content">
							<?php $categories = get_the_category(); if ( $categories ) : ?><p class="blog-card__category"><?php echo esc_html( $categories[0]->name ); ?></p><?php endif; ?>
							<h3 class="blog-card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							<p class="blog-card__excerpt"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 21 ) ); ?></p>
							<p class="blog-card__meta"><?php echo esc_html( get_the_date() ); ?> <span aria-hidden="true">·</span> <?php echo esc_html( get_the_author() ); ?></p>
							<a class="blog-card__link" href="<?php the_permalink(); ?>">Read More <span aria-hidden="true">→</span></a>
						</div>
					</article>
				<?php endwhile; ?>
			</div>
			<?php
			$pagination_args = array(
				'base'      => $blog_url . '?paged=%#%',
				'format'    => '',
				'current'   => $paged,
				'total'     => $latest_query->max_num_pages,
				'prev_text' => '←',
				'next_text' => '→',
				'type'      => 'list',
			);
			if ( $selected_category ) {
				$pagination_args['add_args'] = array( 'journal_category' => $selected_category );
			}
			$pagination = paginate_links( $pagination_args );
			if ( $pagination ) :
				?>
				<nav class="blog-pagination" aria-label="Posts navigation"><?php echo wp_kses_post( $pagination ); ?></nav>
				<?php
			endif;
			?>
		<?php else : ?>
			<div class="blog-empty" aria-label="Articles coming soon">
				<div class="blog-empty__grid" aria-hidden="true"><span></span><span></span><span></span></div>
				<p>New VedCare Divine Journal articles will appear here soon. Please check back for practical wellness insights.</p>
			</div>
		<?php endif; wp_reset_postdata(); ?>
	</section>

	<section class="blog-wellness-cta">
		<div class="blog-wellness-cta__inner container">
			<h2 class="blog-wellness-cta__title">Your Wellness Journey Starts With the Right Knowledge</h2>
			<p class="blog-wellness-cta__text">Explore VedCare Divine's Ayurvedic wellness products and discover solutions designed around your wellness goals.</p>
			<a class="button button--gold" href="<?php echo esc_url( home_url( '/shop/' ) ); ?>">Explore Products <span aria-hidden="true">→</span></a>
		</div>
	</section>
</main>
