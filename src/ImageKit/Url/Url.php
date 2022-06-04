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

        // die($fileName);

        $payload = [];
        if (isset($opts->options) && is_array($opts->options)) {
            $payload = $opts->options;        
        }
        $payload['file'] = $file;
        $payload['fileName'] = $fileName;

        // die(json_encode($payload));
        // if (isset($opts->tags) && is_array($opts->tags)) {
        //     $opts->tags = implode(',', $opts->tags);
        // }

        $resource->setDatas((array)$payload);
        $res = $resource->postMultipart();

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
}
