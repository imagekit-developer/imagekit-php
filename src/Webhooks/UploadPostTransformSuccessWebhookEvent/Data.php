<?php

declare(strict_types=1);

namespace ImageKit\Webhooks\UploadPostTransformSuccessWebhookEvent;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;

/**
 * @phpstan-type data_alias = array{fileID: string, name: string, url: string}
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
     * URL of the generated post-transformation.
     */
    #[Api]
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
        $obj = new self;

        $obj->fileID = $fileID;
        $obj->name = $name;
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
     * URL of the generated post-transformation.
     */
    public function withURL(string $url): self
    {
        $obj = clone $this;
        $obj->url = $url;

        return $obj;
    }
}
