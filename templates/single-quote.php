<?php
/**
 * Template Name: Single Quote Page
 *
 * @package RLQ_Quotes_CPT
 */

get_header();

if (have_posts()) {
    while (have_posts()) {
        the_post();
        $post_id = get_the_ID();

        // Retrieve Meta Data
        $logo_id = get_post_meta($post_id, 'rlq_logo_id', true);
        $logo_url = $logo_id ? wp_get_attachment_image_url($logo_id, 'medium') : '';
        $pros = get_post_meta($post_id, 'rlq_pros', true);
        $cons = get_post_meta($post_id, 'rlq_cons', true);
        $rating = get_post_meta($post_id, 'rlq_rating', true);
        $reviews = get_post_meta($post_id, 'rlq_reviews_count', true);
        $visitors = get_post_meta($post_id, 'rlq_visitors_month', true);
        // On single quote page, "View Rates" might link to an external affiliate URL if available, 
        // or loop back to itself if no external link. 
        // For now, let's link to the post itself or '#' if standard behavior. 
        // In the review template, it linked to get_permalink($post_id).
        $quote_url = get_permalink($post_id);

        // Section Data
        $coverage_desc = get_post_meta($post_id, 'rlq_coverage_desc', true);
        $process_desc = get_post_meta($post_id, 'rlq_process_desc', true);
        $cost_desc = get_post_meta($post_id, 'rlq_cost_desc', true);
        $support_desc = get_post_meta($post_id, 'rlq_support_desc', true);

        // Ratings for specific areas
        $coverage_rating = get_post_meta($post_id, 'rlq_coverage_rating', true);
        $cost_rating = get_post_meta($post_id, 'rlq_cost_rating', true);
        $process_rating = get_post_meta($post_id, 'rlq_process_rating', true);
        $support_rating = get_post_meta($post_id, 'rlq_support_rating', true);

        ?>

        <div class="banner-single">
            <div class="banner-single-content">
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
            </div>
        </div>

        <div class="rlq-review-container">

            <!-- Main Content -->
            <div class="rlq-main-content">

                <div class="rlq-form-wrapper">
                    <div class="rlq-multi-step-container">
                        <!-- Left Panel -->
                        <div class="rlq-ms-left-panel">
                            <h2>Your kind of life insurance</h2>
                            <p>It's not just easy. It's smart and affordable, too.</p>
                            <!-- Placeholder image, user should replace with actual asset -->
                            <img src="<?php echo content_url('/uploads/2026/02/sample.webp'); ?>" alt="Family Illustration"
                                class="rlq-ms-illustration">
                        </div>

                        <!-- Right Panel -->
                        <div class="rlq-ms-right-panel">
                            <h2>Get you price estimate</h2>

                            <!-- Stepper -->
                            <div class="rlq-stepper-container">
                                <div class="rlq-stepper-line">
                                    <div class="rlq-stepper-progress-bar"></div>
                                </div>
                                <div class="rlq-step-indicator active" data-step="1">
                                    <div class="rlq-step-icon"><i class="fas fa-folder"></i></div>
                                </div>
                                <div class="rlq-step-indicator" data-step="2">
                                    <div class="rlq-step-icon"><i class="fas fa-pencil-alt"></i></div>
                                </div>
                                <div class="rlq-step-indicator" data-step="3">
                                    <div class="rlq-step-icon"><i class="fas fa-image"></i></div>
                                </div>
                                <div class="rlq-step-indicator" data-step="4">
                                    <div class="rlq-step-icon"><i class="fas fa-check"></i></div>
                                </div>
                            </div>

                            <form id="rlq-multi-step-form">
                                <?php for ($i = 1; $i <= 4; $i++): ?>
                                    <div class="rlq-form-step" data-step="<?php echo $i; ?>"
                                        style="<?php echo $i > 1 ? 'display:none;' : ''; ?>">

                                        <div class="rlq-form-row">
                                            <div class="rlq-form-group half-width">
                                                <!-- <label>Height</label> -->
                                                <select name="height_<?php echo $i; ?>" class="rlq-form-control" required>
                                                    <option value="">Height</option>
                                                    <option value="5'0">5'0"</option>
                                                    <option value="5'1">5'1"</option>
                                                    <!-- Add more options if needed -->
                                                </select>
                                            </div>
                                            <div class="rlq-form-group half-width">
                                                <!-- <label>Weight</label> -->
                                                <input type="number" name="weight_<?php echo $i; ?>" class="rlq-form-control"
                                                    placeholder="Weight" required>
                                            </div>
                                        </div>

                                        <div class="rlq-form-row">
                                            <div class="rlq-form-group half-width">
                                                <!-- <label>Sex</label> -->
                                                <select name="sex_<?php echo $i; ?>" class="rlq-form-control" required>
                                                    <option value="">Sex</option>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                </select>
                                            </div>
                                            <div class="rlq-form-group half-width">
                                                <!-- <label>Date of birth</label> -->
                                                <input type="text" name="dob_<?php echo $i; ?>" class="rlq-form-control"
                                                    placeholder="Date of birth" onfocus="(this.type='date')" required>
                                            </div>
                                        </div>

                                        <div class="rlq-form-group">
                                            <label style="font-size:12px; margin-bottom:5px; display:block; color:#555;">Which state
                                                do you live in?</label>
                                            <div class="rlq-select-wrapper-state">
                                                <select name="state_<?php echo $i; ?>" class="rlq-form-control" required>
                                                    <option value="">Select State</option>
                                                    <option value="CA">California (CA)</option>
                                                    <!-- Add more states -->
                                                </select>
                                            </div>
                                        </div>

                                        <div class="rlq-form-actions">
                                            <?php if ($i > 1): ?>
                                                <button type="button" class="rlq-btn rlq-prev-step">Previous</button>
                                            <?php else: ?>
                                                <button type="button" class="rlq-btn rlq-prev-step"
                                                    style="visibility:hidden;">Previous</button>
                                            <?php endif; ?>

                                            <?php if ($i < 4): ?>
                                                <button type="button" class="rlq-btn rlq-next-step primary">Save and continue</button>
                                            <?php else: ?>
                                                <button type="submit" class="rlq-btn rlq-submit-btn primary">Get My Quote</button>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endfor; ?>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <?php
    }
}

get_footer();
