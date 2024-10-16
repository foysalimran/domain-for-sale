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
use ThemeAtelier\DomainForSale\Admin\TemplatePostTypes;
use ThemeAtelier\DomainForSale\Frontend\Frontend;
use ThemeAtelier\DomainForSale\Frontend\ContactShortcode;
use ThemeAtelier\DomainForSale\Helpers\ThemeSupport;

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
        $this->define_common_hooks();
        add_action('plugins_loaded', array($this, 'domain_for_sale_load_textdomain'));
        add_action('plugin_loaded', array($this, 'init_plugin'));
        add_action('activated_plugin', array($this, 'activated'));

        $active_plugins = get_option('active_plugins');
        foreach ($active_plugins as $active_plugin) {
            $_temp = strpos($active_plugin, 'domain-for-sale.php');
            if (false != $_temp) {
                add_filter('plugin_action_links_' . $active_plugin, array($this, 'DOMAIN_FOR_SALE_plugin_action_links'));
            }
        }
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
        load_plugin_textdomain('domain-for-sale', false, DOMAIN_FOR_SALE_DIRNAME . "/languages");
    }

    /**
     * Define the constants
     *
     * @return void
     */
    public function define_constants()
    {
        if (!defined('DOMAIN_FOR_SALE_URL')) {
            define('DOMAIN_FOR_SALE_URL', plugins_url('', DOMAIN_FOR_SALE_FILE));
        }
        if (!defined('DOMAIN_FOR_SALE_ASSETS')) {
            define('DOMAIN_FOR_SALE_ASSETS', DOMAIN_FOR_SALE_URL . '/src/assets/');
        }
        if (!defined('DOMAIN_FOR_SALE_ADMIN')) {
            define('DOMAIN_FOR_SALE_ADMIN', DOMAIN_FOR_SALE_URL . '/src/Admin');
        }
    }

    public function activated($plugin)
    {
        if (DOMAIN_FOR_SALE_BASENAME === $plugin) {
            $redirect_url = esc_url(admin_url('edit.php?post_type=dfs_template'));
            exit(wp_kses_post(wp_safe_redirect($redirect_url)));
        }
    }

    public function dfs_plugin_activate()
    {
        $existing_posts = new \WP_Query(array(
            'post_type' => 'dfs_template',
            'posts_per_page' => 1,
        ));

        // If no posts exist, create the default post
        if (!$existing_posts->have_posts()) {
            $post_data = array(
                'post_title'    => esc_html__('Layout', 'domain-for-sale'),
                'post_status'   => 'publish',
                'post_type'     => 'dfs_template',

            );

            $post_id = wp_insert_post($post_data);

            if (! is_wp_error($post_id)) {
                // Meta values to insert under 'dfs_template_options'
                $template_options = array(
                    'dfs_apply_on' => 'shortcode',
                    'dfs_specific_page' => '',
                    'dfs_color_scheme_type' => 'pre_defined',
                    'dfs-scheme' => 1,
                    'dfs_custom_scheme' => array(
                        'primary' => '#1abc9c',
                        'secondary' => '#199e83',
                    ),
                    'dfs_container_width' => 1140,
                    'dfs_gap' => 30,
                    'dfs-background' => array(
                        'background-image' => array(
                            'url' => '',
                            'id' => '',
                            'width' => '',
                            'height' => '',
                            'thumbnail' => '',
                            'alt' => '',
                            'title' => '',
                            'description' => '',
                        ),
                        'background-position' => 'center center',
                        'background-repeat' => 'repeat-x',
                        'background-attachment' => 'fixed',
                        'background-size' => 'cover',
                    ),
                    'dfs-overlay' => 'rgba(0,0,0,0.7)',
                    'dfs-pricetag' => 'Price $200 Only',
                    'dfs-domainname' => get_site_url(),
                    'dfs-saletitle' => 'is for sale',
                    'dfs-content' => 'The domain name (without content) is available for sale by its owner. Any offer you submit is binding for 7 days. If you require further information, contact me.',
                    'dfs-contacttitle' => 'Contact Info:',
                    'dfs-contactinfos' => array(
                        array(
                            'contactinfos-icon' => 'icofont-envelope',
                            'contactinfos-text' => get_option('admin_email'),
                        ),
                        array(
                            'contactinfos-icon' => 'icofont-phone',
                            'contactinfos-text' => '(345) 456 789 23',
                        ),
                    ),
                    'dfs-moredomainTitle' => 'More Domains',
                    'dfs-moredomains' => array(
                        array(
                            'moredomains-title' => 'www.firstdomain.com',
                            'moredomains-link' => array(
                                'url' => '',
                                'text' => '',
                                'target' => '',
                            ),
                            'moredomains-content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum nihil consequatur aspernatur ipsum facere neque distinctio fugit voluptatum laborum odit eveniet saepe culpa sit dolor ea fugiat officiis, debitis magni.',
                        ),
                        array(
                            'moredomains-title' => 'www.seconddomain.com',
                            'moredomains-link' => array(
                                'url' => '',
                                'text' => '',
                                'target' => '',
                            ),
                            'moredomains-content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum nihil consequatur aspernatur ipsum facere neque distinctio fugit voluptatum laborum odit eveniet saepe culpa sit dolor ea fugiat officiis, debitis magni.',
                        ),
                        array(
                            'moredomains-title' => 'www.thirddomain.com',
                            'moredomains-link' => array(
                                'url' => '',
                                'text' => '',
                                'target' => '',
                            ),
                            'moredomains-content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum nihil consequatur aspernatur ipsum facere neque distinctio fugit voluptatum laborum odit eveniet saepe culpa sit dolor ea fugiat officiis, debitis magni.',
                        ),
                    ),
                    'dfs_form_type' => 'dfs_form',
                    'dfs-formtitle' => 'Make an Offer',
                    'dfs-thirdparty_shortcode' => '',
                    'dfs_body_typography' => array(
                        'font-family' => 'Nunito',
                        'font-weight' => '400',
                        'font-style' => '',
                        'text-transform' => '',
                        'font-size' => '16',
                        'line-height' => '20',
                        'tablet-font-size' => '16',
                        'tablet-line-height' => '',
                        'mobile-font-size' => '16',
                        'mobile-line-height' => '',
                        'type' => 'google',
                        'unit' => 'px',
                    ),
                    'dfs_domain_name' => array(
                        'font-family' => 'Poppins',
                        'font-weight' => '700',
                        'font-style' => '',
                        'text-transform' => '',
                        'font-size' => '48',
                        'line-height' => '48',
                        'tablet-font-size' => '42',
                        'tablet-line-height' => '',
                        'mobile-font-size' => '38',
                        'mobile-line-height' => '',
                        'color' => '',
                        'type' => 'google',
                        'unit' => 'px',
                    ),
                    'dfs_sale_title' => array(
                        'font-family' => 'Poppins',
                        'font-weight' => '700',
                        'font-style' => '',
                        'text-transform' => '',
                        'font-size' => '38',
                        'line-height' => '38',
                        'tablet-font-size' => '32',
                        'tablet-line-height' => '',
                        'mobile-font-size' => '30',
                        'mobile-line-height' => '',
                        'color' => '#ffffff',
                        'type' => 'google',
                        'unit' => 'px',
                    ),
                    'dfs_form_title' => array(
                        'font-family' => 'Poppins',
                        'font-weight' => '700',
                        'font-style' => '',
                        'text-transform' => '',
                        'font-size' => '32',
                        'line-height' => '30',
                        'tablet-font-size' => '28',
                        'tablet-line-height' => '',
                        'mobile-font-size' => '',
                        'mobile-line-height' => '',
                        'color' => '#000',
                        'type' => 'google',
                        'unit' => 'px',
                    ),
                    'dfs_recommendation_title' => array(
                        'font-family' => 'Poppins',
                        'font-weight' => '700',
                        'font-style' => '',
                        'text-transform' => '',
                        'font-size' => '28',
                        'line-height' => '24',
                        'tablet-font-size' => '20',
                        'tablet-line-height' => '',
                        'mobile-font-size' => '',
                        'mobile-line-height' => '',
                        'color' => '#000',
                        'type' => 'google',
                        'unit' => 'px',
                    ),
                    'dfs_recommendation_domain_name' => array(
                        'font-family' => 'Poppins',
                        'font-weight' => '700',
                        'font-style' => '',
                        'text-transform' => '',
                        'font-size' => '24',
                        'line-height' => '20',
                        'tablet-font-size' => '22',
                        'tablet-line-height' => '',
                        'mobile-font-size' => '',
                        'mobile-line-height' => '',
                        'color' => '#000',
                        'hover_color' => '',
                        'type' => 'google',
                        'unit' => 'px',
                    ),
                );

                $layout_template = array(
                    'dfs_layout_preset' => 'layout_01',
                );

                // Save all the meta values under the 'dfs_template_options' meta key
                update_post_meta($post_id, 'dfs_layouts', $layout_template);
                update_post_meta($post_id, 'dfs_template_options', $template_options);
            }
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
        $plugin_public = new Frontend();
        $contact_shortcode = new ContactShortcode();
        $plugin_helpers = new Helpers();
        $theme_support = new ThemeSupport();
        $this->loader->add_action('wp_loaded', $plugin_helpers, 'register_all_scripts');
        $this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_styles');
        $this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_scripts');
        $this->loader->add_shortcode('dfs_contact_form', $contact_shortcode, 'dfs_shortcode');

        $this->loader->add_action('wp_loaded', $theme_support, 'theme_support');
    }

    /**
     * Register common hooks.
     *
     * @since 1.0.0
     * @access private
     */
    private function define_common_hooks()
    {
        $common_hooks = new TemplatePostTypes();
        $this->loader->add_action('init', $common_hooks, 'register_domain_for_sale_post_type', 10);
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
        $plugin_helpers = new Helpers();
        $this->loader->add_action('wp_loaded', $plugin_helpers, 'register_all_scripts');
        $this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_styles');
        $this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts');

        $this->loader->add_filter('manage_dfs_template_posts_columns', $plugin_admin, 'filter_domain_for_sale_admin_column');
        $this->loader->add_action('manage_dfs_template_posts_custom_column', $plugin_admin, 'display_domain_for_sale_admin_fields', 10, 2);
    }

    // Plugin settings in plugin list
    public function domain_for_sale_action_links(array $links, $file)
    {

        if (DOMAIN_FOR_SALE_BASENAME === $file) {
            $ui_links        = array(
                sprintf('<a href="%s">%s</a>', admin_url('admin.php?page=domain-for-sale#tab=general'), __('Settings', 'domain-for-sale')),
            );
            $links['go_pro'] = sprintf('<a target="_blank" href="%s" style="%s">%s</a>', 'https://1.envato.market/LPeXVY', 'color:#35b747;font-weight:bold', __('Go Pro!', 'domain-for-sale'));
            return array_merge($ui_links, $links);
        }
        return $links;
    }
}
