<?php

declare(strict_types=1);

namespace ImageKit\Webhooks\VideoTransformationErrorWebhookEvent\Data;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;

/**
 * @phpstan-type asset_alias = array{url: string}
 */
final class Asset implements BaseModel
{
    /** @use SdkModel<asset_alias> */
    use SdkModel;

    /**
     * Source asset URL.
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
     * Source asset URL.
     */
    public function withURL(string $url): self
    {
        $obj = clone $this;
        $obj->url = $url;

        return $obj;
    }
}
