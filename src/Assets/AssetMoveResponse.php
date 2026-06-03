<?php

declare(strict_types=1);

namespace ImageKit\Assets;

use ImageKit\Core\Attributes\Required;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;

/**
 * @phpstan-type AssetMoveResponseShape = array{jobID: string}
 */
final class AssetMoveResponse implements BaseModel
{
    /** @use SdkModel<AssetMoveResponseShape> */
    use SdkModel;

    /**
     * Unique identifier of the bulk move folder job.
     */
    #[Required('job_id')]
    public string $jobID;

    /**
     * `new AssetMoveResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AssetMoveResponse::with(jobID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AssetMoveResponse)->withJobID(...)
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
     * Unique identifier of the bulk move folder job.
     */
    public function withJobID(string $jobID): self
    {
        $self = clone $this;
        $self['jobID'] = $jobID;

        return $self;
    }
}
