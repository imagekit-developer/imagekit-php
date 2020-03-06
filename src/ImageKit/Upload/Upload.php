<?php

namespace ImageKit\Upload;

include_once __DIR__ . "/../Constants/errorMessages.php";
include_once __DIR__ . "/../Utils/respond.php";

class Upload
{

    public function uploadFileRequest(array $uploadOptions,  $resource)
    {
        $opts = (object) $uploadOptions;
        if (!is_object($opts)) {
            return respond(true, ((object) unserialize(MISSING_UPLOAD_DATA)));
        }

        if (empty($opts->file)) {
            return respond(true, ((object) unserialize(MISSING_UPLOAD_FILE_PARAMETER)));
        }

        if (empty($opts->fileName)) {
            return respond(true, ((object) unserialize(MISSING_UPLOAD_FILENAME_PARAMETER)));
        }

        if (isset($opts->tags) && is_array($opts->tags)) {
            $opts->tags = implode(",", $opts->tags);
        }

        $resource->setDatas((array) $opts);
        $res = $resource->postMultipart();

        $stream = $res->getBody();
        $content = $stream->getContents();

        if ($res->getStatusCode() && $res->getStatusCode() !== 200) {
            return respond(true, json_decode($content));
        };

        return respond(false, json_decode($content));
    }
}
