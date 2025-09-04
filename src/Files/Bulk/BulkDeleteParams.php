<?php

declare(strict_types=1);

namespace ImageKit\Files\Bulk;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Concerns\SdkParams;
use ImageKit\Core\Contracts\BaseModel;

/**
 * An object containing the method's parameters.
 * Example usage:
 * ```
 * $params = (new BulkDeleteParams); // set properties as needed
 * $client->files.bulk->delete(...$params->toArray());
 * ```
 * This API deletes multiple files and all their file versions permanently.
 *
 * Note: If a file or specific transformation has been requested in the past, then the response is cached. Deleting a file does not purge the cache. You can purge the cache using purge cache API.
 *
 * A maximum of 100 files can be deleted at a time.
 *
 * @method toArray()
 *   Returns the parameters as an associative array suitable for passing to the client method.
 *
 *   `$client->files.bulk->delete(...$params->toArray());`
 *
 * @see ImageKit\Files\Bulk->delete
 *
 * @phpstan-type bulk_delete_params = array{fileIDs: list<string>}
 */
final class BulkDeleteParams implements BaseModel
{
    /** @use SdkModel<bulk_delete_params> */
    use SdkModel;
    use SdkParams;

    /**
     * An array of fileIds which you want to delete.
     *
     * @var list<string> $fileIDs
     */
    #[Api('fileIds', list: 'string')]
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
        $obj = new self;

        $obj->fileIDs = $fileIDs;

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
        $obj->fileIDs = $fileIDs;

        return $obj;
    }
}
