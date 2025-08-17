<?php

declare(strict_types=1);

namespace ImageKit\Assets;

use ImageKit\Assets\AssetListParams\FileType;
use ImageKit\Assets\AssetListParams\Sort;
use ImageKit\Assets\AssetListParams\Type;
use ImageKit\Client;
use ImageKit\Contracts\AssetsContract;
use ImageKit\Core\Conversion;
use ImageKit\Core\Conversion\ListOf;
use ImageKit\RequestOptions;
use ImageKit\Responses\Assets\AssetListResponseItem;
use ImageKit\Responses\Assets\AssetListResponseItem\FileDetails;
use ImageKit\Responses\Assets\AssetListResponseItem\FolderDetails;

final class AssetsService implements AssetsContract
{
    public function __construct(private Client $client) {}

    /**
     * This API can list all the uploaded files and folders in your ImageKit.io media library. In addition, you can fine-tune your query by specifying various filters by generating a query string in a Lucene-like syntax and provide this generated string as the value of the `searchQuery`.
     *
     * @param array{
     *   fileType?: FileType::*,
     *   limit?: int,
     *   path?: string,
     *   searchQuery?: string,
     *   skip?: int,
     *   sort?: Sort::*,
     *   type?: Type::*,
     * }|AssetListParams $params
     *
     * @return list<FileDetails|FolderDetails>
     */
    public function list(
        array|AssetListParams $params,
        ?RequestOptions $requestOptions = null
    ): array {
        [$parsed, $options] = AssetListParams::parseRequest(
            $params,
            $requestOptions
        );
        $resp = $this->client->request(
            method: 'get',
            path: 'v1/files',
            query: $parsed,
            options: $options
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(
            new ListOf(AssetListResponseItem::class),
            value: $resp
        );
    }
}
