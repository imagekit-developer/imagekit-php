<?php

declare(strict_types=1);

namespace Imagekit\ExtensionConfig;

use Imagekit\Core\Attributes\Required;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Contracts\BaseModel;
use Imagekit\ExtensionConfig\AutoTaggingExtension\Name;

/**
 * @phpstan-type AutoTaggingExtensionShape = array{
 *   maxTags: int, minConfidence: int, name: Name|value-of<Name>
 * }
 */
final class AutoTaggingExtension implements BaseModel
{
    /** @use SdkModel<AutoTaggingExtensionShape> */
    use SdkModel;

    /**
     * Maximum number of tags to attach to the asset.
     */
    #[Required]
    public int $maxTags;

    /**
     * Minimum confidence level for tags to be considered valid.
     */
    #[Required]
    public int $minConfidence;

    /**
     * Specifies the auto-tagging extension used.
     *
     * @var value-of<Name> $name
     */
    #[Required(enum: Name::class)]
    public string $name;

    /**
     * `new AutoTaggingExtension()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AutoTaggingExtension::with(maxTags: ..., minConfidence: ..., name: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AutoTaggingExtension)
     *   ->withMaxTags(...)
     *   ->withMinConfidence(...)
     *   ->withName(...)
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
     * @param Name|value-of<Name> $name
     */
    public static function with(
        int $maxTags,
        int $minConfidence,
        Name|string $name
    ): self {
        $self = new self;

        $self['maxTags'] = $maxTags;
        $self['minConfidence'] = $minConfidence;
        $self['name'] = $name;

        return $self;
    }

    /**
     * Maximum number of tags to attach to the asset.
     */
    public function withMaxTags(int $maxTags): self
    {
        $self = clone $this;
        $self['maxTags'] = $maxTags;

        return $self;
    }

    /**
     * Minimum confidence level for tags to be considered valid.
     */
    public function withMinConfidence(int $minConfidence): self
    {
        $self = clone $this;
        $self['minConfidence'] = $minConfidence;

        return $self;
    }

    /**
     * Specifies the auto-tagging extension used.
     *
     * @param Name|value-of<Name> $name
     */
    public function withName(Name|string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }
}
