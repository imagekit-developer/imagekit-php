<?php

declare(strict_types=1);

namespace ImageKit\Files\Bulk;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Concerns\SdkResponse;
use ImageKit\Core\Contracts\BaseModel;
use ImageKit\Core\Conversion\Contracts\ResponseConverter;

/**
 * @phpstan-type BulkDeleteResponseShape = array{
 *   successfullyDeletedFileIDs?: list<string>
 * }
 */
final class BulkDeleteResponse implements BaseModel, ResponseConverter
{
    /** @use SdkModel<BulkDeleteResponseShape> */
    use SdkModel;

    use SdkResponse;

    /**
     * An array of fileIds that were successfully deleted.
     *
     * @var list<string>|null $successfullyDeletedFileIDs
     */
    #[Api('successfullyDeletedFileIds', list: 'string', optional: true)]
    public ?array $successfullyDeletedFileIDs;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<string> $successfullyDeletedFileIDs
     */
    public static function with(?array $successfullyDeletedFileIDs = null): self
    {
        $obj = new self;

        null !== $successfullyDeletedFileIDs && $obj->successfullyDeletedFileIDs = $successfullyDeletedFileIDs;

        return $obj;
    }

    /**
     * An array of fileIds that were successfully deleted.
     *
     * @param list<string> $successfullyDeletedFileIDs
     */
    public function withSuccessfullyDeletedFileIDs(
        array $successfullyDeletedFileIDs
    ): self {
        $obj = clone $this;
        $obj->successfullyDeletedFileIDs = $successfullyDeletedFileIDs;

        return $obj;
    }
}
