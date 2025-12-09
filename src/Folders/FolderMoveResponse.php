<?php

declare(strict_types=1);

namespace Imagekit\Folders;

use Imagekit\Core\Attributes\Required;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Contracts\BaseModel;

/**
 * Job submitted successfully. A `jobId` will be returned.
 *
 * @phpstan-type FolderMoveResponseShape = array{jobID: string}
 */
final class FolderMoveResponse implements BaseModel
{
    /** @use SdkModel<FolderMoveResponseShape> */
    use SdkModel;

    /**
     * Unique identifier of the bulk job. This can be used to check the status of the bulk job.
     */
    #[Required('jobId')]
    public string $jobID;

    /**
     * `new FolderMoveResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * FolderMoveResponse::with(jobID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new FolderMoveResponse)->withJobID(...)
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
        $self = new self;

        $self['jobID'] = $jobID;

        return $self;
    }

    /**
     * Unique identifier of the bulk job. This can be used to check the status of the bulk job.
     */
    public function withJobID(string $jobID): self
    {
        $self = clone $this;
        $self['jobID'] = $jobID;

        return $self;
    }
}
