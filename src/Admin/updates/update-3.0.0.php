<?php

/**
 * Update version.
 */
update_option('domain_for_sale_version', '3.0.0');
update_option('domain_for_sale_db_version', '3.0.0');

/**
 * Convert old data keys to new ones.
 */
function domain_for_sale_convert_old_to_new_data_3_1_0($options)
{
    $domain_for_sale_posts = new \WP_Query(
        array(
            'post_type'      => 'dfs_template',
            'posts_per_page' => 900,
        )
    );

    $post_ids = wp_list_pluck($domain_for_sale_posts->posts, 'ID');

    // Loop through each post ID to update the 'dfs_template_options' post meta
    foreach ($post_ids as $domain_for_sale_id) {
        $template_options = get_post_meta($domain_for_sale_id, 'dfs_template_options', true);

        if (!empty($options['dfs-enable'])) {
            $template_options['dfs_apply_on'] = 'replace_theme';
        }

        if (!empty($options['dfs-scheme'])) {
            $template_options['dfs-scheme'] = $options['dfs-scheme'];
        }

        $dfs_scheme_custom_1 = isset($options['dfs-scheme-custom-1']) ?  $options['dfs-scheme-custom-1'] : '';
        if ($dfs_scheme_custom_1['primary'] !== '#44dc46' || $dfs_scheme_custom_1['secondary']   !== '#3bbf3d') {
            $template_options['dfs_color_scheme_type'] = 'custom';
            $template_options['dfs_custom_scheme'] = $options['dfs-scheme-custom-1'];
        }

        if (!empty($options['dfs-background'])) {
            $template_options['dfs-background'] = $options['dfs-background'];
        }
        if (!empty($options['dfs-overlay'])) {
            $template_options['dfs-overlay'] = $options['dfs-overlay'];
        }

        if (!empty($options['dfs-body-typography'])) {
            $template_options['dfs-body-typography'] = $options['dfs-body-typography'];
        }
        if (!empty($options['dfs-heading-typography'])) {
            $template_options['dfs-heading-typography'] = $options['dfs-heading-typography'];
        }


        $fields_to_update = [
            'dfs-pricetag',
            'dfs-domainname',
            'dfs-saletitle',
            'dfs-content',
            'dfs-contacttitle',
            'dfs-contactinfos',
            'dfs-moredomainTitle',
            'dfs-moredomains',
            'dfs-formtitle',
            'dfs-thirdparty_shortcode',
        ];

        foreach ($fields_to_update as $field) {
            if (isset($options[$field])) {
                $template_options[$field] = $options[$field];
            }
        }

        update_post_meta($domain_for_sale_id, 'dfs_template_options', $template_options);

        $dfs_layouts = get_post_meta($domain_for_sale_id, 'dfs_layouts', true);

        if ($options['dfs-version'] == '1') {
            $dfs_layouts['dfs_layout_preset'] = 'layout_01';
        }
        update_post_meta($domain_for_sale_id, 'dfs_layouts', $dfs_layouts);
    }

    update_option('dfs-opt', $options);
}

/**
 * Update old to new data.
 */
$options = get_option('dfs-opt');
if ($options) {
    domain_for_sale_convert_old_to_new_data_3_1_0($options);
}
