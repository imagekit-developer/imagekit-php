<?php

declare(strict_types=1);

namespace ImageKit\Files\Batch;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\Model;
use ImageKit\Core\Concerns\Params;
use ImageKit\Core\Contracts\BaseModel;
use ImageKit\Core\Conversion\ListOf;

/**
 * This API deletes multiple files and all their file versions permanently.
 *
 * Note: If a file or specific transformation has been requested in the past, then the response is cached. Deleting a file does not purge the cache. You can purge the cache using purge cache API.
 *
 * A maximum of 100 files can be deleted at a time.
 *
 * @phpstan-type delete_params = array{fileIDs: list<string>}
 */
final class BatchDeleteParams implements BaseModel
{
    use Model;
    use Params;

    /**
     * An array of fileIds which you want to delete.
     *
     * @var list<string> $fileIDs
     */
    #[Api('fileIds', type: new ListOf('string'))]
    public array $fileIDs;

    public function __construct()
    {
        self::introspect();
        $this->unsetOptionalProperties();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<string> $fileIDs
     */
    public static function from(array $fileIDs): self
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
    public function setFileIDs(array $fileIDs): self
    {
        $this->fileIDs = $fileIDs;

        return $this;
    }
}
