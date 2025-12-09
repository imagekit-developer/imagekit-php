<?php

declare(strict_types=1);

namespace Imagekit\Files\Bulk;

use Imagekit\Core\Attributes\Optional;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Contracts\BaseModel;

/**
 * @phpstan-type BulkRemoveTagsResponseShape = array{
 *   successfullyUpdatedFileIDs?: list<string>|null
 * }
 */
final class BulkRemoveTagsResponse implements BaseModel
{
    /** @use SdkModel<BulkRemoveTagsResponseShape> */
    use SdkModel;

    /**
     * An array of fileIds that in which tags were successfully removed.
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
     * @param list<string> $successfullyUpdatedFileIDs
     */
    public static function with(?array $successfullyUpdatedFileIDs = null): self
    {
        $self = new self;

        null !== $successfullyUpdatedFileIDs && $self['successfullyUpdatedFileIDs'] = $successfullyUpdatedFileIDs;

        return $self;
    }

    /**
     * An array of fileIds that in which tags were successfully removed.
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
