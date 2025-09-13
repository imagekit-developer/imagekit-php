<?php

declare(strict_types=1);

namespace ImageKit\Webhooks;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;
use ImageKit\Webhooks\UploadPreTransformErrorEvent\Data;
use ImageKit\Webhooks\UploadPreTransformErrorEvent\Request;

/**
 * Triggered when a pre-transformation fails. The file upload may have been accepted, but the requested transformation could not be applied.
 *
 * @phpstan-type unnamed_type_with_intersection_parent7 = array{
 *   createdAt: \DateTimeInterface, data: Data, request: Request, type: string
 * }
 */
final class UploadPreTransformErrorEvent implements BaseModel
{
    /** @use SdkModel<unnamed_type_with_intersection_parent7> */
    use SdkModel;

    #[Api]
    public string $type = 'upload.pre-transform.error';

    /**
     * Timestamp of when the event occurred in ISO8601 format.
     */
    #[Api('created_at')]
    public \DateTimeInterface $createdAt;

    #[Api]
    public Data $data;

    #[Api]
    public Request $request;

    /**
     * `new UploadPreTransformErrorEvent()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * UploadPreTransformErrorEvent::with(createdAt: ..., data: ..., request: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new UploadPreTransformErrorEvent)
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
     */
    public static function with(
        \DateTimeInterface $createdAt,
        Data $data,
        Request $request
    ): self {
        $obj = new self;

        $obj->createdAt = $createdAt;
        $obj->data = $data;
        $obj->request = $request;

        return $obj;
    }

    /**
     * Timestamp of when the event occurred in ISO8601 format.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $obj = clone $this;
        $obj->createdAt = $createdAt;

        return $obj;
    }

    public function withData(Data $data): self
    {
        $obj = clone $this;
        $obj->data = $data;

        return $obj;
    }

    public function withRequest(Request $request): self
    {
        $obj = clone $this;
        $obj->request = $request;

        return $obj;
    }
}
