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
 * Plugin URI:        https://wp-plugins.themeatelier.net/nilam
 * Description:       Creative and professional auction and domain for sale WordPress Plugin.
 * Version:           3.0.0
 * Author:            ThemeAtelier
 * Author URI:        https://themeatelier.net/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       domain-for-sale
 * Domain Path:       /languages
 */

// Block Direct access
if (!defined('ABSPATH')) {
    die('You should not access this file directly!.');
}
require_once __DIR__ . '/vendor/autoload.php';

use ThemeAtelier\DomainForSale\DomainForSale;

if(!defined('DOMAIN_FOR_SALE_VERSION')){
    define('DOMAIN_FOR_SALE_VERSION', '3.0.0');
}
if(!defined('DOMAIN_FOR_SALE_FILE')){
    define('DOMAIN_FOR_SALE_FILE', __FILE__);
}
if(!defined('DOMAIN_FOR_SALE_ALERT_MSG')){
    define('DOMAIN_FOR_SALE_ALERT_MSG', esc_html__('You should not access this file directly.!', 'domain-for-sale'));
}
if(!defined('DOMAIN_FOR_SALE_DIRNAME')){
    define('DOMAIN_FOR_SALE_DIRNAME', dirname(__FILE__));
}
if(!defined('DOMAIN_FOR_SALE_DIR_PATH')){
    define('DOMAIN_FOR_SALE_DIR_PATH', plugin_dir_path(__FILE__));
}
if(!defined('DOMAIN_FOR_SALE_DIR_URL')){
    define('DOMAIN_FOR_SALE_DIR_URL', plugin_dir_url(__FILE__));
}
if(!defined('DOMAIN_FOR_SALE_BASENAME')){
    define('DOMAIN_FOR_SALE_BASENAME', plugin_basename(__FILE__));
}


function domain_for_sale_run()
{
    // Launch the plugin.
    $domain_for_sale = new DomainForSale();
    $domain_for_sale->run();
    register_activation_hook(__FILE__, array($domain_for_sale, 'dfs_plugin_activate'));
}

include_once ABSPATH . 'wp-admin/includes/plugin.php';
$pro_plugin_slug = 'domain-for-sale-pro/domain-for-sale-pro.php';
// kick-off the plugin
if (!is_plugin_active($pro_plugin_slug)) {
   domain_for_sale_run();
}

/**
 * Initialize the plugin tracker
 *
 * @return void
 */
function appsero_init_tracker_domain_for_sale()
{
    if (!class_exists('DfsAppSero\Client')) {
        require_once DOMAIN_FOR_SALE_DIR_PATH . 'src/Admin/appsero/Client.php';
    }
    $client = new DfsAppSero\Client('343a3d84-7b38-47f3-9225-10e5b28afaa4', 'Domain For Sale', __FILE__);
    // Active insights
    $client->insights()->init();
}
appsero_init_tracker_domain_for_sale();
