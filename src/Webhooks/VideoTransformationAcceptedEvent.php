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
 * @phpstan-type unnamed_type_with_intersection_parent9 = array{
 *   createdAt: \DateTimeInterface, data: Data, request: Request, type: string
 * }
 */
final class VideoTransformationAcceptedEvent implements BaseModel
{
    /** @use SdkModel<unnamed_type_with_intersection_parent9> */
    use SdkModel;

    #[Api]
    public string $type = 'video.transformation.accepted';

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
     * VideoTransformationAcceptedEvent::with(createdAt: ..., data: ..., request: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new VideoTransformationAcceptedEvent)
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
