<?php

declare(strict_types=1);

namespace ImageKit\ExtensionItem\RemoveBg;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;

/**
 * @phpstan-type OptionsShape = array{
 *   add_shadow?: bool|null,
 *   bg_color?: string|null,
 *   bg_image_url?: string|null,
 *   semitransparency?: bool|null,
 * }
 */
final class Options implements BaseModel
{
    /** @use SdkModel<OptionsShape> */
    use SdkModel;

    /**
     * Whether to add an artificial shadow to the result. Default is false. Note: Adding shadows is currently only supported for car photos.
     */
    #[Api(optional: true)]
    public ?bool $add_shadow;

    /**
     * Specifies a solid color background using hex code (e.g., "81d4fa", "fff") or color name (e.g., "green"). If this parameter is set, `bg_image_url` must be empty.
     */
    #[Api(optional: true)]
    public ?string $bg_color;

    /**
     * Sets a background image from a URL. If this parameter is set, `bg_color` must be empty.
     */
    #[Api(optional: true)]
    public ?string $bg_image_url;

    /**
     * Allows semi-transparent regions in the result. Default is true. Note: Semitransparency is currently only supported for car windows.
     */
    #[Api(optional: true)]
    public ?bool $semitransparency;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(
        ?bool $add_shadow = null,
        ?string $bg_color = null,
        ?string $bg_image_url = null,
        ?bool $semitransparency = null,
    ): self {
        $obj = new self;

        null !== $add_shadow && $obj->add_shadow = $add_shadow;
        null !== $bg_color && $obj->bg_color = $bg_color;
        null !== $bg_image_url && $obj->bg_image_url = $bg_image_url;
        null !== $semitransparency && $obj->semitransparency = $semitransparency;

        return $obj;
    }

    /**
     * Whether to add an artificial shadow to the result. Default is false. Note: Adding shadows is currently only supported for car photos.
     */
    public function withAddShadow(bool $addShadow): self
    {
        $obj = clone $this;
        $obj->add_shadow = $addShadow;

        return $obj;
    }

    /**
     * Specifies a solid color background using hex code (e.g., "81d4fa", "fff") or color name (e.g., "green"). If this parameter is set, `bg_image_url` must be empty.
     */
    public function withBgColor(string $bgColor): self
    {
        $obj = clone $this;
        $obj->bg_color = $bgColor;

        return $obj;
    }

    /**
     * Sets a background image from a URL. If this parameter is set, `bg_color` must be empty.
     */
    public function withBgImageURL(string $bgImageURL): self
    {
        $obj = clone $this;
        $obj->bg_image_url = $bgImageURL;

        return $obj;
    }

    /**
     * Allows semi-transparent regions in the result. Default is true. Note: Semitransparency is currently only supported for car windows.
     */
    public function withSemitransparency(bool $semitransparency): self
    {
        $obj = clone $this;
        $obj->semitransparency = $semitransparency;

        return $obj;
    }
}
