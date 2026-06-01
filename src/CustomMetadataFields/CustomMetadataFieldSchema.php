<?php

declare(strict_types=1);

namespace ImageKit\CustomMetadataFields;

use ImageKit\Core\Attributes\Optional;
use ImageKit\Core\Attributes\Required;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;
use ImageKit\CustomMetadataFields\CustomMetadataFieldSchema\DefaultValue;
use ImageKit\CustomMetadataFields\CustomMetadataFieldSchema\SelectOption;
use ImageKit\CustomMetadataFields\CustomMetadataFieldSchema\Type;

/**
 * Schema rules for a custom metadata field value.
 *
 * @phpstan-import-type DefaultValueVariants from \ImageKit\CustomMetadataFields\CustomMetadataFieldSchema\DefaultValue
 * @phpstan-import-type MaxValueVariants from \ImageKit\CustomMetadataFields\CustomMetadataFieldSchema\MaxValue
 * @phpstan-import-type MinValueVariants from \ImageKit\CustomMetadataFields\CustomMetadataFieldSchema\MinValue
 * @phpstan-import-type SelectOptionVariants from \ImageKit\CustomMetadataFields\CustomMetadataFieldSchema\SelectOption
 * @phpstan-import-type DefaultValueShape from \ImageKit\CustomMetadataFields\CustomMetadataFieldSchema\DefaultValue
 * @phpstan-import-type MaxValueShape from \ImageKit\CustomMetadataFields\CustomMetadataFieldSchema\MaxValue
 * @phpstan-import-type MinValueShape from \ImageKit\CustomMetadataFields\CustomMetadataFieldSchema\MinValue
 * @phpstan-import-type SelectOptionShape from \ImageKit\CustomMetadataFields\CustomMetadataFieldSchema\SelectOption
 *
 * @phpstan-type CustomMetadataFieldSchemaShape = array{
 *   type: Type|value-of<Type>,
 *   defaultValue?: DefaultValueShape|null,
 *   isValueRequired?: bool|null,
 *   maxLength?: float|null,
 *   maxValue?: MaxValueShape|null,
 *   minLength?: float|null,
 *   minValue?: MinValueShape|null,
 *   selectOptions?: list<SelectOptionShape>|null,
 * }
 */
final class CustomMetadataFieldSchema implements BaseModel
{
    /** @use SdkModel<CustomMetadataFieldSchemaShape> */
    use SdkModel;

    /**
     * Type of the custom metadata field.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * The default value for this custom metadata field. Data type of default value depends on the field type.
     *
     * @var DefaultValueVariants|null $defaultValue
     */
    #[Optional('default_value', union: DefaultValue::class)]
    public string|float|bool|array|null $defaultValue;

    /**
     * Specifies if the custom metadata field is required or not.
     */
    #[Optional('is_value_required')]
    public ?bool $isValueRequired;

    /**
     * Maximum length of string. Only set if `type` is set to `Text` or `Textarea`.
     */
    #[Optional('max_length')]
    public ?float $maxLength;

    /**
     * Maximum value of the field. Only set if field type is `Date` or `Number`. For `Date` type field, the value will be in ISO8601 string format. For `Number` type field, it will be a numeric value.
     *
     * @var MaxValueVariants|null $maxValue
     */
    #[Optional('max_value')]
    public string|float|null $maxValue;

    /**
     * Minimum length of string. Only set if `type` is set to `Text` or `Textarea`.
     */
    #[Optional('min_length')]
    public ?float $minLength;

    /**
     * Minimum value of the field. Only set if field type is `Date` or `Number`. For `Date` type field, the value will be in ISO8601 string format. For `Number` type field, it will be a numeric value.
     *
     * @var MinValueVariants|null $minValue
     */
    #[Optional('min_value')]
    public string|float|null $minValue;

    /**
     * An array of allowed values when field type is `SingleSelect` or `MultiSelect`.
     *
     * @var list<SelectOptionVariants>|null $selectOptions
     */
    #[Optional('select_options', list: SelectOption::class)]
    public ?array $selectOptions;

    /**
     * `new CustomMetadataFieldSchema()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CustomMetadataFieldSchema::with(type: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CustomMetadataFieldSchema)->withType(...)
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
     * @param Type|value-of<Type> $type
     * @param DefaultValueShape|null $defaultValue
     * @param MaxValueShape|null $maxValue
     * @param MinValueShape|null $minValue
     * @param list<SelectOptionShape>|null $selectOptions
     */
    public static function with(
        Type|string $type,
        string|float|bool|array|null $defaultValue = null,
        ?bool $isValueRequired = null,
        ?float $maxLength = null,
        string|float|null $maxValue = null,
        ?float $minLength = null,
        string|float|null $minValue = null,
        ?array $selectOptions = null,
    ): self {
        $self = new self;

        $self['type'] = $type;

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
     * Type of the custom metadata field.
     *
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }

    /**
     * The default value for this custom metadata field. Data type of default value depends on the field type.
     *
     * @param DefaultValueShape $defaultValue
     */
    public function withDefaultValue(
        string|float|bool|array $defaultValue
    ): self {
        $self = clone $this;
        $self['defaultValue'] = $defaultValue;

        return $self;
    }

    /**
     * Specifies if the custom metadata field is required or not.
     */
    public function withIsValueRequired(bool $isValueRequired): self
    {
        $self = clone $this;
        $self['isValueRequired'] = $isValueRequired;

        return $self;
    }

    /**
     * Maximum length of string. Only set if `type` is set to `Text` or `Textarea`.
     */
    public function withMaxLength(float $maxLength): self
    {
        $self = clone $this;
        $self['maxLength'] = $maxLength;

        return $self;
    }

    /**
     * Maximum value of the field. Only set if field type is `Date` or `Number`. For `Date` type field, the value will be in ISO8601 string format. For `Number` type field, it will be a numeric value.
     *
     * @param MaxValueShape $maxValue
     */
    public function withMaxValue(string|float $maxValue): self
    {
        $self = clone $this;
        $self['maxValue'] = $maxValue;

        return $self;
    }

    /**
     * Minimum length of string. Only set if `type` is set to `Text` or `Textarea`.
     */
    public function withMinLength(float $minLength): self
    {
        $self = clone $this;
        $self['minLength'] = $minLength;

        return $self;
    }

    /**
     * Minimum value of the field. Only set if field type is `Date` or `Number`. For `Date` type field, the value will be in ISO8601 string format. For `Number` type field, it will be a numeric value.
     *
     * @param MinValueShape $minValue
     */
    public function withMinValue(string|float $minValue): self
    {
        $self = clone $this;
        $self['minValue'] = $minValue;

        return $self;
    }

    /**
     * An array of allowed values when field type is `SingleSelect` or `MultiSelect`.
     *
     * @param list<SelectOptionShape> $selectOptions
     */
    public function withSelectOptions(array $selectOptions): self
    {
        $self = clone $this;
        $self['selectOptions'] = $selectOptions;

        return $self;
    }
}
