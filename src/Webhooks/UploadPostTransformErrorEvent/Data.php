<?php

declare(strict_types=1);

namespace ImageKit\Webhooks\UploadPostTransformErrorEvent;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;
use ImageKit\Webhooks\UploadPostTransformErrorEvent\Data\Transformation;

/**
 * @phpstan-type data_alias = array{
 *   fileID: string,
 *   name: string,
 *   path: string,
 *   transformation: Transformation,
 *   url: string,
 * }
 */
final class Data implements BaseModel
{
    /** @use SdkModel<data_alias> */
    use SdkModel;

    /**
     * Unique identifier of the originally uploaded file.
     */
    #[Api('fileId')]
    public string $fileID;

    /**
     * Name of the file.
     */
    #[Api]
    public string $name;

    /**
     * Path of the file.
     */
    #[Api]
    public string $path;

    #[Api]
    public Transformation $transformation;

    /**
     * URL of the attempted post-transformation.
     */
    #[Api]
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
     */
    public static function with(
        string $fileID,
        string $name,
        string $path,
        Transformation $transformation,
        string $url,
    ): self {
        $obj = new self;

        $obj->fileID = $fileID;
        $obj->name = $name;
        $obj->path = $path;
        $obj->transformation = $transformation;
        $obj->url = $url;

        return $obj;
    }

    /**
     * Unique identifier of the originally uploaded file.
     */
    public function withFileID(string $fileID): self
    {
        $obj = clone $this;
        $obj->fileID = $fileID;

        return $obj;
    }

    /**
     * Name of the file.
     */
    public function withName(string $name): self
    {
        $obj = clone $this;
        $obj->name = $name;

        return $obj;
    }

    /**
     * Path of the file.
     */
    public function withPath(string $path): self
    {
        $obj = clone $this;
        $obj->path = $path;

        return $obj;
    }

    public function withTransformation(Transformation $transformation): self
    {
        $obj = clone $this;
        $obj->transformation = $transformation;

        return $obj;
    }

    /**
     * URL of the attempted post-transformation.
     */
    public function withURL(string $url): self
    {
        $obj = clone $this;
        $obj->url = $url;

        return $obj;
    }
}
