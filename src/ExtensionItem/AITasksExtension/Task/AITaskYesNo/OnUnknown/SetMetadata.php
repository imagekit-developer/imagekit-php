<?php

declare(strict_types=1);

namespace ImageKit\ExtensionItem\AITasksExtension\Task\AITaskYesNo\OnUnknown;

use ImageKit\Core\Attributes\Required;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;
use ImageKit\ExtensionItem\AITasksExtension\Task\AITaskYesNo\OnUnknown\SetMetadata\Value;

/**
 * @phpstan-import-type ValueVariants from \ImageKit\ExtensionItem\AITasksExtension\Task\AITaskYesNo\OnUnknown\SetMetadata\Value
 * @phpstan-import-type ValueShape from \ImageKit\ExtensionItem\AITasksExtension\Task\AITaskYesNo\OnUnknown\SetMetadata\Value
 *
 * @phpstan-type SetMetadataShape = array{field: string, value: ValueShape}
 */
final class SetMetadata implements BaseModel
{
    /** @use SdkModel<SetMetadataShape> */
    use SdkModel;

    /**
     * Name of the custom metadata field to set.
     */
    #[Required]
    public string $field;

    /**
     * Value to set for the custom metadata field. The value type should match the custom metadata field type.
     *
     * @var ValueVariants $value
     */
    #[Required(union: Value::class)]
    public string|float|bool|array $value;

    /**
     * `new SetMetadata()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SetMetadata::with(field: ..., value: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SetMetadata)->withField(...)->withValue(...)
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
     * @param ValueShape $value
     */
    public static function with(
        string $field,
        string|float|bool|array $value
    ): self {
        $self = new self;

        $self['field'] = $field;
        $self['value'] = $value;

        return $self;
    }

    /**
     * Name of the custom metadata field to set.
     */
    public function withField(string $field): self
    {
        $self = clone $this;
        $self['field'] = $field;

        return $self;
    }

    /**
     * Value to set for the custom metadata field. The value type should match the custom metadata field type.
     *
     * @param ValueShape $value
     */
    public function withValue(string|float|bool|array $value): self
    {
        $self = clone $this;
        $self['value'] = $value;

        return $self;
    }
}
