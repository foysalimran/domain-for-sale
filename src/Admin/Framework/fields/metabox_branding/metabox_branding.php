<?php if (! defined('ABSPATH')) {
	die;
} // Cannot access directly.
/**
 *
 * Field: metabox_branding
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if (! class_exists('DOMAIN_FOR_SALE_Field_metabox_branding')) {
	class DOMAIN_FOR_SALE_Field_metabox_branding extends DOMAIN_FOR_SALE_Fields
	{

		public function __construct($field, $value = '', $unique = '', $where = '', $parent = '')
		{
			parent::__construct($field, $value, $unique, $where, $parent);
		}

		public function render()
		{

			echo (! empty($this->field['content'])) ? $this->field['content'] : '';
			echo (! empty($this->field['image'])) ? '<img src="' . $this->field['image'] . '">' : '';

			echo (! empty($this->field['after']) && ! empty($this->field['link'])) ? '<span class="spacer"></span><span class="support"><a target="_blank" href="' . $this->field['link'] . '">' . $this->field['after'] . '</a></span>' : '';
		}
	}
}
