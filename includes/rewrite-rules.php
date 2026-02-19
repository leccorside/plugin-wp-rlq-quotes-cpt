<?php
/**
 * Rewrite Rules for Review Page.
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Add Rewrite Rule specific for Reviews.
 * URL Structure: rlq_quote/reviews/[quote-slug]/
 */
function rlq_add_review_rewrite_rule()
{
    add_rewrite_rule(
        '^rlq_quote/reviews/([^/]*)/?',
        'index.php?rlq_quote=$matches[1]&rlq_review_page=1',
        'top'
    );
}
add_action('init', 'rlq_add_review_rewrite_rule');

/**
 * Register Query Var.
 */
function rlq_register_query_vars($vars)
{
    $vars[] = 'rlq_review_page';
    return $vars;
}
add_filter('query_vars', 'rlq_register_query_vars');
