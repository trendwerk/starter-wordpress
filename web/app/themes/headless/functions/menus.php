<?php
namespace Headless;

// Register menu's
add_action('init', function () {
    register_nav_menu('main', __('Main menu', 'headless'));
    register_nav_menu('footer1', __('Footer column 1', 'headless'));
    register_nav_menu('footer2', __('Footer column 2', 'headless'));
    register_nav_menu('footer3', __('Footer column 3', 'headless'));
    register_nav_menu('footer4', __('Footer column 4', 'headless'));
    register_nav_menu('footer', __('Footer menu', 'headless'));
});
