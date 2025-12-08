<?php

declare(strict_types=1);

namespace Imagekit\Webhooks;

use Imagekit\Core\Attributes\Api;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Contracts\BaseModel;
use Imagekit\Webhooks\VideoTransformationReadyEvent\Data;
use Imagekit\Webhooks\VideoTransformationReadyEvent\Data\Asset;
use Imagekit\Webhooks\VideoTransformationReadyEvent\Data\Transformation;
use Imagekit\Webhooks\VideoTransformationReadyEvent\Request;
use Imagekit\Webhooks\VideoTransformationReadyEvent\Timings;

/**
 * Triggered when video encoding is finished and the transformed resource is ready to be served. This is the key event to listen for - update your database or CMS flags when you receive this so your application can start showing the transformed video to users.
 *
 * @phpstan-type VideoTransformationReadyEventShape = array{
 *   id: string,
 *   type: string,
 *   created_at: \DateTimeInterface,
 *   data: Data,
 *   request: Request,
 *   timings?: Timings|null,
 * }
 */
final class VideoTransformationReadyEvent implements BaseModel
{
    /** @use SdkModel<VideoTransformationReadyEventShape> */
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
     * Timestamp when the event was created in ISO8601 format.
     */
    #[Api]
    public \DateTimeInterface $created_at;

    #[Api]
    public Data $data;

    /**
     * Information about the original request that triggered the video transformation.
     */
    #[Api]
    public Request $request;

    /**
     * Performance metrics for the transformation process.
     */
    #[Api(optional: true)]
    public ?Timings $timings;

    /**
     * `new VideoTransformationReadyEvent()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * VideoTransformationReadyEvent::with(
     *   id: ..., type: ..., created_at: ..., data: ..., request: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new VideoTransformationReadyEvent)
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
     * @param Timings|array{
     *   download_duration?: int|null, encoding_duration?: int|null
     * } $timings
     */
    public static function with(
        string $id,
        string $type,
        \DateTimeInterface $created_at,
        Data|array $data,
        Request|array $request,
        Timings|array|null $timings = null,
    ): self {
        $obj = new self;

        $obj['id'] = $id;
        $obj['type'] = $type;
        $obj['created_at'] = $created_at;
        $obj['data'] = $data;
        $obj['request'] = $request;

        null !== $timings && $obj['timings'] = $timings;

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

    /**
     * Performance metrics for the transformation process.
     *
     * @param Timings|array{
     *   download_duration?: int|null, encoding_duration?: int|null
     * } $timings
     */
    public function withTimings(Timings|array $timings): self
    {
        $obj = clone $this;
        $obj['timings'] = $timings;

        return $obj;
    }
}
