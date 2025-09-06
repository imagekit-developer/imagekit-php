<?php

declare(strict_types=1);

namespace ImageKit\Services\Accounts;

use ImageKit\Accounts\Origins\OriginCreateParams;
use ImageKit\Accounts\Origins\OriginResponse;
use ImageKit\Accounts\Origins\OriginResponse\AkeneoPim;
use ImageKit\Accounts\Origins\OriginResponse\AzureBlob;
use ImageKit\Accounts\Origins\OriginResponse\CloudinaryBackup;
use ImageKit\Accounts\Origins\OriginResponse\Gcs;
use ImageKit\Accounts\Origins\OriginResponse\S3;
use ImageKit\Accounts\Origins\OriginResponse\S3Compatible;
use ImageKit\Accounts\Origins\OriginResponse\WebFolder;
use ImageKit\Accounts\Origins\OriginResponse\WebProxy;
use ImageKit\Accounts\Origins\OriginUpdateParams;
use ImageKit\Client;
use ImageKit\Core\Conversion\ListOf;
use ImageKit\RequestOptions;
use ImageKit\ServiceContracts\Accounts\OriginsContract;

use const ImageKit\Core\OMIT as omit;

final class OriginsService implements OriginsContract
{
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * **Note:** This API is currently in beta.
     * Creates a new origin and returns the origin object.
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
    ): S3|S3Compatible|CloudinaryBackup|WebFolder|WebProxy|Gcs|AzureBlob|AkeneoPim {
        [$parsed, $options] = OriginCreateParams::parseRequest(
            [
                'accessKey' => $accessKey,
                'bucket' => $bucket,
                'name' => $name,
                'secretKey' => $secretKey,
                'type' => $type,
                'baseURLForCanonicalHeader' => $baseURLForCanonicalHeader,
                'includeCanonicalHeader' => $includeCanonicalHeader,
                'prefix' => $prefix,
                'endpoint' => $endpoint,
                's3ForcePathStyle' => $s3ForcePathStyle,
                'baseURL' => $baseURL,
                'forwardHostHeaderToOrigin' => $forwardHostHeaderToOrigin,
                'clientEmail' => $clientEmail,
                'privateKey' => $privateKey,
                'accountName' => $accountName,
                'container' => $container,
                'sasToken' => $sasToken,
                'clientID' => $clientID,
                'clientSecret' => $clientSecret,
                'password' => $password,
                'username' => $username,
            ],
            $requestOptions,
        );

        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'post',
            path: 'v1/accounts/origins',
            body: (object) $parsed,
            options: $options,
            convert: OriginResponse::class,
        );
    }

    /**
     * @api
     *
     * **Note:** This API is currently in beta.
     * Updates the origin identified by `id` and returns the updated origin object.
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
    ): S3|S3Compatible|CloudinaryBackup|WebFolder|WebProxy|Gcs|AzureBlob|AkeneoPim {
        [$parsed, $options] = OriginUpdateParams::parseRequest(
            [
                'accessKey' => $accessKey,
                'bucket' => $bucket,
                'name' => $name,
                'secretKey' => $secretKey,
                'type' => $type,
                'baseURLForCanonicalHeader' => $baseURLForCanonicalHeader,
                'includeCanonicalHeader' => $includeCanonicalHeader,
                'prefix' => $prefix,
                'endpoint' => $endpoint,
                's3ForcePathStyle' => $s3ForcePathStyle,
                'baseURL' => $baseURL,
                'forwardHostHeaderToOrigin' => $forwardHostHeaderToOrigin,
                'clientEmail' => $clientEmail,
                'privateKey' => $privateKey,
                'accountName' => $accountName,
                'container' => $container,
                'sasToken' => $sasToken,
                'clientID' => $clientID,
                'clientSecret' => $clientSecret,
                'password' => $password,
                'username' => $username,
            ],
            $requestOptions,
        );

        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'put',
            path: ['v1/accounts/origins/%1$s', $id],
            body: (object) $parsed,
            options: $options,
            convert: OriginResponse::class,
        );
    }

    /**
     * @api
     *
     * **Note:** This API is currently in beta.
     * Returns an array of all configured origins for the current account.
     *
     * @return list<S3|S3Compatible|CloudinaryBackup|WebFolder|WebProxy|Gcs|AzureBlob|AkeneoPim>
     */
    public function list(?RequestOptions $requestOptions = null): array
    {
        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'get',
            path: 'v1/accounts/origins',
            options: $requestOptions,
            convert: new ListOf(OriginResponse::class),
        );
    }

    /**
     * @api
     *
     * **Note:** This API is currently in beta.
     * Permanently removes the origin identified by `id`. If the origin is in use by any URL‑endpoints, the API will return an error.
     */
    public function delete(
        string $id,
        ?RequestOptions $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'delete',
            path: ['v1/accounts/origins/%1$s', $id],
            options: $requestOptions,
            convert: null,
        );
    }

    /**
     * @api
     *
     * **Note:** This API is currently in beta.
     * Retrieves the origin identified by `id`.
     */
    public function get(
        string $id,
        ?RequestOptions $requestOptions = null
    ): S3|S3Compatible|CloudinaryBackup|WebFolder|WebProxy|Gcs|AzureBlob|AkeneoPim {
        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'get',
            path: ['v1/accounts/origins/%1$s', $id],
            options: $requestOptions,
            convert: OriginResponse::class,
        );
    }
}
