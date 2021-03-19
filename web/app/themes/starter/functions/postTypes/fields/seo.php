<?php
return [
    [
        'key' => 'field_tab_seo',
        'label' => __('SEO', 'starter'),
        'placement' => 'left',
        'type' => 'tab',
    ],
    [
        'name' => 'page_title',
        'key' => 'field_page_title',
        'label' => __('Page title', 'starter'),
        'instructions' => __('Will display as "{title} - {sitename}". Title will be used if left blank.', 'starter'),
        'maxlength' => 60,
        'type' => 'text',
    ],
    [
        'name' => 'meta_description',
        'key' => 'field_meta_description',
        'label' => __('Meta description', 'starter'),
        'instructions' => __('Page description in search engines and on social media.', 'starter'),
        'maxlength' => 160,
        'rows' => 4,
        'type' => 'textarea',
    ],
    [
        'name' => 'og_image',
        'key' => 'field_og_image',
        'label' => __('Open Graph image', 'starter'),
        'instructions' => __('Preview image on social media. Header image will be used if left blank.', 'starter'),
        'min_width' => 1200,
        'min_height' => 630,
        'type' => 'image',
    ],
];
