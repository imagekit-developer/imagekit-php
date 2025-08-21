<?php

declare(strict_types=1);

namespace ImageKit\Responses\Cache\Invalidation;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;

/**
 * @phpstan-type invalidation_new_response_alias = array{requestID?: string}
 */
final class InvalidationNewResponse implements BaseModel
{
    use SdkModel;

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
    public static function with(?string $requestID = null): self
    {
        $obj = new self;

        null !== $requestID && $obj->requestID = $requestID;

        return $obj;
    }

    /**
     * Unique identifier of the purge request. This can be used to check the status of the purge request.
     */
    public function withRequestID(string $requestID): self
    {
        $obj = clone $this;
        $obj->requestID = $requestID;

        return $obj;
    }
}
