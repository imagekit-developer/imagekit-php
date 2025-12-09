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
 *   accessKey: string,
 *   bucket: string,
 *   name: string,
 *   secretKey: string,
 *   type: 'AKENEO_PIM',
 *   baseURLForCanonicalHeader?: string,
 *   includeCanonicalHeader?: bool,
 *   prefix?: string,
 *   endpoint: string,
 *   s3ForcePathStyle?: bool,
 *   baseURL: string,
 *   forwardHostHeaderToOrigin?: bool,
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
        $obj = new self;

        $obj['accessKey'] = $accessKey;
        $obj['bucket'] = $bucket;
        $obj['name'] = $name;
        $obj['secretKey'] = $secretKey;
        $obj['endpoint'] = $endpoint;
        $obj['baseURL'] = $baseURL;
        $obj['clientEmail'] = $clientEmail;
        $obj['privateKey'] = $privateKey;
        $obj['accountName'] = $accountName;
        $obj['container'] = $container;
        $obj['sasToken'] = $sasToken;
        $obj['clientID'] = $clientID;
        $obj['clientSecret'] = $clientSecret;
        $obj['password'] = $password;
        $obj['username'] = $username;

        null !== $baseURLForCanonicalHeader && $obj['baseURLForCanonicalHeader'] = $baseURLForCanonicalHeader;
        null !== $includeCanonicalHeader && $obj['includeCanonicalHeader'] = $includeCanonicalHeader;
        null !== $prefix && $obj['prefix'] = $prefix;
        null !== $s3ForcePathStyle && $obj['s3ForcePathStyle'] = $s3ForcePathStyle;
        null !== $forwardHostHeaderToOrigin && $obj['forwardHostHeaderToOrigin'] = $forwardHostHeaderToOrigin;

        return $obj;
    }

    /**
     * Access key for the bucket.
     */
    public function withAccessKey(string $accessKey): self
    {
        $obj = clone $this;
        $obj['accessKey'] = $accessKey;

        return $obj;
    }

    public function withBucket(string $bucket): self
    {
        $obj = clone $this;
        $obj['bucket'] = $bucket;

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
     * Secret key for the bucket.
     */
    public function withSecretKey(string $secretKey): self
    {
        $obj = clone $this;
        $obj['secretKey'] = $secretKey;

        return $obj;
    }

    /**
     * URL used in the Canonical header (if enabled).
     */
    public function withBaseURLForCanonicalHeader(
        string $baseURLForCanonicalHeader
    ): self {
        $obj = clone $this;
        $obj['baseURLForCanonicalHeader'] = $baseURLForCanonicalHeader;

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

    public function withPrefix(string $prefix): self
    {
        $obj = clone $this;
        $obj['prefix'] = $prefix;

        return $obj;
    }

    /**
     * Custom S3-compatible endpoint.
     */
    public function withEndpoint(string $endpoint): self
    {
        $obj = clone $this;
        $obj['endpoint'] = $endpoint;

        return $obj;
    }

    /**
     * Use path-style S3 URLs?
     */
    public function withS3ForcePathStyle(bool $s3ForcePathStyle): self
    {
        $obj = clone $this;
        $obj['s3ForcePathStyle'] = $s3ForcePathStyle;

        return $obj;
    }

    /**
     * Akeneo instance base URL.
     */
    public function withBaseURL(string $baseURL): self
    {
        $obj = clone $this;
        $obj['baseURL'] = $baseURL;

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

    public function withClientEmail(string $clientEmail): self
    {
        $obj = clone $this;
        $obj['clientEmail'] = $clientEmail;

        return $obj;
    }

    public function withPrivateKey(string $privateKey): self
    {
        $obj = clone $this;
        $obj['privateKey'] = $privateKey;

        return $obj;
    }

    public function withAccountName(string $accountName): self
    {
        $obj = clone $this;
        $obj['accountName'] = $accountName;

        return $obj;
    }

    public function withContainer(string $container): self
    {
        $obj = clone $this;
        $obj['container'] = $container;

        return $obj;
    }

    public function withSasToken(string $sasToken): self
    {
        $obj = clone $this;
        $obj['sasToken'] = $sasToken;

        return $obj;
    }

    /**
     * Akeneo API client ID.
     */
    public function withClientID(string $clientID): self
    {
        $obj = clone $this;
        $obj['clientID'] = $clientID;

        return $obj;
    }

    /**
     * Akeneo API client secret.
     */
    public function withClientSecret(string $clientSecret): self
    {
        $obj = clone $this;
        $obj['clientSecret'] = $clientSecret;

        return $obj;
    }

    /**
     * Akeneo API password.
     */
    public function withPassword(string $password): self
    {
        $obj = clone $this;
        $obj['password'] = $password;

        return $obj;
    }

    /**
     * Akeneo API username.
     */
    public function withUsername(string $username): self
    {
        $obj = clone $this;
        $obj['username'] = $username;

        return $obj;
    }
}
