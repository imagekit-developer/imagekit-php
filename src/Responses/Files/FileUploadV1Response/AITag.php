<?php

declare(strict_types=1);

namespace ImageKit\Responses\Files\FileUploadV1Response;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\Model;
use ImageKit\Core\Contracts\BaseModel;

/**
 * @phpstan-type ai_tag_alias = array{
 *   confidence?: float, name?: string, source?: string
 * }
 */
final class AITag implements BaseModel
{
    use Model;

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
     * Array of `AITags` associated with the image. If no `AITags` are set, it will be null. These tags can be added using the `google-auto-tagging` or `aws-auto-tagging` extensions.
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
    public static function from(
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
    public function setConfidence(float $confidence): self
    {
        $this->confidence = $confidence;

        return $this;
    }

    /**
     * Name of the tag.
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Array of `AITags` associated with the image. If no `AITags` are set, it will be null. These tags can be added using the `google-auto-tagging` or `aws-auto-tagging` extensions.
     */
    public function setSource(string $source): self
    {
        $this->source = $source;

        return $this;
    }
}
