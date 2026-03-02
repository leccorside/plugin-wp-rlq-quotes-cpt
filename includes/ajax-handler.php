<?php
/**
 * AJAX Handler for RLQ Quotes form submission
 */

// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

function rlq_submit_quote_form() {
    // Verify nonce if you want to be extra secure, but public forms often skip strict nonce 
    // or rely on a simple one. For now, we sanitize strictly.
    
    // Retrieve Recipient Email
    $to = get_option('rlq_quotes_recipient_email', 'leccorside@gmail.com');
    if (empty($to)) {
        $to = 'leccorside@gmail.com';
    }

    // Collect and sanitize form data
    $first_name = sanitize_text_field($_POST['first_name'] ?? '');
    $last_name = sanitize_text_field($_POST['last_name'] ?? '');
    $email = sanitize_email($_POST['user_email'] ?? '');
    $phone = sanitize_text_field($_POST['user_phone'] ?? '');
    
    // Step 1
    $dob_month = sanitize_text_field($_POST['dob_month'] ?? '');
    $dob_day = sanitize_text_field($_POST['dob_day'] ?? '');
    $dob_year = sanitize_text_field($_POST['dob_year'] ?? '');
    $dob = "$dob_month/$dob_day/$dob_year";

    // Step 2-4
    $gender = sanitize_text_field($_POST['gender'] ?? '');
    $health_rating = sanitize_text_field($_POST['health_rating'] ?? '');
    $height = sanitize_text_field($_POST['height_ft'] ?? '') . "' " . sanitize_text_field($_POST['height_in'] ?? '') . "\"";
    $weight = sanitize_text_field($_POST['weight_lbs'] ?? '') . " lbs";

    // Step 5
    $zip_initial = sanitize_text_field($_POST['zip_code_initial'] ?? '');
    $state_initial = sanitize_text_field($_POST['state_initial'] ?? '');

    // Step 6
    $has_insurance = sanitize_text_field($_POST['has_insurance'] ?? '');
    $current_coverage = sanitize_text_field($_POST['current_coverage_amount'] ?? 'N/A');

    // Step 7 (Array)
    $insurance_type = isset($_POST['insurance_type']) && is_array($_POST['insurance_type']) ? array_map('sanitize_text_field', $_POST['insurance_type']) : [];
    $insurance_type_str = !empty($insurance_type) ? implode(', ', $insurance_type) : 'None';

    // Step 8-10
    $annual_income = sanitize_text_field($_POST['annual_income'] ?? '');
    $target_coverage = sanitize_text_field($_POST['target_coverage_amount'] ?? '');
    $term_length = sanitize_text_field($_POST['term_length'] ?? '');
    $smoker = sanitize_text_field($_POST['smoker'] ?? '');

    // Step 11 (Array)
    $conditions = isset($_POST['conditions']) && is_array($_POST['conditions']) ? array_map('sanitize_text_field', $_POST['conditions']) : [];
    $conditions_str = !empty($conditions) ? implode(', ', $conditions) : 'None';

    // Step 12-14
    $driving_violations = sanitize_text_field($_POST['driving_violations'] ?? '');
    $dangerous_activities = sanitize_text_field($_POST['dangerous_activities'] ?? '');
    $family_history = sanitize_text_field($_POST['family_history'] ?? '');

    // Step 16 (Address)
    $address = sanitize_text_field($_POST['address'] ?? '');
    $city = sanitize_text_field($_POST['city'] ?? '');
    $state = sanitize_text_field($_POST['state'] ?? '');
    $zip = sanitize_text_field($_POST['zip_code'] ?? '');

    // Build Email Body
    $page_title = isset($_POST['page_title']) ? sanitize_text_field(wp_unslash($_POST['page_title'])) : 'RiseLifeQuotes';
    $subject = "New Quote Request - $page_title";
    
    // Check if site has a valid server name for the From email
    $domain = 'leccorside.com.br';
    $from_email = "contato@leccorside.com.br";
    $site_name = get_bloginfo('name') ?: 'RiseLifeQuotes';
    
    $logo_url = plugin_dir_url(__DIR__) . 'assets/img/logo-riselifequotes.png';
    $current_domain = 'https://leccorside.com.br/riselifequotes'; // Fallback domain
    if (isset($_SERVER['HTTP_HOST'])) {
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        $current_domain = $protocol . $_SERVER['HTTP_HOST'];
    }
    
    // Ensure the logo URL is absolute for email clients
    if (strpos($logo_url, 'http') === false) {
        $logo_url = $current_domain . '/' . ltrim($logo_url, '/');
    }

    // Map existing variables to new names used in the email template
    $existing_insurance = $has_insurance;
    $coverage_amount = $target_coverage;
    $income = $annual_income;
    $insurance_type_for_email = $insurance_type_str; // Renamed to avoid conflict with array variable
    $conditions_for_email = $conditions_str; // Renamed to avoid conflict with array variable
    
    $message = '<div style="font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; color: #333;">';
    
    // Logo Row
    $message .= '<div style="text-align: center; margin-bottom: 20px;">';
    $message .= '<img src="' . esc_url($logo_url) . '" alt="RiseLifeQuotes Logo" style="max-width: 200px; height: auto;">';
    $message .= '</div>';
    
    $message .= '<h2 style="text-align: center; color: #2c3e50; margin-bottom: 30px;">' . esc_html($subject) . '</h2>';
    
    // Data Card
    $message .= '<div style="background-color: #f0f4f9; border-radius: 8px; padding: 25px; border: 1px solid #e1e8f0;">';
    
    $row_style = 'border-bottom: 1px solid #d0d7e0; padding-bottom: 12px; margin-bottom: 12px;';
    $last_row_style = 'padding-bottom: 12px; margin-bottom: 0;';
    $heading_style = 'color: #2c3e50; margin-top: 25px; margin-bottom: 15px; font-size: 18px; border-bottom: 2px solid #3498db; padding-bottom: 5px;';
    
    // Personal Details
    $message .= '<h3 style="margin-top: 0; color: #2c3e50; font-size: 18px; border-bottom: 2px solid #3498db; padding-bottom: 5px; margin-bottom: 15px;">Personal Details</h3>';
    $message .= '<div style="' . $row_style . '"><strong>Name:</strong> ' . esc_html("$first_name $last_name") . '</div>';
    $message .= '<div style="' . $row_style . '"><strong>Email:</strong> <a href="mailto:' . esc_attr($email) . '">' . esc_html($email) . '</a></div>';
    $message .= '<div style="' . $row_style . '"><strong>Phone:</strong> ' . esc_html($phone) . '</div>';
    $message .= '<div style="' . $row_style . '"><strong>DOB:</strong> ' . esc_html($dob) . '</div>';
    $message .= '<div style="' . $row_style . '"><strong>Gender:</strong> ' . esc_html($gender) . '</div>';
    $message .= '<div style="' . $last_row_style . '"><strong>Height & Weight:</strong> ' . esc_html($height) . ', ' . esc_html($weight) . '</div>';
    
    // Address Details
    $message .= '<h3 style="' . $heading_style . '">Address Details</h3>';
    $message .= '<div style="' . $last_row_style . '"><strong>Address:</strong> ' . esc_html($address) . ', ' . esc_html($city) . ', ' . esc_html($state) . ' ' . esc_html($zip) . '</div>';
    
    // Insurance Details
    $message .= '<h3 style="' . $heading_style . '">Insurance Details</h3>';
    $message .= '<div style="' . $row_style . '"><strong>Has Existing Insurance:</strong> ' . esc_html($existing_insurance) . '</div>';
    if ($existing_insurance === 'Yes') {
        $message .= '<div style="' . $row_style . '"><strong>Current Coverage:</strong> ' . esc_html($current_coverage) . '</div>';
    }
    $message .= '<div style="' . $row_style . '"><strong>Insurance Type:</strong> ' . esc_html($insurance_type_for_email) . '</div>';
    $message .= '<div style="' . $row_style . '"><strong>Coverage Amount:</strong> ' . esc_html($coverage_amount) . '</div>';
    $message .= '<div style="' . $last_row_style . '"><strong>Annual Income:</strong> ' . esc_html($income) . '</div>';
    
    // Health & Background
    $message .= '<h3 style="' . $heading_style . '">Health & Background</h3>';
    $message .= '<div style="' . $row_style . '"><strong>Health Rating:</strong> ' . esc_html($health_rating) . '</div>';
    $message .= '<div style="' . $row_style . '"><strong>Smoker:</strong> ' . esc_html($smoker) . '</div>';
    $message .= '<div style="' . $row_style . '"><strong>Treated Conditions:</strong> ' . esc_html($conditions_for_email) . '</div>';
    $message .= '<div style="' . $row_style . '"><strong>Family Medical History (Before 65):</strong> ' . esc_html($family_history) . '</div>';
    $message .= '<div style="' . $row_style . '"><strong>Driving Violations (>3 past 3 yrs):</strong> ' . esc_html($driving_violations) . '</div>';
    $message .= '<div style="' . $last_row_style . '"><strong>Dangerous Activities:</strong> ' . esc_html($dangerous_activities) . '</div>';
    
    $message .= '</div>'; // End Data Card
    $message .= '</div>'; // End Main Container

    $headers = array('Content-Type: text/html; charset=UTF-8');
    $headers[] = "From: $site_name <$from_email>";
    $headers[] = "Reply-To: $first_name $last_name <$email>";

    // Force HTML content type to prevent silent drop of email body
    add_filter('wp_mail_content_type', function() { return 'text/html'; });

    // Send email logic (Send to admin/agent first)
    if (wp_mail($to, $subject, $message, $headers)) {
        
        // --- SEND COPY TO THE USER ---
        $user_subject = "Your Life Insurance Quote Request - RiseLifeQuotes";
        wp_mail($email, $user_subject, $message, $headers);
        
        // Remove the filter so it doesn't affect other emails
        remove_filter('wp_mail_content_type', function() { return 'text/html'; });
        
        wp_send_json_success(['message' => 'Quote submitted successfully.']);
    } else {
        // Remove the filter even on failure
        remove_filter('wp_mail_content_type', function() { return 'text/html'; });
        wp_send_json_error(['message' => 'Failed to send email. Ensure SMTP is configured on the host.']);
    }

    wp_die();
}

add_action('wp_ajax_submit_rlq_quote', 'rlq_submit_quote_form');
add_action('wp_ajax_nopriv_submit_rlq_quote', 'rlq_submit_quote_form');
