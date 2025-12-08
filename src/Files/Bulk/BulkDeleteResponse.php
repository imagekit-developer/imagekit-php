<?php

declare(strict_types=1);

namespace Imagekit\Files\Bulk;

use Imagekit\Core\Attributes\Api;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Concerns\SdkResponse;
use Imagekit\Core\Contracts\BaseModel;
use Imagekit\Core\Conversion\Contracts\ResponseConverter;

/**
 * @phpstan-type BulkDeleteResponseShape = array{
 *   successfullyDeletedFileIds?: list<string>|null
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
     * @var list<string>|null $successfullyDeletedFileIds
     */
    #[Api(list: 'string', optional: true)]
    public ?array $successfullyDeletedFileIds;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<string> $successfullyDeletedFileIds
     */
    public static function with(?array $successfullyDeletedFileIds = null): self
    {
        $obj = new self;

        null !== $successfullyDeletedFileIds && $obj['successfullyDeletedFileIds'] = $successfullyDeletedFileIds;

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
        $obj['successfullyDeletedFileIds'] = $successfullyDeletedFileIDs;

        return $obj;
    }
}
