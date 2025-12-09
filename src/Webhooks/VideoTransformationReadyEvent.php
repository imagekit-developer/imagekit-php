<?php

declare(strict_types=1);

namespace Imagekit\Webhooks;

use Imagekit\Core\Attributes\Optional;
use Imagekit\Core\Attributes\Required;
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
 *   createdAt: \DateTimeInterface,
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
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    #[Required]
    public Data $data;

    /**
     * Information about the original request that triggered the video transformation.
     */
    #[Required]
    public Request $request;

    /**
     * Performance metrics for the transformation process.
     */
    #[Optional]
    public ?Timings $timings;

    /**
     * `new VideoTransformationReadyEvent()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * VideoTransformationReadyEvent::with(
     *   id: ..., type: ..., createdAt: ..., data: ..., request: ...
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
     *   url: string, xRequestID: string, userAgent?: string|null
     * } $request
     * @param Timings|array{
     *   downloadDuration?: int|null, encodingDuration?: int|null
     * } $timings
     */
    public static function with(
        string $id,
        string $type,
        \DateTimeInterface $createdAt,
        Data|array $data,
        Request|array $request,
        Timings|array|null $timings = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['type'] = $type;
        $self['createdAt'] = $createdAt;
        $self['data'] = $data;
        $self['request'] = $request;

        null !== $timings && $self['timings'] = $timings;

        return $self;
    }

    /**
     * Unique identifier for the event.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * The type of webhook event.
     */
    public function withType(string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }

    /**
     * Timestamp when the event was created in ISO8601 format.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * @param Data|array{asset: Asset, transformation: Transformation} $data
     */
    public function withData(Data|array $data): self
    {
        $self = clone $this;
        $self['data'] = $data;

        return $self;
    }

    /**
     * Information about the original request that triggered the video transformation.
     *
     * @param Request|array{
     *   url: string, xRequestID: string, userAgent?: string|null
     * } $request
     */
    public function withRequest(Request|array $request): self
    {
        $self = clone $this;
        $self['request'] = $request;

        return $self;
    }

    /**
     * Performance metrics for the transformation process.
     *
     * @param Timings|array{
     *   downloadDuration?: int|null, encodingDuration?: int|null
     * } $timings
     */
    public function withTimings(Timings|array $timings): self
    {
        $self = clone $this;
        $self['timings'] = $timings;

        return $self;
    }
}
