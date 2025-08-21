<?php

declare(strict_types=1);

namespace ImageKit\Responses\Files\Versions\VersionRestoreResponse;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;

/**
 * @phpstan-type ai_tag_alias = array{
 *   confidence?: float, name?: string, source?: string
 * }
 */
final class AITag implements BaseModel
{
    use SdkModel;

    /**
     * Confidence score of the tag.
     */
    #[Api(optional: true)]
    public ?float $confidence;

    /**
     * Name of the tag.
     */
    #[Api(optional: true)]
    public ?string $name;

    /**
     * Source of the tag. Possible values are `google-auto-tagging` and `aws-auto-tagging`.
     */
    #[Api(optional: true)]
    public ?string $source;

    public function __construct()
    {
        self::introspect();
        $this->unsetOptionalProperties();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(
        ?float $confidence = null,
        ?string $name = null,
        ?string $source = null
    ): self {
        $obj = new self;

        null !== $confidence && $obj->confidence = $confidence;
        null !== $name && $obj->name = $name;
        null !== $source && $obj->source = $source;

        return $obj;
    }

    /**
     * Confidence score of the tag.
     */
    public function withConfidence(float $confidence): self
    {
        $obj = clone $this;
        $obj->confidence = $confidence;

        return $obj;
    }

    /**
     * Name of the tag.
     */
    public function withName(string $name): self
    {
        $obj = clone $this;
        $obj->name = $name;

        return $obj;
    }

    /**
     * Source of the tag. Possible values are `google-auto-tagging` and `aws-auto-tagging`.
     */
    public function withSource(string $source): self
    {
        $obj = clone $this;
        $obj->source = $source;

        return $obj;
    }
}
