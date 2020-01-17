<?php

define("BASE_ENDPOINT", "https://api.imagekit.io/v1");


function getListFilesEndpoint()
{
    return (BASE_ENDPOINT.'/files');
}

function getDetailsEndpoint($the_file_id)
{
    return (BASE_ENDPOINT."/files/".$the_file_id."/details");
}

function getListMetaDataFilesEndpoint($the_file_id)
{
    return (BASE_ENDPOINT."/files/".$the_file_id."/metadata");
}

function getUpdateFileDetailsEndpoint($the_file_id)
{
    return (BASE_ENDPOINT."/files/".$the_file_id."/details");
}

function getDeleteFilesEndpoint($the_file_id)
{
    return (BASE_ENDPOINT."/files/".$the_file_id);
}

function getPurgeCacheEndpoint()
{
    return (BASE_ENDPOINT."/files/purge");
}

function getPurgeCacheApiStatusEndpoint($requestId)
{
    return (BASE_ENDPOINT."/files/purge/".$requestId);
}

function getUploadFileEndpoint()
{
    return (BASE_ENDPOINT."/files/upload");
}

