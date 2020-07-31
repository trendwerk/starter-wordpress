<?php
namespace Headless;

$postType = 'blog';

$labels = [
    'add_new' => __('New blog post', 'headless'),
    'name' => __('Blog', 'headless'),
    'singular_name' => __('Blog post', 'headless'),
];

// Register post type
add_action('init', function () use ($postType, $labels) {
    register_post_type($postType, [
        'graphql_plural_name' => 'posts',
        'graphql_single_name' => 'post',
        'has_archive' => true,
        'labels' => $labels,
        'menu_position' => 10,
        'public' => true,
        'rewrite' => ['slug' => $postType],
        'show_in_graphql' => true,
        'show_in_rest' => true,
        'supports' => ['title', 'editor'],
    ]);
});

// Register custom fields
add_action('acf/init', function () use ($postType, $labels) {
    acf_add_local_field_group([
        'key' => $postType,
        'title' => $labels['singular_name']  . ' settings',
        'fields' => array_merge(
            include 'fields/header.php',
            [
                [
                    'key' => 'field_tab_summary',
                    'label' => __('Summary', 'headless'),
                    'placement' => 'left',
                    'type' => 'tab',
                ],
                [
                    'name' => 'summary_image',
                    'key' => 'field_summary_image',
                    'label' => __('Summary image', 'headless'),
                    'instructions' => __('Header image will be used if left blank.', 'headless'),
                    'min_width' => 600,
                    'min_height' => 400,
                    'type' => 'image',
                ],
                [
                    'name' => 'summary_title',
                    'key' => 'field_summary_title',
                    'label' => __('Summary title', 'headless'),
                    'instructions' => __('Title will be used if left blank.', 'headless'),
                    'type' => 'text',
                ],
                [
                    'name' => 'summary',
                    'key' => 'field_summary',
                    'label' => __('Summary', 'headless'),
                    'instructions' => __('Summary will be automatically generated based on content if left blank.', 'headless'),
                    'type' => 'textarea',
                ],
            ],
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
