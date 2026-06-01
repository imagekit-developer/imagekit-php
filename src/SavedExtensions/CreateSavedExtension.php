<?php

declare(strict_types=1);

namespace ImageKit\SavedExtensions;

use ImageKit\AITasksExtension;
use ImageKit\AutoDescriptionExtension;
use ImageKit\AutoTaggingExtension;
use ImageKit\Core\Attributes\Required;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;
use ImageKit\ExtensionConfig;
use ImageKit\RemovedotBgExtension;

/**
 * @phpstan-import-type ExtensionConfigVariants from \ImageKit\ExtensionConfig
 * @phpstan-import-type ExtensionConfigShape from \ImageKit\ExtensionConfig
 *
 * @phpstan-type CreateSavedExtensionShape = array{
 *   config: ExtensionConfigShape, description: string, name: string
 * }
 */
final class CreateSavedExtension implements BaseModel
{
    /** @use SdkModel<CreateSavedExtensionShape> */
    use SdkModel;

    /**
     * Configuration object for an extension (base extensions only, not saved extension references).
     *
     * @var ExtensionConfigVariants $config
     */
    #[Required(union: ExtensionConfig::class)]
    public RemovedotBgExtension|AutoTaggingExtension|AutoDescriptionExtension|AITasksExtension $config;

    /**
     * Description of the saved extension.
     */
    #[Required]
    public string $description;

    /**
     * Name of the saved extension.
     */
    #[Required]
    public string $name;

    /**
     * `new CreateSavedExtension()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CreateSavedExtension::with(config: ..., description: ..., name: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CreateSavedExtension)->withConfig(...)->withDescription(...)->withName(...)
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
     * @param ExtensionConfigShape $config
     */
    public static function with(
        RemovedotBgExtension|array|AutoTaggingExtension|AutoDescriptionExtension|AITasksExtension $config,
        string $description,
        string $name,
    ): self {
        $self = new self;

        $self['config'] = $config;
        $self['description'] = $description;
        $self['name'] = $name;

        return $self;
    }

    /**
     * Configuration object for an extension (base extensions only, not saved extension references).
     *
     * @param ExtensionConfigShape $config
     */
    public function withConfig(
        RemovedotBgExtension|array|AutoTaggingExtension|AutoDescriptionExtension|AITasksExtension $config,
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
