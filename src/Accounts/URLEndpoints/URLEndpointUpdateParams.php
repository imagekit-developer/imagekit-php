<?php

declare(strict_types=1);

namespace ImageKit\Accounts\URLEndpoints;

use ImageKit\Accounts\URLEndpoints\URLEndpointUpdateParams\URLRewriter\AkamaiURLRewriter;
use ImageKit\Accounts\URLEndpoints\URLEndpointUpdateParams\URLRewriter\CloudinaryURLRewriter;
use ImageKit\Accounts\URLEndpoints\URLEndpointUpdateParams\URLRewriter\ImgixURLRewriter;
use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Concerns\SdkParams;
use ImageKit\Core\Contracts\BaseModel;
use ImageKit\Core\Conversion\ListOf;

/**
 * **Note:** This API is currently in beta.
 * Updates the URL‑endpoint identified by `id` and returns the updated object.
 *
 * @phpstan-type update_params = array{
 *   description: string,
 *   origins?: list<string>,
 *   urlPrefix?: string,
 *   urlRewriter?: CloudinaryURLRewriter|ImgixURLRewriter|AkamaiURLRewriter,
 * }
 */
final class URLEndpointUpdateParams implements BaseModel
{
    use SdkModel;
    use SdkParams;

    /**
     * Description of the URL endpoint.
     */
    #[Api]
    public string $description;

    /**
     * Ordered list of origin IDs to try when the file isn’t in the Media Library; ImageKit checks them in the sequence provided. Origin must be created before it can be used in a URL endpoint.
     *
     * @var null|list<string> $origins
     */
    #[Api(type: new ListOf('string'), optional: true)]
    public ?array $origins;

    /**
     * Path segment appended to your base URL to form the endpoint (letters, digits, and hyphens only — or empty for the default endpoint).
     */
    #[Api(optional: true)]
    public ?string $urlPrefix;

    /**
     * Configuration for third-party URL rewriting.
     */
    #[Api(optional: true)]
    public null|AkamaiURLRewriter|CloudinaryURLRewriter|ImgixURLRewriter $urlRewriter;

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
        self::introspect();
        $this->unsetOptionalProperties();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param null|list<string> $origins
     */
    public static function with(
        string $description,
        ?array $origins = null,
        ?string $urlPrefix = null,
        null|AkamaiURLRewriter|CloudinaryURLRewriter|ImgixURLRewriter $urlRewriter = null,
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
    public function withURLRewriter(
        AkamaiURLRewriter|CloudinaryURLRewriter|ImgixURLRewriter $urlRewriter
    ): self {
        $obj = clone $this;
        $obj->urlRewriter = $urlRewriter;

        return $obj;
    }
}
