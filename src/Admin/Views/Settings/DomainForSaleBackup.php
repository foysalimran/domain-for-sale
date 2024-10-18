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
class DomainForSaleBackup
{
    /**
     * Advanced setting section.
     *
     * @param string $prefix The settings.
     * @return void
     */
    public static function section($prefix)
    {
        //
        // Field: backup
        //
        DOMAIN_FOR_SALE::createSection($prefix, array(
            'title'       => esc_html__('Backup', 'domain-for-sale'),
            'icon'        => 'icofont-shield',
            'description' => esc_html__('Export or import to use same settings in different websites.', 'domain-for-sale'),
            'fields'      => array(
                array(
                    'type' => 'backup',
                ),
            )
        ));
    }
}
