<?php

declare(strict_types=1);

namespace ImageKit\Webhooks\VideoTransformationReadyEvent;

use ImageKit\Core\Attributes\Required;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;
use ImageKit\Webhooks\VideoTransformationReadyEvent\Data\Asset;
use ImageKit\Webhooks\VideoTransformationReadyEvent\Data\Transformation;

/**
 * @phpstan-import-type AssetShape from \ImageKit\Webhooks\VideoTransformationReadyEvent\Data\Asset
 * @phpstan-import-type TransformationShape from \ImageKit\Webhooks\VideoTransformationReadyEvent\Data\Transformation
 *
 * @phpstan-type DataShape = array{
 *   asset: Asset|AssetShape, transformation: Transformation|TransformationShape
 * }
 */
final class Data implements BaseModel
{
    /** @use SdkModel<DataShape> */
    use SdkModel;

    /**
     * Information about the source video asset being transformed.
     */
    #[Required]
    public Asset $asset;

    #[Required]
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
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Asset|AssetShape $asset
     * @param Transformation|TransformationShape $transformation
     */
    public static function with(
        Asset|array $asset,
        Transformation|array $transformation
    ): self {
        $self = new self;

        $self['asset'] = $asset;
        $self['transformation'] = $transformation;

        return $self;
    }

    /**
     * Information about the source video asset being transformed.
     *
     * @param Asset|AssetShape $asset
     */
    public function withAsset(Asset|array $asset): self
    {
        $self = clone $this;
        $self['asset'] = $asset;

        return $self;
    }

    /**
     * @param Transformation|TransformationShape $transformation
     */
    public function withTransformation(
        Transformation|array $transformation
    ): self {
        $self = clone $this;
        $self['transformation'] = $transformation;

        return $self;
    }
}
