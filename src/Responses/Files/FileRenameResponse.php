<?php

declare(strict_types=1);

namespace ImageKit\Responses\Files;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\Model;
use ImageKit\Core\Contracts\BaseModel;

/**
 * @phpstan-type file_rename_response_alias = array{purgeRequestID?: string}
 */
final class FileRenameResponse implements BaseModel
{
    use Model;

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
    public static function new(?string $purgeRequestID = null): self
    {
        $obj = new self;

        null !== $purgeRequestID && $obj->purgeRequestID = $purgeRequestID;

        return $obj;
    }

    /**
     * Unique identifier of the purge request. This can be used to check the status of the purge request.
     */
    public function setPurgeRequestID(string $purgeRequestID): self
    {
        $this->purgeRequestID = $purgeRequestID;

        return $this;
    }
}
