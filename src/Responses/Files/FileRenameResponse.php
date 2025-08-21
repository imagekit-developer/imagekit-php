<?php

declare(strict_types=1);

namespace ImageKit\Responses\Files;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;

/**
 * @phpstan-type file_rename_response_alias = array{purgeRequestID?: string}
 */
final class FileRenameResponse implements BaseModel
{
    use SdkModel;

    /**
     * Unique identifier of the purge request. This can be used to check the status of the purge request.
     */
    #[Api('purgeRequestId', optional: true)]
    public ?string $purgeRequestID;

    public function __construct()
    {
        self::introspect();
        $this->unsetOptionalProperties();
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
