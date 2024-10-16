<?php

/**
 * Views class for Shortcode generator options.
 *
 * @link       https://themeatelier.net
 * @since      1.0.0
 *
 * @package domain-for-sale
 * @subpackage domain-for-sale/Admin/Views/DomainForSaleMetaboxContactForm
 * @author     ThemeAtelier<themeatelierbd@gmail.com>
 */

namespace ThemeAtelier\DomainForSale\Admin\Views\Metabox;

use ThemeAtelier\DomainForSale\Admin\Framework\Classes\DOMAIN_FOR_SALE;

class DomainForSaleContactForm
{

    /**
     * Create Option fields for the setting options.
     *
     * @param string $prefix Option setting key prefix.
     * @return void
     */
    public static function options($prefix)
    {
        // Templates options
        DOMAIN_FOR_SALE::createSection($prefix, array(
            'title'  => esc_html__('Contact form', 'domain-for-sale'),
            'icon'   => 'icofont-email',
            'fields' => array(
                array(
                    'id'       => 'dfs_form_type',
                    'type'     => 'button_set',
                    'title'    => esc_html__('Form type', 'domain-for-sale'),
                    'help'  => esc_html__('Select third-party form for using custom shortcode from any third-party plugins such as: Contact form 7, Ninja form, Fluent form etc', 'domain-for-sale'),
                    'options'  => array(
                        'dfs_form'   =>  esc_html__('Domain For Sale Form', 'domain-for-sale'),
                        'shortcode_form'   => esc_html__('Third-party Form', 'domain-for-sale'),
                    ),
                    'default'  => array('dfs_form',)
                ),

                array(
                    'id'    => 'dfs-formtitle',
                    'type'  => 'text',
                    'title' => esc_html__('Form title', 'domain-for-sale'),
                    'default'  => esc_html__('Make an Offer', 'domain-for-sale'),
                    'dependency' => array('dfs_form_type', '==', 'dfs_form'),
                ),

                //  Third party form validation
                array(
                    'id'    => 'dfs-thirdparty_shortcode',
                    'type'  => 'textarea',
                    'title' => esc_html__('Insert shortcode for contact form', 'domain-for-sale'),
                    'dependency' => array('dfs_form_type', '==', 'shortcode_form'),
                ),
            )
        ));
    }
}
