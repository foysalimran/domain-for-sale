<?php

/**
 * The admin-facing functionality of the plugin.
 *
 * @link       https://themeatelier.net
 * @since      1.0.0
 *
 * @package domain-for-sale
 * @subpackage domain-for-sale/src/Admin
 * @author     ThemeAtelier<themeatelierbd@gmail.com>
 */

namespace ThemeAtelier\DomainForSale\Admin;

use ThemeAtelier\DomainForSale\Admin\Views\DomainForSaleOptions;

/**
 * The admin class
 */
class Admin
{
    /**
     * The slug of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $plugin_slug   The slug of this plugin.
     */
    private $plugin_slug;

    /**
     * The min of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $min   The slug of this plugin.
     */
    private $min;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $version    The current version of this plugin.
     */
    private $version;

    /**
     * The class constructor.
     *
     * @param string $plugin_slug The slug of the plugin.
     * @param string $version Current version of the plugin.
     */
    function __construct($plugin_slug, $version)
    {
        $this->plugin_slug = $plugin_slug;
        $this->version     = $version;
        $this->min         = defined('WP_DEBUG') && WP_DEBUG ? '' : '.min';
        DomainForSaleOptions::options('dfs-opt');
        add_action('admin_menu', array($this, 'add_plugin_page'));
    }

    /**
     * Register the stylesheets for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public static function enqueue_scripts($hook)
    {
        wp_enqueue_style('help');   
    }

    public function add_plugin_page()
    {
        // This page will be under "Settings"
        add_menu_page(
            esc_html__('Domain For Sale', 'domain-for-sale'),
            esc_html__('Domain For Sale', 'domain-for-sale'),
            'manage_options',
            'domain-for-sale',
            array($this, 'domain_for_sale_settings'),
            'dashicons-admin-site',
            6
        );

        // Greet Bubble Settings Page.
        add_submenu_page(
            'domain-for-sale',
            esc_html__('Settings', 'domain-for-sale'),
            esc_html__('Settings', 'domain-for-sale'),
            'manage_options',
            'domain-for-sale',
            array($this, 'domain_for_sale_settings')
        );

        // Greet Bubble Settings Page.
        add_submenu_page(
            'domain-for-sale',
            esc_html__('Help', 'domain-for-sale'),
            esc_html__('Help', 'domain-for-sale'),
            'manage_options',
            'help',
            array($this, 'domain_for_sale_help')
        );

        add_submenu_page('domain-for-sale', __('👑 Upgrade to Pro!', 'domain-for-sale'), sprintf('<span class="domain-for-sale-pro-text">%s</span>', __('👑 Upgrade to Pro!', 'domain-for-sale')), 'manage_options', 'https://1.envato.market/LPeXVY');
    }

    /**
     * Options page callback
     */
    public function domain_for_sale_settings() {}

    // Help page callbacks
    public function domain_for_sale_help() {
   
        ?>
<div class="wrap">
    <div class="domain-for-sale-help-wrapper">
      <div class="domain-for-sale__help--header">
        <h3>Domain For Sale <span><?php echo DOMAIN_FOR_SALE_VERSION; ?></span></h3>
        Thank you for installing <strong>Domain For Sale</strong> plugin! This video will help you get started with the plugin.
      </div>

      <div class="domain-for-sale__help--video">
        <iframe width="560" height="315" src="https://www.youtube.com/embed/E_-iUMykP5M?si=oqG2dUks9LR-RZns" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
      </div>

      <div class="domain-for-sale__help--footer">
        <a class="button button-primary" href="<?php echo get_admin_url() . '/admin.php?page=domain-for-sale'; ?>">Go to settings page</a>
        <a target="_blank" class="button button-secondary" href="https://1.envato.market/LPeXVY">Upgrade to pro</a>
      </div>

    </div>
  </div>
        <?php
    }

}
