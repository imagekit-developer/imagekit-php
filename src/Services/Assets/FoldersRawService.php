<?php

declare(strict_types=1);

namespace ImageKit\Services\Assets;

use ImageKit\Assets\Folders\FolderCreateParams;
use ImageKit\Assets\Folders\FolderNewResponse;
use ImageKit\Client;
use ImageKit\Core\Contracts\BaseResponse;
use ImageKit\Core\Exceptions\APIException;
use ImageKit\RequestOptions;
use ImageKit\ServiceContracts\Assets\FoldersRawContract;

/**
 * @phpstan-import-type RequestOpts from \ImageKit\RequestOptions
 */
final class FoldersRawService implements FoldersRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Creates a new (empty) folder. Specify the folder name and the path of the parent folder under which the new folder should be created.
     *
     * If any folder in `parent_folder_path` does not exist, the missing folders are created automatically. For example, when `parent_folder_path` is `/product/images/summer`, the folders `product`, `images`, and `summer` are created if they don't already exist.
     *
     * @param array{
     *   folderName: string, parentFolderPath: string
     * }|FolderCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<FolderNewResponse>
     *
     * @throws APIException
     */
    public function create(
        array|FolderCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = FolderCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'v2/assets/folders',
            body: (object) $parsed,
            options: $options,
            convert: FolderNewResponse::class,
        );
    }
}
