<?php

namespace ImageKit\Constants;


/**
 *
 */
class Endpoints
{
    const API_BASE_ENDPOINT = 'https://api.imagekit.io/v1';
    const UPLOAD_BASE_ENDPOINT = 'https://upload.imagekit.io/api/v1';

    /**
     * @return string
     */
    public static function getListFilesEndpoint()
    {
        return (self::API_BASE_ENDPOINT . '/files');
    }

    /**
     * @param $fileId
     * @return string
     */
    public static function getDetailsEndpoint($fileId)
    {
        return (self::API_BASE_ENDPOINT . '/files/' . $fileId . '/details');
    }

    /**
     * @param $fileId
     * @param $versionId
     * @return string
     */
    public static function getVersionDetailsEndpoint($fileId,$versionId)
    {
        return (self::API_BASE_ENDPOINT . '/files/' . $fileId . '/versions/' . $versionId);
    }

    /**
     * @param $fileId
     * @return string
     */
    public static function getFileVersionsEndpoint($fileId)
    {
        return (self::API_BASE_ENDPOINT . '/files/' . $fileId . '/versions');
    }

    /**
     * @param $fileId
     * @return string
     */
    public static function getListMetaDataFilesEndpoint($fileId)
    {
        return (self::API_BASE_ENDPOINT . '/files/' . $fileId . '/metadata');
    }

    /**
     * @param $fileId
     * @return string
     */
    public static function getUpdateFileDetailsEndpoint($fileId)
    {
        return (self::API_BASE_ENDPOINT . '/files/' . $fileId . '/details');
    }

    /**
     * @param $fileId
     * @return string
     */
    public static function getDeleteFilesEndpoint($fileId)
    {
        return (self::API_BASE_ENDPOINT . '/files/' . $fileId);
    }

    /**
     * @param $fileId
     * @param $versionId
     * @return string
     */
    public static function getDeleteFileVersionEndpoint($fileId,$versionId)
    {
        return (self::API_BASE_ENDPOINT . '/files/' . $fileId . '/versions/' . $versionId);
    }

    /**
     * @return string
     */
    public static function getDeleteByFileIdsEndpoint()
    {
        return (self::API_BASE_ENDPOINT . '/files/batch/deleteByFileIds');
    }

    /**
     * @return string
     */
    public static function getPurgeCacheEndpoint()
    {
        return (self::API_BASE_ENDPOINT . '/files/purge');
    }

    /**
     * @param $requestId
     * @return string
     */
    public static function getPurgeCacheApiStatusEndpoint($requestId)
    {
        return (self::API_BASE_ENDPOINT . '/files/purge/' . $requestId);
    }

    /**
     * @return string
     */
    public static function getUploadFileEndpoint()
    {
        return (self::UPLOAD_BASE_ENDPOINT . '/files/upload');
    }

    /**
     * @return string
     */
    public static function getFileMetadataFromRemoteURLEndpoint()
    {
        return (self::API_BASE_ENDPOINT . '/metadata');
    }

    /**
     * @return string
     */
    public static function getBulkAddTagsEndpoint()
    {
        return (self::API_BASE_ENDPOINT . '/files/addTags');
    }

    /**
     * @return string
     */
    public static function getBulkRemoveTagsEndpoint()
    {
        return (self::API_BASE_ENDPOINT . '/files/removeTags');
    }

    /**
     * @return string
     */
    public static function getBulkRemoveAITagsEndpoint()
    {
        return (self::API_BASE_ENDPOINT . '/files/removeAITags');
    }

    /**
     * @return string
     */
    public static function getCopyFileEndpoint()
    {
        return (self::API_BASE_ENDPOINT . '/files/copy');
    }

    /**
     * @return string
     */
    public static function getMoveFileEndpoint()
    {
        return (self::API_BASE_ENDPOINT . '/files/move');
    }

    /**
     * @return string
     */
    public static function getRenameFileEndpoint()
    {
        return (self::API_BASE_ENDPOINT . '/files/rename');
    }

    /**
     * @return string
     * @var $fileId
     * @var $versionId
     * 
     */
    public static function getRestoreFileVersionEndpoint($fileId, $versionId)
    {
        return (self::API_BASE_ENDPOINT . '/files/' . $fileId . '/versions/' . $versionId . '/restore');
    }

    /**
     * @return string
     * @var $jobId
     *
     */
    public static function getBulkJobStatusEndpoint($jobId)
    {
        return (self::API_BASE_ENDPOINT . '/bulkJobs/' . $jobId);
    }

    /**
     * @return string
     */
    public static function getCreateFolderEndpoint()
    {
        return (self::API_BASE_ENDPOINT . '/folder/');
    }

    /**
     * @return string
     */
    public static function getDeleteFolderEndpoint()
    {
        return (self::API_BASE_ENDPOINT . '/folder/');
    }

    /**
     * @return string
     */
    public static function getCopyFolderEndpoint()
    {
        return (self::API_BASE_ENDPOINT . '/bulkJobs/copyFolder');
    }

    /**
     * @return string
     */
    public static function getMoveFolderEndpoint()
    {
        return (self::API_BASE_ENDPOINT . '/bulkJobs/moveFolder');
    }

    /**
     * @return string
     */
    public static function createCustomMetadataField()
    {
        return (self::API_BASE_ENDPOINT . '/customMetadataFields');
    }

    /**
     * @return string
     */
    public static function getCustomMetadataField()
    {
        return (self::API_BASE_ENDPOINT . '/customMetadataFields');
    }

    /**
     * @return string
     */
    public static function updateCustomMetadataField($id)
    {
        return (self::API_BASE_ENDPOINT . '/customMetadataFields/' . $id);
    }

    /**
     * @return string
     */
    public static function deleteCustomMetadataField($id)
    {
        return (self::API_BASE_ENDPOINT . '/customMetadataFields/' . $id);
    }

}


