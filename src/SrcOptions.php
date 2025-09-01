<?php

declare(strict_types=1);

namespace ImageKit;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;

/**
 * Options for generating ImageKit URLs with transformations. See the [Transformations guide](https://imagekit.io/docs/transformations).
 *
 * @phpstan-type src_options = array{
 *   src: string,
 *   urlEndpoint: string,
 *   expiresIn?: float|null,
 *   queryParameters?: array<string, string>|null,
 *   signed?: bool|null,
 *   transformation?: list<Transformation>|null,
 *   transformationPosition?: TransformationPosition::*|null,
 * }
 */
final class SrcOptions implements BaseModel
{
    /** @use SdkModel<src_options> */
    use SdkModel;

    /**
     * Accepts a relative or absolute path of the resource. If a relative path is provided, it is appended to the `urlEndpoint`.
     * If an absolute path is provided, `urlEndpoint` is ignored.
     */
    #[Api]
    public string $src;

    /**
     * Get your urlEndpoint from the [ImageKit dashboard](https://imagekit.io/dashboard/url-endpoints).
     */
    #[Api]
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
    #[Api(optional: true)]
    public ?float $expiresIn;

    /**
     * These are additional query parameters that you want to add to the final URL.
     * They can be any query parameters and not necessarily related to ImageKit.
     * This is especially useful if you want to add a versioning parameter to your URLs.
     *
     * @var array<string, string>|null $queryParameters
     */
    #[Api(map: 'string', optional: true)]
    public ?array $queryParameters;

    /**
     * Whether to sign the URL or not. Set this to `true` if you want to generate a signed URL.
     * If `signed` is `true` and `expiresIn` is not specified, the signed URL will not expire (valid indefinitely).
     * Note: If `expiresIn` is set to any value above 0, the URL will always be signed regardless of this setting.
     * [Learn more](https://imagekit.io/docs/media-delivery-basic-security#how-to-generate-signed-urls).
     */
    #[Api(optional: true)]
    public ?bool $signed;

    /**
     * An array of objects specifying the transformations to be applied in the URL. If more than one transformation is specified, they are applied in the order they are specified as chained transformations.
     * See [Chained transformations](https://imagekit.io/docs/transformations#chained-transformations).
     *
     * @var list<Transformation>|null $transformation
     */
    #[Api(list: Transformation::class, optional: true)]
    public ?array $transformation;

    /**
     * By default, the transformation string is added as a query parameter in the URL, e.g., `?tr=w-100,h-100`.
     * If you want to add the transformation string in the path of the URL, set this to `path`.
     * Learn more in the [Transformations guide](https://imagekit.io/docs/transformations).
     *
     * @var TransformationPosition::*|null $transformationPosition
     */
    #[Api(enum: TransformationPosition::class, optional: true)]
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
     * @param array<string, string> $queryParameters
     * @param list<Transformation> $transformation
     * @param TransformationPosition::* $transformationPosition
     */
    public static function with(
        string $src,
        string $urlEndpoint,
        ?float $expiresIn = null,
        ?array $queryParameters = null,
        ?bool $signed = null,
        ?array $transformation = null,
        ?string $transformationPosition = null,
    ): self {
        $obj = new self;

        $obj->src = $src;
        $obj->urlEndpoint = $urlEndpoint;

        null !== $expiresIn && $obj->expiresIn = $expiresIn;
        null !== $queryParameters && $obj->queryParameters = $queryParameters;
        null !== $signed && $obj->signed = $signed;
        null !== $transformation && $obj->transformation = $transformation;
        null !== $transformationPosition && $obj->transformationPosition = $transformationPosition;

        return $obj;
    }

    /**
     * Accepts a relative or absolute path of the resource. If a relative path is provided, it is appended to the `urlEndpoint`.
     * If an absolute path is provided, `urlEndpoint` is ignored.
     */
    public function withSrc(string $src): self
    {
        $obj = clone $this;
        $obj->src = $src;

        return $obj;
    }

    /**
     * Get your urlEndpoint from the [ImageKit dashboard](https://imagekit.io/dashboard/url-endpoints).
     */
    public function withURLEndpoint(string $urlEndpoint): self
    {
        $obj = clone $this;
        $obj->urlEndpoint = $urlEndpoint;

        return $obj;
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
        $obj = clone $this;
        $obj->expiresIn = $expiresIn;

        return $obj;
    }

    /**
     * These are additional query parameters that you want to add to the final URL.
     * They can be any query parameters and not necessarily related to ImageKit.
     * This is especially useful if you want to add a versioning parameter to your URLs.
     *
     * @param array<string, string> $queryParameters
     */
    public function withQueryParameters(array $queryParameters): self
    {
        $obj = clone $this;
        $obj->queryParameters = $queryParameters;

        return $obj;
    }

    /**
     * Whether to sign the URL or not. Set this to `true` if you want to generate a signed URL.
     * If `signed` is `true` and `expiresIn` is not specified, the signed URL will not expire (valid indefinitely).
     * Note: If `expiresIn` is set to any value above 0, the URL will always be signed regardless of this setting.
     * [Learn more](https://imagekit.io/docs/media-delivery-basic-security#how-to-generate-signed-urls).
     */
    public function withSigned(bool $signed): self
    {
        $obj = clone $this;
        $obj->signed = $signed;

        return $obj;
    }

    /**
     * An array of objects specifying the transformations to be applied in the URL. If more than one transformation is specified, they are applied in the order they are specified as chained transformations.
     * See [Chained transformations](https://imagekit.io/docs/transformations#chained-transformations).
     *
     * @param list<Transformation> $transformation
     */
    public function withTransformation(array $transformation): self
    {
        $obj = clone $this;
        $obj->transformation = $transformation;

        return $obj;
    }

    /**
     * By default, the transformation string is added as a query parameter in the URL, e.g., `?tr=w-100,h-100`.
     * If you want to add the transformation string in the path of the URL, set this to `path`.
     * Learn more in the [Transformations guide](https://imagekit.io/docs/transformations).
     *
     * @param TransformationPosition::* $transformationPosition
     */
    public function withTransformationPosition(
        string $transformationPosition
    ): self {
        $obj = clone $this;
        $obj->transformationPosition = $transformationPosition;

        return $obj;
    }
}
