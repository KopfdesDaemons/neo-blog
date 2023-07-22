<?php


get_header(); // Lade die Header-Datei (header.php) des Themes.
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">

        <?php if (have_posts()) : ?>
        <header class="page-header">
            <h1 class="page-title">
                <?php
                    printf(
                        /* Übersetzung: %s wird durch den Suchbegriff ersetzt */
                        esc_html__('Suchergebnisse für: %s', 'dein-theme-textdomain'),
                        '<span>' . get_search_query() . '</span>'
                    );
                    ?>
            </h1>
        </header><!-- .page-header -->

        <?php
            while (have_posts()) :
                the_post();

                /*
                 * Inkludiere den Post-Teil des Inhalts-Template für das jeweilige Post-Format
                 * Wenn du den Beitrag mit einem Teaser oder einer Zusammenfassung anzeigen möchtest,
                 * dann benutze das Teaser-Template (content-search.php).
                 */
                get_template_part('template-parts/content', 'search');

            endwhile;

            // Navigation zu den vorherigen/nächsten Suchergebnissen
            the_posts_navigation();

        else :
            // Wenn keine Suchergebnisse gefunden wurden, zeige einen speziellen Inhalt dafür an.
            get_template_part('template-parts/content', 'none');

        endif;
        ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer(); // Lade die Footer-Datei (footer.php) des Themes.