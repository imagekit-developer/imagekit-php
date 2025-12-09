<?php

declare(strict_types=1);

namespace Imagekit\Webhooks\VideoTransformationErrorEvent;

use Imagekit\Core\Attributes\Optional;
use Imagekit\Core\Attributes\Required;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Contracts\BaseModel;

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
        $obj = new self;

        $obj['url'] = $url;
        $obj['xRequestID'] = $xRequestID;

        null !== $userAgent && $obj['userAgent'] = $userAgent;

        return $obj;
    }

    /**
     * Full URL of the transformation request that was submitted.
     */
    public function withURL(string $url): self
    {
        $obj = clone $this;
        $obj['url'] = $url;

        return $obj;
    }

    /**
     * Unique identifier for the originating transformation request.
     */
    public function withXRequestID(string $xRequestID): self
    {
        $obj = clone $this;
        $obj['xRequestID'] = $xRequestID;

        return $obj;
    }

    /**
     * User-Agent header from the original request that triggered the transformation.
     */
    public function withUserAgent(string $userAgent): self
    {
        $obj = clone $this;
        $obj['userAgent'] = $userAgent;

        return $obj;
    }
}
