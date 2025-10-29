<?php

declare(strict_types=1);

namespace ImageKit\Cache\Invalidation;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Concerns\SdkResponse;
use ImageKit\Core\Contracts\BaseModel;
use ImageKit\Core\Conversion\Contracts\ResponseConverter;

/**
 * @phpstan-type InvalidationNewResponseShape = array{requestID?: string}
 */
final class InvalidationNewResponse implements BaseModel, ResponseConverter
{
    /** @use SdkModel<InvalidationNewResponseShape> */
    use SdkModel;

    use SdkResponse;

    /**
     * Unique identifier of the purge request. This can be used to check the status of the purge request.
     */
    #[Api('requestId', optional: true)]
    public ?string $requestID;

    public function __construct()
    {
        $this->initialize();
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
