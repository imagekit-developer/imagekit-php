<?php

declare(strict_types=1);

namespace Imagekit\Webhooks;

use Imagekit\Core\Attributes\Required;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Contracts\BaseModel;
use Imagekit\Webhooks\UploadPostTransformErrorEvent\Data;
use Imagekit\Webhooks\UploadPostTransformErrorEvent\Data\Transformation;
use Imagekit\Webhooks\UploadPostTransformErrorEvent\Request;

/**
 * Triggered when a post-transformation fails. The original file remains available, but the requested transformation could not be generated.
 *
 * @phpstan-type UploadPostTransformErrorEventShape = array{
 *   id: string,
 *   type: string,
 *   createdAt: \DateTimeInterface,
 *   data: Data,
 *   request: Request,
 * }
 */
final class UploadPostTransformErrorEvent implements BaseModel
{
    /** @use SdkModel<UploadPostTransformErrorEventShape> */
    use SdkModel;

    /**
     * Unique identifier for the event.
     */
    #[Required]
    public string $id;

    /**
     * The type of webhook event.
     */
    #[Required]
    public string $type;

    /**
     * Timestamp of when the event occurred in ISO8601 format.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    #[Required]
    public Data $data;

    #[Required]
    public Request $request;

    /**
     * `new UploadPostTransformErrorEvent()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * UploadPostTransformErrorEvent::with(
     *   id: ..., type: ..., createdAt: ..., data: ..., request: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new UploadPostTransformErrorEvent)
     *   ->withID(...)
     *   ->withType(...)
     *   ->withCreatedAt(...)
     *   ->withData(...)
     *   ->withRequest(...)
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
     * @param Data|array{
     *   fileID: string,
     *   name: string,
     *   path: string,
     *   transformation: Transformation,
     *   url: string,
     * } $data
     * @param Request|array{
     *   transformation: Request\Transformation,
     *   xRequestID: string,
     * } $request
     */
    public static function with(
        string $id,
        string $type,
        \DateTimeInterface $createdAt,
        Data|array $data,
        Request|array $request,
    ): self {
        $obj = new self;

        $obj['id'] = $id;
        $obj['type'] = $type;
        $obj['createdAt'] = $createdAt;
        $obj['data'] = $data;
        $obj['request'] = $request;

        return $obj;
    }

    /**
     * Unique identifier for the event.
     */
    public function withID(string $id): self
    {
        $obj = clone $this;
        $obj['id'] = $id;

        return $obj;
    }

    /**
     * The type of webhook event.
     */
    public function withType(string $type): self
    {
        $obj = clone $this;
        $obj['type'] = $type;

        return $obj;
    }

    /**
     * Timestamp of when the event occurred in ISO8601 format.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $obj = clone $this;
        $obj['createdAt'] = $createdAt;

        return $obj;
    }

    /**
     * @param Data|array{
     *   fileID: string,
     *   name: string,
     *   path: string,
     *   transformation: Transformation,
     *   url: string,
     * } $data
     */
    public function withData(Data|array $data): self
    {
        $obj = clone $this;
        $obj['data'] = $data;

        return $obj;
    }

    /**
     * @param Request|array{
     *   transformation: Request\Transformation,
     *   xRequestID: string,
     * } $request
     */
    public function withRequest(Request|array $request): self
    {
        $obj = clone $this;
        $obj['request'] = $request;

        return $obj;
    }
}
