<?php
namespace Headless;

$postType = 'blog';

$labels = [
    'add_new' => __('New post', 'headless'),
    'name' => __('Blog', 'headless'),
    'singular_name' => __('Post', 'headless'),
];

// Register post type
add_action('init', function () use ($postType, $labels) {
    register_post_type($postType, [
        'has_archive' => true,
        'labels' => $labels,
        'menu_position' => 10,
        'public' => true,
        'rewrite' => ['slug' => $postType],
        'supports' => ['editor', 'title'],
        'show_in_rest' => true,
    ]);
});

// Register custom fields
add_action('acf/init', function () use ($postType, $labels) {
    acf_add_local_field_group([
        'key' => $postType,
        'title' => $labels['singular_name']  . ' settings',
        'fields' => [
            [
                'key' => 'field_tab_header',
                'label' => 'Header',
                'placement' => 'left',
                'type' => 'tab',
            ],
            [
                'name' => 'header_image',
                'key' => 'field_header_image',
                'label' => 'Header image',
                'min_width' => 1600,
                'min_height' => 800,
                'type' => 'image',
            ],
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
            [
                'key' => 'field_tab_seo',
                'label' => 'SEO',
                'placement' => 'left',
                'type' => 'tab',
            ],
            [
                'name' => 'title',
                'key' => 'field_title',
                'label' => 'Page title',
                'instructions' => 'Will display as "{title} - {sitename}". Title will be used if left blank.',
                'maxlength' => 60,
                'type' => 'text',
            ],
            [
                'name' => 'meta_description',
                'key' => 'field_meta_description',
                'label' => 'Meta description',
                'instructions' => 'Page description in search engines and on social media.',
                'maxlength' => 160,
                'type' => 'textarea',
            ],
            [
                'name' => 'og_image',
                'key' => 'field_og_image',
                'label' => 'Open Graph image',
                'instructions' => 'Preview image on social media. Header image will be used if left blank.',
                'min_width' => 1200,
                'min_height' => 630,
                'type' => 'image',
            ],
        ],
        'location' => [[[
            'param' => 'post_type',
            'operator' => '==',
            'value' => $postType,
        ]]],
        'graphql_field_name' => 'fields'
    ]);
});
