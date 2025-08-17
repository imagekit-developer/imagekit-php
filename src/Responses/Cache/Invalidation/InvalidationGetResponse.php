<?php

declare(strict_types=1);

namespace ImageKit\Responses\Cache\Invalidation;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\Model;
use ImageKit\Core\Contracts\BaseModel;
use ImageKit\Responses\Cache\Invalidation\InvalidationGetResponse\Status;

/**
 * @phpstan-type invalidation_get_response_alias = array{status?: Status::*}
 */
final class InvalidationGetResponse implements BaseModel
{
    use Model;

    /**
     * Status of the purge request.
     *
     * @var null|Status::* $status
     */
    #[Api(enum: Status::class, optional: true)]
    public ?string $status;

    public function __construct()
    {
        self::introspect();
        $this->unsetOptionalProperties();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param null|Status::* $status
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
