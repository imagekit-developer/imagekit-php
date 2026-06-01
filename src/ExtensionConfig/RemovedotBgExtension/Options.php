<?php

declare(strict_types=1);

namespace ImageKit\ExtensionConfig\RemovedotBgExtension;

use ImageKit\Core\Attributes\Optional;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;

/**
 * @phpstan-type OptionsShape = array{
 *   addShadow?: bool|null,
 *   bgColor?: string|null,
 *   bgImageURL?: string|null,
 *   semiTransparency?: bool|null,
 * }
 */
final class Options implements BaseModel
{
    /** @use SdkModel<OptionsShape> */
    use SdkModel;

    /**
     * Whether to add an artificial shadow to the result. Default is false. Note: Adding shadows is currently only supported for car photos.
     */
    #[Optional('add_shadow')]
    public ?bool $addShadow;

    /**
     * Specifies a solid color background using hex code (e.g., "81d4fa", "fff") or color name (e.g., "green"). If this parameter is set, `bg_image_url` must be empty.
     */
    #[Optional('bg_color')]
    public ?string $bgColor;

    /**
     * Sets a background image from a URL. If this parameter is set, `bg_color` must be empty.
     */
    #[Optional('bg_image_url')]
    public ?string $bgImageURL;

    /**
     * Allows semi-transparent regions in the result. Default is true. Note: Semitransparency is currently only supported for car windows.
     */
    #[Optional('semi_transparency')]
    public ?bool $semiTransparency;

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
        ?bool $addShadow = null,
        ?string $bgColor = null,
        ?string $bgImageURL = null,
        ?bool $semiTransparency = null,
    ): self {
        $self = new self;

        null !== $addShadow && $self['addShadow'] = $addShadow;
        null !== $bgColor && $self['bgColor'] = $bgColor;
        null !== $bgImageURL && $self['bgImageURL'] = $bgImageURL;
        null !== $semiTransparency && $self['semiTransparency'] = $semiTransparency;

        return $self;
    }

    /**
     * Whether to add an artificial shadow to the result. Default is false. Note: Adding shadows is currently only supported for car photos.
     */
    public function withAddShadow(bool $addShadow): self
    {
        $self = clone $this;
        $self['addShadow'] = $addShadow;

        return $self;
    }

    /**
     * Specifies a solid color background using hex code (e.g., "81d4fa", "fff") or color name (e.g., "green"). If this parameter is set, `bg_image_url` must be empty.
     */
    public function withBgColor(string $bgColor): self
    {
        $self = clone $this;
        $self['bgColor'] = $bgColor;

        return $self;
    }

    /**
     * Sets a background image from a URL. If this parameter is set, `bg_color` must be empty.
     */
    public function withBgImageURL(string $bgImageURL): self
    {
        $self = clone $this;
        $self['bgImageURL'] = $bgImageURL;

        return $self;
    }

    /**
     * Allows semi-transparent regions in the result. Default is true. Note: Semitransparency is currently only supported for car windows.
     */
    public function withSemiTransparency(bool $semiTransparency): self
    {
        $self = clone $this;
        $self['semiTransparency'] = $semiTransparency;

        return $self;
    }
}
