<?php

declare(strict_types=1);

namespace ImageKit\Accounts\Origins\OriginRequest;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;

/**
 * @phpstan-type WebFolderShape = array{
 *   baseUrl: string,
 *   name: string,
 *   type: 'WEB_FOLDER',
 *   baseUrlForCanonicalHeader?: string|null,
 *   forwardHostHeaderToOrigin?: bool|null,
 *   includeCanonicalHeader?: bool|null,
 * }
 */
final class WebFolder implements BaseModel
{
    /** @use SdkModel<WebFolderShape> */
    use SdkModel;

    /** @var 'WEB_FOLDER' $type */
    #[Api]
    public string $type = 'WEB_FOLDER';

    /**
     * Root URL for the web folder origin.
     */
    #[Api]
    public string $baseUrl;

    /**
     * Display name of the origin.
     */
    #[Api]
    public string $name;

    /**
     * URL used in the Canonical header (if enabled).
     */
    #[Api(optional: true)]
    public ?string $baseUrlForCanonicalHeader;

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
     * WebFolder::with(baseUrl: ..., name: ...)
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
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(
        string $baseUrl,
        string $name,
        ?string $baseUrlForCanonicalHeader = null,
        ?bool $forwardHostHeaderToOrigin = null,
        ?bool $includeCanonicalHeader = null,
    ): self {
        $obj = new self;

        $obj['baseUrl'] = $baseUrl;
        $obj['name'] = $name;

        null !== $baseUrlForCanonicalHeader && $obj['baseUrlForCanonicalHeader'] = $baseUrlForCanonicalHeader;
        null !== $forwardHostHeaderToOrigin && $obj['forwardHostHeaderToOrigin'] = $forwardHostHeaderToOrigin;
        null !== $includeCanonicalHeader && $obj['includeCanonicalHeader'] = $includeCanonicalHeader;

        return $obj;
    }

    /**
     * Root URL for the web folder origin.
     */
    public function withBaseURL(string $baseURL): self
    {
        $obj = clone $this;
        $obj['baseUrl'] = $baseURL;

        return $obj;
    }

    /**
     * Display name of the origin.
     */
    public function withName(string $name): self
    {
        $obj = clone $this;
        $obj['name'] = $name;

        return $obj;
    }

    /**
     * URL used in the Canonical header (if enabled).
     */
    public function withBaseURLForCanonicalHeader(
        string $baseURLForCanonicalHeader
    ): self {
        $obj = clone $this;
        $obj['baseUrlForCanonicalHeader'] = $baseURLForCanonicalHeader;

        return $obj;
    }

    /**
     * Forward the Host header to origin?
     */
    public function withForwardHostHeaderToOrigin(
        bool $forwardHostHeaderToOrigin
    ): self {
        $obj = clone $this;
        $obj['forwardHostHeaderToOrigin'] = $forwardHostHeaderToOrigin;

        return $obj;
    }

    /**
     * Whether to send a Canonical header.
     */
    public function withIncludeCanonicalHeader(
        bool $includeCanonicalHeader
    ): self {
        $obj = clone $this;
        $obj['includeCanonicalHeader'] = $includeCanonicalHeader;

        return $obj;
    }
}
