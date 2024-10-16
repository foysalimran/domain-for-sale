<?php

/**
 * Domain for sale pro dashboard capability.
 *
 * @return string
 */
function domain_for_sale_dashboard_capability()
{
    return apply_filters('domain_for_sale_dashboard_capability', 'manage_options');
}
