<?php

/**
 * Views class for Shortcode generator options.
 *
 * @link       https://themeatelier.net
 * @since      1.0.0
 *
 * @package domain-for-sale
 * @subpackage domain-for-sale/Admin/Views/DomainForSaleContentOptions
 * @author     ThemeAtelier<themeatelierbd@gmail.com>
 */

namespace ThemeAtelier\DomainForSale\Admin\Views\Metabox;

use ThemeAtelier\DomainForSale\Admin\Framework\Classes\DOMAIN_FOR_SALE;

class DomainForSaleContentOptions
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
            'title'  => esc_html__('Content Options', 'domain-for-sale'),
            'icon'   => 'icofont-edit',
            'fields' => array(
                array(
                    'id'    => 'dfs-pricetag',
                    'type'  => 'text',
                    'title' => esc_html__('Price Tag', 'domain-for-sale'),
                    'default'  => esc_html__('Price $200 Only', 'domain-for-sale'),
                ),
                array(
                    'id'    => 'dfs-domainname',
                    'type'  => 'text',
                    'title' => esc_html__('Domain Name', 'domain-for-sale'),
                    'default'  => get_site_url(),
                ),
                array(
                    'id'    => 'dfs-saletitle',
                    'type'  => 'text',
                    'title' => esc_html__('Sale Title', 'domain-for-sale'),
                    'default'  => esc_html__('is for sale', 'domain-for-sale'),
                ),
                array(
                    'id'    => 'dfs-content',
                    'type'  => 'wp_editor',
                    'title' => esc_html__('Sale Content', 'domain-for-sale'),
                    'default'  => esc_html__('The domain name (without content) is available for sale by its owner. Any offer you submit is binding for 7 days. If you require futher information contact with me.', 'domain-for-sale'),
                ),
                array(
                    'id'    => 'dfs-contacttitle',
                    'type'  => 'text',
                    'title' => esc_html__('Contact Title', 'domain-for-sale'),
                    'default'  => esc_html__('Contact Info:', 'domain-for-sale'),
                ),
                array(
                    'id'     => 'dfs-contactinfos',
                    'type'   => 'repeater',
                    'title'  => esc_html__('Contact Information\'s', 'domain-for-sale'),
                    'fields' => array(
                        array(
                            'id'      => 'contactinfos-icon',
                            'type'    => 'icon',
                            'title'   => esc_html__('Icon for contact info', 'domain-for-sale'),
                        ),
                        array(
                            'id'    => 'contactinfos-text',
                            'type'  => 'text',
                            'title' => esc_html__('Contact info', 'domain-for-sale'),
                        ),
                    ),
                    'default' => array(
                        array(
                            'contactinfos-icon'    => 'icofont-envelope',
                            'contactinfos-text'     => get_option('admin_email'),
                        ),
                        array(
                            'contactinfos-icon'    => 'icofont-phone',
                            'contactinfos-text'     => esc_html__('(345) 456 789 23', 'domain-for-sale'),
                        ),
                    ),
                ),

                array(
                    'id'    => 'dfs-moredomainTitle',
                    'type'  => 'text',
                    'title' => esc_html__('More Domain Title', 'domain-for-sale'),
                    'default'  => esc_html__('More Domains', 'domain-for-sale'),
                    'dependency' => array('dfs_layout_preset', '==', 'layout_02', 'any'),
                ),

                array(
                    'id'     => 'dfs-moredomains',
                    'type'   => 'repeater',
                    'title'  => esc_html__('Recommended Domain', 'domain-for-sale'),
                    'dependency' => array('dfs_layout_preset', '==', 'layout_02', 'any'),
                    'fields' => array(
                        array(
                            'id'      => 'moredomains-title',
                            'type'    => 'text',
                            'title'   => esc_html__('Domain name', 'domain-for-sale'),
                        ),
                        array(
                            'id'      => 'moredomains-link',
                            'type'    => 'link',
                            'title'   => esc_html__('Domain link', 'domain-for-sale'),
                        ),
                        array(
                            'id'    => 'moredomains-content',
                            'type'  => 'textarea',
                            'title' => esc_html__('About domain', 'domain-for-sale'),
                        ),
                    ),
                    'default' => array(
                        array(
                            'moredomains-title'    => 'www.firstdomain.com',
                            'moredomains-link'    => '',
                            'moredomains-content'     => esc_html__('Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum nihil consequatur aspernatur ipsum facere neque distinctio fugit voluptatum laborum odit eveniet saepe culpa sit dolor ea fugiat officiis, debitis magni.', 'domain-for-sale'),
                        ),
                        array(
                            'moredomains-title'    => 'www.seconddomain.com',
                            'moredomains-link'    => '',
                            'moredomains-content'     => esc_html__('Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum nihil consequatur aspernatur ipsum facere neque distinctio fugit voluptatum laborum odit eveniet saepe culpa sit dolor ea fugiat officiis, debitis magni.', 'domain-for-sale'),
                        ),
                        array(
                            'moredomains-title'    => 'www.thirddomain.com',
                            'moredomains-link'    => '',
                            'moredomains-content'     => esc_html__('Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum nihil consequatur aspernatur ipsum facere neque distinctio fugit voluptatum laborum odit eveniet saepe culpa sit dolor ea fugiat officiis, debitis magni.', 'domain-for-sale'),
                        ),
                    ),
                ),

            )
        ));
    }
}
