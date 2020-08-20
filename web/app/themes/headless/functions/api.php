<?php
namespace Headless;

// Replace image URL's to return full size images in static folder
add_action('init_graphql_request', function () {
    add_filter('wp_get_attachment_url', function ($image) {
        return replaceImageUrls($image);
    });

    add_filter('the_content', function ($content) {
        return replaceImageUrls($content);
    });

    function replaceImageUrls($content) {
        $content = preg_replace('/(app\/uploads\/[^.]*)(-\d+[Xx]\d+)/', '$1', $content);
        $content = str_replace('app/uploads', 'static', $content);

        return $content;
    }
});

// Add fields to all post types
add_action('graphql_register_types', function () {
    foreach (\WPGraphQL::get_allowed_post_types() as $postType) {
        $postTypeName = get_post_type_object($postType)->graphql_single_name;

        // Summary
        register_graphql_field($postTypeName, 'summary', [
            'type' => 'String',
            'resolve' => function ($post) {
                return get_the_excerpt($post->ID);
            }
        ]);

        // Formatted date
        register_graphql_field($postTypeName, 'dateFormatted', [
            'type' => 'String',
            'resolve' => function ($post) {
                return get_the_date('', $post->ID);
            }
        ]);
        
        // Template type
        register_graphql_field($postTypeName, 'type', [
            'type' => 'String',
            'resolve' => function ($post) {
                foreach (['page_on_front', 'page_for_posts'] as $key) {
                    if (get_option($key) == $post->ID) {
                        return $key;
                    }
                }

                return get_page_template_slug($post->ID) ?: 'page';
            }
        ]);
    }
});
