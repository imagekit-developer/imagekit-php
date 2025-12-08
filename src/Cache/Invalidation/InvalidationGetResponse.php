<?php

declare(strict_types=1);

namespace Imagekit\Cache\Invalidation;

use Imagekit\Cache\Invalidation\InvalidationGetResponse\Status;
use Imagekit\Core\Attributes\Api;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Contracts\BaseModel;

/**
 * @phpstan-type InvalidationGetResponseShape = array{
 *   status?: value-of<Status>|null
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

        null !== $status && $obj['status'] = $status;

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
        $obj['status'] = $status;

        return $obj;
    }
}
