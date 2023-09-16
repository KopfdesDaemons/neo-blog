<?php
    // Widget area
    if (is_active_sidebar('my-sidebar')) {
        echo '<aside id="neo_sidebar">';
        dynamic_sidebar('my-sidebar');
        echo '</aside>';
    }
