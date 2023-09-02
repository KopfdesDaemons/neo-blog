<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Open Graph-Markup -->
    <meta property="og:title" content="<?php echo esc_attr(get_the_title()); ?>">
    <meta property="og:description" content="<?php echo esc_attr(get_the_excerpt()); ?>">
    <meta property="og:image" content="<?php echo esc_url(get_the_post_thumbnail_url()); ?>">
    <meta property="og:url" content="<?php echo esc_url(get_permalink()); ?>">
    <meta property="og:type" content="article">
    <meta property="og:locale" content="<?php echo esc_attr(get_locale()); ?>">
    <meta property="og:site_name" content="<?php echo esc_attr(get_bloginfo('name')); ?>">

    <!-- Weitere Meta-Tags für SEO und andere Zwecke -->
    <meta name="description" content="<?php echo esc_attr(get_the_excerpt()); ?>">

    <?php if (is_singular() && pings_open()) { ?>
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <?php }

    wp_head(); ?>

    <?php
    // Funktion zur Konvertierung eines Hex-Farbcode in HSL
    function hex2hsl($hex)
    {
        // Lese RGB-Werte aus dem Hex-Farbcode
        list($r, $g, $b) = sscanf($hex, "#%02x%02x%02x");

        // Konvertiere RGB in HSL
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

    // Hole die primäre Farbe aus dem Customizer
    $primary_color = get_theme_mod('primary_color', '#370d07');
    // Konvertiere die primäre Farbe in HSL
    list($primary_hue, $saturation, $lightness) = hex2hsl($primary_color);

    // Definiere die anderen Farben basierend auf der primären Farbe
    $primary_variant_darker = "hsl($primary_hue, " . (max(0, $saturation - 20)) . "%, " . (max(0, $lightness - 20)) . "%)";
    $primary_variant_brighter = "hsl($primary_hue, " . (min(100, $saturation + 20)) . "%, " . (min(100, $lightness + 20)) . "%)";
    $primary_variant_much_brighter = "hsl($primary_hue, " . (min(100, $saturation + 25)) . "%, " . (min(100, $lightness + 25)) . "%)";
    $hintergrund_inputfeld = "hsl($primary_hue, " . (min(100, $saturation + 45)) . "%, " . (min(100, $lightness + 45)) . "%)";
    $hintergrund_variant = "hsl($primary_hue, " . (min(100, $saturation + 45)) . "%, " . (min(100, $lightness + 45)) . "%)";
    $hintergrund_variant_darker = "hsl($primary_hue, " . (min(100, $saturation + 35)) . "%, " . (min(100, $lightness + 35)) . "%)";
    ?>

    <style>
        <?php // Variablen aus Settings
        $font_color_light_mode = get_theme_mod('font_color_light_mode');
        $header_font_color_light_mode = get_theme_mod('header_font_color_light_mode');
        $header_meu_font_color = get_theme_mod('header_menu_font_color');

        // Automatische Schriftfarbe für den Header, wenn keine eigene Farbe
        if (empty($header_font_color_light_mode)) {
            $header_font_color_light_mode = $font_color_light_mode;
        }

        // primary-variant-darker für Headermenü, wenn keine eigene Farbe
        if (empty($header_meu_font_color)) {
            $header_meu_font_color = "var(--primary-variant-darker)";
        }

        ?>:root {
            /* Colors */
            --primary-color: <?php echo $primary_color ?>;
            --primary-variant-darker: <?php echo $primary_variant_darker ?>;
            --primary-variant-brighter: <?php echo $primary_variant_brighter ?>;
            --primary-variant-much-brighter: <?php echo $primary_variant_much_brighter ?>;
            --body: <?php echo get_theme_mod('background_color_light_mode') ?>;
            --hintergrund: <?php echo get_theme_mod('element_background_color_light_mode') ?>;
            --schrift: <?php echo $font_color_light_mode ?>;

            --hintergrund-inputfeld: <?php echo $hintergrund_inputfeld ?>;
            --hintergrund-variant: <?php echo $hintergrund_variant ?>;
            --hintergrund-variant-darker: <?php echo $hintergrund_variant_darker ?>;

            /* Header Settings */
            --header-font-color: <?php echo $header_font_color_light_mode ?>;
            --title-size: <?php echo get_theme_mod('title_size_setting') . 'px;' ?>;
            --slogan-size: <?php echo get_theme_mod('slogan_size_setting') . 'px;' ?>;
            --header-menu-font-color: <?php echo $header_meu_font_color ?>;
            --header-menu-backgound-color: <?php echo get_theme_mod('header_menu_background_color') ?>;
            --header-text-background-color: <?php if (get_theme_mod('header_text_background')) echo '#00000057';
                                            else echo 'transparent' ?>;


            /* Font Settings */
            --line-height: <?php echo get_theme_mod('line_heigt') . 'px;' ?>;

            /* Feed Setting*/
            --feed_post_card_line_heigt: <?php echo get_theme_mod('feed_post_card_line_heigt') . 'px;' ?>;
            --feed_post_card_border_radius: <?php echo get_theme_mod('feed_post_card_border_radius') . 'px;' ?>;
            --feed_post_card_padding: <?php echo get_theme_mod('feed_post_card_padding') . 'em;' ?>;
            --feed_post_card_border_radius_image: <?php echo get_theme_mod('feed_post_card_border_radius_image') . 'px;' ?>;
            --feed_post_card_spacing: <?php echo get_theme_mod('feed_post_card_spacing') . 'em;' ?>;

            --header-gap: <?php echo get_theme_mod('header_gap') . 'em' ?>;
            --max_feed_width: <?php echo get_theme_mod('maximum_width_of_the_feed') . 'em' ?>;
        }



        <?php // Variablen aus Settings
        $font_color_dark_mode = get_theme_mod('font_color_dark_mode');
        $header_font_color_dark_mode = get_theme_mod('header_font_color_dark_mode');

        // Automatische Schriftfarbe für den Header, wenn keine eigene Farbe
        if (empty($header_font_color_dark_mode)) {
            $header_font_color_dark_mode = $font_color_dark_mode;
        }

        ?>.darkmode {
            --primary-variant-darker: <?php echo $primary_variant_much_brighter ?>;
            --primary-variant-much-brighter: <?php echo $primary_variant_darker ?>;
            --body: <?php echo get_theme_mod('background_color_dark_mode') ?>;
            --hintergrund: <?php echo get_theme_mod('element_background_color_dark_mode') ?>;
            --schrift: <?php echo $font_color_dark_mode ?>;
            --header-font-color: <?php echo $header_font_color_dark_mode ?>;
            --hintergrund-inputfeld: <?php echo $hintergrund_inputfeld ?>;
            --hintergrund-variant: <?php echo $hintergrund_variant ?>;
            --hintergrund-variant-darker: <?php echo $hintergrund_variant_darker ?>;
        }

        body {
            font-family: <?php echo get_theme_mod('body_font', '"Quicksand"') ?>;
        }

        <?php $backgroung_image = get_theme_mod('header_background_image');

        ?>.header::before {
            background-image: url('<?php echo esc_url($backgroung_image); ?>');
            filter: <?php echo 'saturate(' . get_theme_mod('header_background_saturation') . '%)' ?>;
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

    <?php
    $fixedHeader = get_theme_mod('fixed_header', false);


    ?>
    <header id="header" class="clearfix header <?php if ($fixedHeader) echo 'fixedHeader' ?>" role="banner">
        <div class="headerDiv">

            <!-- <div class="farbpalettenDiv">
                <ul>
                    <li title="primary-color"></li>
                    <li title="primary-variant-darker"></li>
                    <li title="primary-variant-brighter"></li>
                    <li title="primary-variant-much-brighter"></li>
                    <li title="hintergrund-variant"></li>
                    <li title="hintergrund-variant-darker"></li>
                </ul>
            </div> -->


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


            <!-- Togglebutton, Menü und Suche -->
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