<?php

declare(strict_types=1);

namespace Imagekit\Files;

use Imagekit\Core\Attributes\Optional;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Concerns\SdkParams;
use Imagekit\Core\Contracts\BaseModel;
use Imagekit\ExtensionItem;
use Imagekit\ExtensionItem\AutoDescriptionExtension;
use Imagekit\ExtensionItem\AutoTaggingExtension;
use Imagekit\ExtensionItem\RemovedotBgExtension;
use Imagekit\Files\FileUpdateParams\Publish;
use Imagekit\Files\FileUpdateParams\RemoveAITags;

/**
 * This API updates the details or attributes of the current version of the file. You can update `tags`, `customCoordinates`, `customMetadata`, publication status, remove existing `AITags` and apply extensions using this API.
 *
 * @see Imagekit\Services\FilesService::update()
 *
 * @phpstan-import-type ExtensionItemShape from \Imagekit\ExtensionItem
 * @phpstan-import-type RemoveAITagsShape from \Imagekit\Files\FileUpdateParams\RemoveAITags
 * @phpstan-import-type PublishShape from \Imagekit\Files\FileUpdateParams\Publish
 *
 * @phpstan-type FileUpdateParamsShape = array{
 *   customCoordinates?: string|null,
 *   customMetadata?: array<string,mixed>|null,
 *   description?: string|null,
 *   extensions?: list<ExtensionItemShape>|null,
 *   removeAITags?: RemoveAITagsShape|null,
 *   tags?: list<string>|null,
 *   webhookURL?: string|null,
 *   publish?: PublishShape|null,
 * }
 */
final class FileUpdateParams implements BaseModel
{
    /** @use SdkModel<FileUpdateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Define an important area in the image in the format `x,y,width,height` e.g. `10,10,100,100`. Send `null` to unset this value.
     */
    #[Optional(nullable: true)]
    public ?string $customCoordinates;

    /**
     * A key-value data to be associated with the asset. To unset a key, send `null` value for that key. Before setting any custom metadata on an asset you have to create the field using custom metadata fields API.
     *
     * @var array<string,mixed>|null $customMetadata
     */
    #[Optional(map: 'mixed')]
    public ?array $customMetadata;

    /**
     * Optional text to describe the contents of the file.
     */
    #[Optional]
    public ?string $description;

    /**
     * Array of extensions to be applied to the asset. Each extension can be configured with specific parameters based on the extension type.
     *
     * @var list<RemovedotBgExtension|AutoTaggingExtension|AutoDescriptionExtension>|null $extensions
     */
    #[Optional(list: ExtensionItem::class)]
    public ?array $extensions;

    /**
     * An array of AITags associated with the file that you want to remove, e.g. `["car", "vehicle", "motorsports"]`.
     *
     * If you want to remove all AITags associated with the file, send a string - "all".
     *
     * Note: The remove operation for `AITags` executes before any of the `extensions` are processed.
     *
     * @var 'all'|list<string>|null $removeAITags
     */
    #[Optional(union: RemoveAITags::class)]
    public string|array|null $removeAITags;

    /**
     * An array of tags associated with the file, such as `["tag1", "tag2"]`. Send `null` to unset all tags associated with the file.
     *
     * @var list<string>|null $tags
     */
    #[Optional(list: 'string', nullable: true)]
    public ?array $tags;

    /**
     * The final status of extensions after they have completed execution will be delivered to this endpoint as a POST request. [Learn more](/docs/api-reference/digital-asset-management-dam/managing-assets/update-file-details#webhook-payload-structure) about the webhook payload structure.
     */
    #[Optional('webhookUrl')]
    public ?string $webhookURL;

    /**
     * Configure the publication status of a file and its versions.
     */
    #[Optional]
    public ?Publish $publish;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param array<string,mixed> $customMetadata
     * @param list<ExtensionItemShape> $extensions
     * @param RemoveAITagsShape $removeAITags
     * @param list<string>|null $tags
     * @param PublishShape $publish
     */
    public static function with(
        ?string $customCoordinates = null,
        ?array $customMetadata = null,
        ?string $description = null,
        ?array $extensions = null,
        string|array|null $removeAITags = null,
        ?array $tags = null,
        ?string $webhookURL = null,
        Publish|array|null $publish = null,
    ): self {
        $self = new self;

        null !== $customCoordinates && $self['customCoordinates'] = $customCoordinates;
        null !== $customMetadata && $self['customMetadata'] = $customMetadata;
        null !== $description && $self['description'] = $description;
        null !== $extensions && $self['extensions'] = $extensions;
        null !== $removeAITags && $self['removeAITags'] = $removeAITags;
        null !== $tags && $self['tags'] = $tags;
        null !== $webhookURL && $self['webhookURL'] = $webhookURL;
        null !== $publish && $self['publish'] = $publish;

        return $self;
    }

    /**
     * Define an important area in the image in the format `x,y,width,height` e.g. `10,10,100,100`. Send `null` to unset this value.
     */
    public function withCustomCoordinates(?string $customCoordinates): self
    {
        $self = clone $this;
        $self['customCoordinates'] = $customCoordinates;

        return $self;
    }

    /**
     * A key-value data to be associated with the asset. To unset a key, send `null` value for that key. Before setting any custom metadata on an asset you have to create the field using custom metadata fields API.
     *
     * @param array<string,mixed> $customMetadata
     */
    public function withCustomMetadata(array $customMetadata): self
    {
        $self = clone $this;
        $self['customMetadata'] = $customMetadata;

        return $self;
    }

    /**
     * Optional text to describe the contents of the file.
     */
    public function withDescription(string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * Array of extensions to be applied to the asset. Each extension can be configured with specific parameters based on the extension type.
     *
     * @param list<ExtensionItemShape> $extensions
     */
    public function withExtensions(array $extensions): self
    {
        $self = clone $this;
        $self['extensions'] = $extensions;

        return $self;
    }

    /**
     * An array of AITags associated with the file that you want to remove, e.g. `["car", "vehicle", "motorsports"]`.
     *
     * If you want to remove all AITags associated with the file, send a string - "all".
     *
     * Note: The remove operation for `AITags` executes before any of the `extensions` are processed.
     *
     * @param RemoveAITagsShape $removeAITags
     */
    public function withRemoveAITags(string|array $removeAITags): self
    {
        $self = clone $this;
        $self['removeAITags'] = $removeAITags;

        return $self;
    }

    /**
     * An array of tags associated with the file, such as `["tag1", "tag2"]`. Send `null` to unset all tags associated with the file.
     *
     * @param list<string>|null $tags
     */
    public function withTags(?array $tags): self
    {
        $self = clone $this;
        $self['tags'] = $tags;

        return $self;
    }

    /**
     * The final status of extensions after they have completed execution will be delivered to this endpoint as a POST request. [Learn more](/docs/api-reference/digital-asset-management-dam/managing-assets/update-file-details#webhook-payload-structure) about the webhook payload structure.
     */
    public function withWebhookURL(string $webhookURL): self
    {
        $self = clone $this;
        $self['webhookURL'] = $webhookURL;

        return $self;
    }

    /**
     * Configure the publication status of a file and its versions.
     *
     * @param PublishShape $publish
     */
    public function withPublish(Publish|array $publish): self
    {
        $self = clone $this;
        $self['publish'] = $publish;

        return $self;
    }
}
