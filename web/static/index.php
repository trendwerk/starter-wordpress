<?php
$dir = dirname(__DIR__, 2);

require $dir . '/vendor/autoload.php';

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

League\Glide\ServerFactory::create([
    'base_url' => 'static',
    'cache' => $dir . '/web/app/uploads/.cache',
    'defaults' => ['fit' => 'crop'],
    'max_image_size' => 3840 * 3840,
    'source' => $dir . '/web/app/uploads',
])->outputImage($path, $_GET);
