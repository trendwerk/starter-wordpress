<?php
$dir = dirname(__DIR__, 2);

require $dir . '/vendor/autoload.php';

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$args = array_merge($_GET, ['fit' => 'crop']);

League\Glide\ServerFactory::create([
    'base_url' => 'static',
    'cache' => $dir . '/web/app/uploads/.cache',
    'source' => $dir . '/web/app/uploads',
])->outputImage($path, $args);
