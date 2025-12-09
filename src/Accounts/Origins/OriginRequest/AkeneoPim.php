<?php

declare(strict_types=1);

namespace Imagekit\Accounts\Origins\OriginRequest;

use Imagekit\Core\Attributes\Optional;
use Imagekit\Core\Attributes\Required;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Contracts\BaseModel;

/**
 * @phpstan-type AkeneoPimShape = array{
 *   baseURL: string,
 *   clientID: string,
 *   clientSecret: string,
 *   name: string,
 *   password: string,
 *   type?: 'AKENEO_PIM',
 *   username: string,
 *   baseURLForCanonicalHeader?: string|null,
 *   includeCanonicalHeader?: bool|null,
 * }
 */
final class AkeneoPim implements BaseModel
{
    /** @use SdkModel<AkeneoPimShape> */
    use SdkModel;

    /** @var 'AKENEO_PIM' $type */
    #[Required]
    public string $type = 'AKENEO_PIM';

    /**
     * Akeneo instance base URL.
     */
    #[Required('baseUrl')]
    public string $baseURL;

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
     * Display name of the origin.
     */
    #[Required]
    public string $name;

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
     * `new AkeneoPim()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AkeneoPim::with(
     *   baseURL: ...,
     *   clientID: ...,
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
        string $baseURL,
        string $clientID,
        string $clientSecret,
        string $name,
        string $password,
        string $username,
        ?string $baseURLForCanonicalHeader = null,
        ?bool $includeCanonicalHeader = null,
    ): self {
        $self = new self;

        $self['baseURL'] = $baseURL;
        $self['clientID'] = $clientID;
        $self['clientSecret'] = $clientSecret;
        $self['name'] = $name;
        $self['password'] = $password;
        $self['username'] = $username;

        null !== $baseURLForCanonicalHeader && $self['baseURLForCanonicalHeader'] = $baseURLForCanonicalHeader;
        null !== $includeCanonicalHeader && $self['includeCanonicalHeader'] = $includeCanonicalHeader;

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
     * Display name of the origin.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

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
}
