<?php
/*
Plugin Name: 	Domain For Sale
Plugin URI: 	https://www.themeatelier.net
Description: 	Creative and professional auction and domain for sale WordPress Plugin.
Author: 		ThemeAtelier
Version: 		1.4.9
Author URI: 	https://themeatelier.net
Requirements:   PHP 5.4 or above, WordPress 5.0 or above.
License:     GPL-2.0+
Text Domain:  ta-dfs
Domain Path:  /languages
*/

// Block Direct access
if (!defined('ABSPATH')) {
    die('You should not access this file directly!.');
}

// Define Constants for direct access alert message.
if (!defined('DFS_ALERT_MSG'))
    define('DFS_ALERT_MSG', esc_html__('You should not access this file directly.!', 'ta-dfs'));

// Define constants for plugin directory path.
if (!defined('DFS_DIR_PATH'))
    define('DFS_DIR_PATH', plugin_dir_path(__FILE__));

// Define constants for plugin directory URL.
if (!defined('DFS_DIR_URL'))
    define('DFS_DIR_URL', plugin_dir_url(__FILE__));

// load text domain from plugin folder
function dfs_load_textdomain()
{
    load_plugin_textdomain('', false, dirname(__FILE__) . "/languages");
}
add_action("plugins_loaded", 'dfs_load_textdomain');

// Plugin settings in plugin list
add_filter('plugin_action_links_' . plugin_basename(__FILE__), 'dfs_settings_link');
function dfs_settings_link(array $links)
{
    $url = get_admin_url() . "admin.php?page=dfs";
    $settings_link = '<a href="' . esc_url($url) . '">' . esc_html__('Settings', 'ta-dfs') . '</a>';
    $links[] = $settings_link;
    return $links;
}


// Pro version link
add_filter('plugin_action_links_' . plugin_basename(__FILE__), 'ta_dfs_pro_link');
function ta_dfs_pro_link(array $links)
{
    $url = "https://1.envato.market/LPeXVY";
    $settings_link = '<a target="_blank" style="color: #177764; font-weight: 700;" href="' . esc_url($url) . '">' . esc_html__('Go Pro!', 'ta-dfs') . '</a>';
    $links[] = $settings_link;
    return $links;
}


// Script enqueue class include
require_once DFS_DIR_PATH . 'inc/functions.php';
// include framework for admin panel
require_once DFS_DIR_PATH . 'admin/codestar-framework.php';
require_once DFS_DIR_PATH . 'inc/dfs-plugin-options.php';
require_once DFS_DIR_PATH . 'inc/contact-form-shortcode.php';

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

/********************
	    - Front end -
 ********************/
add_action('template_redirect', 'domina_domain_for_sale');
function domina_domain_for_sale()
{
    $options = get_option('dfs-opt');
    if ($options['dfs-enable']) {
        include(DFS_DIR_PATH . 'templates/index.php');
        die();
    };
}
