<?php

declare(strict_types=1);

namespace ImageKit;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;

/**
 * Resulting set of attributes suitable for an HTML `<img>` element.
 * Useful for enabling responsive image loading with `srcSet` and `sizes`.
 *
 * @phpstan-type responsive_image_attributes = array{
 *   src: string, sizes?: string, srcSet?: string, width?: float
 * }
 */
final class ResponsiveImageAttributes implements BaseModel
{
    /** @use SdkModel<responsive_image_attributes> */
    use SdkModel;

    /**
     * URL for the *largest* candidate (assigned to plain `src`).
     */
    #[Api]
    public string $src;

    /**
     * `sizes` returned (or synthesised as `100vw`).
     * The value for the HTML `sizes` attribute.
     */
    #[Api(optional: true)]
    public ?string $sizes;

    /**
     * Candidate set with `w` or `x` descriptors.
     * Multiple image URLs separated by commas, each with a descriptor.
     */
    #[Api(optional: true)]
    public ?string $srcSet;

    /**
     * Width as a number (if `width` was provided in the input options).
     */
    #[Api(optional: true)]
    public ?float $width;

    /**
     * `new ResponsiveImageAttributes()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ResponsiveImageAttributes::with(src: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ResponsiveImageAttributes)->withSrc(...)
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
     */
    public static function with(
        string $src,
        ?string $sizes = null,
        ?string $srcSet = null,
        ?float $width = null,
    ): self {
        $obj = new self;

        $obj->src = $src;

        null !== $sizes && $obj->sizes = $sizes;
        null !== $srcSet && $obj->srcSet = $srcSet;
        null !== $width && $obj->width = $width;

        return $obj;
    }

    /**
     * URL for the *largest* candidate (assigned to plain `src`).
     */
    public function withSrc(string $src): self
    {
        $obj = clone $this;
        $obj->src = $src;

        return $obj;
    }

    /**
     * `sizes` returned (or synthesised as `100vw`).
     * The value for the HTML `sizes` attribute.
     */
    public function withSizes(string $sizes): self
    {
        $obj = clone $this;
        $obj->sizes = $sizes;

        return $obj;
    }

    /**
     * Candidate set with `w` or `x` descriptors.
     * Multiple image URLs separated by commas, each with a descriptor.
     */
    public function withSrcSet(string $srcSet): self
    {
        $obj = clone $this;
        $obj->srcSet = $srcSet;

        return $obj;
    }

    /**
     * Width as a number (if `width` was provided in the input options).
     */
    public function withWidth(float $width): self
    {
        $obj = clone $this;
        $obj->width = $width;

        return $obj;
    }
}
