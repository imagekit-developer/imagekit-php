<?php

declare(strict_types=1);

namespace Imagekit\Accounts\URLEndpoints;

use Imagekit\Accounts\URLEndpoints\URLEndpointUpdateParams\URLRewriter;
use Imagekit\Accounts\URLEndpoints\URLEndpointUpdateParams\URLRewriter\AkamaiURLRewriter;
use Imagekit\Accounts\URLEndpoints\URLEndpointUpdateParams\URLRewriter\CloudinaryURLRewriter;
use Imagekit\Accounts\URLEndpoints\URLEndpointUpdateParams\URLRewriter\ImgixURLRewriter;
use Imagekit\Core\Attributes\Optional;
use Imagekit\Core\Attributes\Required;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Concerns\SdkParams;
use Imagekit\Core\Contracts\BaseModel;

/**
 * **Note:** This API is currently in beta.
 * Updates the URL‑endpoint identified by `id` and returns the updated object.
 *
 * @see Imagekit\Services\Accounts\URLEndpointsService::update()
 *
 * @phpstan-import-type URLRewriterShape from \Imagekit\Accounts\URLEndpoints\URLEndpointUpdateParams\URLRewriter
 *
 * @phpstan-type URLEndpointUpdateParamsShape = array{
 *   description: string,
 *   origins?: list<string>|null,
 *   urlPrefix?: string|null,
 *   urlRewriter?: URLRewriterShape|null,
 * }
 */
final class URLEndpointUpdateParams implements BaseModel
{
    /** @use SdkModel<URLEndpointUpdateParamsShape> */
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
    public CloudinaryURLRewriter|ImgixURLRewriter|AkamaiURLRewriter|null $urlRewriter;

    /**
     * `new URLEndpointUpdateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * URLEndpointUpdateParams::with(description: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new URLEndpointUpdateParams)->withDescription(...)
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
     * @param URLRewriterShape $urlRewriter
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
