<?php

declare(strict_types=1);

namespace ImageKit\Cache\Invalidation;

use ImageKit\Core\Attributes\Required;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Concerns\SdkParams;
use ImageKit\Core\Contracts\BaseModel;

/**
 * This API will invalidate CDN cache and ImageKit.io's internal cache for an asset.  Note: Purge cache is an asynchronous process and it may take some time to reflect the changes.
 *
 * @see ImageKit\Services\Cache\InvalidationService::create()
 *
 * @phpstan-type InvalidationCreateParamsShape = array{url: string}
 */
final class InvalidationCreateParams implements BaseModel
{
    /** @use SdkModel<InvalidationCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The full URL of the file to be purged.
     */
    #[Required]
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
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(string $url): self
    {
        $self = new self;

        $self['url'] = $url;

        return $self;
    }

    /**
     * The full URL of the file to be purged.
     */
    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }
}
