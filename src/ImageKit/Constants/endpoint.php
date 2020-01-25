<?php

define("API_BASE_ENDPOINT", "https://api.imagekit.io/v1");
define("UPLOAD_BASE_ENDPOINT", "https://upload.imagekit.io/api/v1");


function getListFilesEndpoint()
{
    return (API_BASE_ENDPOINT.'/files');
}

function getDetailsEndpoint($the_file_id)
{
    return (API_BASE_ENDPOINT."/files/".$the_file_id."/details");
}

function getListMetaDataFilesEndpoint($the_file_id)
{
    return (API_BASE_ENDPOINT."/files/".$the_file_id."/metadata");
}

function getUpdateFileDetailsEndpoint($the_file_id)
{
    return (API_BASE_ENDPOINT."/files/".$the_file_id."/details");
}

function getDeleteFilesEndpoint($the_file_id)
{
    return (API_BASE_ENDPOINT."/files/".$the_file_id);
}

function getDeleteByFileIdsEndpoint()
{
    return (API_BASE_ENDPOINT."/files/batch/deleteByFileIds");
}

function getPurgeCacheEndpoint()
{
    return (API_BASE_ENDPOINT."/files/purge");
}

function getPurgeCacheApiStatusEndpoint($requestId)
{
    return (API_BASE_ENDPOINT."/files/purge/".$requestId);
}

function getUploadFileEndpoint()
{
    return (UPLOAD_BASE_ENDPOINT."/files/upload");
}

function getFileMetadataFromRemoteURLEndpoint()
{
    return (API_BASE_ENDPOINT."/metadata");
}
