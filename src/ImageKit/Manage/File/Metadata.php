<?php

namespace ImageKit\Manage\File;

use ImageKit\Constants\ErrorMessages;
use ImageKit\Utils\Response;

/**
 *
 */
class Metadata
{

    /**
     * @param $fileId
     * @param $resource
     * @return Response
     */
    public static function get($fileId, $resource)
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
     * Get file metadata from remote URL
     *
     * @param $url
     * @param $resource
     * @return Response
     */
    public static function getFileMetadataFromRemoteURL($url, $resource)
    {
        if (empty($url)) {
            return Response::respond(true, ((object)ErrorMessages::$MISSING_URL_PARAMETER));
        }

        $resource->setDatas([
            'url' => $url
        ]);
        $res = $resource->get();
        $stream = $res->getBody();
        $content = $stream->getContents();

        if ($res->getStatusCode() && $res->getStatusCode() !== 200) {
            return Response::respond(true, json_decode($content));
        }

        return Response::respond(false, json_decode($content));
    }
}
