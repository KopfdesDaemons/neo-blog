<?php get_header(); ?>
<main role="main">
    <section class="spacer grid">
        <div class="content">
            <h1>
                <?php
                if (is_category()) {
                    single_cat_title(); // Anzeigen des Kategorienamens für Kategorie-Archive
                } elseif (is_tag()) {
                    single_tag_title(); // Anzeigen des Schlagwortnamens für Schlagwort-Archive
                } elseif (is_author()) {
                    the_post();
                    echo 'Beiträge von ' . get_the_author(); // Anzeigen des Autorennamens für Autoren-Archive
                    rewind_posts(); // Schleife zurücksetzen, um die restlichen Schleifenfunktionen zu verwenden
                } elseif (is_day()) {
                    echo 'Archiv für ' . get_the_date(); // Anzeigen des Datums für tägliche Archive
                } elseif (is_month()) {
                    echo 'Archiv für ' . get_the_date('F Y'); // Anzeigen des Monats und Jahres für monatliche Archive
                } elseif (is_year()) {
                    echo 'Archiv für ' . get_the_date('Y'); // Anzeigen des Jahres für jährliche Archive
                } else {
                    echo 'Archiv'; // Standardtext für andere Archive
                }
                ?>
            </h1>

            <?php
            if (have_posts()) {
                while (have_posts()) {
                    the_post();
                    // Hier kannst du den gewünschten Inhalt und das Layout für jeden Beitrag im Archiv definieren
                    // Du kannst WordPress-Template-Tags und Funktionen verwenden, um den Inhalt anzupassen
                    // Hier ist ein einfaches Beispiel, um den Titel und den Auszug anzuzeigen:
            ?>
            <article <?php post_class(); ?>>
                <h2><?php the_title(); ?></h2>
                <?php the_excerpt(); ?>
            </article>
            <?php
                }

                // Pagination, falls erforderlich
                the_posts_pagination();
            } else {
                // Wenn keine Beiträge gefunden werden
                echo 'Keine Beiträge gefunden.';
            }
            ?>
        </div>
        <?php get_sidebar(); ?>
    </section>
</main>
<?php get_footer(); ?>