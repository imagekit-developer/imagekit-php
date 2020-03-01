<?php

namespace ImageKit\File;

use ImageKit\Resource\GuzzleHttpWrapper;

include_once __DIR__ . "/../Constants/errorMessages.php";
include_once __DIR__ . "/../Utils/respond.php";

class File
{

    // List File API
    public function listFiles($parameters, $resource)
    {
        if (!is_array($parameters)) {
            return respond(true, ((object) unserialize(INVALID_LIST_FILES_OPTIONS)));
        }

        if (isset($parameters['tags']) && is_array($parameters['tags'])) {
            $parameters['tags'] = implode(",", $parameters['tags']);
        }

        if (isset($parameters['includeFolder']) && is_bool($parameters['includeFolder'])) {
            $parameters['includeFolder'] = json_encode($parameters['includeFolder']);
        }

        $resource->setDatas((array) $parameters);
        $res = $resource->get();
        $stream = $res->getBody();
        $content = $stream->getContents();

        if ($res->getStatusCode() && $res->getStatusCode() !== 200) {
            return respond(true, json_decode($content));
        };

        return respond(false, json_decode($content));
    }

    // Get Details Of file
    public function getDetails($the_file_id, $resource)
    {
        return $this->getFileDetails($the_file_id, $resource);
    }


    // Get Details Of file
    public function getFileDetails($the_file_id, $resource)
    {
        if (empty($the_file_id)) {
            return respond(true, ((object) unserialize(FILE_ID_MISSING)));
        }

        $res = $resource->get();
        $stream = $res->getBody();
        $content = $stream->getContents();

        if ($res->getStatusCode() && $res->getStatusCode() !== 200) {
            return respond(true, json_decode($content));
        };

        return respond(false, json_decode($content));
    }

    // Get Details Of file
    public function getMetaData($the_file_id, $resource)
    {
        return $this->getFileMetaData($the_file_id, $resource);
    }

    public function getFileMetaData($the_file_id, $resource)
    {
        if (empty($the_file_id)) {
            return respond(true, ((object) unserialize(FILE_ID_MISSING)));
        }

        $res = $resource->get();
        $stream = $res->getBody();
        $content = $stream->getContents();

        if ($res->getStatusCode() && $res->getStatusCode() !== 200) {
            return respond(true, json_decode($content));
        };

        return respond(false, json_decode($content));
    }

    // Delete File API
    public function deleteFile($the_file_id, $resource)
    {
        if (empty($the_file_id)) {
            return respond(true, ((object) unserialize(FILE_ID_MISSING)));
        }

        $resource->setDatas((array) $the_file_id);
        $res = $resource->delete();
        $stream = $res->getBody();
        $content = $stream->getContents();

        if ($res->getStatusCode() && $res->getStatusCode() !== 200) {
            return respond(true, json_decode($content));
        };

        return respond(false, json_decode($content));
    }

    // Delete Bulk Files by File ID API
    public function bulkDeleteByFileIds($options, $resource)
    {
        if (empty($options)) {
            return respond(true, ((object) unserialize(FILE_IDS_MISSING)));
        }

        $resource->setDatas($options);
        $res = $resource->rawPost();
        $stream = $res->getBody();
        $content = $stream->getContents();

        if ($res->getStatusCode() && !(200 >= $res->getStatusCode() || $res->getStatusCode() <= 300)) {
            return respond(true, json_decode($content));
        }

        return respond(false, json_decode($content));
    }

    // Update File Details
    public function updateDetails($the_file_id, $updateData, $resource)
    {
        return $this->updateFileDetails($the_file_id, $updateData, $resource);
    }

    // Update File Details
    public function updateFileDetails($the_file_id, $updateData, $resource)
    {
        if (empty($the_file_id)) {
            return respond(true, ((object) unserialize(FILE_ID_MISSING)));
        }

        if (!is_array($updateData)) {
            return respond(true, ((object) unserialize(UPDATE_DATA_MISSING)));
        }

        $obj = (object) $updateData;

        if (isset($obj->tags) && ($obj->tags !== null) && ($obj->tags !== "undefined") && !is_array($obj->tags)) {
            return respond(true, ((object) unserialize(UPDATE_DATA_TAGS_INVALID)));
        }

        if (isset($obj->customCoordinates) && ($obj->customCoordinates !== null) && ($obj->customCoordinates !== "undefined") && is_array($obj->customCoordinates)) {
            return respond(true, ((object) unserialize(UPDATE_DATA_COORDS_INVALID)));
        }

        $resource->setDatas($updateData);
        $res = $resource->patch();
        $stream = $res->getBody();
        $content = $stream->getContents();

        if ($res->getStatusCode() && $res->getStatusCode() !== 200) {
            return respond(true, json_decode($content));
        };

        return respond(false, json_decode($content));
    }


    // purgeCache File API
    public function purgeCacheApi($urlParam, $resource)
    {
        return $this->purgeFileCacheApi($urlParam, $resource);
    }

    // purgeCache File API
    public function purgeFileCacheApi($urlParam, $resource)
    {
        if (empty($urlParam)) {
            return respond(true, ((object) unserialize(CACHE_PURGE_URL_MISSING)));
        }

        $urlParamArray =  array(
            "url" => $urlParam
        );

        $resource->setDatas((array) $urlParamArray);
        $res = $resource->post();
        $stream = $res->getBody();
        $content = $stream->getContents();

        if ($res->getStatusCode() && !(200 >= $res->getStatusCode() || $res->getStatusCode() <= 300)) {
            return respond(true, json_decode($content));
        };

        return respond(false, json_decode($content));
    }

    // purgeCache File API
    public function purgeCacheApiStatus($requestId, GuzzleHttpWrapper $resource)
    {
        return $this->purgeFileCacheApiStatus($requestId,  $resource);
    }

    // purgeCache File API
    public function purgeFileCacheApiStatus($requestId, GuzzleHttpWrapper $resource)
    {
        if (empty($requestId)) {
            return respond(true, ((object) unserialize(CACHE_PURGE_STATUS_ID_MISSING)));
        }

        $res = $resource->get();

        $stream = $res->getBody();
        $content = $stream->getContents();

        if ($res->getStatusCode() && $res->getStatusCode() !== 200) {
            return respond(true, json_decode($content));
        };

        return respond(false, json_decode($content));
    }

    // Get file metadata from remote URL
    public function getFileMetadataFromRemoteURL($url, $resource)
    {
        if (empty($url)) {
            return respond(true, ((object) unserialize(MISSING_URL_PARAMETER)));
        }

        $resource->setDatas(array(
            "url" => $url
        ));
        $res = $resource->get();
        $stream = $res->getBody();
        $content = $stream->getContents();

        if ($res->getStatusCode() && $res->getStatusCode() !== 200) {
            return respond(true, json_decode($content));
        };

        return respond(false, json_decode($content));
    }
}
