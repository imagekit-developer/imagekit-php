<?php

declare(strict_types=1);

namespace ImageKit\Responses\Accounts\Origins\OriginGetResponse;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;

final class S3Compatible implements BaseModel
{
    use SdkModel;

    #[Api]
    public string $type = 'S3_COMPATIBLE';

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
     * Custom S3-compatible endpoint.
     */
    #[Api]
    public string $endpoint;

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

    #[Api(optional: true)]
    public ?string $id;

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

    /**
     * Path prefix inside the bucket.
     */
    #[Api(optional: true)]
    public ?string $prefix;

    /**
     * Use path-style S3 URLs?
     */
    #[Api(optional: true)]
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
        self::introspect();
        $this->unsetOptionalProperties();
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
        ?string $id = null,
        ?string $baseURLForCanonicalHeader = null,
        ?bool $includeCanonicalHeader = null,
        ?string $prefix = null,
        ?bool $s3ForcePathStyle = null,
    ): self {
        $obj = new self;

        $obj->accessKey = $accessKey;
        $obj->bucket = $bucket;
        $obj->endpoint = $endpoint;
        $obj->name = $name;
        $obj->secretKey = $secretKey;

        null !== $id && $obj->id = $id;
        null !== $baseURLForCanonicalHeader && $obj->baseURLForCanonicalHeader = $baseURLForCanonicalHeader;
        null !== $includeCanonicalHeader && $obj->includeCanonicalHeader = $includeCanonicalHeader;
        null !== $prefix && $obj->prefix = $prefix;
        null !== $s3ForcePathStyle && $obj->s3ForcePathStyle = $s3ForcePathStyle;

        return $obj;
    }

    /**
     * Access key for the bucket.
     */
    public function withAccessKey(string $accessKey): self
    {
        $obj = clone $this;
        $obj->accessKey = $accessKey;

        return $obj;
    }

    /**
     * S3 bucket name.
     */
    public function withBucket(string $bucket): self
    {
        $obj = clone $this;
        $obj->bucket = $bucket;

        return $obj;
    }

    /**
     * Custom S3-compatible endpoint.
     */
    public function withEndpoint(string $endpoint): self
    {
        $obj = clone $this;
        $obj->endpoint = $endpoint;

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

    /**
     * Secret key for the bucket.
     */
    public function withSecretKey(string $secretKey): self
    {
        $obj = clone $this;
        $obj->secretKey = $secretKey;

        return $obj;
    }

    public function withID(string $id): self
    {
        $obj = clone $this;
        $obj->id = $id;

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

    /**
     * Path prefix inside the bucket.
     */
    public function withPrefix(string $prefix): self
    {
        $obj = clone $this;
        $obj->prefix = $prefix;

        return $obj;
    }

    /**
     * Use path-style S3 URLs?
     */
    public function withS3ForcePathStyle(bool $s3ForcePathStyle): self
    {
        $obj = clone $this;
        $obj->s3ForcePathStyle = $s3ForcePathStyle;

        return $obj;
    }
}
