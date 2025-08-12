<?php

declare(strict_types=1);

namespace ImageKit\Responses\CustomMetadataFields\CustomMetadataFieldListResponseItem;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\Model;
use ImageKit\Core\Contracts\BaseModel;
use ImageKit\Core\Conversion\ListOf;
use ImageKit\Responses\CustomMetadataFields\CustomMetadataFieldListResponseItem\Schema\DefaultValue;
use ImageKit\Responses\CustomMetadataFields\CustomMetadataFieldListResponseItem\Schema\SelectOption;
use ImageKit\Responses\CustomMetadataFields\CustomMetadataFieldListResponseItem\Schema\Type;

/**
 * An object that describes the rules for the custom metadata field value.
 *
 * @phpstan-type schema_alias = array{
 *   type: Type::*,
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
     * Type of the custom metadata field.
     *
     * @var Type::* $type
     */
    #[Api(enum: Type::class)]
    public string $type;

    /**
     * The default value for this custom metadata field. Date type of default value depends on the field type.
     *
     * @var null|bool|float|list<bool|float|string>|string $defaultValue
     */
    #[Api(union: DefaultValue::class, optional: true)]
    public null|array|bool|float|string $defaultValue;

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
    public null|float|string $maxValue;

    /**
     * Minimum length of string. Only set if `type` is set to `Text` or `Textarea`.
     */
    #[Api(optional: true)]
    public ?float $minLength;

    /**
     * Minimum value of the field. Only set if field type is `Date` or `Number`. For `Date` type field, the value will be in ISO8601 string format. For `Number` type field, it will be a numeric value.
     */
    #[Api(optional: true)]
    public null|float|string $minValue;

    /**
     * An array of allowed values when field type is `SingleSelect` or `MultiSelect`.
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
     * @param Type::* $type
     * @param null|bool|float|list<bool|float|string>|string $defaultValue
     * @param null|list<bool|float|string> $selectOptions
     */
    public static function new(
        string $type,
        null|array|bool|float|string $defaultValue = null,
        ?bool $isValueRequired = null,
        ?float $maxLength = null,
        null|float|string $maxValue = null,
        ?float $minLength = null,
        null|float|string $minValue = null,
        ?array $selectOptions = null,
    ): self {
        $obj = new self;

        $obj->type = $type;

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
     * @param Type::* $type
     */
    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * The default value for this custom metadata field. Date type of default value depends on the field type.
     *
     * @param bool|float|list<bool|float|string>|string $defaultValue
     */
    public function setDefaultValue(array|bool|float|string $defaultValue): self
    {
        $this->defaultValue = $defaultValue;

        return $this;
    }

    /**
     * Specifies if the this custom metadata field is required or not.
     */
    public function setIsValueRequired(bool $isValueRequired): self
    {
        $this->isValueRequired = $isValueRequired;

        return $this;
    }

    /**
     * Maximum length of string. Only set if `type` is set to `Text` or `Textarea`.
     */
    public function setMaxLength(float $maxLength): self
    {
        $this->maxLength = $maxLength;

        return $this;
    }

    /**
     * Maximum value of the field. Only set if field type is `Date` or `Number`. For `Date` type field, the value will be in ISO8601 string format. For `Number` type field, it will be a numeric value.
     */
    public function setMaxValue(float|string $maxValue): self
    {
        $this->maxValue = $maxValue;

        return $this;
    }

    /**
     * Minimum length of string. Only set if `type` is set to `Text` or `Textarea`.
     */
    public function setMinLength(float $minLength): self
    {
        $this->minLength = $minLength;

        return $this;
    }

    /**
     * Minimum value of the field. Only set if field type is `Date` or `Number`. For `Date` type field, the value will be in ISO8601 string format. For `Number` type field, it will be a numeric value.
     */
    public function setMinValue(float|string $minValue): self
    {
        $this->minValue = $minValue;

        return $this;
    }

    /**
     * An array of allowed values when field type is `SingleSelect` or `MultiSelect`.
     *
     * @param list<bool|float|string> $selectOptions
     */
    public function setSelectOptions(array $selectOptions): self
    {
        $this->selectOptions = $selectOptions;

        return $this;
    }
}
