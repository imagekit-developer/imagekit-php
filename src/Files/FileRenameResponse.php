<?php

declare(strict_types=1);

namespace Imagekit\Files;

use Imagekit\Core\Attributes\Api;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Concerns\SdkResponse;
use Imagekit\Core\Contracts\BaseModel;
use Imagekit\Core\Conversion\Contracts\ResponseConverter;

/**
 * @phpstan-type FileRenameResponseShape = array{purgeRequestId?: string|null}
 */
final class FileRenameResponse implements BaseModel, ResponseConverter
{
    /** @use SdkModel<FileRenameResponseShape> */
    use SdkModel;

    use SdkResponse;

    /**
     * Unique identifier of the purge request. This can be used to check the status of the purge request.
     */
    #[Api(optional: true)]
    public ?string $purgeRequestId;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?string $purgeRequestId = null): self
    {
        $obj = new self;

        null !== $purgeRequestId && $obj['purgeRequestId'] = $purgeRequestId;

        return $obj;
    }

    /**
     * Unique identifier of the purge request. This can be used to check the status of the purge request.
     */
    public function withPurgeRequestID(string $purgeRequestID): self
    {
        $obj = clone $this;
        $obj['purgeRequestId'] = $purgeRequestID;

        return $obj;
    }
}
