<?php

declare(strict_types=1);

namespace ImageKit\Accounts\Origins\OriginRequest;

use ImageKit\Core\Attributes\Optional;
use ImageKit\Core\Attributes\Required;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;

/**
 * @phpstan-type WebFolderShape = array{
 *   baseURL: string,
 *   name: string,
 *   type: 'WEB_FOLDER',
 *   baseURLForCanonicalHeader?: string|null,
 *   forwardHostHeaderToOrigin?: bool|null,
 *   includeCanonicalHeader?: bool|null,
 * }
 */
final class WebFolder implements BaseModel
{
    /** @use SdkModel<WebFolderShape> */
    use SdkModel;

    /** @var 'WEB_FOLDER' $type */
    #[Required]
    public string $type = 'WEB_FOLDER';

    /**
     * Root URL for the web folder origin.
     */
    #[Required('base_url')]
    public string $baseURL;

    /**
     * Display name of the origin.
     */
    #[Required]
    public string $name;

    /**
     * URL used in the Canonical header (if enabled).
     */
    #[Optional('base_url_for_canonical_header')]
    public ?string $baseURLForCanonicalHeader;

    /**
     * Forward the Host header to origin?
     */
    #[Optional('forward_host_header_to_origin')]
    public ?bool $forwardHostHeaderToOrigin;

    /**
     * Whether to send a Canonical header.
     */
    #[Optional('include_canonical_header')]
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
        $this->initialize();
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
        $self = new self;

        $self['baseURL'] = $baseURL;
        $self['name'] = $name;

        null !== $baseURLForCanonicalHeader && $self['baseURLForCanonicalHeader'] = $baseURLForCanonicalHeader;
        null !== $forwardHostHeaderToOrigin && $self['forwardHostHeaderToOrigin'] = $forwardHostHeaderToOrigin;
        null !== $includeCanonicalHeader && $self['includeCanonicalHeader'] = $includeCanonicalHeader;

        return $self;
    }

    /**
     * Root URL for the web folder origin.
     */
    public function withBaseURL(string $baseURL): self
    {
        $self = clone $this;
        $self['baseURL'] = $baseURL;

        return $self;
    }

    /**
     * Display name of the origin.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * @param 'WEB_FOLDER' $type
     */
    public function withType(string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }

    /**
     * URL used in the Canonical header (if enabled).
     */
    public function withBaseURLForCanonicalHeader(
        string $baseURLForCanonicalHeader
    ): self {
        $self = clone $this;
        $self['baseURLForCanonicalHeader'] = $baseURLForCanonicalHeader;

        return $self;
    }

    /**
     * Forward the Host header to origin?
     */
    public function withForwardHostHeaderToOrigin(
        bool $forwardHostHeaderToOrigin
    ): self {
        $self = clone $this;
        $self['forwardHostHeaderToOrigin'] = $forwardHostHeaderToOrigin;

        return $self;
    }

    /**
     * Whether to send a Canonical header.
     */
    public function withIncludeCanonicalHeader(
        bool $includeCanonicalHeader
    ): self {
        $self = clone $this;
        $self['includeCanonicalHeader'] = $includeCanonicalHeader;

        return $self;
    }
}
