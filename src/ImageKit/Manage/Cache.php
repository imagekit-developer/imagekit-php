<?php

namespace ImageKit\Manage;

use ImageKit\Constants\ErrorMessages;
use ImageKit\Resource\GuzzleHttpWrapper;
use ImageKit\Utils\Response;

/**
 *
 */
class Cache
{

    /**
     * purgeCache File API
     *
     * @param $urlParam
     * @param $resource
     * @return Response
     */
    public static function purgeFileCache($urlParam, $resource)
    {

        $urlParamArray = [
            'url' => $urlParam
        ];

        $resource->setDatas($urlParamArray);
        $res = $resource->post();
        $stream = $res->getBody();
        $content = [];
        $content['body'] = json_decode($stream->getContents());
        if($resource->getResponseMetadata()){
            $headers = $res->getHeaders();
            $content['headers'] = $headers;
        }

        if ($res->getStatusCode() && !(200 >= $res->getStatusCode() || $res->getStatusCode() <= 300)) {
            return Response::respond(true, ($content));
        }

        return Response::respond(false, ($content));
    }

    /**
     * purgeCacheStatus File API
     *
     * @param $requestId
     * @param GuzzleHttpWrapper $resource
     * @return Response
     */
    public static function purgeFileCacheStatus($requestId, GuzzleHttpWrapper $resource)
    {
        if (empty($requestId)) {
            return Response::respond(true, ((object)ErrorMessages::$CACHE_PURGE_STATUS_ID_MISSING));
        }

        $res = $resource->get();

        $stream = $res->getBody();
        $content = [];
        $content['body'] = json_decode($stream->getContents());
        if($resource->getResponseMetadata()){
            $headers = $res->getHeaders();
            $content['headers'] = $headers;
        }

        if ($res->getStatusCode() && $res->getStatusCode() !== 200) {
            return Response::respond(true, ($content));
        }

        return Response::respond(false, ($content));
    }

}
