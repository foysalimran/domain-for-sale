<?php

namespace ThemeAtelier\DomainForSale\Frontend\Templates;

class Template_01
{
    public static function content($template_options)
    {
        // Page options
        $dfs_domainName = isset($template_options['dfs-domainname']) ? $template_options['dfs-domainname'] : '';
        $dfs_domain_price_tag = isset($template_options['dfs-pricetag']) ? $template_options['dfs-pricetag'] : '';
        $dfs_saleTitle = isset($template_options['dfs-saletitle']) ? $template_options['dfs-saletitle'] : '';
        $dfs_sale_content = isset($template_options['dfs-content']) ? $template_options['dfs-content'] : '';
        $dfs_contact_title = isset($template_options['dfs-contacttitle']) ? $template_options['dfs-contacttitle'] : '';
        $dfs_contact_infos = isset($template_options['dfs-contactinfos']) ? $template_options['dfs-contactinfos'] : '';

        $dfs_formTitle = isset($template_options['dfs-formtitle']) ? $template_options['dfs-formtitle'] : '';
        $dfs_form_type = isset($template_options['dfs_form_type']) ? $template_options['dfs_form_type'] : '';
        $dfs_thirdparty_shortcode = isset($template_options['dfs-thirdparty_shortcode']) ? $template_options['dfs-thirdparty_shortcode'] : '';

        $dfs_background = isset($template_options['dfs-background']) ? $template_options['dfs-background'] : '';
        $dfs_background_url = !empty($dfs_background['background-image']['url']) ? $dfs_background['background-image']['url'] : DOMAIN_FOR_SALE_DIR_URL . 'src/assets/images/hero-1.webp';
        $dfs_background_repeat = isset($dfs_background['background-repeat']) ? $dfs_background['background-repeat'] : '';
        $dfs_background_position = isset($dfs_background['background-position']) ? $dfs_background['background-position'] : '';
        $dfs_background_size = isset($dfs_background['background-size']) ? $dfs_background['background-size'] : '';
        $dfs_color_scheme_type = isset($template_options['dfs_color_scheme_type']) ? $template_options['dfs_color_scheme_type'] : 'pre_defined';

        $dfs_scheme = isset($template_options['dfs-scheme']) ? $template_options['dfs-scheme'] : '';
        $dfs_custom_scheme = isset($template_options['dfs_custom_scheme']) ? $template_options['dfs_custom_scheme'] : [];
        $dfs_custom_scheme_primary = !empty($dfs_custom_scheme['primary']) ? $dfs_custom_scheme['primary'] : '';
        $dfs_custom_scheme_secondary = !empty($dfs_custom_scheme['secondary']) ? $dfs_custom_scheme['secondary'] : '';

        if ('pre_defined' == $dfs_color_scheme_type) {
            if ($dfs_scheme == '1') {
                $primary = '#1abc9c';
                $secondary = '#199e83';
            } else if ($dfs_scheme == '2') {
                $primary = '#44dc46';
                $secondary = '#3bbf3d';
            } else if ($dfs_scheme == '3') {
                $primary = '#C57229';
                $secondary = '#9B1210';
            } else if ($dfs_scheme == '4') {
                $primary = '#e74c3c';
                $secondary = '#d21414';
            }
        } else {
            $primary = $dfs_custom_scheme_primary;
            $secondary = $dfs_custom_scheme_secondary;
        }

        $dfs_container_width = isset($template_options['dfs_container_width']) ? $template_options['dfs_container_width'] : '1140';
        $dfs_gap = isset($template_options['dfs_gap']) ? $template_options['dfs_gap'] : '';
        $dfs_overlay = isset($template_options['dfs-overlay']) ? $template_options['dfs-overlay'] : 'rgba(0,0,0,0.7)';
        $body_typography = isset($template_options['dfs_body_typography']) ? $template_options['dfs_body_typography'] : '';
        $body_font_family = !empty($body_typography['font-family']) ? $body_typography['font-family'] : 'Nunito';
        $body_font_weight = !empty($body_typography['font-weight']) ? $body_typography['font-weight'] : 'normal';
        $body_font_style =  !empty($body_typography['font-style']) ? $body_typography['font-style'] : 'normal';
        $body_text_transform = !empty($body_typography['text-transform']) ? $body_typography['text-transform'] : 'none';
        $body_font_size = !empty($body_typography['font-size']) ? $body_typography['font-size'] : '16';
        $body_line_height = !empty($body_typography['line-height']) ? $body_typography['line-height'] : '20';
        $body_tablet_font_size = !empty($body_typography['tablet-font-size']) ? $body_typography['tablet-font-size'] : '16';
        $body_tablet_line_height = !empty($body_typography['tablet-line-height']) ? $body_typography['tablet-line-height'] : '20';
        $body_mobile_font_size = !empty($body_typography['mobile-font-size']) ? $body_typography['mobile-font-size'] : '16';
        $body_mobile_line_height = !empty($body_typography['mobile-line-height']) ? $body_typography['mobile-line-height'] : '20';

        $dfs_domain_name = isset($template_options['dfs_domain_name']) ? $template_options['dfs_domain_name'] : '';
        $domain_name_font_family = !empty($dfs_domain_name['font-family']) ? $dfs_domain_name['font-family'] : 'Poppins';
        $domain_name_font_weight = !empty($dfs_domain_name['font-weight']) ? $dfs_domain_name['font-weight'] : 'bold';
        $domain_name_font_style =  !empty($dfs_domain_name['font-style']) ? $dfs_domain_name['font-style'] : 'normal';
        $domain_name_text_transform = !empty($dfs_domain_name['text-transform']) ? $dfs_domain_name['text-transform'] : 'none';
        $domain_name_font_size = !empty($dfs_domain_name['font-size']) ? $dfs_domain_name['font-size'] : '48';
        $domain_name_line_height = !empty($dfs_domain_name['line-height']) ? $dfs_domain_name['line-height'] : '48';
        $domain_name_tablet_font_size = !empty($dfs_domain_name['tablet-font-size']) ? $dfs_domain_name['tablet-font-size'] : '32';
        $domain_name_tablet_line_height = !empty($dfs_domain_name['tablet-line-height']) ? $dfs_domain_name['tablet-line-height'] : '32';
        $domain_name_mobile_font_size = !empty($dfs_domain_name['mobile-font-size']) ? $dfs_domain_name['mobile-font-size'] : '28';
        $domain_name_mobile_line_height = !empty($dfs_domain_name['mobile-line-height']) ? $dfs_domain_name['mobile-line-height'] : '';
        $domain_name_color = !empty($dfs_domain_name['color']) ? $dfs_domain_name['color'] : $primary;

        $dfs_sale_title = isset($template_options['dfs_sale_title']) ? $template_options['dfs_sale_title'] : '';
        $sale_title_font_family = !empty($dfs_sale_title['font-family']) ? $dfs_sale_title['font-family'] : 'Poppins';
        $sale_title_font_weight = !empty($dfs_sale_title['font-weight']) ? $dfs_sale_title['font-weight'] : 'bold';
        $sale_title_font_style =  !empty($dfs_sale_title['font-style']) ? $dfs_sale_title['font-style'] : 'normal';
        $sale_title_text_transform = !empty($dfs_sale_title['text-transform']) ? $dfs_sale_title['text-transform'] : 'none';
        $sale_title_font_size = !empty($dfs_sale_title['font-size']) ? $dfs_sale_title['font-size'] : '38';
        $sale_title_line_height = !empty($dfs_sale_title['line-height']) ? $dfs_sale_title['line-height'] : '38';
        $sale_title_tablet_font_size = !empty($dfs_sale_title['tablet-font-size']) ? $dfs_sale_title['tablet-font-size'] : '32';
        $sale_title_tablet_line_height = !empty($dfs_sale_title['tablet-line-height']) ? $dfs_sale_title['tablet-line-height'] : '';
        $sale_title_mobile_font_size = !empty($dfs_sale_title['mobile-font-size']) ? $dfs_sale_title['mobile-font-size'] : '';
        $sale_title_mobile_line_height = !empty($dfs_sale_title['mobile-line-height']) ? $dfs_sale_title['mobile-line-height'] : '';
        $sale_title_color = !empty($dfs_sale_title['color']) ? $dfs_sale_title['color'] : '';

        $dfs_form_title = isset($template_options['dfs_form_title']) ? $template_options['dfs_form_title'] : '';
        $form_title_font_family = !empty($dfs_form_title['font-family']) ? $dfs_form_title['font-family'] : 'Poppins';
        $form_title_font_weight = !empty($dfs_form_title['font-weight']) ? $dfs_form_title['font-weight'] : 'bold';
        $form_title_font_style =  !empty($dfs_form_title['font-style']) ? $dfs_form_title['font-style'] : 'normal';
        $form_title_text_transform = !empty($dfs_form_title['text-transform']) ? $dfs_form_title['text-transform'] : 'none';
        $form_title_font_size = !empty($dfs_form_title['font-size']) ? $dfs_form_title['font-size'] : '32';
        $form_title_line_height = !empty($dfs_form_title['line-height']) ? $dfs_form_title['line-height'] : '32';
        $form_title_tablet_font_size = !empty($dfs_form_title['tablet-font-size']) ? $dfs_form_title['tablet-font-size'] : '28';
        $form_title_tablet_line_height = !empty($dfs_form_title['tablet-line-height']) ? $dfs_form_title['tablet-line-height'] : '';
        $form_title_mobile_font_size = !empty($dfs_form_title['mobile-font-size']) ? $dfs_form_title['mobile-font-size'] : '';
        $form_title_mobile_line_height = !empty($dfs_form_title['mobile-line-height']) ? $dfs_form_title['mobile-line-height'] : '';
        $form_title_color = !empty($dfs_form_title['color']) ? $dfs_form_title['color'] : $primary;
?>

        <div class="dfs bg--overlay"
            style="
        --primary: <?php echo esc_attr($primary); ?>;
        --secondary: <?php echo esc_attr($secondary); ?>;
        --dfs_container_width: <?php echo esc_attr($dfs_container_width . 'px'); ?>;
        --dfs_gap: <?php echo esc_attr($dfs_gap . 'px'); ?>;
        --background_image: url('<?php echo esc_attr($dfs_background_url); ?>');
        --background_repeat: <?php echo esc_attr($dfs_background_repeat); ?>;
        --background_position: <?php echo esc_attr($dfs_background_position); ?>;
        --background_size: <?php echo esc_attr($dfs_background_size); ?>;
        --dfs_overlay: <?php echo esc_attr($dfs_overlay); ?>;
        --body_font_family: <?php echo esc_attr($body_font_family); ?>;
        --body_font_weight: <?php echo esc_attr($body_font_weight); ?>;
        --body_font_style: <?php echo esc_attr($body_font_style); ?>;
        --body_text_transform: <?php echo esc_attr($body_text_transform); ?>;
        --body_font_size: <?php echo esc_attr($body_font_size . 'px'); ?>;
        --body_line_height: <?php echo esc_attr($body_line_height . 'px'); ?>;
        --body_tablet_font_size: <?php echo esc_attr($body_tablet_font_size . 'px'); ?>;
        --body_tablet_line_height: <?php echo esc_attr($body_tablet_line_height . 'px'); ?>;
        --body_mobile_font_size: <?php echo esc_attr($body_mobile_font_size . 'px'); ?>;
        --body_mobile_line_height: <?php echo esc_attr($body_mobile_line_height . 'px'); ?>;       
        ">
            <div class="dfs__container">
                <div class="dfs__wrapper">
                    <div class="dfs__content">
                        <?php if ($dfs_domain_price_tag) : ?>
                            <div class="dfs__price">
                                <p><?php echo esc_attr($dfs_domain_price_tag); ?></p>
                            </div>
                        <?php endif;
                        if ($dfs_domainName) : ?>
                            <div class="dfs__title"
                                style="
                                --domain_name_font_family: <?php echo esc_attr($domain_name_font_family); ?>;
                                --domain_name_font_weight: <?php echo esc_attr($domain_name_font_weight); ?>;
                                --domain_name_font_style: <?php echo esc_attr($domain_name_font_style); ?>;
                                --domain_name_text_transform: <?php echo esc_attr($domain_name_text_transform); ?>;
                                --domain_name_font_size: <?php echo esc_attr($domain_name_font_size . 'px'); ?>;
                                --domain_name_line_height: <?php echo esc_attr($domain_name_line_height . 'px'); ?>;
                                --domain_name_tablet_font_size: <?php echo esc_attr($domain_name_tablet_font_size . 'px'); ?>;
                                --domain_name_tablet_line_height: <?php echo esc_attr($domain_name_tablet_line_height . 'px'); ?>;
                                --domain_name_mobile_font_size: <?php echo esc_attr($domain_name_mobile_font_size . 'px'); ?>;
                                --domain_name_mobile_line_height: <?php echo esc_attr($domain_name_mobile_line_height . 'px'); ?>; 
                                --domain_name_color: <?php echo esc_attr($domain_name_color); ?>; 
                                ">
                                <h1><?php echo esc_attr($dfs_domainName); ?></h1>
                            </div>
                        <?php endif;
                        if ($dfs_saleTitle) : ?>
                            <div class="dfs__subtitle"
                                style="
                                --sale_title_font_family: <?php echo esc_attr($sale_title_font_family); ?>;
                                --sale_title_font_weight: <?php echo esc_attr($sale_title_font_weight); ?>;
                                --sale_title_font_style: <?php echo esc_attr($sale_title_font_style); ?>;
                                --sale_title_text_transform: <?php echo esc_attr($sale_title_text_transform); ?>;
                                --sale_title_font_size: <?php echo esc_attr($sale_title_font_size . 'px'); ?>;
                                --sale_title_line_height: <?php echo esc_attr($sale_title_line_height . 'px'); ?>;
                                --sale_title_tablet_font_size: <?php echo esc_attr($sale_title_tablet_font_size . 'px'); ?>;
                                --sale_title_tablet_line_height: <?php echo esc_attr($sale_title_tablet_line_height . 'px'); ?>;
                                --sale_title_mobile_font_size: <?php echo esc_attr($sale_title_mobile_font_size . 'px'); ?>;
                                --sale_title_mobile_line_height: <?php echo esc_attr($sale_title_mobile_line_height . 'px'); ?>;
                                --sale_title_color: <?php echo esc_attr($sale_title_color); ?>; 
                            ">
                                <h2><?php echo esc_attr($dfs_saleTitle); ?></h2>
                            </div>
                        <?php endif;
                        if ($dfs_sale_content) : ?>
                            <div class="dfs__content">
                                <?php echo wp_kses_post($dfs_sale_content); ?>
                            </div>
                        <?php endif;
                        if ($dfs_contact_title) : ?>
                            <div class="dfs__contact_info">
                                <?php if ($dfs_contact_title) : ?>
                                    <div class="dfs__contact_info__title">
                                        <p><?php echo esc_attr($dfs_contact_title); ?></p>
                                    </div>
                                <?php endif;
                                foreach ($dfs_contact_infos as $contact) {
                                    $dfs_contact_info_icon = isset($contact['contactinfos-icon']) ? $contact['contactinfos-icon'] : '';
                                    $dfs_contact_info_text = isset($contact['contactinfos-text']) ? $contact['contactinfos-text'] : '';
                                ?>
                                    <p><i class="<?php echo esc_html($dfs_contact_info_icon); ?>"></i>
                                        <?php echo esc_html($dfs_contact_info_text); ?></p>
                                <?php } ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="dfs__wrapper">
                    <div class="dfs__contact">
                        <?php if ($dfs_formTitle) : ?>
                            <div class="dfs__contact__title"
                                style="
                                --form_title_font_family: <?php echo esc_attr($form_title_font_family); ?>;
                                --form_title_font_weight: <?php echo esc_attr($form_title_font_weight); ?>;
                                --form_title_font_style: <?php echo esc_attr($form_title_font_style); ?>;
                                --form_title_text_transform: <?php echo esc_attr($form_title_text_transform); ?>;
                                --form_title_font_size: <?php echo esc_attr($form_title_font_size . 'px'); ?>;
                                --form_title_line_height: <?php echo esc_attr($form_title_line_height . 'px'); ?>;
                                --form_title_tablet_font_size: <?php echo esc_attr($form_title_tablet_font_size . 'px'); ?>;
                                --form_title_tablet_line_height: <?php echo esc_attr($form_title_tablet_line_height . 'px'); ?>;
                                --form_title_mobile_font_size: <?php echo esc_attr($form_title_mobile_font_size . 'px'); ?>;
                                --form_title_mobile_line_height: <?php echo esc_attr($form_title_mobile_line_height . 'px'); ?>;
                                --form_title_color: <?php echo esc_attr($form_title_color); ?>; 
                            ">
                                <h2><?php echo esc_attr($dfs_formTitle); ?></h2>
                            </div>
                        <?php endif;

                        if ('dfs_form' === $dfs_form_type || empty($dfs_form_type)) {
                            echo do_shortcode('[dfs_contact_form]');
                        } else {
                            echo do_shortcode($dfs_thirdparty_shortcode);
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
<?php
    }
}
