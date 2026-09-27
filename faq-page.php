<?php
/**
 * FAQ page template.
 *
 * @package VedCare_Divine
 */

global $wp_query;

$wp_query->is_404 = false;
status_header( 200 );

get_header();
get_template_part( 'template-parts/faq-page', null, array( 'faq' => vedcare_divine_get_faq_data() ) );
get_footer();
