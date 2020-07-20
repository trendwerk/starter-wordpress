<?php
namespace Headless;

// Replace image URL's in API to static folder
add_action('init_graphql_request', function () {
    add_filter('wp_get_attachment_image_src', function ($image) {
        $image[0] = str_replace('app/uploads', 'static', $image[0]);

        return $image;
    });
});
