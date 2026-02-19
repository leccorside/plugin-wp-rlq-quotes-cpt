<?php
/**
 * RLQ Quotes CPT Customizer Settings
 *
 * @package RLQ_Quotes_CPT
 */

if (!defined('ABSPATH')) {
    exit;
}

function rlq_customize_register($wp_customize)
{
    // Add Section
    $wp_customize->add_section('rlq_quotes_section', array(
        'title' => __('RLQ Quotes Settings', 'rlq-quotes-cpt'),
        'priority' => 160,
    ));

    // Add Setting for "Secure Your Loved One’s Future" Text
    $wp_customize->add_setting('rlq_secure_future_text', array(
        'default' => __('Secure Your Loved One’s Future With A Life Insurance Policy', 'rlq-quotes-cpt'),
        'sanitize_callback' => 'wp_kses_post',
        'transport' => 'refresh',
    ));

    // Add Control for "Secure Your Loved One’s Future" Text
    $wp_customize->add_control('rlq_secure_future_text', array(
        'label' => __('Secure Future Text', 'rlq-quotes-cpt'),
        'description' => __('Text appearing in the "Secure Your Loved One’s Future" section.', 'rlq-quotes-cpt'),
        'section' => 'rlq_quotes_section',
        'type' => 'textarea',
    ));

    // Add Setting for "Secure Your Loved One’s Future" Content/Body
    $wp_customize->add_setting('rlq_secure_future_content', array(
        'default' => __('Life insurance is a contract between you and an insurance company. Essentially, in exchange for your premium payments, the insurance company will pay a lump sum known as a death benefit to your beneficiaries after your death.', 'rlq-quotes-cpt'),
        'sanitize_callback' => 'wp_kses_post',
        'transport' => 'refresh',
    ));

    // Add Control for "Secure Your Loved One’s Future" Content/Body
    $wp_customize->add_control('rlq_secure_future_content', array(
        'label' => __('Secure Future Content', 'rlq-quotes-cpt'),
        'description' => __('Content appearing below the title.', 'rlq-quotes-cpt'),
        'section' => 'rlq_quotes_section',
        'type' => 'textarea',
    ));

    // Add Setting for "Texto Home"
    $wp_customize->add_setting('rlq_home_text_content', array(
        'default' => __('Home Text Content...', 'rlq-quotes-cpt'),
        'sanitize_callback' => 'wp_kses_post',
        'transport' => 'refresh',
    ));

    // Add Control for "Texto Home"
    $wp_customize->add_control('rlq_home_text_content', array(
        'label' => __('Texto Home', 'rlq-quotes-cpt'),
        'description' => __('Text appearing below the Secure Future section.', 'rlq-quotes-cpt'),
        'section' => 'rlq_quotes_section',
        'type' => 'textarea',
    ));
}
add_action('customize_register', 'rlq_customize_register');
