<?php

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @link       https://themeatelier.net
 * @since      1.0.0
 *
 * @package     domain-for-sale
 * @subpackage  domain-for-sale/src/Frontend
 * @author      ThemeAtelier<themeatelierbd@gmail.com>
 */

namespace ThemeAtelier\DomainForSale\Frontend;

/**
 * The Frontend class to manage all public facing stuffs.
 *
 * @since 1.0.0
 */
class Frontend
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
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string $plugin_name       The name of the plugin.
     * @param      string $version    The version of this plugin.
     */
    public function __construct()
    {
        $this->min   = defined('WP_DEBUG') && WP_DEBUG ? '' : '.min';
        add_action('wp_footer', [$this, 'domain_for_sale_content']);
    }

    /**
     * Register the stylesheets for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public static function enqueue_scripts()
    {
        wp_enqueue_style('ico-font');
        wp_enqueue_style('bootstrap');
        wp_enqueue_style('sweetalert2');
        wp_enqueue_style('domain-for-sale-style');
        wp_enqueue_style('dfs-responsive');

        $options = get_option('dfs-opt');
        // color scheme css
        wp_enqueue_style('dfs-colors', DOMAIN_FOR_SALE_ASSETS . 'css/colors/color-' . $options['dfs-scheme'] . '.css', __FILE__);

        $overlay = esc_html($options['dfs-overlay']);
        $dfsCustomCss = isset($options['dfs-custom-css']) ? $options['dfs-custom-css'] : '';
        $custom_css = "
			.bg--overlay:before{
					background-color: {$overlay};
			}";
        if ($dfsCustomCss) {
            $custom_css .= $dfsCustomCss;
        }
        wp_add_inline_style('domain-for-sale-style', $custom_css);


        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Domain_For_Sale_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Domain_For_Sale_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */
        $dfsCustomJs = isset($options['dfs-custom-js']) ? $options['dfs-custom-js'] : '';

        wp_enqueue_script('sweetalert2');
        wp_enqueue_script('domain-for-sale-script');
        if (!empty($dfsCustomJs)) {
            wp_add_inline_script('domain-for-sale-script', $dfsCustomJs);
        }
    }

    public function domain_for_sale_content()
    {
    }
}
