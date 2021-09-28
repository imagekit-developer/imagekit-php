<?php

namespace ImageKit;

use GuzzleHttp\Client;
use ImageKit\Configuration\Configuration;
use ImageKit\Constants\Endpoints;
use ImageKit\Constants\ErrorMessages;
use ImageKit\Phash\Phash;
use ImageKit\Resource\GuzzleHttpWrapper;
use ImageKit\Signature\Signature;
use ImageKit\Upload\Upload;
use ImageKit\Url\Url;
use ImageKit\Utils\Authorization;
use ImageKit\Utils\Response;
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
    /**
     * ImageKit SDK VERSION
     *
     * @var string
     */
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
     * ImageKit Client Constructor
     *
     * @param string $publicKey The Public Key as obtained from the imagekit developer dashboard
     *
     * @param string $privateKey The Private Key as obtained from the imagekit developer dashboard
     *
     * @param string $urlEndpoint The URL Endpoint as obtained from the imagekit developer dashboard
     *
     * @param string $transformationPosition Default value is path that places the transformation string as a path
     * parameter in the URL. Can also be specified as query which adds the transformation string as the query parameter
     * tr in the URL. If you use src parameter to create the URL, then the transformation string is always added as
     * a query parameter.
     *
     * @return void
     */
    public function __construct($publicKey, $privateKey, $urlEndpoint, $transformationPosition =
    Transformation::DEFAULT_TRANSFORMATION_POSITION)
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
     * URL endpoints allow you to configure which origins are accessible through your account and set their preference
     * order as well.
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
     * @return Response
     */
    public function uploadFile($options)
    {
        $this->httpClient->setUri(Endpoints::getUploadFileEndpoint());
        return Upload::upload($options, $this->httpClient);
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
     * @return Response
     *
     * @deprecated since 2.0.0, use <code>uploadFile</code>; uploadFiles was misleading as it supports only singular
     * file upload
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
     * @return Response
     */
    public function listFiles(array $parameters = [])
    {
        $this->httpClient->setUri(Endpoints::getListFilesEndpoint());
        return Manage\File::listFile($parameters, $this->httpClient);
    }

    /**
     * Get the file details such as tags, customCoordinates, and isPrivate properties using get file detail API.
     *
     * @link https://docs.imagekit.io/api-reference/media-api/get-file-details API Reference
     *
     * @param string $fileId
     *
     * @return Response
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
     * @return Response
     *
     */
    public function getFileDetails($fileId)
    {
        $this->httpClient->setUri(Endpoints::getDetailsEndpoint($fileId));
        return Manage\File::getDetails($fileId, $this->httpClient);
    }

    /**
     * Get image exif, pHash and other metadata for uploaded files in ImageKit.io media library using this API.
     *
     * @link https://docs.imagekit.io/api-reference/metadata-api/get-image-metadata-for-uploaded-media-files
     *
     * @param string $fileId The unique fileId of the uploaded file. fileId is returned in list files API and upload API
     *
     * @return Response
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
     * @param string $fileId The unique fileId of the uploaded file. fileId is returned in list files API and upload API
     *
     * @return Response
     */
    public function getFileMetaData($fileId)
    {
        $this->httpClient->setUri(Endpoints::getListMetaDataFilesEndpoint($fileId));
        return Manage\File\Metadata::get($fileId, $this->httpClient);
    }

    /**
     * Update file details such as tags and customCoordinates attribute using update file detail API.
     *
     * @link https://docs.imagekit.io/api-reference/media-api/update-file-details
     *
     * @param string $fileId The unique fileId of the uploaded file. fileId is returned in list files API and upload API
     * @param array $updateData
     *
     * @return Response
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
     * @param string $fileId The unique fileId of the uploaded file. fileId is returned in list files API and upload API
     * @param array $updateData
     * @return Response
     */
    public function updateFileDetails($fileId, $updateData)
    {
        $this->httpClient->setUri(Endpoints::getUpdateFileDetailsEndpoint($fileId));
        return Manage\File::updateDetails($fileId, $updateData, $this->httpClient);
    }

    /**
     * Add tags to multiple files in a single request. The method accepts an array of fileIDs of the files and an
     * array of tags that have to be added to those files.
     *
     * @link https://docs.imagekit.io/api-reference/media-api/add-tags-bulk
     *
     * @param array<int, string> $fileIds
     * @param array<int, string> $tags
     *
     * @return Response
     */
    public function bulkAddTags(array $fileIds, array $tags)
    {
        $this->httpClient->setUri(Endpoints::getBulkAddTagsEndpoint());
        return Manage\File::bulkAddTags($fileIds, $tags, $this->httpClient);
    }

    /**
     * Remove tags to multiple files in a single request. The method accepts an array of fileIDs of the files and an
     * array of tags that have to be removed to those files.
     *
     * @link https://docs.imagekit.io/api-reference/media-api/remove-tags-bulk
     *
     * @param array<int, string> $fileIds
     * @param array<int, string> $tags
     *
     * @return Response
     */
    public function bulkRemoveTags(array $fileIds, array $tags)
    {
        $this->httpClient->setUri(Endpoints::getBulkRemoveTagsEndpoint());
        return Manage\File::bulkRemoveTags($fileIds, $tags, $this->httpClient);
    }

    /**
     * You can programmatically delete uploaded files in media library using delete file API.
     *
     * @link https://docs.imagekit.io/api-reference/media-api/delete-file
     *
     * @param $fileId
     * @return Response
     *
     */
    public function deleteFile($fileId)
    {
        $this->httpClient->setUri(Endpoints::getDeleteFilesEndpoint($fileId));
        return Manage\File::delete($fileId, $this->httpClient);
    }

    /**
     * This will purge CDN and ImageKit.io internal cache.
     *
     * @link https://docs.imagekit.io/api-reference/media-api/purge-cache
     *
     * @param $options
     * @return Response
     *
     * @deprecated since 2.0.0, use <code>purgeCache</code>
     */
    public function purgeFileCacheApi($options)
    {
        return $this->purgeCache($options);
    }

    /**
     * This will purge CDN and ImageKit.io internal cache.
     *
     * @link https://docs.imagekit.io/api-reference/media-api/purge-cache
     *
     * @param $options
     * @return Response
     *
     * @deprecated since 2.0.0, use <code>purgeCache</code>
     */
    public function purgeCacheApi($options)
    {
        return $this->purgeCache($options);
    }

    /**
     * This will purge CDN and ImageKit.io internal cache.
     *
     * @link https://docs.imagekit.io/api-reference/media-api/purge-cache
     *
     * @param $options
     * @return Response
     */
    public function purgeCache($options)
    {
        $this->httpClient->setUri(Endpoints::getPurgeCacheEndpoint());
        return Manage\Cache::purgeFileCache($options, $this->httpClient);
    }

    /**
     * Get the status of submitted purge request.
     *
     * @link https://docs.imagekit.io/api-reference/media-api/purge-cache-status
     *
     * @param $requestId
     * @return Response
     *
     * @deprecated since 2.0.0, use <code>getPurgeCacheStatus</code>
     */
    public function purgeCacheApiStatus($requestId)
    {
        return $this->getPurgeCacheStatus($requestId);
    }

    /**
     * Get the status of submitted purge request.
     *
     * @link https://docs.imagekit.io/api-reference/media-api/purge-cache-status
     *
     * @param $requestId
     * @return Response
     *
     * @deprecated since 2.0.0, use <code>getPurgeCacheStatus</code>
     */
    public function purgeFileCacheApiStatus($requestId)
    {
        return $this->getPurgeCacheStatus($requestId);
    }

    /**
     * Get the status of submitted purge request.
     *
     * @link https://docs.imagekit.io/api-reference/media-api/purge-cache-status
     *
     * @param $requestId
     * @return Response
     */
    public function getPurgeCacheStatus($requestId)
    {
        $this->httpClient->setUri(Endpoints::getPurgeCacheApiStatusEndpoint($requestId));
        return Manage\Cache::purgeFileCacheStatus($requestId, $this->httpClient);
    }

    /**
     * Delete multiple files. The method accepts an array of file IDs of the files that have to be deleted.
     *
     * @link https://docs.imagekit.io/api-reference/media-api/delete-files-bulk
     *
     * @param $options
     * @return Response
     *
     * @deprecated since 2.0.0, use <code>bulkDeleteFiles</code>
     */
    public function bulkFileDeleteByIds($options)
    {
        if (!isset($options['fileIds'])) {
            return Response::respond(true, ((object)ErrorMessages::$fileIdS_MISSING));
        }

        return $this->bulkDeleteFiles($options['fileIds']);
    }

    /**
     * Delete multiple files. The method accepts an array of file IDs of the files that have to be deleted.
     *
     * @link https://docs.imagekit.io/api-reference/media-api/delete-files-bulk
     *
     * @param $fileIds
     * @return Response
     *
     */
    public function bulkDeleteFiles($fileIds)
    {
        $this->httpClient->setUri(Endpoints::getDeleteByFileIdsEndpoint());
        return Manage\File::bulkDeleteByFileIds($fileIds, $this->httpClient);
    }

    /**
     * This will copy a file from one location to another. This method accepts the source file's path and destination
     * folder path.
     *
     * @link https://docs.imagekit.io/api-reference/media-api/copy-file
     *
     * @param $sourceFilePath
     * @param $destinationPath
     * @return Response
     */
    public function copyFile($sourceFilePath, $destinationPath)
    {
        $this->httpClient->setUri(Endpoints::getCopyFileEndpoint());
        return Manage\File::copy($sourceFilePath, $destinationPath, $this->httpClient);
    }

    /**
     * This will move a file from one location to another. This method accepts the source file's path and destination
     * folder path.
     *
     * @link https://docs.imagekit.io/api-reference/media-api/move-file
     *
     * @param $sourceFilePath
     * @param $destinationPath
     * @return Response
     */
    public function moveFile($sourceFilePath, $destinationPath)
    {
        $this->httpClient->setUri(Endpoints::getMoveFileEndpoint());
        return Manage\File::move($sourceFilePath, $destinationPath, $this->httpClient);
    }

    /**
     * This will rename a file. This method accepts the source file's path, new file name and an optional parameter
     * boolean to purge cache
     *
     *
     * @link https://docs.imagekit.io/api-reference/media-api/rename-file
     *
     * @param $filePath
     * @param $newFileName
     * @param $purgeCache
     * @return Response
     */
    public function renameFile($filePath, $newFileName, $purgeCache = false)
    {
        $this->httpClient->setUri(Endpoints::getRenameFileEndpoint());
        return Manage\File::rename($filePath, $newFileName, $purgeCache, $this->httpClient);
    }

    /**
     * This will create a new folder. This method accepts folder name and parent folder path.
     *
     * @link https://docs.imagekit.io/api-reference/media-api/create-folder
     *
     * @param $folderName
     * @param $parentFolderPath
     *
     * @return Response
     */
    public function createFolder($folderName, $parentFolderPath = '/')
    {
        $this->httpClient->setUri(Endpoints::getCreateFolderEndpoint());
        return Manage\Folder::create($folderName, $parentFolderPath, $this->httpClient);
    }

    /**
     * This will delete the specified folder and all nested files & folders.
     * This method accepts the full path of the folder that is to be deleted.
     *
     * @link https://docs.imagekit.io/api-reference/media-api/delete-folder
     *
     * @param $folderPath
     *
     * @return Response
     */
    public function deleteFolder($folderPath)
    {
        $this->httpClient->setUri(Endpoints::getDeleteFolderEndpoint());
        return Manage\Folder::delete($folderPath, $this->httpClient);
    }

    /**
     * This will copy a folder from one location to another. This method accepts the source folder's path
     * and destination folder path.
     *
     * @link https://docs.imagekit.io/api-reference/media-api/copy-folder
     *
     * @param $sourceFolderPath
     * @param $destinationPath
     *
     * @return Response
     */
    public function copyFolder($sourceFolderPath, $destinationPath)
    {
        $this->httpClient->setUri(Endpoints::getCopyFolderEndpoint());
        return Manage\Folder::copy($sourceFolderPath, $destinationPath, $this->httpClient);
    }

    /**
     * This will move a folder from one location to another. This method accepts the source folder's path
     * and destination folder path.
     *
     * @link https://docs.imagekit.io/api-reference/media-api/move-folder
     *
     * @param $sourceFolderPath
     * @param $destinationPath
     *
     * @return Response
     */
    public function moveFolder($sourceFolderPath, $destinationPath)
    {
        $this->httpClient->setUri(Endpoints::getMoveFolderEndpoint());
        return Manage\Folder::move($sourceFolderPath, $destinationPath, $this->httpClient);
    }

    /**
     * @param string $token
     * @param int $expire
     * @return object { token: string, expire: int, signature: string}
     */
    public function getAuthenticationParameters($token = '', $expire = 0)
    {
        return Signature::getAuthenticationParameters($token, $expire, $this->configuration);
    }

    /**
     * This endpoint allows you to get the status of a bulk operation e.g. copy or move folder API.
     *
     * @link https://docs.imagekit.io/api-reference/media-api/copy-move-folder-status
     *
     * @param $jobId
     * @return Response
     */
    public function getBulkJobStatus($jobId)
    {
        $this->httpClient->setUri(Endpoints::getBulkJobStatusEndpoint($jobId));

        if (empty($jobId)) {
            return Response::respond(true, ((object)ErrorMessages::$JOBID_MISSING));
        }

        $res = $this->httpClient->get();
        $stream = $res->getBody();
        $content = $stream->getContents();

        if ($res->getStatusCode() && !(200 >= $res->getStatusCode() || $res->getStatusCode() <= 300)) {
            return Response::respond(true, json_decode($content));
        }

        return Response::respond(false, json_decode($content));
    }

    /**
     * Get image exif, pHash and other metadata for uploaded files in ImageKit.io powered remote URL using this API.
     *
     * @link https://docs.imagekit.io/api-reference/metadata-api/get-image-metadata-from-remote-url
     *
     * @param $url
     * @return Response
     */
    public function getFileMetadataFromRemoteURL($url)
    {
        $this->httpClient->setUri(Endpoints::getFileMetadataFromRemoteURLEndpoint());
        return Manage\File\Metadata::getFileMetadataFromRemoteURL($url, $this->httpClient);
    }
    /**
     * Using pHash to find similar or duplicate images
     * The hamming distance between two pHash values determines how similar or different the images are.
     *
     * The pHash value returned by ImageKit.io metadata API is a hexadecimal string of 64bit pHash. The distance
     * between two hash can be between 0 and 64. A lower distance means similar images. If the distance is 0,
     * that means two images are identical.
     *
     * @param string $firstPHash
     * @param string $secondPHash
     * @return int
     */
    public function pHashDistance($firstPHash, $secondPHash)
    {
        return Phash::pHashDistance($firstPHash, $secondPHash);
    }

}
