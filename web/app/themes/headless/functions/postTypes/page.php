<?php
namespace Headless;

$postType = 'page';

$labels = [
    'name' => __('Pages', 'headless'),
    'singular_name' => __('Page', 'headless'),
];

// Remove comments and page attributes
add_action('init', function () use ($postType) {
    remove_post_type_support($postType, 'comments');
});

// Register custom fields
add_action('acf/init', function () use ($postType, $labels) {
    acf_add_local_field_group([
        'key' => $postType,
        'title' => $labels['singular_name']  . ' ' . __('settings', 'headless'),
        'fields' => array_merge(
            include 'fields/header.php',
            include 'fields/seo.php',
        ),
        'location' => [[[
            'param' => 'post_type',
            'operator' => '==',
            'value' => $postType,
        ]]],
        'graphql_field_name' => 'fields'
    ]);
});
