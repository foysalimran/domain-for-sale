<?php

namespace ThemeAtelier\DomainForSale\Frontend;

class ContactShortcode
{
    public function dfs_shortcode()
    {
        ob_start();
        $options = get_option('dfs-opt');
        $isDfsRecaptchaEnable = !empty($options['dfs-enable-recaptcha']) ? $options['dfs-enable-recaptcha'] : false;
        $isDfsRecaptchaSiteKey = !empty($options['dfs-recaptcha-sitekey']) ? $options['dfs-recaptcha-sitekey'] : '';
        $dfsRecaptchaType = isset($options['dfs_recaptcha_version']) ? $options['dfs_recaptcha_version'] : 'v2';

        $dfs_name_label = isset($options['dfs-namelabel']) ? $options['dfs-namelabel'] : '';
        $dfs_name_placeholder = isset($options['dfs-nameplaceholder']) ? $options['dfs-nameplaceholder'] : '';
        $dfs_email_label = isset($options['dfs-emaillabel']) ? $options['dfs-emaillabel'] : '';
        $dfs_email_placeholder = isset($options['dfs-emailplaceholder']) ? $options['dfs-emailplaceholder'] : '';
        $dfs_subject_label = isset($options['dfs-subjectlabel']) ? $options['dfs-subjectlabel'] : '';
        $dfs_subject_placeholder = isset($options['dfs-subjectplaceholder']) ? $options['dfs-subjectplaceholder'] : '';
        $dfs_proposal_label = isset($options['dfs-proposallabel']) ? $options['dfs-proposallabel'] : '';
        $dfs_proposal_placeholder = isset($options['dfs-proposalplaceholder']) ? $options['dfs-proposalplaceholder'] : '';
        $dfs_button_label = isset($options['dfs-buttonlabel']) ? $options['dfs-buttonlabel'] : '';

        $dfs_recaptcha_version = !empty($options['dfs_recaptcha_version']) ? $options['dfs_recaptcha_version'] : '';
        $captcha_site_key_v3 = isset($options['dfs-recaptcha-sitekey_v3']) ? $options['dfs-recaptcha-sitekey_v3'] : '';

        if ($isDfsRecaptchaEnable) {
            if ('v2' === $dfs_recaptcha_version) {
                wp_enqueue_script('dfs-recaptcha');
            } else {
                wp_enqueue_script('dfs-recaptcha-v3', '//www.google.com/recaptcha/api.js?render=' . $captcha_site_key_v3, array(), DOMAIN_FOR_SALE_PRO_VERSION, true);
                wp_add_inline_script(
                    'dfs-recaptcha-v3',
                    'grecaptcha.ready(function() {
                grecaptcha.execute("' . $captcha_site_key_v3 . '", {action: "submit"}).then(function(token) {
                    document.getElementById("token").value = token;
                });
            });'
                );
            }
        }


        echo '<form class="form" action="' . esc_url($_SERVER['REQUEST_URI']) . '" method="post">';
        if ($dfs_name_label) :
            echo '<label  class="form-label" for="dfs-name"><span>' . esc_attr($dfs_name_label) . '</span></label>';
        endif;
        echo '<input id="dfs-name" class="form-control" required placeholder="' . esc_html($dfs_name_placeholder) . '" type="text" name="dfs-name" pattern="[a-zA-Z0-9 ]+"/>';

        if ($dfs_email_label) :
            echo '<label  class="form-label" for="dfs-email"><span>' . esc_attr($dfs_email_label) . '</span></label>';
        endif;
        echo '<input id="dfs-email" class="form-control" required placeholder="' . esc_html($dfs_email_placeholder) . '" type="email" name="dfs-email"/>';

        if ($dfs_subject_label) :
            echo '<label  class="form-label" for="dfs-subject"><span>' . esc_attr($dfs_subject_label) . '</span></label>';
        endif;
        echo '<input id="dfs-subject" class="form-control" required placeholder="' . esc_html($dfs_subject_placeholder) . '" type="text" name="dfs-subject"/>';

        if ($dfs_proposal_label) :
            echo '<label  class="form-label" for="dfs-proposal"><span>' . esc_attr($dfs_proposal_label) . '</span></label>';
        endif;
        echo '<textarea id="dfs-proposal" name="dfs-proposal" rows="4" class="form-control field-message"
    placeholder="' . esc_html($dfs_proposal_placeholder) . '"
    required></textarea>';

        if ($isDfsRecaptchaEnable && $dfsRecaptchaType == 'v2') {
            echo '<div class="g-recaptcha" data-sitekey="' . esc_attr($isDfsRecaptchaSiteKey) . '"></div>';
        }


        echo '<input id="dfs_submit" class="btn btn-block" type="submit" name="dfs-submitted" value="' . esc_html($dfs_button_label) . '">';
        echo '</form>';
        return ob_get_clean();
    }
}
