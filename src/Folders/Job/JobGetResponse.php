<?php

declare(strict_types=1);

namespace ImageKit\Folders\Job;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Concerns\SdkResponse;
use ImageKit\Core\Contracts\BaseModel;
use ImageKit\Core\Conversion\Contracts\ResponseConverter;
use ImageKit\Folders\Job\JobGetResponse\Status;
use ImageKit\Folders\Job\JobGetResponse\Type;

/**
 * @phpstan-type JobGetResponseShape = array{
 *   jobID?: string,
 *   purgeRequestID?: string,
 *   status?: value-of<Status>,
 *   type?: value-of<Type>,
 * }
 */
final class JobGetResponse implements BaseModel, ResponseConverter
{
    /** @use SdkModel<JobGetResponseShape> */
    use SdkModel;

    use SdkResponse;

    /**
     * Unique identifier of the bulk job.
     */
    #[Api('jobId', optional: true)]
    public ?string $jobID;

    /**
     * Unique identifier of the purge request. This will be present only if `purgeCache` is set to `true` in the rename folder API request.
     */
    #[Api('purgeRequestId', optional: true)]
    public ?string $purgeRequestID;

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
        ?string $jobID = null,
        ?string $purgeRequestID = null,
        Status|string|null $status = null,
        Type|string|null $type = null,
    ): self {
        $obj = new self;

        null !== $jobID && $obj->jobID = $jobID;
        null !== $purgeRequestID && $obj->purgeRequestID = $purgeRequestID;
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
        $obj->jobID = $jobID;

        return $obj;
    }

    /**
     * Unique identifier of the purge request. This will be present only if `purgeCache` is set to `true` in the rename folder API request.
     */
    public function withPurgeRequestID(string $purgeRequestID): self
    {
        $obj = clone $this;
        $obj->purgeRequestID = $purgeRequestID;

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
