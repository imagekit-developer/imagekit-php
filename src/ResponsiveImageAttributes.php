<?php

declare(strict_types=1);

namespace Imagekit;

use Imagekit\Core\Attributes\Optional;
use Imagekit\Core\Attributes\Required;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Contracts\BaseModel;

/**
 * Resulting set of attributes suitable for an HTML `<img>` element.
 * Useful for enabling responsive image loading with `srcSet` and `sizes`.
 *
 * @phpstan-type ResponsiveImageAttributesShape = array{
 *   src: string, sizes?: string|null, srcSet?: string|null, width?: float|null
 * }
 */
final class ResponsiveImageAttributes implements BaseModel
{
    /** @use SdkModel<ResponsiveImageAttributesShape> */
    use SdkModel;

    /**
     * URL for the *largest* candidate (assigned to plain `src`).
     */
    #[Required]
    public string $src;

    /**
     * `sizes` returned (or synthesised as `100vw`).
     * The value for the HTML `sizes` attribute.
     */
    #[Optional]
    public ?string $sizes;

    /**
     * Candidate set with `w` or `x` descriptors.
     * Multiple image URLs separated by commas, each with a descriptor.
     */
    #[Optional]
    public ?string $srcSet;

    /**
     * Width as a number (if `width` was provided in the input options).
     */
    #[Optional]
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
        $self = new self;

        $self['src'] = $src;

        null !== $sizes && $self['sizes'] = $sizes;
        null !== $srcSet && $self['srcSet'] = $srcSet;
        null !== $width && $self['width'] = $width;

        return $self;
    }

    /**
     * URL for the *largest* candidate (assigned to plain `src`).
     */
    public function withSrc(string $src): self
    {
        $self = clone $this;
        $self['src'] = $src;

        return $self;
    }

    /**
     * `sizes` returned (or synthesised as `100vw`).
     * The value for the HTML `sizes` attribute.
     */
    public function withSizes(string $sizes): self
    {
        $self = clone $this;
        $self['sizes'] = $sizes;

        return $self;
    }

    /**
     * Candidate set with `w` or `x` descriptors.
     * Multiple image URLs separated by commas, each with a descriptor.
     */
    public function withSrcSet(string $srcSet): self
    {
        $self = clone $this;
        $self['srcSet'] = $srcSet;

        return $self;
    }

    /**
     * Width as a number (if `width` was provided in the input options).
     */
    public function withWidth(float $width): self
    {
        $self = clone $this;
        $self['width'] = $width;

        return $self;
    }
}
