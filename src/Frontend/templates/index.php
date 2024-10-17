<?php

use ThemeAtelier\DomainForSale\Frontend\Templates\Template_01;

// Header options
$dfs_site_title = isset($template_options['dfs-sitetitle']) ? $template_options['dfs-sitetitle'] : '';
$dfs_site_description = isset($template_options['dfs-sitedescription']) ? $template_options['dfs-sitedescription'] : '';
$dfs_site_keywords = isset($template_options['dfs-sitekeywords']) ? $template_options['dfs-sitekeywords'] : '';
$dfs_site_favicon = isset($template_options['dfs-favicon']) ? $template_options['dfs-favicon'] : '';

//Options
$dfs_layout_preset = isset($layout['dfs_layout_preset']) ? $layout['dfs_layout_preset'] : '';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Document Title -->
    <title><?php echo esc_html($dfs_site_title); ?></title>
    <!-- Meta -->
    <meta name="description" content="<?php echo esc_attr($dfs_site_description); ?>">
    <meta name="keywords" content="<?php echo esc_attr($dfs_site_keywords); ?>">
    <?php if ($dfs_site_favicon) : ?>
        <!-- Favicon -->
        <link rel="shortcut icon" href="<?php echo esc_attr($dfs_site_favicon); ?>" type="image/x-icon">
    <?php endif; ?>
    <?php wp_head(); ?>
</head>

<body>

    <?php

    if ('layout_01' === $dfs_layout_preset) :
        Template_01::content($template_options);
    endif;
    wp_footer();
    ?>
</body>

</html>