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
class DomainForSaleCustomCodes
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
                'title'  => esc_html__('Custom Codes', 'domain-for-sale'),
                'icon'   => 'icofont-code-alt',
                'fields'      => array(
                    array(
                        'id'  => 'dfs-custom-css',
                        'type'  => 'code_editor',
                        'title' => esc_html__('Custom CSS', 'domain-for-sale'),
                        'settings'  => array(
                            'theme' => 'mbo',
                            'mode'  => 'css',
                        ),
                    ),
                    array(
                        'id'  => 'dfs-custom-js',
                        'type'  => 'code_editor',
                        'title' => esc_html__('Custom JavaScript', 'domain-for-sale'),
                        'settings'  => array(
                            'theme' => 'mbo',
                            'mode'  => 'js',
                        ),
                    ),

                )
            )
        );
    }
}
