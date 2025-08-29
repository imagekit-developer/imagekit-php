<?php

declare(strict_types=1);

namespace ImageKit;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;
use ImageKit\SolidColorOverlay\Type;

/**
 * @phpstan-type solid_color_overlay = array{
 *   color: string,
 *   type: Type::*,
 *   transformation?: list<SolidColorOverlayTransformation>|null,
 * }
 */
final class SolidColorOverlay implements BaseModel
{
    /** @use SdkModel<solid_color_overlay> */
    use SdkModel;

    /**
     * Specifies the color of the block using an RGB hex code (e.g., `FF0000`), an RGBA code (e.g., `FFAABB50`), or a color name (e.g., `red`).
     * If an 8-character value is provided, the last two characters represent the opacity level (from `00` for 0.00 to `99` for 0.99).
     */
    #[Api]
    public string $color;

    /** @var Type::* $type */
    #[Api(enum: Type::class)]
    public string $type;

    /**
     * Control width and height of the solid color overlay. Supported transformations depend on the base/parent asset.
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
     * SolidColorOverlay::with(color: ..., type: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SolidColorOverlay)->withColor(...)->withType(...)
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
     * @param Type::* $type
     * @param list<SolidColorOverlayTransformation> $transformation
     */
    public static function with(
        string $color,
        string $type,
        ?array $transformation = null
    ): self {
        $obj = new self;

        $obj->color = $color;
        $obj->type = $type;

        null !== $transformation && $obj->transformation = $transformation;

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
     * @param Type::* $type
     */
    public function withType(string $type): self
    {
        $obj = clone $this;
        $obj->type = $type;

        return $obj;
    }

    /**
     * Control width and height of the solid color overlay. Supported transformations depend on the base/parent asset.
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
