<?php

declare(strict_types=1);

namespace Imagekit\Services\Files;

use Imagekit\Client;
use Imagekit\Core\Contracts\BaseResponse;
use Imagekit\Core\Exceptions\APIException;
use Imagekit\Files\Metadata;
use Imagekit\Files\Metadata\MetadataGetFromURLParams;
use Imagekit\RequestOptions;
use Imagekit\ServiceContracts\Files\MetadataRawContract;

final class MetadataRawService implements MetadataRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * You can programmatically get image EXIF, pHash, and other metadata for uploaded files in the ImageKit.io media library using this API.
     *
     * You can also get the metadata in upload API response by passing `metadata` in `responseFields` parameter.
     *
     * @param string $fileID The unique `fileId` of the uploaded file. `fileId` is returned in the list and search assets API and upload API.
     *
     * @return BaseResponse<Metadata>
     *
     * @throws APIException
     */
    public function get(
        string $fileID,
        ?RequestOptions $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['v1/files/%1$s/metadata', $fileID],
            options: $requestOptions,
            convert: Metadata::class,
        );
    }

    /**
     * @api
     *
     * Get image EXIF, pHash, and other metadata from ImageKit.io powered remote URL using this API.
     *
     * @param array{url: string}|MetadataGetFromURLParams $params
     *
     * @return BaseResponse<Metadata>
     *
     * @throws APIException
     */
    public function getFromURL(
        array|MetadataGetFromURLParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = MetadataGetFromURLParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'v1/files/metadata',
            query: $parsed,
            options: $options,
            convert: Metadata::class,
        );
    }
}
