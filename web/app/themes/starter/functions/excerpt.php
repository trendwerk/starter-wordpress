<?php
namespace Starter;

// Modify excerpt length
add_filter('excerpt_length', function () {
    return 40;
});

// Modify excerpt more
add_filter('excerpt_more', function () {
    return '…';
});
