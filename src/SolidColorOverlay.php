<?php

declare(strict_types=1);

namespace ImageKit;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;

/**
 * @phpstan-type solid_color_overlay = array{
 *   position?: OverlayPosition,
 *   timing?: OverlayTiming,
 *   color: string,
 *   type: string,
 *   transformation?: list<SolidColorOverlayTransformation>,
 * }
 */
final class SolidColorOverlay implements BaseModel
{
    /** @use SdkModel<solid_color_overlay> */
    use SdkModel;

    #[Api]
    public string $type = 'solidColor';

    #[Api(optional: true)]
    public ?OverlayPosition $position;

    #[Api(optional: true)]
    public ?OverlayTiming $timing;

    /**
     * Specifies the color of the block using an RGB hex code (e.g., `FF0000`), an RGBA code (e.g., `FFAABB50`), or a color name (e.g., `red`).
     * If an 8-character value is provided, the last two characters represent the opacity level (from `00` for 0.00 to `99` for 0.99).
     */
    #[Api]
    public string $color;

    /**
     * Control width and height of the solid color overlay. Supported transformations depend on the base/parent asset.
     * See overlays on [Images](https://imagekit.io/docs/add-overlays-on-images#apply-transformation-on-solid-color-overlay) and [Videos](https://imagekit.io/docs/add-overlays-on-videos#apply-transformations-on-solid-color-block-overlay).
     *
     * @var list<SolidColorOverlayTransformation>|null $transformation
     */
    #[Api(list: SolidColorOverlayTransformation::class, optional: true)]
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
     * @param list<SolidColorOverlayTransformation> $transformation
     */
    public static function with(
        string $color,
        ?OverlayPosition $position = null,
        ?OverlayTiming $timing = null,
        ?array $transformation = null,
    ): self {
        $obj = new self;

        $obj->color = $color;

        null !== $position && $obj->position = $position;
        null !== $timing && $obj->timing = $timing;
        null !== $transformation && $obj->transformation = $transformation;

        return $obj;
    }

    public function withPosition(OverlayPosition $position): self
    {
        $obj = clone $this;
        $obj->position = $position;

        return $obj;
    }

    public function withTiming(OverlayTiming $timing): self
    {
        $obj = clone $this;
        $obj->timing = $timing;

        return $obj;
    }

    /**
     * Specifies the color of the block using an RGB hex code (e.g., `FF0000`), an RGBA code (e.g., `FFAABB50`), or a color name (e.g., `red`).
     * If an 8-character value is provided, the last two characters represent the opacity level (from `00` for 0.00 to `99` for 0.99).
     */
    public function withColor(string $color): self
    {
        $obj = clone $this;
        $obj->color = $color;

        return $obj;
    }

    /**
     * Control width and height of the solid color overlay. Supported transformations depend on the base/parent asset.
     * See overlays on [Images](https://imagekit.io/docs/add-overlays-on-images#apply-transformation-on-solid-color-overlay) and [Videos](https://imagekit.io/docs/add-overlays-on-videos#apply-transformations-on-solid-color-block-overlay).
     *
     * @param list<SolidColorOverlayTransformation> $transformation
     */
    public function withTransformation(array $transformation): self
    {
        $obj = clone $this;
        $obj->transformation = $transformation;

        return $obj;
    }
}
