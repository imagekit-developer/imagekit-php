<?php

declare(strict_types=1);

namespace ImageKit\Accounts\Origins\OriginRequest;

use ImageKit\Core\Attributes\Optional;
use ImageKit\Core\Attributes\Required;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;

/**
 * @phpstan-type AzureBlobStorageShape = array{
 *   accountName: string,
 *   container: string,
 *   name: string,
 *   sasToken: string,
 *   type: 'AZURE_BLOB',
 *   baseURLForCanonicalHeader?: string|null,
 *   includeCanonicalHeader?: bool|null,
 *   prefix?: string|null,
 * }
 */
final class AzureBlobStorage implements BaseModel
{
    /** @use SdkModel<AzureBlobStorageShape> */
    use SdkModel;

    /** @var 'AZURE_BLOB' $type */
    #[Required]
    public string $type = 'AZURE_BLOB';

    #[Required]
    public string $accountName;

    #[Required]
    public string $container;

    /**
     * Display name of the origin.
     */
    #[Required]
    public string $name;

    #[Required]
    public string $sasToken;

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

    #[Optional]
    public ?string $prefix;

    /**
     * `new AzureBlobStorage()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AzureBlobStorage::with(
     *   accountName: ..., container: ..., name: ..., sasToken: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AzureBlobStorage)
     *   ->withAccountName(...)
     *   ->withContainer(...)
     *   ->withName(...)
     *   ->withSasToken(...)
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
        string $accountName,
        string $container,
        string $name,
        string $sasToken,
        ?string $baseURLForCanonicalHeader = null,
        ?bool $includeCanonicalHeader = null,
        ?string $prefix = null,
    ): self {
        $self = new self;

        $self['accountName'] = $accountName;
        $self['container'] = $container;
        $self['name'] = $name;
        $self['sasToken'] = $sasToken;

        null !== $baseURLForCanonicalHeader && $self['baseURLForCanonicalHeader'] = $baseURLForCanonicalHeader;
        null !== $includeCanonicalHeader && $self['includeCanonicalHeader'] = $includeCanonicalHeader;
        null !== $prefix && $self['prefix'] = $prefix;

        return $self;
    }

    public function withAccountName(string $accountName): self
    {
        $self = clone $this;
        $self['accountName'] = $accountName;

        return $self;
    }

    public function withContainer(string $container): self
    {
        $self = clone $this;
        $self['container'] = $container;

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

    public function withSasToken(string $sasToken): self
    {
        $self = clone $this;
        $self['sasToken'] = $sasToken;

        return $self;
    }

    /**
     * @param 'AZURE_BLOB' $type
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

    public function withPrefix(string $prefix): self
    {
        $self = clone $this;
        $self['prefix'] = $prefix;

        return $self;
    }
}
