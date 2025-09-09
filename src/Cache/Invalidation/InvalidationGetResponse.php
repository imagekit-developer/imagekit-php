<?php

declare(strict_types=1);

namespace ImageKit\Cache\Invalidation;

use ImageKit\Cache\Invalidation\InvalidationGetResponse\Status;
use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;

/**
 * @phpstan-type invalidation_get_response = array{status?: value-of<Status>|null}
 */
final class InvalidationGetResponse implements BaseModel
{
    /** @use SdkModel<invalidation_get_response> */
    use SdkModel;

    /**
     * Status of the purge request.
     *
     * @var value-of<Status>|null $status
     */
    #[Api(enum: Status::class, optional: true)]
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
     * @param Status|value-of<Status> $status
     */
    public static function with(Status|string|null $status = null): self
    {
        $obj = new self;

        null !== $status && $obj->status = $status instanceof Status ? $status->value : $status;

        return $obj;
    }

    /**
     * Status of the purge request.
     *
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $obj = clone $this;
        $obj->status = $status instanceof Status ? $status->value : $status;

        return $obj;
    }
}
