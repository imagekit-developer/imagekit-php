<?php

declare(strict_types=1);

namespace ImageKit\Files\Bulk;

use ImageKit\Core\Attributes\Optional;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;

/**
 * @phpstan-type BulkDeleteResponseShape = array{
 *   successfullyDeletedFileIDs?: list<string>|null
 * }
 */
final class BulkDeleteResponse implements BaseModel
{
    /** @use SdkModel<BulkDeleteResponseShape> */
    use SdkModel;

    /**
     * An array of fileIds that were successfully deleted.
     *
     * @var list<string>|null $successfullyDeletedFileIDs
     */
    #[Optional('successfullyDeletedFileIds', list: 'string')]
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
     * @param list<string>|null $successfullyDeletedFileIDs
     */
    public static function with(?array $successfullyDeletedFileIDs = null): self
    {
        $self = new self;

        null !== $successfullyDeletedFileIDs && $self['successfullyDeletedFileIDs'] = $successfullyDeletedFileIDs;

        return $self;
    }

    /**
     * An array of fileIds that were successfully deleted.
     *
     * @param list<string> $successfullyDeletedFileIDs
     */
    public function withSuccessfullyDeletedFileIDs(
        array $successfullyDeletedFileIDs
    ): self {
        $self = clone $this;
        $self['successfullyDeletedFileIDs'] = $successfullyDeletedFileIDs;

        return $self;
    }
}
