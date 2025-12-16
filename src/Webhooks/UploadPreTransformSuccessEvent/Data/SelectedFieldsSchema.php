<?php

declare(strict_types=1);

namespace Imagekit\Webhooks\UploadPreTransformSuccessEvent\Data;

use Imagekit\Core\Attributes\Optional;
use Imagekit\Core\Attributes\Required;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Contracts\BaseModel;
use Imagekit\Webhooks\UploadPreTransformSuccessEvent\Data\SelectedFieldsSchema\DefaultValue;
use Imagekit\Webhooks\UploadPreTransformSuccessEvent\Data\SelectedFieldsSchema\SelectOption;
use Imagekit\Webhooks\UploadPreTransformSuccessEvent\Data\SelectedFieldsSchema\Type;

/**
 * @phpstan-import-type DefaultValueShape from \Imagekit\Webhooks\UploadPreTransformSuccessEvent\Data\SelectedFieldsSchema\DefaultValue
 * @phpstan-import-type MaxValueShape from \Imagekit\Webhooks\UploadPreTransformSuccessEvent\Data\SelectedFieldsSchema\MaxValue
 * @phpstan-import-type MinValueShape from \Imagekit\Webhooks\UploadPreTransformSuccessEvent\Data\SelectedFieldsSchema\MinValue
 * @phpstan-import-type SelectOptionShape from \Imagekit\Webhooks\UploadPreTransformSuccessEvent\Data\SelectedFieldsSchema\SelectOption
 *
 * @phpstan-type SelectedFieldsSchemaShape = array{
 *   type: Type|value-of<Type>,
 *   defaultValue?: DefaultValueShape|null,
 *   isValueRequired?: bool|null,
 *   maxLength?: float|null,
 *   maxValue?: MaxValueShape|null,
 *   minLength?: float|null,
 *   minValue?: MinValueShape|null,
 *   readOnly?: bool|null,
 *   selectOptions?: list<SelectOptionShape>|null,
 *   selectOptionsTruncated?: bool|null,
 * }
 */
final class SelectedFieldsSchema implements BaseModel
{
    /** @use SdkModel<SelectedFieldsSchemaShape> */
    use SdkModel;

    /**
     * Type of the custom metadata field.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * The default value for this custom metadata field. The value should match the `type` of custom metadata field.
     *
     * @var string|float|bool|list<string|float|bool>|null $defaultValue
     */
    #[Optional(union: DefaultValue::class)]
    public string|float|bool|array|null $defaultValue;

    /**
     * Specifies if the custom metadata field is required or not.
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
     * Indicates whether the custom metadata field is read only. A read only field cannot be modified after being set. This field is configurable only via the **Path policy** feature.
     */
    #[Optional]
    public ?bool $readOnly;

    /**
     * An array of allowed values when field type is `SingleSelect` or `MultiSelect`.
     *
     * @var list<string|float|bool>|null $selectOptions
     */
    #[Optional(list: SelectOption::class)]
    public ?array $selectOptions;

    /**
     * Specifies if the selectOptions array is truncated. It is truncated when number of options are > 100.
     */
    #[Optional]
    public ?bool $selectOptionsTruncated;

    /**
     * `new SelectedFieldsSchema()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SelectedFieldsSchema::with(type: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SelectedFieldsSchema)->withType(...)
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
     * @param DefaultValueShape $defaultValue
     * @param MaxValueShape $maxValue
     * @param MinValueShape $minValue
     * @param list<SelectOptionShape> $selectOptions
     */
    public static function with(
        Type|string $type,
        string|float|bool|array|null $defaultValue = null,
        ?bool $isValueRequired = null,
        ?float $maxLength = null,
        string|float|null $maxValue = null,
        ?float $minLength = null,
        string|float|null $minValue = null,
        ?bool $readOnly = null,
        ?array $selectOptions = null,
        ?bool $selectOptionsTruncated = null,
    ): self {
        $self = new self;

        $self['type'] = $type;

        null !== $defaultValue && $self['defaultValue'] = $defaultValue;
        null !== $isValueRequired && $self['isValueRequired'] = $isValueRequired;
        null !== $maxLength && $self['maxLength'] = $maxLength;
        null !== $maxValue && $self['maxValue'] = $maxValue;
        null !== $minLength && $self['minLength'] = $minLength;
        null !== $minValue && $self['minValue'] = $minValue;
        null !== $readOnly && $self['readOnly'] = $readOnly;
        null !== $selectOptions && $self['selectOptions'] = $selectOptions;
        null !== $selectOptionsTruncated && $self['selectOptionsTruncated'] = $selectOptionsTruncated;

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
     * The default value for this custom metadata field. The value should match the `type` of custom metadata field.
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
     * Indicates whether the custom metadata field is read only. A read only field cannot be modified after being set. This field is configurable only via the **Path policy** feature.
     */
    public function withReadOnly(bool $readOnly): self
    {
        $self = clone $this;
        $self['readOnly'] = $readOnly;

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

    /**
     * Specifies if the selectOptions array is truncated. It is truncated when number of options are > 100.
     */
    public function withSelectOptionsTruncated(
        bool $selectOptionsTruncated
    ): self {
        $self = clone $this;
        $self['selectOptionsTruncated'] = $selectOptionsTruncated;

        return $self;
    }
}
