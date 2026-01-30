<?php

declare(strict_types=1);

namespace Imagekit\Accounts\Origins\OriginRequest;

use Imagekit\Core\Attributes\Optional;
use Imagekit\Core\Attributes\Required;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Contracts\BaseModel;

/**
 * @phpstan-type GoogleCloudStorageGcsShape = array{
 *   bucket: string,
 *   clientEmail: string,
 *   name: string,
 *   privateKey: string,
 *   type: 'GCS',
 *   baseURLForCanonicalHeader?: string|null,
 *   includeCanonicalHeader?: bool|null,
 *   prefix?: string|null,
 * }
 */
final class GoogleCloudStorageGcs implements BaseModel
{
    /** @use SdkModel<GoogleCloudStorageGcsShape> */
    use SdkModel;

    /** @var 'GCS' $type */
    #[Required]
    public string $type = 'GCS';

    #[Required]
    public string $bucket;

    #[Required]
    public string $clientEmail;

    /**
     * Display name of the origin.
     */
    #[Required]
    public string $name;

    #[Required]
    public string $privateKey;

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
     * `new GoogleCloudStorageGcs()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * GoogleCloudStorageGcs::with(
     *   bucket: ..., clientEmail: ..., name: ..., privateKey: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new GoogleCloudStorageGcs)
     *   ->withBucket(...)
     *   ->withClientEmail(...)
     *   ->withName(...)
     *   ->withPrivateKey(...)
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
        string $bucket,
        string $clientEmail,
        string $name,
        string $privateKey,
        ?string $baseURLForCanonicalHeader = null,
        ?bool $includeCanonicalHeader = null,
        ?string $prefix = null,
    ): self {
        $self = new self;

        $self['bucket'] = $bucket;
        $self['clientEmail'] = $clientEmail;
        $self['name'] = $name;
        $self['privateKey'] = $privateKey;

        null !== $baseURLForCanonicalHeader && $self['baseURLForCanonicalHeader'] = $baseURLForCanonicalHeader;
        null !== $includeCanonicalHeader && $self['includeCanonicalHeader'] = $includeCanonicalHeader;
        null !== $prefix && $self['prefix'] = $prefix;

        return $self;
    }

    public function withBucket(string $bucket): self
    {
        $self = clone $this;
        $self['bucket'] = $bucket;

        return $self;
    }

    public function withClientEmail(string $clientEmail): self
    {
        $self = clone $this;
        $self['clientEmail'] = $clientEmail;

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

    public function withPrivateKey(string $privateKey): self
    {
        $self = clone $this;
        $self['privateKey'] = $privateKey;

        return $self;
    }

    /**
     * @param 'GCS' $type
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
