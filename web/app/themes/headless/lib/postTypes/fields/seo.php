<?php
return [
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
];
