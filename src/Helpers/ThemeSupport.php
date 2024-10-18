<?php

namespace ThemeAtelier\DomainForSale\Helpers;

class ThemeSupport
{
    public function theme_support()
    {
        $active_theme = wp_get_theme();
        if ($active_theme->get('Name') === 'Astra' || $active_theme->get('Template') === 'astra') {

            $domain_for_sale_templates       = new \WP_Query(
                array(
                    'post_type'      => 'dfs_template',
                    'posts_per_page' => -1,
                )
            );
            $post_ids        = wp_list_pluck($domain_for_sale_templates->posts, 'ID');
            foreach ($post_ids as $template_id) {
                $template_options = get_post_meta($template_id, 'dfs_template_options', true);
                $dfs_apply_on = $template_options['dfs_apply_on'];

                if ($dfs_apply_on === 'replace_theme') {

                    add_action('wp_footer', function () {
                        echo "
                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    var scrollTopBtn = document.getElementById('ast-scroll-top');
                                    if (scrollTopBtn) {
                                        scrollTopBtn.remove();
                                    }
                                });
                            </script>
                        ";
                    });
                }
            }
        }
    }
}
