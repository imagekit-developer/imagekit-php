<?php

declare(strict_types=1);

namespace ImageKit\Assets;

use ImageKit\Core\Attributes\Required;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;

/**
 * Information about the source video asset being transformed.
 *
 * @phpstan-type VideoAssetShape = array{url: string}
 */
final class VideoAsset implements BaseModel
{
    /** @use SdkModel<VideoAssetShape> */
    use SdkModel;

    /**
     * URL to download or access the source video file.
     */
    #[Required]
    public string $url;

    /**
     * `new VideoAsset()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * VideoAsset::with(url: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new VideoAsset)->withURL(...)
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
     * URL to download or access the source video file.
     */
    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }
}
