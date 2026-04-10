<?php

declare(strict_types=1);

namespace Imagekit\Webhooks;

use Imagekit\Core\Attributes\Required;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Contracts\BaseModel;
use Imagekit\Webhooks\FileVersionDeleteEvent\Data;

/**
 * Triggered when a file version is deleted.
 *
 * @phpstan-import-type DataShape from \Imagekit\Webhooks\FileVersionDeleteEvent\Data
 *
 * @phpstan-type FileVersionDeleteEventShape = array{
 *   id: string, type: string, createdAt: \DateTimeInterface, data: Data|DataShape
 * }
 */
final class FileVersionDeleteEvent implements BaseModel
{
    /** @use SdkModel<FileVersionDeleteEventShape> */
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
     * Timestamp of when the event occurred in ISO8601 format.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    #[Required]
    public Data $data;

    /**
     * `new FileVersionDeleteEvent()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * FileVersionDeleteEvent::with(id: ..., type: ..., createdAt: ..., data: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new FileVersionDeleteEvent)
     *   ->withID(...)
     *   ->withType(...)
     *   ->withCreatedAt(...)
     *   ->withData(...)
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
     * @param Data|DataShape $data
     */
    public static function with(
        string $id,
        string $type,
        \DateTimeInterface $createdAt,
        Data|array $data
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['type'] = $type;
        $self['createdAt'] = $createdAt;
        $self['data'] = $data;

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
     * Timestamp of when the event occurred in ISO8601 format.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * @param Data|DataShape $data
     */
    public function withData(Data|array $data): self
    {
        $self = clone $this;
        $self['data'] = $data;

        return $self;
    }
}
