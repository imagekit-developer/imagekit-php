<?php

declare(strict_types=1);

namespace ImageKit\Responses\Files\Purge;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\Model;
use ImageKit\Core\Contracts\BaseModel;

/**
 * @phpstan-type purge_execute_response_alias = array{requestID?: string}
 */
final class PurgeExecuteResponse implements BaseModel
{
    use Model;

    /**
     * Unique identifier of the purge request. This can be used to check the status of the purge request.
     */
    #[Api('requestId', optional: true)]
    public ?string $requestID;

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
    public static function from(?string $requestID = null): self
    {
        $obj = new self;

        null !== $requestID && $obj->requestID = $requestID;

        return $obj;
    }

    /**
     * Unique identifier of the purge request. This can be used to check the status of the purge request.
     */
    public function setRequestID(string $requestID): self
    {
        $this->requestID = $requestID;

        return $this;
    }
}
