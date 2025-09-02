<?php

declare(strict_types=1);

namespace ImageKit\Webhooks;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;
use ImageKit\Webhooks\UploadPreTransformSuccessEvent\Data;
use ImageKit\Webhooks\UploadPreTransformSuccessEvent\Request;

/**
 * @phpstan-type upload_pre_transform_success_event = array{
 *   id: string,
 *   createdAt: \DateTimeInterface,
 *   data: Data,
 *   request: Request,
 *   type: string,
 * }
 */
final class UploadPreTransformSuccessEvent implements BaseModel
{
    /** @use SdkModel<upload_pre_transform_success_event> */
    use SdkModel;

    #[Api]
    public string $type = 'upload.pre-transform.success';

    /**
     * Unique identifier for the event.
     */
    #[Api]
    public string $id;

    /**
     * Timestamp of when the event occurred in ISO8601 format.
     */
    #[Api('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * Object containing details of a successful upload.
     */
    #[Api]
    public Data $data;

    #[Api]
    public Request $request;

    /**
     * `new UploadPreTransformSuccessEvent()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * UploadPreTransformSuccessEvent::with(
     *   id: ..., createdAt: ..., data: ..., request: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new UploadPreTransformSuccessEvent)
     *   ->withID(...)
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
        string $id,
        \DateTimeInterface $createdAt,
        Data $data,
        Request $request
    ): self {
        $obj = new self;

        $obj->id = $id;
        $obj->createdAt = $createdAt;
        $obj->data = $data;
        $obj->request = $request;

        return $obj;
    }

    /**
     * Unique identifier for the event.
     */
    public function withID(string $id): self
    {
        $obj = clone $this;
        $obj->id = $id;

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

    /**
     * Object containing details of a successful upload.
     */
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
