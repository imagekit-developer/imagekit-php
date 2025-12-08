<?php

declare(strict_types=1);

namespace Imagekit\Files\Bulk;

use Imagekit\Core\Attributes\Api;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Concerns\SdkResponse;
use Imagekit\Core\Contracts\BaseModel;
use Imagekit\Core\Conversion\Contracts\ResponseConverter;

/**
 * @phpstan-type BulkAddTagsResponseShape = array{
 *   successfullyUpdatedFileIds?: list<string>|null
 * }
 */
final class BulkAddTagsResponse implements BaseModel, ResponseConverter
{
    /** @use SdkModel<BulkAddTagsResponseShape> */
    use SdkModel;

    use SdkResponse;

    /**
     * An array of fileIds that in which tags were successfully added.
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

        null !== $successfullyUpdatedFileIds && $obj['successfullyUpdatedFileIds'] = $successfullyUpdatedFileIds;

        return $obj;
    }

    /**
     * An array of fileIds that in which tags were successfully added.
     *
     * @param list<string> $successfullyUpdatedFileIDs
     */
    public function withSuccessfullyUpdatedFileIDs(
        array $successfullyUpdatedFileIDs
    ): self {
        $obj = clone $this;
        $obj['successfullyUpdatedFileIds'] = $successfullyUpdatedFileIDs;

        return $obj;
    }
}
