<?php

namespace ThemeAtelier\DomainForSale\Frontend;

class ContactShortcode
{
    public function dfs_shortcode()
    {
        ob_start();
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
            $siteURL   = get_site_url();
            $options = get_option('dfs-opt');
            $dfs_target_mail = isset($options['dfs-targetemail']) ? $options['dfs-targetemail'] : '';
            $dfs_success_title = isset($options['dfs-success-title']) ? $options['dfs-success-title'] : '';
            $dfs_success_description = isset($options['dfs-success-description']) ? $options['dfs-success-description'] : '';

            $dfs_error_title = isset($options['dfs-error-title']) ? $options['dfs-error-title'] : '';
            $dfs_error_description = isset($options['dfs-error-description']) ? $options['dfs-error-description'] : '';
            $dfs_error_okay = isset($options['dfs-error-okay']) ? $options['dfs-error-okay'] : '';

            $variables = array('{from}', '{email}', '{message}', '{date}', '{ip}', '{subject}', '{siteURL}');
            $values    = array($name, $email, $message, $date, $ip, $subject, $siteURL);
            $text = trim(str_replace($variables, $values, $options['dfs-emaitemplate']));
            $headers = array('From: ' . $name . ' <' . $email . '>');
            // If email has been process for sending, display a success message
            if (wp_mail($dfs_target_mail, $subject, $text, $headers)) {
                $data = array(
                    'type' => 'success',
                    'title' => $dfs_success_title,
                    'description' => $dfs_success_description,
                    'okay' => null,
                );
            } else {
                $data = array(
                    'type' => 'error',
                    'title' => $dfs_error_title,
                    'description' => $dfs_error_description,
                    'okay' => $dfs_error_okay,
                );
            }
        }
        wp_localize_script('domain-for-sale-script', 'confirmation', $data);


        $options = get_option('dfs-opt');
        $dfs_name_label = isset($options['dfs-namelabel']) ? $options['dfs-namelabel'] : '';
        $dfs_name_placeholder = isset($options['dfs-nameplaceholder']) ? $options['dfs-nameplaceholder'] : '';

        $dfs_email_label = isset($options['dfs-emaillabel']) ? $options['dfs-emaillabel'] : '';
        $dfs_email_placeholder = isset($options['dfs-emailplaceholder']) ? $options['dfs-emailplaceholder'] : '';

        $dfs_subject_label = isset($options['dfs-subjectlabel']) ? $options['dfs-subjectlabel'] : '';
        $dfs_subject_placeholder = isset($options['dfs-subjectplaceholder'])? $options['dfs-subjectplaceholder'] : '';



        echo '<form action="' . esc_url($_SERVER['REQUEST_URI']) . '" method="post"><div class="contact-form-holder">';
        echo '<div class="row"><div class="col-md-12"><div class="mb-2">';
        if ($dfs_name_label) :
            echo '<label  class="form-label" for="dfs-name"><span>' . esc_attr($dfs_name_label) . '</span></label>';
        endif;
        echo '<input id="dfs-name" class="form-control" required placeholder="' . esc_html($dfs_name_placeholder) . '" type="text" name="dfs-name" pattern="[a-zA-Z0-9 ]+"/>';
        echo '</div></div></div>';

        echo '<div class="row"><div class="col-md-12"><div class="mb-2">';
        if ($dfs_email_label) :
            echo '<label  class="form-label" for="dfs-email"><span>' . esc_attr($dfs_email_label) . '</span></label>';
        endif;
        echo '<input id="dfs-email" class="form-control" required placeholder="' . esc_html($dfs_email_placeholder) . '" type="email" name="dfs-email"/>';
        echo '</div></div></div>';

        echo '<div class="row"><div class="col-md-12"><div class="mb-2">';
        if ($dfs_subject_label) :
            echo '<label  class="form-label" for="dfs-subject"><span>' . esc_attr($dfs_subject_label) . '</span></label>';
        endif;
        echo '<input id="dfs-subject" class="form-control" required placeholder="' . esc_html($dfs_subject_placeholder) . '" type="text" name="dfs-subject"/>';
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
        return ob_get_clean();
    }
}
