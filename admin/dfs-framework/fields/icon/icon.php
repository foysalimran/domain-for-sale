<?php if (!defined('ABSPATH')) {
  die;
} // Cannot access directly.
/**
 *
 * Field: icon
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if (!class_exists('DFS_Field_icon')) {
  class DFS_Field_icon extends DFS_Fields
  {

    public function __construct($field, $value = '', $unique = '', $where = '', $parent = '')
    {
      parent::__construct($field, $value, $unique, $where, $parent);
    }

    public function render()
    {

      $args = wp_parse_args($this->field, array(
        'button_title' => esc_html__('Add Icon', 'domain-for-sale'),
        'remove_title' => esc_html__('Remove Icon', 'domain-for-sale'),
      ));

      echo $this->field_before();

      $nonce  = wp_create_nonce('dfs_icon_nonce');
      $hidden = (empty($this->value)) ? ' hidden' : '';

      echo '<div class="dfs-icon-select">';
      echo '<span class="dfs-icon-preview' . esc_attr($hidden) . '"><i class="' . esc_attr($this->value) . '"></i></span>';
      echo '<a href="#" class="button button-primary dfs-icon-add" data-nonce="' . esc_attr($nonce) . '">' . $args['button_title'] . '</a>';
      echo '<a href="#" class="button dfs-warning-primary dfs-icon-remove' . esc_attr($hidden) . '">' . $args['remove_title'] . '</a>';
      echo '<input type="hidden" name="' . esc_attr($this->field_name()) . '" value="' . esc_attr($this->value) . '" class="dfs-icon-value"' . $this->field_attributes() . ' />';
      echo '</div>';

      echo $this->field_after();
    }

    public function enqueue()
    {
      add_action('admin_footer', array('DFS_Field_icon', 'add_footer_modal_icon'));
      add_action('customize_controls_print_footer_scripts', array('DFS_Field_icon', 'add_footer_modal_icon'));
    }

    public static function add_footer_modal_icon()
    {
?>
      <div id="dfs-modal-icon" class="dfs-modal dfs-modal-icon hidden">
        <div class="dfs-modal-table">
          <div class="dfs-modal-table-cell">
            <div class="dfs-modal-overlay"></div>
            <div class="dfs-modal-inner">
              <div class="dfs-modal-title">
                <?php esc_html_e('Add Icon', 'domain-for-sale'); ?>
                <div class="dfs-modal-close dfs-icon-close"></div>
              </div>
              <div class="dfs-modal-header">
                <input type="text" placeholder="<?php esc_html_e('Search...', 'domain-for-sale'); ?>" class="dfs-icon-search" />
              </div>
              <div class="dfs-modal-content">
                <div class="dfs-modal-loading">
                  <div class="dfs-loading"></div>
                </div>
                <div class="dfs-modal-load"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
<?php
    }
  }
}
