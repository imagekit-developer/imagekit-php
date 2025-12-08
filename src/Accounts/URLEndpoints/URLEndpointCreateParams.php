<?php

declare(strict_types=1);

namespace Imagekit\Accounts\URLEndpoints;

use Imagekit\Accounts\URLEndpoints\URLEndpointCreateParams\URLRewriter;
use Imagekit\Accounts\URLEndpoints\URLEndpointCreateParams\URLRewriter\Akamai;
use Imagekit\Accounts\URLEndpoints\URLEndpointCreateParams\URLRewriter\Cloudinary;
use Imagekit\Accounts\URLEndpoints\URLEndpointCreateParams\URLRewriter\Imgix;
use Imagekit\Core\Attributes\Optional;
use Imagekit\Core\Attributes\Required;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Concerns\SdkParams;
use Imagekit\Core\Contracts\BaseModel;

/**
 * **Note:** This API is currently in beta.
 * Creates a new URL‑endpoint and returns the resulting object.
 *
 * @see Imagekit\Services\Accounts\URLEndpointsService::create()
 *
 * @phpstan-type URLEndpointCreateParamsShape = array{
 *   description: string,
 *   origins?: list<string>,
 *   urlPrefix?: string,
 *   urlRewriter?: Cloudinary|array{
 *     type: 'CLOUDINARY', preserveAssetDeliveryTypes?: bool|null
 *   }|Imgix|array{type: 'IMGIX'}|Akamai|array{type: 'AKAMAI'},
 * }
 */
final class URLEndpointCreateParams implements BaseModel
{
    /** @use SdkModel<URLEndpointCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Description of the URL endpoint.
     */
    #[Required]
    public string $description;

    /**
     * Ordered list of origin IDs to try when the file isn’t in the Media Library; ImageKit checks them in the sequence provided. Origin must be created before it can be used in a URL endpoint.
     *
     * @var list<string>|null $origins
     */
    #[Optional(list: 'string')]
    public ?array $origins;

    /**
     * Path segment appended to your base URL to form the endpoint (letters, digits, and hyphens only — or empty for the default endpoint).
     */
    #[Optional]
    public ?string $urlPrefix;

    /**
     * Configuration for third-party URL rewriting.
     */
    #[Optional(union: URLRewriter::class)]
    public Cloudinary|Imgix|Akamai|null $urlRewriter;

    /**
     * `new URLEndpointCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * URLEndpointCreateParams::with(description: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new URLEndpointCreateParams)->withDescription(...)
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
     * @param list<string> $origins
     * @param Cloudinary|array{
     *   type: 'CLOUDINARY', preserveAssetDeliveryTypes?: bool|null
     * }|Imgix|array{type: 'IMGIX'}|Akamai|array{type: 'AKAMAI'} $urlRewriter
     */
    public static function with(
        string $description,
        ?array $origins = null,
        ?string $urlPrefix = null,
        Cloudinary|array|Imgix|Akamai|null $urlRewriter = null,
    ): self {
        $obj = new self;

        $obj['description'] = $description;

        null !== $origins && $obj['origins'] = $origins;
        null !== $urlPrefix && $obj['urlPrefix'] = $urlPrefix;
        null !== $urlRewriter && $obj['urlRewriter'] = $urlRewriter;

        return $obj;
    }

    /**
     * Description of the URL endpoint.
     */
    public function withDescription(string $description): self
    {
        $obj = clone $this;
        $obj['description'] = $description;

        return $obj;
    }

    /**
     * Ordered list of origin IDs to try when the file isn’t in the Media Library; ImageKit checks them in the sequence provided. Origin must be created before it can be used in a URL endpoint.
     *
     * @param list<string> $origins
     */
    public function withOrigins(array $origins): self
    {
        $obj = clone $this;
        $obj['origins'] = $origins;

        return $obj;
    }

    /**
     * Path segment appended to your base URL to form the endpoint (letters, digits, and hyphens only — or empty for the default endpoint).
     */
    public function withURLPrefix(string $urlPrefix): self
    {
        $obj = clone $this;
        $obj['urlPrefix'] = $urlPrefix;

        return $obj;
    }

    /**
     * Configuration for third-party URL rewriting.
     *
     * @param Cloudinary|array{
     *   type: 'CLOUDINARY', preserveAssetDeliveryTypes?: bool|null
     * }|Imgix|array{type: 'IMGIX'}|Akamai|array{type: 'AKAMAI'} $urlRewriter
     */
    public function withURLRewriter(
        Cloudinary|array|Imgix|Akamai $urlRewriter
    ): self {
        $obj = clone $this;
        $obj['urlRewriter'] = $urlRewriter;

        return $obj;
    }
}
