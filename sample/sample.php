<?php

echo __DIR__;

if (is_file(__DIR__ . '/../vendor/autoload.php') && is_readable(__DIR__ . '/../vendor/autoload.php')) {
    require_once __DIR__ . '/../vendor/autoload.php';
} else {
    // Fallback to legacy autoloader
    require_once __DIR__ . '/../autoload.php';
}

use ImageKit\ImageKit;

$public_key = "your_public_key";
$your_private_key = "your_private_key";
$url_end_point = "https://ik.imagekit.io/your_imagekit_id";


$sample_file_url = "https://cdn.pixabay.com/photo/2020/02/04/22/29/owl-4819550_960_720.jpg";
$sample_file_path = "/sample_image.jpg";
$sample_file_image_kit_url = $url_end_point . "/sample.jpg";

$imageKit = new ImageKit(
    $public_key,
    $your_private_key,
    $url_end_point
);

// 1 URL generation using image path and image hostname
echo "\n\n-------------------------------------------------------------------\n\n";

$imageURL = $imageKit->url(array(
    "path" => $sample_file_path,
    "transformation" => array(
        array(
            "height" => "300",
            "width" => "400",
        ),
    ),
));

echo ("Url : " . $imageURL);

// 2 Using full image URL
echo "\n\n-------------------------------------------------------------------\n\n";

$imageURL = $imageKit->url(array(
    "src" => $sample_file_image_kit_url,
    "transformation" => array(
        array(
            "height" => "300",
            "width" => "400",
        ),
    ),
    "transformationPosition" => "path",
    "queryParameters" => array(
        "random-param" => rand(10, 1000),

    ),
));

echo ("Url using full image url : " . $imageURL);

// 3 chained Transformations as a query parameter
echo "\n\n-------------------------------------------------------------------\n\n";

$imageURL = $imageKit->url(array(
    "path" => $sample_file_path,
    "transformation" => array(
        array(
            "height" => "300",
            "width" => "400",
        ),
        array(
            "rotation" => "90",
            "lossless" => false,
            "progressive" => true,
            "trim" => "5",
        )
    ),
    "transformationPostion" => "query",
));

echo ("chained transformation : " . $imageURL);

// 4. Sharpening and contrast transforms and a progressive JPG image
echo "\n\n-------------------------------------------------------------------\n\n";

$imageURL = $imageKit->url(array(
    "src" => $sample_file_image_kit_url,
    "queryParameters" => array(
        "v" => "1",
        "q" => "something",
    ),
    "transformation" => array(
        array(
            "format" => "jpg",
            "progressive" => true,
            "effectSharpen" => "-",
            "effectContrast" => "1",
        ),
    ),
));

echo ("Sharpening and contrast transforms : " . $imageURL);

// 5. Signed url
echo "\n\n-------------------------------------------------------------------\n\n";

$imageURL = $imageKit->url(array(
    "path" => $sample_file_path,
    "queryParameters" => array(
        "v" => "123",
    ),
    "transformation" => array(
        array(
            "height" => "300",
            "width" => "400",
        ),
    ),
    "signed" => true,
    "expireSeconds" => 300,
));

echo ("Signed url : " . $imageURL);

// 6. Upload Image - Base64
echo "\n\n-------------------------------------------------------------------\n\n";

$img = file_get_contents(__DIR__ . "/sample_image.jpg");

// Encode the image string data into base64
$encodedImageData = base64_encode($img);
$uploadFile = $imageKit->uploadFiles(array(
    "file" => $encodedImageData,
    "fileName" => "sample",
    "tags" => array("abd", "def"),
    "useUniqueFileName" => false,
    "customCoordinates" => implode(",", array("10", "10", "100", "100"))
));

$response = json_decode(json_encode($uploadFile), true);
echo ("Upload base64 encoded file : " . json_encode($uploadFile));

// 7. Upload Image - Binary
echo "\n\n-------------------------------------------------------------------\n\n";

$uploadFile = $imageKit->uploadFiles(array(
    "file" => fopen(__DIR__ . "/sample_image.jpg", "r"),
    "fileName" => "sample",
    "tags" => array("tag1", "tag2"),
    "useUniqueFileName" => true,
    "customCoordinates" => implode(",", array("10", "10", "100", "100"))
));

$response = json_decode(json_encode($uploadFile), true);
$binaryFileUploadID = $response["success"]["fileId"];
$binaryFileUploadURL = $response["success"]["url"];
echo ("Upload binary file : " . json_encode($uploadFile));

//  8. Upload Image  - URL
echo "\n\n-------------------------------------------------------------------\n\n";

$uploadFile = $imageKit->uploadFiles(array(
    "file" => $sample_file_url,
    "fileName" => "testing",
    "responseFields" => implode(",", array("isPrivateFile", "customCoordinates")),
    "isPrivateFile" => true,
));

$response = json_decode(json_encode($uploadFile), true);
$uploadedImageURL = $response["success"]["url"];
$fileId = $response["success"]["fileId"];
echo ("Upload with url : " . json_encode($uploadFile));

//  9. Upload Image  - with all parameters
echo "\n\n-------------------------------------------------------------------\n\n";

$uploadFile = $imageKit->uploadFiles(array(
    "file" => $sample_file_url,
    "fileName" => "testing",
    "useUniqueFileName" => true,
    "tags" => array("tag1", "tag2"),
    "folder" => "sample",
    "isPrivateFile" => false,
    "customCoordinates" => "10,15,100,100",
    "responseFields" => implode(",", array("isPrivateFile", "customCoordinates")),
));

echo ("Upload with url with all parameters: " . json_encode($uploadFile));

// 10. List Files
echo "\n\n-------------------------------------------------------------------\n\n";

$listFiles = $imageKit->listFiles(array(
    "skip" => 0,
    "limit" => 1,
));

echo ("List files : " . json_encode($listFiles));

// 11. Update details
echo "\n\n-------------------------------------------------------------------\n\n";

$updateFileDetails = $imageKit->updateFileDetails($fileId, array("tags" => ['image_tag'], "customCoordinates" => '100,100,100,100'));

echo ("Updated detail : " . json_encode($updateFileDetails));

// 12. get file details
echo "\n\n-------------------------------------------------------------------\n\n";

$getFileDetails = $imageKit->getFileDetails($fileId);

echo ("File details : " . json_encode($getFileDetails));

// 13. get file meta data
echo "\n\n-------------------------------------------------------------------\n\n";

$getFileDetails = $imageKit->getFileMetaData($fileId);

echo ("File metadata : " . json_encode($getFileDetails));

// 14. Delete file
echo "\n\n-------------------------------------------------------------------\n\n";

$deleteFile = $imageKit->deleteFile($fileId);


echo ("Delete file : " . json_encode($deleteFile));

// 15. Get file metadata from remote url
echo "\n\n-------------------------------------------------------------------\n\n";

$fileMetadataFromRemoteURL = $imageKit->getFileMetadataFromRemoteURL($binaryFileUploadURL);


echo ("Get file metadata from remote url : " . json_encode($fileMetadataFromRemoteURL));


// 16. Delete bulk files by Ids
echo "\n\n-------------------------------------------------------------------\n\n";
$bulkFileDelete = $imageKit->bulkFileDeleteByIds(array(
    "fileIds" => [$binaryFileUploadID]
));

echo ("Delete bulk files by ID : " . json_encode($bulkFileDelete));

// 17. Purge cache
echo "\n\n-------------------------------------------------------------------\n\n";
$purgeCache = $imageKit->purgeFileCacheApi($uploadedImageURL);
$response = json_decode(json_encode($purgeCache), true);
$requestId = $response["success"]["requestId"];
echo ("Purge cache : " . json_encode($purgeCache));

// 18. Purge cache status
echo "\n\n-------------------------------------------------------------------\n\n";

$purgeCacheStatus = $imageKit->purgeFileCacheApiStatus($requestId);

echo ("Purge cache status : " . json_encode($purgeCacheStatus));

// 19. Auth params
echo "\n\n-------------------------------------------------------------------\n\n";

$authenticationParameters = $imageKit->getAuthenticationParameters();

echo ("Auth params : " . json_encode($authenticationParameters));

// 20. Phash distance
echo "\n\n-------------------------------------------------------------------\n\n";

$distance = $imageKit->pHashDistance("f06830ca9f1e3e90", "f06830ca9f1e3e90");
echo ("Phash Distance : " . $distance);
echo ("\n");
