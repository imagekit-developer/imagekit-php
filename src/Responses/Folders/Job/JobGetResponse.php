<?php

declare(strict_types=1);

namespace ImageKit\Responses\Folders\Job;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\Model;
use ImageKit\Core\Contracts\BaseModel;

/**
 * @phpstan-type job_get_response_alias = array{
 *   jobID?: string, purgeRequestID?: string, status?: string, type?: string
 * }
 */
final class JobGetResponse implements BaseModel
{
    use Model;

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
     * Status of the bulk job. Possible values - `Pending`, `Completed`.
     */
    #[Api(optional: true)]
    public ?string $status;

    /**
     * Type of the bulk job. Possible values - `COPY_FOLDER`, `MOVE_FOLDER`, `RENAME_FOLDER`.
     */
    #[Api(optional: true)]
    public ?string $type;

    public function __construct()
    {
        self::introspect();
        $this->unsetOptionalProperties();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(
        ?string $jobID = null,
        ?string $purgeRequestID = null,
        ?string $status = null,
        ?string $type = null,
    ): self {
        $obj = new self;

        null !== $jobID && $obj->jobID = $jobID;
        null !== $purgeRequestID && $obj->purgeRequestID = $purgeRequestID;
        null !== $status && $obj->status = $status;
        null !== $type && $obj->type = $type;

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
     * Status of the bulk job. Possible values - `Pending`, `Completed`.
     */
    public function withStatus(string $status): self
    {
        $obj = clone $this;
        $obj->status = $status;

        return $obj;
    }

    /**
     * Type of the bulk job. Possible values - `COPY_FOLDER`, `MOVE_FOLDER`, `RENAME_FOLDER`.
     */
    public function withType(string $type): self
    {
        $obj = clone $this;
        $obj->type = $type;

        return $obj;
    }
}
