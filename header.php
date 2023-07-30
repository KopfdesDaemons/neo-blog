<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
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
        :root {
            --primary-color: <?php echo $primary_color;
                                ?>;
            --primary-variant-darker: <?php echo $primary_variant_darker;
                                        ?>;
            --primary-variant-brighter: <?php echo $primary_variant_brighter;
                                        ?>;
            --primary-variant-much-brighter: <?php echo $primary_variant_much_brighter;
                                                ?>;
            --body: rgb(240, 240, 240);
            --hintergrund: rgb(255, 255, 255);
            --schrift: rgb(10, 10, 10);
            --hintergrund-inputfeld: <?php echo $hintergrund_inputfeld;
                                        ?>;
            --hintergrund-variant: <?php echo $hintergrund_variant;
                                    ?>;
            --hintergrund-variant-darker: <?php echo $hintergrund_variant_darker;
                                            ?>;
        }

        .darkmode {
            --primary-variant-darker: <?php echo $primary_variant_much_brighter;
                                        ?>;
            --primary-variant-much-brighter: <?php echo $primary_variant_darker;
                                                ?>;
            --body: rgb(15, 15, 15);
            --hintergrund: rgb(22, 24, 28);
            --schrift: rgb(200, 200, 200);
            --hintergrund-inputfeld: <?php echo $hintergrund_inputfeld;
                                        ?>;
            --hintergrund-variant: <?php echo $hintergrund_variant;
                                    ?>;
            --hintergrund-variant-darker: <?php echo $hintergrund_variant_darker;
                                            ?>;
        }

        body {
            font-family: <?php echo get_theme_mod('body_font', '"Quicksand"');
                            ?>;
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

            <div class="toggleDiv">
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