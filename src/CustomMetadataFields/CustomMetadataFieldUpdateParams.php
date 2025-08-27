<?php

declare(strict_types=1);

namespace ImageKit\CustomMetadataFields;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Concerns\SdkParams;
use ImageKit\Core\Contracts\BaseModel;
use ImageKit\CustomMetadataFields\CustomMetadataFieldUpdateParams\Schema;

/**
 * This API updates the label or schema of an existing custom metadata field.
 *
 * @phpstan-type custom_metadata_field_update_params = array{
 *   label?: string, schema?: Schema
 * }
 */
final class CustomMetadataFieldUpdateParams implements BaseModel
{
    /** @use SdkModel<custom_metadata_field_update_params> */
    use SdkModel;
    use SdkParams;

    /**
     * Human readable name of the custom metadata field. This should be unique across all non deleted custom metadata fields. This name is displayed as form field label to the users while setting field value on an asset in the media library UI. This parameter is required if `schema` is not provided.
     */
    #[Api(optional: true)]
    public ?string $label;

    /**
     * An object that describes the rules for the custom metadata key. This parameter is required if `label` is not provided. Note: `type` cannot be updated and will be ignored if sent with the `schema`. The schema will be validated as per the existing `type`.
     */
    #[Api(optional: true)]
    public ?Schema $schema;

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
        ?string $label = null,
        ?Schema $schema = null
    ): self {
        $obj = new self;

        null !== $label && $obj->label = $label;
        null !== $schema && $obj->schema = $schema;

        return $obj;
    }

    /**
     * Human readable name of the custom metadata field. This should be unique across all non deleted custom metadata fields. This name is displayed as form field label to the users while setting field value on an asset in the media library UI. This parameter is required if `schema` is not provided.
     */
    public function withLabel(string $label): self
    {
        $obj = clone $this;
        $obj->label = $label;

        return $obj;
    }

    /**
     * An object that describes the rules for the custom metadata key. This parameter is required if `label` is not provided. Note: `type` cannot be updated and will be ignored if sent with the `schema`. The schema will be validated as per the existing `type`.
     */
    public function withSchema(Schema $schema): self
    {
        $obj = clone $this;
        $obj->schema = $schema;

        return $obj;
    }
}
