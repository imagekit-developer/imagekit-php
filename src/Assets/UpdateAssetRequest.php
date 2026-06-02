<?php

declare(strict_types=1);

namespace ImageKit\Assets;

use ImageKit\Assets\UpdateAssetRequest\Publish;
use ImageKit\Assets\UpdateAssetRequest\RemoveAITags;
use ImageKit\Core\Attributes\Optional;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;
use ImageKit\ExtensionItem;

/**
 * Schema for the update asset request body.
 *
 * @phpstan-import-type ExtensionItemVariants from \ImageKit\ExtensionItem
 * @phpstan-import-type RemoveAITagsVariants from \ImageKit\Assets\UpdateAssetRequest\RemoveAITags
 * @phpstan-import-type ExtensionItemShape from \ImageKit\ExtensionItem
 * @phpstan-import-type PublishShape from \ImageKit\Assets\UpdateAssetRequest\Publish
 * @phpstan-import-type RemoveAITagsShape from \ImageKit\Assets\UpdateAssetRequest\RemoveAITags
 *
 * @phpstan-type UpdateAssetRequestShape = array{
 *   customCoordinates?: string|null,
 *   customMetadata?: array<string,mixed>|null,
 *   description?: string|null,
 *   extensions?: list<ExtensionItemShape>|null,
 *   publish?: null|Publish|PublishShape,
 *   removeAITags?: RemoveAITagsShape|null,
 *   tags?: list<string>|null,
 *   webhookURL?: string|null,
 * }
 */
final class UpdateAssetRequest implements BaseModel
{
    /** @use SdkModel<UpdateAssetRequestShape> */
    use SdkModel;

    /**
     * Define an important area in the image in the format `x,y,width,height` e.g. `10,10,100,100`. Send `null` to unset this value.
     */
    #[Optional('custom_coordinates', nullable: true)]
    public ?string $customCoordinates;

    /**
     * A key-value data to be associated with the asset. To unset a key, send `null` value for that key. Before setting any custom metadata on an asset you have to create the field using custom metadata fields API.
     *
     * @var array<string,mixed>|null $customMetadata
     */
    #[Optional('custom_metadata', map: 'mixed')]
    public ?array $customMetadata;

    /**
     * Optional text to describe the contents of the file.
     */
    #[Optional]
    public ?string $description;

    /**
     * Array of extensions to be applied to the asset. Each extension can be configured with specific parameters based on the extension type.
     *
     * @var list<ExtensionItemVariants>|null $extensions
     */
    #[Optional(list: ExtensionItem::class)]
    public ?array $extensions;

    /**
     * Configure the publication status of a file and its versions.
     */
    #[Optional]
    public ?Publish $publish;

    /**
     * An array of AI tags associated with the file that you want to remove, e.g. `["car", "vehicle", "motorsports"]`.
     *
     * If you want to remove all AI tags associated with the file, send the string `"all"`.
     *
     * Note: The remove operation for `ai_tags` executes before any of the `extensions` are processed.
     *
     * @var RemoveAITagsVariants|null $removeAITags
     */
    #[Optional('remove_ai_tags', union: RemoveAITags::class)]
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
    #[Optional('webhook_url')]
    public ?string $webhookURL;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param array<string,mixed>|null $customMetadata
     * @param list<ExtensionItemShape>|null $extensions
     * @param Publish|PublishShape|null $publish
     * @param RemoveAITagsShape|null $removeAITags
     * @param list<string>|null $tags
     */
    public static function with(
        ?string $customCoordinates = null,
        ?array $customMetadata = null,
        ?string $description = null,
        ?array $extensions = null,
        Publish|array|null $publish = null,
        string|array|null $removeAITags = null,
        ?array $tags = null,
        ?string $webhookURL = null,
    ): self {
        $self = new self;

        null !== $customCoordinates && $self['customCoordinates'] = $customCoordinates;
        null !== $customMetadata && $self['customMetadata'] = $customMetadata;
        null !== $description && $self['description'] = $description;
        null !== $extensions && $self['extensions'] = $extensions;
        null !== $publish && $self['publish'] = $publish;
        null !== $removeAITags && $self['removeAITags'] = $removeAITags;
        null !== $tags && $self['tags'] = $tags;
        null !== $webhookURL && $self['webhookURL'] = $webhookURL;

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
     * Configure the publication status of a file and its versions.
     *
     * @param Publish|PublishShape $publish
     */
    public function withPublish(Publish|array $publish): self
    {
        $self = clone $this;
        $self['publish'] = $publish;

        return $self;
    }

    /**
     * An array of AI tags associated with the file that you want to remove, e.g. `["car", "vehicle", "motorsports"]`.
     *
     * If you want to remove all AI tags associated with the file, send the string `"all"`.
     *
     * Note: The remove operation for `ai_tags` executes before any of the `extensions` are processed.
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
}
