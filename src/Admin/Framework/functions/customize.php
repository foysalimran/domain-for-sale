<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access directly.
/**
 *
 * WP Customize custom panel
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
use ThemeAtelier\DomainForSale\Admin\Framework\Classes\DOMAIN_FOR_SALE;

if ( ! class_exists( 'WP_Customize_Panel_DOMAIN_FOR_SALE' ) && class_exists( 'WP_Customize_Panel' ) ) {
  class WP_Customize_Panel_DOMAIN_FOR_SALE extends WP_Customize_Panel {
    public $type = 'domain-for-sale';
  }
}

/**
 *
 * WP Customize custom section
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! class_exists( 'WP_Customize_Section_DOMAIN_FOR_SALE' ) && class_exists( 'WP_Customize_Section' ) ) {
  class WP_Customize_Section_DOMAIN_FOR_SALE extends WP_Customize_Section {
    public $type = 'domain-for-sale';
  }
}

/**
 *
 * WP Customize custom control
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! class_exists( 'WP_Customize_Control_DOMAIN_FOR_SALE' ) && class_exists( 'WP_Customize_Control' ) ) {
  class WP_Customize_Control_DOMAIN_FOR_SALE extends WP_Customize_Control {

    public $type   = 'domain-for-sale';
    public $field  = '';
    public $unique = '';

    public function render() {

      $depend  = '';
      $visible = '';

      if ( ! empty( $this->field['dependency'] ) ) {

        $dependency      = $this->field['dependency'];
        $depend_visible  = '';
        $data_controller = '';
        $data_condition  = '';
        $data_value      = '';
        $data_global     = '';

        if ( is_array( $dependency[0] ) ) {
          $data_controller = implode( '|', array_column( $dependency, 0 ) );
          $data_condition  = implode( '|', array_column( $dependency, 1 ) );
          $data_value      = implode( '|', array_column( $dependency, 2 ) );
          $data_global     = implode( '|', array_column( $dependency, 3 ) );
          $depend_visible  = implode( '|', array_column( $dependency, 4 ) );
        } else {
          $data_controller = ( ! empty( $dependency[0] ) ) ? $dependency[0] : '';
          $data_condition  = ( ! empty( $dependency[1] ) ) ? $dependency[1] : '';
          $data_value      = ( ! empty( $dependency[2] ) ) ? $dependency[2] : '';
          $data_global     = ( ! empty( $dependency[3] ) ) ? $dependency[3] : '';
          $depend_visible  = ( ! empty( $dependency[4] ) ) ? $dependency[4] : '';
        }

        $depend .= ' data-controller="'. esc_attr( $data_controller ) .'"';
        $depend .= ' data-condition="'. esc_attr( $data_condition ) .'"';
        $depend .= ' data-value="'. esc_attr( $data_value ) .'"';
        $depend .= ( ! empty( $data_global ) ) ? ' data-depend-global="true"' : '';

        $visible  = ' domain-for-sale-dependency-control';
        $visible .= ( ! empty( $depend_visible ) ) ? ' domain-for-sale-depend-visible' : ' domain-for-sale-depend-hidden';

      }

      $id    = 'customize-control-' . str_replace( array( '[', ']' ), array( '-', '' ), $this->id );
      $class = 'customize-control customize-control-'. $this->type . $visible;

      echo '<li id="'. esc_attr( $id ) .'" class="'. esc_attr( $class ) .'"'. $depend .'>';
      $this->render_field_content();
      echo '</li>';

    }

    public function render_field_content() {

      $complex = apply_filters( 'DOMAIN_FOR_SALE_customize_complex_fields', array(
        'accordion',
        'background',
        'border',
        'button_set',
        'checkbox',
        'color_group',
        'date',
        'dimensions',
        'fieldset',
        'group',
        'image_select',
        'link',
        'link_color',
        'media',
        'palette',
        'repeater',
        'sortable',
        'sorter',
        'spacing',
        'switcher',
        'tabbed',
        'typography'
      ) );

      $field_id   = ( ! empty( $this->field['id'] ) ) ? $this->field['id'] : '';
      $custom     = ( ! empty( $this->field['customizer'] ) ) ? true : false;
      $is_complex = ( in_array( $this->field['type'], $complex ) ) ? true : false;
      $class      = ( $is_complex || $custom ) ? ' domain-for-sale-customize-complex' : '';
      $atts       = ( $is_complex || $custom ) ? ' data-unique-id="'. esc_attr( $this->unique ) .'" data-option-id="'. esc_attr( $field_id ) .'"' : '';

      if ( ! $is_complex && ! $custom ) {
        $this->field['attributes']['data-customize-setting-link'] = $this->settings['default']->id;
      }

      $this->field['name'] = $this->settings['default']->id;

      $this->field['dependency'] = array();

      echo '<div class="domain-for-sale-customize-field'. esc_attr( $class ) .'"'. $atts .'>';

      DOMAIN_FOR_SALE::field( $this->field, $this->value(), $this->unique, 'customize' );

      echo '</div>';

    }

  }
}