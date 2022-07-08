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
    const SDK_VERSION = '3.0.0';

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
    Transformation::DEFAULT_TRANSFORMATION_POSITION, $handlerStack=null)
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

        $client = new Client(Authorization::addAuthorization($this->configuration,$handlerStack));
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
    public function url($options=null)
    {
        if(!isset($options)){
            return json_encode(Response::respond(true, ((object)ErrorMessages::$URL_GENERATION_PARAMETER_MISSING)));
        }
        if(!is_array($options)){
            return json_encode(Response::respond(true, ((object)ErrorMessages::$URL_GENERATION_PARAMETER_NON_ARRAY)));
        }
        if(sizeof($options)==0){
            return json_encode(Response::respond(true, ((object)ErrorMessages::$URL_GENERATION_PARAMETER_EMPTY_ARRAY)));
        }
        if (isset($options['src']) && !filter_var($options['src'], FILTER_VALIDATE_URL)) {
            return json_encode(Response::respond(true, ((object)ErrorMessages::$URL_GENERATION_SRC_INVALID)));
        }
        if (isset($options['urlEndpoint']) && !filter_var($options['urlEndpoint'], FILTER_VALIDATE_URL)) {
            return json_encode(Response::respond(true, ((object)ErrorMessages::$URL_GENERATION_URL_INVALID)));
        }
        
        if (isset($options['transformation']) && !is_array($options['transformation'])) {
            return json_encode(Response::respond(true, ((object)ErrorMessages::$URL_GENERATION_TRANSFORMATION_PARAMETER_INVALID)));
        }
        
        $urlInstance = new Url();
        return $urlInstance->buildURL(array_merge((array)$this->configuration, $options));
    }

    /**
     * You can upload files to ImageKit.io media library from your server-side using private API key authentication.
     *
     *
     * @link https://docs.imagekit.io/api-reference/upload-file-api/server-side-file-upload API Reference
     *
     * @param array $options
     * @return object
     *
     */
    public function upload($options=null)
    {
        return $this->uploadFile($options);
    }

    /**
     * You can upload files to ImageKit.io media library from your server-side using private API key authentication.
     *
     *
     * @link https://docs.imagekit.io/api-reference/upload-file-api/server-side-file-upload API Reference
     *
     * @param array $options
     * @return Response
     */
    public function uploadFile($options=null)
    {
        
        if(!isset($options)){
            return Response::respond(true, ((object)ErrorMessages::$UPLOAD_FILE_PARAMETER_MISSING));
        }
        if(!is_array($options)){
            return Response::respond(true, ((object)ErrorMessages::$UPLOAD_FILE_PARAMETER_NON_ARRAY));
        }
        if(sizeof($options)==0){
            return Response::respond(true, ((object)ErrorMessages::$UPLOAD_FILE_PARAMETER_EMPTY_ARRAY));
        }
        if (empty($options['file'])) {
            return Response::respond(true, ((object)ErrorMessages::$MISSING_UPLOAD_FILE_PARAMETER));
        }
        if (empty($options['fileName'])) {
            return Response::respond(true, ((object)ErrorMessages::$MISSING_UPLOAD_FILENAME_PARAMETER));
        }
        if(isset($options['useUniqueFileName']) && !is_bool($options['useUniqueFileName'])){
            return Response::respond(true, ((object)ErrorMessages::$UPLOAD_FILE_PARAMETER_OPTIONS_USEUNIQUEFILENAME_INVALID));
        }
        if(isset($options['isPrivateFile']) && !is_bool($options['isPrivateFile'])){
            return Response::respond(true, ((object)ErrorMessages::$UPLOAD_FILE_PARAMETER_OPTIONS_ISPRIVATEFILE_INVALID));
        }
        if(isset($options['overwriteFile']) && !is_bool($options['overwriteFile'])){
            return Response::respond(true, ((object)ErrorMessages::$UPLOAD_FILE_PARAMETER_OPTIONS_OVERWRITEFILE_INVALID));
        }
        if(isset($options['overwriteAITags']) && !is_bool($options['overwriteAITags'])){
            return Response::respond(true, ((object)ErrorMessages::$UPLOAD_FILE_PARAMETER_OPTIONS_OVERWRITEAITAGS_INVALID));
        }
        if(isset($options['overwriteTags']) && !is_bool($options['overwriteTags'])){
            return Response::respond(true, ((object)ErrorMessages::$UPLOAD_FILE_PARAMETER_OPTIONS_OVERWRITETAGS_INVALID));
        }
        if(isset($options['overwriteCustomMetadata']) && !is_bool($options['overwriteCustomMetadata'])){
            return Response::respond(true, ((object)ErrorMessages::$UPLOAD_FILE_PARAMETER_OPTIONS_OVERWRITECUSTOMMETADATA_INVALID));
        }
        if(isset($options['extensions']) && !is_array($options['extensions'])){
            return Response::respond(true, ((object)ErrorMessages::$UPLOAD_FILE_PARAMETER_OPTIONS_EXTENSIONS_INVALID));
        }
        if(isset($options['customMetadata']) && !is_array($options['customMetadata'])){
            return Response::respond(true, ((object)ErrorMessages::$UPLOAD_FILE_PARAMETER_OPTIONS_CUSTOMMETADATA_INVALID));
        }

        $this->httpClient->setUri(Endpoints::getUploadFileEndpoint());
        return Upload::upload($options, $this->httpClient);
    }

    /**
     * You can upload files to ImageKit.io media library from your server-side using private API key authentication.
     *
     *
     * @link https://docs.imagekit.io/api-reference/upload-file-api/server-side-file-upload API Reference
     *
     * @param array $options
     * @return Response
     *
     * @deprecated since 2.0.0, use <code>uploadFile</code>; uploadFiles was misleading as it supports only singular
     * 
     * file upload
     */
    public function uploadFiles($options=null)
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
    public function listFiles($parameters = null)
    {
        if($parameters){
            if(!is_array($parameters)){
                return Response::respond(true, ((object)ErrorMessages::$LIST_FILES_OPTIONS_NON_ARRAY));
            }
        }

        $this->httpClient->setUri(Endpoints::getListFilesEndpoint());
        return Manage\File::listFile($this->httpClient, $parameters);
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
    public function getDetails($fileId=null)
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
    public function getFileDetails($fileId=null)
    {
        if (empty($fileId)) {
            return Response::respond(true, ((object)ErrorMessages::$fileId_MISSING));
        }
        $this->httpClient->setUri(Endpoints::getDetailsEndpoint($fileId));
        return Manage\File::getDetails($fileId, $this->httpClient);
    }

    /**
     * Get the file version details such as tags, customCoordinates, and isPrivate properties using get file version details API.
     *
     * @link https://docs.imagekit.io/api-reference/media-api/get-file-version-details API Reference
     *
     * @param string $fileId
     * @param string $versionId
     * @return Response
     *
     */
    public function getFileVersionDetails($fileId=null, $versionId=null)
    {
        if (empty($fileId)) {
            return Response::respond(true, ((object)ErrorMessages::$fileId_MISSING));
        }
        
        if (empty($versionId)) {
            return Response::respond(true, ((object)ErrorMessages::$versionId_MISSING));
        }
        
        $this->httpClient->setUri(Endpoints::getVersionDetailsEndpoint($fileId, $versionId));
        return Manage\File::getVersionDetails($fileId, $versionId, $this->httpClient);
    }

    /**
     * Get all the versions of a file using get file versions API.
     *
     * @link https://docs.imagekit.io/api-reference/media-api/get-file-versions API Reference
     *
     * @param string $fileId
     * @return Response
     * 
     */
    public function getFileVersions($fileId=null)
    {
        if (empty($fileId)) {
            return Response::respond(true, ((object)ErrorMessages::$fileId_MISSING));
        }

        $this->httpClient->setUri(Endpoints::getFileVersionsEndpoint($fileId));
        return Manage\File::getFileVersions($fileId, $this->httpClient);
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
    public function getMetaData($fileId=null)
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
    public function getFileMetaData($fileId=null)
    {
        if (empty($fileId)) {
            return Response::respond(true, ((object)ErrorMessages::$fileId_MISSING));
        }
        $this->httpClient->setUri(Endpoints::getListMetaDataFilesEndpoint($fileId));
        return Manage\CustomMetadataFields::get($fileId, $this->httpClient);
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
    public function updateDetails($fileId=null, $updateData=null)
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
    public function updateFileDetails($fileId=null, $updateData=null)
    {
        if (empty($fileId)) {
            return Response::respond(true, ((object)ErrorMessages::$fileId_MISSING));
        }

        if (!is_array($updateData) || sizeof($updateData)==0) {
            return Response::respond(true, ((object)ErrorMessages::$UPDATE_DATA_MISSING));
        }

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
    public function bulkAddTags($fileIds=null, $tags=null)
    {
        if(!isset($fileIds)){
            return Response::respond(true, ((object)ErrorMessages::$BULK_TAGS_FILEIDS_MISSING));
        }
        if(!is_array($fileIds)){
            return Response::respond(true, ((object)ErrorMessages::$BULK_TAGS_FILEIDS_NON_ARRAY));
        }
        if(sizeof($fileIds)==0){
            return Response::respond(true, ((object)ErrorMessages::$BULK_TAGS_FILEIDS_EMPTY_ARRAY));
        }
        if(!isset($tags)){
            return Response::respond(true, ((object)ErrorMessages::$BULK_TAGS_TAGS_MISSING));
        }
        if(!is_array($tags)){
            return Response::respond(true, ((object)ErrorMessages::$BULK_TAGS_TAGS_NON_ARRAY));
        }
        if(sizeof($tags)==0){
            return Response::respond(true, ((object)ErrorMessages::$BULK_TAGS_TAGS_EMPTY_ARRAY));
        }

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
    public function bulkRemoveTags($fileIds=null, $tags=null)
    {
        if(!isset($fileIds)){
            return Response::respond(true, ((object)ErrorMessages::$BULK_TAGS_FILEIDS_MISSING));
        }
        if(!is_array($fileIds)){
            return Response::respond(true, ((object)ErrorMessages::$BULK_TAGS_FILEIDS_NON_ARRAY));
        }
        if(sizeof($fileIds)==0){
            return Response::respond(true, ((object)ErrorMessages::$BULK_TAGS_FILEIDS_EMPTY_ARRAY));
        }
        if(!isset($tags)){
            return Response::respond(true, ((object)ErrorMessages::$BULK_TAGS_TAGS_MISSING));
        }
        if(!is_array($tags)){
            return Response::respond(true, ((object)ErrorMessages::$BULK_TAGS_TAGS_NON_ARRAY));
        }
        if(sizeof($tags)==0){
            return Response::respond(true, ((object)ErrorMessages::$BULK_TAGS_TAGS_EMPTY_ARRAY));
        }

        $this->httpClient->setUri(Endpoints::getBulkRemoveTagsEndpoint());
        return Manage\File::bulkRemoveTags($fileIds, $tags, $this->httpClient);
    }

    /**
     * Remove AI tags from multiple files in a single request. The method accepts an array of fileIDs of the files and an array of tags that have to be removed to those files.
     *
     * @link https://docs.imagekit.io/api-reference/media-api/remove-aitags-bulk
     *
     * @param array<int, string> $fileIds
     * @param array<int, string> $AITags
     *
     * @return Response
     */
    public function bulkRemoveAITags($fileIds=null, $AITags=null)
    {
        if(!isset($fileIds)){
            return Response::respond(true, ((object)ErrorMessages::$BULK_TAGS_FILEIDS_MISSING));
        }
        if(!is_array($fileIds)){
            return Response::respond(true, ((object)ErrorMessages::$BULK_TAGS_FILEIDS_NON_ARRAY));
        }
        if(sizeof($fileIds)==0){
            return Response::respond(true, ((object)ErrorMessages::$BULK_TAGS_FILEIDS_EMPTY_ARRAY));
        }
        if(!isset($AITags)){
            return Response::respond(true, ((object)ErrorMessages::$BULK_TAGS_TAGS_MISSING));
        }
        if(!is_array($AITags)){
            return Response::respond(true, ((object)ErrorMessages::$BULK_TAGS_TAGS_NON_ARRAY));
        }
        if(sizeof($AITags)==0){
            return Response::respond(true, ((object)ErrorMessages::$BULK_TAGS_TAGS_EMPTY_ARRAY));
        }
        $this->httpClient->setUri(Endpoints::getBulkRemoveAITagsEndpoint());
        return Manage\File::bulkRemoveAITags($fileIds, $AITags, $this->httpClient);
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
    public function deleteFile($fileId=null)
    {
        if (!isset($fileId) || empty($fileId)) {
            return Response::respond(true, ((object)ErrorMessages::$fileId_MISSING));
        }
        
        $this->httpClient->setUri(Endpoints::getDeleteFilesEndpoint($fileId));
        return Manage\File::delete($fileId, $this->httpClient);
    }


    /**
     * You can programmatically delete uploaded file version in media library using delete file version API.
     *
     * @link https://docs.imagekit.io/api-reference/media-api/delete-file-version
     *
     * @param $fileId
     * @param $versionId
     * @return Response
     *
     */
    public function deleteFileVersion($fileId=null, $versionId=null)
    {
        if (!isset($fileId) || empty($fileId)) {
            return Response::respond(true, ((object)ErrorMessages::$fileId_MISSING));
        }
        
        if (!isset($versionId) || empty($versionId)) {
            return Response::respond(true, ((object)ErrorMessages::$versionId_MISSING));
        }

        $this->httpClient->setUri(Endpoints::getDeleteFileVersionEndpoint($fileId,$versionId));
        return Manage\File::deleteVersion($fileId, $versionId, $this->httpClient);
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
    public function purgeFileCacheApi($options=null)
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
    public function purgeCacheApi($options=null)
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
    public function purgeCache($options=null)
    {
        if (empty($options)) {
            return Response::respond(true, ((object)ErrorMessages::$CACHE_PURGE_URL_MISSING));
        }
        
        if (!filter_var($options, FILTER_VALIDATE_URL)) {
            return Response::respond(true, ((object)ErrorMessages::$CACHE_PURGE_URL_INVALID));
        }

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
    public function purgeCacheStatus($requestId=null)
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
    public function purgeFileCacheApiStatus($requestId=null)
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
    public function getPurgeCacheStatus($requestId=null)
    {
        if (empty($requestId)) {
            return Response::respond(true, ((object)ErrorMessages::$CACHE_PURGE_STATUS_ID_MISSING));
        }
        
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
    public function bulkFileDeleteByIds($fileIds=null)
    {
        return $this->bulkDeleteFiles($fileIds);
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
    public function bulkDeleteFiles($fileIds=null)
    {
        if (!isset($fileIds)) {
            return Response::respond(true, ((object)ErrorMessages::$fileIdS_MISSING));
        }
        if (!is_array($fileIds)) {
            return Response::respond(true, ((object)ErrorMessages::$fileIdS_NON_ARRAY));
        }
        if (sizeof($fileIds)==0) {
            return Response::respond(true, ((object)ErrorMessages::$fileIdS_EMPTY_ARRAY));
        }
        
        $this->httpClient->setUri(Endpoints::getDeleteByFileIdsEndpoint());
        return Manage\File::bulkDeleteByFileIds($fileIds, $this->httpClient);
    }

    /**
     * This will copy a file from one location to another. This method accepts an array of source file's path, destination path and boolean to include versions or not
     * folder path.
     *
     * @link https://docs.imagekit.io/api-reference/media-api/copy-file
     *
     * @param $parameter['sourceFilePath','destinationPath','includeFileVersions']
     * @return Response
     * 
     */
    public function copy($parameter=null)
    {
        if(!isset($parameter)){
            return Response::respond(true, ((object)ErrorMessages::$COPY_FILE_PARAMETER_MISSING));
        }
        if(!is_array($parameter)){
            return Response::respond(true, ((object)ErrorMessages::$COPY_FILE_PARAMETER_NON_ARRAY));
        }
        if(sizeof($parameter)==0){
            return Response::respond(true, ((object)ErrorMessages::$COPY_FILE_PARAMETER_EMPTY_ARRAY));
        }
        if (empty($parameter['sourceFilePath']) || empty($parameter['destinationPath'])) {
            return Response::respond(true, ((object)ErrorMessages::$COPY_FILE_DATA_INVALID));
        }

        $this->httpClient->setUri(Endpoints::getCopyFileEndpoint());
        return Manage\File::copy($parameter['sourceFilePath'], $parameter['destinationPath'], $parameter['includeFileVersions']??false, $this->httpClient);
    }

    
    /**
     * This will copy a file from one location to another. This method accepts an array of source file's path, destination path and boolean to include versions or not
     * folder path.
     *
     * @link https://docs.imagekit.io/api-reference/media-api/copy-file
     *
     * @param $sourceFilePath
     * @param $destinationPath
     * @param $includeFileVersions
     * @return Response
     * 
     * @deprecated since 3.0.0, use <code>copy</code>
     *
     */
    public function copyFile($sourceFilePath=null, $destinationPath=null, $includeFileVersions=null)
    {
        
        if (empty($sourceFilePath) || empty($destinationPath)) {
            return Response::respond(true, ((object)ErrorMessages::$COPY_FILE_DATA_INVALID));
        }

        $this->httpClient->setUri(Endpoints::getCopyFileEndpoint());
        return Manage\File::copy($sourceFilePath, $destinationPath, $includeFileVersions, $this->httpClient);
    }

    /**
     * This will move a file from one location to another. This method accepts an array containing source file's path and destination path
     * folder path.
     *
     * @link https://docs.imagekit.io/api-reference/media-api/move-file
     *
     * @param $parameter['sourceFilePath','destinationPath']
     * @return Response
     * 
     */
    public function move($parameter=null)
    {
        if(!isset($parameter)){
            return Response::respond(true, ((object)ErrorMessages::$MOVE_FILE_PARAMETER_MISSING));
        }
        if(!is_array($parameter)){
            return Response::respond(true, ((object)ErrorMessages::$MOVE_FILE_PARAMETER_NON_ARRAY));
        }
        if(sizeof($parameter)==0){
            return Response::respond(true, ((object)ErrorMessages::$MOVE_FILE_PARAMETER_EMPTY_ARRAY));
        }
        if (empty($parameter['sourceFilePath']) || empty($parameter['destinationPath'])) {
            return Response::respond(true, ((object)ErrorMessages::$MOVE_FILE_DATA_INVALID));
        }
        $this->httpClient->setUri(Endpoints::getMoveFileEndpoint());
        return Manage\File::move($parameter['sourceFilePath'], $parameter['destinationPath'], $this->httpClient);
    }

    /**
     * This will move a file from one location to another. This method accepts an array containing source file's path and destination path
     * folder path.
     *
     * @link https://docs.imagekit.io/api-reference/media-api/move-file
     *
     * @param $sourceFilePath
     * @param $destinationPath
     * @param $includeVersions
     * @return Response
     * 
     * @deprecated since 3.0.0, use <code>move</code>
     */
    public function moveFile($sourceFilePath=null, $destinationPath=null)
    {
        if (empty($sourceFilePath) || empty($destinationPath)) {
            return Response::respond(true, ((object)ErrorMessages::$MOVE_FILE_DATA_INVALID));
        }
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
     * @param $parameter[$filePath, $newFileNamem, $purgeCache]
     * 
     * @return Response
     */
    public function rename($parameter=null)
    {
        if(!isset($parameter)){
            return Response::respond(true, ((object)ErrorMessages::$RENAME_FILE_PARAMETER_MISSING));
        }
        if(!is_array($parameter)){
            return Response::respond(true, ((object)ErrorMessages::$RENAME_FILE_PARAMETER_NON_ARRAY));
        }
        if(sizeof($parameter)==0){
            return Response::respond(true, ((object)ErrorMessages::$RENAME_FILE_PARAMETER_EMPTY_ARRAY));
        }
        if (empty($parameter['filePath']) || empty($parameter['newFileName'])) {
            return Response::respond(true, ((object)ErrorMessages::$RENAME_FILE_DATA_INVALID));
        }
        $purgeCache= false;
        if(isset($parameter['purgeCache'])){
            if(!is_bool($parameter['purgeCache'])){
                return Response::respond(true, ((object)ErrorMessages::$RENAME_FILE_DATA_INVALID_PURGE_CACHE));
            }
            else{
                $purgeCache = $parameter['purgeCache'];
            }
        }

        $this->httpClient->setUri(Endpoints::getRenameFileEndpoint());
        return Manage\File::rename($parameter['filePath'], $parameter['newFileName'], $purgeCache, $this->httpClient);
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
     * 
     * @deprecated since 3.0.0, use <code>rename</code>
     */
    public function renameFile($filePath, $newFileName, $purgeCache = false)
    {
        if (empty($filePath) || empty($newFileName)) {
            return Response::respond(true, ((object)ErrorMessages::$RENAME_FILE_DATA_INVALID));
        }

        $this->httpClient->setUri(Endpoints::getRenameFileEndpoint());
        return Manage\File::rename($filePath, $newFileName, $purgeCache, $this->httpClient);
    }
    
    /**
     * This will Restore file version to a different version of a file. This method accepts the fileId and versionId
     *
     *
     * @link https://docs.imagekit.io/api-reference/media-api/restore-file-version
     *
     * @param $parameter[$fileId, $versionId]
     * @return Response
     */
    public function restoreFileVersion($parameter=null)
    {
        if(!isset($parameter)){
            return Response::respond(true, ((object)ErrorMessages::$RESTORE_FILE_VERSION_PARAMETER_MISSING));
        }
        if(!is_array($parameter)){
            return Response::respond(true, ((object)ErrorMessages::$RESTORE_FILE_VERSION_PARAMETER_NON_ARRAY));
        }
        if(sizeof($parameter)==0){
            return Response::respond(true, ((object)ErrorMessages::$RESTORE_FILE_VERSION_PARAMETER_EMPTY_ARRAY));
        }
        if (empty($parameter['fileId']) || empty($parameter['versionId'])) {
            return Response::respond(true, ((object)ErrorMessages::$RESTORE_FILE_VERSION_DATA_INVALID));
        }
        $this->httpClient->setUri(Endpoints::getRestoreFileVersionEndpoint($parameter['fileId'], $parameter['versionId']));
        return Manage\File::restoreVersion($this->httpClient);
    }


    /**
     * This will create a new folder. This method accepts folder name and parent folder path in an array.
     *
     * @link https://docs.imagekit.io/api-reference/media-api/create-folder
     *
     * @param $parameter[$folderName, $parentFolderPath]
     *
     * @return Response
     */
    public function createFolder($parameter=null)
    {
        if(!isset($parameter)){
            return Response::respond(true, ((object)ErrorMessages::$CREATE_FOLDER_PARAMETER_MISSING));
        }
        if(!is_array($parameter)){
            return Response::respond(true, ((object)ErrorMessages::$CREATE_FOLDER_PARAMETER_NON_ARRAY));
        }
        if(sizeof($parameter)==0){
            return Response::respond(true, ((object)ErrorMessages::$CREATE_FOLDER_PARAMETER_EMPTY_ARRAY));
        }
        if (empty($parameter['folderName']) || empty($parameter['parentFolderPath'])) {
            return Response::respond(true, ((object)ErrorMessages::$CREATE_FOLDER_DATA_INVALID));
        }
        $this->httpClient->setUri(Endpoints::getCreateFolderEndpoint());
        return Manage\Folder::create($parameter['folderName'], $parameter['parentFolderPath'], $this->httpClient);
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
    public function deleteFolder($folderPath=null)
    {
        if(!isset($folderPath) || empty($folderPath)){
            return Response::respond(true, ((object)ErrorMessages::$DELETE_FOLDER_PARAMETER_MISSING));
        }
        $this->httpClient->setUri(Endpoints::getDeleteFolderEndpoint());
        return Manage\Folder::delete($folderPath, $this->httpClient);
    }

    /**
     * This will copy a folder from one location to another. This method accepts an array of source folder's path, destination path and boolean to include versions or not.
     *
     * @link https://docs.imagekit.io/api-reference/media-api/copy-folder
     *
     * @param $parameter[$sourceFolderPath, $destinationPath, includeFileVersions]
     *
     * @return Response
     */
    public function copyFolder($parameter=null)
    {
        if(!isset($parameter)){
            return Response::respond(true, ((object)ErrorMessages::$COPY_FOLDER_PARAMETER_MISSING));
        }
        if(!is_array($parameter)){
            return Response::respond(true, ((object)ErrorMessages::$COPY_FOLDER_PARAMETER_NON_ARRAY));
        }
        if(sizeof($parameter)==0){
            return Response::respond(true, ((object)ErrorMessages::$COPY_FOLDER_PARAMETER_EMPTY_ARRAY));
        }
        if (empty($parameter['sourceFolderPath']) || empty($parameter['destinationPath'])) {
            return Response::respond(true, ((object)ErrorMessages::$COPY_FOLDER_DATA_INVALID));
        }

        $this->httpClient->setUri(Endpoints::getCopyFolderEndpoint());
        return Manage\Folder::copy($parameter['sourceFolderPath'], $parameter['destinationPath'], $parameter['includeFileVersions']??false, $this->httpClient);
    }

    /**
     * This will move a folder from one location to another. This method accepts the source folder's path
     * and destination folder path in an array.
     *
     * @link https://docs.imagekit.io/api-reference/media-api/move-folder
     *
     * @param $parameter[$sourceFolderPath, $destinationPath]
     *
     * @return Response
     */
    public function moveFolder($parameter=null)
    {
        if(!isset($parameter)){
            return Response::respond(true, ((object)ErrorMessages::$MOVE_FOLDER_PARAMETER_MISSING));
        }
        if(!is_array($parameter)){
            return Response::respond(true, ((object)ErrorMessages::$MOVE_FOLDER_PARAMETER_NON_ARRAY));
        }
        if(sizeof($parameter)==0){
            return Response::respond(true, ((object)ErrorMessages::$MOVE_FOLDER_PARAMETER_EMPTY_ARRAY));
        }
        if (empty($parameter['sourceFolderPath']) || empty($parameter['destinationPath'])) {
            return Response::respond(true, ((object)ErrorMessages::$MOVE_FOLDER_DATA_INVALID));
        }

        $this->httpClient->setUri(Endpoints::getMoveFolderEndpoint());
        return Manage\Folder::move($parameter['sourceFolderPath'], $parameter['destinationPath'], $this->httpClient);
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
    public function getBulkJobStatus($jobId=null)
    {
        
        if (empty($jobId)) {
            return Response::respond(true, ((object)ErrorMessages::$JOBID_MISSING));
        }
        $this->httpClient->setUri(Endpoints::getBulkJobStatusEndpoint($jobId));
        
        try {
            $res = $this->httpClient->get();
        } catch (\Throwable $th) {
            return Response::respond(true, $th->getMessage());
        }
        if($res && $res->getBody() && $res->getHeaders() && $res->getStatusCode()){
            $stream = $res->getBody();
            $content = [];
            $content['body'] = json_decode($stream->getContents());
            $headers = $res->getHeaders();
            $content['headers'] = $headers;
            $content['statusCode'] = $res->getStatusCode();
    
            if ($res->getStatusCode() && ($res->getStatusCode() < 200 || $res->getStatusCode() > 300)) {
                return Response::respond(true, ($content));
            }
    
            return Response::respond(false, ($content));
        }
        else{
            return Response::respond(true, ((object)ErrorMessages::$INVALID_REQUEST)->message);
        }
    }

    /**
     * Get image exif, pHash and other metadata for uploaded files in ImageKit.io powered remote URL using this API.
     *
     * @link https://docs.imagekit.io/api-reference/metadata-api/get-image-metadata-from-remote-url
     *
     * @param $url
     * @return Response
     */
    public function getFileMetadataFromRemoteURL($url=null)
    {
        if (empty($url)) {
            return Response::respond(true, ((object)ErrorMessages::$MISSING_URL_PARAMETER));
        }
        
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            return Response::respond(true, ((object)ErrorMessages::$INVALID_URL_PARAMETER));
        }

        $this->httpClient->setUri(Endpoints::getFileMetadataFromRemoteURLEndpoint());
        return Manage\CustomMetadataFields::getFileMetadataFromRemoteURL($url, $this->httpClient);
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
    public function pHashDistance($firstPHash=null, $secondPHash=null)
    {
        if(!isset($firstPHash) || empty($firstPHash)){
            return Response::respond(true, ((object)ErrorMessages::$PHASH_DISTANCE_FIRST_PHASH_MISSING));
        }
        if(!isset($secondPHash) || empty($secondPHash)){
            return Response::respond(true, ((object)ErrorMessages::$PHASH_DISTANCE_SECOND_PHASH_MISSING));
        }
        return Phash::pHashDistance($firstPHash, $secondPHash);
    }

    
    /**
     * Create custom metadata field using this API.
     *
     * @link https://docs.imagekit.io/api-reference/custom-metadata-fields-api/create-custom-metadata-field
     *
     * @param $parameter[$name,$label,$schema]
     * @return Response
     */
    public function createCustomMetadataField($parameter=null)
    {
        if(!isset($parameter)){
            return Response::respond(true, ((object)ErrorMessages::$CREATE_CUSTOM_METADATA_PARAMETER_MISSING));
        }
        if(!is_array($parameter)){
            return Response::respond(true, ((object)ErrorMessages::$CREATE_CUSTOM_METADATA_PARAMETER_NON_ARRAY));
        }
        if(sizeof($parameter)==0){
            return Response::respond(true, ((object)ErrorMessages::$CREATE_CUSTOM_METADATA_PARAMETER_EMPTY_ARRAY));
        }
        if (empty($parameter['name']) || empty($parameter['label']) || !isset($parameter['schema'])) {
            return Response::respond(true, ((object)ErrorMessages::$CREATE_CUSTOM_METADATA_DATA_INVALID));
        }
        if(!isset($parameter['schema']['type']) || empty($parameter['schema']['type'])){
            return Response::respond(true, ((object)ErrorMessages::$CREATE_CUSTOM_METADATA_DATA_INVALID_SCHEMA_OBJECT));
        }

        $this->httpClient->setUri(Endpoints::createCustomMetadataField());
        return Manage\CustomMetadataFields::createCustomMetadataField($parameter['name'], $parameter['label'], $parameter['schema'], $this->httpClient);
    }
    
    /**
     * Get custom metadata field using this API.
     *
     * @link https://docs.imagekit.io/api-reference/custom-metadata-fields-api/get-custom-metadata-field
     *
     * @param $includeDeleted
     * @return Response
     */
    public function getCustomMetadataFields($includeDeleted=false)
    {
        if(!is_bool($includeDeleted)){
            return Response::respond(true, ((object)ErrorMessages::$GET_CUSTOM_METADATA_INVALID_PARAMETER)); 
        }
        $this->httpClient->setUri(Endpoints::getCustomMetadataField());
        return Manage\CustomMetadataFields::getCustomMetadataField($includeDeleted, $this->httpClient);
    }
    
    /**
     * Update custom metadata field using this API.
     *
     * @link https://docs.imagekit.io/api-reference/custom-metadata-fields-api/update-custom-metadata-field
     *
     * @param $id
     * @param $parameter[$name,$label,$schema]
     * @return Response
     */
    public function updateCustomMetadataField($id=null,$parameter=null)
    {
        if(!isset($id) && !isset($parameter)){
            return Response::respond(true, ((object)ErrorMessages::$UPDATE_CUSTOM_METADATA_PARAMETER_MISSING));
        }
        if(!isset($id) || empty($id)){
            return Response::respond(true, ((object)ErrorMessages::$UPDATE_CUSTOM_METADATA_ID_MISSING));
        }
        if(!isset($parameter)){
            return Response::respond(true, ((object)ErrorMessages::$UPDATE_CUSTOM_METADATA_BODY_MISSING));
        }
        if(!is_array($parameter)){
            return Response::respond(true, ((object)ErrorMessages::$UPDATE_CUSTOM_METADATA_PARAMETER_NON_ARRAY));
        }
        if(sizeof($parameter)==0){
            return Response::respond(true, ((object)ErrorMessages::$UPDATE_CUSTOM_METADATA_PARAMETER_EMPTY_ARRAY));
        }
        if (empty($parameter['label']) || !isset($parameter['schema'])) {
            return Response::respond(true, ((object)ErrorMessages::$UPDATE_CUSTOM_METADATA_DATA_INVALID));
        }
        if(!isset($parameter['schema']['type']) || empty($parameter['schema']['type'])){
            return Response::respond(true, ((object)ErrorMessages::$UPDATE_CUSTOM_METADATA_DATA_INVALID_SCHEMA_OBJECT));
        }

        $this->httpClient->setUri(Endpoints::updateCustomMetadataField($id));
        return Manage\CustomMetadataFields::updateCustomMetadataField($parameter['label'], $parameter['schema'], $this->httpClient);
    }
    
    /**
     * Delete custom metadata field using this API.
     *
     * @link https://docs.imagekit.io/api-reference/custom-metadata-fields-api/delete-custom-metadata-field
     *
     * @param $id
     * @return Response
     */
    public function deleteCustomMetadataField($id=null)
    {
        if(!isset($id) || empty($id)){
            return Response::respond(true, ((object)ErrorMessages::$DELETE_CUSTOM_METADATA_ID_MISSING));
        }
        
        $this->httpClient->setUri(Endpoints::deleteCustomMetadataField($id));
        return Manage\CustomMetadataFields::deleteCustomMetadataField($this->httpClient);
    }

}
