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
                                    <div class="rlq-step-icon"><i class="fas fa-check"></i></div>
                                </div>

                                <div class="rlq-step-indicator " data-step="2">
                                    <div class="rlq-step-icon"><i class="fas fa-check"></i></div>
                                </div>

                                <div class="rlq-step-indicator " data-step="3">
                                    <div class="rlq-step-icon"><i class="fas fa-check"></i></div>
                                </div>

                                <div class="rlq-step-indicator " data-step="4">
                                    <div class="rlq-step-icon"><i class="fas fa-check"></i></div>
                                </div>

                                <div class="rlq-step-indicator " data-step="5">
                                    <div class="rlq-step-icon"><i class="fas fa-check"></i></div>
                                </div>

                                <div class="rlq-step-indicator " data-step="6">
                                    <div class="rlq-step-icon"><i class="fas fa-check"></i></div>
                                </div>

                                <div class="rlq-step-indicator " data-step="7">
                                    <div class="rlq-step-icon"><i class="fas fa-check"></i></div>
                                </div>

                                <div class="rlq-step-indicator " data-step="8">
                                    <div class="rlq-step-icon"><i class="fas fa-check"></i></div>
                                </div>

                                <div class="rlq-step-indicator " data-step="9">
                                    <div class="rlq-step-icon"><i class="fas fa-check"></i></div>
                                </div>

                                <div class="rlq-step-indicator " data-step="10">
                                    <div class="rlq-step-icon"><i class="fas fa-check"></i></div>
                                </div>

                                <div class="rlq-step-indicator " data-step="11">
                                    <div class="rlq-step-icon"><i class="fas fa-check"></i></div>
                                </div>

                                <div class="rlq-step-indicator " data-step="12">
                                    <div class="rlq-step-icon"><i class="fas fa-check"></i></div>
                                </div>

                                <div class="rlq-step-indicator " data-step="13">
                                    <div class="rlq-step-icon"><i class="fas fa-check"></i></div>
                                </div>

                                <div class="rlq-step-indicator " data-step="14">
                                    <div class="rlq-step-icon"><i class="fas fa-check"></i></div>
                                </div>

                                <div class="rlq-step-indicator " data-step="15">
                                    <div class="rlq-step-icon"><i class="fas fa-check"></i></div>
                                </div>

                                <div class="rlq-step-indicator " data-step="16">
                                    <div class="rlq-step-icon"><i class="fas fa-check"></i></div>
                                </div>

                                <div class="rlq-step-indicator " data-step="17">
                                    <div class="rlq-step-icon"><i class="fas fa-check"></i></div>
                                </div>
                            </div>

                            <form id="rlq-multi-step-form" novalidate>

                                <div class="rlq-form-step" data-step="1">
                                    <h3>When were you born?</h3>
                                    <div class="rlq-form-row">
                                        <div class="rlq-form-group third-width">
                                            <select name="dob_month" id="dob_month" class="rlq-form-control" required data-error-msg="Please select a month.">
                                                <option value="">Month</option>
                                                <option value="01">01 - January</option>
                                                <option value="02">02 - February</option>
                                                <option value="03">03 - March</option>
                                                <option value="04">04 - April</option>
                                                <option value="05">05 - May</option>
                                                <option value="06">06 - June</option>
                                                <option value="07">07 - July</option>
                                                <option value="08">08 - August</option>
                                                <option value="09">09 - September</option>
                                                <option value="10">10 - October</option>
                                                <option value="11">11 - November</option>
                                                <option value="12">12 - December</option>
                                            </select>
                                        </div>
                                        <div class="rlq-form-group third-width">
                                            <select name="dob_day" id="dob_day" class="rlq-form-control" required data-error-msg="Please select a day.">
                                                <option value="">Day</option>
                                                <option value="01">01</option><option value="02">02</option><option value="03">03</option><option value="04">04</option><option value="05">05</option><option value="06">06</option><option value="07">07</option><option value="08">08</option><option value="09">09</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option><option value="30">30</option><option value="31">31</option>
                                            </select>
                                        </div>
                                        <div class="rlq-form-group third-width">
                                            <input type="text" name="dob_year" id="dob_year" class="rlq-form-control" placeholder="Year" maxlength="4" pattern="\d{4}" required data-error-msg="Please enter a valid year.">
                                        </div>
                                    </div>
                                    <div class="rlq-form-actions">
                                        <button type="button" class="rlq-btn rlq-prev-step" style="visibility:hidden;">Previous</button>
                                        <button type="button" class="rlq-btn rlq-next-step primary" disabled>Next</button>
                                    </div>

                                    <div class="educational-content mt-5">
                                        <span class="label">
                                            <div class="d-flex gap-2 flex-lg-row flex-column align-items-center educational-content-label-card">
                                                <img src="<?php echo plugin_dir_url(__DIR__) . 'assets/img/icons/question.svg'; ?>" alt="Question icon" style="width:16px;height:16px;max-width:100%" class="question-icon" loading="lazy">
                                                <div class="richtext w-100 text-left" style="color:#000000">
                                                    <p class="richtext-paragraph">Why We Ask</p>
                                                </div>
                                            </div>
                                        </span>
                                        <h3>About Your Age</h3>
                                        <span class="label">
                                            <p class="richtext-paragraph">
                                                Your age helps determine the right life insurance options for you. Life insurance is valuable 
                                                at any stage of life, offering peace of mind and security for your loved ones.
                                            </p>
                                        </span>
                                    </div>

                                </div>

                                <div class="rlq-form-step" data-step="2" style="display:none;">
                                    <h3>What is your gender?</h3>
                                    <div class="rlq-form-group rlq-radio-group-vertical">
                                        <label class="rlq-btn-checkbox"><input type="radio" name="gender" value="Male" required> <span class="btn-text">Male</span></label>
                                        <label class="rlq-btn-checkbox"><input type="radio" name="gender" value="Female" required> <span class="btn-text">Female</span></label>
                                    </div>
                                    <div class="rlq-form-actions">
                                        <button type="button" class="rlq-btn rlq-prev-step">Previous</button>
                                        <button type="button" class="rlq-btn rlq-next-step primary" disabled>Next</button>
                                    </div>

                                    <div class="educational-content mt-5">
                                        <span class="label">
                                            <div class="d-flex gap-2 flex-lg-row flex-column align-items-center educational-content-label-card">
                                                <img src="<?php echo plugin_dir_url(__DIR__) . 'assets/img/icons/question.svg'; ?>" alt="Question icon" style="width:16px;height:16px;max-width:100%" class="question-icon" loading="lazy">
                                                <div class="richtext w-100 text-left" style="color:#000000">
                                                    <p class="richtext-paragraph">Why We Ask</p>
                                                </div>
                                            </div>
                                        </span>
                                        <h3>About Your Gender</h3>
                                        <span class="label">
                                            <p class="richtext-paragraph">
                                                Gender can influence life expectancy and help us find life insurance policies better aligned with your needs.
                                            </p>
                                        </span>
                                    </div>

                                </div>

                                <div class="rlq-form-step" data-step="3" style="display:none;">
                                    <h3>How would you rate your overall health?</h3>
                                    <div class="rlq-form-group rlq-radio-group-vertical">
                                        <label class="rlq-btn-checkbox"><input type="radio" name="health_rating" value="Excellent" required> <span class="btn-text">Excellent</span></label>
                                        <label class="rlq-btn-checkbox"><input type="radio" name="health_rating" value="Above Average" required> <span class="btn-text">Above Average</span></label>
                                        <label class="rlq-btn-checkbox"><input type="radio" name="health_rating" value="Average" required> <span class="btn-text">Average</span></label>
                                        <label class="rlq-btn-checkbox"><input type="radio" name="health_rating" value="Below Average" required> <span class="btn-text">Below Average</span></label>
                                    </div>
                                    <div class="rlq-form-actions">
                                        <button type="button" class="rlq-btn rlq-prev-step">Previous</button>
                                        <button type="button" class="rlq-btn rlq-next-step primary" disabled>Next</button>
                                    </div>

                                    <div class="educational-content mt-5">
                                        <span class="label">
                                            <div class="d-flex gap-2 flex-lg-row flex-column align-items-center educational-content-label-card">
                                                <img src="<?php echo plugin_dir_url(__DIR__) . 'assets/img/icons/question.svg'; ?>" alt="Question icon" style="width:16px;height:16px;max-width:100%" class="question-icon" loading="lazy">
                                                <div class="richtext w-100 text-left" style="color:#000000">
                                                    <p class="richtext-paragraph">Why We Ask</p>
                                                </div>
                                            </div>
                                        </span>
                                        <h3>About Your Health</h3>
                                        <span class="label">
                                            <p class="richtext-paragraph">
                                                Regardless of your age and current health, we can help match you with policies and carriers that align with your needs.
                                            </p>
                                        </span>
                                    </div>

                                </div>

                                <div class="rlq-form-step" data-step="4" style="display:none;">
                                    <h3>What is your height and weight?</h3>
                                    <p style="font-size:14px; margin-bottom:10px;">Current Height</p>
                                    <div class="rlq-form-row">
                                        <div class="rlq-form-group half-width">
                                            <input type="number" name="height_ft" id="height_ft" class="rlq-form-control" placeholder="ft" min="4" max="7" required data-error-msg="Please enter a number between 4 and 7.">
                                            <div class="rlq-error-message text-danger" style="color:red; font-size:12px; display:none; margin-top:5px;"></div>
                                        </div>
                                        <div class="rlq-form-group half-width">
                                            <input type="number" name="height_in" id="height_in" class="rlq-form-control" placeholder="inches" min="0" max="11" required data-error-msg="Please enter a number between 0 and 11.">
                                            <div class="rlq-error-message text-danger" style="color:red; font-size:12px; display:none; margin-top:5px;"></div>
                                        </div>
                                    </div>
                                    <p style="font-size:14px; margin-bottom:10px; margin-top:20px;">Current Weight</p>
                                    <div class="rlq-form-group">
                                        <input type="number" name="weight_lbs" id="weight_lbs" class="rlq-form-control" placeholder="lbs" min="100" max="800" required data-error-msg="Please enter a number between 100-800 lbs.">
                                        <div class="rlq-error-message text-danger" style="color:red; font-size:12px; display:none; margin-top:5px;"></div>
                                    </div>
                                    <div class="rlq-form-actions">
                                        <button type="button" class="rlq-btn rlq-prev-step">Previous</button>
                                        <button type="button" class="rlq-btn rlq-next-step primary" disabled>Next</button>
                                    </div>

                                    <div class="educational-content mt-5">
                                        <span class="label">
                                            <div class="d-flex gap-2 flex-lg-row flex-column align-items-center educational-content-label-card">
                                                <img src="<?php echo plugin_dir_url(__DIR__) . 'assets/img/icons/question.svg'; ?>" alt="Question icon" style="width:16px;height:16px;max-width:100%" class="question-icon" loading="lazy">
                                                <div class="richtext w-100 text-left" style="color:#000000">
                                                    <p class="richtext-paragraph">Why We Ask</p>
                                                </div>
                                            </div>
                                        </span>
                                        <h3>About Your Height and Weight</h3>
                                        <span class="label">
                                            <p class="richtext-paragraph">
                                                Your height and weight help us better understand your health profile so we can recommend the most suitable coverage options. 
                                                Even if you aren't in perfect health, we can help find coverage that works for you.
                                            </p>
                                        </span>
                                    </div>

                                </div>

                                <div class="rlq-form-step" data-step="5" style="display:none;">
                                    <h3>Where do you live?</h3>
                                    <div class="rlq-form-group">
                                        <label>Zip</label>
                                        <input type="text" name="zip_code_initial" id="zip_code_initial" class="rlq-form-control" placeholder="Enter here" maxlength="5" pattern="\d{5}" required>
                                    </div>
                                    <div class="rlq-form-group">
                                        <label>State</label>
                                        <input type="text" name="state_initial" id="state_initial" class="rlq-form-control readonly-input" readonly>
                                    </div>
                                    <div class="rlq-form-actions">
                                        <button type="button" class="rlq-btn rlq-prev-step">Previous</button>
                                        <button type="button" class="rlq-btn rlq-next-step primary" disabled>Next</button>
                                    </div>

                                    <div class="educational-content mt-5">
                                        <span class="label">
                                            <div class="d-flex gap-2 flex-lg-row flex-column align-items-center educational-content-label-card">
                                                <img src="<?php echo plugin_dir_url(__DIR__) . 'assets/img/icons/question.svg'; ?>" alt="Question icon" style="width:16px;height:16px;max-width:100%" class="question-icon" loading="lazy">
                                                <div class="richtext w-100 text-left" style="color:#000000">
                                                    <p class="richtext-paragraph">Why We Ask</p>
                                                </div>
                                            </div>
                                        </span>
                                        <h3>About Your Location</h3>
                                        <span class="label">
                                            <p class="richtext-paragraph">
                                                Where you live helps us determine the life insurance products available in your state.
                                            </p>
                                        </span>
                                    </div>

                                </div>

                                <div class="rlq-form-step" data-step="6" style="display:none;">
                                    <h3>Do you have life insurance now?</h3>
                                    <div class="rlq-form-group rlq-radio-group-vertical">
                                        <label class="rlq-btn-checkbox"><input type="radio" name="has_insurance" value="Yes" required id="has_insurance_yes"> <span class="btn-text">Yes</span></label>
                                        <label class="rlq-btn-checkbox"><input type="radio" name="has_insurance" value="No" required id="has_insurance_no"> <span class="btn-text">No</span></label>
                                    </div>
                                    
                                    <div class="rlq-conditional-field" id="current_coverage_container" style="display:none; margin-top:20px;">
                                        <label>Current Coverage Amount</label>
                                        <input type="number" name="current_coverage_amount" id="current_coverage_amount" class="rlq-form-control" placeholder="Coverage Amount" data-error-msg="Please enter your current coverage amount.">
                                        <div class="rlq-error-message text-danger" style="color:red; font-size:12px; display:none; margin-top:5px;"></div>
                                    </div>
                                    
                                    <div class="rlq-form-actions">
                                        <button type="button" class="rlq-btn rlq-prev-step">Previous</button>
                                        <button type="button" class="rlq-btn rlq-next-step primary" disabled>Next</button>
                                    </div>

                                    <div class="educational-content mt-5">
                                        <span class="label">
                                            <div class="d-flex gap-2 flex-lg-row flex-column align-items-center educational-content-label-card">
                                                <img src="<?php echo plugin_dir_url(__DIR__) . 'assets/img/icons/question.svg'; ?>" alt="Question icon" style="width:16px;height:16px;max-width:100%" class="question-icon" loading="lazy">
                                                <div class="richtext w-100 text-left" style="color:#000000">
                                                    <p class="richtext-paragraph">Why We Ask</p>
                                                </div>
                                            </div>
                                        </span>
                                        <h3>About Your Current Coverage</h3>
                                        <span class="label">
                                            <p class="richtext-paragraph">
                                                Understanding your current coverage helps us determine any gaps and provide life insurance options that 
                                                complement or enhance your existing coverage.
                                            </p>
                                        </span>
                                    </div>

                                </div>

                                <div class="rlq-form-step" data-step="7" style="display:none;">
                                    <h3>What type of insurance are you looking for? Check all that apply. (Optional)</h3>
                                    <div class="rlq-form-group rlq-checkbox-group-vertical">
                                        <label class="rlq-btn-checkbox"><input type="checkbox" name="insurance_type[]" value="Term"> <span class="btn-text">Term</span></label>
                                        <label class="rlq-btn-checkbox"><input type="checkbox" name="insurance_type[]" value="Permanent"> <span class="btn-text">Permanent</span></label>
                                        <label class="rlq-btn-checkbox"><input type="checkbox" name="insurance_type[]" value="Final Expense"> <span class="btn-text">Final Expense</span></label>
                                        <label class="rlq-btn-checkbox"><input type="checkbox" name="insurance_type[]" value="I'm not sure"> <span class="btn-text">I'm not sure</span></label>
                                    </div>
                                    <div class="rlq-form-actions">
                                        <button type="button" class="rlq-btn rlq-prev-step">Previous</button>
                                        <button type="button" class="rlq-btn rlq-next-step primary">Next</button>
                                    </div>

                                    <div class="educational-content mt-5">
                                        <span class="label">
                                            <div class="d-flex gap-2 flex-lg-row flex-column align-items-center educational-content-label-card">
                                                <img src="<?php echo plugin_dir_url(__DIR__) . 'assets/img/icons/question.svg'; ?>" alt="Question icon" style="width:16px;height:16px;max-width:100%" class="question-icon" loading="lazy">
                                                <div class="richtext w-100 text-left" style="color:#000000">
                                                    <p class="richtext-paragraph">Why We Ask</p>
                                                </div>
                                            </div>
                                        </span>
                                        <h3>About the Type of Life Insurance</h3>
                                        <span class="label">
                                            <p class="richtext-paragraph">
                                                The type of life insurance you’re interested in helps us match you with the best available options 
                                                from the insurance carriers we partner with.
                                            </p>
                                        </span>
                                    </div>

                                </div>

                                <div class="rlq-form-step" data-step="8" style="display:none;">
                                    <h3>What is your individual annual income from salary and wages?</h3>
                                    <div class="rlq-grid-3">
                                        <label class="rlq-btn-checkbox"><input type="radio" name="annual_income" value="Less than $50,000" required> <span class="btn-text">Less than<br>$50,000</span></label>
                                        <label class="rlq-btn-checkbox"><input type="radio" name="annual_income" value="$50,000 - $99,999" required> <span class="btn-text">$50,000<br>$99,999</span></label>
                                        <label class="rlq-btn-checkbox"><input type="radio" name="annual_income" value="$100,000 - $149,999" required> <span class="btn-text">$100,000<br>$149,999</span></label>
                                        <label class="rlq-btn-checkbox"><input type="radio" name="annual_income" value="$150,000 - $199,999" required> <span class="btn-text">$150,000<br>$199,999</span></label>
                                        <label class="rlq-btn-checkbox"><input type="radio" name="annual_income" value="$200,000 - $249,999" required> <span class="btn-text">$200,000<br>$249,999</span></label>
                                        <label class="rlq-btn-checkbox"><input type="radio" name="annual_income" value="$250,000 - $299,999" required> <span class="btn-text">$250,000<br>$299,999</span></label>
                                        <label class="rlq-btn-checkbox"><input type="radio" name="annual_income" value="$300,000 - $399,999" required> <span class="btn-text">$300,000<br>$399,999</span></label>
                                        <label class="rlq-btn-checkbox"><input type="radio" name="annual_income" value="$400,000 - $499,999" required> <span class="btn-text">$400,000<br>$499,999</span></label>
                                        <label class="rlq-btn-checkbox"><input type="radio" name="annual_income" value="Over $500,000" required> <span class="btn-text">Over<br>$500,000</span></label>
                                    </div>
                                    <div class="rlq-form-actions">
                                        <button type="button" class="rlq-btn rlq-prev-step">Previous</button>
                                        <button type="button" class="rlq-btn rlq-next-step primary" disabled>Next</button>
                                    </div>

                                    <div class="educational-content mt-5">
                                        <span class="label">
                                            <div class="d-flex gap-2 flex-lg-row flex-column align-items-center educational-content-label-card">
                                                <img src="<?php echo plugin_dir_url(__DIR__) . 'assets/img/icons/question.svg'; ?>" alt="Question icon" style="width:16px;height:16px;max-width:100%" class="question-icon" loading="lazy">
                                                <div class="richtext w-100 text-left" style="color:#000000">
                                                    <p class="richtext-paragraph">Why We Ask</p>
                                                </div>
                                            </div>
                                        </span>
                                        <h3>About Your Income</h3>
                                        <span class="label">
                                            <p class="richtext-paragraph">
                                                <b>This is the total amount you earn per year based on wages and salary before taxes.</b> Bonuses, commissions, freelance earnings, 
                                                or other variable pay should be factored in to reflect actual annual income. However, 
                                                this should not include any income from investments or retirement accounts.
                                            </p>
                                        </span>
                                    </div>

                                </div>

                                <div class="rlq-form-step" data-step="9" style="display:none;">
                                    <h3>How much coverage are you looking for?</h3>
                                    <div class="rlq-form-group">
                                        <label>Amount of coverage</label>
                                        <select name="target_coverage_amount" class="rlq-form-control" required>
                                            <option value="">Please select</option>
                                            <option value="$0 - $49,999">$0 - $49,999</option>
                                            <option value="$50,000 - $99,999">$50,000 - $99,999</option>
                                            <option value="$100,000 - $199,999">$100,000 - $199,999</option>
                                            <option value="$200,000 - $299,999">$200,000 - $299,999</option>
                                            <option value="$300,000 - $399,999">$300,000 - $399,999</option>
                                            <option value="$400,000 - $499,999">$400,000 - $499,999</option>
                                            <option value="$500,000 - $599,999">$500,000 - $599,999</option>
                                            <option value="$600,000 - $699,999">$600,000 - $699,999</option>
                                            <option value="$700,000 - $799,999">$700,000 - $799,999</option>
                                            <option value="$800,000 - $899,999">$800,000 - $899,999</option>
                                            <option value="$900,000 - $999,999">$900,000 - $999,999</option>
                                            <option value="$1,000,000 - $1,499,999">$1,000,000 - $1,499,999</option>
                                            <option value="$1,500,000 - $1,999,999">$1,500,000 - $1,999,999</option>
                                            <option value="$2,000,000 - $4,999,999">$2,000,000 - $4,999,999</option>
                                            <option value="$5,000,000 or greater">$5,000,000 or greater</option>
                                        </select>
                                    </div>
                                    <div class="rlq-form-group">
                                        <label>Term Length</label>
                                        <select name="term_length" class="rlq-form-control" required>
                                            <option value="">Please select</option>
                                            <option value="10 Years">10 Years</option>
                                            <option value="15 Years">15 Years</option>
                                            <option value="20 Years">20 Years</option>
                                            <option value="30 Years">30 Years</option>
                                        </select>
                                    </div>
                                    <div class="rlq-form-actions">
                                        <button type="button" class="rlq-btn rlq-prev-step">Previous</button>
                                        <button type="button" class="rlq-btn rlq-next-step primary" disabled>Next</button>
                                    </div>

                                    <div class="educational-content mt-5">
                                        <span class="label">
                                            <div class="d-flex gap-2 flex-lg-row flex-column align-items-center educational-content-label-card">
                                                <img src="<?php echo plugin_dir_url(__DIR__) . 'assets/img/icons/star.svg'; ?>" alt="Question icon" style="width:16px;height:16px;max-width:100%" class="question-icon" loading="lazy">
                                                <div class="richtext w-100 text-left" style="color:#000000">
                                                    <p class="richtext-paragraph">Recommended</p>
                                                </div>
                                            </div>
                                        </span>
                                        <h3>At Least 10x Your Annual Income</h3>
                                        <span class="label">
                                            <p class="richtext-paragraph">
                                                To help ensure your loved ones are financially protected, we recommend choosing a coverage amount that 
                                                provides long-term financial security.
                                            </p>
                                        </span>
                                    </div>

                                </div>

                                <div class="rlq-form-step" data-step="10" style="display:none;">
                                    <h3>Do you currently smoke cigarettes or e-cigarettes?</h3>
                                    <div class="rlq-form-group rlq-radio-group-vertical">
                                        <label class="rlq-btn-checkbox"><input type="radio" name="smoker" value="Yes" required> <span class="btn-text">Yes</span></label>
                                        <label class="rlq-btn-checkbox"><input type="radio" name="smoker" value="No" required> <span class="btn-text">No</span></label>
                                    </div>
                                    <div class="rlq-form-actions">
                                        <button type="button" class="rlq-btn rlq-prev-step">Previous</button>
                                        <button type="button" class="rlq-btn rlq-next-step primary" disabled>Next</button>
                                    </div>

                                    <div class="educational-content mt-5">
                                        <span class="label">
                                            <div class="d-flex gap-2 flex-lg-row flex-column align-items-center educational-content-label-card">
                                                <img src="<?php echo plugin_dir_url(__DIR__) . 'assets/img/icons/question.svg'; ?>" alt="Question icon" style="width:16px;height:16px;max-width:100%" class="question-icon" loading="lazy">
                                                <div class="richtext w-100 text-left" style="color:#000000">
                                                    <p class="richtext-paragraph">Why We Ask</p>
                                                </div>
                                            </div>
                                        </span>
                                        <h3>About Your Smoking Habits</h3>
                                        <span class="label">
                                            <p class="richtext-paragraph">
                                                Honesty about smoking and tobacco habits ensures the quotes you receive are as accurate as possible. We work with multiple 
                                                insurance carriers that can help find affordable rates, even for smokers.
                                            </p>
                                        </span>
                                    </div>

                                </div>

                                <div class="rlq-form-step" data-step="11" style="display:none;">
                                    <h3>Check all conditions for which you've been treated:</h3>
                                    <div class="rlq-grid-3 rlq-conditions-grid">
                                        <label class="rlq-btn-checkbox block-checkbox">
                                            <input type="checkbox" name="conditions[]" value="Alcohol or Substance Abuse">
                                            <img src="<?php echo plugin_dir_url(__DIR__) . 'assets/img/icons/alcohol.svg'; ?>" onerror="this.src='https://placehold.co/40x40/f0f0f0/666?text=Alcoh'" alt="Icon">
                                            <span class="btn-text">Alcohol or Substance Abuse</span>
                                        </label>
                                        <label class="rlq-btn-checkbox block-checkbox">
                                            <input type="checkbox" name="conditions[]" value="Asthma">
                                            <img src="<?php echo plugin_dir_url(__DIR__) . 'assets/img/icons/asthma.svg'; ?>" onerror="this.src='https://placehold.co/40x40/f0f0f0/666?text=Asthm'" alt="Icon">
                                            <span class="btn-text">Asthma</span>
                                        </label>
                                        <label class="rlq-btn-checkbox block-checkbox">
                                            <input type="checkbox" name="conditions[]" value="Blood Pressure">
                                            <img src="<?php echo plugin_dir_url(__DIR__) . 'assets/img/icons/bloodpressure.svg'; ?>" onerror="this.src='https://placehold.co/40x40/f0f0f0/666?text=Blood'" alt="Icon">
                                            <span class="btn-text">Blood Pressure</span>
                                        </label>
                                        <label class="rlq-btn-checkbox block-checkbox">
                                            <input type="checkbox" name="conditions[]" value="Cancer">
                                            <img src="<?php echo plugin_dir_url(__DIR__) . 'assets/img/icons/cancer.svg'; ?>" onerror="this.src='https://placehold.co/40x40/f0f0f0/666?text=Cance'" alt="Icon">
                                            <span class="btn-text">Cancer</span>
                                        </label>
                                        <label class="rlq-btn-checkbox block-checkbox">
                                            <input type="checkbox" name="conditions[]" value="Cholesterol">
                                            <img src="<?php echo plugin_dir_url(__DIR__) . 'assets/img/icons/cholesterol.svg'; ?>" onerror="this.src='https://placehold.co/40x40/f0f0f0/666?text=Choles'" alt="Icon">
                                            <span class="btn-text">Cholesterol</span>
                                        </label>
                                        <label class="rlq-btn-checkbox block-checkbox">
                                            <input type="checkbox" name="conditions[]" value="Depression or Anxiety">
                                            <img src="<?php echo plugin_dir_url(__DIR__) . 'assets/img/icons/depression.svg'; ?>" onerror="this.src='https://placehold.co/40x40/f0f0f0/666?text=Depre'" alt="Icon">
                                            <span class="btn-text">Depression or Anxiety</span>
                                        </label>
                                        <label class="rlq-btn-checkbox block-checkbox">
                                            <input type="checkbox" name="conditions[]" value="Diabetes">
                                            <img src="<?php echo plugin_dir_url(__DIR__) . 'assets/img/icons/diabetes.svg'; ?>" onerror="this.src='https://placehold.co/40x40/f0f0f0/666?text=Diabe'" alt="Icon">
                                            <span class="btn-text">Diabetes</span>
                                        </label>
                                        <label class="rlq-btn-checkbox block-checkbox">
                                            <input type="checkbox" name="conditions[]" value="Heart issue">
                                            <img src="<?php echo plugin_dir_url(__DIR__) . 'assets/img/icons/heartissue.svg'; ?>" onerror="this.src='https://placehold.co/40x40/f0f0f0/666?text=Heart'" alt="Icon">
                                            <span class="btn-text">Heart issue</span>
                                        </label>
                                        <label class="rlq-btn-checkbox block-checkbox">
                                            <input type="checkbox" name="conditions[]" value="Sleep Apnea">
                                            <img src="<?php echo plugin_dir_url(__DIR__) . 'assets/img/icons/sleepapnea.svg'; ?>" onerror="this.src='https://placehold.co/40x40/f0f0f0/666?text=Apnea'" alt="Icon">
                                            <span class="btn-text">Sleep Apnea</span>
                                        </label>
                                        <label class="rlq-btn-checkbox block-checkbox none-of-these">
                                            <input type="checkbox" name="conditions[]" value="None of these" class="none-of-these-cb">
                                            <img src="<?php echo plugin_dir_url(__DIR__) . 'assets/img/icons/none-of-these.svg'; ?>" onerror="this.src='https://placehold.co/40x40/f0f0f0/666?text=None'" alt="Icon">
                                            <span class="btn-text">None of these</span>
                                        </label>
                                    </div>
                                    <div class="rlq-form-actions">
                                        <button type="button" class="rlq-btn rlq-prev-step">Previous</button>
                                        <button type="button" class="rlq-btn rlq-next-step primary" disabled>Next</button>
                                    </div>

                                    <div class="educational-content mt-5">
                                        <span class="label">
                                            <div class="d-flex gap-2 flex-lg-row flex-column align-items-center educational-content-label-card">
                                                <img src="<?php echo plugin_dir_url(__DIR__) . 'assets/img/icons/question.svg'; ?>" alt="Question icon" style="width:16px;height:16px;max-width:100%" class="question-icon" loading="lazy">
                                                <div class="richtext w-100 text-left" style="color:#000000">
                                                    <p class="richtext-paragraph">Why We Ask</p>
                                                </div>
                                            </div>
                                        </span>
                                        <h3>About Your Medical History</h3>
                                        <span class="label">
                                            <p class="richtext-paragraph">
                                                Your medical history helps us match you with quotes that consider your health history. We work with multiple insurance carriers 
                                                that can help find affordable rates, even for those with health concerns.
                                            </p>
                                        </span>
                                    </div>

                                </div>

                                <div class="rlq-form-step" data-step="12" style="display:none;">
                                    <h3>Have you had more than 3 driving violations in the past 3 years?</h3>
                                    <div class="rlq-form-group rlq-radio-group-vertical">
                                        <label class="rlq-btn-checkbox"><input type="radio" name="driving_violations" value="Yes" required> <span class="btn-text">Yes</span></label>
                                        <label class="rlq-btn-checkbox"><input type="radio" name="driving_violations" value="No" required> <span class="btn-text">No</span></label>
                                    </div>
                                    <div class="rlq-form-actions">
                                        <button type="button" class="rlq-btn rlq-prev-step">Previous</button>
                                        <button type="button" class="rlq-btn rlq-next-step primary" disabled>Next</button>
                                    </div>

                                    <div class="educational-content mt-5">
                                        <span class="label">
                                            <div class="d-flex gap-2 flex-lg-row flex-column align-items-center educational-content-label-card">
                                                <img src="<?php echo plugin_dir_url(__DIR__) . 'assets/img/icons/question.svg'; ?>" alt="Question icon" style="width:16px;height:16px;max-width:100%" class="question-icon" loading="lazy">
                                                <div class="richtext w-100 text-left" style="color:#000000">
                                                    <p class="richtext-paragraph">Why We Ask</p>
                                                </div>
                                            </div>
                                        </span>
                                        <h3>About Your Driving Record</h3>
                                        <span class="label">
                                            <p class="richtext-paragraph">
                                                Your driving record helps assess risk and find coverage suitable for you. We can help you find the right coverage, 
                                                even if your record isn’t perfect.
                                            </p>
                                        </span>
                                    </div>

                                </div>

                                <div class="rlq-form-step" data-step="13" style="display:none;">
                                    <h3>Do you currently engage in any of these sports or activities?</h3>
                                    <p style="font-size:14px; margin-bottom:15px;">Piloting aircraft, Bungee jumping, Mountain & rock climbing, Hang gliding, Scuba diving, Skydiving</p>
                                    <div class="rlq-form-group rlq-radio-group-vertical">
                                        <label class="rlq-btn-checkbox"><input type="radio" name="dangerous_activities" value="Yes" required> <span class="btn-text">Yes</span></label>
                                        <label class="rlq-btn-checkbox"><input type="radio" name="dangerous_activities" value="No" required> <span class="btn-text">No</span></label>
                                    </div>
                                    <div class="rlq-form-actions">
                                        <button type="button" class="rlq-btn rlq-prev-step">Previous</button>
                                        <button type="button" class="rlq-btn rlq-next-step primary" disabled>Next</button>
                                    </div>

                                    <div class="educational-content mt-5">
                                        <span class="label">
                                            <div class="d-flex gap-2 flex-lg-row flex-column align-items-center educational-content-label-card">
                                                <img src="<?php echo plugin_dir_url(__DIR__) . 'assets/img/icons/question.svg'; ?>" alt="Question icon" style="width:16px;height:16px;max-width:100%" class="question-icon" loading="lazy">
                                                <div class="richtext w-100 text-left" style="color:#000000">
                                                    <p class="richtext-paragraph">Why We Ask</p>
                                                </div>
                                            </div>
                                        </span>
                                        <h3>About High-Risk Activities</h3>
                                        <span class="label">
                                            <p class="richtext-paragraph">
                                                Engaging in high-risk activities means it’s even more important to have the right coverage. 
                                                We’ll ensure you’re fully protected, no matter your lifestyle.
                                            </p>
                                        </span>
                                    </div>

                                </div>

                                <div class="rlq-form-step" data-step="14" style="display:none;">
                                    <h3>Did your parents or siblings have heart disease, cancer, stroke, or diabetes before age 65?</h3>
                                    <div class="rlq-form-group rlq-radio-group-vertical">
                                        <label class="rlq-btn-checkbox"><input type="radio" name="family_history" value="Yes" required> <span class="btn-text">Yes</span></label>
                                        <label class="rlq-btn-checkbox"><input type="radio" name="family_history" value="No" required> <span class="btn-text">No</span></label>
                                    </div>
                                    <div class="rlq-form-actions">
                                        <button type="button" class="rlq-btn rlq-prev-step">Previous</button>
                                        <button type="button" class="rlq-btn rlq-next-step primary" disabled>Next</button>
                                    </div>

                                    <div class="educational-content mt-5">
                                        <span class="label">
                                            <div class="d-flex gap-2 flex-lg-row flex-column align-items-center educational-content-label-card">
                                                <img src="<?php echo plugin_dir_url(__DIR__) . 'assets/img/icons/question.svg'; ?>" alt="Question icon" style="width:16px;height:16px;max-width:100%" class="question-icon" loading="lazy">
                                                <div class="richtext w-100 text-left" style="color:#000000">
                                                    <p class="richtext-paragraph">Why We Ask</p>
                                                </div>
                                            </div>
                                        </span>
                                        <h3>About Your Family Medical History</h3>
                                        <span class="label">
                                            <p class="richtext-paragraph">
                                                Family health history helps us understand your potential health risks, allowing us to recommend policies 
                                                that are right for you.
                                            </p>
                                        </span>
                                    </div>

                                </div>

                                <div class="rlq-form-step" data-step="15" style="display:none;">
                                    <h3>Who are we preparing this quote for?</h3>
                                    <div class="rlq-form-row">
                                        <div class="rlq-form-group half-width">
                                            <input type="text" name="first_name" id="first_name" class="rlq-form-control" placeholder="First name" required>
                                        </div>
                                        <div class="rlq-form-group half-width">
                                            <input type="text" name="last_name" id="last_name" class="rlq-form-control" placeholder="Last name" required>
                                        </div>
                                    </div>
                                    <div class="rlq-form-group">
                                        <input type="email" name="user_email" id="user_email" class="rlq-form-control" placeholder="Email" required>
                                    </div>
                                    <div class="rlq-form-group">
                                        <input type="tel" name="user_phone" id="user_phone" class="rlq-form-control phone-mask" placeholder="(000) 000-0000" pattern="\(\d{3}\)\s?\d{3}-\d{4}" required>
                                    </div>
                                    <div class="rlq-form-actions">
                                        <button type="button" class="rlq-btn rlq-prev-step">Previous</button>
                                        <button type="button" class="rlq-btn rlq-next-step primary" disabled>Next</button>
                                    </div>

                                    <div class="educational-content mt-5">
                                        <span class="label">
                                            <div class="d-flex gap-2 flex-lg-row flex-column align-items-center educational-content-label-card">
                                                <img src="<?php echo plugin_dir_url(__DIR__) . 'assets/img/icons/question.svg'; ?>" alt="Question icon" style="width:16px;height:16px;max-width:100%" class="question-icon" loading="lazy">
                                                <div class="richtext w-100 text-left" style="color:#000000">
                                                    <p class="richtext-paragraph">Why We Ask</p>
                                                </div>
                                            </div>
                                        </span>
                                        <h3>About Your Contact Information</h3>
                                        <span class="label">
                                            <p class="richtext-paragraph">
                                                Your name and email allow us to send you information about your quote. This email will also be used for your policy, 
                                                should you decide to move forward.
                                            </p>
                                        </span>
                                    </div>

                                </div>

                                <div class="rlq-form-step" data-step="16" style="display:none;">
                                    <h3>Where do you live?</h3>
                                    <div class="rlq-form-group">
                                        <input type="text" name="address" id="address" class="rlq-form-control" placeholder="Address" required>
                                    </div>
                                    <div class="rlq-form-group">
                                        <input type="text" name="city" id="city" class="rlq-form-control" placeholder="City" required>
                                    </div>
                                    <div class="rlq-form-row">
                                        <div class="rlq-form-group half-width">
                                            <input type="text" name="state" id="state" class="rlq-form-control" placeholder="State" required>
                                        </div>
                                        <div class="rlq-form-group half-width">
                                            <input type="text" name="zip_code" id="zip_code" class="rlq-form-control" placeholder="ZIP" required>
                                        </div>
                                    </div>
                                    <div class="rlq-form-actions">
                                        <button type="button" class="rlq-btn rlq-prev-step">Previous</button>
                                        <button type="button" class="rlq-btn rlq-submit-btn primary" disabled>Get My Quote</button>
                                    </div>

                                    <div class="educational-content mt-5">
                                        <span class="label">
                                            <div class="d-flex gap-2 flex-lg-row flex-column align-items-center educational-content-label-card">
                                                <img src="<?php echo plugin_dir_url(__DIR__) . 'assets/img/icons/question.svg'; ?>" alt="Question icon" style="width:16px;height:16px;max-width:100%" class="question-icon" loading="lazy">
                                                <div class="richtext w-100 text-left" style="color:#000000">
                                                    <p class="richtext-paragraph">Why We Ask</p>
                                                </div>
                                            </div>
                                        </span>
                                        <h3>About Your Address</h3>
                                        <span class="label">
                                            <p class="richtext-paragraph">
                                                Your address helps us complete your application and may influence your premium. We ensure this 
                                                information is used to get you the best coverage available.
                                            </p>
                                        </span>
                                    </div>

                                </div>

                                <div class="rlq-form-step" data-step="17" style="display:none; text-align:center;">
                                    <h3 style="color:#2ecc71;">A RiseLifeQuotes Agent will be in touch soon.</h3>
                                    <p>A RiseLifeQuotes licensed insurance agent is reviewing your request and will be in touch as early as possible to discuss your insurance review.</p>
                                    
                                    <div class="rlq-cards-container" style="margin-top:30px; display:flex; gap:20px;">
                                        <div class="rlq-final-card" style="border:1px solid #ddd; padding:20px; border-radius:8px; background:#f9f9f9; flex:1;">
                                            <img src="<?php echo plugin_dir_url(__DIR__) . 'assets/img/icons/phone.svg'; ?>" alt="Phone icon" class="img-step17" loading="lazy">
                                            <h4>Accelerate Your Application</h4>
                                            <p>Get personalized assistance from one of our licensed agents.</p>
                                            <h3 style="margin-top:10px; color:#3498db;"><a href="tel:1-111-111-1111" style="text-decoration:none; color:inherit;">Call 1-111-111-1111</a></h3>
                                        </div>
                                        
                                        <div class="rlq-final-card" style="border:1px solid #ddd; padding:20px; border-radius:8px; background:#f9f9f9; flex:1;">
                                            <img src="<?php echo plugin_dir_url(__DIR__) . 'assets/img/icons/chat.svg'; ?>" alt="Chat icon" class="img-step17" loading="lazy">
                                            <h4>Prefer to Chat with a Specialist?</h4>
                                            <p>Connect with a live Chat Specialist to confirm your quote.</p>
                                            <a href="/contact" class="rlq-btn primary" style="margin-top:15px; width:auto; display:inline-block; padding:10px 20px; text-decoration:none;">Click to chat with a Specialist</a>
                                        </div>
                                    </div>
                                    
                                    <div style="margin-top:30px; padding-top:20px; border-top:1px solid #eee;">
                                        <p>Confirmation email was sent to: <strong id="display_email">email@gmail.com</strong></p>
                                        <p style="margin-top:15px;"><a href="javascript:location.reload();">Click here</a> to start a new quote for someone else over the age of 18.</p>
                                        <p style="margin-top:10px;"><a href="/">Return to Home</a></p>
                                    </div>
                                </div>
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
