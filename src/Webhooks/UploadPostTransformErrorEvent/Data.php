<?php

declare(strict_types=1);

namespace Imagekit\Webhooks\UploadPostTransformErrorEvent;

use Imagekit\Core\Attributes\Required;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Contracts\BaseModel;
use Imagekit\Webhooks\UploadPostTransformErrorEvent\Data\Transformation;
use Imagekit\Webhooks\UploadPostTransformErrorEvent\Data\Transformation\Error;

/**
 * @phpstan-type DataShape = array{
 *   fileId: string,
 *   name: string,
 *   path: string,
 *   transformation: Transformation,
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
    #[Required]
    public string $fileId;

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
     * Data::with(fileId: ..., name: ..., path: ..., transformation: ..., url: ...)
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
     * @param Transformation|array{error: Error} $transformation
     */
    public static function with(
        string $fileId,
        string $name,
        string $path,
        Transformation|array $transformation,
        string $url,
    ): self {
        $obj = new self;

        $obj['fileId'] = $fileId;
        $obj['name'] = $name;
        $obj['path'] = $path;
        $obj['transformation'] = $transformation;
        $obj['url'] = $url;

        return $obj;
    }

    /**
     * Unique identifier of the originally uploaded file.
     */
    public function withFileID(string $fileID): self
    {
        $obj = clone $this;
        $obj['fileId'] = $fileID;

        return $obj;
    }

    /**
     * Name of the file.
     */
    public function withName(string $name): self
    {
        $obj = clone $this;
        $obj['name'] = $name;

        return $obj;
    }

    /**
     * Path of the file.
     */
    public function withPath(string $path): self
    {
        $obj = clone $this;
        $obj['path'] = $path;

        return $obj;
    }

    /**
     * @param Transformation|array{error: Error} $transformation
     */
    public function withTransformation(
        Transformation|array $transformation
    ): self {
        $obj = clone $this;
        $obj['transformation'] = $transformation;

        return $obj;
    }

    /**
     * URL of the attempted post-transformation.
     */
    public function withURL(string $url): self
    {
        $obj = clone $this;
        $obj['url'] = $url;

        return $obj;
    }
}
