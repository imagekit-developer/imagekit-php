<?php

declare(strict_types=1);

namespace Imagekit\Webhooks;

use Imagekit\Core\Attributes\Required;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Contracts\BaseModel;
use Imagekit\Webhooks\VideoTransformationAcceptedEvent\Data;
use Imagekit\Webhooks\VideoTransformationAcceptedEvent\Data\Asset;
use Imagekit\Webhooks\VideoTransformationAcceptedEvent\Data\Transformation;
use Imagekit\Webhooks\VideoTransformationAcceptedEvent\Request;

/**
 * Triggered when a new video transformation request is accepted for processing. This event confirms that ImageKit has received and queued your transformation request. Use this for debugging and tracking transformation lifecycle.
 *
 * @phpstan-type VideoTransformationAcceptedEventShape = array{
 *   id: string,
 *   type: string,
 *   created_at: \DateTimeInterface,
 *   data: Data,
 *   request: Request,
 * }
 */
final class VideoTransformationAcceptedEvent implements BaseModel
{
    /** @use SdkModel<VideoTransformationAcceptedEventShape> */
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
     * Timestamp when the event was created in ISO8601 format.
     */
    #[Required]
    public \DateTimeInterface $created_at;

    #[Required]
    public Data $data;

    /**
     * Information about the original request that triggered the video transformation.
     */
    #[Required]
    public Request $request;

    /**
     * `new VideoTransformationAcceptedEvent()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * VideoTransformationAcceptedEvent::with(
     *   id: ..., type: ..., created_at: ..., data: ..., request: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new VideoTransformationAcceptedEvent)
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
     * @param Data|array{asset: Asset, transformation: Transformation} $data
     * @param Request|array{
     *   url: string, x_request_id: string, user_agent?: string|null
     * } $request
     */
    public static function with(
        string $id,
        string $type,
        \DateTimeInterface $created_at,
        Data|array $data,
        Request|array $request,
    ): self {
        $obj = new self;

        $obj['id'] = $id;
        $obj['type'] = $type;
        $obj['created_at'] = $created_at;
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
     * Timestamp when the event was created in ISO8601 format.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $obj = clone $this;
        $obj['created_at'] = $createdAt;

        return $obj;
    }

    /**
     * @param Data|array{asset: Asset, transformation: Transformation} $data
     */
    public function withData(Data|array $data): self
    {
        $obj = clone $this;
        $obj['data'] = $data;

        return $obj;
    }

    /**
     * Information about the original request that triggered the video transformation.
     *
     * @param Request|array{
     *   url: string, x_request_id: string, user_agent?: string|null
     * } $request
     */
    public function withRequest(Request|array $request): self
    {
        $obj = clone $this;
        $obj['request'] = $request;

        return $obj;
    }
}
