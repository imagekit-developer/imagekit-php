<?php

declare(strict_types=1);

namespace ImageKit\Services\Accounts;

use ImageKit\Accounts\Origins\OriginCreateParams;
use ImageKit\Accounts\Origins\OriginCreateParams\Body;
use ImageKit\Accounts\Origins\OriginUpdateParams;
use ImageKit\Accounts\Origins\OriginUpdateParams\Body as Body1;
use ImageKit\Client;
use ImageKit\Contracts\Accounts\OriginsContract;
use ImageKit\Core\Conversion;
use ImageKit\Core\Conversion\ListOf;
use ImageKit\RequestOptions;
use ImageKit\Responses\Accounts\Origins\OriginGetResponse;
use ImageKit\Responses\Accounts\Origins\OriginGetResponse\AkeneoPim as AkeneoPim3;
use ImageKit\Responses\Accounts\Origins\OriginGetResponse\AzureBlobStorage as AzureBlobStorage3;
use ImageKit\Responses\Accounts\Origins\OriginGetResponse\CloudinaryBackup as CloudinaryBackup3;
use ImageKit\Responses\Accounts\Origins\OriginGetResponse\GoogleCloudStorageGcs as GoogleCloudStorageGcs3;
use ImageKit\Responses\Accounts\Origins\OriginGetResponse\S3 as S33;
use ImageKit\Responses\Accounts\Origins\OriginGetResponse\S3Compatible as S3Compatible3;
use ImageKit\Responses\Accounts\Origins\OriginGetResponse\WebFolder as WebFolder3;
use ImageKit\Responses\Accounts\Origins\OriginGetResponse\WebProxy as WebProxy3;
use ImageKit\Responses\Accounts\Origins\OriginListResponseItem;
use ImageKit\Responses\Accounts\Origins\OriginListResponseItem\AkeneoPim;
use ImageKit\Responses\Accounts\Origins\OriginListResponseItem\AzureBlobStorage;
use ImageKit\Responses\Accounts\Origins\OriginListResponseItem\CloudinaryBackup;
use ImageKit\Responses\Accounts\Origins\OriginListResponseItem\GoogleCloudStorageGcs;
use ImageKit\Responses\Accounts\Origins\OriginListResponseItem\S3;
use ImageKit\Responses\Accounts\Origins\OriginListResponseItem\S3Compatible;
use ImageKit\Responses\Accounts\Origins\OriginListResponseItem\WebFolder;
use ImageKit\Responses\Accounts\Origins\OriginListResponseItem\WebProxy;
use ImageKit\Responses\Accounts\Origins\OriginNewResponse;
use ImageKit\Responses\Accounts\Origins\OriginNewResponse\AkeneoPim as AkeneoPim1;
use ImageKit\Responses\Accounts\Origins\OriginNewResponse\AzureBlobStorage as AzureBlobStorage1;
use ImageKit\Responses\Accounts\Origins\OriginNewResponse\CloudinaryBackup as CloudinaryBackup1;
use ImageKit\Responses\Accounts\Origins\OriginNewResponse\GoogleCloudStorageGcs as GoogleCloudStorageGcs1;
use ImageKit\Responses\Accounts\Origins\OriginNewResponse\S3 as S31;
use ImageKit\Responses\Accounts\Origins\OriginNewResponse\S3Compatible as S3Compatible1;
use ImageKit\Responses\Accounts\Origins\OriginNewResponse\WebFolder as WebFolder1;
use ImageKit\Responses\Accounts\Origins\OriginNewResponse\WebProxy as WebProxy1;
use ImageKit\Responses\Accounts\Origins\OriginUpdateResponse;
use ImageKit\Responses\Accounts\Origins\OriginUpdateResponse\AkeneoPim as AkeneoPim2;
use ImageKit\Responses\Accounts\Origins\OriginUpdateResponse\AzureBlobStorage as AzureBlobStorage2;
use ImageKit\Responses\Accounts\Origins\OriginUpdateResponse\CloudinaryBackup as CloudinaryBackup2;
use ImageKit\Responses\Accounts\Origins\OriginUpdateResponse\GoogleCloudStorageGcs as GoogleCloudStorageGcs2;
use ImageKit\Responses\Accounts\Origins\OriginUpdateResponse\S3 as S32;
use ImageKit\Responses\Accounts\Origins\OriginUpdateResponse\S3Compatible as S3Compatible2;
use ImageKit\Responses\Accounts\Origins\OriginUpdateResponse\WebFolder as WebFolder2;
use ImageKit\Responses\Accounts\Origins\OriginUpdateResponse\WebProxy as WebProxy2;

final class OriginsService implements OriginsContract
{
    public function __construct(private Client $client) {}

    /**
     * **Note:** This API is currently in beta.
     * Creates a new origin and returns the origin object.
     *
     * @param Body $body
     */
    public function create(
        $body,
        ?RequestOptions $requestOptions = null
    ): S31|S3Compatible1|CloudinaryBackup1|WebFolder1|WebProxy1|GoogleCloudStorageGcs1|AzureBlobStorage1|AkeneoPim1 {
        $args = ['body' => $body];
        [$parsed, $options] = OriginCreateParams::parseRequest(
            $args,
            $requestOptions
        );
        $resp = $this->client->request(
            method: 'post',
            path: 'v1/accounts/origins',
            body: (object) $parsed['body'],
            options: $options,
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(OriginNewResponse::class, value: $resp);
    }

    /**
     * **Note:** This API is currently in beta.
     * Updates the origin identified by `id` and returns the updated origin object.
     *
     * @param Body1 $body
     */
    public function update(
        string $id,
        $body,
        ?RequestOptions $requestOptions = null
    ): S32|S3Compatible2|CloudinaryBackup2|WebFolder2|WebProxy2|GoogleCloudStorageGcs2|AzureBlobStorage2|AkeneoPim2 {
        $args = ['body' => $body];
        [$parsed, $options] = OriginUpdateParams::parseRequest(
            $args,
            $requestOptions
        );
        $resp = $this->client->request(
            method: 'put',
            path: ['v1/accounts/origins/%1$s', $id],
            body: (object) $parsed['body'],
            options: $options,
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(OriginUpdateResponse::class, value: $resp);
    }

    /**
     * **Note:** This API is currently in beta.
     * Returns an array of all configured origins for the current account.
     *
     * @return list<S3|S3Compatible|CloudinaryBackup|WebFolder|WebProxy|GoogleCloudStorageGcs|AzureBlobStorage|AkeneoPim>
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
    ): S33|S3Compatible3|CloudinaryBackup3|WebFolder3|WebProxy3|GoogleCloudStorageGcs3|AzureBlobStorage3|AkeneoPim3 {
        $resp = $this->client->request(
            method: 'get',
            path: ['v1/accounts/origins/%1$s', $id],
            options: $requestOptions,
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(OriginGetResponse::class, value: $resp);
    }
}
