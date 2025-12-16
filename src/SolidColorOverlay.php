<?php

declare(strict_types=1);

namespace Imagekit;

use Imagekit\Core\Attributes\Optional;
use Imagekit\Core\Attributes\Required;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type OverlayPositionShape from \Imagekit\OverlayPosition
 * @phpstan-import-type OverlayTimingShape from \Imagekit\OverlayTiming
 * @phpstan-import-type SolidColorOverlayTransformationShape from \Imagekit\SolidColorOverlayTransformation
 *
 * @phpstan-type SolidColorOverlayShape = array{
 *   position?: null|OverlayPosition|OverlayPositionShape,
 *   timing?: null|OverlayTiming|OverlayTimingShape,
 *   color: string,
 *   type: 'solidColor',
 *   transformation?: list<SolidColorOverlayTransformationShape>|null,
 * }
 */
final class SolidColorOverlay implements BaseModel
{
    /** @use SdkModel<SolidColorOverlayShape> */
    use SdkModel;

    /** @var 'solidColor' $type */
    #[Required]
    public string $type = 'solidColor';

    #[Optional]
    public ?OverlayPosition $position;

    #[Optional]
    public ?OverlayTiming $timing;

    /**
     * Specifies the color of the block using an RGB hex code (e.g., `FF0000`), an RGBA code (e.g., `FFAABB50`), or a color name (e.g., `red`).
     * If an 8-character value is provided, the last two characters represent the opacity level (from `00` for 0.00 to `99` for 0.99).
     */
    #[Required]
    public string $color;

    /**
     * Control width and height of the solid color overlay. Supported transformations depend on the base/parent asset.
     * See overlays on [Images](https://imagekit.io/docs/add-overlays-on-images#apply-transformation-on-solid-color-overlay) and [Videos](https://imagekit.io/docs/add-overlays-on-videos#apply-transformations-on-solid-color-block-overlay).
     *
     * @var list<SolidColorOverlayTransformation>|null $transformation
     */
    #[Optional(list: SolidColorOverlayTransformation::class)]
    public ?array $transformation;

    /**
     * `new SolidColorOverlay()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SolidColorOverlay::with(color: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SolidColorOverlay)->withColor(...)
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
     * @param OverlayPositionShape $position
     * @param OverlayTimingShape $timing
     * @param list<SolidColorOverlayTransformationShape> $transformation
     */
    public static function with(
        string $color,
        OverlayPosition|array|null $position = null,
        OverlayTiming|array|null $timing = null,
        ?array $transformation = null,
    ): self {
        $self = new self;

        $self['color'] = $color;

        null !== $position && $self['position'] = $position;
        null !== $timing && $self['timing'] = $timing;
        null !== $transformation && $self['transformation'] = $transformation;

        return $self;
    }

    /**
     * @param OverlayPositionShape $position
     */
    public function withPosition(OverlayPosition|array $position): self
    {
        $self = clone $this;
        $self['position'] = $position;

        return $self;
    }

    /**
     * @param OverlayTimingShape $timing
     */
    public function withTiming(OverlayTiming|array $timing): self
    {
        $self = clone $this;
        $self['timing'] = $timing;

        return $self;
    }

    /**
     * Specifies the color of the block using an RGB hex code (e.g., `FF0000`), an RGBA code (e.g., `FFAABB50`), or a color name (e.g., `red`).
     * If an 8-character value is provided, the last two characters represent the opacity level (from `00` for 0.00 to `99` for 0.99).
     */
    public function withColor(string $color): self
    {
        $self = clone $this;
        $self['color'] = $color;

        return $self;
    }

    /**
     * Control width and height of the solid color overlay. Supported transformations depend on the base/parent asset.
     * See overlays on [Images](https://imagekit.io/docs/add-overlays-on-images#apply-transformation-on-solid-color-overlay) and [Videos](https://imagekit.io/docs/add-overlays-on-videos#apply-transformations-on-solid-color-block-overlay).
     *
     * @param list<SolidColorOverlayTransformationShape> $transformation
     */
    public function withTransformation(array $transformation): self
    {
        $self = clone $this;
        $self['transformation'] = $transformation;

        return $self;
    }
}
