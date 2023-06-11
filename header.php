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
    <header id="header" class="clearfix" role="banner">

        <div class="headerDiv">
            <div class="titleDiv">
                <?php
                $site_icon_url = get_site_icon_url();
                if ($site_icon_url) {
                    echo '<img src="' . esc_url($site_icon_url) . '"/>';
                }
                ?>
                <a href="<?php echo esc_url(home_url('/')); ?>">
                    <h1 class="site-title"><?php bloginfo('title'); ?></h1>
                </a>
                <!-- <?php if (get_bloginfo('description') != '') { ?>
                    <span class="description">
                        <?php bloginfo('description'); ?>
                    </span>
                <?php } ?> -->
            </div>
            <?php get_search_form(array('button_text' => 's')); ?>
        </div>
    </header>