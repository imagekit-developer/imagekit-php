<?php

declare(strict_types=1);

namespace ImageKit\Files\FileUpdateParams\Update\UpdateFileDetails\Extension;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;
use ImageKit\Files\FileUpdateParams\Update\UpdateFileDetails\Extension\AutoTaggingExtension\Name;

/**
 * @phpstan-type auto_tagging_extension_alias = array{
 *   maxTags: int, minConfidence: int, name: Name::*
 * }
 */
final class AutoTaggingExtension implements BaseModel
{
    use SdkModel;

    /**
     * Maximum number of tags to attach to the asset.
     */
    #[Api]
    public int $maxTags;

    /**
     * Minimum confidence level for tags to be considered valid.
     */
    #[Api]
    public int $minConfidence;

    /**
     * Specifies the auto-tagging extension used.
     *
     * @var Name::* $name
     */
    #[Api(enum: Name::class)]
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
        self::introspect();
        $this->unsetOptionalProperties();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Name::* $name
     */
    public static function with(
        int $maxTags,
        int $minConfidence,
        string $name
    ): self {
        $obj = new self;

        $obj->maxTags = $maxTags;
        $obj->minConfidence = $minConfidence;
        $obj->name = $name;

        return $obj;
    }

    /**
     * Maximum number of tags to attach to the asset.
     */
    public function withMaxTags(int $maxTags): self
    {
        $obj = clone $this;
        $obj->maxTags = $maxTags;

        return $obj;
    }

    /**
     * Minimum confidence level for tags to be considered valid.
     */
    public function withMinConfidence(int $minConfidence): self
    {
        $obj = clone $this;
        $obj->minConfidence = $minConfidence;

        return $obj;
    }

    /**
     * Specifies the auto-tagging extension used.
     *
     * @param Name::* $name
     */
    public function withName(string $name): self
    {
        $obj = clone $this;
        $obj->name = $name;

        return $obj;
    }
}
