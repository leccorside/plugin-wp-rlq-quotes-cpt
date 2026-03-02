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
    $subject = "New Life Insurance Quote Request from $first_name $last_name";
    
    $message = "<h2>New Quote Request</h2>";
    $message .= "<h3>Personal Details</h3>";
    $message .= "<p><strong>Name:</strong> $first_name $last_name</p>";
    $message .= "<p><strong>Email:</strong> $email</p>";
    $message .= "<p><strong>Phone:</strong> $phone</p>";
    $message .= "<p><strong>DOB:</strong> $dob</p>";
    $message .= "<p><strong>Gender:</strong> $gender</p>";
    $message .= "<p><strong>Height & Weight:</strong> $height, $weight</p>";
    
    $message .= "<h3>Address Details</h3>";
    $message .= "<p><strong>Address:</strong> $address, $city, $state $zip</p>";
    
    $message .= "<h3>Health & Background</h3>";
    $message .= "<p><strong>Health Rating:</strong> $health_rating</p>";
    $message .= "<p><strong>Smoker:</strong> $smoker</p>";
    $message .= "<p><strong>Treated Conditions:</strong> $conditions_str</p>";
    $message .= "<p><strong>Family Medical History (Before 65):</strong> $family_history</p>";
    $message .= "<p><strong>Driving Violations (>3 past 3 yrs):</strong> $driving_violations</p>";
    $message .= "<p><strong>Dangerous Activities:</strong> $dangerous_activities</p>";
    
    $message .= "<h3>Insurance Details</h3>";
    $message .= "<p><strong>Has Current Insurance:</strong> $has_insurance (Coverage: $current_coverage)</p>";
    $message .= "<p><strong>Looking For:</strong> $insurance_type_str</p>";
    $message .= "<p><strong>Target Coverage:</strong> $target_coverage</p>";
    $message .= "<p><strong>Term Length:</strong> $term_length</p>";
    $message .= "<p><strong>Annual Income:</strong> $annual_income</p>";

    $headers = array('Content-Type: text/html; charset=UTF-8');
    $headers[] = "Reply-To: $first_name $last_name <$email>";

    // Send the email
    $sent = wp_mail($to, $subject, $message, $headers);

    if ($sent) {
        wp_send_json_success(['message' => 'Quote submitted successfully.']);
    } else {
        wp_send_json_error(['message' => 'Failed to send email.']);
    }

    wp_die();
}

add_action('wp_ajax_submit_rlq_quote', 'rlq_submit_quote_form');
add_action('wp_ajax_nopriv_submit_rlq_quote', 'rlq_submit_quote_form');
