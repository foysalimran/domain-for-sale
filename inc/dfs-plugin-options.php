<?php if (!defined('ABSPATH')) {
  die;
} // Cannot access directly.
$prefix = 'dfs-opt';

//
// Create options
//
CSF::createOptions($prefix, array(
  'menu_title' => esc_html__('Domain For Sale', 'domain-for-sale'),
  'menu_slug'  => 'dfs',
  'menu_icon' => 'dashicons-admin-site',
  'framework_title' => 'Domain For Sale <small>by ThemeAtelier</small>',
  'footer_text'             => esc_html__('Thank you for using our product', 'domain-for-sale'),
  'theme'                   => 'dark',
));


// Main options
CSF::createSection($prefix, array(
  'title'  => esc_html__('Main Options', 'domain-for-sale'),
  'icon'   => 'fas fa-home',
  'fields' => array(
    array(
      'type'    => 'subheading',
      'content' => __('<a target="_blank" href="https://1.envato.market/LPeXVY">Upgrate pro</a> to unlock more template versions. Lifetime purchase. There is no monthly/yearly renewals requre.', 'domain-for-sale'),
    ),
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
        '1'     => DFS_DIR_URL_image . 'color-1.png',
        '2'     => DFS_DIR_URL_image . 'color-2.png',
        '3'     => DFS_DIR_URL_image . 'color-3.png',
        '4'     => DFS_DIR_URL_image . 'color-4.png',

      ),
      'default' => '1',
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
        'background-image' => array(
          'url'       =>  DFS_DIR_URL_image . 'hero-1.webp',
        )
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
CSF::createSection($prefix, array(
  'title'  => esc_html__('SEO', 'domain-for-sale'),
  'icon'   => 'fas fa-chart-line',
  'fields' => array(
    array(
      'type'    => 'subheading',
      'content' => __('<a target="_blank" href="https://1.envato.market/LPeXVY">Upgrate pro</a> to unlock more template versions. Lifetime purchase. There is no monthly/yearly renewals requre.', 'domain-for-sale'),
    ),
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
CSF::createSection($prefix, array(
  'title'  => esc_html__('Template Options', 'domain-for-sale'),
  'icon'   => 'fas fa-cogs',
  'fields' => array(
    array(
      'type'    => 'subheading',
      'content' => __('<a target="_blank" href="https://1.envato.market/LPeXVY">Upgrate pro</a> to unlock more template versions. Lifetime purchase. There is no monthly/yearly renewals requre.', 'domain-for-sale'),
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
CSF::createSection($prefix, array(
  'title'  => esc_html__('Contact form', 'domain-for-sale'),
  'icon'   => 'fas fa-envelope',
  'fields' => array(
    array(
      'type'    => 'subheading',
      'content' => __('<a target="_blank" href="https://1.envato.market/LPeXVY">Upgrate pro</a> to unlock more template versions. Lifetime purchase. There is no monthly/yearly renewals requre.', 'domain-for-sale'),
    ),
    array(
      'id'    => 'dfs-formtitle',
      'type'  => 'text',
      'title' => esc_html__('Form title', 'domain-for-sale'),
      'default'  => esc_html__('Make an Offer', 'domain-for-sale'),
    ),
    array(
      'id'    => 'dfs-namelabel',
      'type'  => 'text',
      'title' => esc_html__('Name Field Label', 'domain-for-sale'),
      'default'  => esc_html__('Name*', 'domain-for-sale'),
    ),
    array(
      'id'    => 'dfs-nameplaceholder',
      'type'  => 'text',
      'title' => esc_html__('Name Field Placeholder', 'domain-for-sale'),
      'default'  => esc_html__('Your name', 'domain-for-sale'),
    ),


    array(
      'id'    => 'dfs-emaillabel',
      'type'  => 'text',
      'title' => esc_html__('Email Field Label', 'domain-for-sale'),
      'default'  => 'Email*',
    ),
    array(
      'id'    => 'dfs-emailplaceholder',
      'type'  => 'text',
      'title' => esc_html__('Email Field Placeholder', 'domain-for-sale'),
      'default'  => esc_html__('Your email address*', 'domain-for-sale'),
    ),

    array(
      'id'    => 'dfs-subjectlabel',
      'type'  => 'text',
      'title' => esc_html__('Subject Field Label', 'domain-for-sale'),
      'default'  => esc_html__('Subject*', 'domain-for-sale'),
    ),

    array(
      'id'    => 'dfs-subjectplaceholder',
      'type'  => 'text',
      'title' => esc_html__('Subject Field Placeholder', 'domain-for-sale'),
      'default'  => esc_html__('Write email subject', 'domain-for-sale'),
    ),

    array(
      'id'    => 'dfs-proposallabel',
      'type'  => 'text',
      'title' => esc_html__('Proposal Field Label', 'domain-for-sale'),
      'default'  => esc_html__('Proposal*', 'domain-for-sale'),
    ),

    array(
      'id'    => 'dfs-proposalplaceholder',
      'type'  => 'text',
      'title' => esc_html__('Proposal Field Placeholder', 'domain-for-sale'),
      'default'  => esc_html__('Write your proposal', 'domain-for-sale'),
    ),


    array(
      'id'    => 'dfs-buttonlabel',
      'type'  => 'text',
      'title' => esc_html__('Button Label', 'domain-for-sale'),
      'default'  => esc_html__('Send proposal', 'domain-for-sale'),
    ),


    array(
      'id'    => 'dfs-targetemail',
      'type'  => 'text',
      'title' => esc_html__('Target Email Addresses', 'domain-for-sale'),
      'desc'  => esc_html__('Write your emaill addresses to get email. Multiple email can be separated by comma , eg: info@domain.com,hi@domain.com', 'domain-for-sale'),
      'default' => get_bloginfo('admin_email'),
    ),


    array(
      'id'    => 'dfs-emaitemplate',
      'type'  => 'textarea',
      'title' => esc_html__('Email Template', 'domain-for-sale'),
      'desc'      => esc_html__('Available tags &ndash; {from}, {email}, {subject}, {message}, {date}, {siteURL}, {ip}', 'domain-for-sale'),
      'default'   => esc_html__("Dear Administrator,\nYou have one message from {from} ({email}).\n\n{message}\n\n{date}\n\n This email was submitted from {siteURL}", 'domain-for-sale')
    ),

    array(
      'id'    => 'dfs-success-title',
      'type'  => 'text',
      'title' => esc_html__('Form Success Title', 'domain-for-sale'),
      "default" => esc_html__("Thank You for your proposal!", 'domain-for-sale'),
    ),

    array(
      'id'    => 'dfs-success-description',
      'type'  => 'text',
      'title' => esc_html__('Form Success Description', 'domain-for-sale'),
      "default" => esc_html__("Your message has already arrived! We will contact you shortly.", 'domain-for-sale'),
    ),

    array(
      'id'    => 'dfs-error-title',
      'type'  => 'text',
      'title' => esc_html__('Form Error Title', 'domain-for-sale'),
      "default" => esc_html__("Email not submitted.", 'domain-for-sale'),
    ),

    array(
      'id'    => 'dfs-error-description',
      'type'  => 'text',
      'title' => esc_html__('Form Error Description', 'domain-for-sale'),
      "default" => esc_html__("There might me an error with server instead please send us a direct message at: info@yourdomain.com", 'domain-for-sale'),
    ),
    array(
      'id'    => 'dfs-error-okay',
      'type'  => 'text',
      'title' => esc_html__('Form Okay Button Value', 'domain-for-sale'),
      "default" => esc_html__("Okay", 'domain-for-sale'),
    ),

  )
));
//
// Field: backup
//
CSF::createSection($prefix, array(
  'title'       => esc_html__('Backup', 'ta-ctd'),
  'icon'        => 'fas fa-shield-alt',
  'description' => esc_html__('Export or import to use same settings in different websites.', 'ta-ctd'),
  'fields'      => array(

    array(
      'type' => 'backup',
    ),
  )
));
