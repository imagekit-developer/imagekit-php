<?php

declare(strict_types=1);

namespace ImageKit\Services\Accounts;

use ImageKit\Accounts\Origins\Origin;
use ImageKit\Accounts\Origins\Origin\AkeneoPim;
use ImageKit\Accounts\Origins\Origin\AzureBlob;
use ImageKit\Accounts\Origins\Origin\CloudinaryBackup;
use ImageKit\Accounts\Origins\Origin\Gcs;
use ImageKit\Accounts\Origins\Origin\S3;
use ImageKit\Accounts\Origins\Origin\S3Compatible;
use ImageKit\Accounts\Origins\Origin\WebFolder;
use ImageKit\Accounts\Origins\Origin\WebProxy;
use ImageKit\Accounts\Origins\OriginCreateParams;
use ImageKit\Accounts\Origins\OriginUpdateParams;
use ImageKit\Client;
use ImageKit\Contracts\Accounts\OriginsContract;
use ImageKit\Core\Conversion;
use ImageKit\Core\Conversion\ListOf;
use ImageKit\RequestOptions;

final class OriginsService implements OriginsContract
{
    public function __construct(private Client $client) {}

    /**
     * **Note:** This API is currently in beta.
     * Creates a new origin and returns the origin object.
     *
     * @param S3|S3Compatible|CloudinaryBackup|WebFolder|WebProxy|Gcs|AzureBlob|AkeneoPim $origin schema for origin resources
     */
    public function create(
        $origin,
        ?RequestOptions $requestOptions = null
    ): S3|S3Compatible|CloudinaryBackup|WebFolder|WebProxy|Gcs|AzureBlob|AkeneoPim {
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
        return Conversion::coerce(Origin::class, value: $resp);
    }

    /**
     * **Note:** This API is currently in beta.
     * Updates the origin identified by `id` and returns the updated origin object.
     *
     * @param S3|S3Compatible|CloudinaryBackup|WebFolder|WebProxy|Gcs|AzureBlob|AkeneoPim $origin schema for origin resources
     */
    public function update(
        string $id,
        $origin,
        ?RequestOptions $requestOptions = null
    ): S3|S3Compatible|CloudinaryBackup|WebFolder|WebProxy|Gcs|AzureBlob|AkeneoPim {
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
        return Conversion::coerce(Origin::class, value: $resp);
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
        return Conversion::coerce(new ListOf(Origin::class), value: $resp);
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
    ): S3|S3Compatible|CloudinaryBackup|WebFolder|WebProxy|Gcs|AzureBlob|AkeneoPim {
        $resp = $this->client->request(
            method: 'get',
            path: ['v1/accounts/origins/%1$s', $id],
            options: $requestOptions,
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(Origin::class, value: $resp);
    }
}
