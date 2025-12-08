<?php

declare(strict_types=1);

namespace Imagekit\Folders\Job;

use Imagekit\Core\Attributes\Api;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Contracts\BaseModel;
use Imagekit\Folders\Job\JobGetResponse\Status;
use Imagekit\Folders\Job\JobGetResponse\Type;

/**
 * @phpstan-type JobGetResponseShape = array{
 *   jobId?: string|null,
 *   purgeRequestId?: string|null,
 *   status?: value-of<Status>|null,
 *   type?: value-of<Type>|null,
 * }
 */
final class JobGetResponse implements BaseModel
{
    /** @use SdkModel<JobGetResponseShape> */
    use SdkModel;

    /**
     * Unique identifier of the bulk job.
     */
    #[Api(optional: true)]
    public ?string $jobId;

    /**
     * Unique identifier of the purge request. This will be present only if `purgeCache` is set to `true` in the rename folder API request.
     */
    #[Api(optional: true)]
    public ?string $purgeRequestId;

    /**
     * Status of the bulk job.
     *
     * @var value-of<Status>|null $status
     */
    #[Api(enum: Status::class, optional: true)]
    public ?string $status;

    /**
     * Type of the bulk job.
     *
     * @var value-of<Type>|null $type
     */
    #[Api(enum: Type::class, optional: true)]
    public ?string $type;

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
     * @param Type|value-of<Type> $type
     */
    public static function with(
        ?string $jobId = null,
        ?string $purgeRequestId = null,
        Status|string|null $status = null,
        Type|string|null $type = null,
    ): self {
        $obj = new self;

        null !== $jobId && $obj['jobId'] = $jobId;
        null !== $purgeRequestId && $obj['purgeRequestId'] = $purgeRequestId;
        null !== $status && $obj['status'] = $status;
        null !== $type && $obj['type'] = $type;

        return $obj;
    }

    /**
     * Unique identifier of the bulk job.
     */
    public function withJobID(string $jobID): self
    {
        $obj = clone $this;
        $obj['jobId'] = $jobID;

        return $obj;
    }

    /**
     * Unique identifier of the purge request. This will be present only if `purgeCache` is set to `true` in the rename folder API request.
     */
    public function withPurgeRequestID(string $purgeRequestID): self
    {
        $obj = clone $this;
        $obj['purgeRequestId'] = $purgeRequestID;

        return $obj;
    }

    /**
     * Status of the bulk job.
     *
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $obj = clone $this;
        $obj['status'] = $status;

        return $obj;
    }

    /**
     * Type of the bulk job.
     *
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $obj = clone $this;
        $obj['type'] = $type;

        return $obj;
    }
}
