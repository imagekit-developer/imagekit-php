<?php

declare(strict_types=1);

namespace ImageKit\Webhooks\VideoTransformationErrorWebhookEvent;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;
use ImageKit\Webhooks\VideoTransformationErrorWebhookEvent\Data\Asset;
use ImageKit\Webhooks\VideoTransformationErrorWebhookEvent\Data\Transformation;

/**
 * @phpstan-type data_alias = array{asset: Asset, transformation: Transformation}
 */
final class Data implements BaseModel
{
    use SdkModel;

    #[Api]
    public Asset $asset;

    #[Api]
    public Transformation $transformation;

    /**
     * `new Data()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Data::with(asset: ..., transformation: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Data)->withAsset(...)->withTransformation(...)
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
    public static function with(
        Asset $asset,
        Transformation $transformation
    ): self {
        $obj = new self;

        $obj->asset = $asset;
        $obj->transformation = $transformation;

        return $obj;
    }

    public function withAsset(Asset $asset): self
    {
        $obj = clone $this;
        $obj->asset = $asset;

        return $obj;
    }

    public function withTransformation(Transformation $transformation): self
    {
        $obj = clone $this;
        $obj->transformation = $transformation;

        return $obj;
    }
}
