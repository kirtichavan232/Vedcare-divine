<?php
/** Fallback template. @package VedCare_Divine */
get_header();

if ( is_front_page() ) {
	get_template_part( 'template-parts/homepage' );
} elseif ( have_posts() ) {
	?>
	<section class="section"><div class="container container--narrow">
		<?php while ( have_posts() ) : the_post(); ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<h1 class="entry-title"><?php the_title(); ?></h1>
				<div class="entry-content"><?php the_content(); ?></div>
			</article>
		<?php endwhile; ?>
	</div></section>
	<?php
} else {
	?>
	<section class="section"><div class="container container--narrow"><h1><?php esc_html_e( 'Nothing found', 'vedcare-divine' ); ?></h1><p><?php esc_html_e( 'There is no content to display here yet.', 'vedcare-divine' ); ?></p></div></section>
	<?php
}

get_footer();