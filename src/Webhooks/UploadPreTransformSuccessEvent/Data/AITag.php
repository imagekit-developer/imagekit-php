<?php

declare(strict_types=1);

namespace Imagekit\Webhooks\UploadPreTransformSuccessEvent\Data;

use Imagekit\Core\Attributes\Optional;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Contracts\BaseModel;

/**
 * @phpstan-type AITagShape = array{
 *   confidence?: float|null, name?: string|null, source?: string|null
 * }
 */
final class AITag implements BaseModel
{
    /** @use SdkModel<AITagShape> */
    use SdkModel;

    /**
     * Confidence score of the tag.
     */
    #[Optional]
    public ?float $confidence;

    /**
     * Name of the tag.
     */
    #[Optional]
    public ?string $name;

    /**
     * Array of `AITags` associated with the image. If no `AITags` are set, it will be null. These tags can be added using the `google-auto-tagging` or `aws-auto-tagging` extensions.
     */
    #[Optional]
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
        $self = new self;

        null !== $confidence && $self['confidence'] = $confidence;
        null !== $name && $self['name'] = $name;
        null !== $source && $self['source'] = $source;

        return $self;
    }

    /**
     * Confidence score of the tag.
     */
    public function withConfidence(float $confidence): self
    {
        $self = clone $this;
        $self['confidence'] = $confidence;

        return $self;
    }

    /**
     * Name of the tag.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * Array of `AITags` associated with the image. If no `AITags` are set, it will be null. These tags can be added using the `google-auto-tagging` or `aws-auto-tagging` extensions.
     */
    public function withSource(string $source): self
    {
        $self = clone $this;
        $self['source'] = $source;

        return $self;
    }
}
