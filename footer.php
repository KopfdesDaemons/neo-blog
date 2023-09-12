<footer id="neo_footer">
    <nav>
        <?php
        wp_nav_menu(array(
            'theme_location' => 'footer-menu',
            'container' => false,
            'menu_class' => 'footer-menu',
        ));
        ?>
    </nav>
</footer>
<?php wp_footer(); ?>
</body>

</html>