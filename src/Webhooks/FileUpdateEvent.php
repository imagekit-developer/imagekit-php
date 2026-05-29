<?php

declare(strict_types=1);

namespace ImageKit\Webhooks;

use ImageKit\Core\Attributes\Required;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;
use ImageKit\Files\File;

/**
 * Triggered when a file is updated.
 *
 * @phpstan-import-type FileShape from \ImageKit\Files\File
 *
 * @phpstan-type FileUpdateEventShape = array{
 *   id: string, type: string, createdAt: \DateTimeInterface, data: File|FileShape
 * }
 */
final class FileUpdateEvent implements BaseModel
{
    /** @use SdkModel<FileUpdateEventShape> */
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

    /**
     * Object containing details of a file.
     */
    #[Required]
    public File $data;

    /**
     * `new FileUpdateEvent()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * FileUpdateEvent::with(id: ..., type: ..., createdAt: ..., data: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new FileUpdateEvent)
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
     * @param File|FileShape $data
     */
    public static function with(
        string $id,
        string $type,
        \DateTimeInterface $createdAt,
        File|array $data
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
     * Object containing details of a file.
     *
     * @param File|FileShape $data
     */
    public function withData(File|array $data): self
    {
        $self = clone $this;
        $self['data'] = $data;

        return $self;
    }
}
