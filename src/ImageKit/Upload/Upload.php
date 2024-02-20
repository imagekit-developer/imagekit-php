<?php

namespace ImageKit\Upload;

use ImageKit\Constants\ErrorMessages;
use ImageKit\Resource\GuzzleHttpWrapper;
use ImageKit\Utils\Response;

/**
 *
 */
class Upload
{
    /**
     * @param array $uploadOptions
     * @param GuzzleHttpWrapper $resource
     * @return Response
     */
    public static function upload(array $uploadOptions, GuzzleHttpWrapper $resource)
    {
        $opts = (object)$uploadOptions;

        $file = $opts->file;
        $fileName = $opts->fileName;
        
        $payload = [];
        if (isset($opts->options) && is_array($opts->options)) {
            $payload = $opts->options;        
        }
        else{
            $payload = (array)$opts;    
        }
        $payload['file'] = $file;
        $payload['fileName'] = $fileName;
                
        if (isset($payload['tags']) && is_array($payload['tags'])) {
            $payload['tags'] = implode(',', $payload['tags']);
        }

        if (isset($payload['customCoordinates']) && is_array($payload['customCoordinates'])) {
            $payload['customCoordinates'] = implode(',', $payload['customCoordinates']);
        }

        if (isset($payload['responseFields']) && is_array($payload['responseFields'])) {
            $payload['responseFields'] = implode(',', $payload['responseFields']);
        }
        
        if (isset($payload['extensions']) && is_array($payload['extensions'])) {
            $payload['extensions'] = json_encode($payload['extensions']);
        }
        
        if (isset($payload['customMetadata']) && is_array($payload['customMetadata'])) {
            $payload['customMetadata'] = json_encode($payload['customMetadata']);
        }

        if (isset($payload['transformation'])) {
            $payload['transformation'] = json_encode($payload['transformation']);
        }

        $resource->setDatas((array)$payload);
        try {
            $res = $resource->postMultipart();
        } catch (\Throwable $th) {
            return Response::respond(true, $th->getMessage());
        }
        if($res && $res->getBody() && $res->getHeaders() && $res->getStatusCode()){
            $stream = $res->getBody();
            $content = [];
            $content['body'] = json_decode($stream->getContents());
            $headers = $res->getHeaders();
            $content['headers'] = $headers;
            $content['statusCode'] = (int)$res->getStatusCode();
    
            if ($res->getStatusCode() && ($res->getStatusCode() < 200 || $res->getStatusCode() > 300)) {
                return Response::respond(true, ($content));
            }
    
            return Response::respond(false, ($content));
        }
        else{
            $errorObject = (object) ErrorMessages::$INVALID_REQUEST;
            return Response::respond(true, $errorObject->message);
        }

        
    }
}
