<?php
/*
 * Plugin Name: Cat Block
 * Plugin URI: http://www.agence-web-cvmh.fr
 * Description: Adds a block (widget or shortcode), which scrolls through the posts in a category.
 * Version: 2.6.18
 * Author: CVMH solutions
 * Author URI: http://www.agence-web-cvmh.fr
 * License: GPLv2 or later
 * Text Domain: cat-block
 * Domain Path: /languages
 */

defined( 'ABSPATH' ) or exit;

add_action( 'plugins_loaded', 'cvmh_catblock_constants', 1 );
function cvmh_catblock_constants() {
    define( 'CVMH_CATBLOCK_VERSION'       , '2.6.18' );
    define( 'CVMH_CATBLOCK_PATH'          , trailingslashit( plugin_dir_path( __FILE__ ) ) );
    define( 'CVMH_CATBLOCK_URI'           , trailingslashit( plugin_dir_url( __FILE__ ) ) );
    define( 'CVMH_CATBLOCK_INC_PATH'      , CVMH_CATBLOCK_PATH . trailingslashit( 'includes' ) ) ;
    define( 'CVMH_CATBLOCK_ASSETS_PATH'   , CVMH_CATBLOCK_URI . trailingslashit( 'assets' ) ) ;
}

add_action( 'plugins_loaded', 'cvmh_catblock_i18n', 2 );
function cvmh_catblock_i18n() {
    load_plugin_textdomain( 'cat-block', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
}
                        
add_action( 'plugins_loaded', 'cvmh_catblock_includes', 3 );
function cvmh_catblock_includes() {
    require_once( CVMH_CATBLOCK_INC_PATH . 'functions.php' );
    require_once( CVMH_CATBLOCK_INC_PATH . 'widget.php' );
    require_once( CVMH_CATBLOCK_INC_PATH . 'shortcode.php' );
}

add_action( 'widgets_init', array( 'CVMH_CatBlock_Widget', 'register' ) );

add_action('wp_enqueue_scripts', 'cvmh_catblock_front_enqueues' );

// Load the admin style.
add_action( 'admin_enqueue_scripts', 'cvmh_catblock_admin_scripts' );
add_action( 'customize_controls_enqueue_scripts', 'cvmh_catblock_admin_scripts' );