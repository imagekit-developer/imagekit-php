<?php

declare(strict_types=1);

namespace ImageKit\Accounts\Origins\OriginRequest;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;

/**
 * @phpstan-type S3Shape = array{
 *   accessKey: string,
 *   bucket: string,
 *   name: string,
 *   secretKey: string,
 *   type: 'S3',
 *   baseUrlForCanonicalHeader?: string|null,
 *   includeCanonicalHeader?: bool|null,
 *   prefix?: string|null,
 * }
 */
final class S3 implements BaseModel
{
    /** @use SdkModel<S3Shape> */
    use SdkModel;

    /** @var 'S3' $type */
    #[Api]
    public string $type = 'S3';

    /**
     * Access key for the bucket.
     */
    #[Api]
    public string $accessKey;

    /**
     * S3 bucket name.
     */
    #[Api]
    public string $bucket;

    /**
     * Display name of the origin.
     */
    #[Api]
    public string $name;

    /**
     * Secret key for the bucket.
     */
    #[Api]
    public string $secretKey;

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
     * Path prefix inside the bucket.
     */
    #[Api(optional: true)]
    public ?string $prefix;

    /**
     * `new S3()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * S3::with(accessKey: ..., bucket: ..., name: ..., secretKey: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new S3)->withAccessKey(...)->withBucket(...)->withName(...)->withSecretKey(...)
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
        ?string $baseUrlForCanonicalHeader = null,
        ?bool $includeCanonicalHeader = null,
        ?string $prefix = null,
    ): self {
        $obj = new self;

        $obj['accessKey'] = $accessKey;
        $obj['bucket'] = $bucket;
        $obj['name'] = $name;
        $obj['secretKey'] = $secretKey;

        null !== $baseUrlForCanonicalHeader && $obj['baseUrlForCanonicalHeader'] = $baseUrlForCanonicalHeader;
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
