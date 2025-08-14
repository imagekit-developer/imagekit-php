<?php

declare(strict_types=1);

namespace ImageKit\Files\Metadata;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\Model;
use ImageKit\Core\Concerns\Params;
use ImageKit\Core\Contracts\BaseModel;

/**
 * Get image EXIF, pHash, and other metadata from ImageKit.io powered remote URL using this API.
 *
 * @phpstan-type from_url_params = array{url: string}
 */
final class MetadataFromURLParams implements BaseModel
{
    use Model;
    use Params;

    /**
     * Should be a valid file URL. It should be accessible using your ImageKit.io account.
     */
    #[Api]
    public string $url;

    /**
     * `new MetadataFromURLParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * MetadataFromURLParams::with(url: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new MetadataFromURLParams)->withURL(...)
     * ```
     */
    public function __construct()
    {
        self::introspect();
        $this->unsetOptionalProperties();
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
