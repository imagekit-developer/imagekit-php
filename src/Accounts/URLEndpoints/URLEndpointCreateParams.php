<?php

declare(strict_types=1);

namespace ImageKit\Accounts\URLEndpoints;

use ImageKit\Accounts\URLEndpoints\URLEndpointCreateParams\URLRewriter;
use ImageKit\Accounts\URLEndpoints\URLEndpointCreateParams\URLRewriter\AkamaiURLRewriter;
use ImageKit\Accounts\URLEndpoints\URLEndpointCreateParams\URLRewriter\CloudinaryURLRewriter;
use ImageKit\Accounts\URLEndpoints\URLEndpointCreateParams\URLRewriter\ImgixURLRewriter;
use ImageKit\Core\Attributes\Optional;
use ImageKit\Core\Attributes\Required;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Concerns\SdkParams;
use ImageKit\Core\Contracts\BaseModel;

/**
 * **Note:** This API is currently in beta.
 * Creates a new URL‑endpoint and returns the resulting object.
 *
 * @see ImageKit\Services\Accounts\URLEndpointsService::create()
 *
 * @phpstan-import-type URLRewriterVariants from \ImageKit\Accounts\URLEndpoints\URLEndpointCreateParams\URLRewriter
 * @phpstan-import-type URLRewriterShape from \ImageKit\Accounts\URLEndpoints\URLEndpointCreateParams\URLRewriter
 *
 * @phpstan-type URLEndpointCreateParamsShape = array{
 *   description: string,
 *   origins?: list<string>|null,
 *   urlPrefix?: string|null,
 *   urlRewriter?: URLRewriterShape|null,
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
    #[Optional('url_prefix')]
    public ?string $urlPrefix;

    /**
     * Configuration for third-party URL rewriting.
     *
     * @var URLRewriterVariants|null $urlRewriter
     */
    #[Optional('url_rewriter', union: URLRewriter::class)]
    public CloudinaryURLRewriter|ImgixURLRewriter|AkamaiURLRewriter|null $urlRewriter;

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
     * @param list<string>|null $origins
     * @param URLRewriterShape|null $urlRewriter
     */
    public static function with(
        string $description,
        ?array $origins = null,
        ?string $urlPrefix = null,
        CloudinaryURLRewriter|array|ImgixURLRewriter|AkamaiURLRewriter|null $urlRewriter = null,
    ): self {
        $self = new self;

        $self['description'] = $description;

        null !== $origins && $self['origins'] = $origins;
        null !== $urlPrefix && $self['urlPrefix'] = $urlPrefix;
        null !== $urlRewriter && $self['urlRewriter'] = $urlRewriter;

        return $self;
    }

    /**
     * Description of the URL endpoint.
     */
    public function withDescription(string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * Ordered list of origin IDs to try when the file isn’t in the Media Library; ImageKit checks them in the sequence provided. Origin must be created before it can be used in a URL endpoint.
     *
     * @param list<string> $origins
     */
    public function withOrigins(array $origins): self
    {
        $self = clone $this;
        $self['origins'] = $origins;

        return $self;
    }

    /**
     * Path segment appended to your base URL to form the endpoint (letters, digits, and hyphens only — or empty for the default endpoint).
     */
    public function withURLPrefix(string $urlPrefix): self
    {
        $self = clone $this;
        $self['urlPrefix'] = $urlPrefix;

        return $self;
    }

    /**
     * Configuration for third-party URL rewriting.
     *
     * @param URLRewriterShape $urlRewriter
     */
    public function withURLRewriter(
        CloudinaryURLRewriter|array|ImgixURLRewriter|AkamaiURLRewriter $urlRewriter
    ): self {
        $self = clone $this;
        $self['urlRewriter'] = $urlRewriter;

        return $self;
    }
}
