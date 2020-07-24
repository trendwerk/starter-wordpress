<?php
namespace Headless;

// Replace image URL's in API to static folder
add_action('init_graphql_request', function () {
    add_filter('wp_get_attachment_image_src', function ($image) {
        $image[0] = str_replace('app/uploads', 'static', $image[0]);

        return $image;
    });
});

// Add fields to all post types
add_action('graphql_register_types', function () {
    foreach (\WPGraphQL::get_allowed_post_types() as $postType) {
        $postTypeName = get_post_type_object($postType)->graphql_single_name;

        // Summary
        register_graphql_field($postTypeName, 'summary', [
            'type' => 'String',
            'resolve' => function ($post) {
                return get_the_excerpt(get_the_id($post));
            }
        ]);

        // Formatted date
        register_graphql_field($postTypeName, 'dateFormatted', [
            'type' => 'String',
            'resolve' => function ($post) {
                return get_the_date('', get_the_id($post));
            }
        ]);
    }
});
