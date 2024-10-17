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
 * @package domain-for-sale
 * @subpackage domain-for-sale/src/Helpers
 * @author     ThemeAtelier<themeatelierbd@gmail.com>
 */

namespace ThemeAtelier\DomainForSale\Helpers;

/**
 * The Helpers class to manage all public facing stuffs.
 *
 * @since 1.0.0
 */
class Helpers
{
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
    }

    /**
     * Register the All scripts for the public-facing side of the site.
     *
     * @since    2.0
     */
    public function register_all_scripts()
    {
        wp_register_style('help', DOMAIN_FOR_SALE_ASSETS . 'css/help' . $this->min . '.css', array(), '1.0.0', 'all');
        wp_register_style('ico-font', DOMAIN_FOR_SALE_ASSETS . 'css/icofont' . $this->min . '.css', array(), '1.0.0', 'all');
        wp_register_style('bootstrap', DOMAIN_FOR_SALE_ASSETS . 'css/bootstrap' . $this->min . '.css', array(), '1.0.0', 'all');
        wp_register_style('sweetalert2', DOMAIN_FOR_SALE_ASSETS . 'css/sweetalert2' . $this->min . '.css', array(), '1.0.0', 'all');
        wp_register_style('domain-for-sale-style', DOMAIN_FOR_SALE_ASSETS . 'css/domain-for-sale-style' . $this->min . '.css', array(), DOMAIN_FOR_SALE_VERSION, 'all');
        wp_register_style('dfs-responsive', DOMAIN_FOR_SALE_ASSETS . 'css/responsive' . $this->min . '.css', array(), DOMAIN_FOR_SALE_VERSION, 'all');

        wp_register_script('sweetalert2', DOMAIN_FOR_SALE_ASSETS . 'js/sweetalert2' . $this->min . '.js', array('jquery'), DOMAIN_FOR_SALE_VERSION, true);
        wp_register_script('domain-for-sale-script', DOMAIN_FOR_SALE_ASSETS . 'js/domain-for-sale-script' . $this->min . '.js', array('jquery'), DOMAIN_FOR_SALE_VERSION, true);
    }

    public static function dfs_apply_on()
    {
        $dfs_apply_on = array(
            'shortcode'     => array(
                'name'  => esc_html__('Shortcode', 'domain-for-sale'),
                'pro_only' => false,
            ),
            'replace_theme'     => array(
                'name'  => esc_html__('Replace Current Theme', 'domain-for-sale'),
                'pro_only' => false,
            ),
            'specific_page'     => array(
                'name'  => esc_html__('Specific Page', 'domain-for-sale'),
                'pro_only' => true,
            ),
        );
        return $dfs_apply_on;
    }

    public static function dfs_select_settings()
	{
		$query          = new \WP_Query(wp_parse_args(array(
			'post_type'   => 'dfs_template',
			'post_status' => 'publish',
		)));

		$already_exists = array();
		foreach ($query->posts as $item) {
			$sett_id          = get_post_meta($item->ID, 'dfs_template_options', true);
			$sett_id          = !empty($sett_id['dfs_apply_on']) ? $sett_id['dfs_apply_on'] : '';
			$already_exists[] = $sett_id;
		}
		return $already_exists;
	}

    public static function dfs_apply_list()
	{
		$sett_id = '';
		if (isset($_GET['post'])) {
			$template_options = get_post_meta($_GET['post'], 'dfs_template_options', true);
			$sett_id          = isset($template_options['dfs_apply_on']) ? $template_options['dfs_apply_on'] : '';
		}

		$apply_list = self::dfs_apply_on();
		$settings   = self::dfs_select_settings();

		foreach ($settings as $sett_val) {
			if (!empty($sett_id) && $sett_id == $sett_val) {
				continue;
			}
			if ($sett_val == 'replace_theme') {
				unset($apply_list['replace_theme']);
			}
		}

		return $apply_list;
	}
}
