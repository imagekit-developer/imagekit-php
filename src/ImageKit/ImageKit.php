<?php

namespace ImageKit;

use GuzzleHttp\Client;
use ImageKit\Configuration\Configuration;
use ImageKit\Constants\Endpoints;
use ImageKit\Phash\Phash;
use ImageKit\Resource\GuzzleHttpWrapper;
use ImageKit\Signature\Signature;
use ImageKit\Upload\Upload;
use ImageKit\Url\Url;
use ImageKit\Utils\Authorization;
use ImageKit\Utils\Transformation;
use InvalidArgumentException;

/**
 * Imagekit Class
 *
 * @package Imagekit
 *
 * @link https://docs.imagekit.io/ Imagekit Documentation
 */
class ImageKit
{
    const SDK_VERSION = '2.0.0';

    /**
     * @var Configuration
     */
    private $configuration;

    /**
     * @var GuzzleHttpWrapper
     */
    private $httpClient;

    /**
     * @param string $publicKey The Public Key as obtained from the imagekit developer dashboard
     *
     * @param string $privateKey The Private Key as obtained from the imagekit developer dashboard
     *
     * @param string $urlEndpoint The URL Endpoint as obtained from the imagekit developer dashboard
     *
     * @param string $transformationPosition Default value is path that places the transformation string as a path parameter in the URL. Can also be specified as query which adds the transformation string as the query parameter tr in the URL. If you use src parameter to create the URL, then the transformation string is always added as a query parameter.
     *
     */
    public function __construct($publicKey, $privateKey, $urlEndpoint, $transformationPosition = Transformation::DEFAULT_TRANSFORMATION_POSITION)
    {
        $this->configuration = new Configuration();
        if ($publicKey == null || empty($publicKey)) {
            $msg = 'Missing publicKey during ImageKit initialization';
            throw new InvalidArgumentException($msg);
        }
        $this->configuration->publicKey = $publicKey;

        if ($privateKey == null || empty($privateKey)) {
            $msg = 'Missing privateKey during ImageKit initialization';
            throw new InvalidArgumentException($msg);
        }
        $this->configuration->privateKey = $privateKey;

        if ($urlEndpoint == null || empty($urlEndpoint)) {
            $msg = 'Missing urlEndpoint during ImageKit initialization';
            throw new InvalidArgumentException($msg);
        }

        if (!filter_var($urlEndpoint, FILTER_VALIDATE_URL)) {
            throw new InvalidArgumentException('urlEndpoint should be a valid URL');
        }
        $this->configuration->urlEndpoint = $urlEndpoint;

        if ($transformationPosition !== 'path' && $transformationPosition !== 'query') {
            $msg = 'Invalid transformationPosition during ImageKit initialization. Can be one of path or query';
            throw new InvalidArgumentException($msg);
        }
        $this->configuration->transformationPosition = $transformationPosition;



        $client = new Client(Authorization::addAuthorization($this->configuration));
        $this->httpClient = new GuzzleHttpWrapper($client);
    }

    /**
     * You can add multiple origins in the same ImageKit.io account.
     * URL endpoints allow you to configure which origins are accessible through your account and set their preference order as well.
     *
     * @link https://docs.imagekit.io/integration/url-endpoints Url Endpoint Documentation
     * @link https://github.com/imagekit-developer/imagekit-php#url-generation Url Generation Documentation
     *
     * @param array $options
     * @return string
     */
    public function url(array $options)
    {
        $urlInstance = new Url();
        return $urlInstance->buildURL(array_merge((array)$this->configuration, $options));
    }

    /**
     * You can upload files to ImageKit.io media library from your server-side using private API key authentication.
     *
     * File size limit
     * The maximum upload file size is limited to 25MB.
     *
     * @link https://docs.imagekit.io/api-reference/upload-file-api/server-side-file-upload API Reference
     *
     * @param array $options
     * @return object
     *
     */
    public function upload(array $options)
    {
        return $this->uploadFile($options);
    }

    /**
     * You can upload files to ImageKit.io media library from your server-side using private API key authentication.
     *
     * File size limit
     * The maximum upload file size is limited to 25MB.
     *
     * @link https://docs.imagekit.io/api-reference/upload-file-api/server-side-file-upload API Reference
     *
     * @param array $options
     * @return object
     */
    public function uploadFile($options)
    {
        $this->httpClient->setUri(Endpoints::getUploadFileEndpoint());
        return Upload::uploadFileRequest($options, $this->httpClient);
    }

    /**
     * You can upload files to ImageKit.io media library from your server-side using private API key authentication.
     *
     * File size limit
     * The maximum upload file size is limited to 25MB.
     *
     * @link https://docs.imagekit.io/api-reference/upload-file-api/server-side-file-upload API Reference
     *
     * @param array $options
     * @return object
     *
     * @deprecated since 2.0.0, use <code>uploadFile</code>; uploadFiles was misleading as it supports only singular file upload
     */
    public function uploadFiles(array $options)
    {
        return $this->uploadFile($options);
    }

    /**
     * This API can list all the uploaded files in your ImageKit.io media library.
     * For searching and filtering, you can use query parameters as described below.
     *
     * @link https://docs.imagekit.io/api-reference/media-api/list-and-search-files API Reference
     *
     * @param array $parameters
     * @return object
     */
    public function listFiles(array $parameters = [])
    {
        $this->httpClient->setUri(Endpoints::getListFilesEndpoint());
        return Manage\File::listFiles($parameters, $this->httpClient);
    }

    /**
     * Get the file details such as tags, customCoordinates, and isPrivate properties using get file detail API.
     *
     * @link https://docs.imagekit.io/api-reference/media-api/get-file-details API Reference
     *
     * @param string $fileId
     *
     * @deprecated since 2.0.0, use <code>getFileDetails</code>
     */
    public function getDetails($fileId)
    {
        return $this->getFileDetails($fileId);
    }

    /**
     * Get the file details such as tags, customCoordinates, and isPrivate properties using get file detail API.
     *
     * @link https://docs.imagekit.io/api-reference/media-api/get-file-details API Reference
     *
     * @param string $fileId
     * @return object
     */
    public function getFileDetails($fileId)
    {
        $this->httpClient->setUri(Endpoints::getDetailsEndpoint($fileId));
        return Manage\File::getFileDetails($fileId, $this->httpClient);
    }

    /**
     * Get image exif, pHash and other metadata for uploaded files in ImageKit.io media library using this API.
     *
     * @link https://docs.imagekit.io/api-reference/metadata-api/get-image-metadata-for-uploaded-media-files
     *
     * @param string $fileId The unique fileId of the uploaded file. fileId is returned in list files API and upload API.
     *
     * @return object
     * @deprecated since 2.0.0, use <code>getFileMetaData</code>
     */
    public function getMetaData($fileId)
    {
        return $this->getFileMetaData($fileId);
    }

    /**
     * Get image exif, pHash and other metadata for uploaded files in ImageKit.io media library using this API.
     *
     * @link https://docs.imagekit.io/api-reference/metadata-api/get-image-metadata-for-uploaded-media-files
     *
     * @param string $fileId The unique fileId of the uploaded file. fileId is returned in list files API and upload API.
     *
     * @return object
     */
    public function getFileMetaData($fileId)
    {
        $this->httpClient->setUri(Endpoints::getListMetaDataFilesEndpoint($fileId));

        return Manage\File\Metadata::getFileMetaData($fileId, $this->httpClient);
    }

    /**
     * Update file details such as tags and customCoordinates attribute using update file detail API.
     *
     * @link https://docs.imagekit.io/api-reference/media-api/update-file-details
     *
     * @param string $fileId The unique fileId of the uploaded file. fileId is returned in list files API and upload API.
     * @param array $updateData
     *
     * @return object
     * @deprecated since 2.0.0, use <code>updateFileDetails</code>
     */
    public function updateDetails($fileId, $updateData)
    {
        return $this->updateFileDetails($fileId, $updateData);
    }

    /**
     * Update file details such as tags and customCoordinates attribute using update file detail API.
     *
     * @link https://docs.imagekit.io/api-reference/media-api/update-file-details
     *
     * @param string $fileId The unique fileId of the uploaded file. fileId is returned in list files API and upload API.
     * @param array $updateData
     * @return object
     */
    public function updateFileDetails($fileId, $updateData)
    {
        $this->httpClient->setUri(Endpoints::getUpdateFileDetailsEndpoint($fileId));
        return Manage\File::updateFileDetails($fileId, $updateData, $this->httpClient);
    }

    // @TODO

    /**
     * @param array $fileIds
     * @param array $tags
     */
    public function bulkAddTags(array $fileIds, array $tags)
    {

    }

    // @TODO

    /**
     * @param array $fileIds
     * @param array $tags
     */
    public function bulkRemoveTags(array $fileIds, array $tags)
    {

    }

    /**
     * @param $fileId
     * @return object
     */
    /**
     * @param $fileId
     * @return object
     */
    public function deleteFile($fileId)
    {
        $this->httpClient->setUri(Endpoints::getDeleteFilesEndpoint($fileId));
        return Manage\File::deleteFile($fileId, $this->httpClient);
    }

    /**
     * @deprecated use purgeCache
     */
    public function purgeCacheApi($options)
    {
        return $this->purgeCache($options);
    }

    /**
     * @param $options
     * @return object
     */
    public function purgeCache($options)
    {

        $this->httpClient->setUri(Endpoints::getPurgeCacheEndpoint());

        $purgeCacheApiInstance = new File();
        return $purgeCacheApiInstance->purgeFileCacheApi($options, $this->httpClient);
    }

    /**
     * @param $options
     * @return object
     */

    /**
     * @deprecated use purgeCache
     */
    public function purgeFileCacheApi($options)
    {
        return $this->purgeCache($options);
    }

    /**
     * @deprecated use getPurgeCacheStatus
     */
    public function purgeCacheApiStatus($requestId)
    {
        return $this->getPurgeCacheStatus($requestId);
    }

    /**
     * @param $requestId
     * @return object
     */
    public function getPurgeCacheStatus($requestId)
    {

        $this->httpClient->setUri(Endpoints::getPurgeCacheApiStatusEndpoint($requestId));

        $purgeCacheApiStatusInstance = new File();
        return $purgeCacheApiStatusInstance->purgeFileCacheApiStatus($requestId, $this->httpClient);
    }

    /**
     * @param $requestId
     * @return object
     */

    /**
     * @deprecated use getPurgeCacheStatus
     */
    public function purgeFileCacheApiStatus($requestId)
    {
        return $this->getPurgeCacheStatus($requestId);
    }

    /**
     * @deprecated use bulkDeleteFiles
     */
    public function bulkFileDeleteByIds($options)
    {
        return $this->bulkDeleteFiles($options);
    }


    /**
     * @param $options
     * @return object
     */
    /**
     * @param $options
     * @return object
     */
    public function bulkDeleteFiles($options)
    {
        $this->httpClient->setUri(Endpoints::getDeleteByFileIdsEndpoint());

        return Manage\File::bulkDeleteByFileIds($options, $this->httpClient);
    }


    // @TODO
    /**
     * @param $sourceFilePath
     * @param $destinationPath
     */
    public function copyFile($sourceFilePath, $destinationPath)
    {

    }

    // @TODO
    /**
     * @param $sourceFilePath
     * @param $destinationPath
     */
    public function moveFile($sourceFilePath, $destinationPath)
    {

    }

    // @TODO
    /**
     * @param $folderName
     * @param $parentFolderPath
     */
    public function createFolder($folderName, $parentFolderPath)
    {

    }

    // @TODO
    /**
     * @param $folderPath
     */
    public function deleteFolder($folderPath)
    {

    }

    // @TODO

    /**
     * @param $sourceFolderPath
     * @param $destinationPath
     */
    public function copyFolder($sourceFolderPath, $destinationPath)
    {

    }

    /**
     * @param $sourceFolderPath
     * @param $destinationPath
     */
    public function moveFolder($sourceFolderPath, $destinationPath)
    {

    }

    /**
     * @param string $token
     * @param int $expire
     * @return array
     */
    public function getAuthenticationParameters($token = '', $expire = 0)
    {
        return Signature::getAuthenticationParameters($token, $expire, $this->configuration);
    }

    // @TODO
    /**
     * @param $jobId
     */
    public function getBulkJobStatus($jobId)
    {

    }

    /**
     * @param $firstPHash
     * @param $secondPHash
     * @return int
     */
    public function pHashDistance($firstPHash, $secondPHash)
    {
        $pHashInstance = new Phash();
        return $pHashInstance->pHashDistance($firstPHash, $secondPHash);
    }

    /**
     * @param $url
     * @return object
     */
    public function getFileMetadataFromRemoteURL($url)
    {

        $this->httpClient->setUri(Endpoints::getFileMetadataFromRemoteURLEndpoint());

        $fileInstance = new File();
        return $fileInstance->getFileMetadataFromRemoteURL($url, $this->httpClient);
    }

    /**
     * @param $str
     * @return false|mixed|string
     */
    private function removeTrailingSlash($str)
    {
        if (is_string($str) and strlen($str) > 0 and substr($str, -1) == '/') {
            $str = substr($str, 0, -1);
        }
        return $str;
    }
}
