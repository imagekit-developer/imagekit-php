<?php

declare(strict_types=1);

namespace ImageKit\Accounts\URLEndpoints;

use ImageKit\Accounts\URLEndpoints\URLEndpointRequest\URLRewriter;
use ImageKit\Accounts\URLEndpoints\URLEndpointRequest\URLRewriter\Akamai;
use ImageKit\Accounts\URLEndpoints\URLEndpointRequest\URLRewriter\Cloudinary;
use ImageKit\Accounts\URLEndpoints\URLEndpointRequest\URLRewriter\Imgix;
use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;

/**
 * Schema for URL endpoint resource.
 *
 * @phpstan-type URLEndpointRequestShape = array{
 *   description: string,
 *   origins?: list<string>|null,
 *   urlPrefix?: string|null,
 *   urlRewriter?: null|Cloudinary|Imgix|Akamai,
 * }
 */
final class URLEndpointRequest implements BaseModel
{
    /** @use SdkModel<URLEndpointRequestShape> */
    use SdkModel;

    /**
     * Description of the URL endpoint.
     */
    #[Api]
    public string $description;

    /**
     * Ordered list of origin IDs to try when the file isn’t in the Media Library; ImageKit checks them in the sequence provided. Origin must be created before it can be used in a URL endpoint.
     *
     * @var list<string>|null $origins
     */
    #[Api(list: 'string', optional: true)]
    public ?array $origins;

    /**
     * Path segment appended to your base URL to form the endpoint (letters, digits, and hyphens only — or empty for the default endpoint).
     */
    #[Api(optional: true)]
    public ?string $urlPrefix;

    /**
     * Configuration for third-party URL rewriting.
     */
    #[Api(union: URLRewriter::class, optional: true)]
    public Cloudinary|Imgix|Akamai|null $urlRewriter;

    /**
     * `new URLEndpointRequest()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * URLEndpointRequest::with(description: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new URLEndpointRequest)->withDescription(...)
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
     */
    public static function with(
        string $description,
        ?array $origins = null,
        ?string $urlPrefix = null,
        Cloudinary|Imgix|Akamai|null $urlRewriter = null,
    ): self {
        $obj = new self;

        $obj->description = $description;

        null !== $origins && $obj->origins = $origins;
        null !== $urlPrefix && $obj->urlPrefix = $urlPrefix;
        null !== $urlRewriter && $obj->urlRewriter = $urlRewriter;

        return $obj;
    }

    /**
     * Description of the URL endpoint.
     */
    public function withDescription(string $description): self
    {
        $obj = clone $this;
        $obj->description = $description;

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
        $obj->origins = $origins;

        return $obj;
    }

    /**
     * Path segment appended to your base URL to form the endpoint (letters, digits, and hyphens only — or empty for the default endpoint).
     */
    public function withURLPrefix(string $urlPrefix): self
    {
        $obj = clone $this;
        $obj->urlPrefix = $urlPrefix;

        return $obj;
    }

    /**
     * Configuration for third-party URL rewriting.
     */
    public function withURLRewriter(Cloudinary|Imgix|Akamai $urlRewriter): self
    {
        $obj = clone $this;
        $obj->urlRewriter = $urlRewriter;

        return $obj;
    }
}
