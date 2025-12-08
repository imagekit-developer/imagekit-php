<?php

declare(strict_types=1);

namespace Imagekit\Webhooks\VideoTransformationAcceptedEvent;

use Imagekit\Core\Attributes\Api;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Contracts\BaseModel;
use Imagekit\Webhooks\VideoTransformationAcceptedEvent\Data\Asset;
use Imagekit\Webhooks\VideoTransformationAcceptedEvent\Data\Transformation;
use Imagekit\Webhooks\VideoTransformationAcceptedEvent\Data\Transformation\Options;
use Imagekit\Webhooks\VideoTransformationAcceptedEvent\Data\Transformation\Type;

/**
 * @phpstan-type DataShape = array{asset: Asset, transformation: Transformation}
 */
final class Data implements BaseModel
{
    /** @use SdkModel<DataShape> */
    use SdkModel;

    /**
     * Information about the source video asset being transformed.
     */
    #[Api]
    public Asset $asset;

    /**
     * Base information about a video transformation request.
     */
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
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Asset|array{url: string} $asset
     * @param Transformation|array{
     *   type: value-of<Type>, options?: Options|null
     * } $transformation
     */
    public static function with(
        Asset|array $asset,
        Transformation|array $transformation
    ): self {
        $obj = new self;

        $obj['asset'] = $asset;
        $obj['transformation'] = $transformation;

        return $obj;
    }

    /**
     * Information about the source video asset being transformed.
     *
     * @param Asset|array{url: string} $asset
     */
    public function withAsset(Asset|array $asset): self
    {
        $obj = clone $this;
        $obj['asset'] = $asset;

        return $obj;
    }

    /**
     * Base information about a video transformation request.
     *
     * @param Transformation|array{
     *   type: value-of<Type>, options?: Options|null
     * } $transformation
     */
    public function withTransformation(
        Transformation|array $transformation
    ): self {
        $obj = clone $this;
        $obj['transformation'] = $transformation;

        return $obj;
    }
}
