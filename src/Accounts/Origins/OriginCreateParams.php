<?php

declare(strict_types=1);

namespace Imagekit\Accounts\Origins;

use Imagekit\Core\Attributes\Optional;
use Imagekit\Core\Attributes\Required;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Concerns\SdkParams;
use Imagekit\Core\Contracts\BaseModel;

/**
 * **Note:** This API is currently in beta.
 * Creates a new origin and returns the origin object.
 *
 * @see Imagekit\Services\Accounts\OriginsService::create()
 *
 * @phpstan-type OriginCreateParamsShape = array{
 *   type: 'AKENEO_PIM',
 *   accessKey: string,
 *   bucket: string,
 *   name: string,
 *   secretKey: string,
 *   baseURLForCanonicalHeader?: string|null,
 *   includeCanonicalHeader?: bool|null,
 *   prefix?: string|null,
 *   endpoint: string,
 *   s3ForcePathStyle?: bool|null,
 *   baseURL: string,
 *   forwardHostHeaderToOrigin?: bool|null,
 *   clientEmail: string,
 *   privateKey: string,
 *   accountName: string,
 *   container: string,
 *   sasToken: string,
 *   clientID: string,
 *   clientSecret: string,
 *   password: string,
 *   username: string,
 * }
 */
final class OriginCreateParams implements BaseModel
{
    /** @use SdkModel<OriginCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /** @var 'AKENEO_PIM' $type */
    #[Required]
    public string $type = 'AKENEO_PIM';

    /**
     * Access key for the bucket.
     */
    #[Required]
    public string $accessKey;

    #[Required]
    public string $bucket;

    /**
     * Display name of the origin.
     */
    #[Required]
    public string $name;

    /**
     * Secret key for the bucket.
     */
    #[Required]
    public string $secretKey;

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
     * Custom S3-compatible endpoint.
     */
    #[Required]
    public string $endpoint;

    /**
     * Use path-style S3 URLs?
     */
    #[Optional]
    public ?bool $s3ForcePathStyle;

    /**
     * Akeneo instance base URL.
     */
    #[Required('baseUrl')]
    public string $baseURL;

    /**
     * Forward the Host header to origin?
     */
    #[Optional]
    public ?bool $forwardHostHeaderToOrigin;

    #[Required]
    public string $clientEmail;

    #[Required]
    public string $privateKey;

    #[Required]
    public string $accountName;

    #[Required]
    public string $container;

    #[Required]
    public string $sasToken;

    /**
     * Akeneo API client ID.
     */
    #[Required('clientId')]
    public string $clientID;

    /**
     * Akeneo API client secret.
     */
    #[Required]
    public string $clientSecret;

    /**
     * Akeneo API password.
     */
    #[Required]
    public string $password;

    /**
     * Akeneo API username.
     */
    #[Required]
    public string $username;

    /**
     * `new OriginCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * OriginCreateParams::with(
     *   accessKey: ...,
     *   bucket: ...,
     *   name: ...,
     *   secretKey: ...,
     *   endpoint: ...,
     *   baseURL: ...,
     *   clientEmail: ...,
     *   privateKey: ...,
     *   accountName: ...,
     *   container: ...,
     *   sasToken: ...,
     *   clientID: ...,
     *   clientSecret: ...,
     *   password: ...,
     *   username: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new OriginCreateParams)
     *   ->withAccessKey(...)
     *   ->withBucket(...)
     *   ->withName(...)
     *   ->withSecretKey(...)
     *   ->withEndpoint(...)
     *   ->withBaseURL(...)
     *   ->withClientEmail(...)
     *   ->withPrivateKey(...)
     *   ->withAccountName(...)
     *   ->withContainer(...)
     *   ->withSasToken(...)
     *   ->withClientID(...)
     *   ->withClientSecret(...)
     *   ->withPassword(...)
     *   ->withUsername(...)
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
        string $accessKey,
        string $bucket,
        string $name,
        string $secretKey,
        string $endpoint,
        string $baseURL,
        string $clientEmail,
        string $privateKey,
        string $accountName,
        string $container,
        string $sasToken,
        string $clientID,
        string $clientSecret,
        string $password,
        string $username,
        ?string $baseURLForCanonicalHeader = null,
        ?bool $includeCanonicalHeader = null,
        ?string $prefix = null,
        ?bool $s3ForcePathStyle = null,
        ?bool $forwardHostHeaderToOrigin = null,
    ): self {
        $self = new self;

        $self['accessKey'] = $accessKey;
        $self['bucket'] = $bucket;
        $self['name'] = $name;
        $self['secretKey'] = $secretKey;
        $self['endpoint'] = $endpoint;
        $self['baseURL'] = $baseURL;
        $self['clientEmail'] = $clientEmail;
        $self['privateKey'] = $privateKey;
        $self['accountName'] = $accountName;
        $self['container'] = $container;
        $self['sasToken'] = $sasToken;
        $self['clientID'] = $clientID;
        $self['clientSecret'] = $clientSecret;
        $self['password'] = $password;
        $self['username'] = $username;

        null !== $baseURLForCanonicalHeader && $self['baseURLForCanonicalHeader'] = $baseURLForCanonicalHeader;
        null !== $includeCanonicalHeader && $self['includeCanonicalHeader'] = $includeCanonicalHeader;
        null !== $prefix && $self['prefix'] = $prefix;
        null !== $s3ForcePathStyle && $self['s3ForcePathStyle'] = $s3ForcePathStyle;
        null !== $forwardHostHeaderToOrigin && $self['forwardHostHeaderToOrigin'] = $forwardHostHeaderToOrigin;

        return $self;
    }

    /**
     * Access key for the bucket.
     */
    public function withAccessKey(string $accessKey): self
    {
        $self = clone $this;
        $self['accessKey'] = $accessKey;

        return $self;
    }

    public function withBucket(string $bucket): self
    {
        $self = clone $this;
        $self['bucket'] = $bucket;

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
     * Secret key for the bucket.
     */
    public function withSecretKey(string $secretKey): self
    {
        $self = clone $this;
        $self['secretKey'] = $secretKey;

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

    /**
     * Custom S3-compatible endpoint.
     */
    public function withEndpoint(string $endpoint): self
    {
        $self = clone $this;
        $self['endpoint'] = $endpoint;

        return $self;
    }

    /**
     * Use path-style S3 URLs?
     */
    public function withS3ForcePathStyle(bool $s3ForcePathStyle): self
    {
        $self = clone $this;
        $self['s3ForcePathStyle'] = $s3ForcePathStyle;

        return $self;
    }

    /**
     * Akeneo instance base URL.
     */
    public function withBaseURL(string $baseURL): self
    {
        $self = clone $this;
        $self['baseURL'] = $baseURL;

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

    public function withClientEmail(string $clientEmail): self
    {
        $self = clone $this;
        $self['clientEmail'] = $clientEmail;

        return $self;
    }

    public function withPrivateKey(string $privateKey): self
    {
        $self = clone $this;
        $self['privateKey'] = $privateKey;

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

    public function withSasToken(string $sasToken): self
    {
        $self = clone $this;
        $self['sasToken'] = $sasToken;

        return $self;
    }

    /**
     * Akeneo API client ID.
     */
    public function withClientID(string $clientID): self
    {
        $self = clone $this;
        $self['clientID'] = $clientID;

        return $self;
    }

    /**
     * Akeneo API client secret.
     */
    public function withClientSecret(string $clientSecret): self
    {
        $self = clone $this;
        $self['clientSecret'] = $clientSecret;

        return $self;
    }

    /**
     * Akeneo API password.
     */
    public function withPassword(string $password): self
    {
        $self = clone $this;
        $self['password'] = $password;

        return $self;
    }

    /**
     * Akeneo API username.
     */
    public function withUsername(string $username): self
    {
        $self = clone $this;
        $self['username'] = $username;

        return $self;
    }
}
