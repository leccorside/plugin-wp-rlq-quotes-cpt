<?php
/**
 * Admin Scripts and Styles.
 */

if (!defined('ABSPATH')) {
    exit;
}

function rlq_admin_enqueue_scripts($hook)
{
    global $post;

    if ('post-new.php' == $hook || 'post.php' == $hook) {
        if ('rlq_quote' === $post->post_type) {
            wp_enqueue_media();

            wp_enqueue_style('rlq-admin-css', RLQ_QUOTES_CPT_URL . 'assets/css/admin.css', array(), RLQ_QUOTES_CPT_VERSION);
            wp_enqueue_script('rlq-admin-js', RLQ_QUOTES_CPT_URL . 'assets/js/admin.js', array('jquery'), RLQ_QUOTES_CPT_VERSION, true);
        }
    }
}
add_action('admin_enqueue_scripts', 'rlq_admin_enqueue_scripts');
