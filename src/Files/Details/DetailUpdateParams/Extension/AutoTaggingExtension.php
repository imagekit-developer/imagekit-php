<?php

declare(strict_types=1);

namespace ImageKit\Files\Details\DetailUpdateParams\Extension;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\Model;
use ImageKit\Core\Contracts\BaseModel;
use ImageKit\Files\Details\DetailUpdateParams\Extension\AutoTaggingExtension\Name;

/**
 * @phpstan-type auto_tagging_extension_alias = array{
 *   maxTags: int, minConfidence: int, name: Name::*
 * }
 */
final class AutoTaggingExtension implements BaseModel
{
    use Model;

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
    public static function from(
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
    public function setMaxTags(int $maxTags): self
    {
        $this->maxTags = $maxTags;

        return $this;
    }

    /**
     * Minimum confidence level for tags to be considered valid.
     */
    public function setMinConfidence(int $minConfidence): self
    {
        $this->minConfidence = $minConfidence;

        return $this;
    }

    /**
     * Specifies the auto-tagging extension used.
     *
     * @param Name::* $name
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
