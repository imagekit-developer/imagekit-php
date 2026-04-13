<?php

declare(strict_types=1);

namespace Imagekit\Beta\V2\Files\FileUploadResponse;

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
     * Source of the tag. Possible values are `google-auto-tagging` and `aws-auto-tagging`.
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
     * Source of the tag. Possible values are `google-auto-tagging` and `aws-auto-tagging`.
     */
    public function withSource(string $source): self
    {
        $self = clone $this;
        $self['source'] = $source;

        return $self;
    }
}
