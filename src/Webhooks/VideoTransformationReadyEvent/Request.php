<?php

declare(strict_types=1);

namespace ImageKit\Webhooks\VideoTransformationReadyEvent;

use ImageKit\Core\Attributes\Optional;
use ImageKit\Core\Attributes\Required;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;

/**
 * Information about the original request that triggered the video transformation.
 *
 * @phpstan-type RequestShape = array{
 *   url: string, xRequestID: string, userAgent?: string|null
 * }
 */
final class Request implements BaseModel
{
    /** @use SdkModel<RequestShape> */
    use SdkModel;

    /**
     * Full URL of the transformation request that was submitted.
     */
    #[Required]
    public string $url;

    /**
     * Unique identifier for the originating transformation request.
     */
    #[Required('x_request_id')]
    public string $xRequestID;

    /**
     * User-Agent header from the original request that triggered the transformation.
     */
    #[Optional('user_agent')]
    public ?string $userAgent;

    /**
     * `new Request()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Request::with(url: ..., xRequestID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Request)->withURL(...)->withXRequestID(...)
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
        string $url,
        string $xRequestID,
        ?string $userAgent = null
    ): self {
        $self = new self;

        $self['url'] = $url;
        $self['xRequestID'] = $xRequestID;

        null !== $userAgent && $self['userAgent'] = $userAgent;

        return $self;
    }

    /**
     * Full URL of the transformation request that was submitted.
     */
    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }

    /**
     * Unique identifier for the originating transformation request.
     */
    public function withXRequestID(string $xRequestID): self
    {
        $self = clone $this;
        $self['xRequestID'] = $xRequestID;

        return $self;
    }

    /**
     * User-Agent header from the original request that triggered the transformation.
     */
    public function withUserAgent(string $userAgent): self
    {
        $self = clone $this;
        $self['userAgent'] = $userAgent;

        return $self;
    }
}
