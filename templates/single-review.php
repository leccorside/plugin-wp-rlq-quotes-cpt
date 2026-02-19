<?php
/**
 * Template Name: Single Review Page
 *
 * @package RLQ_Quotes_CPT
 */

get_header();

// Get Query Var to find the quote
$quote_slug = get_query_var('rlq_quote');

// Arguments to find the quote post
$args = array(
    'name' => $quote_slug,
    'post_type' => 'rlq_quote',
    'post_status' => 'publish',
    'posts_per_page' => 1,
);

$quote_query = new WP_Query($args);

if ($quote_query->have_posts()) {
    while ($quote_query->have_posts()) {
        $quote_query->the_post();
        $post_id = get_the_ID();

        // Retrieve Meta Data
        $logo_id = get_post_meta($post_id, 'rlq_logo_id', true);
        $logo_url = $logo_id ? wp_get_attachment_image_url($logo_id, 'medium') : '';
        $pros = get_post_meta($post_id, 'rlq_pros', true);
        $cons = get_post_meta($post_id, 'rlq_cons', true);
        $rating = get_post_meta($post_id, 'rlq_rating', true);
        $reviews = get_post_meta($post_id, 'rlq_reviews_count', true);
        $visitors = get_post_meta($post_id, 'rlq_visitors_month', true);
        $quote_url = get_permalink($post_id);

        // Section Data
        $coverage_desc = get_post_meta($post_id, 'rlq_coverage_desc', true);
        $process_desc = get_post_meta($post_id, 'rlq_process_desc', true);
        $cost_desc = get_post_meta($post_id, 'rlq_cost_desc', true); // Using Cost as "Filing a Claim"
        $support_desc = get_post_meta($post_id, 'rlq_support_desc', true);

        // Ratings for specific areas
        $coverage_rating = get_post_meta($post_id, 'rlq_coverage_rating', true);
        $cost_rating = get_post_meta($post_id, 'rlq_cost_rating', true);
        $process_rating = get_post_meta($post_id, 'rlq_process_rating', true);
        $support_rating = get_post_meta($post_id, 'rlq_support_rating', true);

        ?>

        <div class="banner-single">
            <div class="banner-single-content">
                <h1>
                    <?php the_title(); ?> Review
                </h1>
            </div>
        </div>

        <div class="rlq-review-container">

            <!-- Header -->
            <div class="rlq-review-header">
                <div class="rlq-header-left">
                    <?php if ($logo_url): ?>
                        <img src="<?php echo esc_url($logo_url); ?>" alt="<?php the_title(); ?>" class="rlq-company-logo">
                    <?php endif; ?>
                    <div class="rlq-header-meta">
                        <h1>
                            <?php the_title(); ?> Review
                        </h1>
                        <div class="rlq-meta-info">
                            <span><i class="fas fa-star" style="color:#f1c40f;"></i>
                                <?php echo esc_html($rating); ?>/10
                            </span>
                            <span>&nbsp;|&nbsp;</span>
                            <span><i class="fas fa-users"></i>
                                <?php echo esc_html($visitors); ?> customers this month
                            </span>
                        </div>
                    </div>
                </div>
                <div class="rlq-header-right">
                    <a href="<?php echo esc_url($quote_url); ?>" class="rlq-view-rates-btn">View Rates</a>
                </div>
            </div>

            <!-- Left Sidebar (Navigation) -->
            <div class="rlq-sidebar-left">
                <div class="rlq-sticky-menu">
                    <h3>Navigate</h3>
                    <ul>
                        <li><a href="#about-section">About
                                <?php the_title(); ?>
                            </a></li>
                        <?php if ($coverage_desc): ?>
                            <li><a href="#types-policies">Types of Policies</a></li>
                        <?php endif; ?>
                        <?php if ($process_desc): ?>
                            <li><a href="#application-process">Application Process</a></li>
                        <?php endif; ?>
                        <?php if ($cost_desc): ?>
                            <li><a href="#filing-claim">Filing a Claim</a></li>
                        <?php endif; ?>
                        <?php if ($support_desc): ?>
                            <li><a href="#customer-service">Customer Service</a></li>
                        <?php endif; ?>
                        <li><a href="#right-for-you">Is
                                <?php the_title(); ?> Right for You?
                            </a></li>
                    </ul>
                </div>
            </div>

            <!-- Main Content -->
            <div class="rlq-main-content">

                <!-- Pros & Cons -->
                <div class="rlq-pros-cons-wrapper">
                    <div class="rlq-pros">
                        <h3><i class="fas fa-thumbs-up"></i> Pros</h3>
                        <?php echo wp_kses_post($pros); ?>
                    </div>
                    <div class="rlq-cons">
                        <h3><i class="fas fa-thumbs-down"></i> Cons</h3>
                        <?php echo wp_kses_post($cons); ?>
                    </div>
                </div>

                <style>
                    #about-section iframe {
                        width: 100%;
                        height: 300px;
                    }
                </style>

                <!-- About Section -->
                <div id="about-section" class="rlq-section">

                    <?php the_content(); ?>

                    <!-- Overall Rating Box -->
                    <div class="rlq-rating-breakdown">
                        <div class="rlq-rating-item"><span>Coverage Options</span> <span class="rlq-rating-val">
                                <?php echo esc_html($coverage_rating); ?>/10
                            </span></div>
                        <div class="rlq-rating-item"><span>Cost & Value</span> <span class="rlq-rating-val">
                                <?php echo esc_html($cost_rating); ?>/10
                            </span></div>
                        <div class="rlq-rating-item"><span>Application Process</span> <span class="rlq-rating-val">
                                <?php echo esc_html($process_rating); ?>/10
                            </span></div>
                        <div class="rlq-rating-item"><span>Customer Service</span> <span class="rlq-rating-val">
                                <?php echo esc_html($support_rating); ?>/10
                            </span></div>
                    </div>
                </div>

            </div>

            <!-- Right Sidebar -->
            <div class="rlq-sidebar-right">

                <!-- Quotes Slider Widget -->
                <div class="rlq-widget rlq-slider-widget">
                    <div class="rlq-slider-container">
                        <?php
                        $slider_args = array(
                            'post_type' => 'rlq_quote',
                            'posts_per_page' => -1, // All quotes
                            'orderby' => 'rand',
                        );
                        $slider_query = new WP_Query($slider_args);
                        if ($slider_query->have_posts()):
                            $idx = 0;
                            while ($slider_query->have_posts()):
                                $slider_query->the_post();
                                $s_logo_id = get_post_meta(get_the_ID(), 'rlq_logo_id', true);
                                $s_logo_url = $s_logo_id ? wp_get_attachment_image_url($s_logo_id, 'medium') : '';
                                $s_phrase = get_post_meta(get_the_ID(), 'rlq_highlight_phrase', true);
                                $s_slug = get_post_field('post_name', get_the_ID());
                                $s_view_rates = get_permalink();
                                $display = ($idx === 0) ? 'block' : 'none';
                                ?>
                                <div class="rlq-slider-item" style="display: <?php echo $display; ?>;">
                                    <div style="text-align:center; padding: 10px;">
                                        <?php if ($s_logo_url): ?>
                                            <img src="<?php echo esc_url($s_logo_url); ?>"
                                                style="width:100%; margin-bottom:15px; height:auto;">
                                        <?php else: ?>
                                            <h3 style="margin-bottom:15px;"><?php the_title(); ?></h3>
                                        <?php endif; ?>

                                        <div
                                            style="font-size:16px; font-weight:bold; color:#333; margin-bottom:20px; line-height: 1.4;">
                                            <?php echo wp_kses_post($s_phrase); ?>
                                        </div>

                                        <a href="<?php echo esc_url($s_view_rates); ?>" class="rlq-view-rates-btn"
                                            style="width:100%; display:block; box-sizing:border-box; padding: 12px 0;">View Rates</a>
                                    </div>
                                </div>
                                <?php
                                $idx++;
                            endwhile;
                            wp_reset_postdata();
                        endif;
                        ?>

                        <!-- Navigation Arrows -->
                        <div class="rlq-slider-nav">
                            <span class="rlq-slider-prev"><i class="fas fa-chevron-left"></i></span>
                            <span class="rlq-slider-next"><i class="fas fa-chevron-right"></i></span>
                        </div>
                    </div>
                </div>

                <!-- Compare Top Providers -->
                <div class="rlq-widget">
                    <h3 class="rlq-widget-title">Compare Top Providers</h3>
                    <?php
                    $top_args = array(
                        'post_type' => 'rlq_quote',
                        'posts_per_page' => 5,
                        'meta_key' => 'rlq_order',
                        'orderby' => 'meta_value_num',
                        'order' => 'ASC',
                        'post__not_in' => array($post_id) // Exclude current
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

                <!-- Latest Posts -->
                <div class="rlq-widget">
                    <h3 class="rlq-widget-title">Must Reads</h3>
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
                            <div class="rlq-recent-post">
                                <?php if (has_post_thumbnail()): ?>
                                    <?php the_post_thumbnail('thumbnail', array('class' => 'rlq-post-thumb')); ?>
                                <?php endif; ?>
                                <div>
                                    <h4 class="rlq-post-title"><a href="<?php the_permalink(); ?>">
                                            <?php the_title(); ?>
                                        </a></h4>
                                    <a href="<?php the_permalink(); ?>" class="rlq-read-more">Read More</a>
                                </div>
                            </div>
                            <?php
                        endwhile;
                        wp_reset_postdata();
                    endif;
                    ?>
                </div>

            </div>
        </div>
        <?php
    }
    wp_reset_postdata();
} else {
    // If quote not found, maybe redirect or show 404
    echo '<div class="rlq-review-container"><h2>Quote not found.</h2></div>';
}

get_footer();
