<?php

declare(strict_types=1);

namespace ImageKit\Services\Assets;

use ImageKit\Assets\Folders\FolderNewResponse;
use ImageKit\Client;
use ImageKit\Core\Exceptions\APIException;
use ImageKit\Core\Util;
use ImageKit\RequestOptions;
use ImageKit\ServiceContracts\Assets\FoldersContract;

/**
 * @phpstan-import-type RequestOpts from \ImageKit\RequestOptions
 */
final class FoldersService implements FoldersContract
{
    /**
     * @api
     */
    public FoldersRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new FoldersRawService($client);
    }

    /**
     * @api
     *
     * Creates a new (empty) folder. Specify the folder name and the path of the parent folder under which the new folder should be created.
     *
     * If any folder in `parent_folder_path` does not exist, the missing folders are created automatically. For example, when `parent_folder_path` is `/product/images/summer`, the folders `product`, `images`, and `summer` are created if they don't already exist.
     *
     * @param string $folderName Name of the folder to create.
     *
     * All characters except alphabets and numbers (including Unicode letters, marks, and numerals in other languages) are replaced by an underscore `_`.
     * @param string $parentFolderPath Full path of the parent folder under which the new folder should be created. Use `/` for the root, otherwise a path like `/containing/folder/`.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $folderName,
        string $parentFolderPath,
        RequestOptions|array|null $requestOptions = null,
    ): FolderNewResponse {
        $params = Util::removeNulls(
            ['folderName' => $folderName, 'parentFolderPath' => $parentFolderPath]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
