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

        if (!is_object($opts)) {
            return Response::respond(true, ((object)ErrorMessages::$MISSING_UPLOAD_DATA));
        }

        if (empty($opts->file)) {
            return Response::respond(true, ((object)ErrorMessages::$MISSING_UPLOAD_FILE_PARAMETER));
        }

        if (empty($opts->fileName)) {
            return Response::respond(true, ((object)ErrorMessages::$MISSING_UPLOAD_FILENAME_PARAMETER));
        }

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
        $content = $stream->getContents();

        if ($res->getStatusCode() && $res->getStatusCode() !== 200) {
            return Response::respond(true, json_decode($content));
        }

        return Response::respond(false, json_decode($content));
    }
}
