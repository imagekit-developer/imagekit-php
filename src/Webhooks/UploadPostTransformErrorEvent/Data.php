<?php

declare(strict_types=1);

namespace ImageKit\Webhooks\UploadPostTransformErrorEvent;

use ImageKit\Core\Attributes\Required;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;
use ImageKit\Webhooks\UploadPostTransformErrorEvent\Data\Transformation;

/**
 * @phpstan-import-type TransformationShape from \ImageKit\Webhooks\UploadPostTransformErrorEvent\Data\Transformation
 *
 * @phpstan-type DataShape = array{
 *   fileID: string,
 *   name: string,
 *   path: string,
 *   transformation: Transformation|TransformationShape,
 *   url: string,
 * }
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
     * Path of the file.
     */
    #[Required]
    public string $path;

    #[Required]
    public Transformation $transformation;

    /**
     * URL of the attempted post-transformation.
     */
    #[Required]
    public string $url;

    /**
     * `new Data()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Data::with(fileID: ..., name: ..., path: ..., transformation: ..., url: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Data)
     *   ->withFileID(...)
     *   ->withName(...)
     *   ->withPath(...)
     *   ->withTransformation(...)
     *   ->withURL(...)
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
     *
     * @param Transformation|TransformationShape $transformation
     */
    public static function with(
        string $fileID,
        string $name,
        string $path,
        Transformation|array $transformation,
        string $url,
    ): self {
        $self = new self;

        $self['fileID'] = $fileID;
        $self['name'] = $name;
        $self['path'] = $path;
        $self['transformation'] = $transformation;
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
     * Path of the file.
     */
    public function withPath(string $path): self
    {
        $self = clone $this;
        $self['path'] = $path;

        return $self;
    }

    /**
     * @param Transformation|TransformationShape $transformation
     */
    public function withTransformation(
        Transformation|array $transformation
    ): self {
        $self = clone $this;
        $self['transformation'] = $transformation;

        return $self;
    }

    /**
     * URL of the attempted post-transformation.
     */
    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }
}
