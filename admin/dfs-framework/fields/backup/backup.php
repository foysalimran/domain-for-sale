<?php if (!defined('ABSPATH')) {
  die;
} // Cannot access directly.
/**
 *
 * Field: backup
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if (!class_exists('DFS_Field_backup')) {
  class DFS_Field_backup extends DFS_Fields
  {

    public function __construct($field, $value = '', $unique = '', $where = '', $parent = '')
    {
      parent::__construct($field, $value, $unique, $where, $parent);
    }

    public function render()
    {

      $unique = $this->unique;
      $nonce  = wp_create_nonce('dfs_backup_nonce');
      $export = add_query_arg(array('action' => 'dfs-export', 'unique' => $unique, 'nonce' => $nonce), admin_url('admin-ajax.php'));

      echo $this->field_before();

      echo '<textarea name="dfs_import_data" class="dfs-import-data"></textarea>';
      echo '<button type="submit" class="button button-primary dfs-confirm dfs-import" data-unique="' . esc_attr($unique) . '" data-nonce="' . esc_attr($nonce) . '">' . esc_html__('Import', 'domain-for-sale') . '</button>';
      echo '<hr />';
      echo '<textarea readonly="readonly" class="dfs-export-data">' . esc_attr(json_encode(get_option($unique))) . '</textarea>';
      echo '<a href="' . esc_url($export) . '" class="button button-primary dfs-export" target="_blank">' . esc_html__('Export & Download', 'domain-for-sale') . '</a>';
      echo '<hr />';
      echo '<button type="submit" name="dfs_transient[reset]" value="reset" class="button dfs-warning-primary dfs-confirm dfs-reset" data-unique="' . esc_attr($unique) . '" data-nonce="' . esc_attr($nonce) . '">' . esc_html__('Reset', 'domain-for-sale') . '</button>';

      echo $this->field_after();
    }
  }
}
