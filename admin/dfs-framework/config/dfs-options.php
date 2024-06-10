<?php if (!defined('ABSPATH')) {
  die;
} // Cannot access directly.
$prefix = 'dfs-opt';

//
// Create options
//
DFS::createOptions($prefix, array(
  'menu_title' => esc_html__('Domain For Sale', 'domain-for-sale'),
  'menu_icon' => 'dashicons-admin-site',
  'framework_title' => 'Domain For Sale ',
  'footer_text'             => esc_html__('Thank you for using our product', 'domain-for-sale'),
  'theme'                   => 'light',
  'menu_slug' => 'domain-for-sale',
  'show_reset_section' => true,
  'show_search'        => false,
  'show_all_options'   => false,
  'show_footer'        => false,
  'show_bar_menu' => false,
  'nav' => 'inline',
  'sticky_header'      => true,
  'show_sub_menu'      => false,
  'footer_credit'      => __('If you like <strong>Domain For Sale</strong>, please leave us a <a href="https://wordpress.org/support/plugin/domain-for-sale/reviews/?filter=5#new-post" target="_blank">&#9733;&#9733;&#9733;&#9733;&#9733;</a> rating. Your Review is very important to us as it helps us to grow more.', 'domain-for-sale'),
));


// Main options
DFS::createSection($prefix, array(
  'title'  => esc_html__('GENERAL', 'domain-for-sale'),
  'icon'   => 'fas fa-home',
  'fields' => array(

    // Enable domain for sale mode
    array(
      'id'    => 'dfs-enable',
      'type'  => 'switcher',
      'title' => esc_html__('Enable Domain for sale', 'domain-for-sale'),
      'label' => esc_html__('Turn ON for enable domain for sale mode for your website.', 'domain-for-sale'),
      'default' => false,
    ),

    // Upload favicon
    array(
      'id'    => 'dfs-favicon',
      'type'  => 'upload',
      'title' => esc_html__('Upload favicon', 'domain-for-sale'),
      'lebel' => esc_html__('Use a 32x32 .ico or .png file.', 'domain-for-sale'),
    ),
    // Color scheme
    array(
      'id'          => 'dfs-scheme',
      'type'        => 'image_select',
      'title'       => esc_html__('Select color scheme', 'domain-for-sale'),
      'options'     => array(
        '1'     => DFS_DIR_URL . 'admin/assets/images/color-1.png',
        '2'     => DFS_DIR_URL . 'admin/assets/images/color-2.png',
        '3'     => DFS_DIR_URL . 'admin/assets/images/color-3.png',
        '4'     => DFS_DIR_URL . 'admin/assets/images/color-4.png',
      ),
      'default' => '1',
    ),


    array(
      'id'        => 'dfs-scheme-custom-1',
      'type'      => 'color_group',
      'title'     => esc_html__('Use custom color', 'domain-for-sale-pro'),
      'class'     => 'dfs_pro_option',
      'options'   => array(
        'primary' => esc_html__('Primary', 'domain-for-sale-pro'),
        'secondary' => esc_html__('Secondary', 'domain-for-sale-pro'),
      ),
      'desc'  => 'To unlock unlimited custom colors, <a target="_blank" href="https://1.envato.market/LPeXVY"><i><strong>Upgrade to Pro!</strong></i></a>',
      'default'   => array(
        'primary' => '#44dc46',
        'secondary' => '#3bbf3d',
      ),
    ),

    array(
      'id'      => 'dfs-background',
      'type'    => 'background',
      'title'   => esc_html__('Body Background Image', 'domain-for-sale'),
      'background_color' => false,
      'default' => array(
        'background-position'   => 'center center',
        'background-repeat'     => 'repeat-x',
        'background-attachment' => 'fixed',
        'background-size'       => 'cover',
        
      )
    ),


    array(
      'id'      => 'dfs-overlay',
      'type'    => 'color',
      'title'   => esc_html__('Background Overlay', 'domain-for-sale'),
      'default' => 'rgba(0,0,0,0.7)',
    ),

    // Body Typography
    array(
      'id'               => 'dfs-body-typography',
      'type'             => 'typography',
      'title'            => esc_html__('Body Typography', 'domain-for-sale'),
      'output'  => 'body',
      'text_align'     => false,
      'text_transform' => false,
      'line_height'    => false,
      'letter_spacing' => false,
      'color'          => false,
      'subset'          => false,
      'default'          => array(
        'font-family'    => 'Nunito',
        'font-weight'    => '400',
        'type'           => 'google',
        'font-size'      => '16',
        'line-height'    => '26',
      ),
    ),

    // Heading Typography
    array(
      'id'               => 'dfs-heading-typography',
      'type'             => 'typography',
      'title'            => esc_html__('Heading Typography', 'domain-for-sale'),
      'output'  => 'h1,h2,h3,h4,h5,h6,.h1, .h2, .h3, .h4, .h5, .h6',
      'text_align'     => false,
      'text_transform' => false,
      'line_height'    => false,
      'letter_spacing' => false,
      'color'          => false,
      'subset'          => false,
      'font_size'     => false,
      'line_height'   => false,
      'default'          => array(
        'font-family'    => 'Poppins',
        'font-weight'    => '700',
        'type'           => 'google',
      ),
    ),


  )
));



// Main options
DFS::createSection($prefix, array(
  'title'  => esc_html__('SEO', 'domain-for-sale'),
  'icon'   => 'fas fa-chart-line',
  'fields' => array(

    array(
      'id'    => 'dfs-sitetitle',
      'type'  => 'text',
      'title' => esc_html__('Site Title', 'domain-for-sale'),
      'default'  => get_bloginfo('title'),
    ),

    array(
      'id'    => 'dfs-sitedescription',
      'type'  => 'text',
      'title' => esc_html__('Site Description', 'domain-for-sale'),
    ),

    array(
      'id'    => 'dfs-sitekeywords',
      'type'  => 'textarea',
      'title' => esc_html__('Site Keywords', 'domain-for-sale'),
      'desc'  => esc_html__('Add your site keywords seperated by a comma eg: "business domain, corporate domain"', 'domain-for-sale'),
    ),
  )
));


// Templates options
DFS::createSection($prefix, array(
  'title'  => esc_html__('CONTENT', 'domain-for-sale'),
  'icon'   => 'fas fa-cogs',
  'fields' => array(
    // Template version
    array(
      'id'          => 'dfs-version',
      'type'        => 'image_select',
      'class'       => 'dfs-version-pro',
      'title'       => esc_html__('Select template version', 'domain-for-sale'),
      'desc'  => 'To unlock more templates <a target="_blank" href="https://1.envato.market/LPeXVY"><i><strong>Upgrade to Pro!</strong></i></a>',
      'options'     => array(
        '1'     => DFS_DIR_URL . 'admin/assets/images/version-1.png',
        '2'     => DFS_DIR_URL . 'admin/assets/images/version-2.png',
      ),
      'default' => '1',
    ),

    array(
      'id'    => 'dfs-pricetag',
      'type'  => 'text',
      'title' => esc_html__('Price Tag', 'domain-for-sale'),
      'default'  => esc_html__('Price $200 Only', 'domain-for-sale'),
    ),

    array(
      'id'    => 'dfs-domainname',
      'type'  => 'text',
      'title' => esc_html__('Domain Name', 'domain-for-sale'),
      'default'  => get_site_url(),
    ),
    array(
      'id'    => 'dfs-saletitle',
      'type'  => 'text',
      'title' => esc_html__('Sale Title', 'domain-for-sale'),
      'default'  => esc_html__('is for sale', 'domain-for-sale'),
    ),

    array(
      'id'    => 'dfs-content',
      'type'  => 'wp_editor',
      'title' => esc_html__('Sale Content', 'domain-for-sale'),
      'default'  => esc_html__('The domain name (without content) is available for sale by its owner. Any offer you submit is binding for 7 days. If you require futher information contact with me.', 'domain-for-sale'),
    ),

    array(
      'id'    => 'dfs-contacttitle',
      'type'  => 'text',
      'title' => esc_html__('Contact title', 'domain-for-sale'),
      'default'  => esc_html__('Contact Info:', 'domain-for-sale'),
    ),

    array(
      'id'     => 'dfs-contactinfos',
      'type'   => 'repeater',
      'title'  => esc_html__('Contact informations', 'domain-for-sale'),
      'fields' => array(
        array(
          'id'      => 'contactinfos-icon',
          'type'    => 'icon',
          'title'   => esc_html__('Icon for contact info', 'domain-for-sale'),
        ),
        array(
          'id'    => 'contactinfos-text',
          'type'  => 'text',
          'title' => esc_html__('Contact info', 'domain-for-sale'),
        ),
      ),
      'default' => array(
        array(
          'contactinfos-icon'    => 'far fa-envelope',
          'contactinfos-text'     => esc_html__('info@yourdomain.com', 'domain-for-sale'),
        ),
        array(
          'contactinfos-icon'    => 'fas fa-phone',
          'contactinfos-text'     => esc_html__('(345) 456 789 23', 'domain-for-sale'),
        ),
      ),
    ),

  )
));

// Templates options
DFS::createSection($prefix, array(
  'title'  => esc_html__('CONTACT FORM', 'domain-for-sale'),
  'icon'   => 'fas fa-envelope',
  'fields' => array(
    array(
      'id'       => 'dfs_form_type',
      'type'     => 'button_set',
      'title'    => esc_html__('Form type', 'domain-for-sale'),
      'help'  => esc_html__('Select third-party form for using custom shortcode from any third-party plugins such as: Contact form 7, Ninja form, Fluent form etc', 'domain-for-sale'),
      'options'  => array(
        'dfs_form'   =>  esc_html__('Domain For Sale Form', 'domain-for-sale'),
        'shortcode_form'   => esc_html__('Third-party Form', 'domain-for-sale'),
      ),
      'default'  => array('dfs_form',)
    ),
    array(
      'id'    => 'dfs-formtitle',
      'type'  => 'text',
      'title' => esc_html__('Form title', 'domain-for-sale'),
      'default'  => esc_html__('Make an Offer', 'domain-for-sale'),
    ),

    array(
      'id'  => 'dfs-recaptcha',
      'type'  => 'heading',
      'title' => esc_html__('Form Fields', 'domain-for-sale'),
      'dependency' => array('dfs_form_type', '==', 'dfs_form'),
    ),

    array(
      'id'    => 'dfs-thirdparty_shortcode',
      'type'  => 'textarea',
      'title' => esc_html__('Insert shortcode for contact form', 'domain-for-sale'),
      'dependency' => array('dfs_form_type', '==', 'shortcode_form'),
    ),


    array(
      'id'    => 'dfs-namelabel',
      'type'  => 'text',
      'title' => esc_html__('Name Field Label', 'domain-for-sale'),
      'default'  => esc_html__('Name*', 'domain-for-sale'),
      'dependency' => array('dfs_form_type', '==', 'dfs_form'),
    ),
    array(
      'id'    => 'dfs-nameplaceholder',
      'type'  => 'text',
      'title' => esc_html__('Name Field Placeholder', 'domain-for-sale'),
      'default'  => esc_html__('Your name', 'domain-for-sale'),
      'dependency' => array('dfs_form_type', '==', 'dfs_form'),
    ),


    array(
      'id'    => 'dfs-emaillabel',
      'type'  => 'text',
      'title' => esc_html__('Email Field Label', 'domain-for-sale'),
      'default'  => 'Email*',
      'dependency' => array('dfs_form_type', '==', 'dfs_form'),
    ),
    array(
      'id'    => 'dfs-emailplaceholder',
      'type'  => 'text',
      'title' => esc_html__('Email Field Placeholder', 'domain-for-sale'),
      'default'  => esc_html__('Your email address*', 'domain-for-sale'),
      'dependency' => array('dfs_form_type', '==', 'dfs_form'),
    ),

    array(
      'id'    => 'dfs-subjectlabel',
      'type'  => 'text',
      'title' => esc_html__('Subject Field Label', 'domain-for-sale'),
      'default'  => esc_html__('Subject*', 'domain-for-sale'),
      'dependency' => array('dfs_form_type', '==', 'dfs_form'),
    ),

    array(
      'id'    => 'dfs-subjectplaceholder',
      'type'  => 'text',
      'title' => esc_html__('Subject Field Placeholder', 'domain-for-sale'),
      'default'  => esc_html__('Write email subject', 'domain-for-sale'),
      'dependency' => array('dfs_form_type', '==', 'dfs_form'),
    ),

    array(
      'id'    => 'dfs-proposallabel',
      'type'  => 'text',
      'title' => esc_html__('Proposal Field Label', 'domain-for-sale'),
      'default'  => esc_html__('Proposal*', 'domain-for-sale'),
      'dependency' => array('dfs_form_type', '==', 'dfs_form'),
    ),

    array(
      'id'    => 'dfs-proposalplaceholder',
      'type'  => 'text',
      'title' => esc_html__('Proposal Field Placeholder', 'domain-for-sale'),
      'default'  => esc_html__('Write your proposal', 'domain-for-sale'),
      'dependency' => array('dfs_form_type', '==', 'dfs_form'),
    ),


    array(
      'id'    => 'dfs-buttonlabel',
      'type'  => 'text',
      'title' => esc_html__('Button Label', 'domain-for-sale'),
      'default'  => esc_html__('Send proposal', 'domain-for-sale'),
      'dependency' => array('dfs_form_type', '==', 'dfs_form'),
    ),

    array(
      'id'  => 'dfs-recaptcha',
      'type'  => 'heading',
      'title' => esc_html__('Form Notification', 'domain-for-sale'),
      'dependency' => array('dfs_form_type', '==', 'dfs_form'),
    ),

    array(
      'id'    => 'dfs-targetemail',
      'type'  => 'text',
      'title' => esc_html__('Target Email Addresses', 'domain-for-sale'),
      'desc'  => esc_html__('Write your emaill addresses to get email. Multiple email can be separated by comma , eg: info@domain.com,hi@domain.com', 'domain-for-sale'),
      'default' => get_bloginfo('admin_email'),
      'dependency' => array('dfs_form_type', '==', 'dfs_form'),
    ),


    array(
      'id'    => 'dfs-emaitemplate',
      'type'  => 'textarea',
      'title' => esc_html__('Email Template', 'domain-for-sale'),
      'desc'      => esc_html__('Available tags &ndash; {from}, {email}, {subject}, {message}, {date}, {siteURL}, {ip}', 'domain-for-sale'),
      'default'   => esc_html__("Dear Administrator,\nYou have one message from {from} ({email}).\n\n{message}\n\n{date}\n\n This email was submitted from {siteURL}", 'domain-for-sale'),
      'dependency' => array('dfs_form_type', '==', 'dfs_form'),
    ),


    array(
      'id'  => 'dfs-recaptcha',
      'type'  => 'heading',
      'title' => esc_html__('Email confirmation notices', 'domain-for-sale-pro'),
      'dependency' => array('dfs_form_type', '==', 'dfs_form'),
     
    ),


    array(
      'id'    => 'dfs-success-title',
      'type'  => 'text',
      'title' => esc_html__('Form Success Title', 'domain-for-sale'),
      "default" => esc_html__("Thank You for your proposal!", 'domain-for-sale'),
      'dependency' => array('dfs_form_type', '==', 'dfs_form'),
    ),

    array(
      'id'    => 'dfs-success-description',
      'type'  => 'text',
      'title' => esc_html__('Form Success Description', 'domain-for-sale'),
      "default" => esc_html__("Your message has already arrived! We will contact you shortly.", 'domain-for-sale'),
      'dependency' => array('dfs_form_type', '==', 'dfs_form'),
    ),

    array(
      'id'    => 'dfs-error-title',
      'type'  => 'text',
      'title' => esc_html__('Form Error Title', 'domain-for-sale'),
      "default" => esc_html__("Email not submitted.", 'domain-for-sale'),
      'dependency' => array('dfs_form_type', '==', 'dfs_form'),
    ),

    array(
      'id'    => 'dfs-error-description',
      'type'  => 'text',
      'title' => esc_html__('Form Error Description', 'domain-for-sale'),
      "default" => esc_html__("There might me an error with server instead please send us a direct message at: info@yourdomain.com", 'domain-for-sale'),
      'dependency' => array('dfs_form_type', '==', 'dfs_form'),
    ),
    array(
      'id'    => 'dfs-error-okay',
      'type'  => 'text',
      'title' => esc_html__('Form Okay Button Value', 'domain-for-sale'),
      "default" => esc_html__("Okay", 'domain-for-sale'),
      'dependency' => array('dfs_form_type', '==', 'dfs_form'),
    ),

    // Reacaptcha pro feature



    array(
      'id'  => 'dfs-recaptcha',
      'type'  => 'heading',
      'title' => esc_html__('Google Recaptcha', 'domain-for-sale-pro'),
      'dependency' => array('dfs_form_type', '==', 'dfs_form'),
    ),
    array(
      'id'  => 'submessage',
      'type' => 'submessage',
      'content' => 'reCAPTCHA is a free anti-spam service of Google that protects your website from spam and abuse. <a target="_blank" href="https://1.envato.market/LPeXVY"><b>Available in pro!</b></a>',
    ),
    
    array(
      'id' => 'dfs-enable-recaptcha',
      'type'  => 'switcher',
      'title' => esc_html__('Turn on google recaptcha', 'domain-for-sale-pro'),
      'dependency' => array('dfs_form_type', '==', 'dfs_form'),
      'default' => true,
      'class' => 'pro_only_field',
    ),

    array(
      'id' => 'dfs-recaptcha-sitekey',
      'type'  => 'text',
      'title' => esc_html__('Site key', 'domain-for-sale-pro'),
      'class' => 'pro_only_field',
      'dependency' => array('dfs-enable-recaptcha|dfs_form_type', '==|==', 'true|dfs_form'),
    ),

    array(
      'id' => 'dfs-recaptcha-secretkey',
      'type'  => 'text',
      'class' => 'pro_only_field',
      'title' => esc_html__('Secret key', 'domain-for-sale-pro'),
      'dependency' => array('dfs-enable-recaptcha|dfs_form_type', '==|==', 'true|dfs_form'),
    ),

    array(
      'id'    => 'dfs-recaptcha-error-title',
      'type'  => 'text',
      'class' => 'pro_only_field',
      'title' => esc_html__('Form Recaptcha Error Title', 'domain-for-sale-pro'),
      "default" => esc_html__("Email not submitted.", 'domain-for-sale-pro'),
      'dependency' => array('dfs-enable-recaptcha|dfs_form_type', '==|==', 'true|dfs_form'),
    ),

    array(
      'id'    => 'dfs-recaptcha-error-description',
      'type'  => 'text',
      'class' => 'pro_only_field',
      'title' => esc_html__('Form Recaptcha Error Description', 'domain-for-sale-pro'),
      "default" => esc_html__("Please tick and verify the recaptcha.", 'domain-for-sale-pro'),
      'dependency' => array('dfs-enable-recaptcha|dfs_form_type', '==|==', 'true|dfs_form'),
    ),
    array(
      'id'    => 'dfs-recaptcha-error-okay',
      'type'  => 'text',
      'class' => 'pro_only_field',
      'title' => esc_html__('Form Recaptcha Okay Button Value', 'domain-for-sale-pro'),
      "default" => esc_html__("Okay", 'domain-for-sale-pro'),
      'dependency' => array('dfs-enable-recaptcha|dfs_form_type', '==|==', 'true|dfs_form'),
    ),

  )
));
//
// Field: backup
//
DFS::createSection($prefix, array(
  'title'       => esc_html__('CUSTOM CODES', 'domain-for-sale'),
  'icon'        => 'fas fa-code',
  'fields'      => array(
    array(
      'id'       => 'dfs-custom-css',
      'type'     => 'code_editor',
      'title'    => esc_html__('Custom CSS', 'domain-for-sale'),
      'settings' => array(
        'theme'  => 'mbo',
        'mode'   => 'css',
      ),
    ),

    array(
      'id'       => 'dfs-custom-js',
      'type'     => 'code_editor',
      'title'    => esc_html__('Custom JavaScript', 'domain-for-sale'),
      'settings' => array(
        'theme'  => 'mbo',
        'mode'   => 'js',
      ),
    ),

  )
));

//
// Field: backup
//
DFS::createSection($prefix, array(
  'title'       => esc_html__('BACKUP', 'domain-for-sale'),
  'icon'        => 'fas fa-shield-alt',
  'description' => esc_html__('Export or import to use same settings in different websites.', 'domain-for-sale'),
  'fields'      => array(

    array(
      'type' => 'backup',
    ),
  )
));


// Templates options
DFS::createSection($prefix, array(
  'title'  => esc_html__('GET HELP', 'domain-for-sale'),
  'icon'   => 'fas fa-life-ring',
  'fields' => array(

    array(
      'id'    => 'dfs-formtitletest',
      'type'  => 'text',
      'type'     => 'callback',
      'function' => 'get_help_callback',
    ),


  )
));


function get_help_callback()
{
?>
  <div class="wrap">
    <div class="dfs-help-wrapper">
      <div class="dfs__help--header">
        <h3>Domain For Sale <span><?php echo DOMAIN_FOR_SALE_VERSION; ?></span></h3>
        Thank you for installing <strong>Domain For Sale</strong> plugin! This video will help you get started with the plugin.
      </div>

      <div class="dfs__help--video">
        <iframe width="560" height="315" src="https://www.youtube.com/embed/E_-iUMykP5M?si=oqG2dUks9LR-RZns" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
      </div>

      <div class="dfs__help--footer">
        <a class="button button-primary" href="<?php echo get_admin_url() . '/admin.php?page=domain-for-sale'; ?>">Go to settings page</a>
        <a target="_blank" class="button button-secondary" href="https://1.envato.market/LPeXVY">Upgrade to pro</a>
      </div>

    </div>
  </div>
<?php }
