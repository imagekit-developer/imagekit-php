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
    public static function listFile(GuzzleHttpWrapper $resource,$parameters=null)
    {
        if($parameters){
            if (isset($parameters['tags']) && is_array($parameters['tags'])) {
                $parameters['tags'] = implode(',', $parameters['tags']);
            }
            $resource->setDatas($parameters);
        }
        try {
            $res = $resource->get();
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
     * Get Details Of file
     *
     * @param string $fileId
     * @param GuzzleHttpWrapper $resource
     *
     * @return Response
     */
    public static function getDetails($fileId, GuzzleHttpWrapper $resource)
    {
        try {
            $res = $resource->get();
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
        try {
            $res = $resource->get();
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
     * Get All Versions Of file
     *
     * @param string $fileId
     * @param GuzzleHttpWrapper $resource
     *
     * @return Response
     */
    public static function getFileVersions($fileId, GuzzleHttpWrapper $resource)
    {
        try {
            $res = $resource->get();
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
     * Delete File API
     *
     * @param $fileId
     * @param GuzzleHttpWrapper $resource
     *
     * @return Response
     */
    public static function delete($fileId, GuzzleHttpWrapper $resource)
    {
        
        $resource->setDatas((array)$fileId);
        try {
            $res = $resource->delete();
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
        $resource->setDatas([$fileId,$versionId]);
        try {
            $res = $resource->delete();
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
     * Delete Bulk Files by File ID API
     *
     * @param $fileIds
     * @param GuzzleHttpWrapper $resource
     *
     * @return Response
     */
    public static function bulkDeleteByFileIds($fileIds, GuzzleHttpWrapper $resource)
    {
        $resource->setDatas(['fileIds' => $fileIds]);
        
        try {
            $res = $resource->post();
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
     * Copy File API
     *
     * @param $sourceFilePath
     * @param $destinationPath
     * @param $includeVersions
     * @param GuzzleHttpWrapper $resource
     *
     * @return Response
     */
    public static function copy($sourceFilePath, $destinationPath, $includeFileVersions, GuzzleHttpWrapper $resource)
    {
        $resource->setDatas(['sourceFilePath' => $sourceFilePath, 'destinationPath' => $destinationPath, 'includeFileVersions' => $includeFileVersions]);
        try {
            $res = $resource->post();
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
        try {
            $res = $resource->post();
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
        $resource->setDatas(['filePath' => $filePath, 'newFileName' => $newFileName, 'purgeCache' => $purgeCache]);
        try {
            $res = $resource->put();
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
     * Restore File Version API
     *
     * @param GuzzleHttpWrapper $resource
     *
     * @return Response
     */
    public static function restoreVersion(GuzzleHttpWrapper $resource)
    {
        try {
            $res = $resource->put();
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
     * Bulk Add Tags
     *
     * @param array $fileIds
     * @param array $tags
     * @param GuzzleHttpWrapper $resource
     *
     * @return Response
     */
    public static function bulkAddTags($fileIds, $tags, GuzzleHttpWrapper $resource)
    {

        $resource->setDatas(['fileIds' => $fileIds, 'tags' => $tags]);
        try {
            $res = $resource->post();
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
        try {
            $res = $resource->post();
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
        $resource->setDatas(['fileIds' => $fileIds, 'AITags' => $AITags]);
        try {
            $res = $resource->post();
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
        $obj = (object)$updateData;

        if (isset($obj->tags) && ($obj->tags !== null) && ($obj->tags !== 'undefined') && !is_array($obj->tags)) {
            return Response::respond(true, ((object)ErrorMessages::$UPDATE_DATA_TAGS_INVALID));
        }

        if (isset($obj->customCoordinates) && ($obj->customCoordinates !== 'undefined') && is_array($obj->customCoordinates)) {
            return Response::respond(true, ((object)ErrorMessages::$UPDATE_DATA_COORDS_INVALID));
        }

        $resource->setDatas($updateData);
        try {
            $res = $resource->patch();
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
}
