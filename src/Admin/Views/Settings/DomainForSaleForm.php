<?php

/**
 * The Enqueue and Dequeue CSS and JS files setting configurations.
 *
 * @package domain-for-sale
 * @subpackage domain-for-sale/admin
 */

namespace ThemeAtelier\DomainForSale\Admin\Views\Settings;

use ThemeAtelier\DomainForSale\Admin\Framework\Classes\DOMAIN_FOR_SALE;

if (! defined('ABSPATH')) {
    die;
} // Cannot access pages directly.

/**
 * The Layout building class.
 */
class DomainForSaleForm
{

    /**
     * Advanced setting section.
     *
     * @param string $prefix The settings.
     * @return void
     */
    public static function section($prefix)
    {
        DOMAIN_FOR_SALE::createSection(
            $prefix,
            array(
                'title'  => esc_html__('Domain For Sale Form', 'domain-for-sale'),
                'icon'   => 'icofont-envelope',
                'fields' => array(
                    // Domain for sale form
                    array(
                        'type'  => 'heading',
                        'title' => esc_html__('Form Fields', 'domain-for-sale'),
                    ),
                    array(
                        'id'    => 'dfs-namelabel',
                        'type'  => 'text',
                        'title' => esc_html__('Name Field Label', 'domain-for-sale'),
                        'default'  => esc_html__('Name*', 'domain-for-sale'),
                    ),
                    array(
                        'id'    => 'dfs-nameplaceholder',
                        'type'  => 'text',
                        'title' => esc_html__('Name Field Placeholder', 'domain-for-sale'),
                        'default'  => esc_html__('Your name', 'domain-for-sale'),
                    ),
                    array(
                        'id'    => 'dfs-emaillabel',
                        'type'  => 'text',
                        'title' => esc_html__('Email Field Label', 'domain-for-sale'),
                        'default'  => 'Email*',
                    ),
                    array(
                        'id'    => 'dfs-emailplaceholder',
                        'type'  => 'text',
                        'title' => esc_html__('Email Field Placeholder', 'domain-for-sale'),
                        'default'  => esc_html__('Your email address*', 'domain-for-sale'),
                    ),
                    array(
                        'id'    => 'dfs-subjectlabel',
                        'type'  => 'text',
                        'title' => esc_html__('Subject Field Label', 'domain-for-sale'),
                        'default'  => esc_html__('Subject*', 'domain-for-sale'),
                    ),
                    array(
                        'id'    => 'dfs-subjectplaceholder',
                        'type'  => 'text',
                        'title' => esc_html__('Subject Field Placeholder', 'domain-for-sale'),
                        'default'  => esc_html__('Write email subject', 'domain-for-sale'),
                    ),
                    array(
                        'id'    => 'dfs-proposallabel',
                        'type'  => 'text',
                        'title' => esc_html__('Proposal Field Label', 'domain-for-sale'),
                        'default'  => esc_html__('Proposal*', 'domain-for-sale'),
                    ),
                    array(
                        'id'    => 'dfs-proposalplaceholder',
                        'type'  => 'text',
                        'title' => esc_html__('Proposal Field Placeholder', 'domain-for-sale'),
                        'default'  => esc_html__('Write your proposal', 'domain-for-sale'),
                    ),
                    array(
                        'id'    => 'dfs-buttonlabel',
                        'type'  => 'text',
                        'title' => esc_html__('Button Label', 'domain-for-sale'),
                        'default'  => esc_html__('Send proposal', 'domain-for-sale'),
                    ),
                    array(
                        'type'  => 'heading',
                        'title' => esc_html__('Form Notification', 'domain-for-sale'),
                    ),
                    array(
                        'id'    => 'dfs-targetemail',
                        'type'  => 'text',
                        'title' => esc_html__('Target Email Addresses', 'domain-for-sale'),
                        'desc'  => esc_html__('Write your emaill addresses to get email. Multiple email can be separated by comma , eg: info@domain.com,hi@domain.com', 'domain-for-sale'),
                    ),
                    array(
                        'id'    => 'dfs-emaitemplate',
                        'type'  => 'textarea',
                        'title' => esc_html__('Email Template', 'domain-for-sale'),
                        'desc'      => esc_html__('Available tags &ndash; {from}, {email}, {subject}, {message}, {date}, {siteURL}, {ip}', 'domain-for-sale'),
                        'default'   => esc_html__("Dear Administrator,\nYou have one message from {from} ({email}).\n\n{message}\n\n{date}", 'domain-for-sale'),
                    ),
                    array(
                        'type'  => 'heading',
                        'title' => esc_html__('Email confirmation notices', 'domain-for-sale'),
                    ),
                    array(
                        'id'    => 'dfs-success-title',
                        'type'  => 'text',
                        'title' => esc_html__('Form Success Title', 'domain-for-sale'),
                        "default" => esc_html__("Thank You for your proposal!", 'domain-for-sale'),
                    ),
                    array(
                        'id'    => 'dfs-success-description',
                        'type'  => 'text',
                        'title' => esc_html__('Form Success Description', 'domain-for-sale'),
                        "default" => esc_html__("Your message has already arrived! We will contact you shortly.", 'domain-for-sale'),
                    ),
                    array(
                        'id'    => 'dfs-error-title',
                        'type'  => 'text',
                        'title' => esc_html__('Form Error Title', 'domain-for-sale'),
                        "default" => esc_html__("Email not submitted.", 'domain-for-sale'),
                    ),
                    array(
                        'id'    => 'dfs-error-description',
                        'type'  => 'text',
                        'title' => esc_html__('Form Error Description', 'domain-for-sale'),
                        "default" => esc_html__("There might be an error with server instead please send us a direct message at: info@yourdomain.com", 'domain-for-sale'),
                    ),
                    array(
                        'id'    => 'dfs-error-okay',
                        'type'  => 'text',
                        'title' => esc_html__('Form Okay Button Value', 'domain-for-sale'),
                        "default" => esc_html__("Okay", 'domain-for-sale'),
                    ),
                    array(
                        'type'  => 'heading',
                        'title' => esc_html__('Google Recaptcha', 'domain-for-sale'),
                    ),
                    array(
                        'type'    => 'submessage',
                        'style'   => 'info',
                        'content' => __(
                            '<a href="https://www.google.com/recaptcha" target="_blank">reCAPTCHA</a> is a free anti-spam service of Google that protects your website from spam and abuse. <a href="https://www.google.com/recaptcha/admin#list" target="_blank"> Get your API Keys</a>.',
                            'domain-for-sale'
                        ),
                    ),
                    array(
                        'type'  => 'switcher',
                        'title' => esc_html__('Turn on google recaptcha', 'domain-for-sale'),
                        'class' => 'switcher_pro_only',
                        'default' => true,
                    ),
                    array(
                        'id'        => 'dfs_recaptcha_version',
                        'type'      => 'select_f',
                        'class'     => 'select_pro_only',
                        'title'      => esc_html__('reCAPTCHA Type ', 'domain-for-sale'),
                        'options'  => array(
                            'v3' => array(
                                'name' => esc_html__('reCAPTCHA v3', 'geodir-recaptcha'),
                                'pro_only' => true,
                            ),
                            'v2' => array(
                                'name' => esc_html__('reCAPTCHA v2 (I\'m not a robot Checkbox)', 'geodir-recaptcha'),
                                'pro_only' => true,
                            ),
                        ),
                        'default'    => 'v3',
                        'advanced' => false,
                        'dependency' => array('dfs-enable-recaptcha', '==', 'true'),
                    ),
                    array(
                        'id' => 'dfs-recaptcha-sitekey_v3',
                        'type'  => 'text',
                        'class' => 'text_pro_only',
                        'title' => esc_html__('Site key', 'domain-for-sale'),
                    ),
                    array(
                        'id' => 'dfs-recaptcha-secretkey_v3',
                        'type'  => 'text',
                        'class' => 'text_pro_only',
                        'title' => esc_html__('Secret key', 'domain-for-sale'),
                    ),
                    array(
                        'id'    => 'dfs-recaptcha-error-title',
                        'type'  => 'text',
                        'class' => 'text_pro_only',
                        'title' => esc_html__('Form Recaptcha Error Title', 'domain-for-sale'),
                        "default" => esc_html__("Email not submitted.", 'domain-for-sale'),
                    ),
                    array(
                        'id'    => 'dfs-recaptcha-error-description',
                        'type'  => 'text',
                        'class' => 'text_pro_only',
                        'title' => esc_html__('Form Recaptcha Error Description', 'domain-for-sale'),
                        "default" => esc_html__("Please tick and verify the recaptcha.", 'domain-for-sale'),
                    ),
                    array(
                        'id'    => 'dfs-recaptcha-error-okay',
                        'type'  => 'text',
                        'class' => 'text_pro_only',
                        'title' => esc_html__('Form Recaptcha Okay Button Value', 'domain-for-sale'),
                        "default" => esc_html__("Okay", 'domain-for-sale'),
                    ),
                )
            )
        );
    }
}
