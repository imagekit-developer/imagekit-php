<?php

declare(strict_types=1);

namespace Imagekit\Cache\Invalidation;

use Imagekit\Core\Attributes\Optional;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Contracts\BaseModel;

/**
 * @phpstan-type InvalidationNewResponseShape = array{requestID?: string|null}
 */
final class InvalidationNewResponse implements BaseModel
{
    /** @use SdkModel<InvalidationNewResponseShape> */
    use SdkModel;

    /**
     * Unique identifier of the purge request. This can be used to check the status of the purge request.
     */
    #[Optional('requestId')]
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

        null !== $requestID && $obj['requestID'] = $requestID;

        return $obj;
    }

    /**
     * Unique identifier of the purge request. This can be used to check the status of the purge request.
     */
    public function withRequestID(string $requestID): self
    {
        $obj = clone $this;
        $obj['requestID'] = $requestID;

        return $obj;
    }
}
