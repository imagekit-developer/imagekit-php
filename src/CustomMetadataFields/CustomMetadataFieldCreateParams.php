<?php

declare(strict_types=1);

namespace ImageKit\CustomMetadataFields;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Concerns\SdkParams;
use ImageKit\Core\Contracts\BaseModel;
use ImageKit\CustomMetadataFields\CustomMetadataFieldCreateParams\Schema;

/**
 * This API creates a new custom metadata field. Once a custom metadata field is created either through this API or using the dashboard UI, its value can be set on the assets. The value of a field for an asset can be set using the media library UI or programmatically through upload or update assets API.
 *
 * @phpstan-type custom_metadata_field_create_params = array{
 *   label: string, name: string, schema: Schema
 * }
 */
final class CustomMetadataFieldCreateParams implements BaseModel
{
    /** @use SdkModel<custom_metadata_field_create_params> */
    use SdkModel;
    use SdkParams;

    /**
     * Human readable name of the custom metadata field. This should be unique across all non deleted custom metadata fields. This name is displayed as form field label to the users while setting field value on an asset in the media library UI.
     */
    #[Api]
    public string $label;

    /**
     * API name of the custom metadata field. This should be unique across all (including deleted) custom metadata fields.
     */
    #[Api]
    public string $name;

    #[Api]
    public Schema $schema;

    /**
     * `new CustomMetadataFieldCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CustomMetadataFieldCreateParams::with(label: ..., name: ..., schema: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CustomMetadataFieldCreateParams)
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
        string $label,
        string $name,
        Schema $schema
    ): self {
        $obj = new self;

        $obj->label = $label;
        $obj->name = $name;
        $obj->schema = $schema;

        return $obj;
    }

    /**
     * Human readable name of the custom metadata field. This should be unique across all non deleted custom metadata fields. This name is displayed as form field label to the users while setting field value on an asset in the media library UI.
     */
    public function withLabel(string $label): self
    {
        $obj = clone $this;
        $obj->label = $label;

        return $obj;
    }

    /**
     * API name of the custom metadata field. This should be unique across all (including deleted) custom metadata fields.
     */
    public function withName(string $name): self
    {
        $obj = clone $this;
        $obj->name = $name;

        return $obj;
    }

    public function withSchema(Schema $schema): self
    {
        $obj = clone $this;
        $obj->schema = $schema;

        return $obj;
    }
}
