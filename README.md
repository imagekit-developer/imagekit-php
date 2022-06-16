
# PHP SDK for ImageKit

[![Packagist](https://img.shields.io/packagist/v/imagekit/imagekit.svg)](https://packagist.org/packages/imagekit/imagekit)  [![Packagist](https://img.shields.io/packagist/dt/imagekit/imagekit.svg)](https://packagist.org/packages/imagekit/imagekit)  [![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT) [![codecov](https://codecov.io/gh/imagekit-developer/imagekit-php/branch/master/graph/badge.svg)](https://codecov.io/gh/imagekit-developer/imagekit-php) [![Twitter Follow](https://img.shields.io/twitter/follow/imagekitio?label=Follow&style=social)](https://twitter.com/ImagekitIo)
[![PHP Test CI](https://github.com/imagekit-developer/imagekit-php/actions/workflows/test.yml/badge.svg)](https://github.com/imagekit-developer/imagekit-php/actions/workflows/test.yml) [![PHP Coverage CI](https://github.com/imagekit-developer/imagekit-php/actions/workflows/coverage.yml/badge.svg)](https://github.com/imagekit-developer/imagekit-php/actions/workflows/coverage.yml) [![Wiki Documentation](https://img.shields.io/badge/wiki-documentation-forestgreen)](https://github.com/imagekit-developer/imagekit-php/wiki)

PHP SDK for [ImageKit](https://imagekit.io/) implements the new APIs and interface for different file operations.

ImageKit is a complete image optimization and transformation solution that comes with an [image CDN](https://imagekit.io/features/imagekit-infrastructure) and media storage. It can be integrated with your existing infrastructure - storage like AWS S3, web servers, your CDN, and custom domain names, allowing you to deliver optimized images in minutes with minimal code changes.


- [Key Features](#key-features)
- [Requirements](#requirements)
- [Version Support](#version-support)
- [Installation](#installation)
- [Usage](#usage)
- [Getting Started](#getting-started)
- [Quick Examples](#quick-examples)
    * [Create an ImageKit Instance](#create-an-imagekit-instance)
    * [URL Generation](#url-generation)
    * [File Upload](#file-upload)
- [Demo Application](#demo-application)
- [URL Generation](#url-generation-1)
- [Signed URL & Image Transformations](#applying-chained-transformations-common-image-manipulations-signed-url--conditional-transformation)
- [Server-side File Upload](#server-side-file-upload)
- [File Management](#file-management)
- [Custom Metadata Fields API](#custom-metadata-fields-api)
- [Utility Function](#utility-functions)
- [Opening Issues](#opening-issues)
- [Support](#support)
- [Resources](#resources)
- [Related Projects](#related-imagekit-projects)
- [License](#license)

## Key Features
- [URL Generation](#url-generation)
- [Transformations](#1-chained-transformations-as-a-query-parameter)
- [Secure URLS](#6-signed-url)
- [File Upload](#server-side-file-upload)
- [File Management](#file-management)

## Requirements
* PHP 5.6+
* [JSON PHP Extension](https://www.php.net/manual/en/book.json.php)
* [cURL PHP Extension](https://www.php.net/manual/en/book.curl.php)

## Version Support
| SDK Version | PHP 5.4 | PHP 5.5 | PHP 5.6 | PHP 7.x | PHP 8.x |
|-------------|---------|---------|---------|---------|---------|
| 3.x         | ❌     | ❌      | ✔️       | ✔️     |✔️      |
| 2.x         | ❌     | ❌      | ✔️       | ✔️     |✔️      |
| 1.x         | ❌     | ✔️      | ✔️       | ✔️     |✔️      |

## Installation

You can install the bindings via [Composer](http://getcomposer.org/). Run the following command:

```bash
composer require imagekit/imagekit
```
To use the bindings, use Composer's [autoload](https://getcomposer.org/doc/01-basic-usage.md#autoloading):
```php
require_once('vendor/autoload.php');
```

## Usage

You can use this PHP SDK for 3 different kinds of methods - URL generation, file upload, and file management. The usage of the SDK has been explained below.

* `URL Generation`
* `File Upload`
* `File Management`

## Getting Started
1. **Sign up for ImageKit** – Before you begin, you need to sign up for an [ImageKit account](https://imagekit.io/registration/)
1. Create your API Keys from [Developer Options](https://imagekit.io/dashboard/developer)
1. We will be using the newly created API Keys and URL-endpoint (from [Developer Options](https://imagekit.io/dashboard/developer)) to initialize the ImageKit instance.
1. **Minimum requirements** – To run the SDK, your system will need to meet the minimum requirements including having **PHP >= 5.6**. We highly recommend having it compiled with the cURL extension and cURL 7.16.2+ compiled with a TLS backend (e.g., NSS or OpenSSL).
1. **Install the SDK** – Using [Composer] is the recommended way to install the ImageKit SDK for PHP. The SDK is available via [Packagist](http://packagist.org/) under the [`imagekit/imagekit`](https://packagist.org/packages/imagekit/imagekit) package. If Composer is installed globally on your system, you can run the following in the base directory of your project to add the SDK as a dependency:
   ```
   composer require imagekit/imagekit
   ```
   Please see the [Installation](#installation) section for more detailed information about installing.
1. **Using the SDK** – The best way to become familiar with how to use the SDK is to follow the Examples provided in the [Official Documentaion](https://docs.imagekit.io/getting-started/quickstart-guides/php).

## Quick Examples
#### Create an ImageKit Instance
```php  
// Require the Composer autoloader.
require 'vendor/autoload.php';
use ImageKit\ImageKit;  
  
$imageKit = new ImageKit(
    "your_public_key",
    "your_private_key",
    "your_url_endpoint"
);
```

#### URL Generation
```php
// For URL Generation
$imageURL = $imageKit->url(
    [
        'path' => '/default-image.jpg',
    ]
);
echo $imageURL;
```

#### File Upload
```php
// For File Upload
$uploadFile = $imageKit->upload([
    'file' => 'file-url',
    'fileName' => 'new-file'
]);
```  

#### Response Structure
```json
{
    "error": {},
    "result": {},
    "responseMetadata": {
        "headers": {},
        "raw": {},
        "statusCode": {statusCode}
    }
}
```

## Demo application

* The official step by step PHP quick start guide - https://docs.imagekit.io/getting-started/quickstart-guides/php
* You can also run the demo application in the [sample](/sample) folder in this repository.

```sh  
cd sample
php sample.php
```  
  
## URL generation  
ImageKit provides inbuild media storage and integration with external origins. Refer to the [Documentation](https://docs.imagekit.io/integration/url-endpoints) to learn more about URL endpoints and external [Image Origins](https://docs.imagekit.io/integration/configure-origin) supported by ImageKit.  

### Using Image path and image hostname or endpoint 
  
This method allows you to create a URL using the image's path and the ImageKit URL endpoint (urlEndpoint) you want to use to access the image.   
  
#### Example
```php  
$imageURL = $imageKit->url(
    [
        'path' => '/default-image.jpg', 
        'transformation' => [
            [
                'height' => '300', 
                'width' => '400'
            ]
        ]
    ]
);
```  

#### Response

```  
https://ik.imagekit.io/your_imagekit_id/tr:h-300,w-400/default-image.jpg 
```  

### Using full image URL
This method allows you to add transformation parameters to an absolute ImageKit powered URL. This method should be used if you have the absolute URL stored in your database.

#### Example
```php  
$imageURL = $imageKit->url([
    'src' => 'https://ik.imagekit.io/your_imagekit_id/endpoint/default-image.jpg',
    'transformation' => [
        [
            'height' => '300',
            'width' => '400'
        ]
    ]
]);
```  

#### Response
```
https://ik.imagekit.io/your_imagekit_id/endpoint/tr:h-300,w-400/default-image.jpg  
```  

The `$imageKit->url()` method accepts the following parameters.

| Option                | Description                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              |  
| :-------------------- | :--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |  
| urlEndpoint           | Optional. The base URL to be appended before the path of the image. If not specified, the URL Endpoint specified at the time of SDK initialization is used. For example, https://ik.imagekit.io/your_imagekit_id/endpoint/                                                                                                                                                                                                                                                                                                                                                               |  
| path                  | Conditional. This is the path at which the image exists. For example, `/path/to/image.jpg`. Either the `path` or `src` parameter needs to be specified for URL generation.                                                                                                                                                                                                                                                                                                                                                                                                                |  
| src                   | Conditional. This is the complete URL of an image already mapped to ImageKit. For example, `https://ik.imagekit.io/your_imagekit_id/endpoint/path/to/image.jpg`. Either the `path` or `src` parameter needs to be specified for URL generation.                                                                                                                                                                                                                                                                                                                                           |  
| transformation        | Optional. An array of objects specifying the transformation to be applied in the URL. The transformation name and the value should be specified as a key-value pair in the object. Different steps of a [chained transformation](https://docs.imagekit.io/features/image-transformations/chained-transformations) can be specified as different objects of the array. The complete [List of supported transformations](#list-of-supported-transformations) in the SDK and some examples of using them are given later. If you use a transformation name that is not specified in the SDK, it gets applied as it is in the URL. |  
| transformationPosition | Optional. The default value is `path` that places the transformation string as a path parameter in the URL. It can also be specified as `query`, which adds the transformation string as the query parameter `tr` in the URL. If you use the `src` parameter to create the URL, the transformation string is always added as a query parameter.                                                                                                                                                                                                                                                 |  
| queryParameters       | Optional. These are the other query parameters that you want to add to the final URL. These can be any query parameters and are not necessarily related to ImageKit. Especially useful if you want to add some versioning parameters to your URLs.                                                                                                                                                                                                                                                                                                                                           |  
| signed                | Optional. Boolean. The default value is `false`. If set to `true`, the SDK generates a signed image URL adding the image signature to the image URL.                                                                                                                                                                                                                                                                                                              |  
| expireSeconds         | Optional. Integer. It is used along with the `signed` parameter. It specifies the time in seconds from now when the signed URL will expire. If specified, the URL contains the expiry timestamp in the URL, and the image signature is modified accordingly.                                                                                                                                                

### Applying Chained Transformations, Common Image Manipulations, Signed URL & Conditional Transformation

This section covers the basics:

* [Chained Transformations as a query parameter](#1-chained-transformations-as-a-query-parameter)
* [Image Enhancement & Color Manipulation](#2-image-enhancement-and-color-manipulation)
* [Resizing images](#3-resizing-images)
* [Quality manipulation](#4-quality-manipulation)
* [Adding overlays to images](#5-adding-overlays-to-images)
* [Signed URL](#6-signed-url)
* [Conditional Transformation](6#conditional-transformation)

The PHP SDK gives a name to each transformation parameter e.g. `height` for `h` and `width` for `w` parameter. It makes your code more readable.  See the [Full list of supported transformations](#list-of-supported-transformations).

👉 If the property does not match any of the available options, it is added as it is.\ e.g
```php
[
    'effectGray' => 'e-grayscale'
]
// and
[
    'e-grayscale' => ''
]
// works the same
```
👉 Note that you can also use `h` and `w` parameter instead of `height` and `width`. 

For more examples check the [Demo Application](#demo-application).

### 1. Chained Transformations as a query parameter

#### Example
```php  
$imageURL = $imageKit->url([
    'path' => '/default-image.jpg',
    'urlEndpoint' => 'https://ik.imagekit.io/your_imagekit_id/endpoint/', 
    'transformation' => [
        [
            'height' => '300',
            'width' => '400'
        ],
        [
            'rotation' => 90
        ],
    ], 
    'transformationPosition' => 'query'
]);
```  
#### Response
```  
https://ik.imagekit.io/your_imagekit_id/endpoint/default-image.jpg?tr=h-300,w-400:rt-90
```  

### 2. Image enhancement and color manipulation

Some transformations like [Contrast stretch](https://docs.imagekit.io/features/image-transformations/image-enhancement-and-color-manipulation#contrast-stretch-e-contrast) , [Sharpen](https://docs.imagekit.io/features/image-transformations/image-enhancement-and-color-manipulation#sharpen-e-sharpen) and [Unsharp mask](https://docs.imagekit.io/features/image-transformations/image-enhancement-and-color-manipulation#unsharp-mask-e-usm) can be added to the URL with or without any other value. To use such transforms without specifying a value, specify the value as "-" in the transformation object. Otherwise, specify the value that you want to be added to this transformation.

#### Example
```php  
$imageURL = $imageKit->url([
    'src' => 'https://ik.imagekit.io/your_imagekit_id/endpoint/default-image.jpg', 
    'transformation' => 
    [
        [
            'format' => 'jpg', 
            'progressive' => true,
            'effectSharpen' => '-', 
            'effectContrast' => '1'
        ]
    ]
]);
```  
#### Response
```  
https://ik.imagekit.io/your_imagekit_id/endpoint/tr:f-jpg,pr-true,e-sharpen,e-contrast-1/default-image.jpg 
```  

### 3. Resizing images
Let's resize the image to `width` 400 and `height` 300.
Check detailed instructions on [Resize, Crop and Other Common Transformations](https://docs.imagekit.io/features/image-transformations/resize-crop-and-other-transformations)

#### Example
```php
$imageURL = $imageKit->url(array(
    'path' => '/default-image.jpg',
    'transformation' => [
        [
            'height' => '300',
            'width' => '400',
        ]
    ]
));
```
#### Response
```
https://ik.imagekit.io/your_imagekit_id/tr:w-400,h-300/default-image.jpg
```

### 4. Quality manipulation
You can use the [Quality Parameter](https://docs.imagekit.io/features/image-transformations/resize-crop-and-other-transformations#quality-q) to change quality like this.

#### Example
```php
$imageURL = $imageKit->url(array(
    'path' => '/default-image.jpg',
    'transformation' => [
        [
            'quality' => '40',
        ]
    ]
));
```

#### Response
```
https://ik.imagekit.io/your_imagekit_id/tr:q-40/default-image.jpg
```

### 5. Adding overlays to images
ImageKit.io  allows to overlay [images](https://docs.imagekit.io/features/image-transformations/overlay#image-overlay) or [text](https://docs.imagekit.io/features/image-transformations/overlay#text-overlay) over other images for watermarking or creating a dynamic banner using custom text.

#### Example
```php
$imageURL = $imageKit->url(array(
    'path' => '/default-image.jpg',
    'urlEndpoint' => 'https://ik.imagekit.io/your_imagekit_id'
    
    // It means first resize the image to 400x300 and then rotate 90 degree
    'transformation' => [
        [
            'height' => '300',
            'width' => '300',
            'overlayImage' => 'default-image.jpg',
            'overlaywidth' => '100',
            'overlayX' => '0',
            'overlayImageBorder' => '10_CDDC39' // 10px border of color CDDC39
        ]
    ]
));
```
#### Response
```
https://ik.imagekit.io/your_imagekit_id/endpoint/tr:w-300,h-300,oi-default-image.jpg,ow-100,ox-0,oib-10_CDDC39/default-image.jpg
```

### 6. Signed URL

Signed URL that expires in 300 seconds with the default URL endpoint and other query parameters.
For detailed explanation on Signed URL refer to this [Official Doc](https://docs.imagekit.io/features/security/signed-urls).

#### Example
```php  
$imageURL = $imageKit->url([
    "path" => "/default-image.jpg",
    "queryParameters" => 
    [
        "v" => "123"
    ],
    "transformation" => [
        [
            "height" => "300",
            "width" => "400"
        ]
    ],
    "signed" => true,
    "expireSeconds" => 300,
]);
```  
#### Response
```  
https://ik.imagekit.io/your_imagekit_id/tr:h-300,w-400/default-image.jpg?v=123&ik-t=1654183277&ik-s=f98618f264a9ccb3c017e7b7441e86d1bc9a7ebb
```  

You can manage [Security Settings](https://docs.imagekit.io/features/security#restricting-unsigned-urls) from the dashboard to prevent unsigned URLs usage. In that case, if the URL doesn't have signature `ik-s` parameter or the signature is invalid, ImageKit will return a forbidden error instead of an actual image.


### 7. Conditional Transformation

Transformations can be applied conditionally i.e. only if certain properties of the input asset satisfy a given condition.
- Please find the allowed [**Conditional Properties list**](#list-of-supported-properties-for-condition-transformation).
- Please find the allowed [**Conditional Operators list**](#list-of-supported-operators-for-condition-transformation).

```php
$imageURL = $imageKit->url([
    'src' => 'https://ik.imagekit.io/your_imagekit_id/endpoint/default-image.jpg',
    'transformation' => [
        [
            'if' => [
                'condition' => [        // required
                    'originalHeight' => '100',
                    'operator' => '<'   // required
                ],
                'true' => [             // required
                    'width' =>  '200',
                ],
                'false' => [
                    'width' =>  '300',
                ],
            ],
        ]
    ],
]);
```
#### Response
```
https://ik.imagekit.io/your_imagekit_id/endpoint/tr:if-ih_lt_100,w-200,if-else,w-300,if-end/default-image.jpg
```

### List of supported transformations

The complete list of transformations supported and their usage in ImageKit can be found [here](https://docs.imagekit.io/features/image-transformations). The SDK gives a name to each transformation parameter, making the code simpler and readable. If a transformation is supported in ImageKit, but a name for it cannot be found in the table below, use the transformation code from ImageKit docs as the name when using it in the `url` function.

| Supported Transformation Name | Translates to parameter |  
| ----------------------------- | ----------------------- |  
| height                        | h                       |  
| width                         | w                       |  
| aspectRatio                   | ar                      |  
| quality                       | q                       |  
| crop                          | c                       |  
| cropMode                      | cm                      |  
| x                             | x                       |  
| y                             | y                       |  
| focus                         | fo                      |  
| format                        | f                       |  
| radius                        | r                       |  
| background                    | bg                      |  
| border                        | bo                      |  
| rotation                      | rt                      |  
| blur                          | bl                      |  
| named                         | n                       |  
| overlayImage                  | oi                      |  
| overlayX                      | ox                      |  
| overlayY                      | oy                      |  
| overlayFocus                  | ofo                     |  
| overlayHeight                 | oh                      |  
| overlayWidth                  | ow                      |  
| overlayText                   | ot                      |  
| overlayTextFontSize           | ots                     |  
| overlayTextFontFamily         | otf                     |  
| overlayTextColor              | otc                     |  
| overlayAlpha                  | oa                      |  
| overlayTextTypography         | ott                     |  
| overlayBackground             | obg                     |  
| overlayImageTrim              | oit                     |  
| progressive                   | pr                      |  
| lossless                      | lo                      |  
| trim                          | t                       |  
| metadata                      | md                      |  
| colorProfile                  | cp                      |  
| defaultImage                  | di                      |  
| dpr                           | dpr                     |  
| effectSharpen                 | e-sharpen               |  
| effectUSM                     | e-usm                   |  
| effectContrast                | e-contrast              |  
| effectGray                    | e-grayscale             |  
| original                      | orig                    |  
| rotate                        | rt                      |  
| overlayImageAspectRatio       | oiar                    |  
| overlayImageBackground        | oibg                    |  
| overlayImageBorder            | oib                     |  
| overlayImageDPR               | oidpr                   |  
| overlayImageQuality           | oiq                     |  
| overlayImageCropping          | oic                     |  
| overlayTextTransparency       | oa                      |  
| overlayTextEncoded            | ote                     |  
| overlayTextWidth              | otw                     |  
| overlayTextBackground         | otbg                    |  
| overlayTextPadding            | otp                     |  
| overlayTextInnerAlignment     | otia                    |  
| overlayRadius                 | or                      |  
| overlayImageFocus             | oifo                    |  


### List of Supported Properties For Condition Transformation

For detailed explanation refer to [Supported Properties](https://docs.imagekit.io/features/image-transformations/conditional-transformations#supported-properties).
|   Supported Property Name     | Translates to parameter |  
| ----------------------------- | ----------------------- |  
| height                        | h                       |  
| width                         | w                       |  
| aspectRatio                   | ar                      |  
| originalHeight                | ih                      |  
| originalWidth                 | iw                      |  
| originalAspectRatio           | iar                     |  


### List of Supported Operators For Condition Transformation

For detailed explanation refer to [Supported Operators](https://docs.imagekit.io/features/image-transformations/conditional-transformations#supported-operators).
|   Supported Property Name     | Translates to parameter |  
| ----------------------------- | ----------------------- |  
| ==                            | eq                      |  
| !=                            | w                       |  
| >                             | gt                      |  
| >=                            | gte                     |  
| <                             | lt                      |  
| <=                            | lte                     |  

## Server-side File Upload

The SDK provides a simple interface using the `$imageKit->upload()` method to upload files to the [ImageKit Media Library](https://imagekit.io/dashboard/media-library). 

- [See full documentation](https://cloudinary.com/documentation/php_image_and_video_upload).
- [Check all the supported file types and extensions](https://docs.imagekit.io/api-reference/upload-file-api#allowed-file-types-for-uploading).
- [Check all the supported parameters and details](https://docs.imagekit.io/api-reference/upload-file-api/server-side-file-upload).

#### Basic Usage
```php
$uploadFile = $imageKit->upload([
    'file' => 'your_file',              //  required, "binary","base64" or "file url"
    'fileName' => 'your_file_name.jpg', //  required
]);
```
#### Response
```json
{
    "error": null,
    "result": {
        "fileId": "6286329dfef1b033aee60211",
        "name": "your_file_name_S-PgGysnR.jpg",
        "size": 94466,
        "versionInfo": {
            "id": "6286329dfef1b033aee60211",
            "name": "Version 1"
        },
        "filePath": "/your_file_name_S-PgGysnR.jpg",
        "url": "https://ik.imagekit.io/demo/your_file_name_S-PgGysnR.jpg",
        "fileType": "image",
        "height": 640,
        "width": 960,
        "thumbnailUrl": "https://ik.imagekit.io/demo/tr:n-ik_ml_thumbnail/your_file_name_S-PgGysnR.jpg",
        "tags": [],
        "AITags": null,
        "customMetadata": { },
        "extensionStatus": {}
    },
    "responseMetadata":{
        "headers":{
            "access-control-allow-origin": "*",
            "x-ik-requestid": "e98f2464-2a86-4934-a5ab-9a226df012c9",
            "content-type": "application/json; charset=utf-8",
            "content-length": "434",
            "etag": "W/"1b2-reNzjRCFNt45rEyD7yFY/dk+Ghg"",
            "date": "Thu, 16 Jun 2022 14:22:01 GMT",
            "x-request-id": "e98f2464-2a86-4934-a5ab-9a226df012c9"
        },
        "raw":{
            "fileId": "6286329dfef1b033aee60211",
            "name": "your_file_name_S-PgGysnR.jpg",
            "size": 94466,
            "versionInfo": {
                "id": "6286329dfef1b033aee60211",
                "name": "Version 1"
            },
            "filePath": "/your_file_name_S-PgGysnR.jpg",
            "url": "https://ik.imagekit.io/demo/your_file_name_S-PgGysnR.jpg",
            "fileType": "image",
            "height": 640,
            "width": 960,
            "thumbnailUrl": "https://ik.imagekit.io/demo/tr:n-ik_ml_thumbnail/your_file_name_S-PgGysnR.jpg",
            "tags": [],
            "AITags": null,
            "customMetadata": { },
            "extensionStatus": {}
        },
        "statusCode":200
    }
}
```
#### Optional Parameters
```php
// Set of optional parameters
$uploadOptions = [
    "useUniqueFileName" => true,            // true|false
    "tags" => implode(",",["abd", "def"]),  // max: 500 chars
    "folder" => "/sample-folder",           
    "isPrivateFile" => false,               // true|false
    "customCoordinates" => implode(",", ["10", "10", "100", "100"]),    // max: 500 chars
    "responseFields" => implode(",", ["tags", "customMetadata"]),
    "extensions" => [       
        [
            "name" => "remove-bg",
            "options" => [  // refer https://docs.imagekit.io/extensions/overview
                "add_shadow" => true
            ]
        ]
    ],
    "webhookUrl" => "https://example.com/webhook",
    "overwriteFile" => true,        // in case of false useUniqueFileName should be true
    "overwriteAITags" => true,      // set to false in order to preserve overwriteAITags
    "overwriteTags" => true,
    "overwriteCustomMetadata" => true,
    // "customMetadata" => [
    //         "SKU" => "VS882HJ2JD",
    //         "price" => 599.99,
    // ]
];

// Attempt File Uplaod
$uploadFile = $imageKit->upload([
    'file' => 'your_file',                  //  required, "binary","base64" or "file url"
    'fileName' => 'your_file_name.jpg',     //  required
    'options' => $uploadOptions             // optional
]);
```  

## File Management

The SDK provides a simple interface for all the following [Media APIs](https://docs.imagekit.io/api-reference/media-api) to manage your files.

### 1. List & Search Files

This API can list all the uploaded files and folders in your [ImageKit.io](https://docs.imagekit.io/api-reference/media-api) media library.

#### Example
```php
$listFiles = $imageKit->listFiles();
```
#### Response
```json
[
    {
        "fileId": "598821f949c0a938d57563bd",
        "type": "file",
        "name": "file1.jpg",
        "filePath": "/images/products/file1.jpg",
        "tags": ["t-shirt", "round-neck", "sale2019"],
        "AITags": [
            {
                "name": "Shirt",
                "confidence": 90.12,
                "source": "google-auto-tagging"
            },
            /* ... more googleVision tags ... */
        ],
        "versionInfo": {
            "id": "598821f949c0a938d57563bd",
            "name": "Version 1"
        },
        "isPrivateFile": false,
        "customCoordinates": null,
        "url": "https://ik.imagekit.io/your_imagekit_id/images/products/file1.jpg",
        "thumbnail": "https://ik.imagekit.io/your_imagekit_id/tr:n-media_library_thumbnail/images/products/file1.jpg",
        "fileType": "image",
        "mime": "image/jpeg",
        "width": 100,
        "height": 100,
        "size": 100,
        "hasAlpha": false,
        "customMetadata": {
            "brand": "Nike",
            "color": "red"
        },
        "createdAt": "2019-08-24T06:14:41.313Z",
        "updatedAt": "2019-08-24T06:14:41.313Z"
    },
    ...more items
]
```
#### Applying Filters
Filter out the files with an object specifying the parameters. 
```php
$listFiles = $imageKit->listFiles([
    "type" => "file",           // file, file-version or folder
    "sort" => "ASC_CREATED",    
    "path" => "/",              // folder path
    "fileType" => "all",        // all, image, non-image
    "limit" => 10,              // min:1, max:1000
    "skip" => 0,                // min:0
    "searchQuery" => 'size < "20kb"',
]);
```

#### Advance Search
In addition, you can fine-tune your query by specifying various filters by generating a query string in a Lucene-like syntax and provide this generated string as the value of the `searchQuery`.
```php
$listFiles = $imageKit->listFiles([
    "searchQuery" => '(size < "1mb" AND width > 500) OR (tags IN ["summer-sale","banner"])',
]);
```
Detailed documentaion can be found here for [Advance Search Queries](https://docs.imagekit.io/api-reference/media-api/list-and-search-files#advanced-search-queries).

### 2. Get File Details

This API can get you all the details and attributes of the current version of the file.

#### Example
```php
$getFileDetails = $imageKit->getFileDetails('file_id');
```
#### Response
```json
{
    "fileId": "598821f949c0a938d57563bd",
    "type": "file",
    "name": "file1.jpg",
    "filePath": "/images/products/file1.jpg",
    "tags": ["t-shirt", "round-neck", "sale2019"],
    "AITags": [
        {
            "name": "Shirt",
            "confidence": 90.12,
            "source": "google-auto-tagging"
        },
        /* ... more googleVision tags ... */
    ],
    "versionInfo": {
            "id": "598821f949c0a938d57563bd",
            "name": "Version 1"
    },
    "isPrivateFile": false,
    "customCoordinates": null,
    "url": "https://ik.imagekit.io/your_imagekit_id/images/products/file1.jpg",
    "thumbnail": "https://ik.imagekit.io/your_imagekit_id/tr:n-media_library_thumbnail/images/products/file1.jpg",
    "fileType": "image",
    "mime": "image/jpeg",
    "width": 100,
    "height": 100,
    "size": 100,
    "hasAlpha": false,
    "customMetadata": {
        "brand": "Nike",
        "color": "red"
    },
    "createdAt": "2019-08-24T06:14:41.313Z",
    "updatedAt": "2019-08-24T06:14:41.313Z"
}
```

### 3. Get File Version Details

This API can get you all the details and attributes for the provided version of the file.`versionID` can be found in the following APIs as `id` within the `versionInfo` parameter:
- [Server-side File Upload API](#server-side-file-upload).
- [List & Search File API](#1-list--search-files)
- [Get File Details API](#2-get-file-details)

#### Example
```php
$getFileVersionDetails = $imageKit->getFileVersionDetails('file_id','version_id');
```
#### Response
```json
{
    "fileId": "598821f949c0a938d57563bd",
    "type": "file",
    "name": "file1.jpg",
    "filePath": "/images/products/file1.jpg",
    "tags": ["t-shirt", "round-neck", "sale2019"],
    "AITags": [
        {
            "name": "Shirt",
            "confidence": 90.12,
            "source": "google-auto-tagging"
        },
        /* ... more googleVision tags ... */
    ],
    "versionInfo": {
            "id": "598821f949c0a938d57563bd",
            "name": "Version 1"
    },
    "isPrivateFile": false,
    "customCoordinates": null,
    "url": "https://ik.imagekit.io/your_imagekit_id/images/products/file1.jpg",
    "thumbnail": "https://ik.imagekit.io/your_imagekit_id/tr:n-media_library_thumbnail/images/products/file1.jpg",
    "fileType": "image",
    "mime": "image/jpeg",
    "width": 100,
    "height": 100,
    "size": 100,
    "hasAlpha": false,
    "customMetadata": {
        "brand": "Nike",
        "color": "red"
    },
    "createdAt": "2019-08-24T06:14:41.313Z",
    "updatedAt": "2019-08-24T06:14:41.313Z"
}
```

### 4. Get File Versions

This API can get you all the versions of the file.

#### Example
```php
$getFileVersions = $imageKit->getFileVersions('file_id');
```
#### Response
```json
[
    {
        "fileId": "598821f949c0a938d57563bd",
        "type": "file-version",
        "name": "file1.jpg",
        "filePath": "/images/products/file1.jpg",
        "tags": ["t-shirt", "round-neck", "sale2019"],
        "AITags": [
            {
                "name": "Shirt",
                "confidence": 90.12,
                "source": "google-auto-tagging"
            },
            /* ... more googleVision tags ... */
        ],
        "versionInfo": {
                "id": "697821f849c0a938d57563ce",
                "name": "Version 2"
        },
        "isPrivateFile": false,
        "customCoordinates": null,
        "url": "https://ik.imagekit.io/your_imagekit_id/images/products/file1.jpg?ik-obj-version=bREnN9Z5VQQ5OOZCSvaXcO9SW.su4QLu",
        "thumbnail": "https://ik.imagekit.io/your_imagekit_id/tr:n-media_library_thumbnail/images/products/file1.jpg?ik-obj-version=bREnN9Z5VQQ5OOZCSvaXcO9SW.su4QLu",
        "fileType": "image",
        "mime": "image/jpeg",
        "width": 100,
        "height": 100,
        "size": 100,
        "hasAlpha": false,
        "customMetadata": {
            "brand": "Nike",
            "color": "red"
        },
        "createdAt": "2019-08-24T06:14:41.313Z",
        "updatedAt": "2019-09-24T06:14:41.313Z"
    },
    ...more items
]
```

### 5. Update File Details

Update file details such as tags, customCoordinates attributes, remove existing AITags and apply [extensions](https://docs.imagekit.io/extensions/overview) using Update File Details API. This operation can only be performed on the current version of the file.

#### Example
```php
// Update parameters
$updateData = [
        "removeAITags" => "all",    // "all" or ["tag1","tag2"]
        "webhookUrl" => "https://example.com/webhook",
        "extensions" => [       
            [
                "name" => "remove-bg",
                "options" => [  // refer https://docs.imagekit.io/extensions/overview
                    "add_shadow" => true
                ]
            ],
            [
                "name" => "google-auto-tagging",
            ]
        ],
        "tags" => ["tag1", "tag2"],
        "customCoordinates" => "10,10,100,100",
        // "customMetadata" => [
        //     "SKU" => "VS882HJ2JD",
        //     "price" => 599.99,
        // ]
];

// Attempt Update
$updateFileDetails = $imageKit->updateFileDetails(
    'file_id',
    $updateData
);
```
#### Response
```json
// This example response is after extensions are applied in the update API.
{
    "fileId" : "598821f949c0a938d57563bd",
    "type": "file",
    "name": "file1.jpg",
    "filePath": "/images/products/file1.jpg",
    "tags": ["t-shirt","round-neck","sale2019"],
    "AITags": [],
    "versionInfo": {
            "id": "598821f949c0a938d57563bd",
            "name": "Version 1"
    },
    "isPrivateFile" : false,
    "customCoordinates" : null,
    "url": "https://ik.imagekit.io/your_imagekit_id/images/products/file1.jpg",
    "thumbnail": "https://ik.imagekit.io/your_imagekit_id/tr:n-media_library_thumbnail/images/products/file1.jpg",
    "fileType": "image",
    "mime": "image/jpeg",
    "width": 100,
    "height": 100,
    "size": 100,
    "hasAlpha": false,
    "customMetadata": {
        "brand": "Nike",
        "color": "red"
    },
    "extensionStatus": {
        "remove-bg": "pending",
        "google-auto-tagging": "success"
    },
    "createdAt": "2019-08-24T06:14:41.313Z",
    "updatedAt": "2019-08-24T06:14:41.313Z"
}
```

### 6. Add Tags (Bulk) API

Add tags to multiple files in a single request. The method accepts an array of `fileIds` of the files and an array of `tags` that have to be added to those files.

#### Example
```php
$fileIds = ['file_id1','file_id2'];
$tags = ['image_tag_1', 'image_tag_2'];

$bulkAddTags = $imageKit->bulkAddTags($fileIds, $tags);
```
#### Response
```json
{
    "successfullyUpdatedFileIds": [
        "5e21880d5efe355febd4bccd",
        "5e1c13c1c55ec3437c451403"
    ]
}
```

### 7. Remove Tags (Bulk) API

Remove tags from multiple files in a single request. The method accepts an array of `fileIds` of the files and an array of `tags` that have to be removed from those files.

#### Example
```php
$fileIds = ['file_id1','file_id2'];
$tags = ['image_tag_1', 'image_tag_2'];

$bulkRemoveTags = $imageKit->bulkRemoveTags($fileIds, $tags);
```
#### Response
```json
{
    "successfullyUpdatedFileIds": [
        "5e21880d5efe355febd4bccd",
        "5e1c13c1c55ec3437c451403"
    ]
}
```

### 8. Remove AI Tags (Bulk) API

Remove AI tags from multiple files in a single request. The method accepts an array of `fileIds` of the files and an array of `AITags` that have to be removed from those files.

#### Example
```php
$fileIds = ['file_id1','file_id2'];
$AITags = ['image_AITag_1', 'image_AITag_2'];

$bulkRemoveTags = $imageKit->bulkRemoveAITags($fileIds, $AITags);
```
#### Response
```json
{
    "successfullyUpdatedFileIds": [
        "5e21880d5efe355febd4bccd",
        "5e1c13c1c55ec3437c451403"
    ]
}
```

### 9. Delete File API

You can programmatically delete uploaded files in the media library using delete file API.

> If a file or specific transformation has been requested in the past, then the response is cached. Deleting a file does not purge the cache. You can purge the cache using [Purge Cache API](#21-purge-cache-api).

#### Example
```php
$fileId = 'file_id';
$deleteFile = $imageKit->deleteFile($fileId);
```

### 10. Delete File Version API

You can programmatically delete uploaded file version in the media library using delete file version API.

> You can delete only the non-current version of a file.

#### Example
```php
$fileId = 'file_id';
$versionId = 'version_id';
$deleteFile = $imageKit->deleteFileVersion($fileId, $versionId);
```

### 11. Delete Files (Bulk) API

Deletes multiple files and their versions from the media library.

#### Example
```php
$fileIds = ["5e1c13d0c55ec3437c451406", ...];
$deleteFiles = $imageKit->bulkDeleteFiles($fileIds);
```
#### Response
```json
{
    "successfullyDeletedFileIds": [
        "5e1c13d0c55ec3437c451406",
        ...
    ]
}
```

### 12. Copy File API

This will copy a file from one folder to another.

>  If any file at the destination has the same name as the source file, then the source file and its versions (if `includeVersions` is set to true) will be appended to the destination file version history.

#### Example
```php
$sourceFilePath = '/sample-folder1/sample-file.jpg';
$destinationPath = '/sample-folder2/';
$includeVersions = false;

$copyFile = $imageKit->copy([
    'sourceFilePath' => $sourceFilePath,
    'destinationPath' => $destinationPath,
    'includeVersions' => $includeVersions
]);
```

### 13. Move File API

This will move a file and all its versions from one folder to another.

>  If any file at the destination has the same name as the source file, then the source file and its versions will be appended to the destination file.

#### Example
```php
$sourceFilePath = '/sample-file.jpg';
$destinationPath = '/sample-folder/';

$moveFile = $imageKit->move([
    'sourceFilePath' => $sourceFilePath,
    'destinationPath' => $destinationPath
]);
```

### 14. Rename File API
You can programmatically rename an already existing file in the media library using Rename File API. This operation would rename all file versions of the file.

>  The old URLs will stop working. The file/file version URLs cached on CDN will continue to work unless a purge is requested.

#### Example
```php
// Purge Cache would default to false

$filePath = '/sample-folder/sample-file.jpg';
$newFileName = 'sample-file2.jpg';
$renameFile = $imageKit->rename([
    'filePath' => $filePath,
    'newFileName' => $newFileName,
]);
```
When `purgeCache` is set to `true`, response will return `purgeRequestId`. This `purgeRequestId` can be used to get the purge request status.
```php
$filePath = '/sample-folder/sample-file.jpg';
$newFileName = 'sample-file2.jpg';
$renameFile = $imageKit->renameFile([
    'filePath' => $filePath,
    'newFileName' => $newFileName,
],true);
```
#### Response
```json
{
    "purgeRequestId": "598821f949c0a938d57563bd"
}
```

### 15. Restore File Version API
This will restore the provided file version to a different version of the file. The new restored version of the file will be returned in response.

#### Example
```php
$fileId = 'fileId';
$versionId = 'versionId';
$restoreFileVersion = $imageKit->restoreFileVersion([
    'fileId' => $fileId,
    'versionId' => $versionId,
]);
```
#### Response
```json
{
    "fileId": "598821f949c0a938d57563bd",
    "type": "file",
    "name": "file1.jpg",
    "filePath": "/images/products/file1.jpg",
    "tags": ["t-shirt", "round-neck", "sale2019"],
    "AITags": [
        {
            "name": "Shirt",
            "confidence": 90.12,
            "source": "google-auto-tagging"
        },
        /* ... more googleVision tags ... */
    ],
    "versionInfo": {
            "id": "697821f849c0a938d57563ce",
            "name": "Version 2"
    },
    "isPrivateFile": false,
    "customCoordinates": null,
    "url": "https://ik.imagekit.io/your_imagekit_id/images/products/file1.jpg",
    "thumbnail": "https://ik.imagekit.io/your_imagekit_id/tr:n-media_library_thumbnail/images/products/file1.jpg",
    "fileType": "image",
    "mime": "image/jpeg",
    "width": 100,
    "height": 100,
    "size": 100,
    "hasAlpha": false,
    "customMetadata": {
        "brand": "Nike",
        "color": "red"
    },
    "createdAt": "2019-08-24T06:14:41.313Z",
    "updatedAt": "2019-09-24T06:14:41.313Z"
}
```

### 16. Create Folder API

This will create a new folder. You can specify the folder name and location of the parent folder where this new folder should be created.

#### Example
```php
$folderName = 'new-folder';
$parentFolderPath = '/';
$createFolder = $imageKit->createFolder([
    'folderName' => $folderName,
    'parentFolderPath' => $parentFolderPath,
]);
```

### 17. Delete Folder API

This will delete the specified folder and all nested files, their versions & folders. This action cannot be undone.

#### Example
```php
$folderPath = '/new-folder';
$deleteFolder = $imageKit->deleteFolder($folderPath);
```

### 18. Copy Folder API

This will copy one folder into another.

#### Example
```php
$sourceFolderPath = '/source-folder/';
$destinationPath = '/destination-folder/';
$includeVersions = false;
$copyFolder = $imageKit->copyFolder([
    'sourceFolderPath' => $sourceFolderPath,
    'destinationPath' => $destinationPath,
    'includeVersions' => $includeVersions
]);
```
#### Response
```json
{
    "jobId": "598821f949c0a938d57563bd"
}
```

### 19. Move Folder API

This will move one folder into another. The selected folder, its nested folders, files, and their versions are moved in this operation.

> If any file at the destination has the same name as the source file, then the source file and its versions will be appended to the destination file version history.

#### Example
```php
$sourceFolderPath = '/sample-folder/';
$destinationPath = '/destination-folder/';
$moveFolder = $imageKit->moveFolder([
    'sourceFolderPath' => $sourceFolderPath,
    'destinationPath' => $destinationPath
]);
```
#### Response
```json
{
    "jobId": "598821f949c0a938d57563bd"
}
```

### 20. Bulk Job Status API

This endpoint allows you to get the status of a bulk operation e.g. [Copy Folder API](#18-copy-folder-api) or [Move Folder API](#19-move-folder-api).

#### Example
```php
$jobId = 'jobId';
$bulkJobStatus = $imageKit->getBulkJobStatus($jobId);
```
#### Response
```json
{
    "jobId": "598821f949c0a938d57563bd",
    "type": "COPY_FOLDER",
    "status": "Completed" // or "Pending"
}
```

### 21. Purge Cache API

This will purge CDN and ImageKit.io's internal cache. In response `requestId` is returned which can be used to fetch the status of the submitted purge request with [Purge Cache Status API](#22-purge-cache-status-api).
#### Example
```php
$image_url = 'https://ik.imagekit.io/demo/sample-folder/sample-file.jpg';
$purgeCache = $imageKit->purgeCache($image_url);
```
#### Response
```json
{
    "requestId" : "598821f949c0a938d57563bd"
}
```
You can purge the cache for multiple files. Check [Purge Cache Multiple Files](https://docs.imagekit.io/api-reference/media-api/purge-cache#purge-cache-for-multiple-files).

### 22. Purge Cache Status API

Get the purge cache request status using the `requestId` returned when a purge cache request gets submitted with [Purge Cache API](#21-purge-cache-api)

#### Example
```php
$cacheRequestId = '598821f949c0a938d57563bd';
$getPurgeCacheStatus = $imageKit->getPurgeCacheStatus($cacheRequestId);
```
#### Response
```json
{
    "status" : "Pending" // or "Completed"
}
```

### 23. Get File Metadata API (From File ID)

Get the image EXIF, pHash, and other metadata for uploaded files in ImageKit.io media library using this API.

#### Example
```php
$fileId = '598821f949c0a938d57563bd';
$getFileMetadata = $imageKit->getFileMetaData($fileId);
```
#### Response
```json
{
    "height": 68,
    "width": 100,
    "size": 7749,
    "format": "jpg",
    "hasColorProfile": true,
    "quality": 0,
    "density": 72,
    "hasTransparency": false,
    "pHash": "f06830ca9f1e3e90",
    "exif": {
        "image": {
            "Make": "Canon",
            "Model": "Canon EOS 40D",
            "Orientation": 1,
            "XResolution": 72,
            "YResolution": 72,
            "ResolutionUnit": 2,
            "Software": "GIMP 2.4.5",
            "ModifyDate": "2008:07:31 10:38:11",
            "YCbCrPositioning": 2,
            "ExifOffset": 214,
            "GPSInfo": 978
        },
        "thumbnail": {
            "Compression": 6,
            "XResolution": 72,
            "YResolution": 72,
            "ResolutionUnit": 2,
            "ThumbnailOffset": 1090,
            "ThumbnailLength": 1378
        },
        "exif": {
            "ExposureTime": 0.00625,
            "FNumber": 7.1,
            "ExposureProgram": 1,
            "ISO": 100,
            "ExifVersion": "0221",
            "DateTimeOriginal": "2008:05:30 15:56:01",
            "CreateDate": "2008:05:30 15:56:01",
            "ShutterSpeedValue": 7.375,
            "ApertureValue": 5.625,
            "ExposureCompensation": 0,
            "MeteringMode": 5,
            "Flash": 9,
            "FocalLength": 135,
            "SubSecTime": "00",
            "SubSecTimeOriginal": "00",
            "SubSecTimeDigitized": "00",
            "FlashpixVersion": "0100",
            "ColorSpace": 1,
            "ExifImageWidth": 100,
            "ExifImageHeight": 68,
            "InteropOffset": 948,
            "FocalPlaneXResolution": 4438.356164383562,
            "FocalPlaneYResolution": 4445.969125214408,
            "FocalPlaneResolutionUnit": 2,
            "CustomRendered": 0,
            "ExposureMode": 1,
            "WhiteBalance": 0,
            "SceneCaptureType": 0
        },
        "gps": {
            "GPSVersionID": [
                2,
                2,
                0,
                0
            ]
        },
        "interoperability": {
            "InteropIndex": "R98",
            "InteropVersion": "0100"
        },
        "makernote": {}
    }
}
```


### 24. Get File Metadata API (From Remote URL)

Get image EXIF, pHash, and other metadata from ImageKit.io powered remote URL using this API.

#### Example
```php
$image_url = 'https://ik.imagekit.io/demo/sample-folder/sample-file.jpg';
$getFileMetadataFromRemoteURL = $imageKit->getFileMetadataFromRemoteURL($image_url);
```
#### Response
```json
{
    "height": 68,
    "width": 100,
    "size": 7749,
    "format": "jpg",
    "hasColorProfile": true,
    "quality": 0,
    "density": 72,
    "hasTransparency": false,
    "pHash": "f06830ca9f1e3e90",
    "exif": {
        "image": {
            "Make": "Canon",
            "Model": "Canon EOS 40D",
            "Orientation": 1,
            "XResolution": 72,
            "YResolution": 72,
            "ResolutionUnit": 2,
            "Software": "GIMP 2.4.5",
            "ModifyDate": "2008:07:31 10:38:11",
            "YCbCrPositioning": 2,
            "ExifOffset": 214,
            "GPSInfo": 978
        },
        "thumbnail": {
            "Compression": 6,
            "XResolution": 72,
            "YResolution": 72,
            "ResolutionUnit": 2,
            "ThumbnailOffset": 1090,
            "ThumbnailLength": 1378
        },
        "exif": {
            "ExposureTime": 0.00625,
            "FNumber": 7.1,
            "ExposureProgram": 1,
            "ISO": 100,
            "ExifVersion": "0221",
            "DateTimeOriginal": "2008:05:30 15:56:01",
            "CreateDate": "2008:05:30 15:56:01",
            "ShutterSpeedValue": 7.375,
            "ApertureValue": 5.625,
            "ExposureCompensation": 0,
            "MeteringMode": 5,
            "Flash": 9,
            "FocalLength": 135,
            "SubSecTime": "00",
            "SubSecTimeOriginal": "00",
            "SubSecTimeDigitized": "00",
            "FlashpixVersion": "0100",
            "ColorSpace": 1,
            "ExifImageWidth": 100,
            "ExifImageHeight": 68,
            "InteropOffset": 948,
            "FocalPlaneXResolution": 4438.356164383562,
            "FocalPlaneYResolution": 4445.969125214408,
            "FocalPlaneResolutionUnit": 2,
            "CustomRendered": 0,
            "ExposureMode": 1,
            "WhiteBalance": 0,
            "SceneCaptureType": 0
        },
        "gps": {
            "GPSVersionID": [
                2,
                2,
                0,
                0
            ]
        },
        "interoperability": {
            "InteropIndex": "R98",
            "InteropVersion": "0100"
        },
        "makernote": {}
    }
}
```


## Custom Metadata Fields API

Imagekit.io allows you to define a `schema` for your metadata keys and the value filled against that key will have to adhere to those rules. You can [Create](#1-create-fields), [Read](#2-get-fields) and [Update](#3-update-fields) custom metadata rules and update your file with custom metadata value in [File update API](#5-update-file-details) or [File Upload API](#server-side-file-upload).

For detailed explanation refer to the [Official Documentaion](https://docs.imagekit.io/api-reference/custom-metadata-fields-api).

### 1. Create Fields

Create a Custom Metadata Field with this API.

#### Example
```php
$body = [
    "name" => "price",              // required
    "label" => "Unit Price",        // required
    "schema" => [                   // required
        "type" => 'Number',         // required
        "minValue" => 1000,
        "maxValue" => 5000,
    ],
];

$createCustomMetadataField = $imageKit->createCustomMetadataField($body);
```

#### Response
```json
{
    "id": "598821f949c0a938d57563dd",
    "name": "price",
    "label": "price",
    "schema": {
        "type": "Number",
        "minValue": 1000,
        "maxValue": 3000
    }
}
```
Check for the [Allowed Values In The Schema](https://docs.imagekit.io/api-reference/custom-metadata-fields-api/create-custom-metadata-field#allowed-values-in-the-schema-object).

### 2. Get Fields

Get a list of all the custom metadata fields.

#### Example
```php
$includeDeleted = false;
$getCustomMetadataFields = $imageKit->getCustomMetadataFields($includeDeleted);
```
#### Response
```json
[
    {
        "id": "598821f949c0a938d57563dd",
        "name": "brand",
        "label": "brand",
        "schema": {
            "type": "Text",
            "defaultValue": "Nike"
        }
    },
    {
        "id": "865421f949c0a835d57563dd"
        "name": "price",
        "label": "price",
        "schema": {
            "type": "Number",
            "minValue": 1000,
            "maxValue": 3000
        }
    }
]
```


### 3. Update Fields

Update the `label` or `schema` of an existing custom metadata field.

#### Example
```php
$customMetadataFieldId = '598821f949c0a938d57563dd';
$body = [
    "label" => "Net Price",
    "schema" => [
        "type"=>'Number'
    ],
];

$updateCustomMetadataField = $imageKit->updateCustomMetadataField($customMetadataFieldId, $body);
```

#### Response
```json
{
    "id": "598821f949c0a938d57563dd",
    "name": "price",
    "label": "Net Price",
    "schema": {
        "type": "Number"
    }
}
```
Check for the [Allowed Values In The Schema](https://docs.imagekit.io/api-reference/custom-metadata-fields-api/create-custom-metadata-field#allowed-values-in-the-schema-object).

### 4. Delete Fields

Delete a custom metadata field.

#### Example
```php
$customMetadataFieldId = '598821f949c0a938d57563dd';

$deleteCustomMetadataField = $imageKit->deleteCustomMetadataField($customMetadataFieldId);
```

## Utility functions

We have included the following commonly used utility functions in this SDK.

### Authentication parameter generation

If you are looking to implement client-side file upload, you will need a `token`, `expiry` timestamp, and a valid `signature` for that upload. The SDK provides a simple method that you can use in your code to generate these authentication parameters for you.

_Note: The Private API Key should never be exposed in any client-side code. You must always generate these authentication parameters on the server-side_

```php  
$imageKit->getAuthenticationParameters($token = "", $expire = 0);  
```  

Returns

```json
{
    "token": "5d1c4a22-54f2-40bb-9e8c-99daaeeb7307",
    "expire": 1654207193,
    "signature": "a03a88b814570a3d92919c16a1b8bd4491f053c3"
}
```  

Both the `token` and `expire` parameters are optional. If not specified, the SDK generates a random token and also generates a valid expiry timestamp internally. The value of the `token` and `expire` used to create the signature is always returned in the response, whether they are provided in input or not.

### Distance calculation between two pHash values

Perceptual hashing allows you to construct a hash value that uniquely identifies an input image based on the contents of an image. [ImageKit.io metadata API](https://docs.imagekit.io/api-reference/metadata-api) returns the pHash value of an image in the response. You can use this value to find a duplicate (or similar) image by calculating the distance between the pHash value of the two images.

This SDK exposes `pHashDistance` function to calculate the distance between two pHash values. It accepts two pHash hexadecimal strings and returns a numeric value indicative of the level of difference between the two images.

```php  
 $imageKit->pHashDistance($firstHash ,$secondHash);  
```  

#### Distance calculation examples

```php  
$imageKit->pHashDistance('f06830ca9f1e3e90', 'f06830ca9f1e3e90');  
// output: 0 (same image)  
  
$imageKit->pHashDistance('2d5ad3936d2e015b', '2d6ed293db36a4fb');  
// output: 17 (similar images)  
  
$imageKit->pHashDistance('a4a65595ac94518b', '7838873e791f8400');  
// output: 37 (dissimilar images)  
```  

## Opening Issues
If you encounter a bug with `imagekit-php` we would like to hear about it. Search the existing issues and try to make sure your problem doesn’t already exist before opening a new issue. It’s helpful if you include the version of `imagekit-php`, PHP version and OS you’re using. Please include a stack trace and a simple workflow to reproduce the case when appropriate, too.


## Support

For any feedback or to report any issues or general implementation support, please reach out to [support@imagekit.io](mailto:support@imagekit.io)

## Resources

- [Main website](https://imagekit.io) -- Main Website.
- [Documentation](https://docs.imagekit.io) -- For both getting started and in-depth SDK usage information.
- [PHP Sample Project](/tree/master/sample) -- A quick, sample project to help get you started.
- [Issues](/issues) -- Check the open and closed issueses. You can report your issues as well.

## Related ImageKit Projects

- [ImageKit Node.js SDK](https://github.com/imagekit-developer/imagekit-nodejs)
- [ImageKit Ruby On Rails SDK](https://github.com/imagekit-developer/imagekit-ruby)
- [ImageKit Java SDK](https://github.com/imagekit-developer/imagekit-java)
- [ImageKit React SDK](https://github.com/imagekit-developer/imagekit-react)
- For more SDKs check [ImageKit Github](https://github.com/imagekit-developer) 

## License

Released under the MIT license.