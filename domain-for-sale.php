<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://themeatelier.net
 * @since             1.4.12
 * @package           Domain_For_Sale
 *
 * @wordpress-plugin
 * Plugin Name:       Domain For Sale
 * Plugin URI:        https://themeatelier.net/domain-for-sale
 * Description:       Creative and professional auction and domain for sale WordPress Plugin.
 * Version:           1.5.3
 * Author:            ThemeAtelier
 * Author URI:        https://themeatelier.net/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       domain-for-sale
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.4.12 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define('DOMAIN_FOR_SALE_VERSION', '1.5.3');
// Define constants for plugin directory URL.
if (!defined('DFS_DIR_URL'))
	define('DFS_DIR_URL', plugin_dir_url(__FILE__));
// Define constants for plugin directory path.
if (!defined('DFS_DIR_PATH'))
	define('DFS_DIR_PATH', plugin_dir_path(__FILE__));

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-domain-for-sale-activator.php
 */
function activate_domain_for_sale()
{
	require_once plugin_dir_path(__FILE__) . 'includes/class-domain-for-sale-activator.php';
	Domain_For_Sale_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-domain-for-sale-deactivator.php
 */
function deactivate_domain_for_sale()
{
	require_once plugin_dir_path(__FILE__) . 'includes/class-domain-for-sale-deactivator.php';
	Domain_For_Sale_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_domain_for_sale');
register_deactivation_hook(__FILE__, 'deactivate_domain_for_sale');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-domain-for-sale.php';


/**
 * Pro version check.
 *
 * @return boolean
 */
function is_domain_for_sale_pro_active()
{
	include_once ABSPATH . 'wp-admin/includes/plugin.php';
	if ((is_plugin_active('domain-for-sale-pro/domain-for-sale.php') || is_plugin_active_for_network('domain-for-sale-pro/domain-for-sale-pro.php'))) {
		return true;
	}
}

// Redirect to help page after active plugin
function dfs_activation_redirect($plugin)
{
	if ($plugin == plugin_basename(__FILE__) && !is_domain_for_sale_pro_active()) {
		exit(wp_redirect(admin_url('admin.php?page=domain-for-sale#tab=get-help')));
	}
}
add_action('activated_plugin', 'dfs_activation_redirect');


/**
 * Initialize the plugin tracker
 *
 * @return void
 */
function appsero_init_tracker_domain_for_sale()
{
	if (!class_exists('DfsAppSero\Client')) {
		require_once DFS_DIR_PATH . 'admin/appsero/Client.php';
	}
	$client = new DfsAppSero\Client('343a3d84-7b38-47f3-9225-10e5b28afaa4', 'Domain For Sale', __FILE__);
	// Active insights
	$client->insights()->init();
}
appsero_init_tracker_domain_for_sale();

// Plugin action link
add_filter('plugin_action_links_' . plugin_basename(__FILE__), 'dfs_settings_link');

function dfs_settings_link(array $links)
{
	$pro_url = "https://1.envato.market/LPeXVY";
	$pro_link = '<a target="_blank" style="color: #177764; font-weight: 700;" href="' . esc_url($pro_url) . '">' . esc_html__('Go Pro!', 'domain-for-sale') . '</a>';

	$settings_url = get_admin_url() . "admin.php?page=domain-for-sale";
	$settings_link = '<a href="' . esc_url($settings_url) . '">' . esc_html__('Settings', 'domain-for-sale') . '</a>';

	$links[] = $settings_link;
	$links[] = $pro_link;
	return $links;
}


/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.4.12
 */
function run_domain_for_sale()
{
	$plugin = new Domain_For_Sale();
	$plugin->run();
}
run_domain_for_sale();
