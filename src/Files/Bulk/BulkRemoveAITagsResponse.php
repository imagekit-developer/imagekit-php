<?php

declare(strict_types=1);

namespace ImageKit\Files\Bulk;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Concerns\SdkResponse;
use ImageKit\Core\Contracts\BaseModel;
use ImageKit\Core\Conversion\Contracts\ResponseConverter;

/**
 * @phpstan-type BulkRemoveAITagsResponseShape = array{
 *   successfullyUpdatedFileIds?: list<string>|null
 * }
 */
final class BulkRemoveAITagsResponse implements BaseModel, ResponseConverter
{
    /** @use SdkModel<BulkRemoveAITagsResponseShape> */
    use SdkModel;

    use SdkResponse;

    /**
     * An array of fileIds that in which AITags were successfully removed.
     *
     * @var list<string>|null $successfullyUpdatedFileIds
     */
    #[Api(list: 'string', optional: true)]
    public ?array $successfullyUpdatedFileIds;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<string> $successfullyUpdatedFileIds
     */
    public static function with(?array $successfullyUpdatedFileIds = null): self
    {
        $obj = new self;

        null !== $successfullyUpdatedFileIds && $obj->successfullyUpdatedFileIds = $successfullyUpdatedFileIds;

        return $obj;
    }

    /**
     * An array of fileIds that in which AITags were successfully removed.
     *
     * @param list<string> $successfullyUpdatedFileIDs
     */
    public function withSuccessfullyUpdatedFileIDs(
        array $successfullyUpdatedFileIDs
    ): self {
        $obj = clone $this;
        $obj->successfullyUpdatedFileIds = $successfullyUpdatedFileIDs;

        return $obj;
    }
}
