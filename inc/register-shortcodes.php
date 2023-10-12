<?php
// Do not allow directly accessing this file.
if (!defined('ABSPATH')) {
    exit('Direct script access denied.');
}
/**
 * @version    1.0
 * @package    Domain for sale
 * @author     ThemeAtelier
 *
 * Websites: http://www.themeatelier.net
 *
 *
 */




if (class_exists('Domain_For_Sale_Register_Shortcodes')) {
    $shortCode = new Domain_For_Sale_Register_Shortcodes();
    $shortCode->register_shortcodes(
        array(
            // Hero
            array(
                'name'  => 'templates',
                'callback'  => 'domain_for_sale_templates',
            ),
        )
    );
}
