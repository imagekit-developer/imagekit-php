<?php

declare(strict_types=1);

namespace ImageKit\Files\Bulk;

use ImageKit\Core\Attributes\Required;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Concerns\SdkParams;
use ImageKit\Core\Contracts\BaseModel;

/**
 * This API deletes multiple files and all their file versions permanently.
 *
 * Note: If a file or specific transformation has been requested in the past, then the response is cached. Deleting a file does not purge the cache. You can purge the cache using purge cache API.
 *
 * A maximum of 100 files can be deleted at a time.
 *
 * @see ImageKit\Services\Files\BulkService::delete()
 *
 * @phpstan-type BulkDeleteParamsShape = array{fileIDs: list<string>}
 */
final class BulkDeleteParams implements BaseModel
{
    /** @use SdkModel<BulkDeleteParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * An array of fileIds which you want to delete.
     *
     * @var list<string> $fileIDs
     */
    #[Required('fileIds', list: 'string')]
    public array $fileIDs;

    /**
     * `new BulkDeleteParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BulkDeleteParams::with(fileIDs: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new BulkDeleteParams)->withFileIDs(...)
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
     *
     * @param list<string> $fileIDs
     */
    public static function with(array $fileIDs): self
    {
        $self = new self;

        $self['fileIDs'] = $fileIDs;

        return $self;
    }

    /**
     * An array of fileIds which you want to delete.
     *
     * @param list<string> $fileIDs
     */
    public function withFileIDs(array $fileIDs): self
    {
        $self = clone $this;
        $self['fileIDs'] = $fileIDs;

        return $self;
    }
}
