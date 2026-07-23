<?php

declare(strict_types=1);

namespace ImageKit\CustomMetadataFields;

use ImageKit\Core\Attributes\Optional;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Concerns\SdkParams;
use ImageKit\Core\Contracts\BaseModel;
use ImageKit\CustomMetadataFields\CustomMetadataFieldUpdateParams\Schema;

/**
 * This API updates the label or schema of an existing custom metadata field.
 *
 * @see ImageKit\Services\CustomMetadataFieldsService::update()
 *
 * @phpstan-import-type SchemaShape from \ImageKit\CustomMetadataFields\CustomMetadataFieldUpdateParams\Schema
 *
 * @phpstan-type CustomMetadataFieldUpdateParamsShape = array{
 *   label?: string|null, schema?: null|Schema|SchemaShape
 * }
 */
final class CustomMetadataFieldUpdateParams implements BaseModel
{
    /** @use SdkModel<CustomMetadataFieldUpdateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Human readable name of the custom metadata field. This should be unique across all non deleted custom metadata fields. This name is displayed as form field label to the users while setting field value on an asset in the media library UI. This parameter is required if `schema` is not provided.
     */
    #[Optional]
    public ?string $label;

    /**
     * An object that describes the rules for the custom metadata key. This parameter is required if `label` is not provided. Note: `type` cannot be updated and will be ignored if sent with the `schema`. The schema will be validated as per the existing `type`.
     */
    #[Optional]
    public ?Schema $schema;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Schema|SchemaShape|null $schema
     */
    public static function with(
        ?string $label = null,
        Schema|array|null $schema = null
    ): self {
        $self = new self;

        null !== $label && $self['label'] = $label;
        null !== $schema && $self['schema'] = $schema;

        return $self;
    }

    /**
     * Human readable name of the custom metadata field. This should be unique across all non deleted custom metadata fields. This name is displayed as form field label to the users while setting field value on an asset in the media library UI. This parameter is required if `schema` is not provided.
     */
    public function withLabel(string $label): self
    {
        $self = clone $this;
        $self['label'] = $label;

        return $self;
    }

    /**
     * An object that describes the rules for the custom metadata key. This parameter is required if `label` is not provided. Note: `type` cannot be updated and will be ignored if sent with the `schema`. The schema will be validated as per the existing `type`.
     *
     * @param Schema|SchemaShape $schema
     */
    public function withSchema(Schema|array $schema): self
    {
        $self = clone $this;
        $self['schema'] = $schema;

        return $self;
    }
}
