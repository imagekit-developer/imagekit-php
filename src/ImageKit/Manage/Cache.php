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
     * purgeCacheStatus File API
     *
     * @param $requestId
     * @param GuzzleHttpWrapper $resource
     * @return Response
     */
    public static function purgeFileCacheStatus($requestId, GuzzleHttpWrapper $resource)
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

}
