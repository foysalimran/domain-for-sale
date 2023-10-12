<?php
// Do not allow directly accessing this file.
if (!defined('ABSPATH')) {
    exit('Direct script access denied.');
}
/**
 * @version    1.0
 * @package    Wonted
 * @author     ThemeAtelier
 *
 * Websites: http://www.themeatelier.net
 *
 *
 */

function domain_for_sale_templates($atts, $content = null)
{
    $attr = shortcode_atts(
        array(
            'id'    => '',
        ),
        $atts
    );


    // Check ID
    if (!empty($atts['id'])) :
        $id = $atts['id'];

        $options = get_option('dfs-opt');

        $templates_meta = get_post_meta($id, 'domain_for_sal_meta', true);

        $template_price_tag = $templates_meta['template_price_tag'];
        $template_domain_name = $templates_meta['template_domain_name'];
        $template_sale_title = $templates_meta['template_sale_title'];
        $template_sale_content = $templates_meta['template_sale_content'];
        $template_contact_title = $templates_meta['template_contact_title'];
        $template_contactinfos = isset($templates_meta['template_contactinfos']) ? $templates_meta['template_contactinfos'] : '';

        ob_start();
?>
        <div class="wrapper">
            <!-- Banner Section Start -->
            <div class="banner--section style--2 bg--overlay bg--overlay-fixed" style="background-image:url('<?php echo esc_attr($templates_meta['template_background']['background-image']['url']); ?>');background-repeat:<?php echo esc_attr($templates_meta['template_background']['background-repeat']); ?>;background-position:<?php echo esc_attr($templates_meta['template_background']['background-position']); ?>;background-size:<?php echo esc_attr($templates_meta['template_background']['background-size']); ?>">
                <!-- Banner Content Start -->
                <div class="banner--content text-center">
                    <div class="vc--parent">
                        <div class="vc--child">
                            <div class="container-fluid">
                                <div class="title">

                                    <?php if ($template_domain_name) : ?>
                                        <h1 class="h1 text-uppercase"><?php echo esc_html($template_domain_name); ?></h1>
                                    <?php endif; ?>

                                    <?php if ($template_price_tag) : ?>
                                        <p class="tag"><?php echo esc_html($template_price_tag); ?></p>
                                    <?php endif; ?>
                                </div>
                                <?php if ($template_sale_title) : ?>
                                    <div class="sub-title">
                                        <h2 class="h1"><?php echo esc_html($template_sale_title); ?></h2>
                                    </div>
                                <?php endif; ?>

                                <?php if ($template_sale_content) : ?>
                                    <div class="content">
                                        <p><?php echo wp_kses_post($template_sale_content); ?></p>
                                    </div>
                                <?php endif; ?>

                                <div class="info">
                                    <?php if ($template_contact_title) : ?>
                                        <div class="title">
                                            <p><?php echo esc_html($template_contact_title); ?></p>
                                        </div>
                                    <?php endif; ?>
                                    <?php foreach ($template_contactinfos as $info) {
                                        $info_icon = $info['contactinfos_icon'];
                                        $info_text = $info['contactinfos_text'];
                                    ?>
                                        <p><?php if ($info_icon) { ?>
                                                <i class="<?php echo esc_attr($info_icon); ?>"></i>

                                            <?php }
                                            if ($info_text) {
                                                echo wp_kses_post($info_text);
                                            } ?>
                                        </p>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Banner Content End -->

                <!-- Banner Form Start -->
                <div class="banner--form">
                    <div class="vc--parent">
                        <div class="vc--child">
                            <div class="container-fluid">
                                <?php if ($options['dfs-formtitle']) : ?>
                                    <h2 class="h2 text-center"><?php echo esc_attr($options['dfs-formtitle']); ?></h2>
                                <?php endif; ?>
                                <?php echo do_shortcode('[dfs_contact_form]'); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Banner Form End -->
            </div>
            <!-- Banner Section End -->
        </div>
<?php
        $html = ob_get_clean();
        return $html;
    endif;
} ?>