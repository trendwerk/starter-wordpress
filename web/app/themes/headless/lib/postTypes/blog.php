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
        'graphql_plural_name' => 'blogPosts',
        'graphql_single_name' => 'blogPost',
        'labels' => $labels,
        'menu_position' => 10,
        'rewrite' => ['slug' => $postType],
        'show_in_graphql' => true,
        'show_in_rest' => true,
        'show_ui' => true,
        'supports' => ['editor', 'title'],
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
                    'label' => 'Summary',
                    'placement' => 'left',
                    'type' => 'tab',
                ],
                [
                    'name' => 'summary_image',
                    'key' => 'field_summary_image',
                    'label' => 'Summary image',
                    'instructions' => 'Header image will be used if left blank.',
                    'min_width' => 600,
                    'min_height' => 400,
                    'type' => 'image',
                ],
                [
                    'name' => 'summary_title',
                    'key' => 'field_summary_title',
                    'label' => 'Summary title',
                    'instructions' => 'Title will be used if left blank.',
                    'type' => 'text',
                ],
                [
                    'name' => 'summary',
                    'key' => 'field_summary',
                    'label' => 'Summary',
                    'instructions' => 'Summary will be automatically generated based on content if left blank.',
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
