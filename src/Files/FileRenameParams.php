<?php

declare(strict_types=1);

namespace ImageKit\Files;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Concerns\SdkParams;
use ImageKit\Core\Contracts\BaseModel;

/**
 * You can rename an already existing file in the media library using rename file API. This operation would rename all file versions of the file.
 *
 * Note: The old URLs will stop working. The file/file version URLs cached on CDN will continue to work unless a purge is requested.
 *
 * @see ImageKit\FilesService::rename()
 *
 * @phpstan-type FileRenameParamsShape = array{
 *   filePath: string, newFileName: string, purgeCache?: bool
 * }
 */
final class FileRenameParams implements BaseModel
{
    /** @use SdkModel<FileRenameParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The full path of the file you want to rename.
     */
    #[Api]
    public string $filePath;

    /**
     * The new name of the file. A filename can contain:
     *
     * Alphanumeric Characters: `a-z`, `A-Z`, `0-9` (including Unicode letters, marks, and numerals in other languages).
     * Special Characters: `.`, `_`, and `-`.
     *
     * Any other character, including space, will be replaced by `_`.
     */
    #[Api]
    public string $newFileName;

    /**
     * Option to purge cache for the old file and its versions' URLs.
     *
     * When set to true, it will internally issue a purge cache request on CDN to remove cached content of old file and its versions. This purge request is counted against your monthly purge quota.
     *
     * Note: If the old file were accessible at `https://ik.imagekit.io/demo/old-filename.jpg`, a purge cache request would be issued against `https://ik.imagekit.io/demo/old-filename.jpg*` (with a wildcard at the end). It will remove the file and its versions' URLs and any transformations made using query parameters on this file or its versions. However, the cache for file transformations made using path parameters will persist. You can purge them using the purge API. For more details, refer to the purge API documentation.
     *
     *
     *
     * Default value - `false`
     */
    #[Api(optional: true)]
    public ?bool $purgeCache;

    /**
     * `new FileRenameParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * FileRenameParams::with(filePath: ..., newFileName: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new FileRenameParams)->withFilePath(...)->withNewFileName(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(
        string $filePath,
        string $newFileName,
        ?bool $purgeCache = null
    ): self {
        $obj = new self;

        $obj->filePath = $filePath;
        $obj->newFileName = $newFileName;

        null !== $purgeCache && $obj->purgeCache = $purgeCache;

        return $obj;
    }

    /**
     * The full path of the file you want to rename.
     */
    public function withFilePath(string $filePath): self
    {
        $obj = clone $this;
        $obj->filePath = $filePath;

        return $obj;
    }

    /**
     * The new name of the file. A filename can contain:
     *
     * Alphanumeric Characters: `a-z`, `A-Z`, `0-9` (including Unicode letters, marks, and numerals in other languages).
     * Special Characters: `.`, `_`, and `-`.
     *
     * Any other character, including space, will be replaced by `_`.
     */
    public function withNewFileName(string $newFileName): self
    {
        $obj = clone $this;
        $obj->newFileName = $newFileName;

        return $obj;
    }

    /**
     * Option to purge cache for the old file and its versions' URLs.
     *
     * When set to true, it will internally issue a purge cache request on CDN to remove cached content of old file and its versions. This purge request is counted against your monthly purge quota.
     *
     * Note: If the old file were accessible at `https://ik.imagekit.io/demo/old-filename.jpg`, a purge cache request would be issued against `https://ik.imagekit.io/demo/old-filename.jpg*` (with a wildcard at the end). It will remove the file and its versions' URLs and any transformations made using query parameters on this file or its versions. However, the cache for file transformations made using path parameters will persist. You can purge them using the purge API. For more details, refer to the purge API documentation.
     *
     *
     *
     * Default value - `false`
     */
    public function withPurgeCache(bool $purgeCache): self
    {
        $obj = clone $this;
        $obj->purgeCache = $purgeCache;

        return $obj;
    }
}
