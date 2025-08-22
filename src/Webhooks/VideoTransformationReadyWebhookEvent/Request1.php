<?php

declare(strict_types=1);

namespace ImageKit\Webhooks\VideoTransformationReadyWebhookEvent;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;

/**
 * @phpstan-type request_alias = array{
 *   url: string, xRequestID: string, userAgent?: string
 * }
 */
final class Request implements BaseModel
{
    use SdkModel;

    /**
     * URL of the submitted request.
     */
    #[Api]
    public string $url;

    /**
     * Unique ID for the originating request.
     */
    #[Api('x_request_id')]
    public string $xRequestID;

    /**
     * User-Agent header of the originating request.
     */
    #[Api('user_agent', optional: true)]
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
        self::introspect();
        $this->unsetOptionalProperties();
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
        $obj = new self;

        $obj->url = $url;
        $obj->xRequestID = $xRequestID;

        null !== $userAgent && $obj->userAgent = $userAgent;

        return $obj;
    }

    /**
     * URL of the submitted request.
     */
    public function withURL(string $url): self
    {
        $obj = clone $this;
        $obj->url = $url;

        return $obj;
    }

    /**
     * Unique ID for the originating request.
     */
    public function withXRequestID(string $xRequestID): self
    {
        $obj = clone $this;
        $obj->xRequestID = $xRequestID;

        return $obj;
    }

    /**
     * User-Agent header of the originating request.
     */
    public function withUserAgent(string $userAgent): self
    {
        $obj = clone $this;
        $obj->userAgent = $userAgent;

        return $obj;
    }
}
