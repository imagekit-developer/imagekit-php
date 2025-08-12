<?php

declare(strict_types=1);

namespace ImageKit\Files\Metadata;

use ImageKit\Client;
use ImageKit\Contracts\Files\MetadataContract;
use ImageKit\Core\Conversion;
use ImageKit\RequestOptions;
use ImageKit\Responses\Files\Metadata\MetadataFromURLResponse;
use ImageKit\Responses\Files\Metadata\MetadataGetResponse;

final class MetadataService implements MetadataContract
{
    public function __construct(private Client $client) {}

    /**
     * You can programmatically get image EXIF, pHash, and other metadata for uploaded files in the ImageKit.io media library using this API.
     *
     * You can also get the metadata in upload API response by passing `metadata` in `responseFields` parameter.
     */
    public function retrieve(
        string $fileID,
        ?RequestOptions $requestOptions = null
    ): MetadataGetResponse {
        $resp = $this->client->request(
            method: 'get',
            path: ['v1/files/%1$s/metadata', $fileID],
            options: $requestOptions,
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(MetadataGetResponse::class, value: $resp);
    }

    /**
     * Get image EXIF, pHash, and other metadata from ImageKit.io powered remote URL using this API.
     *
     * @param array{url: string}|MetadataFromURLParams $params
     */
    public function fromURL(
        array|MetadataFromURLParams $params,
        ?RequestOptions $requestOptions = null
    ): MetadataFromURLResponse {
        [$parsed, $options] = MetadataFromURLParams::parseRequest(
            $params,
            $requestOptions
        );
        $resp = $this->client->request(
            method: 'get',
            path: 'v1/files/metadata',
            query: $parsed,
            options: $options,
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(MetadataFromURLResponse::class, value: $resp);
    }
}
