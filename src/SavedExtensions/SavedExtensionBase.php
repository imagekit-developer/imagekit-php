<?php

declare(strict_types=1);

namespace ImageKit\SavedExtensions;

use ImageKit\AITasksExtension;
use ImageKit\AutoTaggingExtension;
use ImageKit\Core\Attributes\Optional;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;
use ImageKit\ExtensionConfig;
use ImageKit\ExtensionConfig\AutoDescriptionExtension;
use ImageKit\RemovedotBgextension;

/**
 * @phpstan-import-type ExtensionConfigVariants from \ImageKit\ExtensionConfig
 * @phpstan-import-type ExtensionConfigShape from \ImageKit\ExtensionConfig
 *
 * @phpstan-type SavedExtensionBaseShape = array{
 *   config?: ExtensionConfigShape|null,
 *   description?: string|null,
 *   name?: string|null,
 * }
 */
final class SavedExtensionBase implements BaseModel
{
    /** @use SdkModel<SavedExtensionBaseShape> */
    use SdkModel;

    /**
     * Configuration object for an extension (base extensions only, not saved extension references).
     *
     * @var ExtensionConfigVariants|null $config
     */
    #[Optional(union: ExtensionConfig::class)]
    public RemovedotBgextension|AutoTaggingExtension|AutoDescriptionExtension|AITasksExtension|null $config;

    /**
     * Description of the saved extension.
     */
    #[Optional]
    public ?string $description;

    /**
     * Name of the saved extension.
     */
    #[Optional]
    public ?string $name;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param ExtensionConfigShape|null $config
     */
    public static function with(
        RemovedotBgextension|array|AutoTaggingExtension|AutoDescriptionExtension|AITasksExtension|null $config = null,
        ?string $description = null,
        ?string $name = null,
    ): self {
        $self = new self;

        null !== $config && $self['config'] = $config;
        null !== $description && $self['description'] = $description;
        null !== $name && $self['name'] = $name;

        return $self;
    }

    /**
     * Configuration object for an extension (base extensions only, not saved extension references).
     *
     * @param ExtensionConfigShape $config
     */
    public function withConfig(
        RemovedotBgextension|array|AutoTaggingExtension|AutoDescriptionExtension|AITasksExtension $config,
    ): self {
        $self = clone $this;
        $self['config'] = $config;

        return $self;
    }

    /**
     * Description of the saved extension.
     */
    public function withDescription(string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * Name of the saved extension.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }
}
