<?php

declare(strict_types=1);

namespace Imagekit\Webhooks;

use Imagekit\Core\Attributes\Required;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Contracts\BaseModel;
use Imagekit\Webhooks\VideoTransformationErrorEvent\Data;
use Imagekit\Webhooks\VideoTransformationErrorEvent\Data\Asset;
use Imagekit\Webhooks\VideoTransformationErrorEvent\Data\Transformation;
use Imagekit\Webhooks\VideoTransformationErrorEvent\Request;

/**
 * Triggered when an error occurs during video encoding. Listen to this webhook to log error reasons and debug issues. Check your origin and URL endpoint settings if the reason is related to download failure. For other errors, contact ImageKit support.
 *
 * @phpstan-type VideoTransformationErrorEventShape = array{
 *   id: string,
 *   type: string,
 *   createdAt: \DateTimeInterface,
 *   data: Data,
 *   request: Request,
 * }
 */
final class VideoTransformationErrorEvent implements BaseModel
{
    /** @use SdkModel<VideoTransformationErrorEventShape> */
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
     * `new VideoTransformationErrorEvent()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * VideoTransformationErrorEvent::with(
     *   id: ..., type: ..., createdAt: ..., data: ..., request: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new VideoTransformationErrorEvent)
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
     */
    public static function with(
        string $id,
        string $type,
        \DateTimeInterface $createdAt,
        Data|array $data,
        Request|array $request,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['type'] = $type;
        $self['createdAt'] = $createdAt;
        $self['data'] = $data;
        $self['request'] = $request;

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
}
