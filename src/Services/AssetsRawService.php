<?php

declare(strict_types=1);

namespace Imagekit\Services;

use Imagekit\Assets\AssetListParams;
use Imagekit\Assets\AssetListParams\FileType;
use Imagekit\Assets\AssetListParams\Sort;
use Imagekit\Assets\AssetListParams\Type;
use Imagekit\Assets\AssetListResponseItem;
use Imagekit\Client;
use Imagekit\Core\Contracts\BaseResponse;
use Imagekit\Core\Conversion\ListOf;
use Imagekit\Core\Exceptions\APIException;
use Imagekit\Files\File;
use Imagekit\Files\Folder;
use Imagekit\RequestOptions;
use Imagekit\ServiceContracts\AssetsRawContract;

/**
 * @phpstan-import-type RequestOpts from \Imagekit\RequestOptions
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
