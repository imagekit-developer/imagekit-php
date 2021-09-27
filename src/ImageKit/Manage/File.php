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
        $content = $stream->getContents();

        if ($res->getStatusCode() && $res->getStatusCode() !== 200) {
            return Response::respond(true, json_decode($content));
        }

        return Response::respond(false, json_decode($content));
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
        $content = $stream->getContents();

        if ($res->getStatusCode() && $res->getStatusCode() !== 200) {
            return Response::respond(true, json_decode($content));
        }

        return Response::respond(false, json_decode($content));
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
        $content = $stream->getContents();

        if ($res->getStatusCode() && $res->getStatusCode() !== 200) {
            return Response::respond(true, json_decode($content));
        }

        return Response::respond(false, json_decode($content));
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

        $resource->setDatas(['fileIds' => $fileIds]);
        $res = $resource->post();
        $stream = $res->getBody();
        $content = $stream->getContents();

        if ($res->getStatusCode() && !(200 >= $res->getStatusCode() || $res->getStatusCode() <= 300)) {
            return Response::respond(true, json_decode($content));
        }

        return Response::respond(false, json_decode($content));
    }


    /**
     * Copy File API
     *
     * @param $sourceFilePath
     * @param $destinationPath
     * @param GuzzleHttpWrapper $resource
     *
     * @return Response
     */
    public static function copy($sourceFilePath, $destinationPath, GuzzleHttpWrapper $resource)
    {
        if (empty($sourceFilePath) || empty($destinationPath)) {
            return Response::respond(true, ((object)ErrorMessages::$COPY_FILE_DATA_INVALID));
        }

        $resource->setDatas(['sourceFilePath' => $sourceFilePath, 'destinationPath' => $destinationPath]);
        $res = $resource->post();
        $stream = $res->getBody();
        $content = $stream->getContents();

        if ($res->getStatusCode() && !(200 >= $res->getStatusCode() || $res->getStatusCode() <= 300)) {
            return Response::respond(true, json_decode($content));
        }

        return Response::respond(false, json_decode($content));
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
        if (empty($sourceFilePath) || empty($destinationPath)) {
            return Response::respond(true, ((object)ErrorMessages::$COPY_FILE_DATA_INVALID));
        }

        $resource->setDatas(['sourceFilePath' => $sourceFilePath, 'destinationPath' => $destinationPath]);
        $res = $resource->post();
        $stream = $res->getBody();
        $content = $stream->getContents();

        if ($res->getStatusCode() && !(200 >= $res->getStatusCode() || $res->getStatusCode() <= 300)) {
            return Response::respond(true, json_decode($content));
        }

        return Response::respond(false, json_decode($content));
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
        $content = $stream->getContents();

        if ($res->getStatusCode() && !(200 >= $res->getStatusCode() || $res->getStatusCode() <= 300)) {
            return Response::respond(true, json_decode($content));
        }

        return Response::respond(false, json_decode($content));
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
        $content = $stream->getContents();

        if ($res->getStatusCode() && $res->getStatusCode() !== 200) {
            return Response::respond(true, json_decode($content));
        }

        return Response::respond(false, json_decode($content));
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
        $res = $resource->delete();
        $stream = $res->getBody();
        $content = $stream->getContents();

        if ($res->getStatusCode() && $res->getStatusCode() !== 200) {
            return Response::respond(true, json_decode($content));
        }

        return Response::respond(false, json_decode($content));
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
        $content = $stream->getContents();

        if ($res->getStatusCode() && $res->getStatusCode() !== 200) {
            return Response::respond(true, json_decode($content));
        }

        return Response::respond(false, json_decode($content));
    }
}
