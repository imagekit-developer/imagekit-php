<?php

declare(strict_types=1);

namespace ImageKit\Folders\Job;

use ImageKit\Core\Attributes\Optional;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;
use ImageKit\Folders\Job\JobGetResponse\Status;
use ImageKit\Folders\Job\JobGetResponse\Type;

/**
 * @phpstan-type JobGetResponseShape = array{
 *   jobID?: string|null,
 *   purgeRequestID?: string|null,
 *   status?: null|Status|value-of<Status>,
 *   type?: null|Type|value-of<Type>,
 * }
 */
final class JobGetResponse implements BaseModel
{
    /** @use SdkModel<JobGetResponseShape> */
    use SdkModel;

    /**
     * Unique identifier of the bulk job.
     */
    #[Optional('jobId')]
    public ?string $jobID;

    /**
     * Unique identifier of the purge request. This will be present only if `purgeCache` is set to `true` in the rename folder API request.
     */
    #[Optional('purgeRequestId')]
    public ?string $purgeRequestID;

    /**
     * Status of the bulk job.
     *
     * @var value-of<Status>|null $status
     */
    #[Optional(enum: Status::class)]
    public ?string $status;

    /**
     * Type of the bulk job.
     *
     * @var value-of<Type>|null $type
     */
    #[Optional(enum: Type::class)]
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
     * @param Status|value-of<Status>|null $status
     * @param Type|value-of<Type>|null $type
     */
    public static function with(
        ?string $jobID = null,
        ?string $purgeRequestID = null,
        Status|string|null $status = null,
        Type|string|null $type = null,
    ): self {
        $self = new self;

        null !== $jobID && $self['jobID'] = $jobID;
        null !== $purgeRequestID && $self['purgeRequestID'] = $purgeRequestID;
        null !== $status && $self['status'] = $status;
        null !== $type && $self['type'] = $type;

        return $self;
    }

    /**
     * Unique identifier of the bulk job.
     */
    public function withJobID(string $jobID): self
    {
        $self = clone $this;
        $self['jobID'] = $jobID;

        return $self;
    }

    /**
     * Unique identifier of the purge request. This will be present only if `purgeCache` is set to `true` in the rename folder API request.
     */
    public function withPurgeRequestID(string $purgeRequestID): self
    {
        $self = clone $this;
        $self['purgeRequestID'] = $purgeRequestID;

        return $self;
    }

    /**
     * Status of the bulk job.
     *
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    /**
     * Type of the bulk job.
     *
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
