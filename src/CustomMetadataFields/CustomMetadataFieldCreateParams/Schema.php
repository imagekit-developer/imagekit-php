<?php

declare(strict_types=1);

namespace Imagekit\CustomMetadataFields\CustomMetadataFieldCreateParams;

use Imagekit\Core\Attributes\Optional;
use Imagekit\Core\Attributes\Required;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Contracts\BaseModel;
use Imagekit\CustomMetadataFields\CustomMetadataFieldCreateParams\Schema\DefaultValue;
use Imagekit\CustomMetadataFields\CustomMetadataFieldCreateParams\Schema\SelectOption;
use Imagekit\CustomMetadataFields\CustomMetadataFieldCreateParams\Schema\Type;

/**
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

        $obj['type'] = $type;

        null !== $defaultValue && $obj['defaultValue'] = $defaultValue;
        null !== $isValueRequired && $obj['isValueRequired'] = $isValueRequired;
        null !== $maxLength && $obj['maxLength'] = $maxLength;
        null !== $maxValue && $obj['maxValue'] = $maxValue;
        null !== $minLength && $obj['minLength'] = $minLength;
        null !== $minValue && $obj['minValue'] = $minValue;
        null !== $selectOptions && $obj['selectOptions'] = $selectOptions;

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
        $obj['type'] = $type;

        return $obj;
    }

    /**
     * The default value for this custom metadata field. This property is only required if `isValueRequired` property is set to `true`. The value should match the `type` of custom metadata field.
     *
     * @param string|float|bool|list<string|float|bool> $defaultValue
     */
    public function withDefaultValue(
        string|float|bool|array $defaultValue
    ): self {
        $obj = clone $this;
        $obj['defaultValue'] = $defaultValue;

        return $obj;
    }

    /**
     * Sets this custom metadata field as required. Setting custom metadata fields on an asset will throw error if the value for all required fields are not present in upload or update asset API request body.
     */
    public function withIsValueRequired(bool $isValueRequired): self
    {
        $obj = clone $this;
        $obj['isValueRequired'] = $isValueRequired;

        return $obj;
    }

    /**
     * Maximum length of string. Only set this property if `type` is set to `Text` or `Textarea`.
     */
    public function withMaxLength(float $maxLength): self
    {
        $obj = clone $this;
        $obj['maxLength'] = $maxLength;

        return $obj;
    }

    /**
     * Maximum value of the field. Only set this property if field type is `Date` or `Number`. For `Date` type field, set the minimum date in ISO8601 string format. For `Number` type field, set the minimum numeric value.
     */
    public function withMaxValue(string|float $maxValue): self
    {
        $obj = clone $this;
        $obj['maxValue'] = $maxValue;

        return $obj;
    }

    /**
     * Minimum length of string. Only set this property if `type` is set to `Text` or `Textarea`.
     */
    public function withMinLength(float $minLength): self
    {
        $obj = clone $this;
        $obj['minLength'] = $minLength;

        return $obj;
    }

    /**
     * Minimum value of the field. Only set this property if field type is `Date` or `Number`. For `Date` type field, set the minimum date in ISO8601 string format. For `Number` type field, set the minimum numeric value.
     */
    public function withMinValue(string|float $minValue): self
    {
        $obj = clone $this;
        $obj['minValue'] = $minValue;

        return $obj;
    }

    /**
     * An array of allowed values. This property is only required if `type` property is set to `SingleSelect` or `MultiSelect`.
     *
     * @param list<string|float|bool> $selectOptions
     */
    public function withSelectOptions(array $selectOptions): self
    {
        $obj = clone $this;
        $obj['selectOptions'] = $selectOptions;

        return $obj;
    }
}
