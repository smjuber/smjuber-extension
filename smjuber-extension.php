<?php
/**
 * SMJUBER Extension
 *
 * @package           	SMJUBER Extension
 * @author            	SMJUBER
 * @copyright         	2021 SMJUBER
 *
 * @wordpress-plugin
 * Plugin Name: 		SMJUBER Extension
 * PLugin URI: 			https://github.com/smjuber/smjuber-extension
 * Description: 		SMJUBER Extension plugin is extended features of SMJUBER Theme.
 * Version: 			1.0.1
 * License:             GPLv2 or later
 * License URI:         http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * Author: 				SMJUBER
 * Author URI: 			https://www.linkedin.com/in/smjuber/
 * Text Domain: 		smjuber-ext
 * Domain Path: 		/languages
 * Tested up to: 		5.6
 * Requires at least: 	5.0
 * Requires PHP:		7.4
 * Copyright (c) 2016-2021, SMJUBER
 */

// Not permitted to call this file directly.
if ( ! defined( 'ABSPATH' ) ) {
	die();
}

/**
 * Load plugin text domain
 */
if ( !function_exists( 'smjuber_ext_load_textdomain' ) ) {
	function smjuber_ext_load_textdomain() {
	  	load_plugin_textdomain( 'smjuber-ext', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
	}
}
add_action( 'plugins_loaded', 'smjuber_ext_load_textdomain' );

/**
 * Load plugin style
 */
if ( !function_exists( 'smjuber_ext_scripts' ) ) {
	function smjuber_ext_scripts(){
		wp_enqueue_style( 'smjuber-ext-style', plugins_url( '/assets/css/smjuber-ext-style.css', __FILE__ ), array(), '1.0.1', 'all' );
		wp_style_add_data( 'smjuber-ext-style', 'rtl', 'replace' );
	}
}
add_action('wp_enqueue_scripts', 'smjuber_ext_scripts');

/**
 * Load Author social filter
 */
require_once( plugin_dir_path(__FILE__) . '/includes/author-social/class-author-social.php' );

/**
 * Load Project register custom post type and taxonomy
 */
require_once( plugin_dir_path(__FILE__) . '/includes/cpt/class-doc-register.php' );

/**
 * Load social share buttons shortcode
 */
require_once( plugin_dir_path(__FILE__) . '/includes/social-share/class-social-share.php' );

/**
 * Load widget classes
 */
require_once( plugin_dir_path(__FILE__) . '/includes/widgets/class-facebook-widget.php' );
require_once( plugin_dir_path(__FILE__) . '/includes/widgets/class-latest-post-widget.php' );
require_once( plugin_dir_path(__FILE__) . '/includes/widgets/class-profile-widget.php' );
require_once( plugin_dir_path(__FILE__) . '/includes/widgets/class-social-nav-widget.php' );

/**
 * Widgets classes register initialization
 */
if ( !function_exists( 'smjuber_ext_custom_widgets_register' ) ) {
	function smjuber_ext_custom_widgets_register() {
		register_widget( 'Smjuber_Extension_Facebook_Widget' );
		register_widget( 'Smjuber_Extension_Latest_Post_Widget' );
		register_widget( 'Smjuber_Extension_Profile_Widget' );
		register_widget( 'Smjuber_Extension_Social_Nav_Widget' );
	}
}
add_action( 'widgets_init', 'smjuber_ext_custom_widgets_register' );

/**
 * Plugin activation
 */
if ( !function_exists( 'smjuber_ext_activation' ) ) {
	function smjuber_ext_activation() {
		flush_rewrite_rules();
	}
}
register_activation_hook( __FILE__, 'smjuber_ext_activation' );

/**
 * Plugin deactivation
 */
if ( !function_exists( 'smjuber_ext_deactivation' ) ) {
	function smjuber_ext_deactivation() {
		unregister_post_type( 'doc' );
		unregister_taxonomy( 'doc-type' );
		flush_rewrite_rules();
	}
}
register_deactivation_hook( __FILE__, 'smjuber_ext_deactivation' );

?>