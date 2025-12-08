<?php

declare(strict_types=1);

namespace Imagekit\Folders;

use Imagekit\Core\Attributes\Required;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Contracts\BaseModel;

/**
 * Job submitted successfully. A `jobId` will be returned.
 *
 * @phpstan-type FolderRenameResponseShape = array{jobId: string}
 */
final class FolderRenameResponse implements BaseModel
{
    /** @use SdkModel<FolderRenameResponseShape> */
    use SdkModel;

    /**
     * Unique identifier of the bulk job. This can be used to check the status of the bulk job.
     */
    #[Required]
    public string $jobId;

    /**
     * `new FolderRenameResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * FolderRenameResponse::with(jobId: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new FolderRenameResponse)->withJobID(...)
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
    public static function with(string $jobId): self
    {
        $obj = new self;

        $obj['jobId'] = $jobId;

        return $obj;
    }

    /**
     * Unique identifier of the bulk job. This can be used to check the status of the bulk job.
     */
    public function withJobID(string $jobID): self
    {
        $obj = clone $this;
        $obj['jobId'] = $jobID;

        return $obj;
    }
}
