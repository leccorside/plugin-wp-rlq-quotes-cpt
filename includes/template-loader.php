<?php
/**
 * Template Loader for Review Page.
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Load Custom Template for Reviews.
 */
function rlq_review_template_loader($template)
{
    if (get_query_var('rlq_review_page')) {
        $new_template = plugin_dir_path(__DIR__) . 'templates/single-review.php';
        if (file_exists($new_template)) {
            return $new_template;
        }
    }

    // Check for standard Single Quote Post
    if (is_singular('rlq_quote')) {
        $new_template = plugin_dir_path(__DIR__) . 'templates/single-quote.php';
        if (file_exists($new_template)) {
            return $new_template;
        }
    }

    return $template;
}
add_filter('template_include', 'rlq_review_template_loader');
