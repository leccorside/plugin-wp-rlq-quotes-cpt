<?php
/**
 * RLQ Quotes Shortcodes & AJAX
 *
 * @package RLQ_Quotes_CPT
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Shortcode [rlq_comparison_list]
 */
function rlq_comparison_list_render($atts)
{
    // Enqueue scripts and styles
    wp_enqueue_style('rlq-home-style');
    wp_enqueue_script('rlq-filter-script');

    // Localize script with ajax url
    wp_localize_script('rlq-filter-script', 'rlq_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php')
    ));

    ob_start();
    ?>
    <div class="rlq-comparison-wrapper">

        <!-- Filter Section -->
        <div class="rlq-filter-section">
            <div class="rlq-filter-header">
                <h3>How old are you?</h3>
                <p>Filter the best options for you</p>
            </div>
            <div class="rlq-filter-input">
                <label for="rlq-age-filter">Choose your age group</label>
                <div class="rlq-select-wrapper">
                    <select id="rlq-age-filter">
                        <option value="all">All ages</option>
                        <option value="18-34">18-34</option>
                        <option value="35-44">35-34</option>
                        <option value="45-54">45-54</option>
                        <option value="55+">55+</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Dynamic List Container -->
        <div id="rlq-quotes-list">
            <?php
            // Initial load showing all
            echo rlq_get_quotes_html('all');
            ?>
        </div>

        <!-- "Secure Your Loved One’s Future" Section 
        <div class="rlq-secure-future-section">
            <div class="rlq-sf-logo">
                <i class="fas fa-shield-alt" style="font-size: 50px; color: #2c3e50;"></i>
            </div>
            <div class="rlq-sf-content">
                <h3>
                    <?php echo get_theme_mod('rlq_secure_future_text', 'Secure Your Loved One’s Future With A Life Insurance Policy'); ?>
                </h3>
                <p>
                    <?php echo get_theme_mod('rlq_secure_future_content', 'Life insurance is a contract...'); ?>
                </p>
            </div>
            <div class="rlq-sf-action">
                <a href="#" class="rlq-sf-btn">Get My Free Quote</a>
            </div>
        </div>-->

        <!-- "Texto Home" Section 
        <div class="rlq-home-text-section">
            <div class="rlq-home-text-content">
                <?php //echo wp_kses_post(get_theme_mod('rlq_home_text_content', 'Home Text Content...')); ?>
            </div>
        </div>-->

        <!-- Must Reads Section 
        <div class="rlq-home-widget">
            <h3 class="rlq-home-widget-title">Must Reads</h3>
            <div class="rlq-must-reads-grid">
                <?php
                $blog_args = array(
                    'post_type' => 'post',
                    'posts_per_page' => 3
                );
                $blog_query = new WP_Query($blog_args);
                if ($blog_query->have_posts()):
                    while ($blog_query->have_posts()):
                        $blog_query->the_post();
                        ?>
                        <div class="rlq-must-read-item">
                            <?php if (has_post_thumbnail()) {
                                the_post_thumbnail('medium', array('class' => 'rlq-mr-thumb'));
                            } ?>
                            <div class="rlq-mr-content">
                                <h4><a href="<?php the_permalink(); ?>">
                                        <?php the_title(); ?>
                                    </a></h4>
                                <a href="<?php the_permalink(); ?>" class="rlq-read-more">Read More <i
                                        class="fas fa-arrow-right"></i></a>
                            </div>
                        </div>
                        <?php
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?>
            </div>
        </div>-->

    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('rlq_comparison_list', 'rlq_comparison_list_render');

/**
 * AJAX Handler
 */
function rlq_filter_quotes()
{
    $age_group = isset($_POST['age_group']) ? sanitize_text_field($_POST['age_group']) : '';
    // If empty or all, pass specific value or handle in get_quotes
    echo rlq_get_quotes_html($age_group);
    wp_die(); // properly terminate AJAX
}
add_action('wp_ajax_rlq_filter_quotes', 'rlq_filter_quotes');
add_action('wp_ajax_nopriv_rlq_filter_quotes', 'rlq_filter_quotes');

/**
 * Helper to get Quotes HTML
 */
function rlq_get_quotes_html($age_filter = '')
{
    $args = array(
        'post_type' => 'rlq_quote',
        'posts_per_page' => -1,
        'meta_key' => 'rlq_order',
        'orderby' => 'meta_value_num',
        'order' => 'ASC',
    );

    // Only filter if age_filter is set AND strictly not 'all'
    if ($age_filter && $age_filter !== 'all') {
        $args['meta_query'] = array(
            array(
                'key' => 'rlq_age_range',
                'value' => $age_filter,
                'compare' => '='
            )
        );
    }

    $query = new WP_Query($args);
    $output = '';

    if ($query->have_posts()) {
        $count = 1;
        $featured_quote_data = null; // Store data for #1

        while ($query->have_posts()) {
            $query->the_post();
            $id = get_the_ID();
            $logo_id = get_post_meta($id, 'rlq_logo_id', true);
            $logo_url = $logo_id ? wp_get_attachment_image_url($logo_id, 'medium') : '';
            $rating = get_post_meta($id, 'rlq_rating', true);
            $visitors = get_post_meta($id, 'rlq_visitors_month', true);
            $slug = get_post_field('post_name', $id);
            $review_link = home_url('rlq_quote/reviews/' . $slug);
            $highlight = get_post_meta($id, 'rlq_highlight_phrase', true);

            // Capture data for #1
            if ($count === 1) {
                $featured_quote_data = array(
                    'id' => $id,
                    'title' => get_the_title(),
                    'logo_url' => $logo_url,
                    'rating' => $rating,
                    'reviews_count' => get_post_meta($id, 'rlq_reviews_count', true),
                    'pros' => get_post_meta($id, 'rlq_pros', true),
                    'cons' => get_post_meta($id, 'rlq_cons', true),
                    'review_link' => $review_link,
                    // Details
                    'coverage_title' => get_post_meta($id, 'rlq_coverage_title', true),
                    'coverage_desc' => get_post_meta($id, 'rlq_coverage_desc', true),
                    'coverage_rating' => get_post_meta($id, 'rlq_coverage_rating', true),
                    'cost_title' => get_post_meta($id, 'rlq_cost_title', true),
                    'cost_desc' => get_post_meta($id, 'rlq_cost_desc', true),
                    'cost_rating' => get_post_meta($id, 'rlq_cost_rating', true),
                    'process_title' => get_post_meta($id, 'rlq_process_title', true),
                    'process_desc' => get_post_meta($id, 'rlq_process_desc', true),
                    'process_rating' => get_post_meta($id, 'rlq_process_rating', true),
                    'support_title' => get_post_meta($id, 'rlq_support_title', true),
                    'support_desc' => get_post_meta($id, 'rlq_support_desc', true),
                    'support_rating' => get_post_meta($id, 'rlq_support_rating', true),
                );
            }

            // Output logic
            ob_start();
            ?>
            <div class="rlq-quote-card <?php echo ($count === 1) ? 'rlq-featured-card' : 'rlq-standard-card'; ?>">
                <?php if ($count === 1): ?>
                    <div class="rlq-featured-badge">Fast Application</div>
                    <div class="rlq-fire-icon"><i class="fas fa-fire"></i></div>
                <?php endif; ?>

                <div class="rlq-card-body">
                    <div class="rlq-col-rank">
                        <!-- Rank is possibly outside or just a number. Image suggests distinct handling. -->
                        <span class="rlq-rank-num"><?php echo $count; ?></span>
                    </div>
                    <div class="rlq-col-logo">
                        <?php if ($logo_url): ?><img src="<?php echo esc_url($logo_url); ?>"
                                alt="<?php the_title(); ?>"><?php endif; ?>
                        <!-- Title might be needed if logo doesn't include text, but image shows logo text. We'll add title hidden or styled if needed. -->

                    </div>

                    <div class="rlq-col-desc">
                        <div class="rlq-featured-list">
                            <!-- We need a list here. Assuming 'rlq_short_desc' contains the list or we use a fixed field for now. 
                                      User said "prices start at..." etc. We will try to parse short desc as list items if possible, 
                                      or just output it. -->
                            <h3 class="rlq-card-title">
                                <?php the_title(); ?>
                            </h3>
                            <?php
                            $short_desc = get_post_meta($id, 'rlq_short_desc', true);
                            echo wp_kses_post($short_desc);
                            ?>
                        </div>
                    </div>

                    <div class=" <?php if ($count === 1): ?>rlq-col-rating1 <?php else: ?>rlq-col-rating<?php endif; ?>">
                        <div class="rlq-rating-circle">
                            <?php
                            $rating_val = floatval($rating);
                            $rating_label = 'Good';
                            if ($rating_val >= 9.9)
                                $rating_label = 'Superb';
                            elseif ($rating_val >= 9.5)
                                $rating_label = 'Excellent';
                            elseif ($rating_val >= 9.0)
                                $rating_label = 'Very Good';
                            elseif ($rating_val >= 7.0)
                                $rating_label = 'Good';
                            elseif ($rating_val >= 5.0)
                                $rating_label = 'Medium';
                            else
                                $rating_label = 'Bad';
                            ?>
                            <span class="rlq-rating-text">
                                <?php echo $rating_label; ?>
                            </span>
                            <span class="rlq-rating-num"><?php echo $rating; ?></span>
                        </div>
                        <div class="rlq-stars">
                            <?php
                            for ($i = 0; $i < 5; $i++) {
                                if ($i < floor($rating / 2))
                                    echo '<i class="fas fa-star"></i>';
                                elseif ($i < ceil($rating / 2))
                                    echo '<i class="fas fa-star-half-alt"></i>';
                                else
                                    echo '<i class="far fa-star"></i>';
                            }
                            ?>
                        </div>
                        <div class="rlq-reviews-count">Reviews
                            (<?php echo number_format((float) get_post_meta($id, 'rlq_reviews_count', true), 0, '.', ','); ?>)</div>
                    </div>

                    <div class="rlq-col-action">
                        <?php if ($count === 1): ?>
                            <div class="rlq-visitor-tooltip">
                                <i class="fas fa-user-friends"></i> <strong><?php echo number_format((float) $visitors, 0, '.', ','); ?>
                                    people</strong> visited this site this month
                                <div class="rlq-tooltip-arrow"></div>
                            </div>
                        <?php endif; ?>

                        <a href="<?php the_permalink(); ?>" class="rlq-view-rates-btn-home">Get Quote</a>

                        <a href="<?php echo esc_url($review_link); ?>" class="rlq-read-review-link">Read Review</a>

                    </div>
                </div>

            </div>
            <?php
            $output .= ob_get_clean();
            $count++;
        }

        // After loop: Render Featured Highlights Card if data exists
        if ($featured_quote_data) {
            ob_start();
            ?>
            <div class="rlq-review-highlights-card">
                <h3 class="rlq-highlights-main-title">Life Insurance Review Highlights</h3>
                <div class="rlq-highlights-container">

                    <div class="rlq-highlights-header">
                        <div class="rlq-hh-logo">
                            <?php if ($featured_quote_data['logo_url']): ?>
                                <img src="<?php echo esc_url($featured_quote_data['logo_url']); ?>"
                                    alt="<?php echo esc_attr($featured_quote_data['title']); ?>">
                            <?php else: ?>
                                <h3><?php echo esc_html($featured_quote_data['title']); ?></h3>
                            <?php endif; ?>
                            <div class="rlq-hh-title"><?php if ($featured_quote_data['logo_url'])
                                echo esc_html($featured_quote_data['title']); ?></div>
                        </div>
                        <div class="rlq-hh-rating">
                            <div class="rlq-stars">
                                <?php
                                $rating = $featured_quote_data['rating'];
                                for ($i = 0; $i < 5; $i++) {
                                    if ($i < floor($rating / 2))
                                        echo '<i class="fas fa-star"></i>';
                                    elseif ($i < ceil($rating / 2))
                                        echo '<i class="fas fa-star-half-alt"></i>';
                                    else
                                        echo '<i class="far fa-star"></i>';
                                }
                                ?>
                            </div>
                            <span class="rlq-hh-score"><?php echo $rating; ?></span>
                            <span
                                class="rlq-hh-reviews">(<?php echo number_format((float) $featured_quote_data['reviews_count'], 0, '.', '.'); ?>
                                Reviews)</span>
                        </div>
                    </div>

                    <div class="rlq-highlights-body">
                        <div class="rlq-hb-left">
                            <!-- Coverage -->
                            <div class="rlq-metric-item">
                                <div class="rlq-metric-header">
                                    <span class="rlq-metric-icon"><i class="fas fa-umbrella"></i></span>
                                    <span
                                        class="rlq-metric-title"><?php echo esc_html($featured_quote_data['coverage_title'] ?: 'Coverage'); ?></span>
                                    <span
                                        class="rlq-metric-badge"><?php echo esc_html($featured_quote_data['coverage_rating'] ?: '10'); ?></span>
                                </div>
                                <div class="rlq-metric-desc">
                                    <?php echo wp_kses_post($featured_quote_data['coverage_desc'] ?: 'Description of coverage...'); ?>
                                </div>
                            </div>

                            <!-- Cost -->
                            <div class="rlq-metric-item">
                                <div class="rlq-metric-header">
                                    <span class="rlq-metric-icon"><i class="fas fa-dollar-sign"></i></span>
                                    <span
                                        class="rlq-metric-title"><?php echo esc_html($featured_quote_data['cost_title'] ?: 'Cost'); ?></span>
                                    <span
                                        class="rlq-metric-badge"><?php echo esc_html($featured_quote_data['cost_rating'] ?: '10'); ?></span>
                                </div>
                                <div class="rlq-metric-desc">
                                    <?php echo wp_kses_post($featured_quote_data['cost_desc'] ?: 'Description of cost...'); ?>
                                </div>
                            </div>

                            <!-- Process -->
                            <div class="rlq-metric-item">
                                <div class="rlq-metric-header">
                                    <span class="rlq-metric-icon"><i class="fas fa-cogs"></i></span>
                                    <span
                                        class="rlq-metric-title"><?php echo esc_html($featured_quote_data['process_title'] ?: 'Process'); ?></span>
                                    <span
                                        class="rlq-metric-badge"><?php echo esc_html($featured_quote_data['process_rating'] ?: '10'); ?></span>
                                </div>
                                <div class="rlq-metric-desc">
                                    <?php echo wp_kses_post($featured_quote_data['process_desc'] ?: 'Description of process...'); ?>
                                </div>
                            </div>

                            <!-- Support -->
                            <div class="rlq-metric-item">
                                <div class="rlq-metric-header">
                                    <span class="rlq-metric-icon"><i class="fas fa-handshake"></i></span>
                                    <span
                                        class="rlq-metric-title"><?php echo esc_html($featured_quote_data['support_title'] ?: 'Support'); ?></span>
                                    <span
                                        class="rlq-metric-badge-low"><?php echo esc_html($featured_quote_data['support_rating'] ?: '9.0'); ?></span>
                                </div>
                                <div class="rlq-metric-desc">
                                    <?php echo wp_kses_post($featured_quote_data['support_desc'] ?: 'Description of support...'); ?>
                                </div>
                            </div>
                        </div>

                        <div class="rlq-hb-right">
                            <div class="rlq-pros-box">
                                <h4><i class="fas fa-check"></i> Pros</h4>
                                <div class="rlq-pros-content">
                                    <?php echo wp_kses_post($featured_quote_data['pros']); ?>
                                </div>
                            </div>
                            <div class="rlq-cons-box">
                                <h4><i class="fas fa-times"></i> Cons</h4>
                                <div class="rlq-cons-content">
                                    <?php echo wp_kses_post($featured_quote_data['cons']); ?>
                                </div>
                            </div>

                            <a href="<?php echo esc_url(get_permalink($featured_quote_data['id'])); ?>"
                                class="rlq-view-rates-btn-home" style="margin-top:20px;">Get Quote</a>
                        </div>
                    </div>

                </div>
            </div>
            <?php
            $output .= ob_get_clean();
        }

    } else {
        $output = '<div class="rlq-no-results">No quotes found for this criteria.</div>';
    }
    wp_reset_postdata();

    return $output;
}

/**
 * Shortcode: Top Providers Widget [rlq_top_providers]
 */
function rlq_top_providers_render($atts)
{
    ob_start();

    // Query Top Providers
    $args = array(
        'post_type' => 'rlq_quote',
        'posts_per_page' => 5,
        'meta_key' => 'rlq_order',
        'orderby' => 'meta_value_num',
        'order' => 'ASC',
    );
    $query = new WP_Query($args);
    ?>
    <div class="rlq-widget">
        <h3 class="rlq-widget-title">Compare Top Providers</h3>
            <?php
            $current_id = get_the_ID();
            $top_args = array(
                'post_type' => 'rlq_quote',
                'posts_per_page' => 5,
                'meta_key' => 'rlq_order',
                'orderby' => 'meta_value_num',
                'order' => 'ASC',
                'post__not_in' => array($current_id) // Exclude current
            );
            $top_query = new WP_Query($top_args);
            if ($top_query->have_posts()):
                while ($top_query->have_posts()):
                    $top_query->the_post();
                    $t_logo_id = get_post_meta(get_the_ID(), 'rlq_logo_id', true);
                    $t_logo_url = $t_logo_id ? wp_get_attachment_image_url($t_logo_id, 'thumbnail') : '';
                    $t_slug = get_post_field('post_name', get_the_ID());
                    $review_link = home_url('rlq_quote/reviews/' . $t_slug);
                    ?>
                            <div class="rlq-compare-item">
                                <?php if ($t_logo_url): ?><img src="<?php echo esc_url($t_logo_url); ?>" class="rlq-compare-logo">
                                <?php endif; ?>
                                <div>
                                    <div style="font-weight:bold;font-size:12px;">
                                        <?php the_title(); ?>
                                    </div>
                                    <a href="<?php echo esc_url($review_link); ?>" class="rlq-compare-btn">Read Review</a>
                                </div>
                            </div>
                            <?php
                endwhile;
                wp_reset_postdata();
            endif;
            ?>
            <a href="<?php echo esc_url(home_url('/')); ?>" class="custom-compare-btn">Compare All</a>
        </div>
        <?php
        return ob_get_clean();
}
add_shortcode('rlq_top_providers', 'rlq_top_providers_render');
