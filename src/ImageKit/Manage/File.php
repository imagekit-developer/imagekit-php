<?php

namespace ImageKit\Manage;

use ImageKit\Constants\ErrorMessages;
use ImageKit\Resource\GuzzleHttpWrapper;
use ImageKit\Utils\Response;

/**
 *
 * @internal
 */
class File
{
    /**
     * List File API
     *
     * @param array $parameters
     * @param GuzzleHttpWrapper $resource
     *
     * @return Response
     */
    public static function listFile(array $parameters, GuzzleHttpWrapper $resource)
    {
        if (isset($parameters['tags']) && is_array($parameters['tags'])) {
            $parameters['tags'] = implode(',', $parameters['tags']);
        }

        if (isset($parameters['includeFolder']) && is_bool($parameters['includeFolder'])) {
            $parameters['includeFolder'] = json_encode($parameters['includeFolder']);
        }

        $resource->setDatas($parameters);
        $res = $resource->get();
        $stream = $res->getBody();
        $content = [];
        $content['body'] = json_decode($stream->getContents());
        $headers = $res->getHeaders();
        $content['headers'] = $headers;
        $content['statusCode'] = $res->getStatusCode();
        

        if ($res->getStatusCode() && $res->getStatusCode() !== 200) {
            return Response::respond(true, ($content));
        }

        return Response::respond(false, ($content));
    }

    /**
     * Get Details Of file
     *
     * @param string $fileId
     * @param GuzzleHttpWrapper $resource
     *
     * @return Response
     */
    public static function getDetails($fileId, GuzzleHttpWrapper $resource)
    {
        if (empty($fileId)) {
            return Response::respond(true, ((object)ErrorMessages::$fileId_MISSING));
        }

        $res = $resource->get();
        $stream = $res->getBody();
        $content = [];
        $content['body'] = json_decode($stream->getContents());
        $headers = $res->getHeaders();
        $content['headers'] = $headers;
        $content['statusCode'] = $res->getStatusCode();
        
        if ($res->getStatusCode() && $res->getStatusCode() !== 200) {
            return Response::respond(true, ($content));
        }

        return Response::respond(false, ($content));
    }

    /**
     * Get Version Details Of file
     *
     * @param string $fileId
     * @param string $versionId
     * @param GuzzleHttpWrapper $resource
     *
     * @return Response
     */
    public static function getVersionDetails($fileId, $versionId, GuzzleHttpWrapper $resource)
    {
        $errors = [];
        if (empty($fileId)) {
            $errors[] = ((object)ErrorMessages::$fileId_MISSING);
        }
        
        if (empty($versionId)) {
            $errors[] = ((object)ErrorMessages::$versionId_MISSING);
        }
        
        if(!empty($errors)){
            return Response::respond(true, $errors);
        }

        $res = $resource->get();
        $stream = $res->getBody();
        $content = [];
        $content['body'] = json_decode($stream->getContents());
        $headers = $res->getHeaders();
        $content['headers'] = $headers;
        $content['statusCode'] = $res->getStatusCode();
        
        if ($res->getStatusCode() && $res->getStatusCode() !== 200) {
            return Response::respond(true, ($content));
        }

        return Response::respond(false, ($content));
    }

    /**
     * Get All Versions Of file
     *
     * @param string $fileId
     * @param GuzzleHttpWrapper $resource
     *
     * @return Response
     */
    public static function getFileVersions($fileId, GuzzleHttpWrapper $resource)
    {
        $errors = [];
        if (empty($fileId)) {
            $errors[] = ((object)ErrorMessages::$fileId_MISSING);
        }
        
        if(!empty($errors)){
            return Response::respond(true, $errors);
        }

        $res = $resource->get();
        $stream = $res->getBody();
        $content = [];
        $content['body'] = json_decode($stream->getContents());
        $headers = $res->getHeaders();
        $content['headers'] = $headers;
        $content['statusCode'] = $res->getStatusCode();

        if ($res->getStatusCode() && $res->getStatusCode() !== 200) {
            return Response::respond(true, ($content));
        }

        return Response::respond(false, ($content));
    }


    /**
     * Delete File API
     *
     * @param $fileId
     * @param GuzzleHttpWrapper $resource
     *
     * @return Response
     */
    public static function delete($fileId, GuzzleHttpWrapper $resource)
    {
        if (empty($fileId)) {
            return Response::respond(true, ((object)ErrorMessages::$fileId_MISSING));
        }

        $resource->setDatas((array)$fileId);
        $res = $resource->delete();
        $stream = $res->getBody();
        $content = [];
        $content['body'] = json_decode($stream->getContents());
        $headers = $res->getHeaders();
        $content['headers'] = $headers;
        $content['statusCode'] = $res->getStatusCode();

        if ($res->getStatusCode() && $res->getStatusCode() !== 200) {
            return Response::respond(true, ($content));
        }

        return Response::respond(false, ($content));
    }


    /**
     * Delete File Version API
     *
     * @param $fileId
     * @param $versionId
     * @param GuzzleHttpWrapper $resource
     *
     * @return Response
     */
    public static function deleteVersion($fileId, $versionId, GuzzleHttpWrapper $resource)
    {
        $errors = [];
        if (empty($fileId)) {
            $errors[] = ((object)ErrorMessages::$fileId_MISSING);
        }
        
        if (empty($versionId)) {
            $errors[] = ((object)ErrorMessages::$versionId_MISSING);
        }
        
        if(!empty($errors)){
            return Response::respond(true, $errors);
        }
        
        // $resource->setDatas($fileId);
        $res = $resource->delete();
        $stream = $res->getBody();
        $content = [];
        $content['body'] = json_decode($stream->getContents());
        $headers = $res->getHeaders();
        $content['headers'] = $headers;
        $content['statusCode'] = $res->getStatusCode();

        if ($res->getStatusCode() && $res->getStatusCode() !== 200) {
            return Response::respond(true, ($content));
        }

        return Response::respond(false, ($content));
    }

    /**
     * Delete Bulk Files by File ID API
     *
     * @param $fileIds
     * @param GuzzleHttpWrapper $resource
     *
     * @return Response
     */
    public static function bulkDeleteByFileIds($fileIds, GuzzleHttpWrapper $resource)
    {
        if (empty($fileIds)) {
            return Response::respond(true, ((object)ErrorMessages::$fileIdS_MISSING));
        }
        if (!is_array($fileIds)) {
            return Response::respond(true, ((object)ErrorMessages::$fileIdS_NON_ARRAY));
        }

        $resource->setDatas(['fileIds' => $fileIds]);
        $res = $resource->post();
        $stream = $res->getBody();
        $content = [];
        $content['body'] = json_decode($stream->getContents());
        $headers = $res->getHeaders();
        $content['headers'] = $headers;
        $content['statusCode'] = $res->getStatusCode();

        if ($res->getStatusCode() && !(200 >= $res->getStatusCode() || $res->getStatusCode() <= 300)) {
            return Response::respond(true, ($content));
        }

        return Response::respond(false, ($content));
    }


    /**
     * Copy File API
     *
     * @param $sourceFilePath
     * @param $destinationPath
     * @param $includeVersions
     * @param GuzzleHttpWrapper $resource
     *
     * @return Response
     */
    public static function copy($sourceFilePath, $destinationPath, $includeVersions, GuzzleHttpWrapper $resource)
    {
        $resource->setDatas(['sourceFilePath' => $sourceFilePath, 'destinationPath' => $destinationPath, 'includeVersions' => $includeVersions]);
        $res = $resource->post();
        $stream = $res->getBody();
        $content = [];
        $content['body'] = json_decode($stream->getContents());
        $headers = $res->getHeaders();
        $content['headers'] = $headers;
        $content['statusCode'] = $res->getStatusCode();

        if ($res->getStatusCode() && !(200 >= $res->getStatusCode() || $res->getStatusCode() <= 300)) {
            return Response::respond(true, ($content));
        }

        return Response::respond(false, ($content));
    }

    /**
     * Move File API
     *
     * @param $sourceFilePath
     * @param $destinationPath
     * @param GuzzleHttpWrapper $resource
     *
     * @return Response
     */
    public static function move($sourceFilePath, $destinationPath, GuzzleHttpWrapper $resource)
    {
        $resource->setDatas(['sourceFilePath' => $sourceFilePath, 'destinationPath' => $destinationPath]);
        $res = $resource->post();
        $stream = $res->getBody();
        $content = [];
        $content['body'] = json_decode($stream->getContents());
        $headers = $res->getHeaders();
        $content['headers'] = $headers;
        $content['statusCode'] = $res->getStatusCode();

        if ($res->getStatusCode() && !(200 >= $res->getStatusCode() || $res->getStatusCode() <= 300)) {
            return Response::respond(true, ($content));
        }

        return Response::respond(false, ($content));
    }


    /**
     * Rename File API
     *
     * @param $filePath
     * @param $newFileName
     * @param $purgeCache
     * @param GuzzleHttpWrapper $resource
     *
     * @return Response
     */
    public static function rename($filePath, $newFileName, $purgeCache, GuzzleHttpWrapper $resource)
    {
        if (empty($filePath) || empty($newFileName)) {
            return Response::respond(true, ((object)ErrorMessages::$RENAME_FILE_DATA_INVALID));
        }

        $resource->setDatas(['filePath' => $filePath, 'newFileName' => $newFileName, 'purgeCache' => $purgeCache]);
        $res = $resource->put();
        $stream = $res->getBody();
        $content = [];
        $content['body'] = json_decode($stream->getContents());
        $headers = $res->getHeaders();
        $content['headers'] = $headers;
        $content['statusCode'] = $res->getStatusCode();

        if ($res->getStatusCode() && !(200 >= $res->getStatusCode() || $res->getStatusCode() <= 300)) {
            return Response::respond(true, ($content));
        }

        return Response::respond(false, ($content));
    }

    
    /**
     * Restore File Version API
     *
     * @param GuzzleHttpWrapper $resource
     *
     * @return Response
     */
    public static function restoreVersion(GuzzleHttpWrapper $resource)
    {
        $res = $resource->put();
        $stream = $res->getBody();
        $content = [];
        $content['body'] = json_decode($stream->getContents());
        $headers = $res->getHeaders();
        $content['headers'] = $headers;
        $content['statusCode'] = $res->getStatusCode();

        if ($res->getStatusCode() && !(200 >= $res->getStatusCode() || $res->getStatusCode() <= 300)) {
            return Response::respond(true, ($content));
        }

        return Response::respond(false, ($content));
    }


    /**
     * Bulk Add Tags
     *
     * @param array $fileIds
     * @param array $tags
     * @param GuzzleHttpWrapper $resource
     *
     * @return Response
     */
    public static function bulkAddTags(array $fileIds, array $tags, GuzzleHttpWrapper $resource)
    {

        if (!is_array($fileIds) || empty($fileIds) || !is_array($tags) || empty($tags)) {
            return Response::respond(true, ((object)ErrorMessages::$BULK_TAGS_DATA_MISSING));
        }

        $resource->setDatas(['fileIds' => $fileIds, 'tags' => $tags]);
        $res = $resource->post();
        $stream = $res->getBody();
        $content = [];
        $content['body'] = json_decode($stream->getContents());
        $headers = $res->getHeaders();
        $content['headers'] = $headers;
        $content['statusCode'] = $res->getStatusCode();

        if ($res->getStatusCode() && $res->getStatusCode() !== 200) {
            return Response::respond(true, ($content));
        }

        return Response::respond(false, ($content));
    }

    /**
     * Bulk Remove Tags
     *
     * @param array $fileIds
     * @param array $tags
     * @param GuzzleHttpWrapper $resource
     *
     * @return Response
     */
    public static function bulkRemoveTags(array $fileIds, array $tags, GuzzleHttpWrapper $resource)
    {


        if (!is_array($fileIds) || empty($fileIds) || !is_array($tags) || empty($tags)) {
            return Response::respond(true, ((object)ErrorMessages::$BULK_TAGS_DATA_MISSING));
        }

        $resource->setDatas(['fileIds' => $fileIds, 'tags' => $tags]);
        $res = $resource->post();
        $stream = $res->getBody();
        $content = [];
        $content['body'] = json_decode($stream->getContents());
        $headers = $res->getHeaders();
        $content['headers'] = $headers;
        $content['statusCode'] = $res->getStatusCode();

        if ($res->getStatusCode() && $res->getStatusCode() !== 200) {
            return Response::respond(true, ($content));
        }

        return Response::respond(false, ($content));
    }


    /**
     * Bulk Remove AI Tags
     *
     * @param array $fileIds
     * @param array $AITags
     * @param GuzzleHttpWrapper $resource
     *
     * @return Response
     */
    public static function bulkRemoveAITags(array $fileIds, array $AITags, GuzzleHttpWrapper $resource)
    {
        if (!is_array($fileIds) || empty($fileIds) || !is_array($AITags) || empty($AITags)) {
            return Response::respond(true, ((object)ErrorMessages::$BULK_TAGS_DATA_MISSING));
        }

        $resource->setDatas(['fileIds' => $fileIds, 'AITags' => $AITags]);
        $res = $resource->post();
        $stream = $res->getBody();
        $content = [];
        $content['body'] = json_decode($stream->getContents());
        $headers = $res->getHeaders();
        $content['headers'] = $headers;
        $content['statusCode'] = $res->getStatusCode();

        if ($res->getStatusCode() && $res->getStatusCode() !== 200) {
            return Response::respond(true, ($content));
        }

        return Response::respond(false, ($content));
    }


    /**
     * Update File Details
     *
     * @param $fileId
     * @param $updateData
     * @param GuzzleHttpWrapper $resource
     *
     * @return Response
     */
    public static function updateDetails($fileId, $updateData, GuzzleHttpWrapper $resource)
    {
        if (empty($fileId)) {
            return Response::respond(true, ((object)ErrorMessages::$fileId_MISSING));
        }

        if (!is_array($updateData)) {
            return Response::respond(true, ((object)ErrorMessages::$UPDATE_DATA_MISSING));
        }

        $obj = (object)$updateData;

        
        if (isset($obj->tags) && ($obj->tags !== null) && ($obj->tags !== 'undefined') && !is_array($obj->tags)) {
            return Response::respond(true, ((object)ErrorMessages::$UPDATE_DATA_TAGS_INVALID));
        }

        if (isset($obj->customCoordinates) && ($obj->customCoordinates !== 'undefined') && is_array($obj->customCoordinates)) {
            return Response::respond(true, ((object)ErrorMessages::$UPDATE_DATA_COORDS_INVALID));
        }

        $resource->setDatas($updateData);
        $res = $resource->patch();
        $stream = $res->getBody();
        $content = [];
        $content['body'] = json_decode($stream->getContents());
        $headers = $res->getHeaders();
        $content['headers'] = $headers;
        $content['statusCode'] = $res->getStatusCode();

        if ($res->getStatusCode() && $res->getStatusCode() !== 200) {
            return Response::respond(true, ($content));
        }

        return Response::respond(false, ($content));
    }
}
