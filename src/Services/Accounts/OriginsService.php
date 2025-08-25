<?php

declare(strict_types=1);

namespace ImageKit\Services\Accounts;

use ImageKit\Accounts\Origins\Origin\AkeneoPim as AkeneoPim1;
use ImageKit\Accounts\Origins\Origin\AzureBlob as AzureBlob1;
use ImageKit\Accounts\Origins\Origin\CloudinaryBackup as CloudinaryBackup1;
use ImageKit\Accounts\Origins\Origin\Gcs as Gcs1;
use ImageKit\Accounts\Origins\Origin\S3 as S31;
use ImageKit\Accounts\Origins\Origin\S3Compatible as S3Compatible1;
use ImageKit\Accounts\Origins\Origin\WebFolder as WebFolder1;
use ImageKit\Accounts\Origins\Origin\WebProxy as WebProxy1;
use ImageKit\Accounts\Origins\OriginCreateParams;
use ImageKit\Accounts\Origins\OriginUpdateParams;
use ImageKit\Client;
use ImageKit\Contracts\Accounts\OriginsContract;
use ImageKit\Core\Conversion;
use ImageKit\Core\Conversion\ListOf;
use ImageKit\RequestOptions;
use ImageKit\Responses\Accounts\Origins\OriginGetResponse;
use ImageKit\Responses\Accounts\Origins\OriginGetResponse\AkeneoPim as AkeneoPim4;
use ImageKit\Responses\Accounts\Origins\OriginGetResponse\AzureBlob as AzureBlob4;
use ImageKit\Responses\Accounts\Origins\OriginGetResponse\CloudinaryBackup as CloudinaryBackup4;
use ImageKit\Responses\Accounts\Origins\OriginGetResponse\Gcs as Gcs4;
use ImageKit\Responses\Accounts\Origins\OriginGetResponse\S3 as S34;
use ImageKit\Responses\Accounts\Origins\OriginGetResponse\S3Compatible as S3Compatible4;
use ImageKit\Responses\Accounts\Origins\OriginGetResponse\WebFolder as WebFolder4;
use ImageKit\Responses\Accounts\Origins\OriginGetResponse\WebProxy as WebProxy4;
use ImageKit\Responses\Accounts\Origins\OriginListResponseItem;
use ImageKit\Responses\Accounts\Origins\OriginListResponseItem\AkeneoPim;
use ImageKit\Responses\Accounts\Origins\OriginListResponseItem\AzureBlob;
use ImageKit\Responses\Accounts\Origins\OriginListResponseItem\CloudinaryBackup;
use ImageKit\Responses\Accounts\Origins\OriginListResponseItem\Gcs;
use ImageKit\Responses\Accounts\Origins\OriginListResponseItem\S3;
use ImageKit\Responses\Accounts\Origins\OriginListResponseItem\S3Compatible;
use ImageKit\Responses\Accounts\Origins\OriginListResponseItem\WebFolder;
use ImageKit\Responses\Accounts\Origins\OriginListResponseItem\WebProxy;
use ImageKit\Responses\Accounts\Origins\OriginNewResponse;
use ImageKit\Responses\Accounts\Origins\OriginNewResponse\AkeneoPim as AkeneoPim2;
use ImageKit\Responses\Accounts\Origins\OriginNewResponse\AzureBlob as AzureBlob2;
use ImageKit\Responses\Accounts\Origins\OriginNewResponse\CloudinaryBackup as CloudinaryBackup2;
use ImageKit\Responses\Accounts\Origins\OriginNewResponse\Gcs as Gcs2;
use ImageKit\Responses\Accounts\Origins\OriginNewResponse\S3 as S32;
use ImageKit\Responses\Accounts\Origins\OriginNewResponse\S3Compatible as S3Compatible2;
use ImageKit\Responses\Accounts\Origins\OriginNewResponse\WebFolder as WebFolder2;
use ImageKit\Responses\Accounts\Origins\OriginNewResponse\WebProxy as WebProxy2;
use ImageKit\Responses\Accounts\Origins\OriginUpdateResponse;
use ImageKit\Responses\Accounts\Origins\OriginUpdateResponse\AkeneoPim as AkeneoPim3;
use ImageKit\Responses\Accounts\Origins\OriginUpdateResponse\AzureBlob as AzureBlob3;
use ImageKit\Responses\Accounts\Origins\OriginUpdateResponse\CloudinaryBackup as CloudinaryBackup3;
use ImageKit\Responses\Accounts\Origins\OriginUpdateResponse\Gcs as Gcs3;
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
     * @param S31|S3Compatible1|CloudinaryBackup1|WebFolder1|WebProxy1|Gcs1|AzureBlob1|AkeneoPim1 $origin schema for origin resources
     */
    public function create(
        $origin,
        ?RequestOptions $requestOptions = null
    ): S32|S3Compatible2|CloudinaryBackup2|WebFolder2|WebProxy2|Gcs2|AzureBlob2|AkeneoPim2 {
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
     * @param S31|S3Compatible1|CloudinaryBackup1|WebFolder1|WebProxy1|Gcs1|AzureBlob1|AkeneoPim1 $origin schema for origin resources
     */
    public function update(
        string $id,
        $origin,
        ?RequestOptions $requestOptions = null
    ): S33|S3Compatible3|CloudinaryBackup3|WebFolder3|WebProxy3|Gcs3|AzureBlob3|AkeneoPim3 {
        $args = ['origin' => $origin];
        [$parsed, $options] = OriginUpdateParams::parseRequest(
            $args,
            $requestOptions
        );
        $resp = $this->client->request(
            method: 'put',
            path: ['v1/accounts/origins/%1$s', $id],
            body: (object) $parsed['origin'],
            options: $options,
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(OriginUpdateResponse::class, value: $resp);
    }

    /**
     * **Note:** This API is currently in beta.
     * Returns an array of all configured origins for the current account.
     *
     * @return list<S3|S3Compatible|CloudinaryBackup|WebFolder|WebProxy|Gcs|AzureBlob|AkeneoPim>
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
    ): S34|S3Compatible4|CloudinaryBackup4|WebFolder4|WebProxy4|Gcs4|AzureBlob4|AkeneoPim4 {
        $resp = $this->client->request(
            method: 'get',
            path: ['v1/accounts/origins/%1$s', $id],
            options: $requestOptions,
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(OriginGetResponse::class, value: $resp);
    }
}
