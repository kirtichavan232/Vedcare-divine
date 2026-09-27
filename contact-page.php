<?php
/**
 * Contact page template.
 *
 * @package VedCare_Divine
 */

global $wp_query;

$wp_query->is_404 = false;
status_header( 200 );

get_header();
get_template_part( 'template-parts/contact-page' );
get_footer();
