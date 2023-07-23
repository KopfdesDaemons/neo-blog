<footer id="footer">
    <nav>
        <?php
        // Das Footer-Menü anzeigen
        wp_nav_menu(array(
            'theme_location' => 'footer-menu', // Der Name des zuvor erstellten Menüs
            'container' => false, // Das Menü-Container-Element entfernen
            'menu_class' => 'footer-menu', // Eine CSS-Klasse für das Menü hinzufügen (optional)
        ));
        ?>
    </nav>
</footer>



<?php wp_footer(); ?>
</body>

</html>