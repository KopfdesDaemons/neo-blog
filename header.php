<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Open Graph Markup -->
    <meta property="og:title" content="<?php echo esc_attr(get_the_title()); ?>">
    <meta property="og:description" content="<?php echo esc_attr(get_the_excerpt()); ?>">
    <meta property="og:image" content="<?php echo esc_url(get_the_post_thumbnail_url()); ?>">
    <meta property="og:url" content="<?php echo esc_url(get_permalink()); ?>">
    <meta property="og:type" content="article">
    <meta property="og:locale" content="<?php echo esc_attr(get_locale()); ?>">
    <meta property="og:site_name" content="<?php echo esc_attr(get_bloginfo('name')); ?>">

    <!-- Other Meta Tags for SEO and Other Purposes -->
    <meta name="description" content="<?php echo esc_attr(get_the_excerpt()); ?>">

    <?php if (is_singular() && pings_open()) { ?>
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <?php }

    wp_head(); ?>

    <?php
    // Function to convert a hex color code to HSL
    function hex2hsl($hex)
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
    $neo_primary_color = get_theme_mod('primary_color', '#1C28C4');
    // Convert the primary color to HSL
    list($primary_hue, $saturation, $lightness) = hex2hsl($neo_primary_color);

    // Define other colors based on the primary color
    $neo_primary_variant_darker = "hsl($primary_hue, " . (max(0, $saturation - 20)) . "%, " . (max(0, $lightness - 20)) . "%)";
    $neo_primary_variant_brighter = "hsl($primary_hue, " . (min(100, $saturation + 20)) . "%, " . (min(100, $lightness + 20)) . "%)";
    $neo_primary_variant_much_brighter = "hsl($primary_hue, " . (min(100, $saturation + 25)) . "%, " . (min(100, $lightness + 25)) . "%)";
    $neo_background_inputfield = "hsl($primary_hue, " . (min(100, $saturation + 45)) . "%, " . (min(100, $lightness + 45)) . "%)";
    $neo_background_variant = "hsl($primary_hue, " . (min(100, $saturation + 45)) . "%, " . (min(100, $lightness + 45)) . "%)";
    $neo_background_variant_darker = "hsl($primary_hue, " . (min(100, $saturation + 35)) . "%, " . (min(100, $lightness + 35)) . "%)";
    ?>

    <style>
        <?php // Variables from Settings
        $font_color_light_mode = get_theme_mod('font_color_light_mode', '#0a0a0a');
        $header_font_color_light_mode = get_theme_mod('header_font_color_light_mode', '');
        $header_menu_font_color = get_theme_mod('header_menu_font_color', '');

        // Automatic font color for the header if none specified
        if (empty($header_font_color_light_mode)) {
            $header_font_color_light_mode = $font_color_light_mode;
        }

        // primary-variant-darker for header menu if none specified
        if (empty($header_menu_font_color)) {
            $header_menu_font_color = "var(--neo_primary_variant_darker)";
        }

        ?>:root {
            /* Colors */
            --neo_primary_color: <?php echo $neo_primary_color ?>;
            --neo_primary_variant_darker: <?php echo $neo_primary_variant_darker ?>;
            --neo_primary_variant_brighter: <?php echo $neo_primary_variant_brighter ?>;
            --neo_primary_variant_much_brighter: <?php echo $neo_primary_variant_much_brighter ?>;
            --neo_body: <?php echo esc_attr(get_theme_mod('background_color_light_mode', '#F0F0F0')) ?>;
            --neo_element_background: <?php echo esc_attr(get_theme_mod('element_background_color_light_mode', '#f7f7f7')) ?>;
            --neo_font_color: <?php echo $font_color_light_mode ?>;

            --neo_element_background-inputfeld: <?php echo $neo_background_inputfield ?>;
            --neo_element_background_variant: <?php echo $neo_background_variant ?>;
            --neo_element_background_variant-darker: <?php echo $neo_background_variant_darker ?>;

            /* Header Settings */
            --neo_header_font_color: <?php echo esc_attr(get_theme_mod('header_font_color_light_mode', '')) ?>;
            --neo_title_size: <?php echo esc_attr(get_theme_mod('title_size_setting', '25')) . 'px;'
                                ?>;
            --neo_slogan-size: <?php echo esc_attr(get_theme_mod('slogan_size_setting', '14')) . 'px;'
                                ?>;
            --neo_header_menu_font_color: <?php echo esc_attr(get_theme_mod('header_menu_font_color', '')) ?>;
            --neo_header_menu_background_color: <?php echo esc_attr(get_theme_mod('header_menu_background_color', '')) ?>;
            --neo_header_text-background_color: <?php if (get_theme_mod('header_text_background', '')) echo esc_attr('#00000057');
                                                else echo esc_attr('transparent') ?>;
            --neo_header-gap: <?php echo esc_attr(get_theme_mod('header_gap', '0')) . 'em';
                                ?>;
            /* Font Settings */
            --neo_line_height: <?php echo esc_attr(get_theme_mod('line_heigt', '24')) . 'px;';
                                ?>;

            /* Feed Setting */
            --neo_feed_post_card_line_height: <?php echo esc_attr(get_theme_mod('feed_post_card_line_heigt', '24')) . 'px;';
                                                ?>;
            --neo_feed_post_card_border_radius: <?php echo esc_attr(get_theme_mod('feed_post_card_border_radius', '12')) . 'px;';
                                                ?>;
            --neo_feed_post_card_padding: <?php echo esc_attr(get_theme_mod('feed_post_card_padding', '1.5')) . 'em;';
                                            ?>;
            --neo_feed_post_card_border_radius_image: <?php echo esc_attr(get_theme_mod('feed_post_card_border_radius_image', '10')) . 'px;';
                                                        ?>;
            --neo_feed_post_card_spacing: <?php echo esc_attr(get_theme_mod('feed_post_card_spacing', '1')) . 'em;';
                                            ?>;
            --neo_feed_image_height: <?php echo esc_attr(get_theme_mod('feed_image_height', '15')) . 'em;';
                                        ?>;
            --neo_image_display_behavior: <?php echo esc_attr(get_theme_mod('image_display_behavior', 'cover'));
                                            ?>;
            --neo_tags_border_radius: <?php echo esc_attr(get_theme_mod('tags_border_radius', '32')) . 'px;';
                                        ?>;
            --neo_max_feed_width: <?php echo esc_attr(get_theme_mod('maximum_width_of_the_feed', '70')) . 'em';
                                    ?>;

            /* Posts Settings */
            --neo_max_posts_width: <?php echo esc_attr(get_theme_mod('maximum_width_of_posts', '70')) . 'em';
                                    ?>;
            --neo_background_color_posts: <?php echo esc_attr(get_theme_mod('background_color_posts', '#0A0A0A00'));
                                            ?>;
            --neo_dark_mode_background_color_posts: <?php echo esc_attr(get_theme_mod('dark_mode_background_color_posts', '#0A0A0A00'));
                                                    ?>;
            --neo_heading_font_size: <?php echo esc_attr(get_theme_mod('heading_font_size', '28')) . 'px;';
                                        ?>;
            --neo_posts_title_alignment: <?php echo esc_attr(get_theme_mod('posts_title_alignment', 'left'));
                                            ?>;

            /* Pages Settings */
            --neo_max_pages_width: <?php echo esc_attr(get_theme_mod('maximum_width_of_pages', '70')) . 'em';
                                    ?>;
            --neo_page_title_alignment: <?php echo esc_attr(get_theme_mod('page_title_alignment', 'left'));
                                        ?>;
            --neo_background_color_pages: <?php echo esc_attr(get_theme_mod('background_color_pages', '#0A0A0A00'));
                                            ?>;
            --neo_dark_mode_background_color_pages: <?php echo esc_attr(get_theme_mod('dark_mode_background_color_pages', '#0A0A0A00'));
                                                    ?>
        }


        <?php // Variables from Settings
        $neo_font_color_dark_mode = esc_attr(get_theme_mod('font_color_dark_mode', '#c8c8c8'));
        $neo_header_font_color_dark_mode = esc_attr(get_theme_mod('header_font_color_dark_mode', ''));

        // Automatic font color for the header if none specified
        if (empty($neo_header_font_color_dark_mode)) {
            $neo_header_font_color_dark_mode = $neo_font_color_dark_mode;
        }

        ?>.darkmode {
            --neo_primary_variant_darker: <?php echo $neo_primary_variant_much_brighter ?>;
            --neo_primary_variant_much_brighter: <?php echo $neo_primary_variant_darker ?>;
            --neo_body: <?php echo esc_attr(get_theme_mod('background_color_dark_mode', '#0a0a0a')) ?>;
            --neo_element_background: <?php echo esc_attr(get_theme_mod('element_background_color_dark_mode', '#16181c')) ?>;
            --neo_font_color: <?php echo $neo_font_color_dark_mode ?>;
            --neo_header_font_color: <?php echo $neo_header_font_color_dark_mode ?>;
            --neo_element_background-inputfeld: <?php echo $neo_background_inputfield ?>;
            --neo_element_background_variant: <?php echo $neo_background_variant_darker ?>;
            --neo_element_background_variant-darker: <?php echo $neo_background_variant ?>;
        }

        body {
            font-family: <?php echo esc_attr(get_theme_mod('body_font', 'Quicksand, sans-serif')) ?>;
        }

        .header::before {
            background-image: url('<?php echo esc_attr(get_theme_mod('header_background_image', '')); ?>');
            filter: <?php echo 'saturate(' . esc_attr(get_theme_mod('header_background_saturation', '80')) . '%)' ?>;
        }
    </style>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <?php $fixedHeader = get_theme_mod('fixed_header', false); ?>
    <header id="header" class="clearfix header <?php if ($fixedHeader) echo 'fixedHeader' ?>" role="banner">
        <div class="headerDiv">

            <!-- Title -->
            <?php
            $title = get_theme_mod('title', true);
            if ($title) {
                $title = get_bloginfo('title');
                echo '<div class="titleDiv"><a href="' . esc_url(home_url('/')) . '">
                    <span class="site-title">' . esc_html($title) . '</span>
                </a>
            </div>';
            }
            ?>

            <!-- Slogan -->
            <?php
            $tagline = get_theme_mod('tagline', true);
            if ($tagline) {
                $description = get_bloginfo('description');
                echo '<div class="sloganDiv"><span>' . esc_html($description) . '</span></div>';
            }
            ?>

            <!-- Banner -->
            <?php
            $image_url = get_theme_mod('header_banner', '');
            if ($image_url) {
                echo '<img class="headerBanner" src="' . esc_url($image_url) . '" alt="Header Banner">';
            }
            ?>

            <!-- Toggle button, Menu and Search -->
            <div class="toggleDiv">
                <?php
                $home_page_link = get_theme_mod('home_page_link', true);
                if ($home_page_link) { ?>
                    <a href="/" class="home-link" title="<?php echo __('Home page', 'neo') ?>">
                        <i class="fa-solid fa-house"></i>
                    </a>
                <?php } ?>
                <button id="headerMenuBtn" onclick="toggleMenu()"><i class="fa-solid fa-bars"></i></button>

                <?php
                $searchbar = get_theme_mod('searchbar', false);
                if ($searchbar) {
                    echo '<div class="SearchColumn"><div class="searchDiv">';
                    get_search_form(array('button_text' => 's'));
                    echo '</div></div>';
                }
                ?>
            </div>
            <div class="mobileExpandedMenu">
                <nav class="headerMenuColumn">
                    <?php
                    $home_page_link = get_theme_mod('home_page_link', true);
                    if ($home_page_link) { ?>
                        <a href="/" class="home-link" title="<?php echo __('Home page', 'neo') ?>">
                            <i class="fa-solid fa-house"></i>
                        </a>
                    <?php } ?>
                    <?php
                    $header_menu = get_theme_mod('header_menu', true);
                    if ($header_menu) {
                        wp_nav_menu(array('theme_location' => 'header-menu'));
                    }
                    ?>
                </nav>
            </div>
        </div>
    </header>
</body>

</html>