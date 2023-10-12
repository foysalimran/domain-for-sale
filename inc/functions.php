<?php
$options = get_option('dfs-opt');
$isDfsEnable = isset($options['dfs-enable']) ? $options['dfs-enable'] : '';
if ($isDfsEnable) {
	// Remove theme styles & scripts
	function dfs_remove_theme_styles()
	{
		$wp_scripts = wp_scripts();
		$wp_styles  = wp_styles();
		$themes_uri = get_theme_root_uri();

		foreach ($wp_scripts->registered as $wp_script) {
			if (strpos($wp_script->src, $themes_uri) !== false) {
				wp_deregister_script($wp_script->handle);
			}
		}

		foreach ($wp_styles->registered as $wp_style) {
			if (strpos($wp_style->src, $themes_uri) !== false) {
				wp_deregister_style($wp_style->handle);
			}
		}
	}
	add_action("wp_enqueue_scripts", "dfs_remove_theme_styles", 999);
}


// CSS files

if (!is_admin() ) {
	function dfs_styles()
	{
		// font awesome css
		wp_enqueue_style('fontawesome', DFS_DIR_URL . 'assets/css/font-awesome.min.css', __FILE__);

		// bootstrap css
		wp_enqueue_style('bootstrap', DFS_DIR_URL . 'assets/css/bootstrap.min.css', __FILE__);

		// Sweet alert CSS
		wp_enqueue_style('sweetalert2', DFS_DIR_URL . 'assets/css/sweetalert2.css', __FILE__);

		// main css
		wp_enqueue_style('dfs-main', DFS_DIR_URL . 'assets/css/style.css', __FILE__);

		// responsive css
		wp_enqueue_style('dfs-responsive', DFS_DIR_URL . 'assets/css/responsive.css', __FILE__);

		$options = get_option('dfs-opt');
		// color scheme css
		wp_enqueue_style('dfs-colors', DFS_DIR_URL . 'assets/css/colors/color-' . $options['dfs-scheme'] . '.css', __FILE__);

		// Custom css
		$options = get_option('dfs-opt');
		$overlay = esc_html($options['dfs-overlay']);
		$custom_css = "
			.bg--overlay:before{
					background-color: {$overlay};
			}";
		wp_add_inline_style('dfs-main', $custom_css);
	}
	add_action("wp_enqueue_scripts", "dfs_styles");
}

// JavaScript files

if (!is_admin() && $isDfsEnable) {
	function dfs_scripts()
	{
		wp_enqueue_script('sweet-alert', DFS_DIR_URL . 'assets/js/sweetalert2.min.js', array('jquery'), '1.0', true);
		wp_enqueue_script('dfs-custom', DFS_DIR_URL . 'assets/js/main.js', array('jquery'), '1.0', true);
	}
	add_action("wp_enqueue_scripts", "dfs_scripts");
}

function domain_for_sale_shortcode()
{
    add_meta_box(
        'shoetcode_meta_box', //unique ID
        esc_html__('Shortcode', 'domain-for-sale'), //Name shown in the backend
        'domain_for_sale_shortcode_meta_box', //function to output the meta box
        'templates', //post type this box will attach to
        'side', //position (side,advanced, normal etc)
        'high' //priority (high, default, low etc)
    );
}
add_action('add_meta_boxes', 'domain_for_sale_shortcode');

function domain_for_sale_shortcode_meta_box()
{
    wp_nonce_field('shortcode_meta_box', 'shortcode_meta_box_nonce');
    $data = '[templates id="' . get_the_ID() . '"]';
    echo '<input style="width:100%;display:block;font-weight:bold;font-size:16px;margin-bottom:5px;" id="shortCodeValue" type="text" readonly name="shortcode_meta" value="' . esc_attr($data) . '" />';
    $poststatus = get_post_status(get_the_ID());

    if ('publish' == $poststatus) {
        $copyShortcode = esc_html('Copy shortcode', 'domain-for-sale');
        echo "<div id='shortcodeCopyBtn' class='button button-primary button-large'>{$copyShortcode}</div>";
    }
}

// Creator post type
$args = array(
	'publicly_queryable' 	=> false,
	'show_in_nav_menus' 	=> false,
	'menu_icon' 			=> 'dashicons-admin-site',
	'supports' 				=> array('title'),
	'taxonomies' 			=> array(''),
	'show_in_rest'   		=> true,
);

$args = array(
	'post_type'     		=> 'templates',
	'plural_name'   		=> 'Templates',
	'singular_name' 		=> 'Template',
	'args'          		=> $args,
);

$type = new Domain_For_Sale_Posttype($args);
