<?php

declare(strict_types=1);

namespace Imagekit\Services\Files;

use Imagekit\Client;
use Imagekit\Core\Exceptions\APIException;
use Imagekit\Core\Util;
use Imagekit\Files\Metadata;
use Imagekit\RequestOptions;
use Imagekit\ServiceContracts\Files\MetadataContract;

final class MetadataService implements MetadataContract
{
    /**
     * @api
     */
    public MetadataRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new MetadataRawService($client);
    }

    /**
     * @api
     *
     * You can programmatically get image EXIF, pHash, and other metadata for uploaded files in the ImageKit.io media library using this API.
     *
     * You can also get the metadata in upload API response by passing `metadata` in `responseFields` parameter.
     *
     * @param string $fileID The unique `fileId` of the uploaded file. `fileId` is returned in the list and search assets API and upload API.
     *
     * @throws APIException
     */
    public function get(
        string $fileID,
        ?RequestOptions $requestOptions = null
    ): Metadata {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->get($fileID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Get image EXIF, pHash, and other metadata from ImageKit.io powered remote URL using this API.
     *
     * @param string $url Should be a valid file URL. It should be accessible using your ImageKit.io account.
     *
     * @throws APIException
     */
    public function getFromURL(
        string $url,
        ?RequestOptions $requestOptions = null
    ): Metadata {
        $params = Util::removeNulls(['url' => $url]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->getFromURL(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
