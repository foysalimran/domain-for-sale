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

use ThemeAtelier\DomainForSale\Frontend\Templates\Template_01;

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

        $this->domain_for_sale_public_action();
        add_action('template_redirect', [$this, 'domina_domain_for_sale']);
    }

    /**
     * Register the stylesheets for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public static function enqueue_styles()
    {
        wp_enqueue_style('ico-font');
        wp_enqueue_style('sweetalert2');
        wp_enqueue_style('domain-for-sale-style');

        $domain_for_sale_posts       = new \WP_Query(
            array(
                'post_type'      => 'dfs_template',
                'posts_per_page' => 900,
            )
        );
        $post_ids        = wp_list_pluck($domain_for_sale_posts->posts, 'ID');
        $enqueue_fonts   = array();

        $domain_for_salee_google_font =  true;
        foreach ($post_ids as $domain_for_sale_id) {

            // Include dynamic style file.
            $template_options = get_post_meta($domain_for_sale_id, 'dfs_template_options', true);

            if ($domain_for_salee_google_font) {
                // Google fonts.
                $dfs_body_typography        = isset($template_options['dfs_body_typography']) ? $template_options['dfs_body_typography'] : '';
                $dfs_domain_name            = isset($template_options['dfs_domain_name']) ? $template_options['dfs_domain_name'] : '';
                $dfs_sale_title             = isset($template_options['dfs_sale_title']) ? $template_options['dfs_sale_title'] : '';
                $dfs_form_title             = isset($template_options['dfs_form_title']) ? $template_options['dfs_form_title'] : '';
                $dfs_recommendation_title   = isset($template_options['dfs_recommendation_title']) ? $template_options['dfs_recommendation_title'] : '';
                $dfs_recommendation_domain_name = isset($template_options['dfs_recommendation_domain_name']) ? $template_options['dfs_recommendation_domain_name'] : '';
                $template_options           = get_post_meta($domain_for_sale_id, 'domain_for_sale_view_options', true);
                $all_fonts                  = array();
                $domain_for_sale_typography   = array();
                $domain_for_sale_typography[] = $dfs_body_typography;
                $domain_for_sale_typography[] = $dfs_domain_name;
                $domain_for_sale_typography[] = $dfs_sale_title;
                $domain_for_sale_typography[] = $dfs_form_title;
                $domain_for_sale_typography[] = $dfs_recommendation_title;
                $domain_for_sale_typography[] = $dfs_recommendation_domain_name;
                $domain_for_sale_typography[] = isset($template_options['read_more_typography']) ? $template_options['read_more_typography'] : array(
                    'font-family'        => '',
                    'font-weight'        => '600',
                    'subset'             => '',
                    'font-size'          => '12',
                    'tablet-font-size'   => '12',
                    'mobile-font-size'   => '10',
                    'line-height'        => '18',
                    'tablet-line-height' => '18',
                    'mobile-line-height' => '16',
                    'letter-spacing'     => '0',
                    'text-align'         => 'left',
                    'text-transform'     => 'uppercase',
                    'type'               => '',
                    'unit'               => 'px',
                );

                if (!empty($domain_for_sale_typography)) {
                    foreach ($domain_for_sale_typography as $font) {
                        if (isset($font['font-family']) && isset($font['type']) && 'google' === $font['type']) {
                            $variant     = (isset($font['font-weight']) && '' !== $font['font-weight']) ? ':' . $font['font-weight'] : '';
                            $all_fonts[] = $font['font-family'] . $variant;
                        }
                    }
                }
                if ($all_fonts) {
                    $enqueue_fonts[] = $all_fonts;
                }
            }
        }

        // Enqueue Google fonts.
        if ($domain_for_salee_google_font && !empty($enqueue_fonts)) {
            wp_enqueue_style('domain-for-sale-google-fonts', esc_url(add_query_arg('family', rawurlencode(implode('|', array_merge(...$enqueue_fonts))), '//fonts.googleapis.com/css')), array(), DOMAIN_FOR_SALE_VERSION, false);
        }
    }

    /**
     * Register the stylesheets for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public static function enqueue_scripts()
    {
        $args = array(
            'post_type'         => 'dfs_template',
            'posts_per_page'    => -1,
        );

        $dfs_posts = new \WP_Query($args);
        $post_ids  = wp_list_pluck($dfs_posts->posts, 'ID');

        foreach ($post_ids as $dfs_id) {
            $options = get_post_meta($dfs_id, 'dfs_template_options', true);
            $dfs_apply_on = isset($options['dfs_apply_on']) ? $options['dfs_apply_on'] : '';


            if ($dfs_apply_on === 'replace_theme') {

                // Remove theme styles & scripts
                add_action('wp_enqueue_scripts', function () {
                    $wp_scripts = wp_scripts();
                    $wp_styles  = wp_styles();
                    $themes_uri = get_theme_root_uri();

                    foreach ($wp_scripts->registered as $wp_script) {
                        if (strpos($wp_script->src, $themes_uri) !== false) {
                            wp_dequeue_script($wp_script->handle);
                        }
                    }

                    foreach ($wp_styles->registered as $wp_style) {
                        if (strpos($wp_style->src, $themes_uri) !== false) {
                            wp_dequeue_style($wp_style->handle);
                        }
                    }
                }, 999);

                $custom_css = 'body{margin:0px;padding:0px}';
                wp_add_inline_style('domain-for-sale-style', $custom_css);
            }
        }

        $settings = get_option('dfs-opt');
        $dfsCustomCss = isset($settings['dfs-custom-css']) ? $settings['dfs-custom-css'] : '';
        $dfsCustomJs = isset($settings['dfs-custom-js']) ? $settings['dfs-custom-js'] : '';

        if (!empty($dfsCustomCss)) {
            wp_add_inline_style('domain-for-sale-style', $dfsCustomCss);
        }

        wp_enqueue_script('sweetalert2');
        wp_enqueue_script('domain-for-sale-script');
        wp_localize_script('domain-for-sale-script', 'confirmation', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('domain_for_sale_email_nonce')
        ));
        if (!empty($dfsCustomJs)) {
            wp_add_inline_script('domain-for-sale-script', $dfsCustomJs);
        }
    }

    private function domain_for_sale_public_action()
    {
        add_shortcode('domain_for_sale', array($this, 'domain_for_sale_shortcode_render'));
    }

    /********************
	    - Front end -
     ********************/
    function domina_domain_for_sale()
    {
        $args = array(
            'post_type'         => 'dfs_template',
            'posts_per_page'    => -1,
        );

        $dfs_posts  = new \WP_Query($args);
        $dfs_ids    = wp_list_pluck($dfs_posts->posts, 'ID');

        foreach ($dfs_ids as $dfs_id) {

            $template_options   = get_post_meta($dfs_id, 'dfs_template_options', true);
            $layout             = get_post_meta($dfs_id, 'dfs_layouts', true);
            $dfs_apply_on       = isset($template_options['dfs_apply_on']) ? $template_options['dfs_apply_on'] : '';

            if ($dfs_apply_on === 'replace_theme') {
                include(DOMAIN_FOR_SALE_DIR_PATH . 'src/Frontend/Templates/index.php');
                die();
            }
        }
    }

    /**
     * Function get layout from atts and create class depending on it.
     *
     * @since 2.0
     * @param array $attribute attribute of this shortcode.
     */
    public function domain_for_sale_shortcode_render($attribute)
    {
        if (empty($attribute['id'])) {
            return;
        }
        $shortcode_id = $attribute['id'];
        // Preset Layouts.
        $template_options   = get_post_meta($shortcode_id, 'dfs_template_options', true);
        $layout             = get_post_meta($shortcode_id, 'dfs_layouts', true);
        $dfs_layout_preset  = isset($layout['dfs_layout_preset']) ? $layout['dfs_layout_preset'] : '';

        ob_start();
        if ($dfs_layout_preset === 'layout_01') {
            Template_01::content($template_options);
        }
        return ob_get_clean();
    }
}
