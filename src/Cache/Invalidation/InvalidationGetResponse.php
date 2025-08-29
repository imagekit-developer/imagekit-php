<?php

declare(strict_types=1);

namespace ImageKit\Cache\Invalidation;

use ImageKit\Cache\Invalidation\InvalidationGetResponse\Status;
use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;

/**
 * @phpstan-type invalidation_get_response = array{status?: Status::*|null}
 */
final class InvalidationGetResponse implements BaseModel
{
    /** @use SdkModel<invalidation_get_response> */
    use SdkModel;

    /**
     * Status of the purge request.
     *
     * @var Status::*|null $status
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
     * @param Status::* $status
     */
    public static function with(?string $status = null): self
    {
        $obj = new self;

        null !== $status && $obj->status = $status;

        return $obj;
    }

    /**
     * Status of the purge request.
     *
     * @param Status::* $status
     */
    public function withStatus(string $status): self
    {
        $obj = clone $this;
        $obj->status = $status;

        return $obj;
    }
}
