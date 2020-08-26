<?php
return [
    [
        'key' => 'field_tab_seo',
        'label' => __('SEO', 'headless'),
        'placement' => 'left',
        'type' => 'tab',
    ],
    [
        'name' => 'page_title',
        'key' => 'field_page_title',
        'label' => __('Page title', 'headless'),
        'instructions' => __('Will display as "{title} - {sitename}". Title will be used if left blank.', 'headless'),
        'maxlength' => 60,
        'type' => 'text',
    ],
    [
        'name' => 'meta_description',
        'key' => 'field_meta_description',
        'label' => __('Meta description', 'headless'),
        'instructions' => __('Page description in search engines and on social media.', 'headless'),
        'maxlength' => 160,
        'rows' => 4,
        'type' => 'textarea',
    ],
    [
        'name' => 'og_image',
        'key' => 'field_og_image',
        'label' => __('Open Graph image', 'headless'),
        'instructions' => __('Preview image on social media. Header image will be used if left blank.', 'headless'),
        'min_width' => 1200,
        'min_height' => 630,
        'type' => 'image',
    ],
];
