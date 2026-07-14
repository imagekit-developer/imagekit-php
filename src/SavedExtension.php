<?php

declare(strict_types=1);

namespace ImageKit;

use ImageKit\Core\Attributes\Optional;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;
use ImageKit\ExtensionConfig\AITasksExtension;
use ImageKit\ExtensionConfig\AutoDescriptionExtension;
use ImageKit\ExtensionConfig\AutoTaggingExtension;
use ImageKit\ExtensionConfig\RemovedotBgExtension;

/**
 * Saved extension object containing extension configuration.
 *
 * @phpstan-import-type ExtensionConfigVariants from \ImageKit\ExtensionConfig
 * @phpstan-import-type ExtensionConfigShape from \ImageKit\ExtensionConfig
 *
 * @phpstan-type SavedExtensionShape = array{
 *   id?: string|null,
 *   config?: ExtensionConfigShape|null,
 *   createdAt?: \DateTimeInterface|null,
 *   description?: string|null,
 *   name?: string|null,
 *   updatedAt?: \DateTimeInterface|null,
 * }
 */
final class SavedExtension implements BaseModel
{
    /** @use SdkModel<SavedExtensionShape> */
    use SdkModel;

    /**
     * Unique identifier of the saved extension.
     */
    #[Optional]
    public ?string $id;

    /**
     * Configuration object for an extension (base extensions only, not saved extension references).
     *
     * @var ExtensionConfigVariants|null $config
     */
    #[Optional(union: ExtensionConfig::class)]
    public RemovedotBgExtension|AutoTaggingExtension|AutoDescriptionExtension|AITasksExtension|null $config;

    /**
     * Timestamp when the saved extension was created.
     */
    #[Optional]
    public ?\DateTimeInterface $createdAt;

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

    /**
     * Timestamp when the saved extension was last updated.
     */
    #[Optional]
    public ?\DateTimeInterface $updatedAt;

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
        ?string $id = null,
        RemovedotBgExtension|array|AutoTaggingExtension|AutoDescriptionExtension|AITasksExtension|null $config = null,
        ?\DateTimeInterface $createdAt = null,
        ?string $description = null,
        ?string $name = null,
        ?\DateTimeInterface $updatedAt = null,
    ): self {
        $self = new self;

        null !== $id && $self['id'] = $id;
        null !== $config && $self['config'] = $config;
        null !== $createdAt && $self['createdAt'] = $createdAt;
        null !== $description && $self['description'] = $description;
        null !== $name && $self['name'] = $name;
        null !== $updatedAt && $self['updatedAt'] = $updatedAt;

        return $self;
    }

    /**
     * Unique identifier of the saved extension.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

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
     * Timestamp when the saved extension was created.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

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

    /**
     * Timestamp when the saved extension was last updated.
     */
    public function withUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $self = clone $this;
        $self['updatedAt'] = $updatedAt;

        return $self;
    }
}
