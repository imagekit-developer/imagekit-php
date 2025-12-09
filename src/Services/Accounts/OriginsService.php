<?php

declare(strict_types=1);

namespace Imagekit\Services\Accounts;

use Imagekit\Accounts\Origins\OriginCreateParams;
use Imagekit\Accounts\Origins\OriginResponse;
use Imagekit\Accounts\Origins\OriginResponse\AkeneoPim;
use Imagekit\Accounts\Origins\OriginResponse\AzureBlob;
use Imagekit\Accounts\Origins\OriginResponse\CloudinaryBackup;
use Imagekit\Accounts\Origins\OriginResponse\Gcs;
use Imagekit\Accounts\Origins\OriginResponse\S3;
use Imagekit\Accounts\Origins\OriginResponse\S3Compatible;
use Imagekit\Accounts\Origins\OriginResponse\WebFolder;
use Imagekit\Accounts\Origins\OriginResponse\WebProxy;
use Imagekit\Accounts\Origins\OriginUpdateParams;
use Imagekit\Client;
use Imagekit\Core\Contracts\BaseResponse;
use Imagekit\Core\Conversion\ListOf;
use Imagekit\Core\Exceptions\APIException;
use Imagekit\RequestOptions;
use Imagekit\ServiceContracts\Accounts\OriginsContract;

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
     * @param array{
     *   accessKey: string,
     *   bucket: string,
     *   name: string,
     *   secretKey: string,
     *   type?: 'AKENEO_PIM',
     *   baseURLForCanonicalHeader?: string,
     *   includeCanonicalHeader?: bool,
     *   prefix?: string,
     *   endpoint: string,
     *   s3ForcePathStyle?: bool,
     *   baseURL: string,
     *   forwardHostHeaderToOrigin?: bool,
     *   clientEmail: string,
     *   privateKey: string,
     *   accountName: string,
     *   container: string,
     *   sasToken: string,
     *   clientID: string,
     *   clientSecret: string,
     *   password: string,
     *   username: string,
     * }|OriginCreateParams $params
     *
     * @throws APIException
     */
    public function create(
        array|OriginCreateParams $params,
        ?RequestOptions $requestOptions = null
    ): S3|S3Compatible|CloudinaryBackup|WebFolder|WebProxy|Gcs|AzureBlob|AkeneoPim {
        [$parsed, $options] = OriginCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        /** @var BaseResponse<S3|S3Compatible|CloudinaryBackup|WebFolder|WebProxy|Gcs|AzureBlob|AkeneoPim,> */
        $response = $this->client->request(
            method: 'post',
            path: 'v1/accounts/origins',
            body: (object) $parsed,
            options: $options,
            convert: OriginResponse::class,
        );

        return $response->parse();
    }

    /**
     * @api
     *
     * **Note:** This API is currently in beta.
     * Updates the origin identified by `id` and returns the updated origin object.
     *
     * @param array{
     *   accessKey: string,
     *   bucket: string,
     *   name: string,
     *   secretKey: string,
     *   type?: 'AKENEO_PIM',
     *   baseURLForCanonicalHeader?: string,
     *   includeCanonicalHeader?: bool,
     *   prefix?: string,
     *   endpoint: string,
     *   s3ForcePathStyle?: bool,
     *   baseURL: string,
     *   forwardHostHeaderToOrigin?: bool,
     *   clientEmail: string,
     *   privateKey: string,
     *   accountName: string,
     *   container: string,
     *   sasToken: string,
     *   clientID: string,
     *   clientSecret: string,
     *   password: string,
     *   username: string,
     * }|OriginUpdateParams $params
     *
     * @throws APIException
     */
    public function update(
        string $id,
        array|OriginUpdateParams $params,
        ?RequestOptions $requestOptions = null,
    ): S3|S3Compatible|CloudinaryBackup|WebFolder|WebProxy|Gcs|AzureBlob|AkeneoPim {
        [$parsed, $options] = OriginUpdateParams::parseRequest(
            $params,
            $requestOptions,
        );

        /** @var BaseResponse<S3|S3Compatible|CloudinaryBackup|WebFolder|WebProxy|Gcs|AzureBlob|AkeneoPim,> */
        $response = $this->client->request(
            method: 'put',
            path: ['v1/accounts/origins/%1$s', $id],
            body: (object) $parsed,
            options: $options,
            convert: OriginResponse::class,
        );

        return $response->parse();
    }

    /**
     * @api
     *
     * **Note:** This API is currently in beta.
     * Returns an array of all configured origins for the current account.
     *
     * @return list<S3|S3Compatible|CloudinaryBackup|WebFolder|WebProxy|Gcs|AzureBlob|AkeneoPim>
     *
     * @throws APIException
     */
    public function list(?RequestOptions $requestOptions = null): array
    {
        /** @var BaseResponse<list<S3|S3Compatible|CloudinaryBackup|WebFolder|WebProxy|Gcs|AzureBlob|AkeneoPim>,> */
        $response = $this->client->request(
            method: 'get',
            path: 'v1/accounts/origins',
            options: $requestOptions,
            convert: new ListOf(OriginResponse::class),
        );

        return $response->parse();
    }

    /**
     * @api
     *
     * **Note:** This API is currently in beta.
     * Permanently removes the origin identified by `id`. If the origin is in use by any URL‑endpoints, the API will return an error.
     *
     * @throws APIException
     */
    public function delete(
        string $id,
        ?RequestOptions $requestOptions = null
    ): mixed {
        /** @var BaseResponse<mixed> */
        $response = $this->client->request(
            method: 'delete',
            path: ['v1/accounts/origins/%1$s', $id],
            options: $requestOptions,
            convert: null,
        );

        return $response->parse();
    }

    /**
     * @api
     *
     * **Note:** This API is currently in beta.
     * Retrieves the origin identified by `id`.
     *
     * @throws APIException
     */
    public function get(
        string $id,
        ?RequestOptions $requestOptions = null
    ): S3|S3Compatible|CloudinaryBackup|WebFolder|WebProxy|Gcs|AzureBlob|AkeneoPim {
        /** @var BaseResponse<S3|S3Compatible|CloudinaryBackup|WebFolder|WebProxy|Gcs|AzureBlob|AkeneoPim,> */
        $response = $this->client->request(
            method: 'get',
            path: ['v1/accounts/origins/%1$s', $id],
            options: $requestOptions,
            convert: OriginResponse::class,
        );

        return $response->parse();
    }
}
