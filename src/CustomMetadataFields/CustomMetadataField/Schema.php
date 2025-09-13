<?php

declare(strict_types=1);

namespace ImageKit\CustomMetadataFields\CustomMetadataField;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;
use ImageKit\CustomMetadataFields\CustomMetadataField\Schema\DefaultValue;
use ImageKit\CustomMetadataFields\CustomMetadataField\Schema\SelectOption;
use ImageKit\CustomMetadataFields\CustomMetadataField\Schema\Type;

/**
 * An object that describes the rules for the custom metadata field value.
 *
 * @phpstan-type schema_alias = array{
 *   type: value-of<Type>,
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
    /** @use SdkModel<schema_alias> */
    use SdkModel;

    /**
     * Type of the custom metadata field.
     *
     * @var value-of<Type> $type
     */
    #[Api(enum: Type::class)]
    public string $type;

    /**
     * The default value for this custom metadata field. Date type of default value depends on the field type.
     *
     * @var string|float|bool|list<string|float|bool>|null $defaultValue
     */
    #[Api(union: DefaultValue::class, optional: true)]
    public string|float|bool|array|null $defaultValue;

    /**
     * Specifies if the this custom metadata field is required or not.
     */
    #[Api(optional: true)]
    public ?bool $isValueRequired;

    /**
     * Maximum length of string. Only set if `type` is set to `Text` or `Textarea`.
     */
    #[Api(optional: true)]
    public ?float $maxLength;

    /**
     * Maximum value of the field. Only set if field type is `Date` or `Number`. For `Date` type field, the value will be in ISO8601 string format. For `Number` type field, it will be a numeric value.
     */
    #[Api(optional: true)]
    public string|float|null $maxValue;

    /**
     * Minimum length of string. Only set if `type` is set to `Text` or `Textarea`.
     */
    #[Api(optional: true)]
    public ?float $minLength;

    /**
     * Minimum value of the field. Only set if field type is `Date` or `Number`. For `Date` type field, the value will be in ISO8601 string format. For `Number` type field, it will be a numeric value.
     */
    #[Api(optional: true)]
    public string|float|null $minValue;

    /**
     * An array of allowed values when field type is `SingleSelect` or `MultiSelect`.
     *
     * @var list<string|float|bool>|null $selectOptions
     */
    #[Api(list: SelectOption::class, optional: true)]
    public ?array $selectOptions;

    /**
     * `new Schema()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Schema::with(type: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Schema)->withType(...)
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
     * @param string|float|bool|list<string|float|bool> $defaultValue
     * @param list<string|float|bool> $selectOptions
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
        $obj = new self;

        $obj->type = $type instanceof Type ? $type->value : $type;

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
     * Type of the custom metadata field.
     *
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $obj = clone $this;
        $obj->type = $type instanceof Type ? $type->value : $type;

        return $obj;
    }

    /**
     * The default value for this custom metadata field. Date type of default value depends on the field type.
     *
     * @param string|float|bool|list<string|float|bool> $defaultValue
     */
    public function withDefaultValue(
        string|float|bool|array $defaultValue
    ): self {
        $obj = clone $this;
        $obj->defaultValue = $defaultValue;

        return $obj;
    }

    /**
     * Specifies if the this custom metadata field is required or not.
     */
    public function withIsValueRequired(bool $isValueRequired): self
    {
        $obj = clone $this;
        $obj->isValueRequired = $isValueRequired;

        return $obj;
    }

    /**
     * Maximum length of string. Only set if `type` is set to `Text` or `Textarea`.
     */
    public function withMaxLength(float $maxLength): self
    {
        $obj = clone $this;
        $obj->maxLength = $maxLength;

        return $obj;
    }

    /**
     * Maximum value of the field. Only set if field type is `Date` or `Number`. For `Date` type field, the value will be in ISO8601 string format. For `Number` type field, it will be a numeric value.
     */
    public function withMaxValue(string|float $maxValue): self
    {
        $obj = clone $this;
        $obj->maxValue = $maxValue;

        return $obj;
    }

    /**
     * Minimum length of string. Only set if `type` is set to `Text` or `Textarea`.
     */
    public function withMinLength(float $minLength): self
    {
        $obj = clone $this;
        $obj->minLength = $minLength;

        return $obj;
    }

    /**
     * Minimum value of the field. Only set if field type is `Date` or `Number`. For `Date` type field, the value will be in ISO8601 string format. For `Number` type field, it will be a numeric value.
     */
    public function withMinValue(string|float $minValue): self
    {
        $obj = clone $this;
        $obj->minValue = $minValue;

        return $obj;
    }

    /**
     * An array of allowed values when field type is `SingleSelect` or `MultiSelect`.
     *
     * @param list<string|float|bool> $selectOptions
     */
    public function withSelectOptions(array $selectOptions): self
    {
        $obj = clone $this;
        $obj->selectOptions = $selectOptions;

        return $obj;
    }
}
