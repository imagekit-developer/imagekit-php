<?php

declare(strict_types=1);

namespace Imagekit;

use Imagekit\Core\Attributes\Optional;
use Imagekit\Core\Attributes\Required;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Contracts\BaseModel;

/**
 * Options for generating responsive image attributes including `src`, `srcSet`, and `sizes` for HTML `<img>` elements.
 * This schema extends `SrcOptions` to add support for responsive image generation with breakpoints.
 *
 * @phpstan-type GetImageAttributesOptionsShape = array{
 *   src: string,
 *   urlEndpoint: string,
 *   expiresIn?: float|null,
 *   queryParameters?: array<string,string>|null,
 *   signed?: bool|null,
 *   transformation?: list<mixed>|null,
 *   transformationPosition?: null|TransformationPosition|value-of<TransformationPosition>,
 *   deviceBreakpoints?: list<float>|null,
 *   imageBreakpoints?: list<float>|null,
 *   sizes?: string|null,
 *   width?: float|null,
 * }
 */
final class GetImageAttributesOptions implements BaseModel
{
    /** @use SdkModel<GetImageAttributesOptionsShape> */
    use SdkModel;

    /**
     * Accepts a relative or absolute path of the resource. If a relative path is provided, it is appended to the `urlEndpoint`.
     * If an absolute path is provided, `urlEndpoint` is ignored.
     */
    #[Required]
    public string $src;

    /**
     * Get your urlEndpoint from the [ImageKit dashboard](https://imagekit.io/dashboard/url-endpoints).
     */
    #[Required]
    public string $urlEndpoint;

    /**
     * When you want the signed URL to expire, specified in seconds. If `expiresIn` is anything above 0,
     * the URL will always be signed even if `signed` is set to false. If not specified and `signed` is `true`,
     * the signed URL will not expire (valid indefinitely).
     *
     * Example: Setting `expiresIn: 3600` will make the URL expire 1 hour from generation time. After the expiry time, the signed URL will no longer be valid and ImageKit will return
     * a 401 Unauthorized status code.
     *
     * [Learn more](https://imagekit.io/docs/media-delivery-basic-security#how-to-generate-signed-urls).
     */
    #[Optional]
    public ?float $expiresIn;

    /**
     * These are additional query parameters that you want to add to the final URL.
     * They can be any query parameters and not necessarily related to ImageKit.
     * This is especially useful if you want to add a versioning parameter to your URLs.
     *
     * @var array<string,string>|null $queryParameters
     */
    #[Optional(map: 'string')]
    public ?array $queryParameters;

    /**
     * Whether to sign the URL or not. Set this to `true` if you want to generate a signed URL.
     * If `signed` is `true` and `expiresIn` is not specified, the signed URL will not expire (valid indefinitely).
     * Note: If `expiresIn` is set to any value above 0, the URL will always be signed regardless of this setting.
     * [Learn more](https://imagekit.io/docs/media-delivery-basic-security#how-to-generate-signed-urls).
     */
    #[Optional]
    public ?bool $signed;

    /**
     * An array of objects specifying the transformations to be applied in the URL. If more than one transformation is specified, they are applied in the order they are specified as chained transformations.
     * See [Chained transformations](https://imagekit.io/docs/transformations#chained-transformations).
     *
     * @var list<mixed>|null $transformation
     */
    #[Optional(list: Transformation::class)]
    public ?array $transformation;

    /**
     * By default, the transformation string is added as a query parameter in the URL, e.g., `?tr=w-100,h-100`.
     * If you want to add the transformation string in the path of the URL, set this to `path`.
     * Learn more in the [Transformations guide](https://imagekit.io/docs/transformations).
     *
     * @var value-of<TransformationPosition>|null $transformationPosition
     */
    #[Optional(enum: TransformationPosition::class)]
    public ?string $transformationPosition;

    /**
     * Custom list of **device-width breakpoints** in pixels.
     * These define common screen widths for responsive image generation.
     *
     * Defaults to `[640, 750, 828, 1080, 1200, 1920, 2048, 3840]`.
     * Sorted automatically.
     *
     * @var list<float>|null $deviceBreakpoints
     */
    #[Optional(list: 'float')]
    public ?array $deviceBreakpoints;

    /**
     * Custom list of **image-specific breakpoints** in pixels.
     * Useful for generating small variants (e.g., placeholders or thumbnails).
     *
     * Merged with `deviceBreakpoints` before calculating `srcSet`.
     * Defaults to `[16, 32, 48, 64, 96, 128, 256, 384]`.
     * Sorted automatically.
     *
     * @var list<float>|null $imageBreakpoints
     */
    #[Optional(list: 'float')]
    public ?array $imageBreakpoints;

    /**
     * The value for the HTML `sizes` attribute
     * (e.g., `"100vw"` or `"(min-width:768px) 50vw, 100vw"`).
     *
     * - If it includes one or more `vw` units, breakpoints smaller than the corresponding percentage of the smallest device width are excluded.
     * - If it contains no `vw` units, the full breakpoint list is used.
     *
     * Enables a width-based strategy and generates `w` descriptors in `srcSet`.
     */
    #[Optional]
    public ?string $sizes;

    /**
     * The intended display width of the image in pixels,
     * used **only when the `sizes` attribute is not provided**.
     *
     * Triggers a DPR-based strategy (1x and 2x variants) and generates `x` descriptors in `srcSet`.
     *
     * Ignored if `sizes` is present.
     */
    #[Optional]
    public ?float $width;

    /**
     * `new GetImageAttributesOptions()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * GetImageAttributesOptions::with(src: ..., urlEndpoint: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new GetImageAttributesOptions)->withSrc(...)->withURLEndpoint(...)
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
     * @param array<string,string>|null $queryParameters
     * @param list<mixed>|null $transformation
     * @param TransformationPosition|value-of<TransformationPosition>|null $transformationPosition
     * @param list<float>|null $deviceBreakpoints
     * @param list<float>|null $imageBreakpoints
     */
    public static function with(
        string $src,
        string $urlEndpoint,
        ?float $expiresIn = null,
        ?array $queryParameters = null,
        ?bool $signed = null,
        ?array $transformation = null,
        TransformationPosition|string|null $transformationPosition = null,
        ?array $deviceBreakpoints = null,
        ?array $imageBreakpoints = null,
        ?string $sizes = null,
        ?float $width = null,
    ): self {
        $self = new self;

        $self['src'] = $src;
        $self['urlEndpoint'] = $urlEndpoint;

        null !== $expiresIn && $self['expiresIn'] = $expiresIn;
        null !== $queryParameters && $self['queryParameters'] = $queryParameters;
        null !== $signed && $self['signed'] = $signed;
        null !== $transformation && $self['transformation'] = $transformation;
        null !== $transformationPosition && $self['transformationPosition'] = $transformationPosition;
        null !== $deviceBreakpoints && $self['deviceBreakpoints'] = $deviceBreakpoints;
        null !== $imageBreakpoints && $self['imageBreakpoints'] = $imageBreakpoints;
        null !== $sizes && $self['sizes'] = $sizes;
        null !== $width && $self['width'] = $width;

        return $self;
    }

    /**
     * Accepts a relative or absolute path of the resource. If a relative path is provided, it is appended to the `urlEndpoint`.
     * If an absolute path is provided, `urlEndpoint` is ignored.
     */
    public function withSrc(string $src): self
    {
        $self = clone $this;
        $self['src'] = $src;

        return $self;
    }

    /**
     * Get your urlEndpoint from the [ImageKit dashboard](https://imagekit.io/dashboard/url-endpoints).
     */
    public function withURLEndpoint(string $urlEndpoint): self
    {
        $self = clone $this;
        $self['urlEndpoint'] = $urlEndpoint;

        return $self;
    }

    /**
     * When you want the signed URL to expire, specified in seconds. If `expiresIn` is anything above 0,
     * the URL will always be signed even if `signed` is set to false. If not specified and `signed` is `true`,
     * the signed URL will not expire (valid indefinitely).
     *
     * Example: Setting `expiresIn: 3600` will make the URL expire 1 hour from generation time. After the expiry time, the signed URL will no longer be valid and ImageKit will return
     * a 401 Unauthorized status code.
     *
     * [Learn more](https://imagekit.io/docs/media-delivery-basic-security#how-to-generate-signed-urls).
     */
    public function withExpiresIn(float $expiresIn): self
    {
        $self = clone $this;
        $self['expiresIn'] = $expiresIn;

        return $self;
    }

    /**
     * These are additional query parameters that you want to add to the final URL.
     * They can be any query parameters and not necessarily related to ImageKit.
     * This is especially useful if you want to add a versioning parameter to your URLs.
     *
     * @param array<string,string> $queryParameters
     */
    public function withQueryParameters(array $queryParameters): self
    {
        $self = clone $this;
        $self['queryParameters'] = $queryParameters;

        return $self;
    }

    /**
     * Whether to sign the URL or not. Set this to `true` if you want to generate a signed URL.
     * If `signed` is `true` and `expiresIn` is not specified, the signed URL will not expire (valid indefinitely).
     * Note: If `expiresIn` is set to any value above 0, the URL will always be signed regardless of this setting.
     * [Learn more](https://imagekit.io/docs/media-delivery-basic-security#how-to-generate-signed-urls).
     */
    public function withSigned(bool $signed): self
    {
        $self = clone $this;
        $self['signed'] = $signed;

        return $self;
    }

    /**
     * An array of objects specifying the transformations to be applied in the URL. If more than one transformation is specified, they are applied in the order they are specified as chained transformations.
     * See [Chained transformations](https://imagekit.io/docs/transformations#chained-transformations).
     *
     * @param list<mixed> $transformation
     */
    public function withTransformation(array $transformation): self
    {
        $self = clone $this;
        $self['transformation'] = $transformation;

        return $self;
    }

    /**
     * By default, the transformation string is added as a query parameter in the URL, e.g., `?tr=w-100,h-100`.
     * If you want to add the transformation string in the path of the URL, set this to `path`.
     * Learn more in the [Transformations guide](https://imagekit.io/docs/transformations).
     *
     * @param TransformationPosition|value-of<TransformationPosition> $transformationPosition
     */
    public function withTransformationPosition(
        TransformationPosition|string $transformationPosition
    ): self {
        $self = clone $this;
        $self['transformationPosition'] = $transformationPosition;

        return $self;
    }

    /**
     * Custom list of **device-width breakpoints** in pixels.
     * These define common screen widths for responsive image generation.
     *
     * Defaults to `[640, 750, 828, 1080, 1200, 1920, 2048, 3840]`.
     * Sorted automatically.
     *
     * @param list<float> $deviceBreakpoints
     */
    public function withDeviceBreakpoints(array $deviceBreakpoints): self
    {
        $self = clone $this;
        $self['deviceBreakpoints'] = $deviceBreakpoints;

        return $self;
    }

    /**
     * Custom list of **image-specific breakpoints** in pixels.
     * Useful for generating small variants (e.g., placeholders or thumbnails).
     *
     * Merged with `deviceBreakpoints` before calculating `srcSet`.
     * Defaults to `[16, 32, 48, 64, 96, 128, 256, 384]`.
     * Sorted automatically.
     *
     * @param list<float> $imageBreakpoints
     */
    public function withImageBreakpoints(array $imageBreakpoints): self
    {
        $self = clone $this;
        $self['imageBreakpoints'] = $imageBreakpoints;

        return $self;
    }

    /**
     * The value for the HTML `sizes` attribute
     * (e.g., `"100vw"` or `"(min-width:768px) 50vw, 100vw"`).
     *
     * - If it includes one or more `vw` units, breakpoints smaller than the corresponding percentage of the smallest device width are excluded.
     * - If it contains no `vw` units, the full breakpoint list is used.
     *
     * Enables a width-based strategy and generates `w` descriptors in `srcSet`.
     */
    public function withSizes(string $sizes): self
    {
        $self = clone $this;
        $self['sizes'] = $sizes;

        return $self;
    }

    /**
     * The intended display width of the image in pixels,
     * used **only when the `sizes` attribute is not provided**.
     *
     * Triggers a DPR-based strategy (1x and 2x variants) and generates `x` descriptors in `srcSet`.
     *
     * Ignored if `sizes` is present.
     */
    public function withWidth(float $width): self
    {
        $self = clone $this;
        $self['width'] = $width;

        return $self;
    }
}
