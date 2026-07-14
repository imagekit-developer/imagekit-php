<?php

declare(strict_types=1);

namespace ImageKit\Webhooks\UploadPostTransformSuccessEvent;

use ImageKit\Core\Attributes\Required;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;

/**
 * @phpstan-type DataShape = array{fileID: string, name: string, url: string}
 */
final class Data implements BaseModel
{
    /** @use SdkModel<DataShape> */
    use SdkModel;

    /**
     * Unique identifier of the originally uploaded file.
     */
    #[Required('fileId')]
    public string $fileID;

    /**
     * Name of the file.
     */
    #[Required]
    public string $name;

    /**
     * URL of the generated post-transformation.
     */
    #[Required]
    public string $url;

    /**
     * `new Data()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Data::with(fileID: ..., name: ..., url: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Data)->withFileID(...)->withName(...)->withURL(...)
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
    public static function with(string $fileID, string $name, string $url): self
    {
        $self = new self;

        $self['fileID'] = $fileID;
        $self['name'] = $name;
        $self['url'] = $url;

        return $self;
    }

    /**
     * Unique identifier of the originally uploaded file.
     */
    public function withFileID(string $fileID): self
    {
        $self = clone $this;
        $self['fileID'] = $fileID;

        return $self;
    }

    /**
     * Name of the file.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * URL of the generated post-transformation.
     */
    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }
}
