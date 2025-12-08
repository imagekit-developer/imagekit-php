<?php

declare(strict_types=1);

namespace Imagekit\Webhooks\UploadPostTransformSuccessEvent;

use Imagekit\Core\Attributes\Api;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Contracts\BaseModel;

/**
 * @phpstan-type DataShape = array{fileId: string, name: string, url: string}
 */
final class Data implements BaseModel
{
    /** @use SdkModel<DataShape> */
    use SdkModel;

    /**
     * Unique identifier of the originally uploaded file.
     */
    #[Api]
    public string $fileId;

    /**
     * Name of the file.
     */
    #[Api]
    public string $name;

    /**
     * URL of the generated post-transformation.
     */
    #[Api]
    public string $url;

    /**
     * `new Data()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Data::with(fileId: ..., name: ..., url: ...)
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
    public static function with(string $fileId, string $name, string $url): self
    {
        $obj = new self;

        $obj['fileId'] = $fileId;
        $obj['name'] = $name;
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
     * URL of the generated post-transformation.
     */
    public function withURL(string $url): self
    {
        $obj = clone $this;
        $obj['url'] = $url;

        return $obj;
    }
}
