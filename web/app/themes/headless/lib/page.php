<?php
namespace Headless;

$postType = 'page';

// Register custom fields
add_action('acf/init', function () use ($postType) {
    acf_add_local_field_group([
        'key' => $postType,
        'title' => 'Page settings',
        'fields' => [
            [
                'key' => 'field_tab_seo',
                'label' => 'SEO',
                'placement' => 'left',
                'type' => 'tab',
            ],
            [
                'name' => 'seo_title',
                'key' => 'field_seo_title',
                'label' => 'Title',
                'instructions' => 'Will display as "{title} - {sitename}". Page title will be used if left blank.',
                'maxlength' => 60,
                'type' => 'text',
            ],
            [
                'name' => 'seo_description',
                'key' => 'field_seo_description',
                'label' => 'Meta description',
                'maxlength' => 160,
                'type' => 'textarea',
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
