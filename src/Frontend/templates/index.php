<?php
$options = get_option('dfs-opt');

// header options
$dfs_site_title = isset($options['dfs-sitetitle']) ? $options['dfs-sitetitle'] : '';
$dfs_site_desc = isset($options['dfs-sitedescription']) ? $options['dfs-sitedescription'] : '';
$dfs_site_keywords = isset($options['dfs-sitekeywords']) ? $options['dfs-sitekeywords'] : '';
$dfs_favicon = isset($options['dfs-favicon']) ? $options['dfs-favicon'] : '';

// background options
$dfs_background = $options['dfs-background'];
$dfs_background_url = !empty($dfs_background['background-image']['url']) ? $dfs_background['background-image']['url'] : DOMAIN_FOR_SALE_DIR_URL . 'src/assets/images/hero-1.webp';
$dfs_background_repeat = isset($dfs_background['background-repeat']) ? $dfs_background['background-repeat'] : ''; 
$dfs_background_position = isset($dfs_background['background-position']) ? $dfs_background['background-position'] : ''; 
$dfs_background_size = isset($dfs_background['background-size']) ? $dfs_background['background-size'] : ''; 

// Page options
$dfs_domain_name = isset($options['dfs-domainname']) ? $options['dfs-domainname'] : '';
$dfs_price_tag = isset($options['dfs-pricetag']) ? $options['dfs-pricetag'] : '';
$dfs_sale_title = isset($options['dfs-saletitle']) ? $options['dfs-saletitle'] : '';
$dfs_content = isset($options['dfs-content']) ? $options['dfs-content'] : '';
$dfs_contact_title = isset($options['dfs-contacttitle']) ? $options['dfs-contacttitle'] : '';
$dfs_contact_infos = isset($options['dfs-contactinfos']) ? $options['dfs-contactinfos'] : '';

$dfs_form_title = isset($options['dfs-formtitle']) ? $options['dfs-formtitle'] : '';
$dfs_form_type = isset($options['dfs_form_type']) ? $options['dfs_form_type'] : '';
$dfs_thirdparty_shortcode = isset($options['dfs-thirdparty_shortcode'])? $options['dfs-thirdparty_shortcode'] : '';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php if ($dfs_site_title) : ?>
        <!-- Document Title -->
        <title><?php echo esc_html($dfs_site_title); ?></title>
    <?php endif; ?>
    <?php if ($dfs_site_desc) : ?>
        <!-- Meta -->
        <meta name="description" content="<?php echo esc_attr($dfs_site_desc); ?>">
    <?php endif; ?>
    <?php if ($dfs_site_keywords) : ?>
        <meta name="keywords" content="<?php echo esc_attr($dfs_site_keywords); ?>">
    <?php endif; ?>
    <?php if ($dfs_favicon) : ?>
    <!-- Favicon -->
    <link rel="shortcut icon" href="<?php echo esc_url($dfs_favicon); ?>" type="image/x-icon">
    <?php endif; ?>

    <?php wp_head(); ?>
</head>
<body>

    <!-- V1 Wrapper Start -->
    <div class="wrapper">
        <!-- Banner Section Start -->
        <div class="banner--section style--2 bg--overlay bg--overlay-fixed" style="background-image:url('<?php echo esc_url($dfs_background_url); ?>');background-repeat:<?php echo esc_attr($dfs_background_repeat); ?>;background-position:<?php echo esc_attr($dfs_background_position); ?>;background-size:<?php echo esc_attr($dfs_background_size); ?>">
            <!-- Banner Content Start -->
            <div class="banner--content text-center">
                <div class="vc--parent">
                    <div class="vc--child">
                        <div class="container-fluid">
                            <div class="title">
                            <?php
                            $dfs_domain_name = isset($options['dfs-domainname']) ? $options['dfs-domainname'] : '';
                            $dfs_price_tag = isset($options['dfs-pricetag']) ? $options['dfs-pricetag'] : '';
                            $dfs_sale_title = isset($options['dfs-saletitle']) ? $options['dfs-saletitle'] : '';
                            $dfs_content = isset($options['dfs-content']) ? $options['dfs-content'] : '';
                            $dfs_contact_title = isset($options['dfs-contacttitle']) ? $options['dfs-contacttitle'] : '';
                            $dfs_contact_infos = isset($options['dfs-contactinfos']) ? $options['dfs-contactinfos'] : '';
                            ?>

                                <?php if ($dfs_domain_name) : ?>
                                    <h1 class="h1 text-uppercase"><?php echo esc_attr($dfs_domain_name); ?></h1>
                                <?php endif; ?>

                                <?php if ($dfs_price_tag) : ?>
                                    <p class="tag"><?php echo esc_attr($dfs_price_tag); ?></p>
                                <?php endif; ?>
                            </div>
                            <?php if ($dfs_sale_title) : ?>
                                <div class="sub-title">
                                    <h2 class="h1"><?php echo esc_attr($dfs_sale_title); ?></h2>
                                </div>
                            <?php endif; ?>

                            <?php if ($dfs_content) : ?>
                                <div class="content">
                                    <p><?php echo wp_kses_post($dfs_content); ?></p>
                                </div>
                            <?php endif; ?>

                            <div class="info">
                                <?php if ($dfs_contact_title) : ?>
                                    <div class="title">
                                        <p><?php echo esc_attr($dfs_contact_title); ?></p>
                                    </div>
                                <?php endif; ?>
                                <?php foreach ($dfs_contact_infos as $contact) {
                                        $dfs_contact_info_icon = isset($contact['contactinfos-icon']) ? $contact['contactinfos-icon'] : '';
                                        $dfs_contact_info_text = isset($contact['contactinfos-text']) ? $contact['contactinfos-text'] : '';
                                    ?>
                                    <p><i class="<?php echo esc_html($dfs_contact_info_icon); ?>"></i>
                                        <?php echo wp_kses_post($dfs_contact_info_text); ?></p>
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
                        <div class="container-fluid" id="contact-form">
                            <?php if ($dfs_form_title) : ?>
                                <h2 class="h2 text-center"><?php echo esc_attr($dfs_form_title); ?></h2>
                            <?php endif; ?>

                            <?php if ('dfs_form' === $dfs_form_type) {
                                echo do_shortcode('[dfs_contact_form]');
                            } else {
                                echo do_shortcode($dfs_thirdparty_shortcode);
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Banner Form End -->
        </div>
        <!-- Banner Section End -->
    </div>
    <!-- V1 Wrapper End -->

    <?php wp_footer(); ?>
</body>

</html>