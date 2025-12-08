<?php

declare(strict_types=1);

namespace Imagekit\Files\Bulk;

use Imagekit\Core\Attributes\Api;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Concerns\SdkParams;
use Imagekit\Core\Contracts\BaseModel;

/**
 * This API deletes multiple files and all their file versions permanently.
 *
 * Note: If a file or specific transformation has been requested in the past, then the response is cached. Deleting a file does not purge the cache. You can purge the cache using purge cache API.
 *
 * A maximum of 100 files can be deleted at a time.
 *
 * @see Imagekit\Services\Files\BulkService::delete()
 *
 * @phpstan-type BulkDeleteParamsShape = array{fileIds: list<string>}
 */
final class BulkDeleteParams implements BaseModel
{
    /** @use SdkModel<BulkDeleteParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * An array of fileIds which you want to delete.
     *
     * @var list<string> $fileIds
     */
    #[Api(list: 'string')]
    public array $fileIds;

    /**
     * `new BulkDeleteParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BulkDeleteParams::with(fileIds: ...)
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
     * @param list<string> $fileIds
     */
    public static function with(array $fileIds): self
    {
        $obj = new self;

        $obj['fileIds'] = $fileIds;

        return $obj;
    }

    /**
     * An array of fileIds which you want to delete.
     *
     * @param list<string> $fileIDs
     */
    public function withFileIDs(array $fileIDs): self
    {
        $obj = clone $this;
        $obj['fileIds'] = $fileIDs;

        return $obj;
    }
}
