<?php

/**
 * Domain for sale pro dashboard capability.
 *
 * @return string
 */
function domain_for_sale_dashboard_capability()
{
    return apply_filters('domain_for_sale_dashboard_capability', 'manage_options');
}

add_action('wp_ajax_dfs_send_email', 'dfs_send_email');
add_action('wp_ajax_nopriv_dfs_send_email', 'dfs_send_email');
function dfs_send_email()
{
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'domain_for_sale_email_nonce')) {
        wp_send_json_error(array(
            'type' => 'error',
            'title' => __('Security Check Failed', 'domain-for-sale'),
            'description' => __('Nonce verification failed.', 'domain-for-sale'),
            'okay' => __('OK', 'domain-for-sale'),
        ));
        wp_die();
    }

    // Parse the serialized form data into an array
    parse_str($_POST['data'], $formData);

    $name    = sanitize_text_field($formData['dfs-name']);
    $email   = sanitize_email($formData['dfs-email']);
    $subject = sanitize_text_field($formData['dfs-subject']);
    $message = sanitize_textarea_field($formData['dfs-proposal']);
    $date    = date('F j, Y, H:i (h:i A) (\G\M\T O)');
    $ip      = esc_sql(sanitize_text_field($_SERVER['REMOTE_ADDR']));
    $siteURL = get_site_url();

    // Get email template and settings from options
    $options = get_option('dfs-opt');
    $dfs_target_mail = isset($options['dfs-targetemail']) ? $options['dfs-targetemail'] : '';
    $dfs_email_template = isset($options['dfs-emaitemplate']) ? $options['dfs-emaitemplate'] : '';

    $dfs_success_title = isset($options['dfs-success-title']) ? $options['dfs-success-title'] : 'Email Sent!';
    $dfs_success_description = isset($options['dfs-success-description']) ? $options['dfs-success-description'] : 'Your message has been successfully sent.';
    $dfs_error_title = isset($options['dfs-error-title']) ? $options['dfs-error-title'] : 'Error Sending Email';
    $dfs_error_description = isset($options['dfs-error-description']) ? $options['dfs-error-description'] : 'There was an issue sending your message. Please try again later.';
    $dfs_error_okay = isset($options['dfs-error-okay']) ? $options['dfs-error-okay'] : 'Ok';

    // Prepare email content
    $variables      = array('{from}', '{email}', '{message}', '{date}', '{ip}', '{subject}', '{siteURL}');
    $values         = array($name, $email, $message, $date, $ip, $subject, $siteURL);
    $email_body     = trim(str_replace($variables, $values, $dfs_email_template));
    $headers        = array('From: ' . $name . ' <' . $email . '>');

    // Send email using wp_mail()
    if (wp_mail($dfs_target_mail, $subject, $email_body, $headers)) {
        wp_send_json_success(array(
            'type'      => 'success',
            'title'     => esc_html($dfs_success_title),
            'description' => esc_html($dfs_success_description),
        ));
    } else {
        wp_send_json_error(array(
            'type' => 'error',
            'title' => esc_html($dfs_error_title),
            'okay' => esc_html($dfs_error_okay),
            'description' => esc_html($dfs_error_description),
        ));
    }


    wp_die();
}
