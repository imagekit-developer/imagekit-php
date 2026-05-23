<?php

declare(strict_types=1);

namespace ImageKit\Files\Bulk;

use ImageKit\Core\Attributes\Optional;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;

/**
 * @phpstan-type BulkRemoveAITagsResponseShape = array{
 *   successfullyUpdatedFileIDs?: list<string>|null
 * }
 */
final class BulkRemoveAITagsResponse implements BaseModel
{
    /** @use SdkModel<BulkRemoveAITagsResponseShape> */
    use SdkModel;

    /**
     * An array of fileIds that in which AITags were successfully removed.
     *
     * @var list<string>|null $successfullyUpdatedFileIDs
     */
    #[Optional('successfullyUpdatedFileIds', list: 'string')]
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
     * @param list<string>|null $successfullyUpdatedFileIDs
     */
    public static function with(?array $successfullyUpdatedFileIDs = null): self
    {
        $self = new self;

        null !== $successfullyUpdatedFileIDs && $self['successfullyUpdatedFileIDs'] = $successfullyUpdatedFileIDs;

        return $self;
    }

    /**
     * An array of fileIds that in which AITags were successfully removed.
     *
     * @param list<string> $successfullyUpdatedFileIDs
     */
    public function withSuccessfullyUpdatedFileIDs(
        array $successfullyUpdatedFileIDs
    ): self {
        $self = clone $this;
        $self['successfullyUpdatedFileIDs'] = $successfullyUpdatedFileIDs;

        return $self;
    }
}
