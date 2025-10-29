<?php

declare(strict_types=1);

namespace ImageKit\Webhooks;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;
use ImageKit\Webhooks\UploadPostTransformSuccessEvent\Data;
use ImageKit\Webhooks\UploadPostTransformSuccessEvent\Request;

/**
 * Triggered when a post-transformation completes successfully. The transformed version of the file is now ready and can be accessed via the provided URL. Note that each post-transformation generates a separate webhook event.
 *
 * @phpstan-type UploadPostTransformSuccessEventShape = array{
 *   id: string,
 *   type: string,
 *   createdAt: \DateTimeInterface,
 *   data: Data,
 *   request: Request,
 * }
 */
final class UploadPostTransformSuccessEvent implements BaseModel
{
    /** @use SdkModel<UploadPostTransformSuccessEventShape> */
    use SdkModel;

    /**
     * Unique identifier for the event.
     */
    #[Api]
    public string $id;

    /**
     * The type of webhook event.
     */
    #[Api]
    public string $type;

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
     * `new UploadPostTransformSuccessEvent()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * UploadPostTransformSuccessEvent::with(
     *   id: ..., type: ..., createdAt: ..., data: ..., request: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new UploadPostTransformSuccessEvent)
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
     */
    public static function with(
        string $id,
        string $type,
        \DateTimeInterface $createdAt,
        Data $data,
        Request $request,
    ): self {
        $obj = new self;

        $obj->id = $id;
        $obj->type = $type;
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
     * The type of webhook event.
     */
    public function withType(string $type): self
    {
        $obj = clone $this;
        $obj->type = $type;

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
