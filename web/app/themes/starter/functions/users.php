<?php
namespace Starter;

add_action('admin-init', function () {
    // Modify editor capabilities
    $editor = get_role('editor');

    $editor->add_cap('add_users');
    $editor->add_cap('create_users');
    $editor->add_cap('delete_users');
    $editor->add_cap('edit_theme_options');
    $editor->add_cap('edit_users');
    $editor->add_cap('list_users');
    $editor->add_cap('promote_users');
    $editor->add_cap('remove_users');

    $editor->remove_cap('switch_themes');
});
