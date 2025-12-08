<?php

declare(strict_types=1);

namespace Imagekit\Webhooks\VideoTransformationReadyEvent;

use Imagekit\Core\Attributes\Optional;
use Imagekit\Core\Attributes\Required;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Contracts\BaseModel;

/**
 * Information about the original request that triggered the video transformation.
 *
 * @phpstan-type RequestShape = array{
 *   url: string, x_request_id: string, user_agent?: string|null
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
    #[Required]
    public string $x_request_id;

    /**
     * User-Agent header from the original request that triggered the transformation.
     */
    #[Optional]
    public ?string $user_agent;

    /**
     * `new Request()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Request::with(url: ..., x_request_id: ...)
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
        string $x_request_id,
        ?string $user_agent = null
    ): self {
        $obj = new self;

        $obj['url'] = $url;
        $obj['x_request_id'] = $x_request_id;

        null !== $user_agent && $obj['user_agent'] = $user_agent;

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
        $obj['x_request_id'] = $xRequestID;

        return $obj;
    }

    /**
     * User-Agent header from the original request that triggered the transformation.
     */
    public function withUserAgent(string $userAgent): self
    {
        $obj = clone $this;
        $obj['user_agent'] = $userAgent;

        return $obj;
    }
}
