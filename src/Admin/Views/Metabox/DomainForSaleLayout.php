<?php

namespace ThemeAtelier\DomainForSale\Admin\Views\Metabox;

use ThemeAtelier\DomainForSale\Admin\Framework\Classes\DOMAIN_FOR_SALE;

if (!defined('ABSPATH')) {
	die;
} // Cannot access directly.

/**
 * The Layout building class.
 */
class DomainForSaleLayout
{

	/**
	 * Layout metabox section.
	 *
	 * @param string $prefix The metabox key.
	 * @return void
	 */
	public static function section($prefix)
	{
		DOMAIN_FOR_SALE::createSection(
			$prefix,
			array(
				'fields' => array(
					array(
						'type'  => 'metabox_branding',
						'image' => DOMAIN_FOR_SALE_DIR_URL . 'src/Admin/assets/img/dfs-logo.svg',
						'after' => '<i class="icofont-life-ring"></i> Support',
						'link'  => 'https://themeatelier.net/',
						'class' => 'domain-for-sale-admin-header',
					),

					array(
						'id'      => 'dfs_layout_preset',
						'type'    => 'layout_preset',
						'title'   => esc_html__('Layout Preset', 'domain-for-sale'),
						'class'   => 'domain-for-sale-layout-preset',
						'options' => array(
							'layout_01'      => array(
								'image' => DOMAIN_FOR_SALE_DIR_URL . 'src/assets/images/version-1.png',
								'text'  => esc_html__('Layout 01', 'domain-for-sale'),
								'option_demo_url'  => 'https://wp-plugins.themeatelier.net/nilam/',
							),
							'layout_02'  => array(
								'image' => DOMAIN_FOR_SALE_DIR_URL . 'src/assets/images/version-2.png',
								'text'  => esc_html__('Layout 02', 'domain-for-sale'),
								'option_demo_url'  => 'https://wp-plugins.themeatelier.net/nilam/',
							),
						),
						'default' => 'layout_01',
					),
				),
			)
		);
	}
}
