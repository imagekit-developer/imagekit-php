<?php

declare(strict_types=1);

namespace ImageKit\Accounts\Origins\OriginRequest;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;

/**
 * @phpstan-type WebProxyShape = array{
 *   name: string,
 *   type: 'WEB_PROXY',
 *   baseUrlForCanonicalHeader?: string|null,
 *   includeCanonicalHeader?: bool|null,
 * }
 */
final class WebProxy implements BaseModel
{
    /** @use SdkModel<WebProxyShape> */
    use SdkModel;

    /** @var 'WEB_PROXY' $type */
    #[Api]
    public string $type = 'WEB_PROXY';

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
     * Whether to send a Canonical header.
     */
    #[Api(optional: true)]
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
        ?string $baseUrlForCanonicalHeader = null,
        ?bool $includeCanonicalHeader = null,
    ): self {
        $obj = new self;

        $obj['name'] = $name;

        null !== $baseUrlForCanonicalHeader && $obj['baseUrlForCanonicalHeader'] = $baseUrlForCanonicalHeader;
        null !== $includeCanonicalHeader && $obj['includeCanonicalHeader'] = $includeCanonicalHeader;

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
