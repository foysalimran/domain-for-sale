<?php if (!defined('ABSPATH')) {
  die;
} // Cannot access directly.
/**
 *
 * Field: media
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if (!class_exists('DFS_Field_media')) {
  class DFS_Field_media extends DFS_Fields
  {

    public function __construct($field, $value = '', $unique = '', $where = '', $parent = '')
    {
      parent::__construct($field, $value, $unique, $where, $parent);
    }

    public function render()
    {

      $args = wp_parse_args($this->field, array(
        'url'            => true,
        'preview'        => true,
        'preview_width'  => '',
        'preview_height' => '',
        'library'        => array(),
        'button_title'   => esc_html__('Upload', 'domain-for-sale'),
        'remove_title'   => esc_html__('Remove', 'domain-for-sale'),
        'preview_size'   => 'thumbnail',
      ));

      $default_values = array(
        'url'         => '',
        'id'          => '',
        'width'       => '',
        'height'      => '',
        'thumbnail'   => '',
        'alt'         => '',
        'title'       => '',
        'description' => ''
      );

      // fallback
      if (is_numeric($this->value)) {

        $this->value  = array(
          'id'        => $this->value,
          'url'       => wp_get_attachment_url($this->value),
          'thumbnail' => wp_get_attachment_image_src($this->value, 'thumbnail', true)[0],
        );
      }

      $this->value = wp_parse_args($this->value, $default_values);

      $library     = (is_array($args['library'])) ? $args['library'] : array_filter((array) $args['library']);
      $library     = (!empty($library)) ? implode(',', $library) : '';
      $preview_src = ($args['preview_size'] !== 'thumbnail') ? esc_attr($this->value['url']) : esc_attr($this->value['url']);
      $hidden_url  = (empty($args['url'])) ? ' hidden' : '';
      $hidden_auto = (empty($this->value['url'])) ? ' hidden' : '';
      $placeholder = (empty($this->field['placeholder'])) ? ' placeholder="' .  esc_html__('Not selected', 'domain-for-sale') . '"' : '';

      echo $this->field_before();

      if (!empty($args['preview'])) {

        $preview_width  = (!empty($args['preview_width'])) ? 'max-width:' . esc_attr($args['preview_width']) . 'px;' : '';
        $preview_height = (!empty($args['preview_height'])) ? 'max-height:' . esc_attr($args['preview_height']) . 'px;' : '';
        $preview_style  = (!empty($preview_width) || !empty($preview_height)) ? ' style="' . esc_attr($preview_width . $preview_height) . '"' : '';

        echo '<div class="dfs--preview' . esc_attr($hidden_auto) . '">';
        echo '<div class="dfs-image-preview"' . $preview_style . '>';
        echo '<i class="dfs--remove fas fa-times"></i><span><img src="' . esc_url($preview_src) . '" class="dfs--src" /></span>';
        echo '</div>';
        echo '</div>';
      }

      echo '<div class="dfs--placeholder">';
      echo '<input type="text" name="' . esc_attr($this->field_name('[url]')) . '" value="' . esc_attr($this->value['url']) . '" class="dfs--url' . esc_attr($hidden_url) . '" readonly="readonly"' . $this->field_attributes() . $placeholder . ' />';
      echo '<a href="#" class="button button-primary dfs--button" data-library="' . esc_attr($library) . '" data-preview-size="' . esc_attr($args['preview_size']) . '">' . $args['button_title'] . '</a>';
      echo (empty($args['preview'])) ? '<a href="#" class="button button-secondary dfs-warning-primary dfs--remove' . esc_attr($hidden_auto) . '">' . $args['remove_title'] . '</a>' : '';
      echo '</div>';

      echo '<input type="hidden" name="' . esc_attr($this->field_name('[id]')) . '" value="' . esc_attr($this->value['id']) . '" class="dfs--id"/>';
      echo '<input type="hidden" name="' . esc_attr($this->field_name('[width]')) . '" value="' . esc_attr($this->value['width']) . '" class="dfs--width"/>';
      echo '<input type="hidden" name="' . esc_attr($this->field_name('[height]')) . '" value="' . esc_attr($this->value['height']) . '" class="dfs--height"/>';
      echo '<input type="hidden" name="' . esc_attr($this->field_name('[thumbnail]')) . '" value="' . esc_attr($this->value['thumbnail']) . '" class="dfs--thumbnail"/>';
      echo '<input type="hidden" name="' . esc_attr($this->field_name('[alt]')) . '" value="' . esc_attr($this->value['alt']) . '" class="dfs--alt"/>';
      echo '<input type="hidden" name="' . esc_attr($this->field_name('[title]')) . '" value="' . esc_attr($this->value['title']) . '" class="dfs--title"/>';
      echo '<input type="hidden" name="' . esc_attr($this->field_name('[description]')) . '" value="' . esc_attr($this->value['description']) . '" class="dfs--description"/>';

      echo $this->field_after();
    }
  }
}
