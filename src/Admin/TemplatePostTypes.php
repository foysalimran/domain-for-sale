<?php

namespace ThemeAtelier\DomainForSale\Admin;

if (!defined('ABSPATH')) {
	die;
} // Cannot access directly.

/**
 * Custom post class to register the carousel.
 */
class TemplatePostTypes
{

	/**
	 * The single instance of the class.
	 *
	 * @var self
	 * @since 2.2.0
	 */
	private static $instance;

	/**
	 * Path to the file.
	 *
	 * @since 2.2.0
	 *
	 * @var string
	 */
	public $file = __FILE__;

	/**
	 * Holds the base class object.
	 *
	 * @since 2.2.0
	 *
	 * @var object
	 */
	public $base;

	/**
	 * Allows for accessing single instance of class. Class should only be constructed once per call.
	 *
	 * @since 2.2.0
	 * @static
	 * @return self Main instance.
	 */
	public static function instance()
	{
		if (is_null(self::$instance)) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Domain For Sale post type
	 */
	public function register_domain_for_sale_post_type()
	{
		if (post_type_exists('dfs_template')) {
			return;
		}
		$capability =  domain_for_sale_dashboard_capability();
		// Set the Domain For Sale post type labels.
		$labels = apply_filters(
			'domain_for_sale_post_type_labels',
			array(
				'name'               => esc_html__('Templates', 'domain-for-sale'),
				'singular_name'      => esc_html__('Template', 'domain-for-sale'),
				'menu_name'          => esc_html__('Domain For Sale', 'domain-for-sale'),
				'all_items'          => esc_html__('All Templates', 'domain-for-sale'),
				'add_new'            => esc_html__('Add New', 'domain-for-sale'),
				'add_new_item'       => esc_html__('Create New Template', 'domain-for-sale'),
				'new_item'           => esc_html__('Create New Template', 'domain-for-sale'),
				'edit_item'          => esc_html__('Edit Created Template', 'domain-for-sale'),
				'view_item'          => esc_html__('View Created Template', 'domain-for-sale'),
				'name_admin_bar'     => esc_html__('Template Creator', 'domain-for-sale'),
				'search_items'       => esc_html__('Search Created Template', 'domain-for-sale'),
				'parent_item_colon'  => esc_html__('Parent Created Template:', 'domain-for-sale'),
				'not_found'          => esc_html__('No Template found.', 'domain-for-sale'),
				'not_found_in_trash' => esc_html__('No Template found in Trash.', 'domain-for-sale')
			)
		);

		$menu_icon      = 'dashicons-admin-site';

		$args      = apply_filters(
			'domain_for_sale_post_type_args',
			array(
				'label'           		=> esc_html__('DFS Template', 'domain-for-sale'),
				'description'     		=> esc_html__('DFS Template', 'domain-for-sale'),
				'public'          		=> false,
				'show_ui'         		=> true,
				'show_in_nav_menus' 	=> false,
				'menu_icon'       		=> $menu_icon,
				'hierarchical'    		=> false,
				'query_var'       		=> false,
				'publicly_queryable'	=> false,
				'menu_position'   		=> 5,
				'supports'        		=> array('title'),
				'capabilities'    		=> array(
					'publish_posts'       => $capability,
					'edit_posts'          => $capability,
					'edit_others_posts'   => $capability,
					'delete_posts'        => $capability,
					'delete_others_posts' => $capability,
					'read_private_posts'  => $capability,
					'edit_post'           => $capability,
					'delete_post'         => $capability,
					'read_post'           => $capability,
				),
				'capability_type' => 'post',
				'rewrite'         => true,
				'labels'          => $labels,
			)
		);

		register_post_type('dfs_template', $args);
	}
}
