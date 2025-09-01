<?php

declare(strict_types=1);

namespace ImageKit\Webhooks\VideoTransformationReadyEvent\Data;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;

/**
 * Information about the source video asset being transformed.
 *
 * @phpstan-type asset_alias = array{url: string}
 */
final class Asset implements BaseModel
{
    /** @use SdkModel<asset_alias> */
    use SdkModel;

    /**
     * URL to download or access the source video file.
     */
    #[Api]
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
        $obj = new self;

        $obj->url = $url;

        return $obj;
    }

    /**
     * URL to download or access the source video file.
     */
    public function withURL(string $url): self
    {
        $obj = clone $this;
        $obj->url = $url;

        return $obj;
    }
}
