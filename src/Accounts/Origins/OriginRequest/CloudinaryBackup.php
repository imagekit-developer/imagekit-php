<?php

declare(strict_types=1);

namespace Imagekit\Accounts\Origins\OriginRequest;

use Imagekit\Core\Attributes\Optional;
use Imagekit\Core\Attributes\Required;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Contracts\BaseModel;

/**
 * @phpstan-type CloudinaryBackupShape = array{
 *   accessKey: string,
 *   bucket: string,
 *   name: string,
 *   secretKey: string,
 *   type: 'CLOUDINARY_BACKUP',
 *   baseURLForCanonicalHeader?: string|null,
 *   includeCanonicalHeader?: bool|null,
 *   prefix?: string|null,
 * }
 */
final class CloudinaryBackup implements BaseModel
{
    /** @use SdkModel<CloudinaryBackupShape> */
    use SdkModel;

    /** @var 'CLOUDINARY_BACKUP' $type */
    #[Required]
    public string $type = 'CLOUDINARY_BACKUP';

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
     * `new CloudinaryBackup()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CloudinaryBackup::with(accessKey: ..., bucket: ..., name: ..., secretKey: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CloudinaryBackup)
     *   ->withAccessKey(...)
     *   ->withBucket(...)
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
        string $name,
        string $secretKey,
        ?string $baseURLForCanonicalHeader = null,
        ?bool $includeCanonicalHeader = null,
        ?string $prefix = null,
    ): self {
        $self = new self;

        $self['accessKey'] = $accessKey;
        $self['bucket'] = $bucket;
        $self['name'] = $name;
        $self['secretKey'] = $secretKey;

        null !== $baseURLForCanonicalHeader && $self['baseURLForCanonicalHeader'] = $baseURLForCanonicalHeader;
        null !== $includeCanonicalHeader && $self['includeCanonicalHeader'] = $includeCanonicalHeader;
        null !== $prefix && $self['prefix'] = $prefix;

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
}
