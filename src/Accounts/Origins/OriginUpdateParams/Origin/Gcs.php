<?php

declare(strict_types=1);

namespace ImageKit\Accounts\Origins\OriginUpdateParams\Origin;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;

final class Gcs implements BaseModel
{
    use SdkModel;

    #[Api]
    public string $type = 'GCS';

    #[Api]
    public string $bucket;

    #[Api]
    public string $clientEmail;

    /**
     * Display name of the origin.
     */
    #[Api]
    public string $name;

    #[Api]
    public string $privateKey;

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
     * `new Gcs()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Gcs::with(bucket: ..., clientEmail: ..., name: ..., privateKey: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Gcs)
     *   ->withBucket(...)
     *   ->withClientEmail(...)
     *   ->withName(...)
     *   ->withPrivateKey(...)
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
        string $bucket,
        string $clientEmail,
        string $name,
        string $privateKey,
        ?string $baseURLForCanonicalHeader = null,
        ?bool $includeCanonicalHeader = null,
        ?string $prefix = null,
    ): self {
        $obj = new self;

        $obj->bucket = $bucket;
        $obj->clientEmail = $clientEmail;
        $obj->name = $name;
        $obj->privateKey = $privateKey;

        null !== $baseURLForCanonicalHeader && $obj->baseURLForCanonicalHeader = $baseURLForCanonicalHeader;
        null !== $includeCanonicalHeader && $obj->includeCanonicalHeader = $includeCanonicalHeader;
        null !== $prefix && $obj->prefix = $prefix;

        return $obj;
    }

    public function withBucket(string $bucket): self
    {
        $obj = clone $this;
        $obj->bucket = $bucket;

        return $obj;
    }

    public function withClientEmail(string $clientEmail): self
    {
        $obj = clone $this;
        $obj->clientEmail = $clientEmail;

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

    public function withPrivateKey(string $privateKey): self
    {
        $obj = clone $this;
        $obj->privateKey = $privateKey;

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
