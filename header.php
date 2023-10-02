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

    <?php require_once get_template_directory() . '/customizer-options/css-variables.php'; ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <?php $neo_blog_header_fixed = get_theme_mod('fixed_header', false); ?>
    <header class="neo_blog_header <?php if ($neo_blog_header_fixed) echo 'neo_blog_header_fixed' ?>" role="banner">
        <a href="#neo_blog_main_content" class="neo_blog_skip_link"><?php echo esc_html__('Skip to main content', 'neo-blog') ?></a>
        <div class="neo_blog_header_div">

            <!-- Title -->
            <?php
            $title = get_theme_mod('title', true);
            if ($title) {
                $title = get_bloginfo('title');
                echo '<div class="neo_blog_header_title_div"><a href="' . esc_url(home_url('/')) . '">
                    <span class="neo_blog_header_title_span">' . esc_html($title) . '</span>
                </a>
            </div>';
            }
            ?>

            <!-- Slogan -->
            <?php
            $tagline = get_theme_mod('tagline', true);
            if ($tagline) {
                $description = get_bloginfo('description');
                echo '<div class="neo_blog_header_slogan_div"><span>' . esc_html($description) . '</span></div>';
            }
            ?>

            <!-- Banner -->
            <?php
            $image_url = get_theme_mod('header_banner', '');
            if ($image_url) {
                echo '<img class="neo_blog_header_banner" src="' . esc_url($image_url) . '" alt="Header Banner">';
            }
            ?>

            <!-- Toggle button, Menu and Search -->
            <div class="neo_blog_header_toggle_row">
                <?php
                $home_page_link = get_theme_mod('home_page_link', true);
                if ($home_page_link) { ?>
                    <a href="/" class="neo_blog_header_home_link" title="<?php echo esc_attr('Home page', 'neo-blog') ?>">
                        <i class="fa-solid fa-house"></i>
                    </a>
                <?php } ?>

                <?php
                $header_menu_is_activ = get_theme_mod('header_menu', true);
                $header_menu_style_is_horizontal = get_theme_mod('header_menu_style', 'vertical') == 'horizontal';
                if ($header_menu_is_activ & !$header_menu_style_is_horizontal) { ?>
                    <button id="neo_blog_header_menu_button" onclick="neo_blog_toggle_menu()" aria-label="<?php echo esc_attr('open menu', 'neo-blog') ?>"><i class="fa-solid fa-bars"></i></button>
                <?php }
                $searchbar = get_theme_mod('searchbar', false);
                if ($searchbar) {
                    echo '<div class="neo_blog_header_search_row"><div class="neo_blog_header_search_div">';
                    get_search_form(array('button_text' => 's'));
                    echo '</div></div>';
                }
                ?>
            </div>

            <!-- Header menu and home link -->
            <div class="neo_blog_header_menu_row">
                <nav class="neo_blog_header_menu_nav">
                    <?php
                    $home_page_link = get_theme_mod('home_page_link', true);
                    if ($home_page_link) { ?>
                        <a href="/" class="neo_blog_header_home_link" title="<?php echo esc_attr('Home page', 'neo-blog') ?>" aria-label="<?php echo esc_attr('Home page', 'neo-blog') ?>">
                            <i class="fa-solid fa-house"></i>
                        </a>
                    <?php } ?>
                    <?php
                    if ($header_menu_is_activ & !$header_menu_style_is_horizontal) {
                        wp_nav_menu(array(
                            'theme_location' => 'header-menu',
                            'menu_class' => 'neo_blog_header_menu_vertical',
                            'container'      => false,
                            'walker' => new neo_blog_Menu_Walker(),
                        ));
                    }
                    if ($header_menu_is_activ & $header_menu_style_is_horizontal) {
                        wp_nav_menu(array(
                            'theme_location' => 'header-menu',
                            'menu_class' => 'neo_blog_header_menu_horizontal',
                            'container'      => false,
                            'walker' => new neo_blog_Menu_Walker(),
                        ));
                    }
                    ?>
                </nav>
            </div>
        </div>
    </header>
</body>

</html>