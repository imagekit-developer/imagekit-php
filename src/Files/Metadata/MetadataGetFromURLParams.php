<?php

declare(strict_types=1);

namespace ImageKit\Files\Metadata;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Concerns\SdkParams;
use ImageKit\Core\Contracts\BaseModel;

/**
 * Get image EXIF, pHash, and other metadata from ImageKit.io powered remote URL using this API.
 *
 * @see ImageKit\Files\Metadata->getFromURL
 *
 * @phpstan-type MetadataGetFromURLParamsShape = array{url: string}
 */
final class MetadataGetFromURLParams implements BaseModel
{
    /** @use SdkModel<MetadataGetFromURLParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Should be a valid file URL. It should be accessible using your ImageKit.io account.
     */
    #[Api]
    public string $url;

    /**
     * `new MetadataGetFromURLParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * MetadataGetFromURLParams::with(url: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new MetadataGetFromURLParams)->withURL(...)
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
    public static function with(string $url): self
    {
        $obj = new self;

        $obj->url = $url;

        return $obj;
    }

    /**
     * Should be a valid file URL. It should be accessible using your ImageKit.io account.
     */
    public function withURL(string $url): self
    {
        $obj = clone $this;
        $obj->url = $url;

        return $obj;
    }
}
