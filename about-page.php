<?php
/** JSON-driven About Us page. @package VedCare_Divine */
global $wp_query;
$wp_query->is_404 = false;
status_header( 200 );
get_header();
get_template_part( 'template-parts/about-page', null, array( 'about' => vedcare_divine_get_about_data() ) );
get_footer();
