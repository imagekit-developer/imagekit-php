<?php

declare(strict_types=1);

namespace ImageKit\Responses\CustomMetadataFields;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\Model;
use ImageKit\Core\Contracts\BaseModel;
use ImageKit\Responses\CustomMetadataFields\CustomMetadataFieldNewResponse\Schema;

/**
 * Object containing details of a custom metadata field.
 *
 * @phpstan-type custom_metadata_field_new_response_alias = array{
 *   id: string, label: string, name: string, schema: Schema
 * }
 */
final class CustomMetadataFieldNewResponse implements BaseModel
{
    use Model;

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
    public static function new(
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
    public function setID(string $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Human readable name of the custom metadata field. This name is displayed as form field label to the users while setting field value on the asset in the media library UI.
     */
    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    /**
     * API name of the custom metadata field. This becomes the key while setting `customMetadata` (key-value object) for an asset using upload or update API.
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * An object that describes the rules for the custom metadata field value.
     */
    public function setSchema(Schema $schema): self
    {
        $this->schema = $schema;

        return $this;
    }
}
