<?php
namespace Headless;

// Remove and move admin menu items
add_action('admin_menu', function () {
    moveMenuItem('edit.php?post_type=page', 5);
    moveMenuItem('themes.php', 62);
    moveMenuItem('upload.php', 61);

    remove_menu_page('edit-comments.php');
    remove_menu_page('edit.php?post_type=acf-field-group');
    remove_menu_page('edit.php');
    remove_menu_page('index.php');
    remove_menu_page('tools.php');
    remove_submenu_page('options-general.php', 'options-discussion.php');
    remove_submenu_page('options-general.php', 'options-media.php');
    remove_submenu_page('options-general.php', 'options-privacy.php');
    remove_submenu_page('options-general.php', 'options-writing.php');

    if (!current_user_can('administrator')) {
        remove_menu_page('plugins.php');
    }
});

// Remove admin bar items
add_action('admin_bar_menu', function ($adminBar) {
    $adminBar->remove_menu('new-post');
    $adminBar->remove_menu('comments');
    $adminBar->remove_menu('new-media');
    $adminBar->remove_menu('new-user');
}, 100);

// Remove update notice
add_action('admin_head', function () {
    ?>
    <style>
        #wp-admin-bar-updates {
            display: none !important;
        }
    </style>
    <?php
    remove_action('admin_notices', 'update_nag', 3);
});

// Remove footer text
add_filter('admin_footer_text', '__return_false');

// Disallow comments and pingbacks
add_filter('comments_open', '__return_false');
add_filter('pings_open', '__return_false');

// Activate plugins after theme activation
add_action('after_switch_theme', function () {
    require_once ABSPATH . 'wp-admin/includes/plugin.php';

    activate_plugin('wp-graphql/wp-graphql-acf.php');
    activate_plugin('wp-graphql/wp-graphql.php');
    activate_plugin('wp-graphql/wp-graphiql');
    activate_plugin('advanced-custom-fields-pro/acf.php');
    activate_plugin('limit-login-attempts/limit-login-attempts.php');
});

// Go to pages overview after logging in, instead of the dashboard
add_filter('login_redirect', function ($to, $_, $user) {
    if (is_wp_error($user)) {
        return $to;
    }

    if ($to === admin_url()) {
        return admin_url('edit.php?post_type=page');
    }

    return $to;
}, 10, 3);

add_action('admin_init', function () {
    if ($GLOBALS['pagenow'] === 'index.php') {
        wp_redirect('edit.php?post_type=page');
    }
});

function moveMenuItem($page, $newPosition) {
    global $menu;

    // Find current position
    foreach ($menu as $position => $item) {
        if (array_search($page, $item)) {
            $currentPosition = $position;
        }
    }

    $menu[$newPosition] = $menu[$currentPosition];
    unset($menu[$currentPosition]);
}
