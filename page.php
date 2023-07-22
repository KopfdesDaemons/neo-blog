<?php
get_header();
?>
<main class="spacer">


    <?php
    while (have_posts()) {
        the_post(); // Ruft den nächsten Beitrag (in diesem Fall die Seite) ab und bereitet ihn vor
    ?>

    <!-- Hier beginnt das HTML-Markup für die Seite -->
    <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

        <!-- Hier kommt der Titel der Seite -->
        <h1><?php the_title(); ?></h1>

        <!-- Hier kommen die Inhalte der Seite -->
        <?php the_content(); ?>

    </div>
</main>
<?php
    }
    get_footer();