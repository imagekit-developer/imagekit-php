<?php

declare(strict_types=1);

namespace ImageKit\Assets;

use ImageKit\Core\Attributes\Optional;
use ImageKit\Core\Attributes\Required;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Concerns\SdkParams;
use ImageKit\Core\Contracts\BaseModel;

/**
 * Renames an existing file or folder in the media library. Pass a file path or a folder path in `path`.
 *
 * - **File rename** is synchronous. The operation renames all file versions of the file and returns `200 OK`. If `purge_cache` was `true`, the response includes `purge_request_id`; if the purge quota is exhausted, `207 Multi-Status` is returned (the rename succeeded, the purge did not).
 * - **Folder rename** is asynchronous. The folder and all its nested assets and sub-folders remain unchanged, but their paths are updated to reflect the new folder name. The API returns `202 Accepted` with a `job_id`. Use the [get job status](#operation/get-job-status) API to track progress.
 *
 * Note: The old URLs will stop working. The file or file version URLs cached on the CDN will continue to work until a purge is requested — either implicitly via `purge_cache` or explicitly via the purge cache API.
 *
 * @see ImageKit\Services\AssetsService::rename()
 *
 * @phpstan-type AssetRenameParamsShape = array{
 *   newName: string, path: string, purgeCache?: bool|null
 * }
 */
final class AssetRenameParams implements BaseModel
{
    /** @use SdkModel<AssetRenameParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The new name of the file or folder. The name can contain:
     *
     * - Alphanumeric characters: `a-z`, `A-Z`, `0-9` (including Unicode letters, marks, and numerals in other languages).
     * - Special characters: `.`, `_`, and `-`.
     *
     * Any other character, including space, will be replaced by `_`.
     */
    #[Required('new_name')]
    public string $newName;

    /**
     * Full path of the file or folder you want to rename.
     */
    #[Required]
    public string $path;

    /**
     * When `true`, ImageKit internally issues a purge cache request on the CDN to remove cached content of the old file (or, for folders, the nested files) and its versions. This purge request is counted against your monthly purge quota.
     *
     * Note: A purge cache request would be issued against `https://ik.imagekit.io/<imagekit_id>/<old-path>*` (with a trailing wildcard). It removes the file and its versions' URLs and any transformations made using query parameters. Transformations made using path parameters are not purged — use the purge API for those.
     */
    #[Optional('purge_cache')]
    public ?bool $purgeCache;

    /**
     * `new AssetRenameParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AssetRenameParams::with(newName: ..., path: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AssetRenameParams)->withNewName(...)->withPath(...)
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
        string $newName,
        string $path,
        ?bool $purgeCache = null
    ): self {
        $self = new self;

        $self['newName'] = $newName;
        $self['path'] = $path;

        null !== $purgeCache && $self['purgeCache'] = $purgeCache;

        return $self;
    }

    /**
     * The new name of the file or folder. The name can contain:
     *
     * - Alphanumeric characters: `a-z`, `A-Z`, `0-9` (including Unicode letters, marks, and numerals in other languages).
     * - Special characters: `.`, `_`, and `-`.
     *
     * Any other character, including space, will be replaced by `_`.
     */
    public function withNewName(string $newName): self
    {
        $self = clone $this;
        $self['newName'] = $newName;

        return $self;
    }

    /**
     * Full path of the file or folder you want to rename.
     */
    public function withPath(string $path): self
    {
        $self = clone $this;
        $self['path'] = $path;

        return $self;
    }

    /**
     * When `true`, ImageKit internally issues a purge cache request on the CDN to remove cached content of the old file (or, for folders, the nested files) and its versions. This purge request is counted against your monthly purge quota.
     *
     * Note: A purge cache request would be issued against `https://ik.imagekit.io/<imagekit_id>/<old-path>*` (with a trailing wildcard). It removes the file and its versions' URLs and any transformations made using query parameters. Transformations made using path parameters are not purged — use the purge API for those.
     */
    public function withPurgeCache(bool $purgeCache): self
    {
        $self = clone $this;
        $self['purgeCache'] = $purgeCache;

        return $self;
    }
}
