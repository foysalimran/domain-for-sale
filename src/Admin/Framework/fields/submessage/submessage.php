<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access directly.
/**
 *
 * Field: submessage
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! class_exists( 'DOMAIN_FOR_SALE_Field_submessage' ) ) {
  class DOMAIN_FOR_SALE_Field_submessage extends DOMAIN_FOR_SALE_Fields {

    public function __construct( $field, $value = '', $unique = '', $where = '', $parent = '' ) {
      parent::__construct( $field, $value, $unique, $where, $parent );
    }

    public function render() {

      $style = ( ! empty( $this->field['style'] ) ) ? $this->field['style'] : 'normal';

      echo '<div class="domain-for-sale-submessage domain-for-sale-submessage-'. esc_attr( $style ) .'">'. $this->field['content'] .'</div>';

    }

  }
}
