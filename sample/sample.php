<?php

require_once __DIR__ . '/../vendor/autoload.php';

use ImageKit\ImageKit;

if (php_sapi_name() !== 'cli') {
    exit;
}

$public_key = 'your_public_key';
$your_private_key = 'your_private_key';
$url_end_point = 'https://ik.imagekit.io/demo';

$sample_file_url = 'https://cdn.pixabay.com/photo/2020/02/04/22/29/owl-4819550_960_720.jpg';
$sample_file_path = '/sample_image.jpg';
$sample_file_image_kit_url = $url_end_point . '/default-image.jpg';

$imageKit = new ImageKit(
    $public_key,
    $your_private_key,
    $url_end_point
);

include_once('url_generation/index.php');
include_once('upload_api/index.php');
include_once('file_management/index.php');
include_once('metadata/index.php');
include_once('utility/index.php');

echo "\n";
