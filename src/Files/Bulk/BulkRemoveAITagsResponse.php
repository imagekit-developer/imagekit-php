<?php

declare(strict_types=1);

namespace ImageKit\Files\Bulk;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Concerns\SdkResponse;
use ImageKit\Core\Contracts\BaseModel;
use ImageKit\Core\Conversion\Contracts\ResponseConverter;

/**
 * @phpstan-type bulk_remove_ai_tags_response = array{
 *   successfullyUpdatedFileIDs?: list<string>
 * }
 */
final class BulkRemoveAITagsResponse implements BaseModel, ResponseConverter
{
    /** @use SdkModel<bulk_remove_ai_tags_response> */
    use SdkModel;

    use SdkResponse;

    /**
     * An array of fileIds that in which AITags were successfully removed.
     *
     * @var list<string>|null $successfullyUpdatedFileIDs
     */
    #[Api('successfullyUpdatedFileIds', list: 'string', optional: true)]
    public ?array $successfullyUpdatedFileIDs;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<string> $successfullyUpdatedFileIDs
     */
    public static function with(?array $successfullyUpdatedFileIDs = null): self
    {
        $obj = new self;

        null !== $successfullyUpdatedFileIDs && $obj->successfullyUpdatedFileIDs = $successfullyUpdatedFileIDs;

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
        $obj->successfullyUpdatedFileIDs = $successfullyUpdatedFileIDs;

        return $obj;
    }
}
