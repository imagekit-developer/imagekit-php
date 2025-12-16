<?php

declare(strict_types=1);

namespace Imagekit\CustomMetadataFields;

use Imagekit\Core\Attributes\Required;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Contracts\BaseModel;
use Imagekit\CustomMetadataFields\CustomMetadataField\Schema;

/**
 * Object containing details of a custom metadata field.
 *
 * @phpstan-import-type SchemaShape from \Imagekit\CustomMetadataFields\CustomMetadataField\Schema
 *
 * @phpstan-type CustomMetadataFieldShape = array{
 *   id: string, label: string, name: string, schema: Schema|SchemaShape
 * }
 */
final class CustomMetadataField implements BaseModel
{
    /** @use SdkModel<CustomMetadataFieldShape> */
    use SdkModel;

    /**
     * Unique identifier for the custom metadata field. Use this to update the field.
     */
    #[Required]
    public string $id;

    /**
     * Human readable name of the custom metadata field. This name is displayed as form field label to the users while setting field value on the asset in the media library UI.
     */
    #[Required]
    public string $label;

    /**
     * API name of the custom metadata field. This becomes the key while setting `customMetadata` (key-value object) for an asset using upload or update API.
     */
    #[Required]
    public string $name;

    /**
     * An object that describes the rules for the custom metadata field value.
     */
    #[Required]
    public Schema $schema;

    /**
     * `new CustomMetadataField()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CustomMetadataField::with(id: ..., label: ..., name: ..., schema: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CustomMetadataField)
     *   ->withID(...)
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
     * @param SchemaShape $schema
     */
    public static function with(
        string $id,
        string $label,
        string $name,
        Schema|array $schema
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['label'] = $label;
        $self['name'] = $name;
        $self['schema'] = $schema;

        return $self;
    }

    /**
     * Unique identifier for the custom metadata field. Use this to update the field.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Human readable name of the custom metadata field. This name is displayed as form field label to the users while setting field value on the asset in the media library UI.
     */
    public function withLabel(string $label): self
    {
        $self = clone $this;
        $self['label'] = $label;

        return $self;
    }

    /**
     * API name of the custom metadata field. This becomes the key while setting `customMetadata` (key-value object) for an asset using upload or update API.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * An object that describes the rules for the custom metadata field value.
     *
     * @param SchemaShape $schema
     */
    public function withSchema(Schema|array $schema): self
    {
        $self = clone $this;
        $self['schema'] = $schema;

        return $self;
    }
}
