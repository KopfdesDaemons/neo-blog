<?php
// Function to convert a hex color code to HSL
function neo_blog_hex2hsl($hex)
{
    // Extract RGB values from the hex color code
    list($r, $g, $b) = sscanf($hex, "#%02x%02x%02x");

    // Convert RGB to HSL
    $r /= 255.0;
    $g /= 255.0;
    $b /= 255.0;

    $max = max($r, $g, $b);
    $min = min($r, $g, $b);

    $h = 0;
    $s = 0;
    $l = ($max + $min) / 2;

    if ($max != $min) {
        $d = $max - $min;
        $s = $l > 0.5 ? $d / (2 - $max - $min) : $d / ($max + $min);

        switch ($max) {
            case $r:
                $h = ($g - $b) / $d + ($g < $b ? 6 : 0);
                break;
            case $g:
                $h = ($b - $r) / $d + 2;
                break;
            case $b:
                $h = ($r - $g) / $d + 4;
                break;
        }

        $h /= 6;
    }

    return array(round($h * 360), round($s * 100), round($l * 100));
}

// Get the primary color from the Customizer
$neo_blog_primary_color = esc_attr(get_theme_mod('primary_color', '#1C28C4'));
// Convert the primary color to HSL
list($primary_hue, $saturation, $lightness) = neo_blog_hex2hsl($neo_blog_primary_color);

// Define other colors based on the primary color
$neo_blog_primary_variant_darker = "hsl($primary_hue, " . (max(0, $saturation - 20)) . "%, " . (max(0, $lightness - 20)) . "%)";
$neo_blog_primary_variant_brighter = "hsl($primary_hue, " . (min(100, $saturation + 20)) . "%, " . (min(100, $lightness + 20)) . "%)";
$neo_blog_primary_variant_much_brighter = "hsl($primary_hue, " . (min(100, $saturation + 25)) . "%, " . (min(100, $lightness + 25)) . "%)";
$neo_blog_background_inputfield = "hsl($primary_hue, " . (min(100, $saturation + 45)) . "%, " . (min(100, $lightness + 45)) . "%)";
$neo_blog_background_variant = "hsl($primary_hue, " . (min(100, $saturation + 45)) . "%, " . (min(100, $lightness + 45)) . "%)";
$neo_blog_background_variant_darker = "hsl($primary_hue, " . (min(100, $saturation + 35)) . "%, " . (min(100, $lightness + 35)) . "%)";
?>

<style>
    <?php // Variables from Settings
    $font_color_light_mode = esc_attr(get_theme_mod('font_color_light_mode', '#0a0a0a'));
    $header_font_color_light_mode = esc_attr(get_theme_mod('header_font_color_light_mode', ''));
    $header_menu_font_color = esc_attr(get_theme_mod('header_menu_font_color', ''));

    // Automatic font color for the header if none specified
    if (empty($header_font_color_light_mode)) {
        $header_font_color_light_mode = $font_color_light_mode;
    }

    // primary-variant-darker for header menu if none specified
    if (empty($header_menu_font_color)) {
        $header_menu_font_color = "var(--neo_blog_primary_variant_darker)";
    }

    ?>:root {
        /* Colors */
        --neo_blog_primary_color: <?php echo $neo_blog_primary_color ?>;
        --neo_blog_primary_variant_darker: <?php echo $neo_blog_primary_variant_darker ?>;
        --neo_blog_primary_variant_brighter: <?php echo $neo_blog_primary_variant_brighter ?>;
        --neo_blog_primary_variant_much_brighter: <?php echo $neo_blog_primary_variant_much_brighter ?>;
        --neo_blog_body: <?php echo esc_attr(get_theme_mod('background_color_light_mode', '#F0F0F0')) ?>;
        --neo_blog_element_background: <?php echo esc_attr(get_theme_mod('element_background_color_light_mode', '#f7f7f7')) ?>;
        --neo_blog_font_color: <?php echo $font_color_light_mode ?>;

        --neo_blog_element_background_inputfeld: <?php echo $neo_blog_background_inputfield ?>;
        --neo_blog_element_background_variant: <?php echo $neo_blog_background_variant ?>;
        --neo_blog_element_background_variant_darker: <?php echo $neo_blog_background_variant_darker ?>;

        /* Header Settings */
        --neo_blog_header_font_color: <?php echo esc_attr(get_theme_mod('header_font_color_light_mode', '')) ?>;
        --neo_blog_title_size: <?php echo esc_attr(get_theme_mod('title_size_setting', '25')) . 'px;'
                                ?>;
        --neo_blog_slogan-size: <?php echo esc_attr(get_theme_mod('slogan_size_setting', '14')) . 'px;'
                                ?>;
        --neo_blog_header_menu_font_color: <?php echo esc_attr(get_theme_mod('header_menu_font_color', '')) ?>;
        --neo_blog_header_menu_background_color: <?php echo esc_attr(get_theme_mod('header_menu_background_color', '')) ?>;
        --neo_blog_header_text-background_color: <?php if (get_theme_mod('header_text_background', '')) echo esc_attr('#00000057');
                                                    else echo esc_attr('transparent') ?>;
        --neo_blog_header_gap: <?php echo esc_attr(get_theme_mod('header_gap', '0')) . 'em';
                                ?>;
        /* Font Settings */
        --neo_blog_line_height: <?php echo esc_attr(get_theme_mod('line_heigt', '24')) . 'px;';
                                ?>;

        /* Feed Setting */
        --neo_blog_feed_post_card_line_height: <?php echo esc_attr(get_theme_mod('feed_post_card_line_heigt', '24')) . 'px;';
                                                ?>;
        --neo_blog_feed_post_card_border_radius: <?php echo esc_attr(get_theme_mod('feed_post_card_border_radius', '8')) . 'px;';
                                                    ?>;
        --neo_blog_feed_post_card_padding: <?php echo esc_attr(get_theme_mod('feed_post_card_padding', '1.5')) . 'em;';
                                            ?>;
        --neo_blog_feed_post_card_border_radius_image: <?php echo esc_attr(get_theme_mod('feed_post_card_border_radius_image', '6')) . 'px;';
                                                        ?>;
        --neo_blog_feed_post_card_spacing: <?php echo esc_attr(get_theme_mod('feed_post_card_spacing', '1')) . 'em;';
                                            ?>;
        --neo_blog_feed_image_height: <?php echo esc_attr(get_theme_mod('feed_image_height', '15')) . 'em;';
                                        ?>;
        --neo_blog_image_display_behavior: <?php echo esc_attr(get_theme_mod('image_display_behavior', 'cover'));
                                            ?>;
        --neo_blog_tags_border_radius: <?php echo esc_attr(get_theme_mod('tags_border_radius', '8')) . 'px;';
                                        ?>;
        --neo_blog_max_feed_width: <?php echo esc_attr(get_theme_mod('maximum_width_of_the_feed', '70')) . 'em';
                                    ?>;

        /* Posts Settings */
        --neo_blog_max_posts_width: <?php echo esc_attr(get_theme_mod('maximum_width_of_posts', '70')) . 'em';
                                    ?>;
        --neo_blog_background_color_posts: <?php echo esc_attr(get_theme_mod('background_color_posts', '#0A0A0A00'));
                                            ?>;
        --neo_blog_dark_mode_background_color_posts: <?php echo esc_attr(get_theme_mod('dark_mode_background_color_posts', '#0A0A0A00'));
                                                        ?>;
        --neo_blog_heading_font_size: <?php echo esc_attr(get_theme_mod('heading_font_size', '24')) . 'px;';
                                        ?>;
        --neo_blog_posts_title_alignment: <?php echo esc_attr(get_theme_mod('posts_title_alignment', 'left'));
                                            ?>;

        /* Pages Settings */
        --neo_blog_max_pages_width: <?php echo esc_attr(get_theme_mod('maximum_width_of_pages', '70')) . 'em';
                                    ?>;
        --neo_blog_page_title_alignment: <?php echo esc_attr(get_theme_mod('page_title_alignment', 'left'));
                                            ?>;
        --neo_blog_background_color_pages: <?php echo esc_attr(get_theme_mod('background_color_pages', '#0A0A0A00'));
                                            ?>;
        --neo_blog_dark_mode_background_color_pages: <?php echo esc_attr(get_theme_mod('dark_mode_background_color_pages', '#0A0A0A00'));
                                                        ?>;

        /* Mobile Settings */
        --neo_blog_content_padding: <?php echo esc_attr(get_theme_mod('content_padding', '10') . 'px');
                                    ?>;
        --neo_blog_mobile_feed_padding: <?php echo esc_attr(get_theme_mod('mobile_feed_padding', '5') . 'px');
                                        ?>;

        /* Comments Settings */
        --neo_blog_comments_border_radius: <?php echo esc_attr(get_theme_mod('comments_border_radius', '12') . 'px');
                                            ?>;
        --neo_blog_comments_inner_glow: <?php echo esc_attr(get_theme_mod('comments_inner_glow', '50') . 'px');
                                        ?>;
        --neo_blog_comments_border: <?php if (get_theme_mod('comments_border', true)) echo '1px solid var(--neo_blog_primary_variant_darker)';
                                    else echo 'none' ?>;
        --neo_blog_comments_border_radius_reply_link: <?php echo esc_attr(get_theme_mod('comments_border_radius_reply_link', '8') . 'px');
                                                        ?>;
        --neo_blog_comments_reply_link_position: <?php echo esc_attr(get_theme_mod('comments_reply_link_position', 'flex-start'));
                                                    ?>;
        --neo_blog_comments_name_font_size: <?php echo esc_attr(get_theme_mod('comments_name_font_size', '14')) . 'px;';
                                            ?>;
        --neo_blog_comments_max_height: <?php echo esc_attr(get_theme_mod('comments_max_height', '400') . 'px');
                                        ?>;
        --neo_blog_comments_date_position: <?php echo esc_attr(get_theme_mod('comments_date_position', 'row'));
                                            ?>;
    }


    <?php // Variables from Settings
    $neo_blog_font_color_dark_mode = esc_attr(get_theme_mod('font_color_dark_mode', '#c8c8c8'));
    $neo_blog_header_font_color_dark_mode = esc_attr(get_theme_mod('header_font_color_dark_mode', ''));

    // Automatic font color for the header if none specified
    if (empty($neo_blog_header_font_color_dark_mode)) {
        $neo_blog_header_font_color_dark_mode = $neo_blog_font_color_dark_mode;
    }

    ?>.neo_blog_dark_mode {
        --neo_blog_primary_variant_darker: <?php echo $neo_blog_primary_variant_much_brighter ?>;
        --neo_blog_primary_variant_much_brighter: <?php echo $neo_blog_primary_variant_darker ?>;
        --neo_blog_body: <?php echo esc_attr(get_theme_mod('background_color_dark_mode', '#0a0a0a')) ?>;
        --neo_blog_element_background: <?php echo esc_attr(get_theme_mod('element_background_color_dark_mode', '#16181c')) ?>;
        --neo_blog_font_color: <?php echo $neo_blog_font_color_dark_mode ?>;
        --neo_blog_header_font_color: <?php echo $neo_blog_header_font_color_dark_mode ?>;
        --neo_blog_element_background_inputfeld: <?php echo $neo_blog_background_inputfield ?>;
        --neo_blog_element_background_variant: <?php echo $neo_blog_background_variant_darker ?>;
        --neo_blog_element_background_variant_darker: <?php echo $neo_blog_background_variant ?>;
    }

    body {
        font-family: <?php echo esc_attr(get_theme_mod('body_font', 'Quicksand, sans-serif')) ?>;
    }

    .neo_blog_header::before {
        background-image: url('<?php echo esc_attr(get_theme_mod('header_background_image', '')); ?>');
        filter: <?php echo 'saturate(' . esc_attr(get_theme_mod('header_background_saturation', '80')) . '%)' ?>;
    }
</style>