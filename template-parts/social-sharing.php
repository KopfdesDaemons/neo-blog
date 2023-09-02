<?php
// #########################################
// Share Buttons
// #########################################

function theme_slug_social_sharing()
{
    // Get current page URL.
    $page_url = get_permalink();

    // Get current page title.
    $page_title = get_the_title();

    // Create Array with Social Sharing links.
    $links = array(
        'facebook' => array(
            'url'  => 'https://www.facebook.com/sharer/sharer.php?u=' . $page_url . '&t=' . $page_title,
            'text' => 'Facebook',
        ),
        'twitter' => array(
            'url'  => 'https://twitter.com/intent/tweet?text=' . $page_title . '&url=' . $page_url,
            'text' => 'Twitter',
        ),
        'reddit' => array(
            'url'  => 'https://reddit.com/submit?url=' . $page_url . '&title=' . $page_title,
            'text' => 'Reddit',
        ),
        'email' => array(
            'url'  => 'mailto:?subject=' . $page_title . '&body=' . $page_url,
            'text' => 'E-Mail',
        )
    );

    // Create HTML list with Social Sharing links.
    $html = '<div class="social-sharing-links"><span>Share:</span><ul>';

    foreach ($links as $key => $link) {
        $html .= sprintf(
            '<li><a class="' . $link['text'] . '" href="%1$s" target="_blank">%2$s</a></li>',
            esc_url($link['url']),
            esc_html($link['text'])
        );
    }

    $html .= '</ul></div>';
    return $html;
}
