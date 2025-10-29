<?php

declare(strict_types=1);

namespace ImageKit\Folders;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Concerns\SdkResponse;
use ImageKit\Core\Contracts\BaseModel;
use ImageKit\Core\Conversion\Contracts\ResponseConverter;

/**
 * Job submitted successfully. A `jobId` will be returned.
 *
 * @phpstan-type FolderCopyResponseShape = array{jobID: string}
 */
final class FolderCopyResponse implements BaseModel, ResponseConverter
{
    /** @use SdkModel<FolderCopyResponseShape> */
    use SdkModel;

    use SdkResponse;

    /**
     * Unique identifier of the bulk job. This can be used to check the status of the bulk job.
     */
    #[Api('jobId')]
    public string $jobID;

    /**
     * `new FolderCopyResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * FolderCopyResponse::with(jobID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new FolderCopyResponse)->withJobID(...)
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
