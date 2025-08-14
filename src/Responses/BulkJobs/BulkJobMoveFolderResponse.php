<?php

declare(strict_types=1);

namespace ImageKit\Responses\BulkJobs;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\Model;
use ImageKit\Core\Contracts\BaseModel;

/**
 * @phpstan-type bulk_job_move_folder_response_alias = array{jobID?: string}
 */
final class BulkJobMoveFolderResponse implements BaseModel
{
    use Model;

    /**
     * Unique identifier of the bulk job. This can be used to check the status of the bulk job.
     */
    #[Api('jobId', optional: true)]
    public ?string $jobID;

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
    public static function with(?string $jobID = null): self
    {
        $obj = new self;

        null !== $jobID && $obj->jobID = $jobID;

        return $obj;
    }

    /**
     * Unique identifier of the bulk job. This can be used to check the status of the bulk job.
     */
    public function withJobID(string $jobID): self
    {
        $obj = clone $this;
        $obj->jobID = $jobID;

        return $obj;
    }
}
