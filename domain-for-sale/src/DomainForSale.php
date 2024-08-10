<?php

/**
 * The file of the DomainForSale class.
 *
 * @link       https://themeatelier.net
 * @since      1.0.0
 *
 * @package DomainForSale
 */

namespace ThemeAtelier\DomainForSale;

use ThemeAtelier\DomainForSale\Loader;
use ThemeAtelier\DomainForSale\Helpers\Helpers;
use ThemeAtelier\DomainForSale\Admin\Admin;
use ThemeAtelier\DomainForSale\Frontend\Frontend;
use ThemeAtelier\DomainForSale\Frontend\ContactShortcode;

// don't call the file directly.
if (!defined('ABSPATH')) {
    exit;
}

/**
 * The main class of the plugin.
 *
 * Handle all the class and methods of the plugin.
 *
 * @author     ThemeAtelier <themeatelierbd@gmail.com>
 */
class DomainForSale
{
    /**
     * Plugin version
     *
     * @since    1.0.0
     * @access   protected
     * @var string
     */
    protected $version;

    /**
     * Plugin slug
     *
     * @since    1.0.0
     * @access   protected
     * @var string
     */
    protected $plugin_slug;

    /**
     * Main Loader.
     *
     * The loader that's responsible for maintaining and registering all hooks that empowers
     * the plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var object
     */
    protected $loader;
    /**
     * Constructor for the DomainForSale class.
     *
     * Sets up all the appropriate hooks and actions within the plugin.
     */
    public function __construct()
    {
        $this->version     = DOMAIN_FOR_SALE_VERSION;
        $this->plugin_slug = 'domain-for-sale';
        $this->load_dependencies();
        $this->define_constants();
        $this->define_admin_hooks();
        $this->define_public_hooks();
        add_action('plugins_loaded', array($this, 'domain_for_sale_load_textdomain'));
        add_action('plugin_loaded', array($this, 'init_plugin'));
        add_action('activated_plugin', array($this, 'redirect_to'));
        $active_plugins = get_option('active_plugins');
        foreach ($active_plugins as $active_plugin) {
            $_temp = strpos($active_plugin, 'domain-for-sale.php');
            if (false != $_temp) {
                add_filter('plugin_action_links_' . $active_plugin, array($this, 'domain_for_sale_action_links'));
            }
        }
        add_action('template_redirect', array($this, 'domina_domain_for_sale'));
    }

    /**
     * Run the loader to execute all of the hooks with WordPress.
     *
     * @since    1.0.0
     */
    public function run()
    {
        $this->loader->run();
    }

    /**
     * The slug of the plugin used to uniquely identify it within the context of
     * WordPress and to define internationalization functionality.
     *
     * @since     1.0.0
     * @return    string    The name of the plugin.
     */
    public function get_plugin_slug()
    {
        return $this->plugin_slug;
    }

    /**
     * Retrieve the version number of the plugin.
     *
     * @since     1.0.0
     * @return    string    The version number of the plugin.
     */
    public function get_version()
    {
        return $this->version;
    }

    // load text domain from plugin folder
    function domain_for_sale_load_textdomain()
    {
        load_plugin_textdomain('', false, DOMAIN_FOR_SALE_DIRNAME . "/languages");
    }

    /**
     * Define the constants
     *
     * @return void
     */
    public function define_constants()
    {
        if(!defined('DOMAIN_FOR_SALE_URL')){
            define('DOMAIN_FOR_SALE_URL', plugins_url('', DOMAIN_FOR_SALE_FILE));
        }
        if(!defined('DOMAIN_FOR_SALE_ASSETS')){
            define('DOMAIN_FOR_SALE_ASSETS', DOMAIN_FOR_SALE_URL . '/src/assets/');
        }
        if(!defined('DOMAIN_FOR_SALE_ADMIN')){
            define('DOMAIN_FOR_SALE_ADMIN', DOMAIN_FOR_SALE_URL . '/src/Admin');
        }
    }

    public function redirect_to($plugin)
    {
        if (DOMAIN_FOR_SALE_BASENAME === $plugin) {
            $redirect_url = esc_url(admin_url('admin.php?page=domain-for-sale'));
            exit(wp_kses_post(wp_safe_redirect($redirect_url)));
        }
    }

    /**
     * Load the plugin after all plugins are loaded.
     *
     * @return void
     */
    public function init_plugin()
    {
        do_action('DOMAIN_FOR_SALE_loaded');
    }

    /**
     * Load the required dependencies for this plugin.
     *
     * Include the following files that make up the plugin:
     *
     * - Loader. Orchestrates the hooks of the plugin.
     * - Teamproi18n. Defines internationalization functionality.
     * - Admin. Defines all hooks for the admin area.
     * - Frontend. Defines all hooks for the public side of the site.
     *
     * Create an instance of the loader which will be used to register the hooks
     * with WordPress.
     *
     * @since    1.0.0
     * @access   private
     */
    private function load_dependencies()
    {
        /**
         * The class responsible for orchestrating the actions and filters of the
         * core plugin.
         */
        $this->loader = new Loader();
    }

    /**
     * Register all of the hooks related to the public-facing functionality
     * of the plugin.
     *
     * @since    1.0.0
     * @access   private
     */
    private function define_public_hooks()
    {
        $plugin_public = new Frontend($this->get_plugin_slug(), $this->get_version());
        $contact_shortcode = new ContactShortcode();
        $plugin_helpers = new Helpers($this->get_plugin_slug(), $this->get_version());
        $this->loader->add_action('wp_loaded', $plugin_helpers, 'register_all_scripts');
        $this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_scripts');
        $this->loader->add_shortcode('dfs_contact_form', $contact_shortcode, 'dfs_shortcode');
    }

    /**
     * Register all of the hooks related to the admin dashboard functionality
     * of the plugin.
     *
     * @since    1.0.0
     * @access   private
     */
    private function define_admin_hooks()
    {
        $plugin_admin = new Admin($this->get_plugin_slug(), $this->get_version());
        $plugin_helpers = new Helpers($this->get_plugin_slug(), $this->get_version());
        $this->loader->add_action('wp_loaded', $plugin_helpers, 'register_all_scripts');
        $this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts');
    }

    // Plugin settings in plugin list
    public function domain_for_sale_action_links(array $links)
    {
        $url = get_admin_url() . "admin.php?page=domain-for-sale#tab=general";
        $settings_link = '<a href="' . esc_url($url) . '">' . esc_html__('Settings', 'domain-for-sale') . '</a>';
        $links[] = $settings_link;
        return $links;
    }

    /********************
	    - Front end -
     ********************/
    function domina_domain_for_sale()
    {
        $options = get_option('dfs-opt');
        if ($options['dfs-enable']) {
            include(DOMAIN_FOR_SALE_DIR_PATH . 'src/Frontend/templates/index.php');
            die();
        };
    }
}
