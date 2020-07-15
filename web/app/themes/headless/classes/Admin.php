<?php
namespace Headless;

class Admin
{
    public static function init()
    {
        // Remove and move admin menu items
        add_action('admin_menu', function () {
            static::moveMenuItem('edit.php?post_type=page', 50);
            static::moveMenuItem('upload.php', 58);

            remove_menu_page('edit-comments.php');
            remove_menu_page('edit.php');
            remove_menu_page('tools.php');
            remove_submenu_page('index.php', 'update-core.php');

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

        // Remove dashboard widgets
        add_action('wp_dashboard_setup', function () {
            global $wp_meta_boxes;

            unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity']);
            unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
            unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
            unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
            unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_drafts']);
            unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
            unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
            unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
        });

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

            activate_plugin('advanced-custom-fields-pro/acf.php');
        });
    }

    public static function moveMenuItem($page, $newPosition)
    {
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
}
