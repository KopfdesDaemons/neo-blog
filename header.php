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
    $primary_color = get_theme_mod('primary_color', '#370d07');
    // Convert the primary color to HSL
    list($primary_hue, $saturation, $lightness) = hex2hsl($primary_color);

    // Define other colors based on the primary color
    $primary_variant_darker = "hsl($primary_hue, " . (max(0, $saturation - 20)) . "%, " . (max(0, $lightness - 20)) . "%)";
    $primary_variant_brighter = "hsl($primary_hue, " . (min(100, $saturation + 20)) . "%, " . (min(100, $lightness + 20)) . "%)";
    $primary_variant_much_brighter = "hsl($primary_hue, " . (min(100, $saturation + 25)) . "%, " . (min(100, $lightness + 25)) . "%)";
    $hintergrund_inputfeld = "hsl($primary_hue, " . (min(100, $saturation + 45)) . "%, " . (min(100, $lightness + 45)) . "%)";
    $hintergrund_variant = "hsl($primary_hue, " . (min(100, $saturation + 45)) . "%, " . (min(100, $lightness + 45)) . "%)";
    $hintergrund_variant_darker = "hsl($primary_hue, " . (min(100, $saturation + 35)) . "%, " . (min(100, $lightness + 35)) . "%)";
    ?>

    <style>
        <?php // Variables from Settings
        $font_color_light_mode = get_theme_mod('font_color_light_mode');
        $header_font_color_light_mode = get_theme_mod('header_font_color_light_mode');
        $header_menu_font_color = get_theme_mod('header_menu_font_color');

        // Automatic font color for the header if none specified
        if (empty($header_font_color_light_mode)) {
            $header_font_color_light_mode = $font_color_light_mode;
        }

        // primary-variant-darker for header menu if none specified
        if (empty($header_menu_font_color)) {
            $header_menu_font_color = "var(--primary-variant-darker)";
        }

        ?>:root {
            /* Colors */
            --primary-color: <?php echo esc_attr(get_theme_mod('primary_color')) ?>;
            --primary-variant-darker: <?php echo esc_attr(get_theme_mod('primary_variant_darker')) ?>;
            --primary-variant-brighter: <?php echo esc_attr(get_theme_mod('primary_variant_brighter')) ?>;
            --primary-variant-much-brighter: <?php echo esc_attr(get_theme_mod('primary_variant_much_brighter')) ?>;
            --body: <?php echo esc_attr(get_theme_mod('background_color_light_mode')) ?>;
            --hintergrund: <?php echo esc_attr(get_theme_mod('element_background_color_light_mode')) ?>;
            --schrift: <?php echo esc_attr(get_theme_mod('font_color_light_mode')) ?>;
            --hintergrund-inputfeld: <?php echo esc_attr(get_theme_mod('hintergrund_inputfeld')) ?>;
            --hintergrund-variant: <?php echo esc_attr(get_theme_mod('hintergrund_variant')) ?>;
            --hintergrund-variant-darker: <?php echo esc_attr(get_theme_mod('hintergrund_variant_darker')) ?>;

            /* Header Settings */
            --header-font-color: <?php echo esc_attr(get_theme_mod('header_font_color_light_mode')) ?>;
            --title-size: <?php echo esc_attr(get_theme_mod('title_size_setting')) . 'px;'
                            ?>;
            --slogan-size: <?php echo esc_attr(get_theme_mod('slogan_size_setting')) . 'px;'
                            ?>;
            --header-menu-font-color: <?php echo esc_attr(get_theme_mod('header_menu_font_color')) ?>;
            --header-menu-background-color: <?php echo esc_attr(get_theme_mod('header_menu_background_color')) ?>;
            --header-text-background-color: <?php if (get_theme_mod('header_text_background')) echo esc_attr('#00000057');
                                            else echo esc_attr('transparent') ?>;
            --header-gap: <?php echo esc_attr(get_theme_mod('header_gap')) . 'em';
                            ?>
                /* Font Settings */
                --line-height: <?php echo esc_attr(get_theme_mod('line_heigt')) . 'px;';
                                ?>;

            /* Feed Setting */
            --feed_post_card_line_height: <?php echo esc_attr(get_theme_mod('feed_post_card_line_heigt')) . 'px;';
                                            ?>;
            --feed_post_card_border_radius: <?php echo esc_attr(get_theme_mod('feed_post_card_border_radius')) . 'px;';
                                            ?>;
            --feed_post_card_padding: <?php echo esc_attr(get_theme_mod('feed_post_card_padding')) . 'em;';
                                        ?>;
            --feed_post_card_border_radius_image: <?php echo esc_attr(get_theme_mod('feed_post_card_border_radius_image')) . 'px;';
                                                    ?>;
            --feed_post_card_spacing: <?php echo esc_attr(get_theme_mod('feed_post_card_spacing')) . 'em;';
                                        ?>;
            --feed_image_height: <?php echo esc_attr(get_theme_mod('feed_image_height')) . 'em;';
                                    ?>;
            --image_display_behavior: <?php echo esc_attr(get_theme_mod('image_display_behavior'));
                                        ?>;
            --tags_border_radius: <?php echo esc_attr(get_theme_mod('tags_border_radius')) . 'px;';
                                    ?>;
            --max_feed_width: <?php echo esc_attr(get_theme_mod('maximum_width_of_the_feed')) . 'em';
                                ?>;
            --max_posts_width: <?php echo esc_attr(get_theme_mod('maximum_width_of_posts')) . 'em';
                                ?>;

            /* Posts Settings */
            --background_color_posts: <?php echo esc_attr(get_theme_mod('background_color_posts'));
                                        ?>;
            --dark_mode_background_color_posts: <?php echo esc_attr(get_theme_mod('dark_mode_background_color_posts'));
                                                ?>;
            --heading_font_size: <?php echo esc_attr(get_theme_mod('heading_font_size')) . 'px;';
                                    ?>;
        }


        <?php // Variables from Settings
        $font_color_dark_mode = esc_attr(get_theme_mod('font_color_dark_mode'));
        $header_font_color_dark_mode = esc_attr(get_theme_mod('header_font_color_dark_mode'));

        // Automatic font color for the header if none specified
        if (empty($header_font_color_dark_mode)) {
            $header_font_color_dark_mode = $font_color_dark_mode;
        }

        ?>.darkmode {
            --primary-variant-darker: <?php echo $primary_variant_much_brighter ?>;
            --primary-variant-much-brighter: <?php echo $primary_variant_darker ?>;
            --body: <?php echo esc_attr(get_theme_mod('background_color_dark_mode')) ?>;
            --hintergrund: <?php echo esc_attr(get_theme_mod('element_background_color_dark_mode')) ?>;
            --schrift: <?php echo $font_color_dark_mode ?>;
            --header-font-color: <?php echo $header_font_color_dark_mode ?>;
            --hintergrund-inputfeld: <?php echo $hintergrund_inputfeld ?>;
            --hintergrund-variant: <?php echo $hintergrund_variant ?>;
            --hintergrund-variant-darker: <?php echo $hintergrund_variant_darker ?>;
        }

        body {
            font-family: <?php echo esc_attr(get_theme_mod('body_font', '"Quicksand"')) ?>;
        }

        .header::before {
            background-image: url('<?php echo esc_attr(get_theme_mod('header_background_image')); ?>');
            filter: <?php echo 'saturate(' . esc_attr(get_theme_mod('header_background_saturation')) . '%)' ?>;
        }
    </style>


    <script>
        function toggleMenu() {
            var menu = document.querySelector('.mobileExpandedMenu');
            menu.classList.toggle('headerMenuOpen');
        }

        function addMarginToBody() {
            const header = document.querySelector('.header');
            if (!header.classList.contains('fixedHeader')) return;
            const height = header.offsetHeight;
            const main = document.querySelector('main');
            main.style.marginTop = height + 15 + 'px';
        }

        window.addEventListener("DOMContentLoaded", function() {
            const header = document.querySelector('.header');
            if (!header.classList.contains('fixedHeader')) return;
            addMarginToBody()
            window.addEventListener('resize', function(event) {
                addMarginToBody()
            }, true);
        }, false);
    </script>

</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <?php $fixedHeader = get_theme_mod('fixed_header', false); ?>
    <header id="header" class="clearfix header <?php if ($fixedHeader) echo 'fixedHeader' ?>" role="banner">
        <div class="headerDiv">

            <!-- Title -->
            <?php
            $title = get_theme_mod('title', false);
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
            $tagline = get_theme_mod('tagline', false);
            if ($tagline) {
                $description = get_bloginfo('description');
                echo '<div class="sloganDiv"><span>' . esc_html($description) . '</span></div>';
            }
            ?>

            <!-- Banner -->
            <?php
            $image_url = get_theme_mod('header_banner');
            if ($image_url) {
                echo '<img class="headerBanner" src="' . esc_url($image_url) . '" alt="Header Banner">';
            }
            ?>

            <!-- Toggle button, Menu and Search -->
            <div class="toggleDiv">
                <?php
                $home_page_link = get_theme_mod('home_page_link');
                if ($home_page_link) { ?>
                    <a href="/" class="home-link" title="<?php echo __('Home page', 'my-theme') ?>">
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
                    $home_page_link = get_theme_mod('home_page_link');
                    if ($home_page_link) { ?>
                        <a href="/" class="home-link" title="<?php echo __('Home page', 'my-theme') ?>">
                            <i class="fa-solid fa-house"></i>
                        </a>
                    <?php } ?>
                    <?php
                    $header_menu = get_theme_mod('header_menu', false);
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