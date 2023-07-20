<aside id="sidebar" class="shadow">
    <?php
    // Widget area
    if (is_active_sidebar('my-sidebar')) {
        dynamic_sidebar('my-sidebar');
    }
    ?>
</aside>