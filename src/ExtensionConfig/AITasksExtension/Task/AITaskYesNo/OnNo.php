<?php

declare(strict_types=1);

namespace Imagekit\ExtensionConfig\AITasksExtension\Task\AITaskYesNo;

use Imagekit\Core\Attributes\Optional;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Contracts\BaseModel;
use Imagekit\ExtensionConfig\AITasksExtension\Task\AITaskYesNo\OnNo\SetMetadata;
use Imagekit\ExtensionConfig\AITasksExtension\Task\AITaskYesNo\OnNo\UnsetMetadata;

/**
 * Actions to execute if the AI answers no.
 *
 * @phpstan-import-type SetMetadataShape from \Imagekit\ExtensionConfig\AITasksExtension\Task\AITaskYesNo\OnNo\SetMetadata
 * @phpstan-import-type UnsetMetadataShape from \Imagekit\ExtensionConfig\AITasksExtension\Task\AITaskYesNo\OnNo\UnsetMetadata
 *
 * @phpstan-type OnNoShape = array{
 *   addTags?: list<string>|null,
 *   removeTags?: list<string>|null,
 *   setMetadata?: list<SetMetadata|SetMetadataShape>|null,
 *   unsetMetadata?: list<UnsetMetadata|UnsetMetadataShape>|null,
 * }
 */
final class OnNo implements BaseModel
{
    /** @use SdkModel<OnNoShape> */
    use SdkModel;

    /**
     * Array of tag strings to add to the asset.
     *
     * @var list<string>|null $addTags
     */
    #[Optional('add_tags', list: 'string')]
    public ?array $addTags;

    /**
     * Array of tag strings to remove from the asset.
     *
     * @var list<string>|null $removeTags
     */
    #[Optional('remove_tags', list: 'string')]
    public ?array $removeTags;

    /**
     * Array of custom metadata field updates.
     *
     * @var list<SetMetadata>|null $setMetadata
     */
    #[Optional('set_metadata', list: SetMetadata::class)]
    public ?array $setMetadata;

    /**
     * Array of custom metadata fields to remove.
     *
     * @var list<UnsetMetadata>|null $unsetMetadata
     */
    #[Optional('unset_metadata', list: UnsetMetadata::class)]
    public ?array $unsetMetadata;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<string>|null $addTags
     * @param list<string>|null $removeTags
     * @param list<SetMetadata|SetMetadataShape>|null $setMetadata
     * @param list<UnsetMetadata|UnsetMetadataShape>|null $unsetMetadata
     */
    public static function with(
        ?array $addTags = null,
        ?array $removeTags = null,
        ?array $setMetadata = null,
        ?array $unsetMetadata = null,
    ): self {
        $self = new self;

        null !== $addTags && $self['addTags'] = $addTags;
        null !== $removeTags && $self['removeTags'] = $removeTags;
        null !== $setMetadata && $self['setMetadata'] = $setMetadata;
        null !== $unsetMetadata && $self['unsetMetadata'] = $unsetMetadata;

        return $self;
    }

    /**
     * Array of tag strings to add to the asset.
     *
     * @param list<string> $addTags
     */
    public function withAddTags(array $addTags): self
    {
        $self = clone $this;
        $self['addTags'] = $addTags;

        return $self;
    }

    /**
     * Array of tag strings to remove from the asset.
     *
     * @param list<string> $removeTags
     */
    public function withRemoveTags(array $removeTags): self
    {
        $self = clone $this;
        $self['removeTags'] = $removeTags;

        return $self;
    }

    /**
     * Array of custom metadata field updates.
     *
     * @param list<SetMetadata|SetMetadataShape> $setMetadata
     */
    public function withSetMetadata(array $setMetadata): self
    {
        $self = clone $this;
        $self['setMetadata'] = $setMetadata;

        return $self;
    }

    /**
     * Array of custom metadata fields to remove.
     *
     * @param list<UnsetMetadata|UnsetMetadataShape> $unsetMetadata
     */
    public function withUnsetMetadata(array $unsetMetadata): self
    {
        $self = clone $this;
        $self['unsetMetadata'] = $unsetMetadata;

        return $self;
    }
}
