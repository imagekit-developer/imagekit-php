<?php

declare(strict_types=1);

namespace Imagekit\Webhooks\VideoTransformationReadyEvent\Data;

use Imagekit\Core\Attributes\Required;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Contracts\BaseModel;

/**
 * Information about the source video asset being transformed.
 *
 * @phpstan-type AssetShape = array{url: string}
 */
final class Asset implements BaseModel
{
    /** @use SdkModel<AssetShape> */
    use SdkModel;

    /**
     * URL to download or access the source video file.
     */
    #[Required]
    public string $url;

    /**
     * `new Asset()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Asset::with(url: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Asset)->withURL(...)
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
