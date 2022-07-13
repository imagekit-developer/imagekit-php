# PHP SDK for ImageKit

[![Packagist](https://img.shields.io/packagist/v/imagekit/imagekit.svg)](https://packagist.org/packages/imagekit/imagekit)  [![Packagist](https://img.shields.io/packagist/dt/imagekit/imagekit.svg)](https://packagist.org/packages/imagekit/imagekit)  [![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT) [![codecov](https://codecov.io/gh/imagekit-developer/imagekit-php/branch/master/graph/badge.svg)](https://codecov.io/gh/imagekit-developer/imagekit-php) [![Twitter Follow](https://img.shields.io/twitter/follow/imagekitio?label=Follow&style=social)](https://twitter.com/ImagekitIo)
[![PHP Test CI](https://github.com/imagekit-developer/imagekit-php/actions/workflows/test.yml/badge.svg)](https://github.com/imagekit-developer/imagekit-php/actions/workflows/test.yml) [![PHP Coverage CI](https://github.com/imagekit-developer/imagekit-php/actions/workflows/coverage.yml/badge.svg)](https://github.com/imagekit-developer/imagekit-php/actions/workflows/coverage.yml) [![Wiki Documentation](https://img.shields.io/badge/wiki-documentation-forestgreen)](https://github.com/imagekit-developer/imagekit-php/wiki)

PHP SDK for [ImageKit](https://imagekit.io/) implements the new APIs and interface for different file operations.

ImageKit is complete media storage, optimization, and transformation solution that comes with an [image and video CDN](https://imagekit.io/). It can be integrated with your existing infrastructure - storage like AWS S3, web servers, your CDN, and custom domain names, allowing you to deliver optimized images in minutes with minimal code changes.

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
- [Signed URL & Image Transformations](#applying-chained-transformations-common-image-manipulations--signed-url)
- [Server-side File Upload](#server-side-file-upload)
- [File Management](#file-management)
- [Custom Metadata Fields API](#custom-metadata-fields-api)
- [Utility Function](#utility-functions)
- [Opening Issues](#opening-issues)
- [Support](#support)
- [Resources](#resources)
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

You can use this PHP SDK for three different methods - URL generation, file upload, and file management. The usage of the SDK has been explained below.

* `URL Generation`
* `File Upload`
* `File Management`

## Getting Started
1. **Sign up for ImageKit** – Before you begin, you need to sign up for an [ImageKit account](https://imagekit.io/registration/)
2. Get your [API Keys](https://docs.imagekit.io/api-reference/api-introduction/api-keys) from [developer options](https://imagekit.io/dashboard/developer) inside the dashboard.
3. **Minimum requirements** – To use PHP SDK, your system must meet the minimum requirements, including having **PHP >= 5.6**. We highly recommend having it compiled with the cURL extension and cURL 7.16.2+ compiled with a TLS backend (e.g., NSS or OpenSSL).
4. **Install the SDK** – Using Composer is the recommended way to install the ImageKit SDK for PHP. The SDK is available via [Packagist](http://packagist.org/) under the [`imagekit/imagekit`](https://packagist.org/packages/imagekit/imagekit) package. If Composer is installed globally on your system, you can run the following in the base directory of your project to add the SDK as a dependency:
   ```
   composer require imagekit/imagekit
   ```
   Please see the [Installation](#installation) section for more detailed information about installing.
5. **Using the SDK** – The best way to become familiar with how to use the SDK is to follow the examples provided in the [quick start guide](https://docs.imagekit.io/getting-started/quickstart-guides/php).

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
// For URL Generation, works for both images and videos
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
$uploadFile = $imageKit->uploadFile([
    'file' => 'file-url', # required, "binary","base64" or "file url"
    'fileName' => 'new-file' # required
]);
```  

#### Response Structure
Following is the response for [server-side file upload API](https://docs.imagekit.io/api-reference/upload-file-api/server-side-file-upload#response-code-and-structure-json)

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
            "etag": 'W/"1b2-reNzjRCFNt45rEyD7yFY/dk+Ghg"',
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

## Demo application

* Step-by-step PHP quick start guide - https://docs.imagekit.io/getting-started/quickstart-guides/php
* You can also run the demo application in this repository's [sample](/sample) folder.
  ```sh  
  cd sample
  php sample.php
  ```  
  
## URL generation 

### Using relative file path and URL endpoint
  
This method allows you to create an URL to access a file using the relative file path and the ImageKit URL endpoint (`urlEndpoint`). The file can be an image, video, or any other static file supported by ImageKit.
  
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
This method allows you to add transformation parameters to an absolute URL. For example, if you have configured a custom CNAME and have absolute asset URLs in your database or CMS, you will often need this.

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
| transformationPosition | Optional. The default value is `path` which places the transformation string as a path parameter in the URL. It can also be specified as `query`, which adds the transformation string as the query parameter `tr` in the URL. The transformation string is always added as a query parameter if you use the `src` parameter to create the URL.                                                                                                                                                                                                                                                 |  
| queryParameters       | Optional. These are the other query parameters that you want to add to the final URL. These can be any query parameters and are not necessarily related to ImageKit. Especially useful if you want to add some versioning parameters to your URLs.                                                                                                                                                                                                                                                                                                                                           |  
| signed                | Optional. Boolean. The default value is `false`. If set to `true`, the SDK generates a signed image URL adding the image signature to the image URL.                                                                                                                                                                                                                                                                                                              |  
| expireSeconds         | Optional. Integer. It is used along with the `signed` parameter. It specifies the time in seconds from now when the signed URL will expire. If specified, the URL contains the expiry timestamp in the URL, and the image signature is modified accordingly.                                                                                                                                                

### Applying chained transformations, common image manipulations & signed URL

This section covers the basics:

* [Chained Transformations as a query parameter](#1-chained-transformations-as-a-query-parameter)
* [Image enhancement & color manipulation](#2-image-enhancement-and-color-manipulation)
* [Resizing images and videos](#3-resizing-images-and-videos)
* [Quality manipulation](#4-quality-manipulation)
* [Adding overlays to images](#5-adding-overlays-to-images)
* [Signed URL](#6-signed-url)

The PHP SDK gives a name to each transformation parameter e.g. `height` for `h` and `width` for `w` parameter. It makes your code more readable. See the [Full list of supported transformations](#list-of-supported-transformations).

👉 If the property does not match any of the available options, it is added as it is. For example:
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
👉 Note that you can also use the `h` and `w` parameters instead of `height` and `width`. 

For more examples, check the [Demo Application](https://github.com/imagekit-developer/imagekit-php/tree/master/sample).


### 1. Chained transformations as a query parameter

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

Some transformations like [contrast stretch](https://docs.imagekit.io/features/image-transformations/image-enhancement-and-color-manipulation#contrast-stretch-e-contrast) , [sharpen](https://docs.imagekit.io/features/image-transformations/image-enhancement-and-color-manipulation#sharpen-e-sharpen) and [unsharp mask](https://docs.imagekit.io/features/image-transformations/image-enhancement-and-color-manipulation#unsharp-mask-e-usm) can be added to the URL with or without any other value. To use such transforms without specifying a value, specify the value as "-" in the transformation object. Otherwise, specify the value that you want to be added to this transformation.

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

### 3. Resizing images and videos
Let's resize the image to `width` 400 and `height` 300.
Check detailed instructions on [resize, crop, and other Common transformations](https://docs.imagekit.io/features/image-transformations/resize-crop-and-other-transformations)

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
You can use the [quality parameter](https://docs.imagekit.io/features/image-transformations/resize-crop-and-other-transformations#quality-q) to change quality like this.

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
ImageKit.io  allows overlaying [images](https://docs.imagekit.io/features/image-transformations/overlay#image-overlay) or [text](https://docs.imagekit.io/features/image-transformations/overlay#text-overlay) over other images and videos for watermarking or creating dynamic assets using custom text.

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

For example, the signed URL expires in 300 seconds with the default URL endpoint and other query parameters.
For a detailed explanation of the signed URL, refer to this [documentation](https://docs.imagekit.io/features/security/signed-urls).

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

You can manage [security settings](https://docs.imagekit.io/features/security#restricting-unsigned-urls) from the dashboard to prevent unsigned URLs usage. In that case, if the URL doesn't have a signature `ik-s` parameter or the signature is invalid, ImageKit will return a forbidden error instead of an actual image.

### List of supported transformations

The complete list of transformations supported and their usage in ImageKit can be found in the docs for [images](https://docs.imagekit.io/features/image-transformations) and [videos](https://docs.imagekit.io/features/video-transformation). The SDK gives a name to each transformation parameter, making the code simpler, making the code simpler, and readable.

If a transformation is supported in ImageKit, but a name for it cannot be found in the table below, then use the transformation code from ImageKit docs as the name when using the `url` function.

If you want to generate transformations in your application and add them to the URL as it is, use the `raw` parameter.

| Supported Transformation Name | Translates to parameter |
|-------------------------------|-------------------------|
| height | h |
| width | w |
| aspectRatio | ar |
| quality | q |
| crop | c |
| cropMode | cm |
| x | x |
| y | y |
| focus | fo |
| format | f |
| radius | r |
| background | bg |
| border | b |
| rotation | rt |
| blur | bl |
| named | n |
| overlayX | ox |
| overlayY | oy |
| overlayFocus | ofo |
| overlayHeight | oh |
| overlayWidth | ow |
| overlayImage | oi |
| overlayImageTrim | oit |
| overlayImageAspectRatio | oiar |
| overlayImageBackground | oibg |
| overlayImageBorder | oib |
| overlayImageDPR | oidpr |
| overlayImageQuality | oiq |
| overlayImageCropping | oic |
| overlayImageFocus | oifo |
| overlayImageTrim | oit |
| overlayText | ot |
| overlayTextFontSize | ots |
| overlayTextFontFamily | otf |
| overlayTextColor | otc |
| overlayTextTransparency | oa |
| overlayAlpha | oa |
| overlayTextTypography | ott |
| overlayBackground | obg |
| overlayTextEncoded | ote |
| overlayTextWidth | otw |
| overlayTextBackground | otbg |
| overlayTextPadding | otp |
| overlayTextInnerAlignment | otia |
| overlayRadius | or |
| progressive | pr |
| lossless | lo |
| trim | t |
| metadata | md |
| colorProfile | cp |
| defaultImage | di |
| dpr | dpr |
| effectSharpen | e-sharpen |
| effectUSM | e-usm |
| effectContrast | e-contrast |
| effectGray | e-grayscale |
| original | orig |
| raw | `replaced by the parameter value` |


## Server-side File Upload

The SDK provides a simple interface using the `$imageKit->uploadFile()` method to upload files to the [ImageKit Media Library](https://imagekit.io/dashboard/media-library). 

- [Server-side file upload API](https://docs.imagekit.io/api-reference/upload-file-api/server-side-file-upload).
- [Supported file types and extensions](https://docs.imagekit.io/api-reference/upload-file-api#allowed-file-types-for-uploading).

#### Basic Usage
```php
$uploadFile = $imageKit->uploadFile([
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
            "etag": 'W/"1b2-reNzjRCFNt45rEyD7yFY/dk+Ghg"',
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
Please refer to [server-side file upload API request structure](https://docs.imagekit.io/api-reference/upload-file-api/server-side-file-upload#request-structure-multipart-form-data) for a detailed explanation of mandatory and optional parameters.

```php
// Attempt File Uplaod
$uploadFile = $imageKit->uploadFile([
    'file' => 'your_file',                  //  required, "binary","base64" or "file url"
    'fileName' => 'your_file_name.jpg',     //  required
    // Optional Parameters
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
]);
```  

## File Management

The SDK provides a simple interface for all the following [Media APIs](https://docs.imagekit.io/api-reference/media-api) to manage your files.

### 1. List and Search Files

This API can list all the uploaded files and folders in your [ImageKit.io](https://docs.imagekit.io/api-reference/media-api) media library. 

Refer to the [list and search file API](https://docs.imagekit.io/api-reference/media-api/list-and-search-files) for a better understanding of the **request & response structure**.

#### Example
```php
$listFiles = $imageKit->listFiles();
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
In addition, you can fine-tune your query by specifying various filters by generating a query string in a Lucene-like syntax and providing this generated string as the value of the `searchQuery`.

```php
$listFiles = $imageKit->listFiles([
    "searchQuery" => '(size < "1mb" AND width > 500) OR (tags IN ["summer-sale","banner"])',
]);
```
Detailed documentation can be found here for [advance search queries](https://docs.imagekit.io/api-reference/media-api/list-and-search-files#advanced-search-queries).

### 2. Get File Details

This API will get all the details and attributes of the current version of the asset.

Refer to the [get file details API](https://docs.imagekit.io/api-reference/media-api/get-file-details) for a better understanding of the **request & response structure**.

#### Example
```php
$getFileDetails = $imageKit->getFileDetails('file_id');
```

### 3. Get File Version Details

This API can get you all the details and attributes for the provided version of the file.

Refer to the [get file version details API](https://docs.imagekit.io/api-reference/media-api/get-file-version-details) for a better understanding of the **request & response structure**.

#### Example
```php
$getFileVersionDetails = $imageKit->getFileVersionDetails('file_id','version_id');
```

### 4. Get File Versions

This API will get you all the versions of an asset.

Refer to the [get file versions API](https://docs.imagekit.io/api-reference/media-api/get-file-versions) for a better understanding of the **request & response structure**.

#### Example
```php
$getFileVersions = $imageKit->getFileVersions('file_id');
```

### 5. Update File Details

Update file details such as `tags`, `customCoordinates` attributes, remove existing `AITags`, and apply [extensions](https://docs.imagekit.io/extensions/overview) using update file details API. This operation can only be performed only on the current version of an asset.

Refer to the [update file details API](https://docs.imagekit.io/api-reference/media-api/update-file-details) for better understanding about the **request & response structure**.

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

### 6. Add Tags (Bulk) API

Add tags to multiple files in a single request. The method accepts an array of `fileIds` of the files and an array of `tags` that have to be added to those files.

Refer to the [add tags (Bulk) API](https://docs.imagekit.io/api-reference/media-api/add-tags-bulk) for a better understanding of the **request & response structure**.

#### Example
```php
$fileIds = ['file_id1','file_id2'];
$tags = ['image_tag_1', 'image_tag_2'];

$bulkAddTags = $imageKit->bulkAddTags($fileIds, $tags);
```

### 7. Remove Tags (Bulk) API

Remove tags from multiple files in a single request. The method accepts an array of `fileIds` of the files and an array of `tags` that have to be removed from those files.

Refer to the [remove tags (Bulk) API](https://docs.imagekit.io/api-reference/media-api/remove-tags-bulk) for a better understanding of the **request & response structure**.

#### Example
```php
$fileIds = ['file_id1','file_id2'];
$tags = ['image_tag_1', 'image_tag_2'];

$bulkRemoveTags = $imageKit->bulkRemoveTags($fileIds, $tags);
```

### 8. Remove AI Tags (Bulk) API

Remove AI tags from multiple files in a single request. The method accepts an array of `fileIds` of the files and an array of `AITags` that have to be removed from those files.

Refer to the [remove AI Tags (Bulk) API](https://docs.imagekit.io/api-reference/media-api/remove-aitags-bulk) for a better understanding of the **request & response structure**.

#### Example
```php
$fileIds = ['file_id1','file_id2'];
$AITags = ['image_AITag_1', 'image_AITag_2'];

$bulkRemoveTags = $imageKit->bulkRemoveTags($fileIds, $AITags);
```

### 9. Delete File API

You can programmatically delete uploaded files in the media library using delete file API.

> If a file or specific transformation has been requested in the past, then the response is cached. Deleting a file does not purge the cache. However, you can purge the cache using [Purge Cache API](#21-purge-cache-api).

Refer to the [delete file API](https://docs.imagekit.io/api-reference/media-api/delete-file) for better understanding about the **request & response structure**.

#### Basic Usage
```php
$fileId = 'file_id';
$deleteFile = $imageKit->deleteFile($fileId);
```

### 10. Delete File Version API

Using the delete file version API, you can programmatically delete the uploaded file version in the media library.

> You can delete only the non-current version of a file.

Refer to the [delete file version API](https://docs.imagekit.io/api-reference/media-api/delete-file-version) for a better understanding of the **request & response structure**.

#### Example
```php
$fileId = 'file_id';
$versionId = 'version_id';
$deleteFileVersion = $imageKit->deleteFileVersion($fileId, $versionId);
```

### 11. Delete Files (Bulk) API

Deletes multiple files and their versions from the media library.

Refer to the [delete files (Bulk) API](https://docs.imagekit.io/api-reference/media-api/delete-files-bulk) for a better understanding of the **request & response structure**.

#### Example
```php
$fileIds = ["5e1c13d0c55ec3437c451406", ...];
$deleteFiles = $imageKit->bulkDeleteFiles($fileIds);
```


### 12. Copy File API

This will copy a file from one folder to another.

>  If any file at the destination has the same name as the source file, then the source file and its versions (if `includeFileVersions` is set to true) will be appended to the destination file version history.

Refer to the [copy file API](https://docs.imagekit.io/api-reference/media-api/copy-file) for a better understanding of the **request & response structure**.

#### Basic Usage
```php
$sourceFilePath = '/sample-folder1/sample-file.jpg';
$destinationPath = '/sample-folder2/';
$includeFileVersions = false;

$copyFile = $imageKit->copy([
    'sourceFilePath' => $sourceFilePath,
    'destinationPath' => $destinationPath,
    'includeFileVersions' => $includeFileVersions
]);
```

### 13. Move File API

This will move a file and all its versions from one folder to another.

>  If any file at the destination has the same name as the source file, then the source file and its versions will be appended to the destination file.

Refer to the [move file API](https://docs.imagekit.io/api-reference/media-api/move-file) for a better understanding of the **request & response structure**.

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

Using Rename File API, you can programmatically rename an already existing file in the media library. This operation would rename all versions of the file.

>  The old URLs will stop working. However, the file/file version URLs cached on CDN will continue to work unless a purge is requested.

Refer to the [rename file API](https://docs.imagekit.io/api-reference/media-api/rename-file) for a better understanding of the **request & response structure**.

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
$renameFile = $imageKit->rename([
    'filePath' => $filePath,
    'newFileName' => $newFileName,
],true);
```

### 15. Restore File Version API

This will restore the provided file version to a different version of the file. The newly restored version of the file will be returned in the response.

Refer to the [restore file version API](https://docs.imagekit.io/api-reference/media-api/restore-file-version) for a better understanding of the **request & response structure**.

#### Example
```php
$fileId = 'fileId';
$versionId = 'versionId';
$restoreFileVersion = $imageKit->restoreFileVersion([
    'fileId' => $fileId,
    'versionId' => $versionId,
]);
```

### 16. Create Folder API

This will create a new folder. You can specify the folder name and location of the parent folder where this new folder should be created.

Refer to the [create folder API](https://docs.imagekit.io/api-reference/media-api/create-folder) for a better understanding of the **request & response structure**.

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

Refer to the [delete folder API](https://docs.imagekit.io/api-reference/media-api/delete-folder) for a better understanding of the **request & response structure**.

#### Example
```php
$folderPath = '/new-folder';
$deleteFolder = $imageKit->deleteFolder($folderPath);
```

### 18. Copy Folder API

This will copy one folder into another.

Refer to the [copy folder API](https://docs.imagekit.io/api-reference/media-api/copy-folder) for a better understanding of the **request & response structure**.

#### Example
```php
$sourceFolderPath = '/source-folder/';
$destinationPath = '/destination-folder/';
$includeFileVersions = false;
$copyFolder = $imageKit->copyFolder([
    'sourceFolderPath' => $sourceFolderPath,
    'destinationPath' => $destinationPath,
    'includeFileVersions' => $includeFileVersions
]);
```

### 19. Move Folder API

This will move one folder into another. The selected folder, its nested folders, files, and their versions are moved in this operation.

> If any file at the destination has the same name as the source file, then the source file and its versions will be appended to the destination file version history.

Refer to the [move folder API](https://docs.imagekit.io/api-reference/media-api/move-folder) for a better understanding of the **request & response structure**.

#### Example
```php
$sourceFolderPath = '/sample-folder/';
$destinationPath = '/destination-folder/';
$moveFolder = $imageKit->moveFolder([
    'sourceFolderPath' => $sourceFolderPath,
    'destinationPath' => $destinationPath
]);
```

### 20. Bulk Job Status API

This endpoint allows you to get the status of a bulk operation e.g. [Copy Folder API](#18-copy-folder-api) or [Move Folder API](#19-move-folder-api).

Refer to the [bulk job status API](https://docs.imagekit.io/api-reference/media-api/copy-move-folder-status) for a better understanding of the **request & response structure**.

#### Example
```php
$jobId = 'jobId';
$bulkJobStatus = $imageKit->getBulkJobStatus($jobId);
```

### 21. Purge Cache API

This will purge CDN and ImageKit.io's internal cache. In response, `requestId` is returned, which can be used to fetch the status of the submitted purge request with [Purge Cache Status API](#22-purge-cache-status-api).

Refer to the [Purge Cache API](https://docs.imagekit.io/api-reference/media-api/purge-cache) for a better understanding of the **request & response structure**.

#### Example
```php
$image_url = 'https://ik.imagekit.io/demo/sample-folder/sample-file.jpg';
$purgeCache = $imageKit->purgeCache($image_url);
```

You can purge the cache for multiple files. Check [purge cache multiple files](https://docs.imagekit.io/api-reference/media-api/purge-cache#purge-cache-for-multiple-files).

### 22. Purge Cache Status API

Get the purge cache request status using the `requestId` returned when a purge cache request gets submitted with [Purge Cache API](#21-purge-cache-api)

Refer to the [Purge Cache Status API](https://docs.imagekit.io/api-reference/media-api/purge-cache-status) for a better understanding of the **request & response structure**.

#### Example
```php
$cacheRequestId = '598821f949c0a938d57563bd';
$purgeCacheStatus = $imageKit->purgeCacheStatus($cacheRequestId);
```

### 23. Get File Metadata API (From File ID)

Get the image EXIF, pHash, and other metadata for uploaded files in the ImageKit.io media library using this API.

Refer to the [get image metadata for uploaded media files API](https://docs.imagekit.io/api-reference/metadata-api/get-image-metadata-for-uploaded-media-files) for a better understanding of the **request & response structure**.

#### Example
```php
$fileId = '598821f949c0a938d57563bd';
$getFileMetadata = $imageKit->getFileMetaData($fileId);
```

### 24. Get File Metadata API (From Remote URL)

Get image EXIF, pHash, and other metadata from ImageKit.io powered remote URL using this API.

Refer to the [get image metadata from remote URL API](https://docs.imagekit.io/api-reference/metadata-api/get-image-metadata-from-remote-url) for a better understanding of the **request & response structure**.

#### Example
```php
$image_url = 'https://ik.imagekit.io/demo/sample-folder/sample-file.jpg';
$getFileMetadataFromRemoteURL = $imageKit->getFileMetadataFromRemoteURL($image_url);
```
## Custom Metadata Fields API

Imagekit.io allows you to define a `schema` for your metadata keys, and the value filled against that key will have to adhere to those rules. You can [create](#1-create-fields), [read](#2-get-fields) and [update](#3-update-fields) custom metadata rules and update your file with custom metadata value in [file update API](#5-update-file-details) or [file upload API](#server-side-file-upload).

For a detailed explanation, refer to the [custom metadata fields documentation](https://docs.imagekit.io/api-reference/custom-metadata-fields-api).


### 1. Create Fields

Create a custom metadata field with this API.

Refer to the [create custom metadata fields API](https://docs.imagekit.io/api-reference/custom-metadata-fields-api/create-custom-metadata-field) for a better understanding of the **request & response structure**.

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

Check for the [allowed values in the schema](https://docs.imagekit.io/api-reference/custom-metadata-fields-api/create-custom-metadata-field#allowed-values-in-the-schema-object).

### 2. Get Fields

Get a list of all the custom metadata fields.

Refer to the [get custom metadata fields API](https://docs.imagekit.io/api-reference/custom-metadata-fields-api/get-custom-metadata-field) for a better understanding of the **request & response structure**.

#### Example
```php
$includeDeleted = false;
$getCustomMetadataField = $imageKit->getCustomMetadataField($includeDeleted);
```

### 3. Update Fields

Update an existing custom metadata field's `label` or `schema`.

Refer to the [update custom metadata fields API](https://docs.imagekit.io/api-reference/custom-metadata-fields-api/update-custom-metadata-field) for a better understanding of the **request & response structure**.

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

Check for the [allowed values in the schema](https://docs.imagekit.io/api-reference/custom-metadata-fields-api/create-custom-metadata-field#allowed-values-in-the-schema-object).


### 4. Delete Fields

Delete a custom metadata field.

Refer to the [delete custom metadata fields API](https://docs.imagekit.io/api-reference/custom-metadata-fields-api/delete-custom-metadata-field) for a better understanding of the **request & response structure**.

#### Example
```php
$customMetadataFieldId = '598821f949c0a938d57563dd';

$deleteCustomMetadataField = $imageKit->deleteCustomMetadataField($customMetadataFieldId);
```


## Utility functions

We have included the following commonly used utility functions in this SDK.

### Authentication parameter generation

If you want to implement client-side file upload, you will need a `token`, `expiry` timestamp, and a valid `signature` for that upload. The SDK provides a simple method you can use in your code to generate these authentication parameters.

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

Both the `token` and `expire` parameters are optional. If not specified, the SDK internally generates a random token and a valid expiry timestamp. The value of the `token` and `expire` used to create the signature is always returned in the response, whether they are provided in input or not.

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
If you encounter a bug with `imagekit-php` we would like to hear about it. Search the existing issues and try to make sure your problem doesn't already exist before opening a new issue. It's helpful if you include the version of `imagekit-php`, PHP version, and OS you're using. Please include a stack trace and a simple workflow to reproduce the case when appropriate, too.


## Support

For any feedback or to report any issues or general implementation support, please reach out to [support@imagekit.io](mailto:support@imagekit.io)

## Resources

- [Main website](https://imagekit.io) - Main Website.
- [Documentation](https://docs.imagekit.io) - For both getting started and in-depth SDK usage information.
- [PHP quick start guide](https://docs.imagekit.io/getting-started/quickstart-guides/php)

## License

Released under the MIT license.