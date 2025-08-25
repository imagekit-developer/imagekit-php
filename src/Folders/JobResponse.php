<?php

declare(strict_types=1);

namespace ImageKit\Folders;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;

/**
 * Job submitted successfully. A `jobId` will be returned.
 */
final class JobResponse implements BaseModel
{
    use SdkModel;

    /**
     * Unique identifier of the bulk job. This can be used to check the status of the bulk job.
     */
    #[Api('jobId')]
    public string $jobID;

    /**
     * `new JobResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * JobResponse::with(jobID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new JobResponse)->withJobID(...)
     * ```
     */
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
    public static function with(string $jobID): self
    {
        $obj = new self;

        $obj->jobID = $jobID;

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
