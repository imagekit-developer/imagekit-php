<?php

declare(strict_types=1);

namespace ImageKit\Accounts\Origins\OriginRequest;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;

/**
 * @phpstan-type azure_blob = array{
 *   accountName: string,
 *   container: string,
 *   name: string,
 *   sasToken: string,
 *   type: string,
 *   baseURLForCanonicalHeader?: string|null,
 *   includeCanonicalHeader?: bool|null,
 *   prefix?: string|null,
 * }
 */
final class AzureBlob implements BaseModel
{
    /** @use SdkModel<azure_blob> */
    use SdkModel;

    #[Api]
    public string $type = 'AZURE_BLOB';

    #[Api]
    public string $accountName;

    #[Api]
    public string $container;

    /**
     * Display name of the origin.
     */
    #[Api]
    public string $name;

    #[Api]
    public string $sasToken;

    /**
     * URL used in the Canonical header (if enabled).
     */
    #[Api('baseUrlForCanonicalHeader', optional: true)]
    public ?string $baseURLForCanonicalHeader;

    /**
     * Whether to send a Canonical header.
     */
    #[Api(optional: true)]
    public ?bool $includeCanonicalHeader;

    #[Api(optional: true)]
    public ?string $prefix;

    /**
     * `new AzureBlob()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AzureBlob::with(accountName: ..., container: ..., name: ..., sasToken: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AzureBlob)
     *   ->withAccountName(...)
     *   ->withContainer(...)
     *   ->withName(...)
     *   ->withSasToken(...)
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
        string $accountName,
        string $container,
        string $name,
        string $sasToken,
        ?string $baseURLForCanonicalHeader = null,
        ?bool $includeCanonicalHeader = null,
        ?string $prefix = null,
    ): self {
        $obj = new self;

        $obj->accountName = $accountName;
        $obj->container = $container;
        $obj->name = $name;
        $obj->sasToken = $sasToken;

        null !== $baseURLForCanonicalHeader && $obj->baseURLForCanonicalHeader = $baseURLForCanonicalHeader;
        null !== $includeCanonicalHeader && $obj->includeCanonicalHeader = $includeCanonicalHeader;
        null !== $prefix && $obj->prefix = $prefix;

        return $obj;
    }

    public function withAccountName(string $accountName): self
    {
        $obj = clone $this;
        $obj->accountName = $accountName;

        return $obj;
    }

    public function withContainer(string $container): self
    {
        $obj = clone $this;
        $obj->container = $container;

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

    public function withSasToken(string $sasToken): self
    {
        $obj = clone $this;
        $obj->sasToken = $sasToken;

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
     * Whether to send a Canonical header.
     */
    public function withIncludeCanonicalHeader(
        bool $includeCanonicalHeader
    ): self {
        $obj = clone $this;
        $obj->includeCanonicalHeader = $includeCanonicalHeader;

        return $obj;
    }

    public function withPrefix(string $prefix): self
    {
        $obj = clone $this;
        $obj->prefix = $prefix;

        return $obj;
    }
}
