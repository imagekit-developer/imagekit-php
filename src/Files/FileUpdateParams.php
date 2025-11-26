<?php

declare(strict_types=1);

namespace ImageKit\Files;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Concerns\SdkParams;
use ImageKit\Core\Contracts\BaseModel;
use ImageKit\ExtensionItem;
use ImageKit\ExtensionItem\AIAutoDescription;
use ImageKit\ExtensionItem\AutoTaggingExtension;
use ImageKit\ExtensionItem\RemoveBg;
use ImageKit\Files\FileUpdateParams\Publish;
use ImageKit\Files\FileUpdateParams\RemoveAITags;

/**
 * This API updates the details or attributes of the current version of the file. You can update `tags`, `customCoordinates`, `customMetadata`, publication status, remove existing `AITags` and apply extensions using this API.
 *
 * @see ImageKit\Services\FilesService::update()
 *
 * @phpstan-type FileUpdateParamsShape = array{
 *   customCoordinates?: string|null,
 *   customMetadata?: array<string,mixed>,
 *   description?: string,
 *   extensions?: list<RemoveBg|AutoTaggingExtension|AIAutoDescription>,
 *   removeAITags?: 'all'|list<string>,
 *   tags?: list<string>|null,
 *   webhookUrl?: string,
 *   publish?: Publish,
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
    #[Api(nullable: true, optional: true)]
    public ?string $customCoordinates;

    /**
     * A key-value data to be associated with the asset. To unset a key, send `null` value for that key. Before setting any custom metadata on an asset you have to create the field using custom metadata fields API.
     *
     * @var array<string,mixed>|null $customMetadata
     */
    #[Api(map: 'mixed', optional: true)]
    public ?array $customMetadata;

    /**
     * Optional text to describe the contents of the file.
     */
    #[Api(optional: true)]
    public ?string $description;

    /**
     * Array of extensions to be applied to the asset. Each extension can be configured with specific parameters based on the extension type.
     *
     * @var list<RemoveBg|AutoTaggingExtension|AIAutoDescription>|null $extensions
     */
    #[Api(list: ExtensionItem::class, optional: true)]
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
    #[Api(union: RemoveAITags::class, optional: true)]
    public string|array|null $removeAITags;

    /**
     * An array of tags associated with the file, such as `["tag1", "tag2"]`. Send `null` to unset all tags associated with the file.
     *
     * @var list<string>|null $tags
     */
    #[Api(list: 'string', nullable: true, optional: true)]
    public ?array $tags;

    /**
     * The final status of extensions after they have completed execution will be delivered to this endpoint as a POST request. [Learn more](/docs/api-reference/digital-asset-management-dam/managing-assets/update-file-details#webhook-payload-structure) about the webhook payload structure.
     */
    #[Api(optional: true)]
    public ?string $webhookUrl;

    /**
     * Configure the publication status of a file and its versions.
     */
    #[Api(optional: true)]
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
     * @param list<RemoveBg|AutoTaggingExtension|AIAutoDescription> $extensions
     * @param 'all'|list<string> $removeAITags
     * @param list<string>|null $tags
     */
    public static function with(
        ?string $customCoordinates = null,
        ?array $customMetadata = null,
        ?string $description = null,
        ?array $extensions = null,
        string|array|null $removeAITags = null,
        ?array $tags = null,
        ?string $webhookUrl = null,
        ?Publish $publish = null,
    ): self {
        $obj = new self;

        null !== $customCoordinates && $obj->customCoordinates = $customCoordinates;
        null !== $customMetadata && $obj->customMetadata = $customMetadata;
        null !== $description && $obj->description = $description;
        null !== $extensions && $obj->extensions = $extensions;
        null !== $removeAITags && $obj->removeAITags = $removeAITags;
        null !== $tags && $obj->tags = $tags;
        null !== $webhookUrl && $obj->webhookUrl = $webhookUrl;
        null !== $publish && $obj->publish = $publish;

        return $obj;
    }

    /**
     * Define an important area in the image in the format `x,y,width,height` e.g. `10,10,100,100`. Send `null` to unset this value.
     */
    public function withCustomCoordinates(?string $customCoordinates): self
    {
        $obj = clone $this;
        $obj->customCoordinates = $customCoordinates;

        return $obj;
    }

    /**
     * A key-value data to be associated with the asset. To unset a key, send `null` value for that key. Before setting any custom metadata on an asset you have to create the field using custom metadata fields API.
     *
     * @param array<string,mixed> $customMetadata
     */
    public function withCustomMetadata(array $customMetadata): self
    {
        $obj = clone $this;
        $obj->customMetadata = $customMetadata;

        return $obj;
    }

    /**
     * Optional text to describe the contents of the file.
     */
    public function withDescription(string $description): self
    {
        $obj = clone $this;
        $obj->description = $description;

        return $obj;
    }

    /**
     * Array of extensions to be applied to the asset. Each extension can be configured with specific parameters based on the extension type.
     *
     * @param list<RemoveBg|AutoTaggingExtension|AIAutoDescription> $extensions
     */
    public function withExtensions(array $extensions): self
    {
        $obj = clone $this;
        $obj->extensions = $extensions;

        return $obj;
    }

    /**
     * An array of AITags associated with the file that you want to remove, e.g. `["car", "vehicle", "motorsports"]`.
     *
     * If you want to remove all AITags associated with the file, send a string - "all".
     *
     * Note: The remove operation for `AITags` executes before any of the `extensions` are processed.
     *
     * @param 'all'|list<string> $removeAITags
     */
    public function withRemoveAITags(string|array $removeAITags): self
    {
        $obj = clone $this;
        $obj->removeAITags = $removeAITags;

        return $obj;
    }

    /**
     * An array of tags associated with the file, such as `["tag1", "tag2"]`. Send `null` to unset all tags associated with the file.
     *
     * @param list<string>|null $tags
     */
    public function withTags(?array $tags): self
    {
        $obj = clone $this;
        $obj->tags = $tags;

        return $obj;
    }

    /**
     * The final status of extensions after they have completed execution will be delivered to this endpoint as a POST request. [Learn more](/docs/api-reference/digital-asset-management-dam/managing-assets/update-file-details#webhook-payload-structure) about the webhook payload structure.
     */
    public function withWebhookURL(string $webhookURL): self
    {
        $obj = clone $this;
        $obj->webhookUrl = $webhookURL;

        return $obj;
    }

    /**
     * Configure the publication status of a file and its versions.
     */
    public function withPublish(Publish $publish): self
    {
        $obj = clone $this;
        $obj->publish = $publish;

        return $obj;
    }
}
