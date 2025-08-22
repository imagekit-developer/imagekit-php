<?php

declare(strict_types=1);

namespace ImageKit\Webhooks;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;
use ImageKit\Webhooks\VideoTransformationErrorWebhookEvent\Data;
use ImageKit\Webhooks\VideoTransformationErrorWebhookEvent\Request;
use ImageKit\Webhooks\VideoTransformationErrorWebhookEvent\Type;

/**
 * @phpstan-type video_transformation_error_webhook_event_alias = array{
 *   id: string,
 *   createdAt: \DateTimeInterface,
 *   data: Data,
 *   request: Request,
 *   type: Type::*,
 * }
 */
final class VideoTransformationErrorWebhookEvent implements BaseModel
{
    use SdkModel;

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

    /** @var Type::* $type */
    #[Api(enum: Type::class)]
    public string $type;

    /**
     * `new VideoTransformationErrorWebhookEvent()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * VideoTransformationErrorWebhookEvent::with(
     *   id: ..., createdAt: ..., data: ..., request: ..., type: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new VideoTransformationErrorWebhookEvent)
     *   ->withID(...)
     *   ->withCreatedAt(...)
     *   ->withData(...)
     *   ->withRequest(...)
     *   ->withType(...)
     * ```
     */
    public function __construct()
    {
        self::introspect();
        $this->unsetOptionalProperties();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Type::* $type
     */
    public static function with(
        string $id,
        \DateTimeInterface $createdAt,
        Data $data,
        Request $request,
        string $type,
    ): self {
        $obj = new self;

        $obj->id = $id;
        $obj->createdAt = $createdAt;
        $obj->data = $data;
        $obj->request = $request;
        $obj->type = $type;

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

    /**
     * @param Type::* $type
     */
    public function withType(string $type): self
    {
        $obj = clone $this;
        $obj->type = $type;

        return $obj;
    }
}
