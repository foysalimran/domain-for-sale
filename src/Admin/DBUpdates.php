<?php

/**
 * The admin-facing functionality of the plugin.
 *
 * @link       https://themeatelier.net
 * @since      1.0.0
 *
 * @package domain-for-sale
 * @subpackage domain-for-sale/Admin
 * @author     ThemeAtelier<themeatelierbd@gmail.com>
 */

namespace ThemeAtelier\DomainForSale\Admin;

/**
 * The admin class
 */
class DBUpdates
{
    /**
     * DB updates that need to be run
     *
     * @var array
     */
    private static $updates = array(
        '3.0.0' => 'updates/update-3.0.0.php',
    );
    
    /**
     * The class constructor.
     *
     */
    function __construct()
    {
        add_action('plugins_loaded', array($this, 'perform_updates'));
    }

    /**
     * Check if an update is needed.
     *
     * @return bool
     */
    public function is_needs_update() {
        $installed_version = get_option('domain_for_sale_version');
        $first_version     = get_option('domain_for_sale_first_version');
        $activation_date   = get_option('domain_for_sale_activation_date');

        if (false === $installed_version) {
            update_option('domain_for_sale_version', '2.0.0');
            update_option('domain_for_sale_db_version', '2.0.0');
        }
        if (false === $first_version) {
            update_option('domain_for_sale_first_version', DOMAIN_FOR_SALE_VERSION);
        }
        if (false === $activation_date) {
            update_option('domain_for_sale_activation_date', current_time('timestamp'));
        }

        if (version_compare($installed_version, DOMAIN_FOR_SALE_VERSION, '<')) {
            return true;
        }

        return false;
    }

    /**
     * Perform all updates.
     *
     */
    public function perform_updates() {
        if (!$this->is_needs_update()) {
            return;
        }

        $installed_version = get_option('domain_for_sale_version');

        foreach (self::$updates as $version => $path) {
            if (version_compare($installed_version, $version, '<')) {
                include $path;
                update_option('domain_for_sale_version', $version);
            }
        }

        update_option('domain_for_sale_version', DOMAIN_FOR_SALE_VERSION);
    }
}
