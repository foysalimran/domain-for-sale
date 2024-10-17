<?php

namespace ThemeAtelier\DomainForSale\Admin\Views\Metabox;

use ThemeAtelier\DomainForSale\Admin\Framework\Classes\DOMAIN_FOR_SALE;

if (!defined('ABSPATH')) {
	die;
} // Cannot access directly.

/**
 * The Shortcode display class.
 */
class DomainForSaleShortcode
{
	/**
	 * Shortcode display metabox section.
	 *
	 * @param string $prefix The metabox key.
	 * @return void
	 */
	public static function section($prefix)
	{
		if (isset($_GET['post'])) {
			DOMAIN_FOR_SALE::createSection(
				$prefix,
				array(
					'fields' => array(
						array(
							'type'  => 'shortcode',
							'class' => 'domain-for-sale-admin-sidebar',
						),
					),
				)
			);
		}
	}
}
