<?php
namespace Headless;

// Disable custom colors and font sizes
add_action('after_setup_theme', function () {
    add_theme_support('disable-custom-colors');
    add_theme_support('disable-custom-font-sizes');
    add_theme_support('disable-custom-gradients');
    add_theme_support('editor-color-palette', []);
    add_theme_support('editor-font-sizes', []);
    add_theme_support('editor-gradient-presets', []);
    remove_theme_support('core-block-patterns');
});

// Hide all blocks except the following
add_filter('allowed_block_types', function () {
    return [
        'core/buttons',
        'core/embed',
        'core/heading',
        'core/html',
        'core/image',
        'core/list',
        'core/paragraph',
        'core/quote',
    ];
});

// Enqueue editor customisations file
add_action('enqueue_block_editor_assets', function () {
    wp_enqueue_script(
        'editor-modifications',
        get_stylesheet_directory_uri() . '/functions/editor.js',
        ['wp-blocks', 'wp-dom'],
        time(),
        true
    );
});