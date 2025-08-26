<?php

declare(strict_types=1);

namespace ImageKit\Services\Files;

use ImageKit\Client;
use ImageKit\Contracts\Files\MetadataContract;
use ImageKit\Core\Conversion;
use ImageKit\Files\Metadata;
use ImageKit\Files\Metadata\MetadataGetFromURLParams;
use ImageKit\RequestOptions;

final class MetadataService implements MetadataContract
{
    public function __construct(private Client $client) {}

    /**
     * You can programmatically get image EXIF, pHash, and other metadata for uploaded files in the ImageKit.io media library using this API.
     *
     * You can also get the metadata in upload API response by passing `metadata` in `responseFields` parameter.
     */
    public function get(
        string $fileID,
        ?RequestOptions $requestOptions = null
    ): Metadata {
        $resp = $this->client->request(
            method: 'get',
            path: ['v1/files/%1$s/metadata', $fileID],
            options: $requestOptions,
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(Metadata::class, value: $resp);
    }

    /**
     * Get image EXIF, pHash, and other metadata from ImageKit.io powered remote URL using this API.
     *
     * @param string $url Should be a valid file URL. It should be accessible using your ImageKit.io account.
     */
    public function getFromURL(
        $url,
        ?RequestOptions $requestOptions = null
    ): Metadata {
        [$parsed, $options] = MetadataGetFromURLParams::parseRequest(
            ['url' => $url],
            $requestOptions
        );
        $resp = $this->client->request(
            method: 'get',
            path: 'v1/files/metadata',
            query: $parsed,
            options: $options,
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(Metadata::class, value: $resp);
    }
}
