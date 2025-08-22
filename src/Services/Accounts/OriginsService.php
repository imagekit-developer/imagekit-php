<?php

declare(strict_types=1);

namespace ImageKit\Services\Accounts;

use ImageKit\Accounts\Origins\OriginCreateParams;
use ImageKit\Accounts\Origins\OriginCreateParams\Origin\AkeneoPim;
use ImageKit\Accounts\Origins\OriginCreateParams\Origin\AzureBlobStorage;
use ImageKit\Accounts\Origins\OriginCreateParams\Origin\CloudinaryBackup;
use ImageKit\Accounts\Origins\OriginCreateParams\Origin\GoogleCloudStorageGcs;
use ImageKit\Accounts\Origins\OriginCreateParams\Origin\S3;
use ImageKit\Accounts\Origins\OriginCreateParams\Origin\S3Compatible;
use ImageKit\Accounts\Origins\OriginCreateParams\Origin\WebFolder;
use ImageKit\Accounts\Origins\OriginCreateParams\Origin\WebProxy;
use ImageKit\Accounts\Origins\OriginUpdateParams;
use ImageKit\Client;
use ImageKit\Contracts\Accounts\OriginsContract;
use ImageKit\Core\Conversion;
use ImageKit\Core\Conversion\ListOf;
use ImageKit\Core\Util;
use ImageKit\RequestOptions;
use ImageKit\Responses\Accounts\Origins\OriginGetResponse;
use ImageKit\Responses\Accounts\Origins\OriginGetResponse\AkeneoPim as AkeneoPim4;
use ImageKit\Responses\Accounts\Origins\OriginGetResponse\AzureBlobStorage as AzureBlobStorage4;
use ImageKit\Responses\Accounts\Origins\OriginGetResponse\CloudinaryBackup as CloudinaryBackup4;
use ImageKit\Responses\Accounts\Origins\OriginGetResponse\GoogleCloudStorageGcs as GoogleCloudStorageGcs4;
use ImageKit\Responses\Accounts\Origins\OriginGetResponse\S3 as S34;
use ImageKit\Responses\Accounts\Origins\OriginGetResponse\S3Compatible as S3Compatible4;
use ImageKit\Responses\Accounts\Origins\OriginGetResponse\WebFolder as WebFolder4;
use ImageKit\Responses\Accounts\Origins\OriginGetResponse\WebProxy as WebProxy4;
use ImageKit\Responses\Accounts\Origins\OriginListResponseItem;
use ImageKit\Responses\Accounts\Origins\OriginListResponseItem\AkeneoPim as AkeneoPim1;
use ImageKit\Responses\Accounts\Origins\OriginListResponseItem\AzureBlobStorage as AzureBlobStorage1;
use ImageKit\Responses\Accounts\Origins\OriginListResponseItem\CloudinaryBackup as CloudinaryBackup1;
use ImageKit\Responses\Accounts\Origins\OriginListResponseItem\GoogleCloudStorageGcs as GoogleCloudStorageGcs1;
use ImageKit\Responses\Accounts\Origins\OriginListResponseItem\S3 as S31;
use ImageKit\Responses\Accounts\Origins\OriginListResponseItem\S3Compatible as S3Compatible1;
use ImageKit\Responses\Accounts\Origins\OriginListResponseItem\WebFolder as WebFolder1;
use ImageKit\Responses\Accounts\Origins\OriginListResponseItem\WebProxy as WebProxy1;
use ImageKit\Responses\Accounts\Origins\OriginNewResponse;
use ImageKit\Responses\Accounts\Origins\OriginNewResponse\AkeneoPim as AkeneoPim2;
use ImageKit\Responses\Accounts\Origins\OriginNewResponse\AzureBlobStorage as AzureBlobStorage2;
use ImageKit\Responses\Accounts\Origins\OriginNewResponse\CloudinaryBackup as CloudinaryBackup2;
use ImageKit\Responses\Accounts\Origins\OriginNewResponse\GoogleCloudStorageGcs as GoogleCloudStorageGcs2;
use ImageKit\Responses\Accounts\Origins\OriginNewResponse\S3 as S32;
use ImageKit\Responses\Accounts\Origins\OriginNewResponse\S3Compatible as S3Compatible2;
use ImageKit\Responses\Accounts\Origins\OriginNewResponse\WebFolder as WebFolder2;
use ImageKit\Responses\Accounts\Origins\OriginNewResponse\WebProxy as WebProxy2;
use ImageKit\Responses\Accounts\Origins\OriginUpdateResponse;
use ImageKit\Responses\Accounts\Origins\OriginUpdateResponse\AkeneoPim as AkeneoPim3;
use ImageKit\Responses\Accounts\Origins\OriginUpdateResponse\AzureBlobStorage as AzureBlobStorage3;
use ImageKit\Responses\Accounts\Origins\OriginUpdateResponse\CloudinaryBackup as CloudinaryBackup3;
use ImageKit\Responses\Accounts\Origins\OriginUpdateResponse\GoogleCloudStorageGcs as GoogleCloudStorageGcs3;
use ImageKit\Responses\Accounts\Origins\OriginUpdateResponse\S3 as S33;
use ImageKit\Responses\Accounts\Origins\OriginUpdateResponse\S3Compatible as S3Compatible3;
use ImageKit\Responses\Accounts\Origins\OriginUpdateResponse\WebFolder as WebFolder3;
use ImageKit\Responses\Accounts\Origins\OriginUpdateResponse\WebProxy as WebProxy3;

final class OriginsService implements OriginsContract
{
    public function __construct(private Client $client) {}

    /**
     * **Note:** This API is currently in beta.
     * Creates a new origin and returns the origin object.
     *
     * @param S3|S3Compatible|CloudinaryBackup|WebFolder|WebProxy|GoogleCloudStorageGcs|AzureBlobStorage|AkeneoPim $origin schema for origin resources
     */
    public function create(
        $origin,
        ?RequestOptions $requestOptions = null
    ): S32|S3Compatible2|CloudinaryBackup2|WebFolder2|WebProxy2|GoogleCloudStorageGcs2|AzureBlobStorage2|AkeneoPim2 {
        $args = ['origin' => $origin];
        [$parsed, $options] = OriginCreateParams::parseRequest(
            $args,
            $requestOptions
        );
        $resp = $this->client->request(
            method: 'post',
            path: 'v1/accounts/origins',
            body: (object) $parsed['origin'],
            options: $options,
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(OriginNewResponse::class, value: $resp);
    }

    /**
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
        $baseURLForCanonicalHeader = null,
        $includeCanonicalHeader = null,
        $prefix = null,
        $endpoint,
        $s3ForcePathStyle = null,
        $baseURL,
        $forwardHostHeaderToOrigin = null,
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
    ): S33|S3Compatible3|CloudinaryBackup3|WebFolder3|WebProxy3|GoogleCloudStorageGcs3|AzureBlobStorage3|AkeneoPim3 {
        $args = [
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
        ];
        $args = Util::array_filter_null(
            $args,
            [
                'baseURLForCanonicalHeader',
                'includeCanonicalHeader',
                'prefix',
                's3ForcePathStyle',
                'forwardHostHeaderToOrigin',
            ],
        );
        [$parsed, $options] = OriginUpdateParams::parseRequest(
            $args,
            $requestOptions
        );
        $resp = $this->client->request(
            method: 'put',
            path: ['v1/accounts/origins/%1$s', $id],
            body: (object) $parsed,
            options: $options,
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(OriginUpdateResponse::class, value: $resp);
    }

    /**
     * **Note:** This API is currently in beta.
     * Returns an array of all configured origins for the current account.
     *
     * @return list<S31|S3Compatible1|CloudinaryBackup1|WebFolder1|WebProxy1|GoogleCloudStorageGcs1|AzureBlobStorage1|AkeneoPim1>
     */
    public function list(?RequestOptions $requestOptions = null): array
    {
        $resp = $this->client->request(
            method: 'get',
            path: 'v1/accounts/origins',
            options: $requestOptions
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(
            new ListOf(OriginListResponseItem::class),
            value: $resp
        );
    }

    /**
     * **Note:** This API is currently in beta.
     * Permanently removes the origin identified by `id`. If the origin is in use by any URL‑endpoints, the API will return an error.
     */
    public function delete(
        string $id,
        ?RequestOptions $requestOptions = null
    ): mixed {
        return $this->client->request(
            method: 'delete',
            path: ['v1/accounts/origins/%1$s', $id],
            options: $requestOptions,
        );
    }

    /**
     * **Note:** This API is currently in beta.
     * Retrieves the origin identified by `id`.
     */
    public function get(
        string $id,
        ?RequestOptions $requestOptions = null
    ): S34|S3Compatible4|CloudinaryBackup4|WebFolder4|WebProxy4|GoogleCloudStorageGcs4|AzureBlobStorage4|AkeneoPim4 {
        $resp = $this->client->request(
            method: 'get',
            path: ['v1/accounts/origins/%1$s', $id],
            options: $requestOptions,
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(OriginGetResponse::class, value: $resp);
    }
}
