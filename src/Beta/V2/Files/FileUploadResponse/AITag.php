<?php

declare(strict_types=1);

namespace ImageKit\Beta\V2\Files\FileUploadResponse;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;

/**
 * @phpstan-type ai_tag = array{
 *   confidence?: float|null, name?: string|null, source?: string|null
 * }
 */
final class AITag implements BaseModel
{
    /** @use SdkModel<ai_tag> */
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
     * Array of `AITags` associated with the image. If no `AITags` are set, it will be null. These tags can be added using the `google-auto-tagging` or `aws-auto-tagging` extensions.
     */
    #[Api(optional: true)]
    public ?string $source;

    public function __construct()
    {
        $this->initialize();
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
     * Array of `AITags` associated with the image. If no `AITags` are set, it will be null. These tags can be added using the `google-auto-tagging` or `aws-auto-tagging` extensions.
     */
    public function withSource(string $source): self
    {
        $obj = clone $this;
        $obj->source = $source;

        return $obj;
    }
}
