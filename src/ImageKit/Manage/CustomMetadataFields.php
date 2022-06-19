<?php

namespace ImageKit\Manage;

use ImageKit\Constants\ErrorMessages;
use ImageKit\Utils\Response;

/**
 *
 */
class CustomMetadataFields
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
                return Response::respond(true, $content);
            }
    
            return Response::respond(false, $content);
        }
        else{
            return Response::respond(true, ((object)ErrorMessages::$INVALID_REQUEST)->message);
        }
    }

     /**
     * Update custom metadata field 
     *
     * @param $label
     * @param $schema
     * @param $resource
     * @return Response
     */
    public static function updateCustomMetadataField($label, $schema, $resource)
    {
        $resource->setDatas([
            'label' => $label,
            'schema' => $schema
        ]);
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

     /**
     * Update custom metadata field 
     *
     * @param $resource
     * @return Response
     */
    public static function deleteCustomMetadataField($resource)
    {
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
}
