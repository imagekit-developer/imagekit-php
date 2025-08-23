<?php

declare(strict_types=1);

namespace ImageKit\Cache\Invalidation;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Concerns\SdkParams;
use ImageKit\Core\Contracts\BaseModel;

/**
 * This API will purge CDN cache and ImageKit.io's internal cache for a file.  Note: Purge cache is an asynchronous process and it may take some time to reflect the changes.
 */
final class InvalidationCreateParams implements BaseModel
{
    use SdkModel;
    use SdkParams;

    /**
     * The full URL of the file to be purged.
     */
    #[Api]
    public string $url;

    /**
     * `new InvalidationCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * InvalidationCreateParams::with(url: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new InvalidationCreateParams)->withURL(...)
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
     * The full URL of the file to be purged.
     */
    public function withURL(string $url): self
    {
        $obj = clone $this;
        $obj->url = $url;

        return $obj;
    }
}
