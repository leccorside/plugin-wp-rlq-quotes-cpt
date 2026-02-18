<?php
/**
 * Plugin Name: RLQ Quotes Custom Post Type
 * Plugin URI:  https://riselifequote.com/
 * Description: Adiciona o Custom Post Type "Quotes" com campos personalizados específicos para o tema Royal Elementor Kit.
 * Version:     1.0.0
 * Author:      Rise Life Quote
 * Author URI:  https://riselifequote.com/
 * Text Domain: rlq-quotes-cpt
 * License:     GPL-2.0+
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// Define plugin constants
define( 'RLQ_QUOTES_CPT_VERSION', '1.0.0' );
define( 'RLQ_QUOTES_CPT_DIR', plugin_dir_path( __FILE__ ) );
define( 'RLQ_QUOTES_CPT_URL', plugin_dir_url( __FILE__ ) );

/**
 * The code that runs during plugin activation.
 */
function activate_rlq_quotes_cpt() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/post-types.php';
	rlq_register_quotes_cpt();
	flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'activate_rlq_quotes_cpt' );

/**
 * The code that runs during plugin deactivation.
 */
function deactivate_rlq_quotes_cpt() {
	flush_rewrite_rules();
}
register_deactivation_hook( __FILE__, 'deactivate_rlq_quotes_cpt' );

/**
 * Load plugin files.
 */
require_once plugin_dir_path( __FILE__ ) . 'includes/post-types.php';
require_once plugin_dir_path( __FILE__ ) . 'includes/meta-boxes.php';
require_once plugin_dir_path( __FILE__ ) . 'includes/scripts.php';
