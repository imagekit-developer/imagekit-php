<?php

declare(strict_types=1);

namespace ImageKit\CustomMetadataFields\CustomMetadataFieldUpdateParams;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\Model;
use ImageKit\Core\Contracts\BaseModel;
use ImageKit\Core\Conversion\ListOf;
use ImageKit\CustomMetadataFields\CustomMetadataFieldUpdateParams\Schema\DefaultValue;
use ImageKit\CustomMetadataFields\CustomMetadataFieldUpdateParams\Schema\SelectOption;

/**
 * An object that describes the rules for the custom metadata key. This parameter is required if `label` is not provided. Note: `type` cannot be updated and will be ignored if sent with the `schema`. The schema will be validated as per the existing `type`.
 *
 * @phpstan-type schema_alias = array{
 *   defaultValue?: string|float|bool|list<string|float|bool>,
 *   isValueRequired?: bool,
 *   maxLength?: float,
 *   maxValue?: string|float,
 *   minLength?: float,
 *   minValue?: string|float,
 *   selectOptions?: list<string|float|bool>,
 * }
 */
final class Schema implements BaseModel
{
    use Model;

    /**
     * The default value for this custom metadata field. This property is only required if `isValueRequired` property is set to `true`. The value should match the `type` of custom metadata field.
     *
     * @var null|bool|float|list<bool|float|string>|string $defaultValue
     */
    #[Api(union: DefaultValue::class, optional: true)]
    public null|array|bool|float|string $defaultValue;

    /**
     * Sets this custom metadata field as required. Setting custom metadata fields on an asset will throw error if the value for all required fields are not present in upload or update asset API request body.
     */
    #[Api(optional: true)]
    public ?bool $isValueRequired;

    /**
     * Maximum length of string. Only set this property if `type` is set to `Text` or `Textarea`.
     */
    #[Api(optional: true)]
    public ?float $maxLength;

    /**
     * Maximum value of the field. Only set this property if field type is `Date` or `Number`. For `Date` type field, set the minimum date in ISO8601 string format. For `Number` type field, set the minimum numeric value.
     */
    #[Api(optional: true)]
    public null|float|string $maxValue;

    /**
     * Minimum length of string. Only set this property if `type` is set to `Text` or `Textarea`.
     */
    #[Api(optional: true)]
    public ?float $minLength;

    /**
     * Minimum value of the field. Only set this property if field type is `Date` or `Number`. For `Date` type field, set the minimum date in ISO8601 string format. For `Number` type field, set the minimum numeric value.
     */
    #[Api(optional: true)]
    public null|float|string $minValue;

    /**
     * An array of allowed values. This property is only required if `type` property is set to `SingleSelect` or `MultiSelect`.
     *
     * @var null|list<bool|float|string> $selectOptions
     */
    #[Api(type: new ListOf(union: SelectOption::class), optional: true)]
    public ?array $selectOptions;

    public function __construct()
    {
        self::introspect();
        $this->unsetOptionalProperties();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param null|bool|float|list<bool|float|string>|string $defaultValue
     * @param null|list<bool|float|string> $selectOptions
     */
    public static function new(
        null|array|bool|float|string $defaultValue = null,
        ?bool $isValueRequired = null,
        ?float $maxLength = null,
        null|float|string $maxValue = null,
        ?float $minLength = null,
        null|float|string $minValue = null,
        ?array $selectOptions = null,
    ): self {
        $obj = new self;

        null !== $defaultValue && $obj->defaultValue = $defaultValue;
        null !== $isValueRequired && $obj->isValueRequired = $isValueRequired;
        null !== $maxLength && $obj->maxLength = $maxLength;
        null !== $maxValue && $obj->maxValue = $maxValue;
        null !== $minLength && $obj->minLength = $minLength;
        null !== $minValue && $obj->minValue = $minValue;
        null !== $selectOptions && $obj->selectOptions = $selectOptions;

        return $obj;
    }

    /**
     * The default value for this custom metadata field. This property is only required if `isValueRequired` property is set to `true`. The value should match the `type` of custom metadata field.
     *
     * @param bool|float|list<bool|float|string>|string $defaultValue
     */
    public function setDefaultValue(array|bool|float|string $defaultValue): self
    {
        $this->defaultValue = $defaultValue;

        return $this;
    }

    /**
     * Sets this custom metadata field as required. Setting custom metadata fields on an asset will throw error if the value for all required fields are not present in upload or update asset API request body.
     */
    public function setIsValueRequired(bool $isValueRequired): self
    {
        $this->isValueRequired = $isValueRequired;

        return $this;
    }

    /**
     * Maximum length of string. Only set this property if `type` is set to `Text` or `Textarea`.
     */
    public function setMaxLength(float $maxLength): self
    {
        $this->maxLength = $maxLength;

        return $this;
    }

    /**
     * Maximum value of the field. Only set this property if field type is `Date` or `Number`. For `Date` type field, set the minimum date in ISO8601 string format. For `Number` type field, set the minimum numeric value.
     */
    public function setMaxValue(float|string $maxValue): self
    {
        $this->maxValue = $maxValue;

        return $this;
    }

    /**
     * Minimum length of string. Only set this property if `type` is set to `Text` or `Textarea`.
     */
    public function setMinLength(float $minLength): self
    {
        $this->minLength = $minLength;

        return $this;
    }

    /**
     * Minimum value of the field. Only set this property if field type is `Date` or `Number`. For `Date` type field, set the minimum date in ISO8601 string format. For `Number` type field, set the minimum numeric value.
     */
    public function setMinValue(float|string $minValue): self
    {
        $this->minValue = $minValue;

        return $this;
    }

    /**
     * An array of allowed values. This property is only required if `type` property is set to `SingleSelect` or `MultiSelect`.
     *
     * @param list<bool|float|string> $selectOptions
     */
    public function setSelectOptions(array $selectOptions): self
    {
        $this->selectOptions = $selectOptions;

        return $this;
    }
}
