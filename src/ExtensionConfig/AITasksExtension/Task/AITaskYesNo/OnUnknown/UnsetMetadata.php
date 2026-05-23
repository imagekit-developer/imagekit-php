<?php

declare(strict_types=1);

namespace ImageKit\ExtensionConfig\AITasksExtension\Task\AITaskYesNo\OnUnknown;

use ImageKit\Core\Attributes\Required;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;

/**
 * @phpstan-type UnsetMetadataShape = array{field: string}
 */
final class UnsetMetadata implements BaseModel
{
    /** @use SdkModel<UnsetMetadataShape> */
    use SdkModel;

    /**
     * Name of the custom metadata field to remove.
     */
    #[Required]
    public string $field;

    /**
     * `new UnsetMetadata()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * UnsetMetadata::with(field: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new UnsetMetadata)->withField(...)
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
     */
    public static function with(string $field): self
    {
        $self = new self;

        $self['field'] = $field;

        return $self;
    }

    /**
     * Name of the custom metadata field to remove.
     */
    public function withField(string $field): self
    {
        $self = clone $this;
        $self['field'] = $field;

        return $self;
    }
}
