<?php

declare(strict_types=1);

namespace ImageKit\Assets\Jobs;

use ImageKit\Assets\Jobs\JobGetResponse\Status;
use ImageKit\Assets\Jobs\JobGetResponse\Type;
use ImageKit\Core\Attributes\Optional;
use ImageKit\Core\Attributes\Required;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;

/**
 * @phpstan-type JobGetResponseShape = array{
 *   jobID: string,
 *   status: Status|value-of<Status>,
 *   type: Type|value-of<Type>,
 *   purgeRequestID?: string|null,
 * }
 */
final class JobGetResponse implements BaseModel
{
    /** @use SdkModel<JobGetResponseShape> */
    use SdkModel;

    /**
     * Unique identifier of the bulk job.
     */
    #[Required('job_id')]
    public string $jobID;

    /**
     * Status of the bulk job.
     *
     * @var value-of<Status> $status
     */
    #[Required(enum: Status::class)]
    public string $status;

    /**
     * Type of the bulk job.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * Unique identifier of the purge request. Present only if `purge_cache` was set to `true` in the rename folder API request.
     */
    #[Optional('purge_request_id')]
    public ?string $purgeRequestID;

    /**
     * `new JobGetResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * JobGetResponse::with(jobID: ..., status: ..., type: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new JobGetResponse)->withJobID(...)->withStatus(...)->withType(...)
     * ```
     */
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
        string $jobID,
        Status|string $status,
        Type|string $type,
        ?string $purgeRequestID = null,
    ): self {
        $self = new self;

        $self['jobID'] = $jobID;
        $self['status'] = $status;
        $self['type'] = $type;

        null !== $purgeRequestID && $self['purgeRequestID'] = $purgeRequestID;

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

    /**
     * Unique identifier of the purge request. Present only if `purge_cache` was set to `true` in the rename folder API request.
     */
    public function withPurgeRequestID(string $purgeRequestID): self
    {
        $self = clone $this;
        $self['purgeRequestID'] = $purgeRequestID;

        return $self;
    }
}
