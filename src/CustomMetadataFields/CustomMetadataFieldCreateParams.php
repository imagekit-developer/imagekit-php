<?php

declare(strict_types=1);

namespace Imagekit\CustomMetadataFields;

use Imagekit\Core\Attributes\Required;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Concerns\SdkParams;
use Imagekit\Core\Contracts\BaseModel;
use Imagekit\CustomMetadataFields\CustomMetadataFieldCreateParams\Schema;
use Imagekit\CustomMetadataFields\CustomMetadataFieldCreateParams\Schema\Type;

/**
 * This API creates a new custom metadata field. Once a custom metadata field is created either through this API or using the dashboard UI, its value can be set on the assets. The value of a field for an asset can be set using the media library UI or programmatically through upload or update assets API.
 *
 * @see Imagekit\Services\CustomMetadataFieldsService::create()
 *
 * @phpstan-type CustomMetadataFieldCreateParamsShape = array{
 *   label: string,
 *   name: string,
 *   schema: Schema|array{
 *     type: value-of<Type>,
 *     defaultValue?: string|float|bool|null|list<string|float|bool>,
 *     isValueRequired?: bool|null,
 *     maxLength?: float|null,
 *     maxValue?: string|float|null,
 *     minLength?: float|null,
 *     minValue?: string|float|null,
 *     selectOptions?: list<string|float|bool>|null,
 *   },
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
     * @param Schema|array{
     *   type: value-of<Type>,
     *   defaultValue?: string|float|bool|list<string|float|bool>|null,
     *   isValueRequired?: bool|null,
     *   maxLength?: float|null,
     *   maxValue?: string|float|null,
     *   minLength?: float|null,
     *   minValue?: string|float|null,
     *   selectOptions?: list<string|float|bool>|null,
     * } $schema
     */
    public static function with(
        string $label,
        string $name,
        Schema|array $schema
    ): self {
        $obj = new self;

        $obj['label'] = $label;
        $obj['name'] = $name;
        $obj['schema'] = $schema;

        return $obj;
    }

    /**
     * Human readable name of the custom metadata field. This should be unique across all non deleted custom metadata fields. This name is displayed as form field label to the users while setting field value on an asset in the media library UI.
     */
    public function withLabel(string $label): self
    {
        $obj = clone $this;
        $obj['label'] = $label;

        return $obj;
    }

    /**
     * API name of the custom metadata field. This should be unique across all (including deleted) custom metadata fields.
     */
    public function withName(string $name): self
    {
        $obj = clone $this;
        $obj['name'] = $name;

        return $obj;
    }

    /**
     * @param Schema|array{
     *   type: value-of<Type>,
     *   defaultValue?: string|float|bool|list<string|float|bool>|null,
     *   isValueRequired?: bool|null,
     *   maxLength?: float|null,
     *   maxValue?: string|float|null,
     *   minLength?: float|null,
     *   minValue?: string|float|null,
     *   selectOptions?: list<string|float|bool>|null,
     * } $schema
     */
    public function withSchema(Schema|array $schema): self
    {
        $obj = clone $this;
        $obj['schema'] = $schema;

        return $obj;
    }
}
