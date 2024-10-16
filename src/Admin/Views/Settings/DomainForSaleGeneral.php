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
class DomainForSaleGeneral
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
                'title'  => esc_html__('General', 'domain-for-sale'),
                'icon'   => 'icofont-gear',
                'fields' => array(
                    // Upload favicon
                    array(
                        'id'    => 'dfs-favicon',
                        'type'  => 'upload',
                        'title' => esc_html__('Upload favicon', 'domain-for-sale'),
                        'lebel' => esc_html__('Use a 32x32 .ico or .png file.', 'domain-for-sale'),
                    ),
                    array(
                        'id'  => 'dfs-recaptcha',
                        'type'  => 'heading',
                        'title' => esc_html__('SEO Settings', 'domain-for-sale'),
                    ),
                    array(
                        'id'    => 'dfs-sitetitle',
                        'type'  => 'text',
                        'title' => esc_html__('Site Title', 'domain-for-sale'),
                        'default'  => get_bloginfo('title'),
                    ),
                    array(
                        'id'    => 'dfs-sitedescription',
                        'type'  => 'text',
                        'title' => esc_html__('Site Description', 'domain-for-sale'),
                    ),
                    array(
                        'id'    => 'dfs-sitekeywords',
                        'type'  => 'textarea',
                        'title' => esc_html__('Site Keywords', 'domain-for-sale'),
                        'desc'  => esc_html__('Add your site keywords seperated by a comma eg: "business domain, corporate domain"', 'domain-for-sale'),
                    ),
                )
            )
        );
    }
}
