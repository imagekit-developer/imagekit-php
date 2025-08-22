<?php

declare(strict_types=1);

namespace ImageKit\Accounts\Origins\OriginCreateParams\Origin;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;

/**
 * @phpstan-type web_folder_alias = array{
 *   baseURL: string,
 *   name: string,
 *   type: string,
 *   baseURLForCanonicalHeader?: string,
 *   forwardHostHeaderToOrigin?: bool,
 *   includeCanonicalHeader?: bool,
 * }
 */
final class WebFolder implements BaseModel
{
    use SdkModel;

    #[Api]
    public string $type = 'WEB_FOLDER';

    /**
     * Root URL for the web folder origin.
     */
    #[Api('baseUrl')]
    public string $baseURL;

    /**
     * Display name of the origin.
     */
    #[Api]
    public string $name;

    /**
     * URL used in the Canonical header (if enabled).
     */
    #[Api('baseUrlForCanonicalHeader', optional: true)]
    public ?string $baseURLForCanonicalHeader;

    /**
     * Forward the Host header to origin?
     */
    #[Api(optional: true)]
    public ?bool $forwardHostHeaderToOrigin;

    /**
     * Whether to send a Canonical header.
     */
    #[Api(optional: true)]
    public ?bool $includeCanonicalHeader;

    /**
     * `new WebFolder()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * WebFolder::with(baseURL: ..., name: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new WebFolder)->withBaseURL(...)->withName(...)
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
     */
    public static function with(
        string $baseURL,
        string $name,
        ?string $baseURLForCanonicalHeader = null,
        ?bool $forwardHostHeaderToOrigin = null,
        ?bool $includeCanonicalHeader = null,
    ): self {
        $obj = new self;

        $obj->baseURL = $baseURL;
        $obj->name = $name;

        null !== $baseURLForCanonicalHeader && $obj->baseURLForCanonicalHeader = $baseURLForCanonicalHeader;
        null !== $forwardHostHeaderToOrigin && $obj->forwardHostHeaderToOrigin = $forwardHostHeaderToOrigin;
        null !== $includeCanonicalHeader && $obj->includeCanonicalHeader = $includeCanonicalHeader;

        return $obj;
    }

    /**
     * Root URL for the web folder origin.
     */
    public function withBaseURL(string $baseURL): self
    {
        $obj = clone $this;
        $obj->baseURL = $baseURL;

        return $obj;
    }

    /**
     * Display name of the origin.
     */
    public function withName(string $name): self
    {
        $obj = clone $this;
        $obj->name = $name;

        return $obj;
    }

    /**
     * URL used in the Canonical header (if enabled).
     */
    public function withBaseURLForCanonicalHeader(
        string $baseURLForCanonicalHeader
    ): self {
        $obj = clone $this;
        $obj->baseURLForCanonicalHeader = $baseURLForCanonicalHeader;

        return $obj;
    }

    /**
     * Forward the Host header to origin?
     */
    public function withForwardHostHeaderToOrigin(
        bool $forwardHostHeaderToOrigin
    ): self {
        $obj = clone $this;
        $obj->forwardHostHeaderToOrigin = $forwardHostHeaderToOrigin;

        return $obj;
    }

    /**
     * Whether to send a Canonical header.
     */
    public function withIncludeCanonicalHeader(
        bool $includeCanonicalHeader
    ): self {
        $obj = clone $this;
        $obj->includeCanonicalHeader = $includeCanonicalHeader;

        return $obj;
    }
}
