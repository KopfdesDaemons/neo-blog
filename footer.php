<footer id="neo_blog_footer">
    <nav>
        <?php
        wp_nav_menu(array(
            'theme_location' => 'footer-menu',
            'container' => false,
            'menu_class' => 'footer-menu',
        ));
        ?>
    </nav>
    <div class="neo_blog_footer_info">
        <div>
            <a href="https://wordpress.org/themes/neo-blog/" target="_blank">Neo Blog WordPress Theme</a>
        </div>
    </div>
</footer>
<?php wp_footer(); ?>
</body>

</html>