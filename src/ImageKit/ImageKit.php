<?php

namespace ImageKit;

use ImageKit\File\File;
use ImageKit\Phash\Phash;
use ImageKit\Upload\Upload;
use ImageKit\Url\Url;
use ImageKit\Signature\Signature;
use ImageKit\Resource\GuzzleHttpWrapper;
use GuzzleHttp\Client;
use InvalidArgumentException;

include_once __DIR__ . "/Constants/endpoint.php";
include_once __DIR__ . '/Utils/transformation.php';
include_once __DIR__ . '/Utils/authorization.php';

/**
 * Class Imagekit
 *
 * The main class for the SDK consumption
 *
 * @package Imagekit
 */

class ImageKit
{
    /**
     * @var string the public key
     */
    private $_publicKey = null;
    /**
     * @var string the private key
     */
    private $_privateKey = null;
    /**
     * @var string the URL endpoint
     */
    private $_urlEndpoint = null;
    /**
     * @var string transformation position. Default will be 'path'.
     */
    private $_transformationPosition = null;

    /**
     * @param string|null $publicKey The Public Key as obtained from the imagekit developer dashboard
     *
     * @param string|null $privateKey The Private Key as obtained from the imagekit developer dashboard
     *
     * @param string|null $urlEndpoint The URL Endpoint as obtained from the imagekit developer dashboard
     *
     * @param string|null $transformationPosition Default value is path that places the transformation string as a path parameter in the URL. Can also be specified as query which adds the transformation string as the query parameter tr in the URL. If you use src parameter to create the URL, then the transformation string is always added as a query parameter.
     *
     */

    public function __construct(
        $publicKey = null,
        $privateKey = null,
        $urlEndpoint = null,
        $transformationPosition = null
    ) {

        if ($publicKey == null) {
            $msg = 'Missing publicKey during ImageKit initialization';
            throw new InvalidArgumentException($msg);
        }
        $this->_publicKey = $publicKey;

        if ($privateKey == null) {
            $msg = 'Missing privateKey during ImageKit initialization';
            throw new InvalidArgumentException($msg);
        }
        $this->_privateKey = $privateKey;

        if ($urlEndpoint == null) {
            $msg = 'Missing urlEndpoint during ImageKit initialization';
            throw new InvalidArgumentException($msg);
        }
        $this->_urlEndpoint = $this->removeTrailingSlash($urlEndpoint);

        if ($transformationPosition === null) {
            $transformationPosition = getDefault();
        } else if ($transformationPosition !== 'path' && $transformationPosition !== 'query') {
            $msg = 'Invalid transformationPosition during ImageKit initialization. Can be one of path or query';
            throw new InvalidArgumentException($msg);
        }
        $this->_transformationPosition = $transformationPosition;
    }

    public function getDefaultOption()
    {
        return array(
            'publicKey' => $this->_publicKey,
            'privateKey' => $this->_privateKey,
            'urlEndpoint' => $this->_urlEndpoint,
            'transformationPosition' => $this->_transformationPosition,
        );
    }

    public function url($options)
    {
        $defaultOptions = $this->getDefaultOption();

        $urlInstance = new Url();
        return $urlInstance->buildURL(array_merge($defaultOptions, $options));
    }

    public function upload($options)
    {
        return $this->uploadFiles($options);
    }

    public function uploadFiles($options)
    {
        $defaultOptions = $this->getDefaultOption();

        $client = new Client(addAuthorization([], $defaultOptions));

        $resource = new GuzzleHttpWrapper($client);
        $resource->setUri(getUploadFileEndpoint());

        $uploadInstance = new Upload();
        return $uploadInstance->uploadFileRequest($options, $resource);
    }


    public function listFiles(array $parameters)
    {
        $defaultOptions = $this->getDefaultOption();

        $client = new Client(addAuthorization([], $defaultOptions));

        $resource = new GuzzleHttpWrapper($client);
        $resource->setUri(getListFilesEndpoint());

        $listFilesInstance = new File();
        return $listFilesInstance->listFiles($parameters, $resource);
    }

    public function getDetails($the_file_id)
    {
        return $this->getFileDetails($the_file_id);
    }

    public function getFileDetails($the_file_id)
    {
        $defaultOptions = $this->getDefaultOption();

        $client = new Client(addAuthorization([], $defaultOptions));

        $resource = new GuzzleHttpWrapper($client);
        $resource->setUri(getDetailsEndpoint($the_file_id));

        $getDetailsInstance = new File();
        return $getDetailsInstance->getFileDetails($the_file_id, $resource);
    }


    public function getMetaData($the_file_id)
    {
        return  $this->getFileMetaData($the_file_id);
    }

    public function getFileMetaData($the_file_id)
    {
        $defaultOptions = $this->getDefaultOption();

        $client = new Client(addAuthorization([], $defaultOptions));

        $resource = new GuzzleHttpWrapper($client);
        $resource->setUri(getListMetaDataFilesEndpoint($the_file_id));

        $getFileMetadataInstance = new File();
        return $getFileMetadataInstance->getFileMetaData($the_file_id, $resource);
    }

    public function updateDetails($the_file_id, $updateData)
    {

        return $this->updateFileDetails($the_file_id, $updateData);
    }

    public function updateFileDetails($the_file_id, $updateData)
    {
        $defaultOptions = $this->getDefaultOption();
        $client = new Client(addAuthorization([], $defaultOptions));

        $resource = new GuzzleHttpWrapper($client);
        $resource->setUri(getUpdateFileDetailsEndpoint($the_file_id));

        $updateDetailsInstance = new File();
        return $updateDetailsInstance->updateFileDetails($the_file_id, $updateData, $resource);
    }



    public function deleteFile($the_file_id)
    {
        $defaultOptions = $this->getDefaultOption();

        $client = new Client(addAuthorization([], $defaultOptions));

        $resource = new GuzzleHttpWrapper($client);
        $resource->setUri(getDeleteFilesEndpoint($the_file_id));

        $deleteFileInstance = new File();
        return $deleteFileInstance->deleteFile($the_file_id, $resource);
    }

    public function bulkFileDeleteByIds($options)
    {
        $defaultOptions = $this->getDefaultOption();

        $client = new Client(addAuthorization([], $defaultOptions));

        $resource = new GuzzleHttpWrapper($client);
        $resource->setUri(getDeleteByFileIdsEndpoint());

        $deleteFileInstance = new File();
        return $deleteFileInstance->bulkDeleteByFileIds($options, $resource);
    }

    public function purgeCacheApi($options)
    {
        return $this->purgeFileCacheApi($options);
    }

    public function purgeFileCacheApi($options)
    {
        $defaultOptions = $this->getDefaultOption();

        $client = new Client(addAuthorization([], $defaultOptions));

        $resource = new GuzzleHttpWrapper($client);
        $resource->setUri(getPurgeCacheEndpoint());

        $purgeCacheApiInstance = new File();
        return $purgeCacheApiInstance->purgeFileCacheApi($options, $resource);
    }

    public function purgeCacheApiStatus($requestId)
    {
        return  $this->purgeFileCacheApiStatus($requestId);
    }

    public function purgeFileCacheApiStatus($requestId)
    {
        $defaultOptions = $this->getDefaultOption();

        $client = new Client(addAuthorization([], $defaultOptions));

        $resource = new GuzzleHttpWrapper($client);
        $resource->setUri(getPurgeCacheApiStatusEndpoint($requestId));

        $purgeCacheApiStatusInstance = new File();
        return $purgeCacheApiStatusInstance->purgeFileCacheApiStatus($requestId, $resource);
    }

    public function getAuthenticationParameters($token = "", $expire = 0)
    {
        $defaultOptions = $this->getDefaultOption();

        $getAuthenticationParametersInstance = new Signature();
        return $getAuthenticationParametersInstance->getAuthenticationParameters($token, $expire, $defaultOptions);
    }

    public function pHashDistance($firstPHash, $secondPHash)
    {
        $pHashInstance = new Phash();
        return $pHashInstance->pHashDistance($firstPHash, $secondPHash);
    }

    public function getFileMetadataFromRemoteURL($url)
    {
        $defaultOptions = $this->getDefaultOption();

        $client = new Client(addAuthorization([], $defaultOptions));

        $resource = new GuzzleHttpWrapper($client);
        $resource->setUri(getFileMetadataFromRemoteURLEndpoint());

        $fileInstance = new File();
        return $fileInstance->getFileMetadataFromRemoteURL($url, $resource);
    }

    private function removeTrailingSlash($str)
    {
        if (is_string($str) and strlen($str) > 0  and substr($str, -1) == "/") {
            $str = substr($str, 0, -1);
        }
        return $str;
    }
}
