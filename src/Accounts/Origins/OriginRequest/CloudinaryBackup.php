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
 *   type?: 'CLOUDINARY_BACKUP',
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
        $obj = new self;

        $obj['accessKey'] = $accessKey;
        $obj['bucket'] = $bucket;
        $obj['name'] = $name;
        $obj['secretKey'] = $secretKey;

        null !== $baseURLForCanonicalHeader && $obj['baseURLForCanonicalHeader'] = $baseURLForCanonicalHeader;
        null !== $includeCanonicalHeader && $obj['includeCanonicalHeader'] = $includeCanonicalHeader;
        null !== $prefix && $obj['prefix'] = $prefix;

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

    /**
     * S3 bucket name.
     */
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

    /**
     * Path prefix inside the bucket.
     */
    public function withPrefix(string $prefix): self
    {
        $obj = clone $this;
        $obj['prefix'] = $prefix;

        return $obj;
    }
}
