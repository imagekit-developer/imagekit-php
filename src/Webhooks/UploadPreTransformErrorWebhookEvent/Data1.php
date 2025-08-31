<?php

declare(strict_types=1);

namespace ImageKit\Webhooks\UploadPreTransformErrorWebhookEvent;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;
use ImageKit\Webhooks\UploadPreTransformErrorWebhookEvent\Data\Transformation;

/**
 * @phpstan-type data_alias = array{
 *   name: string, path: string, transformation: Transformation
 * }
 */
final class Data implements BaseModel
{
    /** @use SdkModel<data_alias> */
    use SdkModel;

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
     * `new Data()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Data::with(name: ..., path: ..., transformation: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Data)->withName(...)->withPath(...)->withTransformation(...)
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
        string $name,
        string $path,
        Transformation $transformation
    ): self {
        $obj = new self;

        $obj->name = $name;
        $obj->path = $path;
        $obj->transformation = $transformation;

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
}
