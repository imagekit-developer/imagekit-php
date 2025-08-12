<?php

declare(strict_types=1);

namespace ImageKit\CustomMetadataFields;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\Model;
use ImageKit\Core\Concerns\Params;
use ImageKit\Core\Contracts\BaseModel;
use ImageKit\CustomMetadataFields\CustomMetadataFieldCreateParams\Schema;

/**
 * This API creates a new custom metadata field. Once a custom metadata field is created either through this API or using the dashboard UI, its value can be set on the assets. The value of a field for an asset can be set using the media library UI or programmatically through upload or update assets API.
 *
 * @phpstan-type create_params = array{label: string, name: string, schema: Schema}
 */
final class CustomMetadataFieldCreateParams implements BaseModel
{
    use Model;
    use Params;

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
    public static function from(
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
    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    /**
     * API name of the custom metadata field. This should be unique across all (including deleted) custom metadata fields.
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function setSchema(Schema $schema): self
    {
        $this->schema = $schema;

        return $this;
    }
}
