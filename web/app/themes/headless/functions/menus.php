<?php
namespace Headless;

// Register menu's
add_action('init', function () {
    register_nav_menu('main', __('Main menu', 'headless'));
    register_nav_menu('footer', __('Footer menu', 'headless'));
});
