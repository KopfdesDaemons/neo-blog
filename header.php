<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <?php if (is_singular() && pings_open()) { ?>
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <?php }

    wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <header id="header" class="clearfix header" role="banner">
        <div class="headerDiv">
            <div class="titleDiv">
                <a href="<?php echo esc_url(home_url('/')); ?>">
                    <span class="site-title"><?php bloginfo('title'); ?></span>
                </a>
            </div>
            <?php
            $searchbar = get_theme_mod('searchbar', false);
            if ($searchbar) {
                echo '
        <div class="SearchColumn">
            <div class="searchDiv">
                ';
                get_search_form(array('button_text' => 's'));
                echo '
            </div>
        </div>
        ';
            }
            ?>
            <nav class="headerMenuColumn">
                <!-- <button><i class="fa-solid fa-bars"></i></button> -->
                <?php
                $header_menu = get_theme_mod('header_menu', false);
                if ($header_menu) wp_nav_menu(array('theme_location' => 'header-menu')); ?>
            </nav>
        </div>
    </header>