<?php

declare(strict_types=1);

namespace ImageKit\Responses\BulkJobs;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\Model;
use ImageKit\Core\Contracts\BaseModel;

/**
 * @phpstan-type bulk_job_get_status_response_alias = array{
 *   jobID?: string, status?: string, type?: string
 * }
 */
final class BulkJobGetStatusResponse implements BaseModel
{
    use Model;

    /**
     * Unique identifier of the bulk job.
     */
    #[Api('jobId', optional: true)]
    public ?string $jobID;

    /**
     * Status of the bulk job. Possible values - `Pending`, `Completed`.
     */
    #[Api(optional: true)]
    public ?string $status;

    /**
     * Type of the bulk job. Possible values - `COPY_FOLDER`, `MOVE_FOLDER`.
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
    public static function from(
        ?string $jobID = null,
        ?string $status = null,
        ?string $type = null
    ): self {
        $obj = new self;

        null !== $jobID && $obj->jobID = $jobID;
        null !== $status && $obj->status = $status;
        null !== $type && $obj->type = $type;

        return $obj;
    }

    /**
     * Unique identifier of the bulk job.
     */
    public function setJobID(string $jobID): self
    {
        $this->jobID = $jobID;

        return $this;
    }

    /**
     * Status of the bulk job. Possible values - `Pending`, `Completed`.
     */
    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Type of the bulk job. Possible values - `COPY_FOLDER`, `MOVE_FOLDER`.
     */
    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }
}
