<?php
namespace Starter;

$name = 'general-content';
$title = __('General content', 'starter');

add_action('acf/init', function() use ($name, $title) {
    acf_add_options_page([
        'menu_slug' => $name,
        'menu_title' => $title,
        'page_title' => 'General',
        'position' => 59,
        'show_in_graphql' => true,
    ]);

    acf_add_local_field_group([
        'key' => $name,
        'title' => $title,
        'fields' => [
            [
                'key' => 'field_tab_contact',
                'label' => __('Contact details', 'starter'),
                'placement' => 'left',
                'type' => 'tab',
            ],
            [
                'name' => 'company_name',
                'key' => 'field_company_name',
                'label' => __('Company name', 'starter'),
                'type' => 'text',
            ],
            [
                'name' => 'address',
                'key' => 'field_address',
                'label' => __('Address', 'starter'),
                'type' => 'text',
            ],
            [
                'name' => 'zipcode',
                'key' => 'field_zipcode',
                'label' => __('Zipcode', 'starter'),
                'type' => 'text',
            ],
            [
                'name' => 'city',
                'key' => 'field_city',
                'label' => __('City', 'starter'),
                'type' => 'text',
            ],
            [
                'name' => 'email',
                'key' => 'field_email',
                'label' => __('Email adddress', 'starter'),
                'type' => 'text',
            ],
            [
                'name' => 'telephone',
                'key' => 'field_telephone',
                'label' => __('Telephone', 'starter'),
                'type' => 'text',
            ],

            [
                'key' => 'field_social_media',
                'label' => __('Social media', 'starter'),
                'placement' => 'left',
                'type' => 'tab',
            ],
            [
                'name' => 'facebook',
                'key' => 'field_facebook',
                'label' => __('Facebook profile', 'starter'),
                'type' => 'url',
            ],
            [
                'name' => 'instagram',
                'key' => 'field_instagram',
                'label' => __('Instagram profile', 'starter'),
                'type' => 'url',
            ],
            [
                'name' => 'linkedin',
                'key' => 'field_linkedin',
                'label' => __('LinkedIn profile', 'starter'),
                'type' => 'url',
            ],
            [
                'name' => 'pinterest',
                'key' => 'field_pinterest',
                'label' => __('Pinterest profile', 'starter'),
                'type' => 'url',
            ],
            [
                'name' => 'twitter',
                'key' => 'field_twitter',
                'label' => __('Twitter profile', 'starter'),
                'type' => 'url',
            ],
            [
                'name' => 'youtube',
                'key' => 'field_youtube',
                'label' => __('YouTube profile', 'starter'),
                'type' => 'url',
            ],
        ],
        'location' => [[[
            'param' => 'options_page',
            'operator' => '==',
            'value' => $name,
        ]]],
        'graphql_field_name' => 'fields'
    ]);
});
