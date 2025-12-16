<?php

declare(strict_types=1);

namespace Imagekit\Accounts\Origins\OriginRequest;

use Imagekit\Core\Attributes\Optional;
use Imagekit\Core\Attributes\Required;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Contracts\BaseModel;

/**
 * @phpstan-type S3CompatibleShape = array{
 *   accessKey: string,
 *   bucket: string,
 *   endpoint: string,
 *   name: string,
 *   secretKey: string,
 *   type: 'S3_COMPATIBLE',
 *   baseURLForCanonicalHeader?: string|null,
 *   includeCanonicalHeader?: bool|null,
 *   prefix?: string|null,
 *   s3ForcePathStyle?: bool|null,
 * }
 */
final class S3Compatible implements BaseModel
{
    /** @use SdkModel<S3CompatibleShape> */
    use SdkModel;

    /** @var 'S3_COMPATIBLE' $type */
    #[Required]
    public string $type = 'S3_COMPATIBLE';

    /**
     * Access key for the bucket.
     */
    #[Required]
    public string $accessKey;

    /**
     * S3 bucket name.
     */
    #[Required]
    public string $bucket;

    /**
     * Custom S3-compatible endpoint.
     */
    #[Required]
    public string $endpoint;

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

    /**
     * Path prefix inside the bucket.
     */
    #[Optional]
    public ?string $prefix;

    /**
     * Use path-style S3 URLs?
     */
    #[Optional]
    public ?bool $s3ForcePathStyle;

    /**
     * `new S3Compatible()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * S3Compatible::with(
     *   accessKey: ..., bucket: ..., endpoint: ..., name: ..., secretKey: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new S3Compatible)
     *   ->withAccessKey(...)
     *   ->withBucket(...)
     *   ->withEndpoint(...)
     *   ->withName(...)
     *   ->withSecretKey(...)
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
        string $endpoint,
        string $name,
        string $secretKey,
        ?string $baseURLForCanonicalHeader = null,
        ?bool $includeCanonicalHeader = null,
        ?string $prefix = null,
        ?bool $s3ForcePathStyle = null,
    ): self {
        $self = new self;

        $self['accessKey'] = $accessKey;
        $self['bucket'] = $bucket;
        $self['endpoint'] = $endpoint;
        $self['name'] = $name;
        $self['secretKey'] = $secretKey;

        null !== $baseURLForCanonicalHeader && $self['baseURLForCanonicalHeader'] = $baseURLForCanonicalHeader;
        null !== $includeCanonicalHeader && $self['includeCanonicalHeader'] = $includeCanonicalHeader;
        null !== $prefix && $self['prefix'] = $prefix;
        null !== $s3ForcePathStyle && $self['s3ForcePathStyle'] = $s3ForcePathStyle;

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

    /**
     * S3 bucket name.
     */
    public function withBucket(string $bucket): self
    {
        $self = clone $this;
        $self['bucket'] = $bucket;

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

    /**
     * Path prefix inside the bucket.
     */
    public function withPrefix(string $prefix): self
    {
        $self = clone $this;
        $self['prefix'] = $prefix;

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
}
