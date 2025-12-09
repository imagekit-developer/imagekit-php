<?php

declare(strict_types=1);

namespace Imagekit\CustomMetadataFields\CustomMetadataFieldUpdateParams;

use Imagekit\Core\Attributes\Optional;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Contracts\BaseModel;
use Imagekit\CustomMetadataFields\CustomMetadataFieldUpdateParams\Schema\DefaultValue;
use Imagekit\CustomMetadataFields\CustomMetadataFieldUpdateParams\Schema\SelectOption;

/**
 * An object that describes the rules for the custom metadata key. This parameter is required if `label` is not provided. Note: `type` cannot be updated and will be ignored if sent with the `schema`. The schema will be validated as per the existing `type`.
 *
 * @phpstan-type SchemaShape = array{
 *   defaultValue?: string|float|bool|null|list<string|float|bool>,
 *   isValueRequired?: bool|null,
 *   maxLength?: float|null,
 *   maxValue?: string|float|null,
 *   minLength?: float|null,
 *   minValue?: string|float|null,
 *   selectOptions?: list<string|float|bool>|null,
 * }
 */
final class Schema implements BaseModel
{
    /** @use SdkModel<SchemaShape> */
    use SdkModel;

    /**
     * The default value for this custom metadata field. This property is only required if `isValueRequired` property is set to `true`. The value should match the `type` of custom metadata field.
     *
     * @var string|float|bool|list<string|float|bool>|null $defaultValue
     */
    #[Optional(union: DefaultValue::class)]
    public string|float|bool|array|null $defaultValue;

    /**
     * Sets this custom metadata field as required. Setting custom metadata fields on an asset will throw error if the value for all required fields are not present in upload or update asset API request body.
     */
    #[Optional]
    public ?bool $isValueRequired;

    /**
     * Maximum length of string. Only set this property if `type` is set to `Text` or `Textarea`.
     */
    #[Optional]
    public ?float $maxLength;

    /**
     * Maximum value of the field. Only set this property if field type is `Date` or `Number`. For `Date` type field, set the minimum date in ISO8601 string format. For `Number` type field, set the minimum numeric value.
     */
    #[Optional]
    public string|float|null $maxValue;

    /**
     * Minimum length of string. Only set this property if `type` is set to `Text` or `Textarea`.
     */
    #[Optional]
    public ?float $minLength;

    /**
     * Minimum value of the field. Only set this property if field type is `Date` or `Number`. For `Date` type field, set the minimum date in ISO8601 string format. For `Number` type field, set the minimum numeric value.
     */
    #[Optional]
    public string|float|null $minValue;

    /**
     * An array of allowed values. This property is only required if `type` property is set to `SingleSelect` or `MultiSelect`.
     *
     * @var list<string|float|bool>|null $selectOptions
     */
    #[Optional(list: SelectOption::class)]
    public ?array $selectOptions;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param string|float|bool|list<string|float|bool> $defaultValue
     * @param list<string|float|bool> $selectOptions
     */
    public static function with(
        string|float|bool|array|null $defaultValue = null,
        ?bool $isValueRequired = null,
        ?float $maxLength = null,
        string|float|null $maxValue = null,
        ?float $minLength = null,
        string|float|null $minValue = null,
        ?array $selectOptions = null,
    ): self {
        $self = new self;

        null !== $defaultValue && $self['defaultValue'] = $defaultValue;
        null !== $isValueRequired && $self['isValueRequired'] = $isValueRequired;
        null !== $maxLength && $self['maxLength'] = $maxLength;
        null !== $maxValue && $self['maxValue'] = $maxValue;
        null !== $minLength && $self['minLength'] = $minLength;
        null !== $minValue && $self['minValue'] = $minValue;
        null !== $selectOptions && $self['selectOptions'] = $selectOptions;

        return $self;
    }

    /**
     * The default value for this custom metadata field. This property is only required if `isValueRequired` property is set to `true`. The value should match the `type` of custom metadata field.
     *
     * @param string|float|bool|list<string|float|bool> $defaultValue
     */
    public function withDefaultValue(
        string|float|bool|array $defaultValue
    ): self {
        $self = clone $this;
        $self['defaultValue'] = $defaultValue;

        return $self;
    }

    /**
     * Sets this custom metadata field as required. Setting custom metadata fields on an asset will throw error if the value for all required fields are not present in upload or update asset API request body.
     */
    public function withIsValueRequired(bool $isValueRequired): self
    {
        $self = clone $this;
        $self['isValueRequired'] = $isValueRequired;

        return $self;
    }

    /**
     * Maximum length of string. Only set this property if `type` is set to `Text` or `Textarea`.
     */
    public function withMaxLength(float $maxLength): self
    {
        $self = clone $this;
        $self['maxLength'] = $maxLength;

        return $self;
    }

    /**
     * Maximum value of the field. Only set this property if field type is `Date` or `Number`. For `Date` type field, set the minimum date in ISO8601 string format. For `Number` type field, set the minimum numeric value.
     */
    public function withMaxValue(string|float $maxValue): self
    {
        $self = clone $this;
        $self['maxValue'] = $maxValue;

        return $self;
    }

    /**
     * Minimum length of string. Only set this property if `type` is set to `Text` or `Textarea`.
     */
    public function withMinLength(float $minLength): self
    {
        $self = clone $this;
        $self['minLength'] = $minLength;

        return $self;
    }

    /**
     * Minimum value of the field. Only set this property if field type is `Date` or `Number`. For `Date` type field, set the minimum date in ISO8601 string format. For `Number` type field, set the minimum numeric value.
     */
    public function withMinValue(string|float $minValue): self
    {
        $self = clone $this;
        $self['minValue'] = $minValue;

        return $self;
    }

    /**
     * An array of allowed values. This property is only required if `type` property is set to `SingleSelect` or `MultiSelect`.
     *
     * @param list<string|float|bool> $selectOptions
     */
    public function withSelectOptions(array $selectOptions): self
    {
        $self = clone $this;
        $self['selectOptions'] = $selectOptions;

        return $self;
    }
}
