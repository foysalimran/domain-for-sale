<?php

/**
 * Views class for Shortcode generator options.
 *
 * @link       https://themeatelier.net
 * @since      1.0.0
 *
 * @package domain-for-sale
 * @subpackage domain-for-sale/Admin/Views/DomainForSaleStyleOptions
 * @author     ThemeAtelier<themeatelierbd@gmail.com>
 */

namespace ThemeAtelier\DomainForSale\Admin\Views\Metabox;

use ThemeAtelier\DomainForSale\Admin\Framework\Classes\DOMAIN_FOR_SALE;

class DomainForSaleStyleOptions
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
            'title'  => esc_html__('Style Options', 'domain-for-sale'),
            'icon'   => 'icofont-paint',
            'fields' => array(
                // Color Scheme Type
                array(
                    'id'            => 'dfs_color_scheme_type',
                    'type'          => 'radio',
                    'title'         => esc_html__('Color Scheme Type', 'domain-for-sale'),
                    'inline'        => true,
                    'class'         => 'dfs_color_scheme_type',
                    'options'       => array(
                        'pre_defined' => esc_html__('Pre Defined', 'domain-for-sale'),
                        'custom' => esc_html__('Custom', 'domain-for-sale'),
                    ),
                    'subtitle'       => esc_html__('Select type of color scheme to use', 'domain-for-sale'),
                    'default' => 'pre_defined',
                ),

                // Color scheme
                array(
                    'id'          => 'dfs-scheme',
                    'type'        => 'image_select',
                    'title'       => esc_html__('Select Pre Defined Color Scheme', 'domain-for-sale'),
                    'options'     => array(
                        '4'     => DOMAIN_FOR_SALE_DIR_URL . 'src/assets/images/color-4.png',
                        '1'     => DOMAIN_FOR_SALE_DIR_URL . 'src/assets/images/color-1.png',
                        '2'     => DOMAIN_FOR_SALE_DIR_URL . 'src/assets/images/color-2.png',
                        '3'     => DOMAIN_FOR_SALE_DIR_URL . 'src/assets/images/color-3.png',
                    ),
                    'default' => '4',
                    'dependency' => array('dfs_color_scheme_type', '==', 'pre_defined'),
                ),


                array(
                    'id'        => 'dfs_custom_scheme',
                    'type'      => 'color_group',
                    'title'     => esc_html__('Use Custom Color', 'domain-for-sale'),
                    'options'   => array(
                        'primary' => esc_html__('Primary', 'domain-for-sale'),
                        'secondary' => esc_html__('Secondary', 'domain-for-sale'),
                    ),
                    'default'   => array(
                        'primary' => '#44dc46',
                        'secondary' => '#3bbf3d',
                    ),
                    'dependency' => array('dfs_color_scheme_type', '==', 'custom'),
                ),
                array(
                    'id'      => 'dfs_container_width',
                    'type'    => 'slider',
                    'min'     => 800,
                    'max'     => 2000,
                    'step'    => 10,
                    'unit'    => 'px',
                    'default' => 1140,
                    'title'   => esc_html__('Container Width', 'domain-for-sale'),
                    'subtitle'  => esc_html__('Use custom width for the container.', 'domain-for-sale'),
                ),
                array(
                    'id'      => 'dfs_gap',
                    'title'   => esc_html__('Gap Between Columns', 'domain-for-sale'),
                    'subtitle'  => esc_html__('Use custom gap for the column', 'domain-for-sale'),
                    'type'    => 'slider',
                    'min'     => 0,
                    'max'     => 300,
                    'step'    => 1,
                    'unit'    => 'px',
                    'default' => 30,
                ),
                array(
                    'id'      => 'dfs-background',
                    'type'    => 'background',
                    'title'   => esc_html__('Body Background Image', 'domain-for-sale'),
                    'background_color' => false,
                    'default' => array(
                        'background-position'   => 'center center',
                        'background-repeat'     => 'repeat-x',
                        'background-attachment' => 'fixed',
                        'background-size'       => 'cover',
                    )
                ),
                array(
                    'id'      => 'dfs-overlay',
                    'type'    => 'color',
                    'title'   => esc_html__('Background Overlay', 'domain-for-sale'),
                    'default' => 'rgba(0,0,0,0.7)',
                ),

            )
        ));
    }
}
