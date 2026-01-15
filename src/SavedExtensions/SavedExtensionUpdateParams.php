<?php

declare(strict_types=1);

namespace Imagekit\SavedExtensions;

use Imagekit\Core\Attributes\Optional;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Concerns\SdkParams;
use Imagekit\Core\Contracts\BaseModel;
use Imagekit\ExtensionConfig;
use Imagekit\ExtensionConfig\AITasksExtension;
use Imagekit\ExtensionConfig\AutoDescriptionExtension;
use Imagekit\ExtensionConfig\AutoTaggingExtension;
use Imagekit\ExtensionConfig\RemovedotBgExtension;

/**
 * This API updates an existing saved extension. You can update the name, description, or config.
 *
 * @see Imagekit\Services\SavedExtensionsService::update()
 *
 * @phpstan-import-type ExtensionConfigVariants from \Imagekit\ExtensionConfig
 * @phpstan-import-type ExtensionConfigShape from \Imagekit\ExtensionConfig
 *
 * @phpstan-type SavedExtensionUpdateParamsShape = array{
 *   config?: ExtensionConfigShape|null,
 *   description?: string|null,
 *   name?: string|null,
 * }
 */
final class SavedExtensionUpdateParams implements BaseModel
{
    /** @use SdkModel<SavedExtensionUpdateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Configuration object for an extension (base extensions only, not saved extension references).
     *
     * @var ExtensionConfigVariants|null $config
     */
    #[Optional(union: ExtensionConfig::class)]
    public RemovedotBgExtension|AutoTaggingExtension|AutoDescriptionExtension|AITasksExtension|null $config;

    /**
     * Updated description of the saved extension.
     */
    #[Optional]
    public ?string $description;

    /**
     * Updated name of the saved extension.
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
        RemovedotBgExtension|array|AutoTaggingExtension|AutoDescriptionExtension|AITasksExtension|null $config = null,
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
        RemovedotBgExtension|array|AutoTaggingExtension|AutoDescriptionExtension|AITasksExtension $config,
    ): self {
        $self = clone $this;
        $self['config'] = $config;

        return $self;
    }

    /**
     * Updated description of the saved extension.
     */
    public function withDescription(string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * Updated name of the saved extension.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }
}
