<?php

namespace ThemeAtelier\DomainForSale\Admin\Views;

use ThemeAtelier\DomainForSale\Admin\Views\Metabox\DomainForSaleLayout;
use ThemeAtelier\DomainForSale\Admin\Views\Metabox\DomainForSaleMainOptions;
use ThemeAtelier\DomainForSale\Admin\Views\Metabox\DomainForSaleContactForm;
use ThemeAtelier\DomainForSale\Admin\Views\Metabox\DomainForSaleTypography;
use ThemeAtelier\DomainForSale\Admin\Views\Metabox\DomainForSaleShortcode;
use ThemeAtelier\DomainForSale\Admin\Views\Metabox\DomainForSaleTemplateOptions;
use ThemeAtelier\DomainForSale\Admin\Framework\Classes\DOMAIN_FOR_SALE;

if (!defined('ABSPATH')) {
    die;
} // Cannot access directly.

class DomainForSaleMetaboxes
{
    /**
     * Layout Metabox function.
     *
     * @param string $prefix The meta-key for this metabox.
     * @return void
     */
    public static function layout_metabox($prefix)
    {
        DOMAIN_FOR_SALE::createMetabox(
            $prefix,
            array(
                'title'        => esc_html__('Domain For Sale', 'domain-for-sale'),
                'post_type'    => 'dfs_template',
                'show_restore' => false,
                'context'      => 'normal',
            )
        );

        DomainForSaleLayout::section($prefix);
    }

    /**
	 * Option Metabox function
	 *
	 * @param string $prefix The metabox key.
	 * @return void
	 */
	public static function option_metabox($prefix)
	{
		DOMAIN_FOR_SALE::createMetabox(
			$prefix,
			array(
				'title'        	=> esc_html__('View Options', 'domain-for-sale'),
				'post_type'    	=> 'dfs_template',
				'show_restore' 	=> false,
				'nav'        	=> 'inline',
				'theme'        	=> 'light',
			)
		);

		DomainForSaleMainOptions::options($prefix);
		DomainForSaleTemplateOptions::options($prefix);
		DomainForSaleContactForm::options($prefix);
		DomainForSaleTypography::options($prefix);
	}

    /**
	 * Shortcode Metabox function
	 *
	 * @param string $prefix The metabox key.
	 * @return void
	 */
	public static function shortcode_metabox( $prefix ) {
		DOMAIN_FOR_SALE::createMetabox(
			$prefix,
			array(
				'title'        => esc_html__( 'Domain For Sale', 'domain-for-sale' ),
				'post_type'    => 'dfs_template',
				'context'      => 'side',
				'show_restore' => false,
			)
		);

		DomainForSaleShortcode::section( $prefix );

	}
}
