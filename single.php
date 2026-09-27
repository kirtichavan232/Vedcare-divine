<?php
/** Single blog post template. @package VedCare_Divine */
get_header();
?>
<section class="journal-post-section">
	<div class="journal-post">
		<?php while ( have_posts() ) : the_post(); ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class( 'journal-post__article' ); ?>>
				<header class="journal-post__header">
					<?php $categories = get_the_category(); if ( $categories ) : ?>
						<p class="journal-post__category"><?php echo esc_html( $categories[0]->name ); ?></p>
					<?php endif; ?>
					<h1 class="journal-post__title"><?php the_title(); ?></h1>
					<p class="journal-post__meta"><time datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time><span aria-hidden="true"> · </span><?php echo esc_html( get_the_author() ); ?></p>
				</header>
				<?php
				$post_content          = get_the_content();
				$thumbnail_id          = get_post_thumbnail_id();
				$thumbnail_in_content  = $thumbnail_id && false !== strpos( $post_content, 'wp-image-' . $thumbnail_id );
				if ( $thumbnail_id && ! $thumbnail_in_content ) {
					$image_sizes = array_merge( array( 'full' ), array_keys( wp_get_registered_image_subsizes() ) );
					foreach ( $image_sizes as $image_size ) {
						$thumbnail_source = wp_get_attachment_image_src( $thumbnail_id, $image_size );
						if ( $thumbnail_source && false !== strpos( $post_content, $thumbnail_source[0] ) ) {
							$thumbnail_in_content = true;
							break;
						}
					}
				}
				?>
				<?php if ( has_post_thumbnail() && ! $thumbnail_in_content ) : ?>
					<figure class="journal-post__featured-image"><?php the_post_thumbnail( 'large', array( 'loading' => 'eager' ) ); ?></figure>
				<?php endif; ?>
				<div class="journal-post__content entry-content"><?php the_content(); ?></div>
			</article>
		<?php endwhile; ?>
	</div>
</section>
<?php get_footer(); ?>
