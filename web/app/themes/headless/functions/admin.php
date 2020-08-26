<?php
namespace Headless;

// Remove default post type 'post'
add_action('init', function () {
    register_post_type('post', []);
});

// Remove and move admin menu items
add_action('admin_menu', function () {
    moveMenuItem('edit.php?post_type=page', 5);
    moveMenuItem('themes.php', 62);
    moveMenuItem('upload.php', 61);
    remove_menu_page('edit-comments.php');
    remove_menu_page('edit.php?post_type=acf-field-group');
    remove_menu_page('index.php');
    remove_menu_page('tools.php');
    remove_submenu_page('options-general.php', 'options-discussion.php');
    remove_submenu_page('options-general.php', 'options-media.php');
    remove_submenu_page('options-general.php', 'options-privacy.php');
    remove_submenu_page('options-general.php', 'options-writing.php');
});

// Remove admin bar items
add_action('admin_bar_menu', function ($adminBar) {
    $adminBar->remove_menu('comments');
    $adminBar->remove_menu('new-media');
    $adminBar->remove_menu('new-user');
}, 100);

// Hide things in admin
add_action('admin_head', function () {
    ?>
    <style>
        #nav-menu-meta #add-category,
        #nav-menu-meta #add-post_tag,
        #wp-admin-bar-updates {
            display: none !important;
        }
    </style>
    <?php
});

// Remove update notice
add_action('admin_head', function () {
    remove_action('admin_notices', 'update_nag', 3);
});

// Remove unused medium_large image size
add_filter('intermediate_image_sizes', function($sizes) {
    return array_diff($sizes, ['medium_large']);
});

// Remove footer text
add_filter('admin_footer_text', '__return_false');

// Disallow comments and pingbacks
add_filter('comments_open', '__return_false');
add_filter('pings_open', '__return_false');

// Activate plugins after theme activation
add_action('after_switch_theme', function () {
    require_once ABSPATH . 'wp-admin/includes/plugin.php';

    activate_plugin('wp-graphql-acf/wp-graphql-acf.php');
    activate_plugin('wp-graphql/wp-graphql.php');
    activate_plugin('wp-graphiql/wp-graphiql.php');
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

// Disable deactivation of plugins
add_filter('plugin_action_links', function ($actions) {
    if (WP_ENV === 'development') {
        return $actions;
    }

    if (isset($actions['deactivate'])) {
        unset($actions['deactivate']);
    }

    return $actions;
});

add_filter('bulk_actions-plugins', function ($actions) {
    if (WP_ENV === 'development') {
        return $actions;
    }

    if (isset($actions['deactivate-selected'])) {
        unset($actions['deactivate-selected']);
    }

    return $actions;
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
