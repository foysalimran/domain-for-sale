<?php

function dfs_html_form_code()
{
    $options = get_option('dfs-opt');
    echo '<form action="' . esc_url($_SERVER['REQUEST_URI']) . '" method="post" id="contact-form"><div class="contact-form-holder">';

    echo '<div class="row"><div class="col-md-12"><div class="mb-2">';
    if ($options['dfs-namelabel']) :
        echo '<label  class="form-label" for="dfs-name"><span>' . esc_attr($options['dfs-namelabel']) . '</span></label>';
    endif;
    echo '<input id="dfs-name" class="form-control" required placeholder="' . esc_html($options['dfs-nameplaceholder']) . '" type="text" name="dfs-name" pattern="[a-zA-Z0-9 ]+"/>';
    echo '</div></div></div>';

    echo '<div class="row"><div class="col-md-12"><div class="mb-2">';
    if ($options['dfs-emaillabel']) :
        echo '<label  class="form-label" for="dfs-email"><span>' . esc_attr($options['dfs-emaillabel']) . '</span></label>';
    endif;
    echo '<input id="dfs-email" class="form-control" required placeholder="' . esc_html($options['dfs-emailplaceholder']) . '" type="email" name="dfs-email"/>';
    echo '</div></div></div>';

    echo '<div class="row"><div class="col-md-12"><div class="mb-2">';
    if ($options['dfs-subjectlabel']) :
        echo '<label  class="form-label" for="dfs-subject"><span>' . esc_attr($options['dfs-subjectlabel']) . '</span></label>';
    endif;
    echo '<input id="dfs-subject" class="form-control" required placeholder="' . esc_html($options['dfs-subjectplaceholder']) . '" type="text" name="dfs-subject"/>';
    echo '</div></div></div>';

    echo '<div class="row"><div class="col-md-12"><div class="mb-2">';
    if ($options['dfs-proposallabel']) :
        echo '<label  class="form-label" for="dfs-proposal"><span>' . esc_attr($options['dfs-proposallabel']) . '</span></label>';
    endif;
    echo '<textarea id="dfs-proposal" name="dfs-proposal" rows="4" class="form-control field-message"
    placeholder="' . esc_html($options['dfs-proposalplaceholder']) . '"
    required></textarea>';
    echo '</div></div></div>';

    echo '<div class="row"><div class="col-md-12"><input class="btn btn-block" type="submit" name="dfs-submitted" value="' . esc_html($options['dfs-buttonlabel']) . '"></div></div>';
    echo '</div></form>';
}

function dfs_deliver_mail()
{
    $data = array(
        'type' => null,
        'title' => null,
        'description' => null,
        'okay' => null,
    );


    // if the submit button is clicked, send the email
    if (isset($_POST['dfs-submitted'])) {
        // sanitize form values
        $name      = sanitize_text_field($_POST['dfs-name']);
        $email     = sanitize_email($_POST['dfs-email']);
        $subject   = sanitize_text_field($_POST['dfs-subject']);
        $message   = sanitize_textarea_field($_POST['dfs-proposal']);
        $date      = date('F j, Y, H:i (h:i A) (\G\M\T O)');
        $ip = esc_sql(sanitize_text_field($_SERVER['REMOTE_ADDR']));
        $siteURL = get_site_url();
        $options = get_option('dfs-opt');

        $variables = array('{from}', '{subject}', '{email}', '{message}', '{siteURL}', '{date}', '{ip}');
        $values = array($name, $subject, $email, $message, $siteURL, $date, $ip);
        $text = trim(str_replace($variables, $values, $options['dfs-emaitemplate']));
        $headers = array('From: ' . $name . ' <' . $email . '>');

        // If email has been process for sending, display a success message
        if (wp_mail($options['dfs-targetemail'], $subject, $text, $headers)) {
            $data = array(
                'type' => 'success',
                'title' => $options['dfs-success-title'],
                'description' => $options['dfs-success-description'],
                'okay' => null,
            );
        } else {
            $data = array(
                'type' => 'error',
                'title' => $options['dfs-error-title'],
                'description' => $options['dfs-error-description'],
                'okay' => $options['dfs-error-okay'],
            );
        }
    }
    wp_localize_script('dfs-custom', 'confirmation', $data);
}

function dfs_shortcode()
{
    ob_start();
    dfs_deliver_mail();
    dfs_html_form_code();
    return ob_get_clean();
}

add_shortcode('dfs_contact_form', 'dfs_shortcode');
