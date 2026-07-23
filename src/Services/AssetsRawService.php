<?php

declare(strict_types=1);

namespace ImageKit\Services;

use ImageKit\Assets\AssetListParams;
use ImageKit\Assets\AssetListParams\FileType;
use ImageKit\Assets\AssetListParams\Sort;
use ImageKit\Assets\AssetListParams\Type;
use ImageKit\Assets\AssetListResponseItem;
use ImageKit\Client;
use ImageKit\Core\Contracts\BaseResponse;
use ImageKit\Core\Conversion\ListOf;
use ImageKit\Core\Exceptions\APIException;
use ImageKit\Files\File;
use ImageKit\Files\Folder;
use ImageKit\RequestOptions;
use ImageKit\ServiceContracts\AssetsRawContract;

/**
 * @phpstan-import-type RequestOpts from \ImageKit\RequestOptions
 */
final class AssetsRawService implements AssetsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * This API can list all the uploaded files and folders in your ImageKit.io media library. In addition, you can fine-tune your query by specifying various filters by generating a query string in a Lucene-like syntax and provide this generated string as the value of the `searchQuery`.
     *
     * @param array{
     *   fileType?: FileType|value-of<FileType>,
     *   limit?: int,
     *   path?: string,
     *   searchQuery?: string,
     *   skip?: int,
     *   sort?: value-of<Sort>,
     *   type?: Type|value-of<Type>,
     * }|AssetListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<list<File|Folder>>
     *
     * @throws APIException
     */
    public function list(
        array|AssetListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = AssetListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'v1/files',
            query: $parsed,
            options: $options,
            convert: new ListOf(AssetListResponseItem::class),
        );
    }
}
