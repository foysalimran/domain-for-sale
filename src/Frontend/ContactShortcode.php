<?php

namespace ThemeAtelier\DomainForSale\Frontend;

class ContactShortcode
{
    public function dfs_shortcode()
    {
        ob_start();
        $options = get_option('dfs-opt');

        $dfs_name_label = isset($options['dfs-namelabel']) ? $options['dfs-namelabel'] : '';
        $dfs_name_placeholder = isset($options['dfs-nameplaceholder']) ? $options['dfs-nameplaceholder'] : '';
        $dfs_email_label = isset($options['dfs-emaillabel']) ? $options['dfs-emaillabel'] : '';
        $dfs_email_placeholder = isset($options['dfs-emailplaceholder']) ? $options['dfs-emailplaceholder'] : '';
        $dfs_subject_label = isset($options['dfs-subjectlabel']) ? $options['dfs-subjectlabel'] : '';
        $dfs_subject_placeholder = isset($options['dfs-subjectplaceholder']) ? $options['dfs-subjectplaceholder'] : '';
        $dfs_proposal_label = isset($options['dfs-proposallabel']) ? $options['dfs-proposallabel'] : '';
        $dfs_proposal_placeholder = isset($options['dfs-proposalplaceholder']) ? $options['dfs-proposalplaceholder'] : '';
        $dfs_button_label = isset($options['dfs-buttonlabel']) ? $options['dfs-buttonlabel'] : '';      

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

        echo '<input id="dfs_submit" class="btn btn-block" type="submit" name="dfs-submitted" value="' . esc_html($dfs_button_label) . '">';
        echo '</form>';
        return ob_get_clean();
    }
}
