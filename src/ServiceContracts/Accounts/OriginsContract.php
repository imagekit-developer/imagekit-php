<?php

declare(strict_types=1);

namespace ImageKit\ServiceContracts\Accounts;

use ImageKit\Accounts\Origins\OriginResponse\AkeneoPim;
use ImageKit\Accounts\Origins\OriginResponse\AzureBlob;
use ImageKit\Accounts\Origins\OriginResponse\CloudinaryBackup;
use ImageKit\Accounts\Origins\OriginResponse\Gcs;
use ImageKit\Accounts\Origins\OriginResponse\S3;
use ImageKit\Accounts\Origins\OriginResponse\S3Compatible;
use ImageKit\Accounts\Origins\OriginResponse\WebFolder;
use ImageKit\Accounts\Origins\OriginResponse\WebProxy;
use ImageKit\Core\Exceptions\APIException;
use ImageKit\RequestOptions;

use const ImageKit\Core\OMIT as omit;

interface OriginsContract
{
    /**
     * @api
     *
     * @param string $accessKey access key for the bucket
     * @param string $bucket
     * @param string $name display name of the origin
     * @param string $secretKey secret key for the bucket
     * @param string $type
     * @param string $baseURLForCanonicalHeader URL used in the Canonical header (if enabled)
     * @param bool $includeCanonicalHeader whether to send a Canonical header
     * @param string $prefix
     * @param string $endpoint custom S3-compatible endpoint
     * @param bool $s3ForcePathStyle Use path-style S3 URLs?
     * @param string $baseURL akeneo instance base URL
     * @param bool $forwardHostHeaderToOrigin Forward the Host header to origin?
     * @param string $clientEmail
     * @param string $privateKey
     * @param string $accountName
     * @param string $container
     * @param string $sasToken
     * @param string $clientID akeneo API client ID
     * @param string $clientSecret akeneo API client secret
     * @param string $password akeneo API password
     * @param string $username akeneo API username
     *
     * @throws APIException
     */
    public function create(
        $accessKey,
        $bucket,
        $name,
        $secretKey,
        $type,
        $baseURLForCanonicalHeader = omit,
        $includeCanonicalHeader = omit,
        $prefix = omit,
        $endpoint,
        $s3ForcePathStyle = omit,
        $baseURL,
        $forwardHostHeaderToOrigin = omit,
        $clientEmail,
        $privateKey,
        $accountName,
        $container,
        $sasToken,
        $clientID,
        $clientSecret,
        $password,
        $username,
        ?RequestOptions $requestOptions = null,
    ): S3|S3Compatible|CloudinaryBackup|WebFolder|WebProxy|Gcs|AzureBlob|AkeneoPim;

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @throws APIException
     */
    public function createRaw(
        array $params,
        ?RequestOptions $requestOptions = null
    ): S3|S3Compatible|CloudinaryBackup|WebFolder|WebProxy|Gcs|AzureBlob|AkeneoPim;

    /**
     * @api
     *
     * @param string $accessKey access key for the bucket
     * @param string $bucket
     * @param string $name display name of the origin
     * @param string $secretKey secret key for the bucket
     * @param string $type
     * @param string $baseURLForCanonicalHeader URL used in the Canonical header (if enabled)
     * @param bool $includeCanonicalHeader whether to send a Canonical header
     * @param string $prefix
     * @param string $endpoint custom S3-compatible endpoint
     * @param bool $s3ForcePathStyle Use path-style S3 URLs?
     * @param string $baseURL akeneo instance base URL
     * @param bool $forwardHostHeaderToOrigin Forward the Host header to origin?
     * @param string $clientEmail
     * @param string $privateKey
     * @param string $accountName
     * @param string $container
     * @param string $sasToken
     * @param string $clientID akeneo API client ID
     * @param string $clientSecret akeneo API client secret
     * @param string $password akeneo API password
     * @param string $username akeneo API username
     *
     * @throws APIException
     */
    public function update(
        string $id,
        $accessKey,
        $bucket,
        $name,
        $secretKey,
        $type,
        $baseURLForCanonicalHeader = omit,
        $includeCanonicalHeader = omit,
        $prefix = omit,
        $endpoint,
        $s3ForcePathStyle = omit,
        $baseURL,
        $forwardHostHeaderToOrigin = omit,
        $clientEmail,
        $privateKey,
        $accountName,
        $container,
        $sasToken,
        $clientID,
        $clientSecret,
        $password,
        $username,
        ?RequestOptions $requestOptions = null,
    ): S3|S3Compatible|CloudinaryBackup|WebFolder|WebProxy|Gcs|AzureBlob|AkeneoPim;

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @throws APIException
     */
    public function updateRaw(
        string $id,
        array $params,
        ?RequestOptions $requestOptions = null
    ): S3|S3Compatible|CloudinaryBackup|WebFolder|WebProxy|Gcs|AzureBlob|AkeneoPim;

    /**
     * @api
     *
     * @return list<S3|S3Compatible|CloudinaryBackup|WebFolder|WebProxy|Gcs|AzureBlob|AkeneoPim>
     *
     * @throws APIException
     */
    public function list(
        ?RequestOptions $requestOptions = null
    ): array;

    /**
     * @api
     *
     * @return list<S3|S3Compatible|CloudinaryBackup|WebFolder|WebProxy|Gcs|AzureBlob|AkeneoPim>
     *
     * @throws APIException
     */
    public function listRaw(
        mixed $params,
        ?RequestOptions $requestOptions = null
    ): array;

    /**
     * @api
     *
     * @throws APIException
     */
    public function delete(
        string $id,
        ?RequestOptions $requestOptions = null
    ): mixed;

    /**
     * @api
     *
     * @throws APIException
     */
    public function deleteRaw(
        string $id,
        mixed $params,
        ?RequestOptions $requestOptions = null
    ): mixed;

    /**
     * @api
     *
     * @throws APIException
     */
    public function get(
        string $id,
        ?RequestOptions $requestOptions = null
    ): S3|S3Compatible|CloudinaryBackup|WebFolder|WebProxy|Gcs|AzureBlob|AkeneoPim;

    /**
     * @api
     *
     * @throws APIException
     */
    public function getRaw(
        string $id,
        mixed $params,
        ?RequestOptions $requestOptions = null
    ): S3|S3Compatible|CloudinaryBackup|WebFolder|WebProxy|Gcs|AzureBlob|AkeneoPim;
}
