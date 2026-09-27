<?php
/** Reusable JSON-driven product page. @package VedCare_Divine */
global $wp_query;
$wp_query->is_404 = false;
status_header( 200 );
get_header();
get_template_part( 'template-parts/product-page', null, array( 'product' => vedcare_divine_get_product_data( get_query_var( 'vedcare_product' ) ) ) );
get_footer();
