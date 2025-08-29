<?php

declare(strict_types=1);

namespace ImageKit\Webhooks;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;
use ImageKit\Webhooks\VideoTransformationReadyEvent\Data;
use ImageKit\Webhooks\VideoTransformationReadyEvent\Request;
use ImageKit\Webhooks\VideoTransformationReadyEvent\Timings;

/**
 * @phpstan-type video_transformation_ready_event = array{
 *   id: string,
 *   createdAt: \DateTimeInterface,
 *   data: Data,
 *   request: Request,
 *   type: string,
 *   timings?: Timings|null,
 * }
 */
final class VideoTransformationReadyEvent implements BaseModel
{
    /** @use SdkModel<video_transformation_ready_event> */
    use SdkModel;

    #[Api]
    public string $type = 'video.transformation.ready';

    /**
     * Unique identifier for the event.
     */
    #[Api]
    public string $id;

    #[Api('created_at')]
    public \DateTimeInterface $createdAt;

    #[Api]
    public Data $data;

    #[Api]
    public Request $request;

    #[Api(optional: true)]
    public ?Timings $timings;

    /**
     * `new VideoTransformationReadyEvent()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * VideoTransformationReadyEvent::with(
     *   id: ..., createdAt: ..., data: ..., request: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new VideoTransformationReadyEvent)
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
        Request $request,
        ?Timings $timings = null,
    ): self {
        $obj = new self;

        $obj->id = $id;
        $obj->createdAt = $createdAt;
        $obj->data = $data;
        $obj->request = $request;

        null !== $timings && $obj->timings = $timings;

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

    public function withTimings(Timings $timings): self
    {
        $obj = clone $this;
        $obj->timings = $timings;

        return $obj;
    }
}
