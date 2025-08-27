<?php

declare(strict_types=1);

namespace ImageKit\Beta\V2\Files\FileUploadParams\Extension\RemoveBg;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;

/**
 * @phpstan-type options_alias = array{
 *   addShadow?: bool|null,
 *   bgColor?: string|null,
 *   bgImageURL?: string|null,
 *   semitransparency?: bool|null,
 * }
 */
final class Options implements BaseModel
{
    /** @use SdkModel<options_alias> */
    use SdkModel;

    /**
     * Whether to add an artificial shadow to the result. Default is false. Note: Adding shadows is currently only supported for car photos.
     */
    #[Api('add_shadow', optional: true)]
    public ?bool $addShadow;

    /**
     * Specifies a solid color background using hex code (e.g., "81d4fa", "fff") or color name (e.g., "green"). If this parameter is set, `bg_image_url` must be empty.
     */
    #[Api('bg_color', optional: true)]
    public ?string $bgColor;

    /**
     * Sets a background image from a URL. If this parameter is set, `bg_color` must be empty.
     */
    #[Api('bg_image_url', optional: true)]
    public ?string $bgImageURL;

    /**
     * Allows semi-transparent regions in the result. Default is true. Note: Semitransparency is currently only supported for car windows.
     */
    #[Api(optional: true)]
    public ?bool $semitransparency;

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
        ?bool $addShadow = null,
        ?string $bgColor = null,
        ?string $bgImageURL = null,
        ?bool $semitransparency = null,
    ): self {
        $obj = new self;

        null !== $addShadow && $obj->addShadow = $addShadow;
        null !== $bgColor && $obj->bgColor = $bgColor;
        null !== $bgImageURL && $obj->bgImageURL = $bgImageURL;
        null !== $semitransparency && $obj->semitransparency = $semitransparency;

        return $obj;
    }

    /**
     * Whether to add an artificial shadow to the result. Default is false. Note: Adding shadows is currently only supported for car photos.
     */
    public function withAddShadow(bool $addShadow): self
    {
        $obj = clone $this;
        $obj->addShadow = $addShadow;

        return $obj;
    }

    /**
     * Specifies a solid color background using hex code (e.g., "81d4fa", "fff") or color name (e.g., "green"). If this parameter is set, `bg_image_url` must be empty.
     */
    public function withBgColor(string $bgColor): self
    {
        $obj = clone $this;
        $obj->bgColor = $bgColor;

        return $obj;
    }

    /**
     * Sets a background image from a URL. If this parameter is set, `bg_color` must be empty.
     */
    public function withBgImageURL(string $bgImageURL): self
    {
        $obj = clone $this;
        $obj->bgImageURL = $bgImageURL;

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
