<?php

declare(strict_types=1);

namespace Imagekit\CustomMetadataFields;

use Imagekit\Core\Attributes\Optional;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Concerns\SdkParams;
use Imagekit\Core\Contracts\BaseModel;
use Imagekit\CustomMetadataFields\CustomMetadataFieldUpdateParams\Schema;

/**
 * This API updates the label or schema of an existing custom metadata field.
 *
 * @see Imagekit\Services\CustomMetadataFieldsService::update()
 *
 * @phpstan-type CustomMetadataFieldUpdateParamsShape = array{
 *   label?: string,
 *   schema?: Schema|array{
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
     * @param Schema|array{
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
        ?string $label = null,
        Schema|array|null $schema = null
    ): self {
        $obj = new self;

        null !== $label && $obj['label'] = $label;
        null !== $schema && $obj['schema'] = $schema;

        return $obj;
    }

    /**
     * Human readable name of the custom metadata field. This should be unique across all non deleted custom metadata fields. This name is displayed as form field label to the users while setting field value on an asset in the media library UI. This parameter is required if `schema` is not provided.
     */
    public function withLabel(string $label): self
    {
        $obj = clone $this;
        $obj['label'] = $label;

        return $obj;
    }

    /**
     * An object that describes the rules for the custom metadata key. This parameter is required if `label` is not provided. Note: `type` cannot be updated and will be ignored if sent with the `schema`. The schema will be validated as per the existing `type`.
     *
     * @param Schema|array{
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
