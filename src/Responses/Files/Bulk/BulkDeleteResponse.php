<?php

declare(strict_types=1);

namespace ImageKit\Responses\Files\Bulk;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;

final class BulkDeleteResponse implements BaseModel
{
    use SdkModel;

    /**
     * An array of fileIds that were successfully deleted.
     *
     * @var list<string>|null $successfullyDeletedFileIDs
     */
    #[Api('successfullyDeletedFileIds', list: 'string', optional: true)]
    public ?array $successfullyDeletedFileIDs;

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
