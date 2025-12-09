<?php

declare(strict_types=1);

namespace Imagekit\Files\Bulk;

use Imagekit\Core\Attributes\Optional;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Contracts\BaseModel;

/**
 * @phpstan-type BulkAddTagsResponseShape = array{
 *   successfullyUpdatedFileIDs?: list<string>|null
 * }
 */
final class BulkAddTagsResponse implements BaseModel
{
    /** @use SdkModel<BulkAddTagsResponseShape> */
    use SdkModel;

    /**
     * An array of fileIds that in which tags were successfully added.
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
     * An array of fileIds that in which tags were successfully added.
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
