<?php

declare(strict_types=1);

namespace Imagekit\Accounts\Origins\OriginRequest;

use Imagekit\Core\Attributes\Api;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Contracts\BaseModel;

/**
 * @phpstan-type AkeneoPimShape = array{
 *   baseUrl: string,
 *   clientId: string,
 *   clientSecret: string,
 *   name: string,
 *   password: string,
 *   type: 'AKENEO_PIM',
 *   username: string,
 *   baseUrlForCanonicalHeader?: string|null,
 *   includeCanonicalHeader?: bool|null,
 * }
 */
final class AkeneoPim implements BaseModel
{
    /** @use SdkModel<AkeneoPimShape> */
    use SdkModel;

    /** @var 'AKENEO_PIM' $type */
    #[Api]
    public string $type = 'AKENEO_PIM';

    /**
     * Akeneo instance base URL.
     */
    #[Api]
    public string $baseUrl;

    /**
     * Akeneo API client ID.
     */
    #[Api]
    public string $clientId;

    /**
     * Akeneo API client secret.
     */
    #[Api]
    public string $clientSecret;

    /**
     * Display name of the origin.
     */
    #[Api]
    public string $name;

    /**
     * Akeneo API password.
     */
    #[Api]
    public string $password;

    /**
     * Akeneo API username.
     */
    #[Api]
    public string $username;

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
     * `new AkeneoPim()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AkeneoPim::with(
     *   baseUrl: ...,
     *   clientId: ...,
     *   clientSecret: ...,
     *   name: ...,
     *   password: ...,
     *   username: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AkeneoPim)
     *   ->withBaseURL(...)
     *   ->withClientID(...)
     *   ->withClientSecret(...)
     *   ->withName(...)
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
        string $baseUrl,
        string $clientId,
        string $clientSecret,
        string $name,
        string $password,
        string $username,
        ?string $baseUrlForCanonicalHeader = null,
        ?bool $includeCanonicalHeader = null,
    ): self {
        $obj = new self;

        $obj['baseUrl'] = $baseUrl;
        $obj['clientId'] = $clientId;
        $obj['clientSecret'] = $clientSecret;
        $obj['name'] = $name;
        $obj['password'] = $password;
        $obj['username'] = $username;

        null !== $baseUrlForCanonicalHeader && $obj['baseUrlForCanonicalHeader'] = $baseUrlForCanonicalHeader;
        null !== $includeCanonicalHeader && $obj['includeCanonicalHeader'] = $includeCanonicalHeader;

        return $obj;
    }

    /**
     * Akeneo instance base URL.
     */
    public function withBaseURL(string $baseURL): self
    {
        $obj = clone $this;
        $obj['baseUrl'] = $baseURL;

        return $obj;
    }

    /**
     * Akeneo API client ID.
     */
    public function withClientID(string $clientID): self
    {
        $obj = clone $this;
        $obj['clientId'] = $clientID;

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
     * Display name of the origin.
     */
    public function withName(string $name): self
    {
        $obj = clone $this;
        $obj['name'] = $name;

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
}
