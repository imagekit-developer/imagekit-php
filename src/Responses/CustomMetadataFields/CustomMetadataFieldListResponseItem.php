<?php

declare(strict_types=1);

namespace ImageKit\Responses\CustomMetadataFields;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;
use ImageKit\Responses\CustomMetadataFields\CustomMetadataFieldListResponseItem\Schema;

/**
 * Object containing details of a custom metadata field.
 */
final class CustomMetadataFieldListResponseItem implements BaseModel
{
    use SdkModel;

    /**
     * Unique identifier for the custom metadata field. Use this to update the field.
     */
    #[Api]
    public string $id;

    /**
     * Human readable name of the custom metadata field. This name is displayed as form field label to the users while setting field value on the asset in the media library UI.
     */
    #[Api]
    public string $label;

    /**
     * API name of the custom metadata field. This becomes the key while setting `customMetadata` (key-value object) for an asset using upload or update API.
     */
    #[Api]
    public string $name;

    /**
     * An object that describes the rules for the custom metadata field value.
     */
    #[Api]
    public Schema $schema;

    /**
     * `new CustomMetadataFieldListResponseItem()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CustomMetadataFieldListResponseItem::with(
     *   id: ..., label: ..., name: ..., schema: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CustomMetadataFieldListResponseItem)
     *   ->withID(...)
     *   ->withLabel(...)
     *   ->withName(...)
     *   ->withSchema(...)
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
     */
    public static function with(
        string $id,
        string $label,
        string $name,
        Schema $schema
    ): self {
        $obj = new self;

        $obj->id = $id;
        $obj->label = $label;
        $obj->name = $name;
        $obj->schema = $schema;

        return $obj;
    }

    /**
     * Unique identifier for the custom metadata field. Use this to update the field.
     */
    public function withID(string $id): self
    {
        $obj = clone $this;
        $obj->id = $id;

        return $obj;
    }

    /**
     * Human readable name of the custom metadata field. This name is displayed as form field label to the users while setting field value on the asset in the media library UI.
     */
    public function withLabel(string $label): self
    {
        $obj = clone $this;
        $obj->label = $label;

        return $obj;
    }

    /**
     * API name of the custom metadata field. This becomes the key while setting `customMetadata` (key-value object) for an asset using upload or update API.
     */
    public function withName(string $name): self
    {
        $obj = clone $this;
        $obj->name = $name;

        return $obj;
    }

    /**
     * An object that describes the rules for the custom metadata field value.
     */
    public function withSchema(Schema $schema): self
    {
        $obj = clone $this;
        $obj->schema = $schema;

        return $obj;
    }
}
