<?php

$options = get_option('dfs-opt');
$dfs_background = !empty($options['dfs-background']['background-image']['url']) ? $options['dfs-background']['background-image']['url'] : DOMAIN_FOR_SALE_DIR_URL . 'src/assets/images/hero-1.webp';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php if ($options['dfs-sitetitle']) : ?>
        <!-- Document Title -->
        <title><?php echo esc_html($options['dfs-sitetitle']); ?></title>
    <?php endif; ?>
    <?php if ($options['dfs-sitedescription']) : ?>
        <!-- Meta -->
        <meta name="description" content="<?php echo esc_attr($options['dfs-sitedescription']); ?>">
    <?php endif; ?>
    <?php if ($options['dfs-sitekeywords']) : ?>
        <meta name="keywords" content="<?php echo esc_attr($options['dfs-sitekeywords']); ?>">
    <?php endif; ?>
    <?php if ($options['dfs-favicon']) : ?>
    <!-- Favicon -->
    <link rel="shortcut icon" href="<?php echo esc_attr($options['dfs-favicon']); ?>" type="image/x-icon">
    <?php endif; ?>

    <?php wp_head(); ?>
</head>
<body>

    <!-- V1 Wrapper Start -->
    <div class="wrapper">
        <!-- Banner Section Start -->
        <div class="banner--section style--2 bg--overlay bg--overlay-fixed" style="background-image:url('<?php echo esc_url($dfs_background); ?>');background-repeat:<?php echo esc_attr($options['dfs-background']['background-repeat']); ?>;background-position:<?php echo esc_attr($options['dfs-background']['background-position']); ?>;background-size:<?php echo esc_attr($options['dfs-background']['background-size']); ?>">
            <!-- Banner Content Start -->
            <div class="banner--content text-center">
                <div class="vc--parent">
                    <div class="vc--child">
                        <div class="container-fluid">
                            <div class="title">

                                <?php if ($options['dfs-domainname']) : ?>
                                    <h1 class="h1 text-uppercase"><?php echo esc_attr($options['dfs-domainname']); ?></h1>
                                <?php endif; ?>

                                <?php if ($options['dfs-pricetag']) : ?>
                                    <p class="tag"><?php echo esc_attr($options['dfs-pricetag']); ?></p>
                                <?php endif; ?>
                            </div>
                            <?php if ($options['dfs-saletitle']) : ?>
                                <div class="sub-title">
                                    <h2 class="h1"><?php echo esc_attr($options['dfs-saletitle']); ?></h2>
                                </div>
                            <?php endif; ?>

                            <?php if ($options['dfs-content']) : ?>
                                <div class="content">
                                    <p><?php echo wp_kses_post($options['dfs-content']); ?></p>
                                </div>
                            <?php endif; ?>

                            <div class="info">
                                <?php if ($options['dfs-contacttitle']) : ?>
                                    <div class="title">
                                        <p><?php echo esc_attr($options['dfs-contacttitle']); ?></p>
                                    </div>
                                <?php endif; ?>
                                <?php foreach ($options['dfs-contactinfos'] as $contact) { ?>
                                    <p><i class="<?php echo esc_html($contact['contactinfos-icon']); ?>"></i>
                                        <?php echo wp_kses_post($contact['contactinfos-text']); ?></p>
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
                            <?php if ($options['dfs-formtitle']) : ?>
                                <h2 class="h2 text-center"><?php echo esc_attr($options['dfs-formtitle']); ?></h2>
                            <?php endif; ?>

                            <?php if ('dfs_form' === $options['dfs_form_type']) {
                                echo do_shortcode('[dfs_contact_form]');
                            } else {
                                echo do_shortcode($options['dfs-thirdparty_shortcode']);
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