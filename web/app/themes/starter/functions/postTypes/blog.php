<?php
namespace Starter;

$postType = 'blog';

$labels = [
    'add_new' => __('New blog post', 'starter'),
    'name' => __('Blog', 'starter'),
    'singular_name' => __('Blog post', 'starter'),
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
        'supports' => ['title', 'editor', 'author'],
    ]);

    register_taxonomy('blog-category', $postType, [
        'hierarchical' => true,
        'show_in_graphql' => true,
        'graphql_single_name' => 'blogCategory',
        'graphql_plural_name' => 'blogCategories'
    ]);
    register_taxonomy('blog-tag', $postType, [
        'show_in_graphql' => true,
        'graphql_single_name' => 'blogTag',
        'graphql_plural_name' => 'blogTags'
    ]);
});

// Register custom fields
add_action('acf/init', function () use ($postType, $labels) {
    acf_add_local_field_group([
        'key' => $postType,
        'title' => $labels['singular_name']  . ' ' . __('settings', 'starter'),
        'fields' => array_merge(
            include 'fields/header.php',
            [
                [
                    'key' => 'field_tab_categories',
                    'label' => __('Categories', 'starter'),
                    'placement' => 'left',
                    'type' => 'tab',
                ],
                [
                    'name' => 'categories',
                    'key' => 'field_categories',
                    'label' => __('Categories', 'starter'),
                    'type' => 'taxonomy',
                    'taxonomy' => 'blog-category',
                    'field_type' => 'checkbox',
                    'load_terms' => true,
                    'save_terms' => true,
                ],
                [
                    'name' => 'tags',
                    'key' => 'field_tags',
                    'label' => __('Tags', 'starter'),
                    'type' => 'taxonomy',
                    'taxonomy' => 'blog-tag',
                    'field_type' => 'multi_select',
                    'load_terms' => true,
                    'save_terms' => true,
                ],
                [
                    'key' => 'field_tab_summary',
                    'label' => __('Summary', 'starter'),
                    'placement' => 'left',
                    'type' => 'tab',
                ],
                [
                    'name' => 'summary_image',
                    'key' => 'field_summary_image',
                    'label' => __('Summary image', 'starter'),
                    'instructions' => __('Header image will be used if left blank.', 'starter'),
                    'min_width' => 600,
                    'min_height' => 400,
                    'type' => 'image',
                ],
                [
                    'name' => 'summary_title',
                    'key' => 'field_summary_title',
                    'label' => __('Summary title', 'starter'),
                    'instructions' => __('Title will be used if left blank.', 'starter'),
                    'type' => 'text',
                ],
                [
                    'name' => 'summary',
                    'key' => 'field_summary',
                    'label' => __('Summary', 'starter'),
                    'instructions' => __('Summary will be automatically generated based on content if left blank.', 'starter'),
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

    // Archive settings
    acf_add_options_page([
        'menu_slug' => $postType . '-settings',
        'menu_title' => __('Archive settings', 'starter'),
        'page_title' => $labels['name'],
        'parent_slug' => 'edit.php?post_type=blog',
        'show_in_graphql' => true,
    ]);

    acf_add_local_field_group([
        'key' => $postType . '-settings',
        'title' => __('Archive settings', 'starter'),
        'fields' => array_merge(
            include 'fields/header.php',
            [
                [
                    'key' => 'field_tab_' . $postType . '_content',
                    'label' => __('Content', 'starter'),
                    'placement' => 'left',
                    'type' => 'tab',
                ],
                [
                    'name' => 'title',
                    'key' => 'field_' . $postType . '_title',
                    'label' => __('Title', 'starter'),
                    'type' => 'text',
                ],
                [
                    'name' => 'content',
                    'key' => 'field_' . $postType . '_content',
                    'label' => __('Intro text', 'starter'),
                    'type' => 'wysiwyg',
                    'media_upload' => false,
                    'tabs' => 'visual',
                ],
            ],
            include 'fields/seo.php',
        ),
        'location' => [[[
            'param' => 'options_page',
            'operator' => '==',
            'value' => $postType . '-settings',
        ]]],
        'graphql_field_name' => 'fields'
    ]);
});
