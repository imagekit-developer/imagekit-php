<?php

declare(strict_types=1);

namespace ImageKit\ServiceContracts\Assets;

use ImageKit\Assets\Folders\FolderNewResponse;
use ImageKit\Core\Exceptions\APIException;
use ImageKit\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \ImageKit\RequestOptions
 */
interface FoldersContract
{
    /**
     * @api
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
    ): FolderNewResponse;
}
