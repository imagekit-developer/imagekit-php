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

    
    /**
     * Create custom metadata field 
     *
     * @param $name
     * @param $label
     * @param $schema
     * @param $resource
     * @return Response
     */
    public static function createCustomMetadataField($name, $label, $schema, $resource)
    {
        $resource->setDatas([
            'name' => $name,
            'label' => $label,
            'schema' => $schema
        ]);
        $res = $resource->post();
        $stream = $res->getBody();
        $content = [];
        $content['body'] = json_decode($stream->getContents());
        if($resource->getResponseMetadata()){
            $headers = $res->getHeaders();
            $content['headers'] = $headers;
        }

        // return $res->getStatusCode();
        if ($res->getStatusCode() && $res->getStatusCode() !== 201) {
            return Response::respond(true, ($content));
        }

        return Response::respond(false, ($content));
    }

    /**
     * Get custom metadata field 
     *
     * @param $includeDeleted
     * @param $resource 
     * @return Response
     */
    public static function getCustomMetadataField($includeDeleted, $resource)
    {
        $resource->setDatas([
            'includeDeleted' => $includeDeleted
        ]);
       
        $res = $resource->get();
        $stream = $res->getBody();
        $content = [];
        $content['body'] = json_decode($stream->getContents());
        if($resource->getResponseMetadata()){
            $headers = $res->getHeaders();
            $content['headers'] = $headers;
        }

        if ($res->getStatusCode() && $res->getStatusCode() !== 200) {
            return Response::respond(true, $content);
        }

        return Response::respond(false, $content);
    }



}
