<?php

declare(strict_types=1);

namespace ImageKit\Webhooks;

use ImageKit\Assets\FileDetails;
use ImageKit\Core\Attributes\Required;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;

/**
 * Triggered when a file is created.
 *
 * @phpstan-import-type FileDetailsShape from \ImageKit\Assets\FileDetails
 *
 * @phpstan-type FileCreateEventShape = array{
 *   id: string,
 *   type: string,
 *   createdAt: \DateTimeInterface,
 *   data: FileDetails|FileDetailsShape,
 * }
 */
final class FileCreateEvent implements BaseModel
{
    /** @use SdkModel<FileCreateEventShape> */
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
    public FileDetails $data;

    /**
     * `new FileCreateEvent()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * FileCreateEvent::with(id: ..., type: ..., createdAt: ..., data: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new FileCreateEvent)
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
     * @param FileDetails|FileDetailsShape $data
     */
    public static function with(
        string $id,
        string $type,
        \DateTimeInterface $createdAt,
        FileDetails|array $data,
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
     * @param FileDetails|FileDetailsShape $data
     */
    public function withData(FileDetails|array $data): self
    {
        $self = clone $this;
        $self['data'] = $data;

        return $self;
    }
}
