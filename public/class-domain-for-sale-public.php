<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://themeatelier.net
 * @since      1.4.12
 *
 * @package    Domain_For_Sale
 * @subpackage Domain_For_Sale/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Domain_For_Sale
 * @subpackage Domain_For_Sale/public
 * @author     ThemeAtelier <themeatelierbd@gmail.com>
 */
class Domain_For_Sale_Public
{

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.4.12
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.4.12
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.4.12
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct($plugin_name, $version)
	{

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->load_dependencies();
		add_action('template_redirect', [$this, 'domain_for_sale_redirect']);
	}

	/**
	 * Dequeue style from theme.
	 *
	 * @since    1.0.0
	 */
	public function dequeue_theme_styles()
	{

		$wp_styles  = wp_styles();
		$themes_uri = get_theme_root_uri();
		foreach ($wp_styles->registered as $wp_style) {
			if (strpos($wp_style->src, $themes_uri) !== false) {
				wp_deregister_style($wp_style->handle);
			}
		}
	}

	/**
	 * Dequeue scripts from theme.
	 *
	 * @since    1.0.0
	 */
	public function dequeue_theme_scripts()
	{
		$wp_scripts = wp_scripts();
		$themes_uri = get_theme_root_uri();
		foreach ($wp_scripts->registered as $wp_script) {
			if (strpos($wp_script->src, $themes_uri) !== false) {
				wp_deregister_script($wp_script->handle);
			}
		}
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.4.12
	 */
	public function enqueue_styles()
	{

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

		// font awesome css
		wp_enqueue_style('fontawesome', DFS_DIR_URL . 'public/assets/css/font-awesome.min.css', __FILE__);

		// bootstrap css
		wp_enqueue_style('bootstrap', DFS_DIR_URL . 'public/css/bootstrap.css', __FILE__);

		// Sweet alert CSS
		wp_enqueue_style('sweetalert2', DFS_DIR_URL . 'public/css/sweetalert2.css', __FILE__);

		// main css
		wp_enqueue_style('dfs-main', DFS_DIR_URL . 'public/css/style.css', __FILE__);

		// responsive css
		wp_enqueue_style('dfs-responsive', DFS_DIR_URL . 'public/css/responsive.css', __FILE__);

		$options = get_option('dfs-opt');
		// color scheme css
		wp_enqueue_style('dfs-colors', DFS_DIR_URL . 'public/css/colors/color-' . $options['dfs-scheme'] . '.css', __FILE__);

		// Custom css
		$overlay = esc_html($options['dfs-overlay']);
		$dfsCustomCss = isset($options['dfs-custom-css']) ? $options['dfs-custom-css'] : '';
		$custom_css = "
			.bg--overlay:before{
					background-color: {$overlay};
			}";
		if ($dfsCustomCss) {
			$custom_css .= $dfsCustomCss;
		}
		wp_add_inline_style('dfs-main', $custom_css);
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.4.12
	 */
	public function enqueue_scripts()
	{

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
		$options = get_option('dfs-opt');
		$dfsCustomJs = isset($options['dfs-custom-js']) ? $options['dfs-custom-js'] : '';
		wp_enqueue_script('sweet-alert', DFS_DIR_URL . 'public/js/sweetalert2.min.js', array('jquery'), '1.0', true);
		wp_enqueue_script('dfs-custom', DFS_DIR_URL . 'public/js/main.js', array('jquery'), '1.0', true);

		if (!empty($dfsCustomJs)) {
			wp_add_inline_script('dfs-custom', $dfsCustomJs);
		}
	}

	public function load_dependencies()
	{

		/**
		 * The class responsible for generating shortcode for plugin contact form
		 * core plugin.
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'public/partials/domain-for-sale-contact-form-shortcode.php';
		$options = get_option('dfs-opt');
		$isDfsEnable = isset($options['dfs-enable']) ? $options['dfs-enable'] : '';
		if (!is_admin() && $isDfsEnable) {
			$this->loader = new DFS_ContactForm();
		}
	}

	public function domain_for_sale_redirect()
	{
		$options = get_option('dfs-opt');
		$isDfsEnable = isset($options['dfs-enable']) ? $options['dfs-enable'] : '';
		if (!is_admin() && $isDfsEnable) {
			include(DFS_DIR_PATH . 'public/partials/domain-for-sale-public-display.php');
			die();
		};
	}
}
