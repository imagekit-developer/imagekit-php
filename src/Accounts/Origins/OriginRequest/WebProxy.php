<?php

declare(strict_types=1);

namespace ImageKit\Accounts\Origins\OriginRequest;

use ImageKit\Core\Attributes\Optional;
use ImageKit\Core\Attributes\Required;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;

/**
 * @phpstan-type WebProxyShape = array{
 *   name: string,
 *   type: 'WEB_PROXY',
 *   baseURLForCanonicalHeader?: string|null,
 *   includeCanonicalHeader?: bool|null,
 * }
 */
final class WebProxy implements BaseModel
{
    /** @use SdkModel<WebProxyShape> */
    use SdkModel;

    /** @var 'WEB_PROXY' $type */
    #[Required]
    public string $type = 'WEB_PROXY';

    /**
     * Display name of the origin.
     */
    #[Required]
    public string $name;

    /**
     * URL used in the Canonical header (if enabled).
     */
    #[Optional('baseUrlForCanonicalHeader')]
    public ?string $baseURLForCanonicalHeader;

    /**
     * Whether to send a Canonical header.
     */
    #[Optional]
    public ?bool $includeCanonicalHeader;

    /**
     * `new WebProxy()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * WebProxy::with(name: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new WebProxy)->withName(...)
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
        string $name,
        ?string $baseURLForCanonicalHeader = null,
        ?bool $includeCanonicalHeader = null,
    ): self {
        $self = new self;

        $self['name'] = $name;

        null !== $baseURLForCanonicalHeader && $self['baseURLForCanonicalHeader'] = $baseURLForCanonicalHeader;
        null !== $includeCanonicalHeader && $self['includeCanonicalHeader'] = $includeCanonicalHeader;

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
     * @param 'WEB_PROXY' $type
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
