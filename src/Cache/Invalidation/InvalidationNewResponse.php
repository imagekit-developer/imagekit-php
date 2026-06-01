<?php

declare(strict_types=1);

namespace ImageKit\Cache\Invalidation;

use ImageKit\Core\Attributes\Optional;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;

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
    #[Optional('request_id')]
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
        $self = new self;

        null !== $requestID && $self['requestID'] = $requestID;

        return $self;
    }

    /**
     * Unique identifier of the purge request. This can be used to check the status of the purge request.
     */
    public function withRequestID(string $requestID): self
    {
        $self = clone $this;
        $self['requestID'] = $requestID;

        return $self;
    }
}
