<?php
/**
 * Settings Page for RLQ Quotes
 */

// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register settings
 */
function rlq_quotes_register_settings() {
    register_setting('rlq_quotes_settings_group', 'rlq_quotes_recipient_email', [
        'type' => 'string',
        'sanitize_callback' => 'sanitize_email',
        'default' => 'leccorside@gmail.com',
    ]);
}
add_action('admin_init', 'rlq_quotes_register_settings');

/**
 * Add submenu page to the Custom Post Type menu
 */
function rlq_quotes_add_settings_page() {
    add_submenu_page(
        'edit.php?post_type=rlq_quote',
        'RLQ Quotes Settings',
        'Settings',
        'manage_options',
        'rlq-quotes-settings',
        'rlq_quotes_settings_page_html'
    );
}
add_action('admin_menu', 'rlq_quotes_add_settings_page');

/**
 * Settings page HTML
 */
function rlq_quotes_settings_page_html() {
    // Check user capabilities
    if (!current_user_can('manage_options')) {
        return;
    }

    // Pass default if empty
    $recipient_email = get_option('rlq_quotes_recipient_email', 'leccorside@gmail.com');
    ?>
    <div class="wrap">
        <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
        <form action="options.php" method="post">
            <?php
            // Output security fields for the registered setting
            settings_fields('rlq_quotes_settings_group');
            // Output setting sections and their fields
            do_settings_sections('rlq_quotes_settings_group');
            ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">Quote Submissions Recipient Email</th>
                    <td>
                        <input type="email" name="rlq_quotes_recipient_email" value="<?php echo esc_attr($recipient_email); ?>" class="regular-text" />
                        <p class="description">Enter the email address where all quote form submissions should be sent.</p>
                    </td>
                </tr>
            </table>
            <?php
            // Output save settings button
            submit_button('Save Settings');
            ?>
        </form>
    </div>
    <?php
}
