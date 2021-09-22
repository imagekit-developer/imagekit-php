<?php

namespace ImageKit\Manage;

use ImageKit\Constants\ErrorMessages;
use ImageKit\Manage\File\Metadata;
use ImageKit\Resource\GuzzleHttpWrapper;
use ImageKit\Utils\Response;

/**
 *
 * @internal
 */
class File
{

    /** @var Metadata */
    private $metadata;
    /** @var Cache */
    private $cache;

    /**
     * @param $parameters
     * @param $resource
     * @return object
     */
    public function __construct()
    {
        $this->metadata = new Metadata();
        $this->cache = new Cache();
    }

    /**
     * List File API
     *
     * @param array $parameters
     * @param GuzzleHttpWrapper $resource
     * @return object
     */
    public static function listFiles(array $parameters, GuzzleHttpWrapper $resource)
    {
        if (isset($parameters['tags']) && is_array($parameters['tags'])) {
            $parameters['tags'] = implode(',', $parameters['tags']);
        }

        if (isset($parameters['includeFolder']) && is_bool($parameters['includeFolder'])) {
            $parameters['includeFolder'] = json_encode($parameters['includeFolder']);
        }

        $resource->setDatas((array)$parameters);
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
     * @return object
     */
    public static function getFileDetails($fileId, GuzzleHttpWrapper $resource)
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
     * @param $resource
     * @return object
     */
    public static function deleteFile($fileId, $resource)
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
     * @param $options
     * @param $resource
     * @return object
     */
    public static function bulkDeleteByFileIds($options, $resource)
    {
        if (empty($options)) {
            return Response::respond(true, ((object)ErrorMessages::$fileIdS_MISSING));
        }

        $resource->setDatas($options);
        $res = $resource->rawPost();
        $stream = $res->getBody();
        $content = $stream->getContents();

        if ($res->getStatusCode() && !(200 >= $res->getStatusCode() || $res->getStatusCode() <= 300)) {
            return Response::respond(true, json_decode($content));
        }

        return Response::respond(false, json_decode($content));
    }

    /**
     * Update File Details
     *
     * @param $fileId
     * @param $updateData
     * @param $resource
     * @return object
     */
    public function updateDetails($fileId, $updateData, $resource)
    {
        return $this->updateFileDetails($fileId, $updateData, $resource);
    }

    /**
     * Update File Details
     *
     * @param $fileId
     * @param $updateData
     * @param $resource
     * @return object
     */
    public static function updateFileDetails($fileId, $updateData, $resource)
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
