<?php

declare(strict_types=1);

namespace ImageKit\Core\Services\Accounts;

use ImageKit\Accounts\Origins\OriginCreateParams;
use ImageKit\Accounts\Origins\OriginRequest\AkeneoPim;
use ImageKit\Accounts\Origins\OriginRequest\AzureBlob;
use ImageKit\Accounts\Origins\OriginRequest\CloudinaryBackup;
use ImageKit\Accounts\Origins\OriginRequest\Gcs;
use ImageKit\Accounts\Origins\OriginRequest\S3;
use ImageKit\Accounts\Origins\OriginRequest\S3Compatible;
use ImageKit\Accounts\Origins\OriginRequest\WebFolder;
use ImageKit\Accounts\Origins\OriginRequest\WebProxy;
use ImageKit\Accounts\Origins\OriginResponse;
use ImageKit\Accounts\Origins\OriginResponse\AkeneoPim as AkeneoPim1;
use ImageKit\Accounts\Origins\OriginResponse\AzureBlob as AzureBlob1;
use ImageKit\Accounts\Origins\OriginResponse\CloudinaryBackup as CloudinaryBackup1;
use ImageKit\Accounts\Origins\OriginResponse\Gcs as Gcs1;
use ImageKit\Accounts\Origins\OriginResponse\S3 as S31;
use ImageKit\Accounts\Origins\OriginResponse\S3Compatible as S3Compatible1;
use ImageKit\Accounts\Origins\OriginResponse\WebFolder as WebFolder1;
use ImageKit\Accounts\Origins\OriginResponse\WebProxy as WebProxy1;
use ImageKit\Accounts\Origins\OriginUpdateParams;
use ImageKit\Client;
use ImageKit\Core\Conversion\ListOf;
use ImageKit\Core\ServiceContracts\Accounts\OriginsContract;
use ImageKit\RequestOptions;

final class OriginsService implements OriginsContract
{
    public function __construct(private Client $client) {}

    /**
     * **Note:** This API is currently in beta.
     * Creates a new origin and returns the origin object.
     *
     * @param S3|S3Compatible|CloudinaryBackup|WebFolder|WebProxy|Gcs|AzureBlob|AkeneoPim $origin schema for origin request resources
     */
    public function create(
        $origin,
        ?RequestOptions $requestOptions = null
    ): S31|S3Compatible1|CloudinaryBackup1|WebFolder1|WebProxy1|Gcs1|AzureBlob1|AkeneoPim1 {
        [$parsed, $options] = OriginCreateParams::parseRequest(
            ['origin' => $origin],
            $requestOptions
        );

        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'post',
            path: 'v1/accounts/origins',
            body: (object) $parsed['origin'],
            options: $options,
            convert: OriginResponse::class,
        );
    }

    /**
     * **Note:** This API is currently in beta.
     * Updates the origin identified by `id` and returns the updated origin object.
     *
     * @param S3|S3Compatible|CloudinaryBackup|WebFolder|WebProxy|Gcs|AzureBlob|AkeneoPim $origin schema for origin request resources
     */
    public function update(
        string $id,
        $origin,
        ?RequestOptions $requestOptions = null
    ): S31|S3Compatible1|CloudinaryBackup1|WebFolder1|WebProxy1|Gcs1|AzureBlob1|AkeneoPim1 {
        [$parsed, $options] = OriginUpdateParams::parseRequest(
            ['origin' => $origin],
            $requestOptions
        );

        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'put',
            path: ['v1/accounts/origins/%1$s', $id],
            body: (object) $parsed['origin'],
            options: $options,
            convert: OriginResponse::class,
        );
    }

    /**
     * **Note:** This API is currently in beta.
     * Returns an array of all configured origins for the current account.
     *
     * @return list<S31|S3Compatible1|CloudinaryBackup1|WebFolder1|WebProxy1|Gcs1|AzureBlob1|AkeneoPim1>
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
     * **Note:** This API is currently in beta.
     * Retrieves the origin identified by `id`.
     */
    public function get(
        string $id,
        ?RequestOptions $requestOptions = null
    ): S31|S3Compatible1|CloudinaryBackup1|WebFolder1|WebProxy1|Gcs1|AzureBlob1|AkeneoPim1 {
        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'get',
            path: ['v1/accounts/origins/%1$s', $id],
            options: $requestOptions,
            convert: OriginResponse::class,
        );
    }
}
