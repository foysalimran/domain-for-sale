<?php

/**
 * Views class for Shortcode generator options.
 *
 * @link       https://themeatelier.net
 * @since      1.0.0
 *
 * @package domain-for-sale
 * @subpackage domain-for-sale/Admin/Views/DomainForSaleMetaboxMainOptions
 * @author     ThemeAtelier<themeatelierbd@gmail.com>
 */

namespace ThemeAtelier\DomainForSale\Admin\Views\Metabox;

use ThemeAtelier\DomainForSale\Admin\Framework\Classes\DOMAIN_FOR_SALE;

class DomainForSaleMainOptions
{
    /**
     * Create Option fields for the setting options.
     *
     * @param string $prefix Option setting key prefix.
     * @return void
     */
    public static function options($prefix)
    {
        // Main options
        DOMAIN_FOR_SALE::createSection(
            $prefix,
            array(
                'title'  => esc_html__('Main Options', 'domain-for-sale'),
                'icon'   => 'icofont-ui-settings',
                'fields' => array(
                    array(
                        'id'            => 'dfs_apply_on',
                        'type'          => 'select_f',
                        'title'         => esc_html__('Apply With', 'domain-for-sale'),
                        'options'       => 'dfs_apply_on',
                        'subtitle'      => esc_html__('Pick the method for using this template', 'domain-for-sale'),
                        'help'          => esc_html__('Shortcode: Copy paste shortcode any page or posts, Replace Current Theme: Your current theme will be replace with this template, Specefic Page: Pick a page you want to show this template.', 'domain-for-sale'),
                        'default'       => 'shortcode',
                    ),
                    array(
                        'id'            => 'dfs_specific_page',
                        'type'          => 'select',
                        'multiple'      => true,
                        'chosen'        => true,
                        'title'         => esc_html__('Specific Pages', 'domain-for-sale'),
                        'options'       =>  'dfs_specific_page',
                        'subtitle'      => esc_html__('Selected page(s) will be replaced with this template.', 'domain-for-sale'),
                        'dependency'    => array('dfs_apply_on', '==', 'specific_page'),
                    ),

                    array(
                        'type'          => 'heading',
                        'title'         => esc_html__('Contact Form', 'domain-for-sale'),
                    ),
                    array(
                        'id'            => 'dfs_form_type',
                        'type'          => 'button_set',
                        'title'         => esc_html__('Form type', 'domain-for-sale'),
                        'options'       => array(
                            'dfs_form'  =>  esc_html__('Domain For Sale Form', 'domain-for-sale'),
                            'shortcode_form'   => esc_html__('Third-party Form', 'domain-for-sale'),
                        ),
                        'subtitle'      => esc_html__('Select a contact form type', 'domain-for-sale'),
                        'help'          => esc_html__('Domain For Sale Form: Self hosted form provided by this plugin. Third-party form: Custom shortcode from any third-party plugins such as: Contact form 7, Ninja form, Fluent form etc', 'domain-for-sale'),
                        'default'       => array('dfs_form',)
                    ),

                    array(
                        'id'            => 'dfs-formtitle',
                        'type'          => 'text',
                        'title'         => esc_html__('Form title', 'domain-for-sale'),
                        'subtitle'      => esc_html__('Change form title', 'domain-for-sale'),
                        'default'       => esc_html__('Make an Offer', 'domain-for-sale'),
                        'dependency'    => array('dfs_form_type', '==', 'dfs_form'),
                    ),

                    //  Third party form validation
                    array(
                        'id'            => 'dfs-thirdparty_shortcode',
                        'type'          => 'textarea',
                        'title'         => esc_html__('Insert shortcode for contact form', 'domain-for-sale'),
                        'subtitle'      => esc_html__('Use a shortcode from any third-party contact form plugins such as: Contact form 7, Ninja form, Fluent form etc'),
                        'dependency'    => array('dfs_form_type', '==', 'shortcode_form'),
                    ),
                )
            )   
        );
    }
}
