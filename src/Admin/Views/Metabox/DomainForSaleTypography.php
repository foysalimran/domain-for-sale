<?php

/**
 * Views class for Shortcode generator options.
 *
 * @link       https://themeatelier.net
 * @since      1.0.0
 *
 * @package domain-for-sale
 * @subpackage domain-for-sale/Admin/Views/DomainForSaleMetaboxTypography
 * @author     ThemeAtelier<themeatelierbd@gmail.com>
 */

namespace ThemeAtelier\DomainForSale\Admin\Views\Metabox;

use ThemeAtelier\DomainForSale\Admin\Framework\Classes\DOMAIN_FOR_SALE;

class DomainForSaleTypography
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
                'title'  => esc_html__('Typography', 'domain-for-sale'),
                'icon'   => 'icofont-home',
                'fields' => array(
                    array(
                        'id'                    => 'dfs_body_typography',
                        'type'                  => 'typography',
                        'title'                 => esc_html__('Body', 'domain-for-sale'),
                        'text_align'            => false,
                        'letter_spacing'        => false,
                        'color'                 => false,
                        'subset'                => false,
                        'default'               => array(
                            'font-family'       => 'Nunito',
                            'font-weight'       => '400',
                            'type'              => 'google',
                            'font-size'         => '16',
                            'line-height'       => '20',
                            'tablet-font-size'  => '16',
                            'mobile-font-size'  => '16',
                            'color'             => '',
                        ),
                    ),
                    array(
                        'id'                => 'dfs_domain_name',
                        'type'              => 'typography',
                        'title'             => esc_html__('Domain Name', 'domain-for-sale'),
                        'text_align'        => false,
                        'letter_spacing'    => false,
                        'subset'            => false,
                        'default'           => array(
                            'font-family'    => 'Poppins',
                            'font-weight'    => '700',
                            'type'           => 'google',
                            'font-size'         => '48',
                            'line-height'       => '48',
                            'tablet-font-size'  => '42',
                            'mobile-font-size'  => '38',
                            'color'             => '',
                        ),
                    ),
                    array(
                        'id'                => 'dfs_sale_title',
                        'type'              => 'typography',
                        'title'             => esc_html__('Sale Title', 'domain-for-sale'),
                        'text_align'        => false,
                        'letter_spacing'    => false,
                        'subset'            => false,
                        'default'           => array(
                            'font-family'    => 'Poppins',
                            'font-weight'    => '700',
                            'type'           => 'google',
                            'font-size'         => '38',
                            'line-height'       => '38',
                            'tablet-font-size'  => '32',
                            'mobile-font-size'  => '30',
                            'color'             => '',
                        ),
                    ),
                    array(
                        'id'                => 'dfs_form_title',
                        'type'              => 'typography',
                        'title'             => esc_html__('Form Title', 'domain-for-sale'),
                        'text_align'        => false,
                        'letter_spacing'    => false,
                        'subset'            => false,
                        'default'           => array(
                            'font-family'    => 'Poppins',
                            'font-weight'    => '700',
                            'type'           => 'google',
                            'font-size'         => '32',
                            'line-height'       => '30',
                            'tablet-font-size'  => '28',
                            'color'             => '',
                        ),
                    ),
                    array(
                        'id'                => 'dfs_recommendation_title',
                        'type'              => 'typography',
                        'title'             => esc_html__('Recommendation Title', 'domain-for-sale'),
                        'text_align'        => false,
                        'letter_spacing'    => false,
                        'subset'            => false,
                        'default'           => array(
                            'font-family'    => 'Poppins',
                            'font-weight'    => '700',
                            'type'           => 'google',
                            'font-size'         => '28',
                            'line-height'       => '24',
                            'tablet-font-size'  => '20',
                            'color'             => '',
                        ),
                        'dependency' => array('dfs_layout_preset', '==', 'layout_02', 'any'),
                    ),
                    array(
                        'id'                => 'dfs_recommendation_domain_name',
                        'type'              => 'typography',
                        'title'             => esc_html__('Recommendation Domain Name', 'domain-for-sale'),
                        'text_align'        => false,
                        'letter_spacing'    => false,
                        'subset'            => false,
                        'hover_color'       => true,
                        'default'           => array(
                            'font-family'    => 'Poppins',
                            'font-weight'    => '700',
                            'type'           => 'google',
                            'font-size'         => '24',
                            'line-height'       => '20',
                            'tablet-font-size'  => '22',
                            'color'             => '#000000',
                            'hover_color'       => '',
                        ),
                        'dependency' => array('dfs_layout_preset', '==', 'layout_02', 'any'),
                    ),
                )
            )
        );
    }
}
