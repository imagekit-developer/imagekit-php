<?php

declare(strict_types=1);

namespace ImageKit\Responses\Files;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\Model;
use ImageKit\Core\Contracts\BaseModel;
use ImageKit\Core\Conversion\ListOf;

/**
 * @phpstan-type file_remove_tags_response_alias = array{
 *   successfullyUpdatedFileIDs?: list<string>
 * }
 */
final class FileRemoveTagsResponse implements BaseModel
{
    use Model;

    /**
     * An array of fileIds that in which tags were successfully removed.
     *
     * @var null|list<string> $successfullyUpdatedFileIDs
     */
    #[Api(
        'successfullyUpdatedFileIds',
        type: new ListOf('string'),
        optional: true
    )]
    public ?array $successfullyUpdatedFileIDs;

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
     * @param null|list<string> $successfullyUpdatedFileIDs
     */
    public static function new(?array $successfullyUpdatedFileIDs = null): self
    {
        $obj = new self;

        null !== $successfullyUpdatedFileIDs && $obj->successfullyUpdatedFileIDs = $successfullyUpdatedFileIDs;

        return $obj;
    }

    /**
     * An array of fileIds that in which tags were successfully removed.
     *
     * @param list<string> $successfullyUpdatedFileIDs
     */
    public function setSuccessfullyUpdatedFileIDs(
        array $successfullyUpdatedFileIDs
    ): self {
        $this->successfullyUpdatedFileIDs = $successfullyUpdatedFileIDs;

        return $this;
    }
}
