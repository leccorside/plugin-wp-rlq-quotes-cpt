<?php
/**
 * Plugin Name: RLQ Quotes Custom Post Type
 * Plugin URI:  https://riselifequote.com/
 * Description: Adiciona o Custom Post Type "Quotes" com campos personalizados específicos para o tema Royal Elementor Kit.
 * Version:     1.0.0
 * Author:      Johnathan Amorim
 * Author URI:  https://leccorside.com.br
 * Text Domain: rlq-quotes-cpt
 * License:     GPL-2.0+
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
	die;
}

// Define plugin constants
define('RLQ_QUOTES_CPT_VERSION', '1.0.0');
define('RLQ_QUOTES_CPT_DIR', plugin_dir_path(__FILE__));
define('RLQ_QUOTES_CPT_URL', plugin_dir_url(__FILE__));

/**
 * The code that runs during plugin activation.
 */
function activate_rlq_quotes_cpt()
{
	require_once plugin_dir_path(__FILE__) . 'includes/post-types.php';
	require_once plugin_dir_path(__FILE__) . 'includes/rewrite-rules.php';
	rlq_register_quotes_cpt();
	rlq_add_review_rewrite_rule();
	flush_rewrite_rules();
}
register_activation_hook(__FILE__, 'activate_rlq_quotes_cpt');

/**
 * The code that runs during plugin deactivation.
 */
function deactivate_rlq_quotes_cpt()
{
	flush_rewrite_rules();
}
register_deactivation_hook(__FILE__, 'deactivate_rlq_quotes_cpt');

/**
 * Load plugin files.
 */
require_once plugin_dir_path(__FILE__) . 'includes/post-types.php';
require_once plugin_dir_path(__FILE__) . 'includes/meta-boxes.php';
require_once plugin_dir_path(__FILE__) . 'includes/scripts.php';
require_once plugin_dir_path(__FILE__) . 'includes/rewrite-rules.php';
require_once plugin_dir_path(__FILE__) . 'includes/template-loader.php';
require_once plugin_dir_path(__FILE__) . 'includes/customizer.php';
require_once plugin_dir_path(__FILE__) . 'includes/shortcodes.php';

/**
 * Enqueue Styles for Review Page.
 */
function rlq_enqueue_review_styles()
{
	// Review Page Assets
	if (get_query_var('rlq_review_page') || is_singular('rlq_quote')) {
		wp_enqueue_style('rlq-review-style', plugin_dir_url(__FILE__) . 'assets/css/rlq-review-style.css', array(), RLQ_QUOTES_CPT_VERSION);
		wp_enqueue_script('rlq-review-slider', plugin_dir_url(__FILE__) . 'assets/js/rlq-review-slider.js', array('jquery'), RLQ_QUOTES_CPT_VERSION, true);
		wp_enqueue_script('rlq-multi-step-form', plugin_dir_url(__FILE__) . 'assets/js/rlq-multi-step-form.js', array('jquery'), RLQ_QUOTES_CPT_VERSION, true);
		// Enqueue Font Awesome if not already present
		wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css', array(), '6.4.0');
	}

	// Register Scripts/Styles for Shortcodes (enqueued in shortcode function)
	wp_register_style('rlq-home-style', plugin_dir_url(__FILE__) . 'assets/css/rlq-home-style.css', array(), RLQ_QUOTES_CPT_VERSION);
	wp_register_script('rlq-filter-script', plugin_dir_url(__FILE__) . 'assets/js/rlq-filter.js', array('jquery'), RLQ_QUOTES_CPT_VERSION, true);

	// Make sure FA is available for shortcode too if needed, or enqueue it globally if acceptable. 
	// For now, let's register it to be safe or just enqueue if not present.
	if (!wp_style_is('font-awesome', 'enqueued') && !wp_style_is('font-awesome', 'registered')) {
		wp_register_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css', array(), '6.4.0');
	}
}
add_action('wp_enqueue_scripts', 'rlq_enqueue_review_styles');
