<?php
// Do not allow directly accessing this file.
if (!defined('ABSPATH')) {
    exit('Direct script access denied.');
}
/**
 * @version    1.0
 * @package    Domain For Sale
 * @author     ThemeAtelier
 *
 * Websites: http://www.themeatelier.net
 *
 *
 */
// Control core classes for avoid errors
if (class_exists('CSF')) {

    //
    // Set a unique slug-like ID
    $prefix = 'domain_for_sale_meta';
    //
    // Create a metabox
    CSF::createMetabox($prefix, array(
        'title'     => __('Template options', 'domain-for-sale'),
        'post_type' => 'templates',
    ));

    //
    // Create a section
    CSF::createSection($prefix, array(
        'fields' => array(
            // Select version for templates
            array(
                'id'    => 'select_version',
                'type'  => 'image_select',
                'title' => __('Choose Version', 'domain-for-sale'),
                'desc'  => __('Select version for this section', 'domain-for-sale'),
                'options'    => array(
                    'templates_1' => DFS_DIR_URL_image . 'version-1.png',
                    'templates_2' => DFS_DIR_URL_image . 'version-2.png',
                ),
                'default'   => 'templates_1',
            ),


        )
    ));

    //
    // Set a unique slug-like ID
    $prefix = 'domain_for_sal_meta';
    //
    // Create a metabox
    CSF::createMetabox($prefix, array(
        'title'     => __('Domain For Sale', 'domain-for-sale'),
        'post_type' => 'templates',
        'theme'              => 'light',
        'nav'   => 'inline',
        'show_restore' => true,
    ));

    //
    // Create a section
    CSF::createSection($prefix, array(
        'title'  => __('Content Options', 'domain-for-sale'),
        'icon'  => 'fa fa-cogs',
        'fields' => array(
            array(
                'id'                => 'template_price_tag',
                'type'              => 'text',
                'title'             => __('Price Tag', 'domain-for-sale'),
            ),
            array(
                'id'                => 'template_domain_name',
                'type'              => 'text',
                'title'             => __('Domain Name', 'domain-for-sale'),
            ),
            array(
                'id'                => 'template_sale_title',
                'type'              => 'text',
                'title'             => __('Sale Title', 'domain-for-sale'),
            ),
            array(
                'id'                => 'template_sale_content',
                'type'              => 'wp_editor',
                'title'             => __('Sale Content', 'domain-for-sale'),
            ),
            array(
                'id'                => 'template_contact_title',
                'type'              => 'text',
                'title'             => __('Contact title', 'domain-for-sale'),
            ),
            array(
                'id'     => 'template_contactinfos',
                'type'   => 'repeater',
                'title'  => __('Contact informations', 'domain-for-sale'),
                'fields' => array(
                    array(
                        'id'      => 'contactinfos_icon',
                        'type'    => 'icon',
                        'title'   => __('Icon for contact info', 'domain-for-sale'),
                    ),
                    array(
                        'id'    => 'contactinfos_text',
                        'type'  => 'text',
                        'title' => __('Contact info', 'domain-for-sale'),
                    ),
                ),
                'default' => array(
                    array(
                        'contactinfos_icon'    => 'far fa-envelope',
                        'contactinfos_text'     => __('info@yourdomain.com', 'domain-for-sale'),
                    ),
                    array(
                        'contactinfos_icon'    => 'fas fa-phone',
                        'contactinfos_text'     => __('(345) 456 789 23', 'domain-for-sale'),
                    ),
                ),
            ),
        )
    ));
    //
    // Create a section
    CSF::createSection($prefix, array(
        'title'  => __('Style Options', 'domain-for-sale'),
        'icon'  => 'fa fa-font',
        'fields' => array(
            array(
                'type'    => 'subheading',
                'content' => __('<a target="_blank" href="https://1.envato.market/LPeXVY">Upgrate pro</a> to unlock more template versions. Lifetime purchase. There is no monthly/yearly renewals requre.', 'domain-for-sale'),
            ),
            // Enable domain for sale mode
            array(
                'id'    => 'template_enable',
                'type'  => 'switcher',
                'title' => __('Enable Domain for sale', 'domain-for-sale'),
                'label' => __('Turn ON for enable domain for sale mode for your website.', 'domain-for-sale'),
                'default' => false,
            ),

            // Upload favicon
            array(
                'id'    => 'template_favicon',
                'type'  => 'upload',
                'title' => __('Upload favicon', 'domain-for-sale'),
                'lebel' => __('Use a 32x32 .ico or .png file.', 'domain-for-sale'),
            ),
            // Color scheme
            array(
                'id'          => 'template_scheme',
                'type'        => 'image_select',
                'title'       => __('Select color scheme', 'domain-for-sale'),
                'options'     => array(
                    '1'     => DFS_DIR_URL_image . 'color-1.png',
                    '2'     => DFS_DIR_URL_image . 'color-2.png',
                    '3'     => DFS_DIR_URL_image . 'color-3.png',
                    '4'     => DFS_DIR_URL_image . 'color-4.png',

                ),
                'default' => '1',
            ),

            array(
                'id'      => 'template_background',
                'type'    => 'background',
                'title'   => __('Body Background Image', 'domain-for-sale'),
                'background_color' => false,
                'default' => array(
                    'background-position'   => 'center center',
                    'background-repeat'     => 'repeat-x',
                    'background-attachment' => 'fixed',
                    'background-size'       => 'cover',
                    'background-image' => array(
                        'url'       =>  DFS_DIR_URL_image . 'templates-1.webp',
                    )
                )
            ),


            array(
                'id'      => 'template_overlay',
                'type'    => 'color',
                'title'   => __('Background Overlay', 'domain-for-sale'),
                'default' => 'rgba(0,0,0,0.7)',
            ),

            // Body Typography
            array(
                'id'               => 'template_body_typography',
                'type'             => 'typography',
                'title'            => __('Body Typography', 'domain-for-sale'),
                'output'  => 'body',
                'text_align'     => false,
                'text_transform' => false,
                'line_height'    => false,
                'letter_spacing' => false,
                'color'          => false,
                'subset'          => false,
                'default'          => array(
                    'font-family'    => 'Nunito',
                    'font-weight'    => '400',
                    'type'           => 'google',
                    'font-size'      => '16',
                    'line-height'    => '26',
                ),
            ),

            // Heading Typography
            array(
                'id'               => 'template_heading_typography',
                'type'             => 'typography',
                'title'            => __('Heading Typography', 'domain-for-sale'),
                'output'  => 'h1,h2,h3,h4,h5,h6,.h1, .h2, .h3, .h4, .h5, .h6',
                'text_align'     => false,
                'text_transform' => false,
                'line_height'    => false,
                'letter_spacing' => false,
                'color'          => false,
                'subset'          => false,
                'font_size'     => false,
                'line_height'   => false,
                'default'          => array(
                    'font-family'    => 'Poppins',
                    'font-weight'    => '700',
                    'type'           => 'google',
                ),
            ),
        )
    ));
}
