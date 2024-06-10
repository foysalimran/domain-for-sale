<?php if (!defined('ABSPATH')) {
  die;
} // Cannot access directly.
/**
 *
 * Field: notice
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if (!class_exists('DFS_Field_notice')) {
  class DFS_Field_notice extends DFS_Fields
  {

    public function __construct($field, $value = '', $unique = '', $where = '', $parent = '')
    {
      parent::__construct($field, $value, $unique, $where, $parent);
    }

    public function render()
    {

      $style = (!empty($this->field['style'])) ? $this->field['style'] : 'normal';

      echo (!empty($this->field['content'])) ? '<div class="dfs-notice dfs-notice-' . esc_attr($style) . '">' . $this->field['content'] . '</div>' : '';
    }
  }
}
