<?php

/**
 * The main class for Settings configurations.
 *
 * @package domain-for-sale
 * @subpackage domain-for-sale/src/Admin/Views
 */

namespace ThemeAtelier\DomainForSale\Admin\Views;

use ThemeAtelier\DomainForSale\Admin\Views\Settings\DomainForSaleGeneral;
use ThemeAtelier\DomainForSale\Admin\Views\Settings\DomainForSaleForm;
use ThemeAtelier\DomainForSale\Admin\Views\Settings\DomainForSaleCustomCodes;
use ThemeAtelier\DomainForSale\Admin\Views\Settings\DomainForSaleBackup;
use ThemeAtelier\DomainForSale\Admin\Framework\Classes\DOMAIN_FOR_SALE;

if (! defined('ABSPATH')) {
	die;
} // Cannot access pages directly.

/**
 * Settings.
 */
class DomainForSaleSettings
{
	/**
	 * Create a settings page.
	 *
	 * @param string $prefix The settings.
	 * @return void
	 */
	public static function settings($prefix)
	{
		$capability = domain_for_sale_dashboard_capability();
		DOMAIN_FOR_SALE::createOptions(
			$prefix,
			array(
				'menu_title'       => esc_html__('Global Settings', 'domain-for-sale'),
				'menu_type'        => 'submenu', // menu, submenu, options, theme, etc.
				'menu_slug'        => 'domain-for-sale-settings',
				'theme'            => 'light',
				'show_all_options' => false,
				'show_search'      => false,
				'show_footer'      => false,
				'show_bar_menu'    => false,
				'class'            => 'dfs-settings',
                'nav'        	   => 'inline',
				'framework_title'  => esc_html__('Domain For Sale Settings', 'domain-for-sale'),
				'menu_capability'  => $capability,
			)
		);
        DomainForSaleGeneral::section($prefix);
        DomainForSaleForm::section($prefix);
        DomainForSaleCustomCodes::section($prefix);
        DomainForSaleBackup::section($prefix);
	}
}
