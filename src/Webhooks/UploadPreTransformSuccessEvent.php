<?php

declare(strict_types=1);

namespace Imagekit\Webhooks;

use Imagekit\Core\Attributes\Required;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Contracts\BaseModel;
use Imagekit\Files\Metadata;
use Imagekit\Webhooks\UploadPreTransformSuccessEvent\Data;
use Imagekit\Webhooks\UploadPreTransformSuccessEvent\Data\AITag;
use Imagekit\Webhooks\UploadPreTransformSuccessEvent\Data\ExtensionStatus;
use Imagekit\Webhooks\UploadPreTransformSuccessEvent\Data\SelectedFieldsSchema;
use Imagekit\Webhooks\UploadPreTransformSuccessEvent\Data\VersionInfo;
use Imagekit\Webhooks\UploadPreTransformSuccessEvent\Request;

/**
 * Triggered when a pre-transformation completes successfully. The file has been processed with the requested transformation and is now available in the Media Library.
 *
 * @phpstan-type UploadPreTransformSuccessEventShape = array{
 *   id: string,
 *   type: string,
 *   createdAt: \DateTimeInterface,
 *   data: Data,
 *   request: Request,
 * }
 */
final class UploadPreTransformSuccessEvent implements BaseModel
{
    /** @use SdkModel<UploadPreTransformSuccessEventShape> */
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
     * Object containing details of a successful upload.
     */
    #[Required]
    public Data $data;

    #[Required]
    public Request $request;

    /**
     * `new UploadPreTransformSuccessEvent()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * UploadPreTransformSuccessEvent::with(
     *   id: ..., type: ..., createdAt: ..., data: ..., request: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new UploadPreTransformSuccessEvent)
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
     * @param Data|array{
     *   aiTags?: list<AITag>|null,
     *   audioCodec?: string|null,
     *   bitRate?: int|null,
     *   customCoordinates?: string|null,
     *   customMetadata?: array<string,mixed>|null,
     *   description?: string|null,
     *   duration?: int|null,
     *   embeddedMetadata?: array<string,mixed>|null,
     *   extensionStatus?: ExtensionStatus|null,
     *   fileID?: string|null,
     *   filePath?: string|null,
     *   fileType?: string|null,
     *   height?: float|null,
     *   isPrivateFile?: bool|null,
     *   isPublished?: bool|null,
     *   metadata?: Metadata|null,
     *   name?: string|null,
     *   selectedFieldsSchema?: array<string,SelectedFieldsSchema>|null,
     *   size?: float|null,
     *   tags?: list<string>|null,
     *   thumbnailURL?: string|null,
     *   url?: string|null,
     *   versionInfo?: VersionInfo|null,
     *   videoCodec?: string|null,
     *   width?: float|null,
     * } $data
     * @param Request|array{transformation: string, xRequestID: string} $request
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
     * Timestamp of when the event occurred in ISO8601 format.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * Object containing details of a successful upload.
     *
     * @param Data|array{
     *   aiTags?: list<AITag>|null,
     *   audioCodec?: string|null,
     *   bitRate?: int|null,
     *   customCoordinates?: string|null,
     *   customMetadata?: array<string,mixed>|null,
     *   description?: string|null,
     *   duration?: int|null,
     *   embeddedMetadata?: array<string,mixed>|null,
     *   extensionStatus?: ExtensionStatus|null,
     *   fileID?: string|null,
     *   filePath?: string|null,
     *   fileType?: string|null,
     *   height?: float|null,
     *   isPrivateFile?: bool|null,
     *   isPublished?: bool|null,
     *   metadata?: Metadata|null,
     *   name?: string|null,
     *   selectedFieldsSchema?: array<string,SelectedFieldsSchema>|null,
     *   size?: float|null,
     *   tags?: list<string>|null,
     *   thumbnailURL?: string|null,
     *   url?: string|null,
     *   versionInfo?: VersionInfo|null,
     *   videoCodec?: string|null,
     *   width?: float|null,
     * } $data
     */
    public function withData(Data|array $data): self
    {
        $self = clone $this;
        $self['data'] = $data;

        return $self;
    }

    /**
     * @param Request|array{transformation: string, xRequestID: string} $request
     */
    public function withRequest(Request|array $request): self
    {
        $self = clone $this;
        $self['request'] = $request;

        return $self;
    }
}
