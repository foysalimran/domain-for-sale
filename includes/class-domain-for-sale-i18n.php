<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://themeatelier.net
 * @since      1.4.12
 *
 * @package    Domain_For_Sale
 * @subpackage Domain_For_Sale/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.4.12
 * @package    Domain_For_Sale
 * @subpackage Domain_For_Sale/includes
 * @author     ThemeAtelier <themeatelierbd@gmail.com>
 */
class Domain_For_Sale_i18n
{


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.4.12
	 */
	public function load_plugin_textdomain()
	{

		load_plugin_textdomain(
			'domain-for-sale',
			false,
			dirname(dirname(plugin_basename(__FILE__))) . '/languages/'
		);
	}
}
