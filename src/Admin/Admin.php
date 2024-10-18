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

use ThemeAtelier\DomainForSale\Admin\DBUpdates;
use ThemeAtelier\DomainForSale\Admin\Views\DomainForSaleMetaboxes;
use ThemeAtelier\DomainForSale\Admin\Views\DomainForSaleSettings;

/**
 * The admin class
 */
class Admin
{
  protected $suffix;

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
    $this->suffix      = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG || defined('WP_DEBUG') && WP_DEBUG ? '' : '.min';
    $this->plugin_slug = $plugin_slug;
    $this->version     = $version;
    $this->min         = defined('WP_DEBUG') && WP_DEBUG ? '' : '.min';
    add_action('admin_menu', array($this, 'domain_for_sale_support_submenu'));
    DomainForSaleMetaboxes::layout_metabox('dfs_layouts');
    DomainForSaleMetaboxes::option_metabox('dfs_template_options');
    DomainForSaleMetaboxes::shortcode_metabox('dfs_shortcode');
    DomainForSaleSettings::settings('dfs-opt');
    new DBUpdates();
  }

  /**
   * Register the stylesheets for the public-facing side of the site.
   *
   * @since    1.0.0
   */
  public function enqueue_styles()
  {
    $current_screen        = get_current_screen();
    $the_current_post_type = $current_screen->post_type;
    if ('dfs_template' == $the_current_post_type) {
      wp_enqueue_style('domain-for-sale-admin', DOMAIN_FOR_SALE_URL . '/src/Admin/assets/css/domain-for-sale-admin' . $this->suffix . '.css', array(), $this->version, 'all');
    }
  }

  /**
   * Register the stylesheets for the public-facing side of the site.
   *
   * @since    1.0.0
   */
  public function enqueue_scripts($hook)
  {
    $current_screen        = get_current_screen();
    $the_current_post_type = $current_screen->post_type;

    wp_enqueue_style('help');

    if ('dfs_template' == $the_current_post_type) {
      wp_enqueue_script('domain-for-sale-admin', DOMAIN_FOR_SALE_URL . '/src/Admin/assets/js/domain-for-sale-admin' . $this->suffix . '.js', array('jquery'), $this->version, false);
    }
  }

  public function domain_for_sale_support_submenu()
  {
    add_submenu_page(
      'edit.php?post_type=dfs_template',
      esc_html__('Settings', 'domain-for-sale'),
      esc_html__('Settings', 'domain-for-sale'),
      'manage_options', // More permissive for testing
      'domain-for-sale-settings',
      array($this, 'domain_for_sale_settings'),
    );

    add_submenu_page(
      'edit.php?post_type=dfs_template',
      esc_html__('Help', 'domain-for-sale'),
      esc_html__('Help', 'domain-for-sale'),
      'manage_options', // More permissive for testing
      'domain-for-sale-help',
      array($this, 'domain_for_sale_help'),
    );
    add_submenu_page(
      'edit.php?post_type=dfs_template',
      __('👑 Upgrade to Pro!', 'domain-for-sale'),
      sprintf(
        '<span class="domain-for-sale-text">%s</span>',
        __('👑 Upgrade to Pro!', 'domain-for-sale')
      ),
      'manage_options',
      'https://1.envato.market/LPeXVY'
    );
  }

  public function domain_for_sale_settings() {}

  // Help page callbacks
  public function domain_for_sale_help(): void
  {

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

  // Help page callbacks
  /**
   * Add domain_for_sale admin columns.
   *
   * @since 2.0.0
   * @return statement
   */
  public function filter_domain_for_sale_admin_column()
  {
    $admin_columns['cb']            = '<input type="checkbox" />';
    $admin_columns['title']         = esc_html__('Title', 'domain-for-sale');
    $admin_columns['shortcode']     = esc_html__('Shortcode', 'domain-for-sale');
    $admin_columns['layout']        = esc_html__('Layout', 'domain-for-sale');
    $admin_columns['date']          = esc_html__('Date', 'domain-for-sale');

    return $admin_columns;
  }

  /**
   * Display admin columns for the domain_for_sales.
   *
   * @param mix    $column The columns.
   * @param string $post_id The post ID.
   * @return void
   */
  public function display_domain_for_sale_admin_fields($column, $post_id)
  {
    $layouts     = get_post_meta($post_id, 'dfs_layouts', true);
    $domain_for_sales_types = isset($layouts['dfs_layout_preset']) ? $layouts['dfs_layout_preset'] : '';

    switch ($column) {
      case 'shortcode':
        $column_field = '<input  class="ta_domain_for_sale_input" style="width: 175px;padding: 4px 8px;cursor: pointer;" type="text" onClick="this.select();" readonly="readonly" value="[domain_for_sale id=&quot;' . $post_id . '&quot;]"/> <div class="domain-for-sale-after-copy-text"><i class="icofont-check-circled"></i> ' . esc_html('Shortcode Copied to Clipboard!', 'domain-for-sale') . ' </div>';
        echo $column_field;
        break;
      case 'layout':
        $layout = ucwords(str_replace('_layout', ' ', $domain_for_sales_types));
        esc_html_e($layout);
        break;
    } // end switch.
  }
}
