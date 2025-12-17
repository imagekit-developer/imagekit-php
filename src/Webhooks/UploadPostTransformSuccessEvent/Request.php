<?php

declare(strict_types=1);

namespace Imagekit\Webhooks\UploadPostTransformSuccessEvent;

use Imagekit\Core\Attributes\Required;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Contracts\BaseModel;
use Imagekit\Webhooks\UploadPostTransformSuccessEvent\Request\Transformation;

/**
 * @phpstan-import-type TransformationShape from \Imagekit\Webhooks\UploadPostTransformSuccessEvent\Request\Transformation
 *
 * @phpstan-type RequestShape = array{
 *   transformation: Transformation|TransformationShape, xRequestID: string
 * }
 */
final class Request implements BaseModel
{
    /** @use SdkModel<RequestShape> */
    use SdkModel;

    #[Required]
    public Transformation $transformation;

    /**
     * Unique identifier for the originating request.
     */
    #[Required('x_request_id')]
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
     *
     * @param Transformation|TransformationShape $transformation
     */
    public static function with(
        Transformation|array $transformation,
        string $xRequestID
    ): self {
        $self = new self;

        $self['transformation'] = $transformation;
        $self['xRequestID'] = $xRequestID;

        return $self;
    }

    /**
     * @param Transformation|TransformationShape $transformation
     */
    public function withTransformation(
        Transformation|array $transformation
    ): self {
        $self = clone $this;
        $self['transformation'] = $transformation;

        return $self;
    }

    /**
     * Unique identifier for the originating request.
     */
    public function withXRequestID(string $xRequestID): self
    {
        $self = clone $this;
        $self['xRequestID'] = $xRequestID;

        return $self;
    }
}
