<?php

declare(strict_types=1);

namespace ImageKit\Webhooks;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;
use ImageKit\Webhooks\VideoTransformationAcceptedEvent\Data;
use ImageKit\Webhooks\VideoTransformationAcceptedEvent\Request;

/**
 * Triggered when a new video transformation request is accepted for processing. This event confirms that ImageKit has received and queued your transformation request. Use this for debugging and tracking transformation lifecycle.
 *
 * @phpstan-type video_transformation_accepted_event = array{
 *   id: string,
 *   createdAt: \DateTimeInterface,
 *   data: Data,
 *   request: Request,
 *   type: string,
 * }
 */
final class VideoTransformationAcceptedEvent implements BaseModel
{
    /** @use SdkModel<video_transformation_accepted_event> */
    use SdkModel;

    #[Api]
    public string $type = 'video.transformation.accepted';

    /**
     * Unique identifier for the event.
     */
    #[Api]
    public string $id;

    /**
     * Timestamp when the event was created in ISO8601 format.
     */
    #[Api('created_at')]
    public \DateTimeInterface $createdAt;

    #[Api]
    public Data $data;

    /**
     * Information about the original request that triggered the video transformation.
     */
    #[Api]
    public Request $request;

    /**
     * `new VideoTransformationAcceptedEvent()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * VideoTransformationAcceptedEvent::with(
     *   id: ..., createdAt: ..., data: ..., request: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new VideoTransformationAcceptedEvent)
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
     * Timestamp when the event was created in ISO8601 format.
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

    /**
     * Information about the original request that triggered the video transformation.
     */
    public function withRequest(Request $request): self
    {
        $obj = clone $this;
        $obj->request = $request;

        return $obj;
    }
}
