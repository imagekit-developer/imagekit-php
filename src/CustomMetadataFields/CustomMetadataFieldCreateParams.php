<?php

declare(strict_types=1);

namespace ImageKit\CustomMetadataFields;

use ImageKit\Core\Attributes\Required;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Concerns\SdkParams;
use ImageKit\Core\Contracts\BaseModel;
use ImageKit\CustomMetadataFields\CustomMetadataFieldCreateParams\Schema;

/**
 * This API creates a new custom metadata field. Once a custom metadata field is created either through this API or using the dashboard UI, its value can be set on the assets. The value of a field for an asset can be set using the media library UI or programmatically through upload or update assets API.
 *
 * @see ImageKit\Services\CustomMetadataFieldsService::create()
 *
 * @phpstan-import-type SchemaShape from \ImageKit\CustomMetadataFields\CustomMetadataFieldCreateParams\Schema
 *
 * @phpstan-type CustomMetadataFieldCreateParamsShape = array{
 *   label: string, name: string, schema: Schema|SchemaShape
 * }
 */
final class CustomMetadataFieldCreateParams implements BaseModel
{
    /** @use SdkModel<CustomMetadataFieldCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Human readable name of the custom metadata field. This should be unique across all non deleted custom metadata fields. This name is displayed as form field label to the users while setting field value on an asset in the media library UI.
     */
    #[Required]
    public string $label;

    /**
     * API name of the custom metadata field. This should be unique across all (including deleted) custom metadata fields.
     */
    #[Required]
    public string $name;

    #[Required]
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
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Schema|SchemaShape $schema
     */
    public static function with(
        string $label,
        string $name,
        Schema|array $schema
    ): self {
        $self = new self;

        $self['label'] = $label;
        $self['name'] = $name;
        $self['schema'] = $schema;

        return $self;
    }

    /**
     * Human readable name of the custom metadata field. This should be unique across all non deleted custom metadata fields. This name is displayed as form field label to the users while setting field value on an asset in the media library UI.
     */
    public function withLabel(string $label): self
    {
        $self = clone $this;
        $self['label'] = $label;

        return $self;
    }

    /**
     * API name of the custom metadata field. This should be unique across all (including deleted) custom metadata fields.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * @param Schema|SchemaShape $schema
     */
    public function withSchema(Schema|array $schema): self
    {
        $self = clone $this;
        $self['schema'] = $schema;

        return $self;
    }
}
