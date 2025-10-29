<?php

declare(strict_types=1);

namespace ImageKit\Webhooks\UploadPreTransformSuccessEvent;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;

/**
 * @phpstan-type RequestShape = array{transformation: string, xRequestID: string}
 */
final class Request implements BaseModel
{
    /** @use SdkModel<RequestShape> */
    use SdkModel;

    /**
     * The requested pre-transformation string.
     */
    #[Api]
    public string $transformation;

    /**
     * Unique identifier for the originating request.
     */
    #[Api('x_request_id')]
    public string $xRequestID;

    /**
     * `new Request()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Request::with(transformation: ..., xRequestID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Request)->withTransformation(...)->withXRequestID(...)
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
        string $transformation,
        string $xRequestID
    ): self {
        $obj = new self;

        $obj->transformation = $transformation;
        $obj->xRequestID = $xRequestID;

        return $obj;
    }

    /**
     * The requested pre-transformation string.
     */
    public function withTransformation(string $transformation): self
    {
        $obj = clone $this;
        $obj->transformation = $transformation;

        return $obj;
    }

    /**
     * Unique identifier for the originating request.
     */
    public function withXRequestID(string $xRequestID): self
    {
        $obj = clone $this;
        $obj->xRequestID = $xRequestID;

        return $obj;
    }
}
