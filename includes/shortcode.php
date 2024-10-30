<?php
defined( 'ABSPATH' ) or exit;
    
add_shortcode( 'cvmh-catblock', 'cvmh_catblock_front_shortcode' );
function cvmh_catblock_front_shortcode( $atts ) {
    
    $args = shortcode_atts( cvmh_catblock_default_args(), $atts );
    return cvmh_catblock_front_render( $args );
    
}