<?php

declare(strict_types=1);

namespace Imagekit\Cache\Invalidation;

use Imagekit\Cache\Invalidation\InvalidationGetResponse\Status;
use Imagekit\Core\Attributes\Optional;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Contracts\BaseModel;

/**
 * @phpstan-type InvalidationGetResponseShape = array{
 *   status?: null|Status|value-of<Status>
 * }
 */
final class InvalidationGetResponse implements BaseModel
{
    /** @use SdkModel<InvalidationGetResponseShape> */
    use SdkModel;

    /**
     * Status of the purge request.
     *
     * @var value-of<Status>|null $status
     */
    #[Optional(enum: Status::class)]
    public ?string $status;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Status|value-of<Status>|null $status
     */
    public static function with(Status|string|null $status = null): self
    {
        $self = new self;

        null !== $status && $self['status'] = $status;

        return $self;
    }

    /**
     * Status of the purge request.
     *
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }
}
