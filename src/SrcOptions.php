<?php

declare(strict_types=1);

namespace Imagekit;

use Imagekit\Core\Attributes\Optional;
use Imagekit\Core\Attributes\Required;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Contracts\BaseModel;

/**
 * Options for generating ImageKit URLs with transformations. See the [Transformations guide](https://imagekit.io/docs/transformations).
 *
 * @phpstan-type SrcOptionsShape = array{
 *   src: string,
 *   urlEndpoint: string,
 *   expiresIn?: float|null,
 *   queryParameters?: array<string,string>|null,
 *   signed?: bool|null,
 *   transformation?: list<mixed>|null,
 *   transformationPosition?: null|TransformationPosition|value-of<TransformationPosition>,
 * }
 */
final class SrcOptions implements BaseModel
{
    /** @use SdkModel<SrcOptionsShape> */
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
     * `new SrcOptions()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SrcOptions::with(src: ..., urlEndpoint: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SrcOptions)->withSrc(...)->withURLEndpoint(...)
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
     */
    public static function with(
        string $src,
        string $urlEndpoint,
        ?float $expiresIn = null,
        ?array $queryParameters = null,
        ?bool $signed = null,
        ?array $transformation = null,
        TransformationPosition|string|null $transformationPosition = null,
    ): self {
        $self = new self;

        $self['src'] = $src;
        $self['urlEndpoint'] = $urlEndpoint;

        null !== $expiresIn && $self['expiresIn'] = $expiresIn;
        null !== $queryParameters && $self['queryParameters'] = $queryParameters;
        null !== $signed && $self['signed'] = $signed;
        null !== $transformation && $self['transformation'] = $transformation;
        null !== $transformationPosition && $self['transformationPosition'] = $transformationPosition;

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
}
