<?php

declare(strict_types=1);

namespace ImageKit\Files;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Concerns\SdkResponse;
use ImageKit\Core\Contracts\BaseModel;
use ImageKit\Core\Conversion\Contracts\ResponseConverter;

/**
 * @phpstan-type file_rename_response = array{purgeRequestID?: string}
 */
final class FileRenameResponse implements BaseModel, ResponseConverter
{
    /** @use SdkModel<file_rename_response> */
    use SdkModel;

    use SdkResponse;

    /**
     * Unique identifier of the purge request. This can be used to check the status of the purge request.
     */
    #[Api('purgeRequestId', optional: true)]
    public ?string $purgeRequestID;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?string $purgeRequestID = null): self
    {
        $obj = new self;

        null !== $purgeRequestID && $obj->purgeRequestID = $purgeRequestID;

        return $obj;
    }

    /**
     * Unique identifier of the purge request. This can be used to check the status of the purge request.
     */
    public function withPurgeRequestID(string $purgeRequestID): self
    {
        $obj = clone $this;
        $obj->purgeRequestID = $purgeRequestID;

        return $obj;
    }
}
