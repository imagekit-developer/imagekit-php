<?php

declare(strict_types=1);

namespace ImageKit\Assets;

use ImageKit\Core\Attributes\Required;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;

/**
 * @phpstan-type AssetCopyResponseShape = array{jobID: string}
 */
final class AssetCopyResponse implements BaseModel
{
    /** @use SdkModel<AssetCopyResponseShape> */
    use SdkModel;

    /**
     * Unique identifier of the bulk copy folder job.
     */
    #[Required('job_id')]
    public string $jobID;

    /**
     * `new AssetCopyResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AssetCopyResponse::with(jobID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AssetCopyResponse)->withJobID(...)
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
     * Unique identifier of the bulk copy folder job.
     */
    public function withJobID(string $jobID): self
    {
        $self = clone $this;
        $self['jobID'] = $jobID;

        return $self;
    }
}
