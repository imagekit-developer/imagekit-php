<?php

declare(strict_types=1);

namespace Imagekit\CustomMetadataFields\CustomMetadataField;

use Imagekit\Core\Attributes\Optional;
use Imagekit\Core\Attributes\Required;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Contracts\BaseModel;
use Imagekit\CustomMetadataFields\CustomMetadataField\Schema\DefaultValue;
use Imagekit\CustomMetadataFields\CustomMetadataField\Schema\SelectOption;
use Imagekit\CustomMetadataFields\CustomMetadataField\Schema\Type;

/**
 * An object that describes the rules for the custom metadata field value.
 *
 * @phpstan-type SchemaShape = array{
 *   type: value-of<Type>,
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
     * Type of the custom metadata field.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * The default value for this custom metadata field. Data type of default value depends on the field type.
     *
     * @var string|float|bool|list<string|float|bool>|null $defaultValue
     */
    #[Optional(union: DefaultValue::class)]
    public string|float|bool|array|null $defaultValue;

    /**
     * Specifies if the this custom metadata field is required or not.
     */
    #[Optional]
    public ?bool $isValueRequired;

    /**
     * Maximum length of string. Only set if `type` is set to `Text` or `Textarea`.
     */
    #[Optional]
    public ?float $maxLength;

    /**
     * Maximum value of the field. Only set if field type is `Date` or `Number`. For `Date` type field, the value will be in ISO8601 string format. For `Number` type field, it will be a numeric value.
     */
    #[Optional]
    public string|float|null $maxValue;

    /**
     * Minimum length of string. Only set if `type` is set to `Text` or `Textarea`.
     */
    #[Optional]
    public ?float $minLength;

    /**
     * Minimum value of the field. Only set if field type is `Date` or `Number`. For `Date` type field, the value will be in ISO8601 string format. For `Number` type field, it will be a numeric value.
     */
    #[Optional]
    public string|float|null $minValue;

    /**
     * An array of allowed values when field type is `SingleSelect` or `MultiSelect`.
     *
     * @var list<string|float|bool>|null $selectOptions
     */
    #[Optional(list: SelectOption::class)]
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
     * Specifies if the this custom metadata field is required or not.
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
     * @param list<string|float|bool> $selectOptions
     */
    public function withSelectOptions(array $selectOptions): self
    {
        $self = clone $this;
        $self['selectOptions'] = $selectOptions;

        return $self;
    }
}
