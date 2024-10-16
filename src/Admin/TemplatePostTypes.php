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

		$menu_icon      = 'data:image/svg+xml;base64,' . base64_encode(
			'<?xml version="1.0" encoding="iso-8859-1"?><svg fill="#A0A5AA" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 472.615 472.615" xml:space="preserve">
<g><g><polygon points="147.25,194.145 133.221,241.875 125.577,217.596 106.788,217.606 99.154,241.875 85.115,194.145 66.231,199.702 89.384,278.471 108.221,278.644 116.183,253.337 124.154,278.654 142.991,278.471 166.134,199.702"/></g></g><g><g><polygon points="267.375,194.145 253.346,241.875 245.702,217.596 226.913,217.596 219.269,241.875 205.24,194.145 186.356,199.702 209.499,278.471 228.336,278.654 236.308,253.337 244.279,278.654 263.116,278.471 286.259,199.702"/></g></g><g><g><polygon points="387.5,194.145 373.461,241.875 365.827,217.606 347.038,217.596 339.394,241.875 325.365,194.145 306.481,199.702 329.624,278.471 348.461,278.654 356.433,253.337 364.394,278.644 383.231,278.471 406.384,199.702"/></g></g><g><g><path d="M441.692,167.385c-9.361-27.847-24.473-53.592-44.195-75.521c-14.009,13.152-29.357,24.377-45.723,33.598 c3.864,13.214,7.028,27.238,9.471,41.923h-19.951c-1.998-11.459-4.451-22.437-7.33-32.884 c-27.338,12.442-57.012,19.574-87.81,20.825v12.06h-19.692v-12.06c-30.798-1.25-60.472-8.383-87.81-20.825 c-2.879,10.447-5.333,21.425-7.33,32.884H111.37c2.443-14.685,5.607-28.709,9.471-41.923c-16.365-9.221-31.713-20.448-45.723-33.6 c-19.735,21.941-34.839,47.687-44.195,75.523H0v137.846h472.615V167.385H441.692z M452.923,285.538H19.692v-98.462h433.231 V285.538z"/></g></g><g><g><path d="M345.502,366.491c-11.776,32.32-27.769,58.784-46.437,77.199c31.25-9.421,59.896-26.088,84.31-48.853 C371.67,383.921,359.005,374.433,345.502,366.491z"/></g></g><g><g><path d="M246.154,305.241v12.051c30.795,1.25,60.47,8.387,87.809,20.832c2.878-10.446,5.333-21.424,7.33-32.883H246.154z"/></g></g><g><g><path d="M361.243,305.241c-2.443,14.686-5.607,28.709-9.472,41.923c16.365,9.221,31.714,20.448,45.725,33.599c19.733-21.95,34.83-47.693,44.196-75.522H361.243z"/></g></g><g><g><path d="M111.371,305.241H30.923c9.369,27.836,24.473,53.587,44.199,75.519c14.01-13.151,29.356-24.375,45.72-33.595C116.978,333.95,113.814,319.927,111.371,305.241z"/></g></g><g><g><path d="M127.113,366.491c-13.502,7.942-26.166,17.428-37.867,28.341c24.416,22.768,53.059,39.434,84.3,48.854C154.879,425.273,138.885,398.809,127.113,366.491z"/></g></g><g><g><path d="M131.321,305.241c1.999,11.459,4.451,22.437,7.33,32.883c27.34-12.445,57.015-19.582,87.81-20.832v-12.051H131.321z"/></g></g><g><g><path d="M144.542,357.315c18.513,53.226,48.514,88.794,81.92,94.692V337.226C197.665,338.509,169.987,345.357,144.542,357.315z"/></g></g><g><g><path d="M246.154,337.226v114.782c33.41-5.897,63.409-41.463,81.92-94.692C302.628,345.357,274.95,338.509,246.154,337.226z"/></g></g><g><g><path d="M89.24,77.789c11.704,10.913,24.369,20.396,37.872,28.34c11.774-32.321,27.769-58.784,46.436-77.2 C142.299,38.351,113.653,55.019,89.24,77.789z"/></g></g><g><g><path d="M299.067,28.929c18.666,18.413,34.661,44.879,46.435,77.2c13.503-7.944,26.168-17.427,37.872-28.34 C358.962,55.019,330.316,38.351,299.067,28.929z"/></g></g><g><g><path d="M246.154,20.608V135.39c28.798-1.282,56.475-8.131,81.919-20.086C309.561,62.073,279.56,26.508,246.154,20.608z"/></g></g><g><g><path d="M144.542,115.303c25.443,11.955,53.121,18.804,81.919,20.086V20.608C193.055,26.508,163.054,62.073,144.542,115.303z"/></g></g></svg>'
		);

		$args      = apply_filters(
			'domain_for_sale_post_type_args',
			array(
				'label'           	=> esc_html__('DFS Template', 'domain-for-sale'),
				'description'     	=> esc_html__('DFS Template', 'domain-for-sale'),
				'public'          	=> false,
				'show_ui'         	=> true,
				'show_in_nav_menus' => false,
				'menu_icon'       	=> $menu_icon,
				'hierarchical'    	=> false,
				'query_var'       	=> false,
				'publicly_queryable' => false,
				'menu_position'   	=> 5,
				'supports'        	=> array('title'),
				'capabilities'    	=> array(
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
